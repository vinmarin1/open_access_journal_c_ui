document.addEventListener('DOMContentLoaded', fetchData);


function navigateToArticle(articleId){
  window.location.href = `../PHP/article-details.php?articleId=${articleId}`;
}

async function fetchData() {
  try {
    const response = await fetch('https://web-production-cecc.up.railway.app/api/recommendations/', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        "period": "",
        "category": "publication_date"
      })
    });
    

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

    console.log('API Response:', data);

    const articlesContainer = document.querySelector('#recently-added');
    

    data.recommendations.splice(0,10).forEach(item => {
      const articleDiv = document.createElement('div');
      articleDiv.classList.add('article');
      articleDiv.addEventListener('click', () => navigateToArticle(item.article_id));
      let contributorsHTML = "";
      if (item.contributors != null) {
        for (const contributors of item.contributors.split(",")) {
          contributorsHTML += `<a href="https://orcid.org/${contributors.split("-")[1]}">${contributors.split("-")[0]}</a>,`;
        }
      }
      articleDiv.innerHTML = `
        <p class="h6" id="title">${item.title}</p>
        <div class="article-info">
          <p class="info" id="category">${item.journal || 'No Journal'}</p>
          <p class="">${new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(new Date(item.publication_date))}</p>
        </div>
        <p class="article-content" id="abstract">${item.abstract.slice(0,180)}...</p>
        <button class="btn btn-primary btn-md btn-article" style="border: 2px var(--main, #0858A4) solid; background-color: transparent; border-radius: 20px; color: var(--main, #0858A4); width: 100%;">Read Article</button>
      `;

      articlesContainer.appendChild(articleDiv);
    });

  } catch (error) {
    console.error('Error fetching data:', error);
  }
}

