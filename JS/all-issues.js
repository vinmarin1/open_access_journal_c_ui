function getQueryParam(name) {
    const urlSearchParams = new URLSearchParams(window.location.search);
    return urlSearchParams.get(name);
}

document.addEventListener("DOMContentLoaded", function() {
        generateArticlesBasedOnIssues()
        generateIssue();
});

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
}

async function generateArticlesBasedOnIssues() {
    
    const response = await fetch(
        `https://web-production-cecc.up.railway.app/api/articles/`,
        {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              issue: getQueryParam("issue"),
            }),
          }
      );
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
    
    const data = await response.json();
    const articles = data.results

    const articlesByIssue = document.querySelector("#articles-by-issue")

    articlesByIssue.innerHTML = articles.map(article => `
    <!-- Article Container -->
    <div class="article-container">
        <!-- Article Content -->
        <div class="article-content">
            <h6>${article.title} (${
                new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(new Date(article.publication_date))
              })</h6>
            <!--<p class="authors" style="color: #959595;">Author name</p>-->
            <p>${article.abstract.slice(0,150)}...</p>
            <!--<div class="article-tags">
                <span class="tag">technology</span>
                <span class="tag">covid-19</span>
                 More tags 
            </div> -->
        </div>
        <!-- Article Stats -->
        <div class="article-stats">
            <div class="download-buttons">
                <button>Download PDF</button>
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
    </div>`).join('');

    console.log(articlesByIssue,"dd")
}


