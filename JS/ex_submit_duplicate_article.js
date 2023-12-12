document.getElementById('check-duplication').addEventListener('click', function() {

    const title = document.getElementById('title').value;
    const abstract = document.getElementById('abstract').value;
    const checkDupicate = document.getElementById('click');
    const labelTitle = document.getElementById('label-title');
    const labelAbstract = document.getElementById('label-abstract');
    const journalType = document.getElementById('journal-type');
    

    fetch('https://web-production-cecc.up.railway.app/article/checker', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            title: title,
            abstract: abstract,
        }),
    })
    .then(response => {
        if (!response.ok) {
            labelTitle.style.display = 'none';
            labelAbstract.style.display = 'none';
            journalType.style.display = 'none';
      
            throw new Error('Network response was not ok');
        }
        journalType.style.display = 'block';
        labelTitle.style.display = 'block';
        labelAbstract.style.display = 'block';
        return response.json();

      
    })
    .then(data => {
      
        document.getElementById('similar-title').innerHTML = data.similar_articles[0].title;
        document.getElementById('similar-abstract').innerHTML = data.similar_articles[0].abstract;
      

    })
    .catch(error => console.error('Error:', error));
});


