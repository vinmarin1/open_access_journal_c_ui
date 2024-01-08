document.addEventListener('DOMContentLoaded', fetchData);


function navigateToArticle(articleId){
  window.location.href = `../PHP/article-details.php?articleId=${articleId}`;
}

const sortSelect = document.querySelector("select");
let sortSelected = "total_interactions"
sortSelect.addEventListener("change", function () {
   sortSelected = sortSelect.value;
   fetchData()

})

async function fetchData() {
  try {
    const response = await fetch('https://web-production-cecc.up.railway.app/api/recommendations/', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        "period": "",
        "category": sortSelected
      })
    });

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

    console.log('API Response:', data);

    // Assuming 'data.recommendations' is an array
    const articlesContainer = document.querySelector('#most-popular');
    articlesContainer.innerHTML=''
    

    data.recommendations.splice(0,5).forEach(item => {
      const articleDiv = document.createElement('div');
      articleDiv.innerHTML = ''
      articleDiv.classList.add('item');
      articleDiv.addEventListener('click', () => navigateToArticle(item.article_id));
      articleDiv.innerHTML = `
        <span class="title w-100">${item.title.slice(0,60)}...</span>
        <ul class="d-flex gap-2">
          <li class="d-flex flex-column"><span class="total">${item.total_downloads}</span>downloads</li>
          <li class="d-flex flex-column"><span class="total">${item.total_reads}</span>views</li>
        </ul>
      `;

      articlesContainer.appendChild(articleDiv);
    });

  } catch (error) {
    console.error('Error fetching data:', error);
    // You can handle errors or display a message as needed
  }
}

