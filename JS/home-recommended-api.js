document.addEventListener('DOMContentLoaded', fetchData);
function navigateToArticle(articleId){
  window.location.href = `/open_access_journal_c_ui/PHP/article-details.php?articleId=${articleId}`;
}
async function fetchData() {
  try {
    const response = await fetch(`https://web-production-cecc.up.railway.app/articles/recommendations/${sessionId? sessionId : 0}`, { //convert-6-to-session-id
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

    // Assuming 'data.recommendations' is an array
    const articlesContainer = document.querySelector('#recommendations');
    const historyContainer = document.querySelector('#history');
    

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
        <button class="btn btn-primary btn-md btn-article" style="border: 2px #0858a4 solid; background-color: transparent; border-radius: 20px; color: #0858a4; width: 100%;">Read Article</button>
      `;

      articlesContainer.appendChild(articleDiv);
    });

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
    // You can handle errors or display a message as needed
  }
}
