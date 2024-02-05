function getQueryParam(name) {
    const urlSearchParams = new URLSearchParams(window.location.search);
    return urlSearchParams.get(name);
}

document.addEventListener("DOMContentLoaded", function() {
    generateIssues();
    fetchAndGenerateJournal();

 
});
async function fetchAndGenerateJournal() {
 
      
    const response = await fetch(
        `https://web-production-cecc.up.railway.app/api/journal/?id= ${getQueryParam("journal_id")}`,
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
    const journalDetails = data.journalDetails

    // const journalName = document.querySelector("#journal_name")
    const journalTitle = document.querySelector("#journal_title")
    const journalDescription = document.querySelector("#journal_details")

    // journalName.innerHTML = journalDetails.journal
    journalTitle.innerHTML = journalDetails.journal_title
    journalDescription.innerHTML = journalDetails.description
}



async function generateIssues() {

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
        <div class="issue" onclick="window.location.href='all-issues.php?issue=${issue.issues_id}'" >
            <img src='../images/volume2-1.jpg' alt="Journal 1">
            <p style="color: #285581;">${issue.title}<br><span style="color: black">${issue.year}</span></p>
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
