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
    const subjectAreasHtml = journalDetails.subject_areas.split(",").map((item) => `<li>${item}</li>`).join('');
    // const journalName = document.querySelector("#journal_name")
    const journalTitle = document.querySelector("#journal_title")
    const journalDescription = document.querySelector("#journal_details")
    const journalSubject = document.querySelector("#journal_subject")
    journalDescription.innerHTML=""

    // journalName.innerHTML = journalDetails.journal
    journalTitle.innerHTML = journalDetails.journal_title
    journalDescription.innerHTML = journalDetails.description.slice(0,300) +"..."
              
    journalSubject.innerHTML =  `<a href="./browse-articles.php?journal=${journalDetails.journal_id}">View Published Articles</a><br/><br/> <h5>Subject Areas</h5><ul>` + subjectAreasHtml+"</ul>"
    
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
    if (Object.keys(issuesPerYear).length === 0) {
      issuesPerYearContainer.innerHTML ="No issues"
     }else{
    renderIssues(issuesPerYear)
     
     }
}
function renderIssuesContent(issues) {
    return issues.map(issue => `
    <div class="issue" onclick="window.location.href='all-issues.php?issue=${issue.issues_id}'" >
        <img src='../Files/cover-image/${issue.cover_image}' alt="Journal">
        <p style="color: #285581;" class="my-2 small">${issue.title}<br><button class="btn btn-outline-primary">View Issue</button></p>
    </div>
`).join('');
   
}

function renderIssues(data) {
    const issuesPerYearContainer = document.querySelector('#issues-per-year-container')

    issuesPerYearContainer.innerHTML = Object.entries(data).map(([year, issues], index) => `
        <div class="all-issues">
            <div class="header-title" id="issueYear">${year}</div>
            ${renderIssuesContent(issues)}
        </div>
    `).join('');
    console.log(data, "dataaa");
}
