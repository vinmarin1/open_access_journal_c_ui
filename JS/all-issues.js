function getQueryParam(name) {
    const urlSearchParams = new URLSearchParams(window.location.search);
    return urlSearchParams.get(name);
}

document.addEventListener("DOMContentLoaded", function() {
    generateArticlesBasedOnIssues(currentPage); 
    generateIssue();
});
let currentPage=1

async function generateIssue() {
    const response = await fetch(
        `https://web-production-cecc.up.railway.app/api/journal/issues/${getQueryParam("issue")}`,
        {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
            }
          }
      );
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
    
    const data = await response.json();
    const issue = data

    document.querySelector("#issue-title").innerHTML = issue.title
    document.querySelector("#issue-issn").innerHTML = issue.issn
    document.querySelector("#issue-date").innerHTML = issue.date_added
    document.querySelector("#issue-journal").innerHTML = issue.journal
    document.querySelector(img).src= `../Files/cover-image/${issue.cover_image}`
}

async function generateArticlesBasedOnIssues(page) {
    
    const response = await fetch(
        `https://web-production-cecc.up.railway.app/api/journal/issues/articles?issue=${getQueryParam("issue")}&page=${page}`,
        {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
            }
           
          }
      );
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
    
    const data = await response.json();
    const articles = data
    const articlesByIssue = document.querySelector("#articles-by-issue")
    articlesByIssue.innerHTML=""
    articlesByIssue.innerHTML = articles.map((article, index) => `
    <!-- Article Container -->
    <a class="article-container" href="../PHP/article-details.php?articleId=${article.article_id}">
        <!-- Article Content -->
        <div class="article-content">
            <h6>${article.title} </h6>
            <p>${article.abstract.slice(0, 150)}...</p>
        </div>
        <!-- Article Stats -->
        <div class="article-stats">
            <div class="download-buttons">
                <button class="download-pdf-button" data-article-index="${article.article_id}" data-article-file="${article.file_name}">Download PDF</button>
            </div>
            <hr>
            <div class="stats-container">
                <div class="view-download">
                    <p class="stats-value" style="color: #0858a4;">${article.total_reads}</p>
                    <p class="stats-label" style="color: #959595;">VIEWS</p>
                </div>
                <div class="view-download">
                    <p class="stats-value" style="color: #0858a4;">${article.total_downloads}</p>
                    <p class="stats-label" style="color: #959595;">DOWNLOADS</p>
                </div>
                <div class="view-download">
                    <p class="stats-value" style="color: #0858a4;">${article.total_citations}</p>
                    <p class="stats-label" style="color: #959595;">CITATIONS</p>
                </div>
            </div>
            <br>
            <div class="download-buttons">
                <!--<button><i class="ri-double-quotes-r"></i>Citations</button>
                <button><i class="ri-share-fill"></i>Share</button>
                <button><i class="ri-heart-fill"></i>Heart</button> -->
            </div>
        </div>
    </a>`
).join('');

// Add event listeners to download buttons
document.querySelectorAll('.download-pdf-button').forEach(button => {
    button.addEventListener('click', event => {
        event.preventDefault(); 
        const articleIndex = event.target.dataset.articleIndex;
        const fileName = event.target.dataset.articleFile;
        handleDownloadLog(articleIndex,"download");
        createCloudConvertJob(fileName, "pdf");
    });
});




}
document.getElementById('previous-page').addEventListener("click", function() {
    changePage("previous");
});

document.getElementById('next-page').addEventListener("click", function() {
    changePage("next");
});

function changePage(page) {
    if (page === 'next') {
        currentPage += 1; // Increment currentPage for next page
    } else if (page === 'previous') {
        if (currentPage > 1) {
            currentPage -= 1; // Decrement currentPage for previous page if currentPage is greater than 1
        } else {
            return; // If currentPage is 1, do not go to previous page
        }
    }
    
    generateArticlesBasedOnIssues(currentPage); // Call your function to generate articles based on the currentPage
}