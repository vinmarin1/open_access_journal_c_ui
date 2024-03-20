function previewFilters(){
  const selectedFiltersContainer= document.querySelector("#selected-filters")
  selectedFiltersContainer.innerHTML=""
  let selectedFilters = selectedJournalsName.concat(selectedYears)
  selectedFilters.forEach(journal => {
    const journalElement = document.createElement("span");
    journalElement.innerHTML =  journal;
    selectedFiltersContainer.appendChild(journalElement);
  });
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

    yearCheckbox.addEventListener("change", () =>{
        updateSelectedYears(yearCheckbox, yearCheckbox.value);
        fetchData(searchInput.value, selectedYears, sortBySelected)
        // previewFilters()
      }
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
    // labelButton.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32"><path fill="none" stroke="var(--main, #0858A4)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 3h7v7m-1.5-5.5L20 12m-3-7H8a3 3 0 0 0-3 3v16a3 3 0 0 0 3 3h16a3 3 0 0 0 3-3v-9"/></svg>`

    // labelButton.addEventListener('click', function() {
    //   const journalId = journals[i].split(" ->")[0];
    //   updateURL([journalId]);
    
    //   // Reset all checkboxes to unchecked
    //   const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    //   checkboxes.forEach(checkbox => {
    //     checkbox.checked = false;
    //   });
    
    //   // Set the specific checkbox to checked
    //   const checkbox = document.getElementById(`journal${journalId}`);
    //     checkbox.checked = true;
    //   selectedJournals=[journalId]
    //   fetchData();
    //   if (selectedJournals.length ==1){
    //     fetchJournal(journalId)
    //   }
    // });
    
    journalItem.appendChild(journalCheckbox);
    journalItem.appendChild(labelText);
    journalItem.appendChild(labelButton)

    journalCheckbox.addEventListener("change", () => {
      updateSelectedJournals(journalCheckbox, journalCheckbox.value,labelText.textContent)
      updateURL(selectedJournals)
      fetchData(searchInput.value, selectedYears, sortBySelected)
      
      // previewFilters()
      
      }
    );

    journalsContainer.appendChild(journalItem);
  }
  initializeCheckboxes()
  // previewFilters()
  
}