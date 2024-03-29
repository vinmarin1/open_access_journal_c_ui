document.addEventListener('DOMContentLoaded', sessionId!=0 ? fetchData: null);
function navigateToArticle(articleId){
  window.location.href = `../PHP/article-details.php?articleId=${articleId}`;
}
async function fetchData() {
  try {
    const response = await fetch(`https://web-production-cecc.up.railway.app/api/recommendations/${sessionId? sessionId : 0}`, { //convert-6-to-session-id
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

    console.log('API Response:', data);

    const articlesContainer = document.querySelector('#recommendations');
    const historyContainer = document.querySelector('#history');
    if (data.recommendations && data.recommendations.length > 0) {
      data.recommendations.forEach(item => {
        const articleDiv = document.createElement('div');
        articleDiv.classList.add('article');
        articleDiv.addEventListener('click', () => navigateToArticle(item.article_id));
        articleDiv.innerHTML = `
          <p class="h6" id="title">${item.title}</p>
          <div class="article-info">
            <p class="info" id="category">${item.journal || 'No Journal'}</p>
          </div>
          <p class="article-content" id="abstract">${item.abstract.slice(0,120)}...</p>
          <button class="btn btn-primary btn-md btn-article" style="border: 2px var(--main, #0858A4) solid; background-color: transparent; border-radius: 20px; color: var(--main, #0858A4); width: 100%;">Read Article</button>
        `;
  
        articlesContainer.appendChild(articleDiv);
      })
    } else {
      const articlesContainer = document.querySelector('#recommendations');
      articlesContainer.classList.remove('articles-container');
      articlesContainer.style.padding = '1em 8%'; 
      articlesContainer.innerHTML = `
        <p class="w-100" id="title">
          <span style="color:var(--main, #0858A4); font-size:20px;">QCUJ has recently launched a new recommendation system </span> 
          aimed at simplifying personalized content discovery for its users.This system, developed by QCUJ's dedicated team, utilizes user interaction history to provide tailored recommendations
        </p>
        <p>Explore more articles to enhance your recommendations further!</p>
        <button id="browse-btn" class="btn btn-primary btn-md btn-article" style="border: 2px var(--main, #0858A4) solid; background-color: transparent; border-radius: 20px; color: var(--main, #0858A4); width: 16em;">Read Articles</button>
      `;
      articlesContainer.addEventListener('click', () => window.location.href = `../PHP/browse-articles.php`);
    }

    data.history.splice(0,2).forEach(item => {
      const articleDiv = document.createElement('div');
      articleDiv.addEventListener('click', () => navigateToArticle(item.article_id));
      articleDiv.innerHTML = `
      <h6>${item.title}</h6>
      <p>${item.abstract.slice(0,80)}</p>
      <button class="btn btn-outline-light btn-md">Try it Now</button>
      `;

      historyContainer.appendChild(articleDiv);
    });
  

  } catch (error) {
    console.error('Error fetching data:', error);
 
  }
}
