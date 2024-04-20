document.addEventListener("DOMContentLoaded", () => {
    fetchJournal();
});
function generateJournals(data) {
    const journalsContainer = document.querySelector("#journals");

    journalsContainer.innerHTML = data.map(journal => {
        const subjectAreasHtml = journal.subject_areas.split(",").map((item) => `<li>${item}</li>`).join('');
        const editorialBoardHTML = journal.editorial.split(";").map((item) => `
            <li><b>${item.split(':')[0]} : </b>${item.split(':')[1]}</li>
        
        `).join('');
        return `
            <div class="container-fluid border rounded p-4" id="journal">
                <div class="col-md-2 me-5 col-12 journal-title">
                    <h5 style="font-size:1.4em">${journal.journal_title}</h5>
                    <div class="pic-border">
                        <img class="img-fluid" src="../Files/journal-image/${journal.image}" alt="" style="height: 260px; width:180px;">
                    </div>
                    <div class="d-flex flex-column py-4">
                        <a href="issues.php?journal_id=${journal.journal_id}">View Issues</a>
                        <a href="./browse-articles.php?journal=${journal.journal_id}">View Published Articles</a>
                    </div>
                </div>

                <div class="col-md-8 col-12 journal-details">
                    <h5>About</h5>
                    <p style="text-align: justify;">${journal.description}</p>

                    <div class="other-info">
                        <div class="sub-area">
                            <h5>Subject Areas</h5>
                            <ul>
                                ${subjectAreasHtml}
                            </ul>
                        </div>
                        <div class="edit-board">
                            <h5>Editorial Board</h5>
                            <ul>
                               ${editorialBoardHTML}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }).join('');
    console.log(journalsContainer, "d");
}
function updateURL(selectedJournals) {
    let url = new URL(window.location.href);
    url.searchParams.set('search', selectedJournals); 
    history.replaceState(null, '', url.toString());
}

document.getElementById("search-form").addEventListener("submit", function (event) {
    event.preventDefault();
    let searchInputValue = document.getElementById("result").value;
    updateURL(searchInputValue);
    fetchJournal(searchInputValue);
});

function getQueryParam(name) {
    const urlSearchParams = new URLSearchParams(window.location.search);
    return urlSearchParams.get(name);
}

async function fetchJournal(searchInputValue) {
    const searchInput = getQueryParam("search");
    const response = await fetch(
      `https://web-production-cecc.up.railway.app/api/journal/?search=${searchInput ? searchInput : ""}`,
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
    generateJournals(data.journal);
}