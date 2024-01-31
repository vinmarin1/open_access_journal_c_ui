document.addEventListener("DOMContentLoaded", generateIssues);

async function generateIssues() {
    function getQueryParam(name) {
        const urlSearchParams = new URLSearchParams(window.location.search);
        return urlSearchParams.get(name);
    }
      
    const response = await fetch(
        `https://web-production-cecc.up.railway.app/api/journal/issues?journal_id= ${getQueryParam("journal_id")}`,
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
    const issuesPerYear = data.issuesPerYear
    renderIssues(issuesPerYear)
}
function renderIssuesContent(issues) {
    return issues.map(issue => `
        <div class="issue">
            <img src='../images/volume2-1.jpg' alt="Journal 1">
            <p style="color: #285581;" onclick="window.location.href='all-issues.php'">${issue.title}<br><span style="color: black">${issue.year}</span></p>
        </div>
    `).join('');
}

function renderIssues(data) {
    const issuesPerYearContainer = document.querySelector('#issues-per-year-container')
    issuesPerYearContainer.innerHTML = Object.entries(data).map(([year, issues], index) => `
        <div class="all-issues">
            <div class="header-title" id="issueYear">${year}</div>
            ${renderIssuesContent(issues)}
            <div class="">
                <button class="btn btn-primary btn-md btn-seemore" id="see-more">Show All Articles</button>
            </div>
        </div>
    `).join('');
    console.log(data, "dataaa");
}
