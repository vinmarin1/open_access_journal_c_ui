document.getElementById('check-d').addEventListener('click', function() {

    const title = document.getElementById('title').value;
    const abstract = document.getElementById('abstract').value;

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
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
      
        document.getElementById('similar-title').innerHTML = data.similar_articles[0].title;
        document.getElementById('similar-abstract').innerHTML = data.similar_articles[0].abstract;
    })
    .catch(error => console.error('Error:', error));
});