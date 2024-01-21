document.addEventListener( "DOMCrontentLoaded",
  fetchData().then(() => {
    generateFilters();
    generateDatalist(articleData);
  })
);

let articleData = []
// generate data list for search box
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

let totalItems = 0;
const selectedYears = [];
let selectedJournals = [];
const sortBySelect = document.querySelector("select");
let sortBySelected = "total_interactions";

// function to update url based on selected journal
function updateURL(selectedJournals){
  let url = new URL(window.location.href);
  url.searchParams.set('journal', selectedJournals); 
  history.replaceState(null, '', url.toString());
}

// handle search element event submit with sorting change
document.getElementById("search-form").addEventListener("submit", function (event) {
    event.preventDefault();
    let searchInputValue = document.getElementById("result").value;
    updateURL(selectedJournals)
    fetchData(searchInputValue, selectedYears, sortBySelected)
  });

const searchInput = document.getElementById("result");
let debounceTimer;
  
searchInput.addEventListener("input", (event) => {
  event.preventDefault();

  clearTimeout(debounceTimer);

  debounceTimer = setTimeout(() => {
    let searchInputValue = searchInput.value;
    updateURL(selectedJournals);
    
    fetchData(searchInputValue, selectedYears, sortBySelected)
  }, 2000); 
});
  

// handle sort select element event change
sortBySelect.addEventListener("change", function (event) {
  event.preventDefault();
  let searchInputValue = document.getElementById("result").value;
  sortBySelected = sortBySelect.value;
  fetchData(searchInputValue, selectedYears, sortBySelected)
});


// updte selected years based on checkbox
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

async function fetchJournal(journal) {
  const response = await fetch(
    `https://web-production-cecc.up.railway.app/api/journal/?id=${journal}`,
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
  console.log(data.journalDetails)
  generateJournalPreview(data.journalDetails)
}
// function to generate frontend of journal preview
function generateJournalPreview(journal) {
  const journalPreview = document.querySelector(".journal-preview");

   journalPreview.classList.add("d-flex")

  journalPreview.querySelector("img").src = `../Files/journal-image/${journal.image}`;
  journalPreview.querySelector("h2").innerHTML= journal.journal
  journalPreview.querySelector(".issn").querySelector("span").innerHTML = `2071-1050 (Online)`
  journalPreview.querySelector(".date").querySelector("span").innerHTML =   new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(new Date(journal.date_added))
  journalPreview.querySelector(".board").querySelector("span").innerHTML = journal.editorial
  journalPreview.querySelector(".info").querySelector("span").innerHTML = journal.description
}


// function to fetch and generate journal and year filters (dynamic)
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

    const labelText = document.createTextNode(` ${years[i]}`);
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

    const labelText = document.createTextNode(` ${journals[i].split("->")[1]}`);
    const labelButton = document.createElement("button")
    labelButton.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32"><path fill="none" stroke="#0858a4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 3h7v7m-1.5-5.5L20 12m-3-7H8a3 3 0 0 0-3 3v16a3 3 0 0 0 3 3h16a3 3 0 0 0 3-3v-9"/></svg>`

    labelButton.addEventListener('click', function() {
      const journalId = journals[i].split(" ->")[0];
      updateURL([journalId]);
    
      // Reset all checkboxes to unchecked
      const checkboxes = document.querySelectorAll('input[type="checkbox"]');
      checkboxes.forEach(checkbox => {
        checkbox.checked = false;
      });
    
      // Set the specific checkbox to checked
      const checkbox = document.getElementById(`journal${journalId}`);
        checkbox.checked = true;
      selectedJournals=[journalId]
      fetchData();
      if (selectedJournals.length ==1){
        fetchJournal(journalId)
      }
    });
    
    journalItem.appendChild(journalCheckbox);
    journalItem.appendChild(labelText);
    journalItem.appendChild(labelButton)

    journalCheckbox.addEventListener("change", () =>
      updateSelectedJournals(journalCheckbox, journalCheckbox.value)
      // console.log(journalCheckbox.value, "journal")
    );

    journalsContainer.appendChild(journalItem);
  }
}

// fetch data based on current page
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
  fetchData(searchInputValue, selectedYears,sortBySelected, page)
}

var result = document.getElementById("result");

// speech recognition search
function startConverting() {
  var voiceButton = document.getElementById("voiceSearch")
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
      voiceButton.classList.add("bg-secondary")
      voiceButton.innerHTML=`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><circle cx="18" cy="12" r="0" fill="white"><animate attributeName="r" begin=".67" calcMode="spline" dur="1.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite" values="0;2;0;0"/></circle><circle cx="12" cy="12" r="0" fill="white"><animate attributeName="r" begin=".33" calcMode="spline" dur="1.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite" values="0;2;0;0"/></circle><circle cx="6" cy="12" r="0" fill="white"><animate attributeName="r" begin="0" calcMode="spline" dur="1.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite" values="0;2;0;0"/></circle></svg>`

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
      voiceButton.innerHTML =`<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="white" d="M16 2a6 6 0 0 0-6 6v8a6 6 0 0 0 12 0V8a6 6 0 0 0-6-6ZM7 15a1 1 0 0 1 1 1a8 8 0 1 0 16 0a1 1 0 1 1 2 0c0 5.186-3.947 9.45-9.001 9.95L17 26v3a1 1 0 1 1-2 0v-3l.001-.05C9.947 25.45 6 21.187 6 16a1 1 0 0 1 1-1Z" /></svg>`
      voiceButton.classList.remove("bg-secondary")
      recognizing = false;
      searchInputValue = finalTranscripts;
      fetchData(finalTranscripts, selectedYears, sortby)
    };
    speechRecognizer.onerror = function (event) {};
  } else {

    result.innerHTML =
      "Your browser is not supported. Please download Google Chrome or update your Google Chrome!";
       function swal() {
        Swal.fire({
          icon: "warning",
          text: "Sorry. Voice search is not supported in your browser. Please try using Google Chrome or another supported browser."
        });
      };
      swal()
      voiceButton.setAttribute("disabled","true")
      voiceButton.classList.add("bg-secondary")
      voiceButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="white" d="M4.93 12.01a1 1 0 0 1 1.13.848a6.001 6.001 0 0 0 7.832 4.838l.293-.107l1.509 1.509a7.94 7.94 0 0 1-2.336.787l-.358.053V21a1 1 0 0 1-1.993.117L11 21v-1.062a8.005 8.005 0 0 1-6.919-6.796a1 1 0 0 1 .848-1.132ZM12 2a5 5 0 0 1 4.995 4.783L17 7v5a4.98 4.98 0 0 1-.691 2.538l-.137.22l.719.719c.542-.76.91-1.652 1.048-2.619a1 1 0 0 1 1.98.284a7.96 7.96 0 0 1-1.412 3.513l-.187.25l2.165 2.166a1 1 0 0 1-1.32 1.497l-.094-.083L3.515 4.93a1 1 0 0 1 1.32-1.497l.094.083l2.23 2.23A5.002 5.002 0 0 1 12 2m-5 8.404l6.398 6.398A5 5 0 0 1 7 12z"/></g></svg>`
  }
}

// generate pagination items button
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

async function fetchData(input, dates,sort, currentPage = 0) {
  // get journal params from url
  function getQueryParam(name) {
    const urlSearchParams = new URLSearchParams(window.location.search);
    return urlSearchParams.get(name);
  }
  
  const journalId = getQueryParam("journal");

  if (journalId && journalId.split(",").length ==1){
    fetchJournal(journalId)
  }

  const articlesContainer = document.querySelector("#articles");
  const total = document.querySelector("#total");
  const loading = document.querySelector('#skeleton-container');

  loading.classList.add("d-flex")

  // fetch articles
  try {

    const response = await fetch(
      `https://web-production-cecc.up.railway.app/api/articles/?sort=${sort}`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          journal: journalId!=null ? journalId : [],
          dates: dates,
          input: typeof input == "string" ? input : "",
        }),
      }
    );

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

   // display and render article items
    articlesContainer.innerHTML = "";
   
    total.innerHTML = "";
    let noOfItems = 10;
    articleData = data.results
    data.results
      .slice(currentPage * noOfItems, noOfItems * (currentPage + 1))
      .forEach((item) => {
        const articleDiv = document.createElement("div");
        articleDiv.classList.add("articles", "d-flex", "flex-column", "flex-md-row");

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
            
            new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(new Date(item.publication_date))
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
      loading.classList.add("d-none") 
    total.innerHTML = `${data.total} searched articles`;
    generatePagination(data.total)
  } catch (error) {
    console.error("Error fetching data:", error);
    articlesContainer.innerHTML = `No match found for ${input}.`
    total.innerHTML = '0 searched article'
    loading.classList.add("d-none") 
  }
}
