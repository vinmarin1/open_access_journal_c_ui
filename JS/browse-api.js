document.addEventListener('DOMContentLoaded', fetchData);


function navigateToArticle(articleId){
  window.location.href = `../PHP/article-details.php?articleId=${articleId}`;
}

async function fetchData(input,dates,sort) {
  try {
    const response = await fetch(`https://web-production-cecc.up.railway.app/api/articles/?sort=${sort}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        "journal":"",
        "dates": dates,
        "input": typeof input == "string" ? input: ""
        
        
      })
    });

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

    console.log('API Response:', data);
    console.log(dates)
    // Assuming 'data.recommendations' is an array
    const articlesContainer = document.querySelector('#articles');
    articlesContainer.innerHTML = '';
    const total = document.querySelector('#total');
    total.innerHTML = '';
    data.results.splice(0,10).forEach(item => {
      const articleDiv = document.createElement('div');
      articleDiv.classList.add('articles');
      articleDiv.addEventListener('click', () => navigateToArticle(item.article_id));
      const keywordsArray = item.keyword.split(',');

      let keywordsHTML = '';
      for (const keyword of keywordsArray) {
        keywordsHTML += `<span class="keyword">${keyword.trim()}</span>`;
      }
      
      articleDiv.innerHTML = `
        <div class="article-details">
        <h6 style="color: #0858a4;"><strong>${item.title} - (${item.publication_date})</strong></h6>
        <p style="color: #454545;">${item.abstract.slice(0,200)} </p>
        <div class="keywords">
        ${keywordsHTML}
        </div>
        ${item.article_contains[0]!=""? `Terms found:  ${item.article_contains.join(', ')}`: ""}
    </div>
    <div class="article-stats">
        <div class="stats-container">
            <div class="view-download">
                <p class="stats-value" style="color: #0858a4;">${item.total_reads}</p>
                <p class="stats-label" style="color: #959595;">VIEWS</p>
            </div>
            <div class="view-download">
                <p class="stats-value" style="color: #0858a4;">${item.total_downloads}</p>
                <p class="stats-label" style="color: #959595;">DOWNLOADS</p>
            </div>
            <div class="view-download">
            <p class="stats-value" style="color: #0858a4;">${item.total_citations}</p>
            <p class="stats-label" style="color: #959595;">CITATIONS</p>
        </div>
        </div>
        <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
        <div class="published-info">
            <h6 class="publish-label" style="color: #0858a4;"><strong>Published in The ${item.journal}</strong></h6>
            <p class="authors" style="color: #959595;">${item.author}</p>
            
        </div>
    </div>
      `;

      articlesContainer.appendChild(articleDiv);
    });

    total.innerHTML = `${data.total} searched articles`

        

  } catch (error) {
    console.error('Error fetching data:', error);
    // You can handle errors or display a message as needed
  }
}
