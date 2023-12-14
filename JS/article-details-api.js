document.addEventListener('DOMContentLoaded', fetchArticleDetails);

function getQueryParam(name) {
  const urlSearchParams = new URLSearchParams(window.location.search);
  return urlSearchParams.get(name);
}

const articleId = getQueryParam('articleId');


async function fetchArticleDetails() {
  try {
    const response = await fetch('https://web-production-cecc.up.railway.app/articles/logs/read', {
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
              <button class="btn tbn-primary btn-md" id="epub-btn">Download EPUB</button>
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

              <hr style="height: 2px; background-color: #0858a4; width: 80%">

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
    const epubBtn = articleElement.querySelector(`#epub-btn`);
    const viewFullArticle = articleElement.querySelector(`#btn1`);

  
    if(active){
      downloadBtn.style.display = 'inline-block';
      epubBtn.style.display = 'inline-block';

    
    }else{
      downloadBtn.style.display = 'none';

      viewFullArticle.addEventListener('click', () => {
        window.location.href= '../php/login.php'
      });
    }
    if (downloadBtn) {
      downloadBtn.addEventListener('click', () => {
        createCloudConvertJob(item.file_name,'pdf')
        handleDownloadLog(item.article_id);
      });
    }
    if (epubBtn) {
      epubBtn.addEventListener('click', () => {
        // downloadEpub(item.file_name)
        createCloudConvertJob(item.file_name,'epub')
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
      <p class="article-content h-25 ">${article.abstract.slice(0, 80)}</p>
      <button class="btn btn-primary btn-md btn-article" style="border: 2px #0858a4 solid; background-color: transparent; border-radius: 20px; color: #0858a4; width: 100%;">Read Article</button>
    `;
    articleElement.addEventListener('click', () => navigateToArticle(article.article_id));

    articleContainer.appendChild(articleElement);
  });
}

function downloadFile(file){
  window.location.href = `http://monorbeta-001-site1.btempurl.com/journaldata/file/${file}`;
}

async function handleDownloadLog(articleId) {
  await fetch('https://web-production-cecc.up.railway.app/articles/logs/download', {
    method: 'POST',
    body: JSON.stringify({
        author_id: sessionId, //convert-6-to-session-id
        article_id: parseInt(articleId)
    }),
    headers: {
        'Content-Type': 'application/json'
    }})
}
function downloadEpub(file_url) {
  // Assuming the Flask server is running on localhost:5000
  const apiUrl = `http://localhost:5000/epub/${file_url}`;

  // Create a link element
  const link = document.createElement('a');
  link.href = apiUrl;
  link.download = 'Output1.epub';

  // Append the link to the document
  document.body.appendChild(link);

  // Trigger a click event on the link
  link.click();

  // Remove the link from the document
  document.body.removeChild(link);
}


 function createCloudConvertJob(file,format) {

  const apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmQ1NTQ0ZmYwYzE2NTdmNjZhOGExZmQ5YmQ3YjIzODU0YmRiMDhjYjYxNGM1MzE2N2E0NWZmNmJhYzkxYjA2ZGRhYWQ5ZjBiZWFhZmIwOWIiLCJpYXQiOjE3MDEyNDI1MzYuNDg0NDY3LCJuYmYiOjE3MDEyNDI1MzYuNDg0NDY5LCJleHAiOjQ4NTY5MTYxMzYuNDc5ODk1LCJzdWIiOiI2NjI5Njk0NCIsInNjb3BlcyI6WyJ1c2VyLnJlYWQiLCJ1c2VyLndyaXRlIiwidGFzay5yZWFkIiwidGFzay53cml0ZSIsInByZXNldC5yZWFkIiwicHJlc2V0LndyaXRlIiwid2ViaG9vay5yZWFkIiwid2ViaG9vay53cml0ZSJdfQ.BoMmx1_yaPK38lstapuVDFcp474cbqOhwVDIikM7a8H1e8R0I1isn4UZYiON6OGG0ckBSEm-mJbQ0wNaAHjfcpG378098a6uw2YfyJVVgkZP9lr5k2gOCCJXRq3eP5trwXAr9kdkxGZrfn7d9SWr9xF_wFGgd3x5nLjZuLlmjYDAOPx62BVLaDUSQkOg77CeyXFQIR91GuhwdanJF19ASGbWLGypZ1n4RtwIwfChRyNBbOSFo0RsKYzZzaF2v0QyfBGtmRmQJWB6GyC-VXl_DEdld5WnOCt5xPkreE9XKUthI0WgpbId98yCEcx3ZF4T7hRDylLrXJi_c_F-xz85s8MfPpx9_27X1xF7e4cMqUkeeQTANh4fzMSibSx8vZV6sC5Py3fsfj_gQ2D3gG-UqEo2srHS5xhetCW39TqRtgThvwpICHoRV-Q3GZx73BUqgLz0-HlEp7-ZuLZKoJIq6-2HnYZeWtAPuX08dvwWWoCR5E8NvMlZ3vBby8YHuN7pMYpm_LOuebgUyJW-5Ok9yfKy_4wNyq_yadYktpZlfPQ2-QrRucQ6gbkMxyKswqBgwt5D3NL6wWPLu2hnCkprg1SqC459xY4LcPWSRZDUf_S9nqlHbIOrS7vkTYRtkeA81ZpbrkI_v9NU6LjDZfd2k_G13WywEiIUo_wi9cPlpxs';

  // Define the CloudConvert API endpoint
  const apiUrl = 'https://api.cloudconvert.com/v2/jobs';

  // Define the JSON data for creating a job
  const jsonData = {
      "tasks": {
          "import-1": {
              "operation": "import/url",
              "url": `http://monorbeta-001-site1.btempurl.com/journaldata/file/${file}`,
              "filename": file
          },
          "task-1": {
              "operation": "convert",
              "input_format": "docx",
              "output_format": format,
              "engine": "calibre",
              "input": [
                  "import-1"
              ]
          },
          "export-1": {
              "operation": "export/url",
              "input": [
                  "task-1"
              ],
              "inline": true,
              "archive_multiple_files": true
          }
      },
      "tag": "jobbuilder"
  }

  fetch(apiUrl, {
    method: 'POST',
    body: JSON.stringify(jsonData),
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${apiKey}`
    }
  })
    .then(response => response.json())
    .then(data => {
      // Use the job ID to construct the download URL
      const downloadUrl = `https://sync.api.cloudconvert.com/v2/jobs/${data.data.id}?redirect=true`;

      // Perform the second fetch to get the file content
      fetch(downloadUrl, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${apiKey}`
        }
      })
        .then(response => {
          // Trigger the download when the second fetch is done
          response.blob().then(blob => {
            console.log(window.URL.createObjectURL(blob))
            const url = window.URL.createObjectURL(blob);
          
            const link = document.createElement('a');
            link.href = url;
            link.download = `filename.${format}`; // Set the desired filename
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            

            // // Create an iframe element
            // const iframe = document.createElement('iframe');
            // iframe.style.width = '100%';
            // iframe.style.height = '600px'; // Set the desired height

            // // Set the iframe source to the data URL of the fetched content
            // iframe.src = url;

            // // Append the iframe to the document
            // document.body.appendChild(iframe);
          });
        })
        .catch(error => {
          console.error('Error fetching file content:', error);
        });
    })
    .catch(error => {
      console.error('Error creating job:', error);
    });
}