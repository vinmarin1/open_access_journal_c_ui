document.getElementById('check-duplication').addEventListener('click', async function(event) {
   
    const title = document.getElementById('title').value;
    const abstract = document.getElementById('abstract').value;

  
    const response = await fetch('https://web-production-cecc.up.railway.app/api/check/journal', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            title: title,
            abstract: abstract
        }),
    });


    const data = await response.json();

   
    const journalType = data.journal_classification;
    const dropdown = document.getElementById('journal-type');

   
    for (let i = 0; i < dropdown.options.length; i++) {
        if (dropdown.options[i].value === journalType) {
            dropdown.options[i].selected = true;
            break;
        }
    }
});



