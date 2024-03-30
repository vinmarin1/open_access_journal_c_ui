
let selectedJournals = [];
let selectedJournalsName = [];

document.addEventListener( "DOMContentLoaded",
  fetchData().then(() => {
  
    generateFilters();
    // previewFilters();
    // generateDatalist(articleData);
  })
);

let totalItems = 0;
const selectedYears = [];

const sortBySelect = document.querySelector("select");
let sortBySelected = "total_interactions";

// function to update url based on selected journal
function updateURL(selectedJournals){
  let url = new URL(window.location.href);
  url.searchParams.set('journal', selectedJournals); 
  history.replaceState(null, '', url.toString());
}
function updateSearchURL(searchInput){
  let url = new URL(window.location.href);
  url.searchParams.set('search', searchInput); 
  history.replaceState(null, '', url.toString());
}
// Function to initialize checkboxes based on URL query parameter
const initializeCheckboxes = () => {
  const urlParams = new URLSearchParams(window.location.search);
  const selectedJournalsParam = urlParams.get("journal");
  if (selectedJournalsParam) {
    const selectedJournalsArray = selectedJournalsParam.split(",");
    selectedJournalsArray.forEach((journalId) => {
      const checkbox = document.querySelector(`input[value='${journalId}']`);
      if (checkbox) {
        checkbox.checked = true;
      }
    });
  }
};

// handle search element event submit with sorting change
document.getElementById("search-form").addEventListener("submit", function (event) {
    event.preventDefault();
    let searchInputValue = document.getElementById("result").value;
    updateURL(selectedJournals)
    updateSearchURL(searchInputValue)
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
    updateSearchURL(searchInputValue)
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

const updateSelectedJournals = (checkbox, journal,journalName) => {
  if (checkbox.checked) {
    if (!selectedJournals.includes(journal)) {
      selectedJournals.push(journal);
      selectedJournalsName.push(journalName)
    }
  } else {
    const index = selectedJournals.indexOf(journal);
    if (index !== -1) {
      selectedJournals.splice(index, 1);
      selectedJournalsName.splice(index, 1);
    }
  }
};

function navigateToArticle(articleId) {
  window.location.href = `../PHP/article-details.php?articleId=${articleId}`;
}

