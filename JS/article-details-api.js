document.addEventListener("DOMContentLoaded", fetchArticleDetails);

function getQueryParam(name) {
  const urlSearchParams = new URLSearchParams(window.location.search);
  return urlSearchParams.get(name);
}

const articleId = getQueryParam("articleId");

async function fetchArticleDetails() {
  try {
    const response = await fetch(
      "https://web-production-cecc.up.railway.app/api/articles/logs/read",
      {
        method: "POST",
        body: JSON.stringify({
          author_id: sessionId ? sessionId : null,
          article_id: parseInt(articleId),
        }),
        headers: {
          "Content-Type": "application/json",
        },
      }
    );
    const data = await response.json();
    renderArticleDetails(data.selected_article);
    renderRecommended(data.recommendations);
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}

function renderArticleDetails(data) {
  const articleContainer = document.getElementById("article_details");
  data.forEach((item) => {
    const articleElement = document.createElement("div");
    const citationContent = document.getElementById("citation-content");

    articleElement.classList.add("article-details-body");
    const keywordsArray = item.keyword.split(",");

    let keywordsHTML = "";
    for (const keyword of keywordsArray) {
      keywordsHTML += `<a>${keyword.trim()}</a>`;
    }

    let contributorsHTML = "";
    if (item.contributors != null) {
      for (const contributors of item.contributors.split(";")) {
        contributorsHTML += `
        <div id="popup-link" class="d-flex">
          <a href="#">${contributors.split("->")[0]} </a>
          <div class="popup-form">
            <div class="container-fluid">
              <div class="row">
                <!-- <div class="col-md-2">
                  <img src="../images/profile.jpg" alt="Profile Picture" class="profile-pic">
                </div> -->
                <div class="col-md-10 col-12 prof-info">
                  <!-- Content for the second column -->
                  <p class="!font-bold">${contributors.split("->")[0]}</p>
                  <span class="text-xs">${contributors.split("->")[2]}</span>
                </div>
              </div>
           
              ${contributors.split("->")[2].includes("Primary Contact") ? `<a class="btn btn-primary btn-md" id="seeMore-btn" href="mailto:${contributors.split("->")[3]}">Contact</a>` : ''}
                <a class="btn btn-primary btn-md" id="seeMore-btn" href="./user-view.php?orcid=${contributors.split("->")[1]}">View Profile</a>
                <a href="https://orcid.org/${contributors.split("->")[1]}">
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 512 512">
                	<path fill="#a7cf36" d="M294.75 188.19h-45.92V342h47.47c67.62 0 83.12-51.34 83.12-76.91c0-41.64-26.54-76.9-84.67-76.9M256 8C119 8 8 119 8 256s111 248 248 248s248-111 248-248S393 8 256 8m-80.79 360.76h-29.84v-207.5h29.84zm-14.92-231.14a19.57 19.57 0 1 1 19.57-19.57a19.64 19.64 0 0 1-19.57 19.57M300 369h-81V161.26h80.6c76.73 0 110.44 54.83 110.44 103.85C410 318.39 368.38 369 300 369" />
                </svg>
                </a>
            </div>

          </div>
        </div>
       `;
      }
    }


    articleElement.innerHTML = `
    
      <div class="content-over">
        <div class="article-title">
            <p>${item.journal}</p>
            <h3>${item.title}</h3>
            <div class="after-title">
                <div class="authors" >
                    <p style= "font-size: small; color: gray" >Author/s</p>
                    <div class="d-flex gap-1">${contributorsHTML}</div>
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
      
          <div class="col-md-1">
              <!-- This is a Blank space -->
          </div>

          <div class="abstract col-sm-7">
              <h4>Abstract</h4>
              <button class="btn btn-md" id="read-btn">Read Full Article</button>
              <button class="btn tbn-primary btn-md" id="download-btn">Download PDF <span class="d-none" id="downloadLoading"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
              <path fill="none" stroke="#0880E8" stroke-dasharray="15" stroke-dashoffset="15" stroke-linecap="round" stroke-width="2" d="M12 3C16.9706 3 21 7.02944 21 12">
                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.3s" values="15;0" />
                <animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12" />
              </path>
            </svg></span></button>
              <button class="btn tbn-primary btn-md" id="epub-btn">Download EPUB <span class="d-none" id="epubLoading"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
              <path fill="none" stroke="#0880E8" stroke-dasharray="15" stroke-dashoffset="15" stroke-linecap="round" stroke-width="2" d="M12 3C16.9706 3 21 7.02944 21 12">
                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.3s" values="15;0" />
                <animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12" />
              </path>
            </svg></span></button>
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
                  <div class="citations">
                      <p style="font-size:large; text-align: center;">${item.total_citations}</p>
                      <p style="font-size:small; margin-left: 5px" >CITATIONS</p>
                  </div>
              </div>

              <hr style="height: 2px; background-color: #0858a4; width: 80%">

              <div class="article-pub">
                  <h4>Published in the Gavel</h4>
                  <p style="margin-top: 20px; color: black">ISSN(Online)</p>
                  <p>2071-1050(Online)</p>
                  <p style="margin-top: 20px; color: black ">Date Published</p>
                  <p>${item.publication_date}</p>
                  <p style="margin-top: 20px; margin-bottom: 10px; color: black ">Keywords</p>
                  <div class="keyword1">
                  ${keywordsHTML}
                  </div>
                  <button class="btn" id="cite-btn">
                    <h4>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M16.5 6A3.5 3.5 0 0 1 20 9.442c.09.865.077 2.141-.508 3.614c-.598 1.506-1.764 3.148-3.892 4.744a1 1 0 1 1-1.2-1.6c1.564-1.173 2.46-2.313 2.973-3.31A3.5 3.5 0 1 1 16.5 6m-9 0A3.5 3.5 0 0 1 11 9.442c.09.865.077 2.141-.508 3.614c-.597 1.506-1.764 3.148-3.892 4.744a1 1 0 1 1-1.2-1.6c1.564-1.173 2.46-2.313 2.973-3.31A3.5 3.5 0 1 1 7.5 6"/></g></svg>
                      Cite
                    </h4>
                  </button>
                  <a  class="border-0" href="https://www.facebook.com/sharer/sharer.php?u=https://openaccessjournalcui-production.up.railway.app/PHP/article-details.php?articleId=${item.article_id}" target="_blank">

                  <button class="btn" id="share-btn">
                      <h4>

                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18 22q-1.25 0-2.125-.875T15 19q0-.175.025-.363t.075-.337l-7.05-4.1q-.425.375-.95.588T6 15q-1.25 0-2.125-.875T3 12q0-1.25.875-2.125T6 9q.575 0 1.1.213t.95.587l7.05-4.1q-.05-.15-.075-.337T15 5q0-1.25.875-2.125T18 2q1.25 0 2.125.875T21 5q0 1.25-.875 2.125T18 8q-.575 0-1.1-.212t-.95-.588L8.9 11.3q.05.15.075.338T9 12q0 .175-.025.363T8.9 12.7l7.05 4.1q.425-.375.95-.587T18 16q1.25 0 2.125.875T21 19q0 1.25-.875 2.125T18 22"/></svg>
                          Share

                      </h4>

                  </button>
                  </a>

                  <button class="btn" id="donate-btn">
                    <h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="currentColor" d="M178 32c-20.65 0-38.73 8.88-50 23.89C116.73 40.88 98.65 32 78 32a62.07 62.07 0 0 0-62 62c0 70 103.79 126.66 108.21 129a8 8 0 0 0 7.58 0C136.21 220.66 240 164 240 94a62.07 62.07 0 0 0-62-62m-50 174.8C109.74 196.16 32 147.69 32 94a46.06 46.06 0 0 1 46-46c19.45 0 35.78 10.36 42.6 27a8 8 0 0 0 14.8 0c6.82-16.67 23.15-27 42.6-27a46.06 46.06 0 0 1 46 46c0 53.61-77.76 102.15-96 112.8"/></svg>
                      Heart
                    </h4>
                  </button>
              </div>
          </div>
          </div>
      </div>
    `;
    function formatContributors(authors) {
      if (authors != null) {
          return authors
              .split(";")
              .map((author, index, array) => (index === array.length - 1 && array.length > 1 ? `& ${author}` : author))
              .join(", ");
      }
      return "";
    }
  
    let contributors_full = formatContributors(item.contributors_B);
    let contributors_initial = formatContributors(item.contributors_B);
    
    
    const citationSelect = document.querySelector("select");
    citationSelect.addEventListener("change", function () {
      const selectedCitation = citationSelect.value;
     
      citationContent.innerHTML = `   
        <ul>
          <li> 
            <h4 class="small"><b>${selectedCitation} Citation</b></h4>
            <p>
              ${
                item.contributors != null ?
                  selectedCitation === "APA"
                    ? `${contributors_full} (${item.publication_date.split(" ")[3]}). ${item.title}. ${item.journal}, ${item.volume.split(" ")[1]}(1). https://openaccessjournalcui-production.up.railway.app/PHP/article-details.php?articleId=${item.article_id}`
                  : selectedCitation === "MLA"
                    ? `${contributors_initial}. "${item.title}." ${item.journal}, ${item.publication_date.split(" ")[3]}, ${item.volume.split(" ")[1]}(1).`
                  : selectedCitation === "Chicago"
                    ? `${contributors_initial}. "${item.title}." ${item.journal} ${item.volume.split(" ")[1]}, no. 1 (${item.publication_date.split(" ")[3]}).  https://openaccessjournalcui-production.up.railway.app/PHP/article-details.php?articleId=${item.article_id}`
                  : `${item.contributors_A.split(";").join(", ")}. ${item.title}. ${item.journal}.`
                    + ` https://openaccessjournalcui-production.up.railway.app/PHP/article-details.php?articleId=${item.article_id}`
                : 
                  selectedCitation === "APA"
                      ? `${item.title}(${item.publication_date.split(" ")[3]}). ${item.journal}, ${item.volume.split(" ")[1]}(1). https://openaccessjournalcui-production.up.railway.app/PHP/article-details.php?articleId=${item.article_id}`
                  : selectedCitation === "MLA"
                      ? `"${item.title}." ${item.journal}, ${item.publication_date.split(" ")[3]}, ${item.volume.split(" ")[1]}(1).`
                  : selectedCitation === "Chicago"
                      ? `${contributors_initial}. "${item.title}." ${item.journal} ${item.volume.split(" ")[1]}, no. 1 (${item.publication_date.split(" ")[3]}).  https://openaccessjournalcui-production.up.railway.app/PHP/article-details.php?articleId=${item.article_id}`
                  : `${item.title}. ${item.journal}.`
                      + ` https://openaccessjournalcui-production.up.railway.app/PHP/article-details.php?articleId=${item.article_id}`
              }
            </p>
          </li>
        </ul>
      `;
    });

    const initialSelectedCitation = citationSelect.value;
    citationContent.innerHTML = `   
      <ul>
        <li> 
          <h4 class="small"><b>${initialSelectedCitation} Citation</b></h4>
          <p class="cited" id="cited">
          ${item.contributors != null ? 
            `${contributors_full} (${item.publication_date.split(" ")[3]}). ${item.title}. ${item.journal}, ${item.volume.split(" ")[1]}(1). https://openaccessjournalcui-production.up.railway.app/PHP/article-details.php?articleId=${item.article_id}`
            : 
            `${item.title}(${item.publication_date.split(" ")[3]}).${item.journal}, ${item.volume.split(" ")[1]}(1). https://openaccessjournalcui-production.up.railway.app/PHP/article-details.php?articleId=${item.article_id}`

          }
          </p>
        </li>
      </ul>
    `;

    const copyBtn = document.getElementById("copy-btn")
    const inlineBtn = document.getElementById("inline-btn")

    copyBtn.addEventListener("click",()=> {
      navigator.clipboard.writeText(citationContent.querySelector("p").innerHTML);
      handleDownloadLog(item.article_id,"citation");
      Swal.fire({
        html: '<h4 style="color: #0858a4; font-family: font-family: Arial, Helvetica, sans-serif">Successfully copied reference in your clipboard.</h4>',
        icon: 'success',
      })
    })

    inlineBtn.addEventListener("click",()=> {
      navigator.clipboard.writeText(citationContent.querySelector("p").innerHTML);
      handleDownloadLog(item.article_id,"citation");
      Swal.fire({
        html: '<h4 style="color: #0858a4; font-family: font-family: Arial, Helvetica, sans-serif">Successfully copied reference in your clipboard.</4>',
        icon: 'success',
      })
    })
 

    const downloadBtn = articleElement.querySelector(`#download-btn`);
    const epubBtn = articleElement.querySelector(`#epub-btn`);
    const citeBtn = articleElement.querySelector(`#cite-btn`);
    // const viewFullArticle = articleElement.querySelector(`#btn1`);

    if (active) {
      downloadBtn.style.display = "inline-block";
      epubBtn.style.display = "inline-block";
    } else {
      // downloadBtn.style.display = "none";

      // // viewFullArticle.addEventListener("click", () => {
      // //   window.location.href = "../php/login.php";
      // // });
      downloadBtn.addEventListener("click", () => {
          window.location.href = "../PHP/login.php";
      });
      epubBtn.addEventListener("click", () => {
        window.location.href = "../PHP/login.php";
    });

    }
  
    if (downloadBtn) {
      downloadBtn.addEventListener("click", () => {
        try{
          let fileExtension = item.file_name.split('.').pop();
          if (fileExtension === "docx") {
            createCloudConvertJob(item.file_name,"docx", "pdf");
          }else if (fileExtension === "pdf") {
            let fileUrl = `https://qcuj.online/Files/final-file/${encodeURIComponent(item.file_name)}`;
            let link = document.createElement("a");
            link.setAttribute("href", fileUrl);
            link.setAttribute("download", "");
            link.style.display = "none";
            
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
          }else{
            createCloudConvertJob(item.file_name, fileExtension, "pdf")
          }
          handleDownloadLog(item.article_id, "download");
          Swal.fire({
            html: '<h4 style="color: #0858a4; font-family: font-family: Arial, Helvetica, sans-serif">Successfully downloaded.</h4>',
            icon: 'success',
          })
        }catch(error){
          Swal.fire({
            html: '<h4 style="color: #0858a4; font-family: font-family: Arial, Helvetica, sans-serif">Failed to download. No file available</h4>',
            icon: 'warning',
          })
        }

       
        
    });
    }
    if (epubBtn) {
      epubBtn.addEventListener("click", () => {
        try{
          Swal.fire({
            html: '<h4 style="color: #0858a4; font-family: font-family: Arial, Helvetica, sans-serif">Successfully downloaded.</h4>',
            icon: 'success',
          })
          var fileExtension = item.file_name.split('.').pop();
          createCloudConvertJob(item.file_name, fileExtension, "epub")
          handleDownloadLog(item.article_id,"download");
        }catch(error){
          Swal.fire({
            html: '<h4 style="color: #0858a4; font-family: font-family: Arial, Helvetica, sans-serif">Failed to download. No article file available.</h4>',
            icon: 'warning',
          })
        }
      });
    }
    if (citeBtn) {
      citeBtn.addEventListener("click", () => {
        toggleCiteModal()
      });
    }
    articleContainer.appendChild(articleElement);
  });
}

function navigateToArticle(articleId) {
  window.location.href = `../PHP/article-details.php?articleId=${articleId}`;
}

async function renderRecommended(data) {
  const container = document.querySelector(".recommendation-article");
  const articleContainer = document.getElementById("similar-articles");
  
  if (data.length < 1){
    container.classList.add("d-none")
    console.log("hello")
  }
  await data.forEach((article) => {
    const articleElement = document.createElement("div");
    articleElement.classList.add("article");

    articleElement.innerHTML = `
      <p class="h6 h-50">${article.title}</p>
      <div class="article-info">
        <p class="info">${article.journal}</p>
      </div>
      <p class="author">By ${article.author}</p>
      <p class="article-content h-25 ">${article.abstract.slice(0, 80)}</p>
      <button class="btn btn-primary btn-md btn-article" style="border: 2px #0858a4 solid; background-color: transparent; border-radius: 20px; color: #0858a4; width: 100%;">Read Article</button>
    `;
    articleElement.addEventListener("click", () =>
      navigateToArticle(article.article_id)
    );

    articleContainer.appendChild(articleElement);
  });
}



const closeBtn = document.getElementById("closeCiteModal")
closeBtn.addEventListener("click", () => {
  toggleCiteModal()
})

function toggleCiteModal() {
  const citationElement = document.getElementById("citation-container")

  const isModalVisible = citationElement.classList.contains("d-none");

  if (isModalVisible) {
    citationElement.classList.add("d-flex");
    citationElement.classList.remove("d-none");
  } else {
    citationElement.classList.remove("d-flex");
    citationElement.classList.add("d-none");
  }
}

