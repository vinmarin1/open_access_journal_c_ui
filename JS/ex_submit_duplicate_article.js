document.getElementById('check-duplication').addEventListener('click', async function() {
    const title = document.getElementById('title').value;
    const abstract = document.getElementById('abstract').value;
    const labelTitle = document.getElementById('label-title');
    const labelDuplication = document.getElementById('result-duplication');
    const labelResult = document.getElementById('label-result');
    const journalType = document.getElementById('journal-type');
    const nextBtn = document.getElementById('next');
    const similarTitle = document.getElementById('similar-title');
    const similarAbstract = document.getElementById('similar-abstract');
    const flagged = document.getElementById('flagged');
    const flaggedT = document.getElementById('flaggedT');
    const labelDuplicationAb = document.getElementById('result-duplication2');

    labelTitle.style.color = '#0858a4';
    labelResult.style.color = '#0858a4';
    similarTitle.style.color = '#115272';
    nextBtn.disabled= true;
    
    await fetch('https://web-production-cecc.up.railway.app/api/check/duplication', {
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
        return response.json();
    })
    .then(data => {
        if(data.flagged == true && data.similar_articles[0].score.title  < 0.75 && data.similar_articles[0].score.overview <= 0.50) {
            document.getElementById('similar-title').innerHTML = '';
            labelDuplication.style.display = 'none';
            labelDuplicationAb.style.display = 'none';
            Swal.fire({
                html: "<h3 id='article-unique'>Unique Article</h3>",
                icon: "success",
                showConfirmButton: true
            });

            journalType.style.display = 'block';
            labelTitle.style.textAlign = 'left';
            labelResult.style.textAlign = 'left';
            labelResult.style.color = '#0858a4';       
            similarTitle.style.textAlign = 'left';
            similarTitle.style.color = '#0858a4';
            flagged.style.display = 'block';
            flaggedT.classList.remove('text-danger');
            flaggedT.classList.add('text-success');
            
            flaggedT.innerHTML = '(Unique)';

            nextBtn.disabled = false;
        }
        else if (data.flagged == true ){
            document.getElementById('similar-title').innerHTML = data.similar_articles[0].title;
            const titleScore = (data.similar_articles[0].score.title * 100).toFixed(2);
            const overviewScore = (data.similar_articles[0].score.overview * 100).toFixed(2);
            const articleId = data.similar_articles[0].article_id;
            similarTitle.setAttribute('data-article-id', articleId);
            labelDuplication.innerHTML = titleScore + '%';
            labelDuplicationAb.innerHTML = overviewScore + '%';
            labelDuplication.style.display = 'block';
            labelDuplicationAb.style.display = 'block';
            Swal.fire({
                title: "Duplication Alert!",
                icon: "info",
                text: "Revise your Title and Abstract",
                showConfirmButton: true
            });

            journalType.style.display = 'block';
            labelTitle.style.textAlign = 'left';
            labelResult.style.textAlign = 'left';
            labelResult.style.color = '#0858a4';    
            labelDuplication.style.textAlign = 'left';
            labelDuplication.style.color = '##0858a4';
            similarTitle.style.textAlign = 'left';
            similarTitle.style.color = '#0858a4';
            flagged.style.display = 'block';
            flaggedT.classList.add('text-danger');
            flaggedT.classList.remove('text-success');
            flaggedT.innerHTML = '(Duplicate)';
            

            
            if (titleScore >= 75) {
                labelDuplication.classList.add('text-danger');
            } else {
                labelDuplication.classList.remove('text-danger');
            }
            if (overviewScore >= 50) {
                labelDuplicationAb.classList.add('text-danger');
            } else {
                labelDuplicationAb.classList.remove('text-danger');
            }
            nextBtn.disabled = true;

            Swal.fire({
                icon: 'warning',
                text: 'Article already exists or similar content detected'
            });
        }
  
        else{
            document.getElementById('similar-title').innerHTML = '';
            labelDuplication.style.display = 'none';
            labelDuplicationAb.style.display = 'none';
            Swal.fire({
                html: "<h3 id='article-unique'>Unique Article</h3>",
                icon: "success",
                showConfirmButton: true
            });

            journalType.style.display = 'block';
            labelTitle.style.textAlign = 'left';
            labelResult.style.textAlign = 'left';
            labelResult.style.color = '#0858a4';       
            similarTitle.style.textAlign = 'left';
            similarTitle.style.color = '#0858a4';
            flagged.style.display = 'block';
            flaggedT.innerHTML = '(Unique)';
            flaggedT.classList.remove('text-danger');
            flaggedT.classList.add('text-success');

            nextBtn.disabled = false;
        }
        
    })
    .catch(error => console.error('Error:', error));
});

function openArticleDetails() {
    const articleId = document.getElementById('similar-title').getAttribute('data-article-id');
    window.open('article-details.php?articleId=' + articleId, '_blank');
}
