async function fetchJournal(journal) {
    const response = await fetch(
      `https://web-production-cecc.up.railway.app/api/journal/?id=${journal}`,
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
    if(data.journalDetails==null){
      return false
  }else{
    generateJournalPreview(data.journalDetails)
    return true
  }
    
    
  }
  
  // function previewFilters(){
  
  // function to generate frontend of journal preview
  function generateJournalPreview(journal) {
    const journalPreview = document.querySelector(".journal-preview");
  
     journalPreview.classList.add("d-flex")
  
    journalPreview.querySelector("img").src = `../Files/journal-image/${journal.image}`;
    journalPreview.querySelector("h2").innerHTML= journal.journal
    journalPreview.querySelector(".issn").querySelector("span").innerHTML = `2071-1050 (Online)`
    journalPreview.querySelector(".date").querySelector("span").innerHTML =   new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(new Date(journal.date_added))
    journalPreview.querySelector(".info").querySelector("span").innerHTML = journal.description
  }
  