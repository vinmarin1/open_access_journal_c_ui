document.addEventListener('DOMContentLoaded', fetchArticleDetails);

function getQueryParam(name) {
  const urlSearchParams = new URLSearchParams(window.location.search);
  return urlSearchParams.get(name);
}

const articleId = getQueryParam('articleId');


async function fetchArticleDetails() {
  try {
    const response = await fetch('https://web-production-89c0.up.railway.app/articles/logs/read', {
      method: 'POST',
      body: JSON.stringify({
        author_id: sessionId? sessionId : null,
        article_id: parseInt(articleId)
      }),
      headers: {
        'Content-Type': 'application/json'
      }
    });
    const data = await response.json();
    renderArticleDetails(data.selected_article);
    renderRecommended(data.recommendations);
    
  } catch (error) {
    console.error('Error fetching data:', error);
  }
}
function renderArticleDetails(data) {
  const articleContainer = document.getElementById('article_details');
  data.forEach(item => {
    const articleElement = document.createElement('div');
    
    articleElement.classList.add('article-details-body');
    const keywordsArray = item.keyword.split(',');

    let keywordsHTML = '';
    for (const keyword of keywordsArray) {
      keywordsHTML += `<a href="">${keyword.trim()}</a>`;
    }
    articleElement.innerHTML = 
    `
      <div class="content-over">
        <div class="article-title">
            <p>${item.journal}</p>
            <h3>${item.title}</h3>
            <div class="after-title">
                <div class="authors">
                    <p style= "font-size: small; color: gray" >Author/s</p>
                    <p>${item.author}</p>
                </div>
                <div class="volume">
                    <p style= "font-size: small; color: gray" >Journal Issue and Volume</p>
                    <p>Volume 1</p>
                </div>
            </div>
        </div>
      </div>

      <div class="container-fluid">
      <div class="row gap-4">
          <div class="abstract col-sm-7">
              <h4>Abstract</h4>
              <button class="btn tbn-primary btn-md" id="btn1">Read Full Articles</button>
              <button class="btn tbn-primary btn-md" id="download-btn">Download PDF</button>
              <p>${item.abstract}</p>
          </div>
          
          <div class="col-lg-3 pt-4 pb-4">
              <div class="views-dl">
                  <div class="views">
                      <p style="font-size:large;" >${item.total_reads}</p>
                      <p style="font-size:small; margin-left: 5px" >VIEWS</p>
                  </div>
                  <div class="downloads">
                      <p style="font-size:large; text-align: center;">${item.total_downloads}</p>
                      <p style="font-size:small; margin-left: 5px" >DOWNLOADS</p>
                  </div>
              </div>

              <hr style="height: 2px; background-color: #115272; width: 80%">

              <div class="article-pub">
                  <h4>Published in the Gavel</h4>
                  <p style="margin-top: 20px; color: black">ISSN(Online)</p>
                  <p>2071-1050(Online)</p>
                  <p style="margin-top: 20px; color: black ">Date Published</p>
                  <p>${item.date}</p>
                  <p style="margin-top: 20px; margin-bottom: 10px; color: black ">keywords</p>
                  <div class="keyword1">
                  ${keywordsHTML}
                  </div>
                
              </div>
          </div>
          </div>
      </div>
    `;
    const downloadBtn = articleElement.querySelector(`#download-btn`);
    if (downloadBtn) {
      downloadBtn.addEventListener('click', () => {
        downloadFile(item.file_name);
        handleDownloadLog(item.article_id);
      });
    }
    articleContainer.appendChild(articleElement);
  });
}

function navigateToArticle(articleId){
  window.location.href = `/open_access_journal_c_ui/PHP/article-details.php?articleId=${articleId}`;
}
async function renderRecommended(data) {
  const articleContainer = document.getElementById('similar-articles');
 
  await data.forEach(article => {
    const articleElement = document.createElement('div');
    articleElement.classList.add('article');

    articleElement.innerHTML = `
      <p class="h6 h-50">${article.title}</p>
      <div class="article-info">
        <p class="info">${article.journal}</p>
        <span class="views">${article.total_reads} views</span>
      </div>
      <p class="author">By ${article.author}</p>
      <p class="article-content h-25 ">${article.abstract.slice(0, 120)}</p>
      <button class="btn btn-primary btn-md btn-article" style="border: 2px #115272 solid; background-color: transparent; border-radius: 20px; color: #115272; width: 100%;">Read Article</button>
    `;
    articleElement.addEventListener('click', () => navigateToArticle(article.article_id));

    articleContainer.appendChild(articleElement);
  });
}

function downloadFile(file){
  window.location.href = `http://monorbeta-001-site1.btempurl.com/journaldata/file/${file}`;
}

async function handleDownloadLog(articleId) {
  await fetch('https://web-production-89c0.up.railway.app/articles/logs/download', {
    method: 'POST',
    body: JSON.stringify({
        author_id: sessionId, //convert-6-to-session-id
        article_id: parseInt(articleId)
    }),
    headers: {
        'Content-Type': 'application/json'
    }})
}
