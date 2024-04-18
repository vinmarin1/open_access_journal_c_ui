
let selectedJournals = [];
let selectedJournalsName = [];

document.addEventListener( "DOMContentLoaded",
  fetchData().then(() => {
    generateFilters();
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
function updateExactURL(searchInput){
  let url = new URL(window.location.href);
  url.searchParams.set('exact', searchInput); 
  history.replaceState(null, '', url.toString());
}

// Function to initialize checkboxes based on URL query parameter
const initializeCheckboxes = () => {
  const urlParams = new URLSearchParams(window.location.search);
  const selectedJournalsParam = urlParams.get("journal");
  if (selectedJournalsParam) {
    const selectedJournalsArray = selectedJournalsParam.split(",");
    selectedJournalsArray.forEach((journalId) => {
      const checkboxes = document.querySelectorAll("input[type='checkbox']");
      checkboxes.forEach((checkbox) => {
        const checkboxValues = checkbox.value.split(","); // Split multiple values
        const isChecked = selectedJournalsArray.some((journalId) => checkboxValues.includes(journalId.trim()));
        checkbox.checked = isChecked;
      });
    });
  }
};

document.getElementById('refine_search').addEventListener('click', function(event) {
  event.preventDefault();
  let searchInputValue = document.getElementById("any-words").value;
  let searchExactInputValue = document.getElementById("exact-words").value;
  
  initializeCheckboxes()
  updateURL(selectedJournals)
  updateSearchURL(searchInputValue)
  updateExactURL(searchExactInputValue)
  fetchData(searchInputValue, selectedYears, sortBySelected)
  $('#exampleModalCenter').modal('hide'); 
})
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

