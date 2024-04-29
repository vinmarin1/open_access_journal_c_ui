document.getElementById('check-duplication').addEventListener('click', async function(event) {
    document.getElementById("check-duplication").disabled = true;

    // Hide the text and show the spinner
    document.getElementById("check-text").style.display = "none";
    document.getElementById("check-spinner").style.display = "inline-block";
    document.getElementById("checking-text").style.display = "inline";
     

    const abstract = document.getElementById('abstract').value;
    const title = document.getElementById('title').value;
    const journalInfo = document.getElementById("journal-info");

    const response = await fetch('https://web-production-cecc.up.railway.app/api/check/journal', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            abstract: abstract,
            title: title
        }),
    });
    
    const data = await response.json();
    
    if (response.ok) {
        const journalType = data.journal_classification;
        const dropdown = document.getElementById('journal-type');
        const subjectAreasDropdown = document.getElementById('subject_areas'); // Get subject areas dropdown

        document.getElementById("check-duplication").disabled = false;
        document.getElementById("check-text").style.display = "inline";
        document.getElementById("check-spinner").style.display = "none";
        document.getElementById("checking-text").style.display = "none";
        journalInfo.innerHTML = "A match has been found. You may choose to follow this or select your preferred journal.";
        document.getElementById('journal-error').innerHTML = '';

        for (let i = 0; i < dropdown.options.length; i++) {
            if (dropdown.options[i].value === journalType) {
                dropdown.options[i].selected = true;

                // Trigger change event to update subject areas based on the selected journal type
                const event = new Event('change');
                dropdown.dispatchEvent(event);
                break;
            }
        }
    } else {
        // Handle error here
        console.error('Error:', data.message);
        journalInfo.innerHTML = "";
        document.getElementById('journal-error').innerHTML = data.message;
    }
});

// Add event listener to journal type dropdown for dynamically updating subject areas
document.getElementById('journal-type').addEventListener('change', async function() {
    const selectedJournalId = this.value;
    const subjectAreasDropdown = document.getElementById('subject_areas');

    // Fetch and update subject areas based on the selected journal ID
    const response = await fetch('../PHP/subject_areas.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'journal_id=' + encodeURIComponent(selectedJournalId),
    });

    const data = await response.json();
    if (response.ok) {
        const subjectAreas = data.subjectAreas;
        subjectAreasDropdown.innerHTML = ''; // Clear previous options
        subjectAreas.forEach(function (subject) {
            const option = document.createElement('option');
            option.value = subject;
            option.textContent = subject;
            subjectAreasDropdown.appendChild(option);
        });
    } else {
        alert('Error fetching subject areas.');
    }
});
