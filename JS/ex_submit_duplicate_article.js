document.getElementById('check-duplication').addEventListener('click', function() {
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

    fetch('https://web-production-cecc.up.railway.app/api/check/duplication', {
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
        if (data.similar_articles.length > 0) {
            if(data.similar_articles[0].score.overview >= 1.0 || data.similar_articles[0].score.title >= 1.0){
                document.getElementById('similar-title').innerHTML = data.similar_articles[0].title;
                const articleId = data.similar_articles[0].article_id;
                similarTitle.setAttribute('data-article-id', articleId);
                labelDuplication.innerHTML = 'Title: ' + (data.similar_articles[0].score.title * 100).toFixed(2) + '%';
                labelDuplicationAb.innerHTML = 'Abstract: ' + (data.similar_articles[0].score.overview * 100).toFixed(2) + '%';

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
                flaggedT.innerHTML = 'Flagged as: Duplicate';

                nextBtn.disabled = true;

                Swal.fire({
                    icon: 'warning',
                    text: 'Duplicated title and abstract detected!'
                });
            } else if(data.highest_simlarity >= 0.4 && data.highest_simlarity < 1.0){
                document.getElementById('similar-title').innerHTML = data.similar_articles[0].title;
                const articleId = data.similar_articles[0].article_id;
                similarTitle.setAttribute('data-article-id', articleId);
                labelDuplication.innerHTML = 'Title: ' + (data.similar_articles[0].score.title * 100).toFixed(2) + '%';
                labelDuplicationAb.innerHTML = 'Abstract: ' + (data.similar_articles[0].score.overview * 100).toFixed(2) + '%';
                Swal.fire({
                    title: "Duplication Alert!",
                    icon: "info",
                    text: "Revise your title or Abstract",
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
                flaggedT.innerHTML = 'Flagged as: Duplicate';

                nextBtn.disabled = true;

                Swal.fire({
                    icon: 'warning',
                    text: 'Duplicated title and abstract detected!'
                });
            } else if(data.highest_simlarity <= 0.31){
                document.getElementById('similar-title').innerHTML = '';
                labelDuplication.innerHTML = 'Title: ' + (data.similar_articles[0].score.title * 100).toFixed(2) + '%';
                labelDuplicationAb.innerHTML = 'Abstract: ' + (data.similar_articles[0].score.overview * 100).toFixed(2) + '%';
                Swal.fire({
                    html: "<h3 id='article-unique'>Good Article</h3>",
                    icon: "success",
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
                flaggedT.innerHTML = 'Flagged as: Duplicate';

                nextBtn.disabled = false;
            }
        } else {
            if(data.similar_articles.length === 0){
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
                flaggedT.innerHTML = 'Flagged as: Unique';

                nextBtn.disabled = false;
            }
        }
    })
    .catch(error => console.error('Error:', error));
});

function openArticleDetails() {
    const articleId = document.getElementById('similar-title').getAttribute('data-article-id');
    window.open('article-details.php?articleId=' + articleId, '_blank');
}
