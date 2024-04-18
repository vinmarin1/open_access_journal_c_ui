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
  const journalsRefineContainer = document.getElementById("journals-refine-container")
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
    
    journalItem.appendChild(journalCheckbox);
    journalItem.appendChild(labelText);
    journalItem.appendChild(labelButton)

    journalCheckbox.addEventListener("change", () => {
      updateSelectedJournals(journalCheckbox, journalCheckbox.value,labelText.textContent)
      updateURL(selectedJournals)
      fetchData(searchInput.value, selectedYears, sortBySelected)
      initializeCheckboxes()
      }
    );

    journalsContainer.appendChild(journalItem);
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
    
    journalItem.appendChild(journalCheckbox);
    journalItem.appendChild(labelText);

    journalCheckbox.addEventListener("change", () => {
      updateSelectedJournals(journalCheckbox, journalCheckbox.value,labelText.textContent)
      updateURL(selectedJournals)
      fetchData(searchInput.value, selectedYears, sortBySelected)
      initializeCheckboxes()
      }
    );

    journalsRefineContainer.appendChild(journalItem);
  }
  initializeCheckboxes()
  
}