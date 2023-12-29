document.addEventListener('DOMContentLoaded', fetchData);
function navigateToArticle(articleId){
  window.location.href = `../PHP/article-details.php?articleId=${articleId}`;
}
async function fetchData() {
  try {
    const response = await fetch('http://127.0.0.1:5000/api/articles/logs/read', { //convert-6-to-session-id
      method: 'POST',
      body: JSON.stringify({
        author_id: '6',
        article_id: parseInt(articleId)
      }),
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
    

    data.recommendations.forEach(item => {
      const articleDiv = document.createElement('div');
      articleDiv.classList.add('article');
      articleDiv.addEventListener('click', () => navigateToArticle(item.article_id));
      articleDiv.innerHTML = `
        <p class="h6" id="title">${item.title}</p>
        <div class="article-info">
          <p class="info" id="category">${item.journal || 'No Journal'}</p>
          <span class="views" id="views">${item.total_reads} Views</span>
        </div>
        <p class="author" id="author">${item.author}</p>
        <p class="article-content" id="abstract">${item.abstract.slice(0,200)}</p>
        <button class="btn btn-primary btn-md btn-article" style="border: 2px #0858a4 solid; background-color: transparent; border-radius: 20px; color: #0858a4; width: 100%;">Read Article</button>
      `;

      articlesContainer.appendChild(articleDiv);
    });

  } catch (error) {
    console.error('Error fetching data:', error);
    // You can handle errors or display a message as needed
  }
}
