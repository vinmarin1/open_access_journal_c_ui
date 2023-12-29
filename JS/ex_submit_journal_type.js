document.getElementById('check-duplication').addEventListener('click', async function(event) {
   

    const abstract = document.getElementById('abstract').value;

  
    const response = await fetch('http://127.0.0.1:5000/api/check/journal', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
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



