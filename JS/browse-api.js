document.addEventListener('DOMContentLoaded', fetchData().then((totalItems) => {
  generatePagination(totalItems);
}));

let totalItems=0
  const selectedYears = [];
  const year1Checkbox = document.getElementById('year1');
  const year2Checkbox = document.getElementById('year2');
  const year3Checkbox = document.getElementById('year3');
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
  }
  year1Checkbox.addEventListener('change', () => updateSelectedYears(year1Checkbox, "2022"));
  year2Checkbox.addEventListener('change', () => updateSelectedYears(year2Checkbox, "2023"));
  year3Checkbox.addEventListener('change', () => updateSelectedYears(year3Checkbox, "2024"));

  const sortBySelect = document.querySelector("select");
  let sortBySelected = "total_interactions"
  // handle search element event submit with sorting change
  document.getElementById('search-form').addEventListener('submit', function(event) {
      event.preventDefault();
      let searchInputValue = document.getElementById('result').value;
      let year = document.getElementById('year1').value;
      fetchData(searchInputValue, selectedYears, sortBySelected).then((totalItems) => {
        // Do something with totalItems
        generatePagination(totalItems)});
  });
  // handle sort select element event change
  sortBySelect.addEventListener('change', function(event) {
      event.preventDefault();
      let searchInputValue = document.getElementById('result').value;
      let year = document.getElementById('year1').value;
      sortBySelected = sortBySelect.value;
      fetchData(searchInputValue, selectedYears, sortBySelected).then((totalItems) => {
        // Do something with totalItems
        generatePagination(totalItems);
      });
  });
  const currentPageItem = document.querySelector(`.page-item:nth-child(2)`);
  currentPageItem.classList.add('active');
  function changePage (page) {
      event.preventDefault();

      // Remove "active" class from all page items
      const pageItems = document.querySelectorAll('.page-item');
      pageItems.forEach(item => item.classList.remove('active'));

      // Set "active" class to the clicked page item
      const currentPageItem = document.querySelector(`.page-item:nth-child(${page+1})`);
      if (currentPageItem) {
          currentPageItem.classList.add('active');
      }
      let searchInputValue = document.getElementById('result').value;
      let year = document.getElementById('year1').value;
      sortBySelected = sortBySelect.value;
      fetchData(searchInputValue, selectedYears, sortBySelected,page).then((totalItems) => {
        // Do something with totalItems
        generatePagination(totalItems)});
  console.log(totalItems,"total")

  }

  var result = document.getElementById('result');

  function startConverting() {
      result.innerText = '';
      console.log("voice")
      if ('webkitSpeechRecognition' in window) {
          var speechRecognizer = new webkitSpeechRecognition();
          speechRecognizer.continuous = false;
          speechRecognizer.interimResults = true;
          speechRecognizer.lang = 'en-US';
          speechRecognizer.start();
          var recognizing = false;
          speechRecognizer.onstart = function() {
              recognizing = true;
          };
          var finalTranscripts = '';
          speechRecognizer.onresult = function(event) {
              var interimTranscripts = '';
              for (var i = event.resultIndex; i < event.results.length; i++) {
                  var transcript = event.results[i][0].transcript;
                  if (event.results[i].isFinal) {
                      finalTranscripts += transcript.replace('.', ''); // Remove periods
                  } else {
                      interimTranscripts += transcript;
                  }
              }
              console.log(finalTranscripts);
              result.setAttribute("value", `${finalTranscripts + interimTranscripts}`);
          };
          speechRecognizer.onend = function() {
              recognizing = false;
              searchInputValue = finalTranscripts
              fetchData(finalTranscripts, selectedYears, sortby).then((totalItems) => {
                // Do something with totalItems
                generatePagination(totalItems)});
          };
          speechRecognizer.onerror = function(event) {
              // Handle error if needed
          };
      } else {
          result.innerHTML =
              'Your browser is not supported. Please download Google Chrome or update your Google Chrome!';
      }
  }
  console.log(totalItems,"total")

  function generatePagination(totalItems) {
    const totalPages = Math.ceil(totalItems / 10); // Assuming 10 items per page
    const paginationContainer = document.getElementById('pagination-container');

    // Clear existing content
    paginationContainer.innerHTML = '';

    for (let i = 0; i < totalPages; i++) {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item');

        const pageLink = document.createElement('a');
        pageLink.classList.add('page-link');
        pageLink.href = "javascript:void(0);";
        pageLink.textContent = i + 1;

        // Add click event to the dynamically created page link
        pageLink.addEventListener('click', function () {
        changePage(i);
        });

        pageItem.appendChild(pageLink);
        paginationContainer.appendChild(pageItem);
    }
  }

function navigateToArticle(articleId){
  window.location.href = `../PHP/article-details.php?articleId=${articleId}`;
}

async function fetchData(input,dates,sort,currentPage=0) {
  try {
    const response = await fetch(`https://web-production-cecc.up.railway.app/api/articles/?sort=${sort}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        "journal":"",
        "dates": dates,
        "input": typeof input == "string" ? input: ""
        
        
      })
    });

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

    console.log('API Response:', data);
    console.log(dates)
    // Assuming 'data.recommendations' is an array
    const articlesContainer = document.querySelector('#articles');
    articlesContainer.innerHTML = '';
    const total = document.querySelector('#total');
    total.innerHTML = '';
    let noOfItems = 10
    console.log(currentPage,"current")
    console.log((currentPage * noOfItems),( noOfItems * (currentPage+1)),"hello")
    data.results.slice((currentPage * noOfItems),( noOfItems * (currentPage+1))).forEach(item => {
      const articleDiv = document.createElement('div');
      articleDiv.classList.add('articles');
      articleDiv.addEventListener('click', () => navigateToArticle(item.article_id));
      const keywordsArray = item.keyword.split(',');

      let keywordsHTML = '';
      for (const keyword of keywordsArray) {
        keywordsHTML += `<span class="keyword">${keyword.trim()}</span>`;
      }
      let contributorsHTML = "";
      if (item.contributors != null) {
        contributorsHTML = "By "
        for (const contributors of item.contributors.split(",")) {
          contributorsHTML += `<a href="https://orcid.org/${contributors.split("->")[1]}">${contributors.split("->")[0]}</a> | `;
        }
      }
      articleDiv.innerHTML = `
        <div class="article-details">
        <h6 style="color: #0858a4;"><strong>${item.title} - (${item.publication_date})</strong></h6>
        <p style="color: #454545;">${item.abstract.slice(0,200)} </p>
        <div class="keywords">
        ${keywordsHTML}
        </div>
        ${item.article_contains[0]!=""? `Terms found:  ${item.article_contains.join(', ')}`: ""}
    </div>
    <div class="article-stats">
        <div class="stats-container">
            <div class="view-download">
                <p class="stats-value" style="color: #0858a4;">${item.total_reads}</p>
                <p class="stats-label" style="color: #959595;">VIEWS</p>
            </div>
            <div class="view-download">
                <p class="stats-value" style="color: #0858a4;">${item.total_downloads}</p>
                <p class="stats-label" style="color: #959595;">DOWNLOADS</p>
            </div>
            <div class="view-download">
            <p class="stats-value" style="color: #0858a4;">${item.total_citations}</p>
            <p class="stats-label" style="color: #959595;">CITATIONS</p>
        </div>
        </div>
        <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
        <div class="published-info">
            <h6 class="publish-label" style="color: #0858a4;"><strong>Published in The ${item.journal}</strong></h6>
            <p class="authors" style="color: #959595;">${contributorsHTML}</p>
            
        </div>
    </div>
      `;

      articlesContainer.appendChild(articleDiv);
    });

    total.innerHTML = `${data.total} searched articles`
totalItems=data.total
        return totalItems

  } catch (error) {
    console.error('Error fetching data:', error);
  }
}
