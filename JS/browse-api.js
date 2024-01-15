document.addEventListener( "DOMContentLoaded",
  fetchData().then((totalItems) => {
    generatePagination(totalItems);
    generateFilters();
    generateDatalist(articleData);
  })
);
let articleData = []

function generateDatalist(articleData){
  const articleList = document.getElementById("articlesList");

  // Clear existing options in the select element
  articleList.innerHTML = "";
  
  // Iterate over the article data and create options
  for (const article of articleData) {
    const option = document.createElement("option");
    option.value = article.title; 
    option.text = article.title; 
    articleList.appendChild(option);
  console.log(article.title,"data")

  }
}


const sortBySelect = document.querySelector("select");
let sortBySelected = "total_interactions";

// handle search element event submit with sorting change
document.getElementById("search-form").addEventListener("submit", function (event) {
    event.preventDefault();
    let searchInputValue = document.getElementById("result").value;
    fetchData(searchInputValue, selectedYears,selectedJournals, sortBySelected).then(
      (totalItems) => {
        generatePagination(totalItems);
      }
    );
  });

// handle sort select element event change
sortBySelect.addEventListener("change", function (event) {
  event.preventDefault();
  let searchInputValue = document.getElementById("result").value;
  sortBySelected = sortBySelect.value;
  fetchData(searchInputValue, selectedYears, selectedJournals, sortBySelected).then(
    (totalItems) => {
      generatePagination(totalItems);
    }
  );
});

let totalItems = 0;
const selectedYears = [];
const selectedJournals = [];

const updateSelectedYears = (checkbox, year) => {
  if (checkbox.checked) {
    if (!selectedYears.includes(year)) {
      selectedYears.push(year);
    }
  } else {
    const index = selectedYears.indexOf(year);
    if (index !== -1) {
      selectedYears.splice(index, 1);
    }
  }
};

const updateSelectedJournals = (checkbox, journal) => {
  if (checkbox.checked) {
    if (!selectedJournals.includes(journal)) {
      selectedJournals.push(journal);
    }
  } else {
    const index = selectedJournals.indexOf(journal);
    if (index !== -1) {
      selectedJournals.splice(index, 1);
    }
  }
};
async function generateFilters() {
  const response = await fetch(
    "https://web-production-cecc.up.railway.app/api/articles/filters",
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  );

  if (!response.ok) {
    throw new Error(`HTTP error! Status: ${response.status}`);
  }

  const data = await response.json();
  const years = data.distinct_years.split(",").map(Number);
  const journals = data.journals.split(",");

  const yearsContainer = document.getElementById("years-container");
  const journalsContainer = document.getElementById("journals-container")

  for (let i = 0; i < years.length; i++) {
    const yearItem = document.createElement("label");
    yearItem.classList.add("checkbox-label");

    const yearCheckbox = document.createElement("input");
    yearCheckbox.type = "checkbox";
    yearCheckbox.id = `year${i + 1}`;
    yearCheckbox.classList.add("checkbox");
    yearCheckbox.value = years[i];

    const labelText = document.createTextNode(` ${years[i]} (20)`);
    yearItem.appendChild(yearCheckbox);
    yearItem.appendChild(labelText);

    yearCheckbox.addEventListener("change", () =>
      updateSelectedYears(yearCheckbox, yearCheckbox.value)
    );

    yearsContainer.appendChild(yearItem);
  }

  for (let i = 0; i < journals.length; i++) {
    const journalItem = document.createElement("label");
    journalItem.classList.add("checkbox-label");

    const journalCheckbox = document.createElement("input");
    journalCheckbox.type = "checkbox";
    journalCheckbox.id = `journal${i + 1}`;
    journalCheckbox.classList.add("checkbox");
    journalCheckbox.value = journals[i].split(" ->")[0];

    const labelText = document.createTextNode(` ${journals[i].split("->")[1]} (20)`);
    journalItem.appendChild(journalCheckbox);
    journalItem.appendChild(labelText);

    journalCheckbox.addEventListener("change", () =>
      updateSelectedJournals(journalCheckbox, journalCheckbox.value)
      // console.log(journalCheckbox.value, "journal")
    );

    journalsContainer.appendChild(journalItem);
  }
}



const currentPageItem = document.querySelector(`.page-item:nth-child(2)`);
currentPageItem.classList.add("active");
function changePage(page) {
  event.preventDefault();

  const pageItems = document.querySelectorAll(".page-item");
  pageItems.forEach((item) => item.classList.remove("active"));

  const currentPageItem = document.querySelector(
    `.page-item:nth-child(${page + 1})`
  );
  if (currentPageItem) {
    currentPageItem.classList.add("active");
  }
  let searchInputValue = document.getElementById("result").value;
  let year = document.getElementById("year1").value;
  sortBySelected = sortBySelect.value;
  fetchData(searchInputValue, selectedYears, selectedJournals,sortBySelected, page).then(
    (totalItems) => {
      generatePagination(totalItems);
    }
  );
}

var result = document.getElementById("result");

function startConverting() {
  result.innerText = "";
  console.log("voice");
  if ("webkitSpeechRecognition" in window) {
    var speechRecognizer = new webkitSpeechRecognition();
    speechRecognizer.continuous = false;
    speechRecognizer.interimResults = true;
    speechRecognizer.lang = "en-US";
    speechRecognizer.start();
    var recognizing = false;
    speechRecognizer.onstart = function () {
      recognizing = true;
    };
    var finalTranscripts = "";
    speechRecognizer.onresult = function (event) {
      var interimTranscripts = "";
      for (var i = event.resultIndex; i < event.results.length; i++) {
        var transcript = event.results[i][0].transcript;
        if (event.results[i].isFinal) {
          finalTranscripts += transcript.replace(".", ""); // Remove periods
        } else {
          interimTranscripts += transcript;
        }
      }
      console.log(finalTranscripts);
      result.setAttribute("value", `${finalTranscripts + interimTranscripts}`);
    };
    speechRecognizer.onend = function () {
      recognizing = false;
      searchInputValue = finalTranscripts;
      fetchData(finalTranscripts, selectedYears,selectedJournals, sortby).then((totalItems) => {
        generatePagination(totalItems);
      });
    };
    speechRecognizer.onerror = function (event) {};
  } else {
    result.innerHTML =
      "Your browser is not supported. Please download Google Chrome or update your Google Chrome!";
  }
}

function generatePagination(totalItems) {
  const totalPages = Math.ceil(totalItems / 10);
  const paginationContainer = document.getElementById("pagination-container");

  // Clear existing content
  paginationContainer.innerHTML = "";

  for (let i = 0; i < totalPages; i++) {
    const pageItem = document.createElement("li");
    pageItem.classList.add("page-item");

    const pageLink = document.createElement("a");
    pageLink.classList.add("page-link");
    pageLink.href = "javascript:void(0);";
    pageLink.textContent = i + 1;

    pageLink.addEventListener("click", function () {
      changePage(i);
    });

    pageItem.appendChild(pageLink);
    paginationContainer.appendChild(pageItem);
  }
}

function navigateToArticle(articleId) {
  window.location.href = `../PHP/article-details.php?articleId=${articleId}`;
}

async function fetchData(input, dates, journals,sort, currentPage = 0) {
  try {
    const response = await fetch(
      `https://web-production-cecc.up.railway.app/api/articles/?sort=${sort}`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          journal: journals,
          dates: dates,
          input: typeof input == "string" ? input : "",
        }),
      }
    );

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

    const articlesContainer = document.querySelector("#articles");
    articlesContainer.innerHTML = "";
    const total = document.querySelector("#total");
    total.innerHTML = "";
    let noOfItems = 10;
    articleData = data.results
    data.results
      .slice(currentPage * noOfItems, noOfItems * (currentPage + 1))
      .forEach((item) => {
        const articleDiv = document.createElement("div");
        articleDiv.classList.add("articles");
        articleDiv.addEventListener("click", () =>
          navigateToArticle(item.article_id)
        );
        const keywordsArray = item.keyword.split(",");

        let keywordsHTML = "";
        for (const keyword of keywordsArray) {
          keywordsHTML += `<span class="keyword">${keyword.trim()}</span>`;
        }
        let contributorsHTML = "";
        if (item.contributors != null) {
          contributorsHTML = "By ";
          for (const contributors of item.contributors.split(",")) {
            contributorsHTML += `<a href="https://orcid.org/${
              contributors.split("->")[1]
            }">${contributors.split("->")[0]}</a> | `;
          }
        }
        articleDiv.innerHTML = `
        <div class="article-details">
        <h6 style="color: #0858a4;"><strong>${item.title} - (${
          item.publication_date
        })</strong></h6>
        <p style="color: #454545;">${item.abstract.slice(0, 200)} </p>
        <div class="keywords">
        ${keywordsHTML}
        </div>
        ${
          item.article_contains[0] != ""
            ? `Terms found:  ${item.article_contains.join(", ")}`
            : ""
        }
    </div>
    <div class="article-stats">
        <div class="stats-container">
            <div class="view-download">
                <p class="stats-value" style="color: #0858a4;">${
                  item.total_reads
                }</p>
                <p class="stats-label" style="color: #959595;">VIEWS</p>
            </div>
            <div class="view-download">
                <p class="stats-value" style="color: #0858a4;">${
                  item.total_downloads
                }</p>
                <p class="stats-label" style="color: #959595;">DOWNLOADS</p>
            </div>
            <div class="view-download">
            <p class="stats-value" style="color: #0858a4;">${
              item.total_citations
            }</p>
            <p class="stats-label" style="color: #959595;">CITATIONS</p>
        </div>
        </div>
        <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
        <div class="published-info">
            <h6 class="publish-label" style="color: #0858a4;"><strong>Published in The ${
              item.journal
            }</strong></h6>
            <p class="authors" style="color: #959595;">${contributorsHTML}</p>
            
        </div>
    </div>
      `;

        articlesContainer.appendChild(articleDiv);
      });

    total.innerHTML = `${data.total} searched articles`;
    totalItems = data.total;
    return totalItems;
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}
