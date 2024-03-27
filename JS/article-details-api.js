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
// function copyPageLink () {
//   const url = `${window.location.href}`; 
//   navigator.clipboard.writeText(url).then(() => {
//       Swal.fire({
//           html: '<h4 style="color: var(--main, #0858A4); font-family: Arial, Helvetica, sans-serif">Successfully copied the link to your clipboard.</h4>',
//           icon: 'success'
//       });
//   })
//   // .catch((error) => {
//   //     console.error('Error copying text: ', error);
//   //     Swal.fire({
//   //         html: '<h4 style="color: var(--main, #0858A4); font-family: Arial, Helvetica, sans-serif">Failed to copy the link. Please try again.</h4>',
//   //         icon: 'error'
//   //     });
//   // });
// };
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

    const referencesArray = item.references.trim().split("\\n");

    let referencesHTML = "";
    for (const ref of referencesArray) {
      if (ref != ""){
        referencesHTML += `<li style="text-align:justify">${ref}</li>`;
      
      }
    }
    let contributorsHTML = "";
    if (item.contributors != null) {
      for (const contributors of item.contributors.split(";")) {
        contributorsHTML += `
        <div id="popup-link" class="d-flex">
          <a href="#" class="text-muted">${contributors.split("->")[0]} </a>
          <div class="popup-form">
            <div class="container-fluid">
              <div class="row">
                <!-- <div class="col-md-2">
                  <img src="../images/profile.jpg" alt="Profile Picture" class="profile-pic">
                </div> -->
                <div class="col-md-10 col-12 prof-info">
                  <!-- Content for the second column -->
                  <h5 class="!font-bold">${contributors.split("->")[0]}</h5>
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
    }else if (item.contributors == null){
      for (const contributors of item.author.split(",")) {
        contributorsHTML += `
        <div id="popup-link" class="d-flex">
          <a href="#" class="text-muted">${contributors} </a>
          <div class="popup-form">
            <div class="container-fluid">
              <div class="row">
                <!-- <div class="col-md-2">
                  <img src="../images/profile.jpg" alt="Profile Picture" class="profile-pic">
                </div> -->
                <div class="col-md-10 col-12 prof-info">
                  <!-- Content for the second column -->
                  <p class="!font-bold">${contributors}</p>
                  <a class="btn btn-primary btn-md" id="seeMore-btn" href="./user-view.php?orcid=${contributors}">View Profile</a>
                  <a href="https://orcid.org/${contributors}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 512 512">
                    <path fill="#a7cf36" d="M294.75 188.19h-45.92V342h47.47c67.62 0 83.12-51.34 83.12-76.91c0-41.64-26.54-76.9-84.67-76.9M256 8C119 8 8 119 8 256s111 248 248 248s248-111 248-248S393 8 256 8m-80.79 360.76h-29.84v-207.5h29.84zm-14.92-231.14a19.57 19.57 0 1 1 19.57-19.57a19.64 19.64 0 0 1-19.57 19.57M300 369h-81V161.26h80.6c76.73 0 110.44 54.83 110.44 103.85C410 318.39 368.38 369 300 369" />
                  </svg>
                  </a>
                </div>
              </div>
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
                    <div class="d-flex flex-wrap gap-1">${contributorsHTML}</div>
                </div>
                <div class="volume">
                    <p style= "font-size: small; color: gray" >Journal Issue and Volume</p>
                    <p href="./all-issues??issue=${item.issues_id}"><a class="text-muted" href="./all-issues.php?issue=${item.issues_id}">${item.issue_title}</a></p>
                </div>
            </div>
        </div>
      </div>

      <section style="padding:1em 8%;" class="d-flex flex-column flex-md-row justify-content-between gap-5">
          <div class="abstract w-100">
            <div class="alert alert-light small py-2" role="alert" id="login-redirect">
              You are not logged in. To heart, download and read full article, please <a href="./login.php" class="alert-link">login</a>
            </div>
            <div class="d-flex gap-1 align-items-center justify-content-between">
              <div class="d-flex flex-wrap gap-1">
              <button class="btn btn-md" id="read-btn">Read Full Article</button>
   
              <button class="btn tbn-primary btn-md" id="download-btn"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                </svg>
                PDF
              </button>
              <button class="btn tbn-primary btn-md" id="epub-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                </svg>
                EPUB 
              </button>
              <button  class="btn tbn-primary btn-md" id="cite-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 15 15">
                  <path fill="currentColor" fill-rule="evenodd" d="M9.425 3.441c.631-.204 1.359-.2 1.954.105c1.374.706 1.969 2.526 1.416 4.454c-.248.865-.685 1.705-1.609 2.552c-.924.848-2.206 1.348-2.8 1.348A.38.38 0 0 1 8 11.525c0-.207.176-.375.386-.375c.679 0 1.286-.37 2.005-.914c.55-.417.98-.95 1.217-1.414c.455-.888.47-2.14-.265-2.473a1.8 1.8 0 0 1-1.366.61c-1.2 0-1.907-.965-1.876-1.839c.029-.835.56-1.43 1.324-1.679m-6 0c.631-.204 1.359-.2 1.954.105C6.753 4.252 7.348 6.072 6.795 8c-.248.865-.685 1.705-1.609 2.552c-.924.848-2.206 1.348-2.8 1.348A.38.38 0 0 1 2 11.525c0-.207.176-.375.386-.375c.679 0 1.286-.37 2.005-.914c.55-.417.98-.95 1.217-1.414c.455-.888.47-2.14-.265-2.473c-.353.386-.814.61-1.366.61c-1.2 0-1.907-.965-1.876-1.839c.029-.835.56-1.43 1.324-1.679" clip-rule="evenodd" />
                </svg>
                Cite
              </button>
              </div>
              <button class="btn" id="support-btn">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 16 16">
                  	<path fill="${item.isSupported != 0 ? 'red': '#a8b3b3'}" d="M14.88 4.78a3.489 3.489 0 0 0-.37-.9a3.24 3.24 0 0 0-.6-.79a3.78 3.78 0 0 0-1.21-.81a3.74 3.74 0 0 0-2.84 0a4 4 0 0 0-1.16.75l-.05.06l-.65.65l-.65-.65l-.05-.06a4 4 0 0 0-1.16-.75a3.74 3.74 0 0 0-2.84 0a3.78 3.78 0 0 0-1.21.81a3.55 3.55 0 0 0-.97 1.69a3.75 3.75 0 0 0-.12 1c0 .318.04.634.12.94a4 4 0 0 0 .36.89a3.8 3.8 0 0 0 .61.79L8 14.31l5.91-5.91c.237-.232.44-.498.6-.79A3.578 3.578 0 0 0 15 5.78a3.747 3.747 0 0 0-.12-1" />
                  </svg>
                  <span id="total_support">${item.total_support}</span>
                </div>
              </button>
            
            </div>
              <h4>Abstract</h4>
              <p class="mb-4">${item.abstract}</p>
              <br/>
              <h4>References</h4>
              <ul class="mb-4 ml-4" style="list-style-type: square;">${referencesHTML}</ul>
              <iframe
                  src="https://qcuj.online/Files/final-file/${encodeURIComponent(item.file_name)}"
                  width="100%"
                  height="800px"
                  loading="lazy"
                  title="PDF-file"
                  class="d-none"
                  frameborder="0"
              ></iframe>
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

              <hr style="height: 2px; background-color: var(--main, #0858A4); width: 80%">

              <div class="article-pub">
                  <h4>Published in ${item.journal}</h4>
                  <p style="margin-top: 20px; color: black">ISSN(Online)</p>
                  <p>${item.issn}</p>
                  <p style="margin-top: 20px; color: black ">Date Published</p>
                  <p>${item.publication_date}</p>
                  <p style="margin-top: 20px; margin-bottom: 10px; color: black ">Keywords</p>
                  <div class="keyword1">
                  ${keywordsHTML}
                  </div>
                
                  <div>
                  <h4>Share with:</h4>

                  <a  class="share-btn" href="https://www.facebook.com/sharer/sharer.php?u=https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
                      <path fill="#1877f2" d="M256 128C256 57.308 198.692 0 128 0C57.308 0 0 57.308 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.348-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.959 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445" />
                      <path fill="#fff" d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A128.959 128.959 0 0 0 128 256a128.9 128.9 0 0 0 20-1.555V165z" />
                    </svg>
                  </a>
                  <a  class="share-btn"  href="http://www.linkedin.com/shareArticle?mini=true&url=https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
                      <path fill="#0a66c2" d="M218.123 218.127h-37.931v-59.403c0-14.165-.253-32.4-19.728-32.4c-19.756 0-22.779 15.434-22.779 31.369v60.43h-37.93V95.967h36.413v16.694h.51a39.907 39.907 0 0 1 35.928-19.733c38.445 0 45.533 25.288 45.533 58.186zM56.955 79.27c-12.157.002-22.014-9.852-22.016-22.009c-.002-12.157 9.851-22.014 22.008-22.016c12.157-.003 22.014 9.851 22.016 22.008A22.013 22.013 0 0 1 56.955 79.27m18.966 138.858H37.95V95.967h37.97zM237.033.018H18.89C8.58-.098.125 8.161-.001 18.471v219.053c.122 10.315 8.576 18.582 18.89 18.474h218.144c10.336.128 18.823-8.139 18.966-18.474V18.454c-.147-10.33-8.635-18.588-18.966-18.453" />
                    </svg>
                  </a>
                <!--  <a onclick="" class="share-btn" id="copy-page-link">
                   Copy link
                  </a> -->
                
                

              </div>
          </div>
      </section>
    `;

    function formatContributors(authors) {
      if (authors != null) {
          return authors
              .split(";")
              .map((author, index, array) => (index === array.length - 1 && array.length > 1 ? `& ${author.trim()}` : author.trim()))
              .join(", ");
      }
      return "";
    }
    
    function formatAuthors(authors) {
      if (authors != null) {
          return authors
              .split(",")
              .map((author, index, array) => (index === array.length - 1 && array.length > 1 ? `& ${author.trim()}` : author.trim()))
              .join(", ");
      }
      return "";
    }
  
    let contributors_full = formatContributors(item.contributors_A);
    let contributors_initial = formatContributors(item.contributors_B);
    
    let authors_full = formatAuthors(item.author);
    
    
    const citationSelect = document.querySelector("select");
    citationSelect.addEventListener("change", function () {
      const selectedCitation = citationSelect.value;
     
      citationContent.innerHTML = `   
        <ul>
          <li> 
            <h4 class="small"><b>${selectedCitation} Citation</b></h4>
            <p style="font-family:Arial,sans-serif;">
              ${
                item.contributors == null ?   
                  selectedCitation === "APA"
                      ? `${authors_full} (${item.publication_date.split(" ")[3]}). ${item.title}. ${item.journal}, ${item.issue_volume}(${item.issues_id}). Retrieved from https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`
                    : selectedCitation === "MLA"
                      ? `${authors_full}. "${item.title}." ${item.journal}, ${item.publication_date.split(" ")[3]}, ${item.issue_volume}(${item.issues_id}).`
                    : selectedCitation === "Chicago"
                      ? `${authors_full}. "${item.title}." ${item.journal} ${item.issue_volume}, no. ${item.issues_id} (${item.publication_date.split(" ")[3]}).  https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`
                    : `${item.contributors_A.split(";").join(", ")}. ${item.title}. ${item.journal}.`
                      + ` https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`
                : 
                item.contributors != null ?
                  selectedCitation === "APA"
                    ? `${contributors_initial} (${item.publication_date.split(" ")[3]}). ${item.title}. ${item.journal}, ${item.issue_volume}(${item.issues_id}). Retrieved from https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`
                  : selectedCitation === "MLA"
                    ? `${contributors_full}. "${item.title}." ${item.journal}, ${item.publication_date.split(" ")[3]}, ${item.issue_volume}(${item.issues_id}).`
                  : selectedCitation === "Chicago"
                    ? `${contributors_full}. "${item.title}." ${item.journal} ${item.issue_volume}, no. ${item.issues_id} (${item.publication_date.split(" ")[3]}).  https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`
                  : `${item.contributors_A.split(";").join(", ")}. ${item.title}. ${item.journal}.`
                    + ` https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`
                : 
                  selectedCitation === "APA"
                      ? `${item.title}(${item.publication_date.split(" ")[3]}). ${item.journal}, ${item.issue_volume}(${item.issues_id}). Retrieved from https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`
                  : selectedCitation === "MLA"
                      ? `"${item.title}." ${item.journal}, ${item.publication_date.split(" ")[3]}, ${item.issue_volume}(${item.issues_id}).`
                  : selectedCitation === "Chicago"
                      ? `"${item.title}." ${item.journal} ${item.issue_volume}, no. ${item.issues_id} (${item.publication_date.split(" ")[3]}).  https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`
                  : `${item.title}. ${item.journal}.`
                      + ` https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`
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
          <p class="cited" id="cited" style="font-family:Arial,sans-serif;">
          ${ item.contributors == null && item.authors !=''?   
              `${authors_full} (${item.publication_date.split(" ")[3]}). ${item.title}. ${item.journal}, ${item.issue_volume}(${item.issues_id}). Retrieved from https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`:
            item.contributors != null ? 
            `${contributors_initial} (${item.publication_date.split(" ")[3]}). ${item.title}. ${item.journal}, ${item.issue_volume}(${item.issues_id}). https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`
            : 
            `${item.title}(${item.publication_date.split(" ")[3]}).${item.journal}, ${item.issue_volume}(${item.issues_id}). Retrieved from https://qcuj.online/PHP/article-details.php?articleId=${item.article_id}`

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
        html: '<h4 style="color: var(--main, #0858A4); font-family: font-family: Arial, Helvetica, sans-serif">Successfully copied reference in your clipboard.</h4>',
        icon: 'success',
      })
    })
    
    if (inlineBtn){
    inlineBtn.addEventListener("click",()=> {
      navigator.clipboard.writeText(citationContent.querySelector("p").innerHTML);
      handleDownloadLog(item.article_id,"citation");
      Swal.fire({
        html: '<h4 style="color: var(--main, #0858A4); font-family: font-family: Arial, Helvetica, sans-serif">Successfully copied reference in your clipboard.</4>',
        icon: 'success',
      })
    })}
 
    const readBtn = articleElement.querySelector(`#read-btn`);

    const downloadBtn = articleElement.querySelector(`#download-btn`);
    const epubBtn = articleElement.querySelector(`#epub-btn`);
    const citeBtn = articleElement.querySelector(`#cite-btn`);
    const loginRedirect = articleElement.querySelector(`#login-redirect`);
    const supportBtn = articleElement.querySelector(`#support-btn`);
    const support =  articleElement.querySelector(`#total_support`)
    // const viewFullArticle = articleElement.querySelector(`#btn1`);

    if (active) {
      downloadBtn.style.display = "inline-block";
      epubBtn.style.display = "inline-block";
      readBtn.style.display = "inline-block";
      // supportBtn.style.display = "inline-block";
      loginRedirect.style.display = "none";
      if (supportBtn) {
        supportBtn.addEventListener("click", async () => {
          const svgElement = document.querySelector("#support-btn svg path");
          const currentColor = svgElement.getAttribute("fill");
          const currentTotal = parseInt(support.innerHTML)
          if (currentColor != "red"){
            svgElement.setAttribute("fill", "red");
            support.innerHTML = currentTotal + 1
          
          } else {
            svgElement.setAttribute("fill", "#a8b3b3");
            support.innerHTML = currentTotal - 1
          }
          const response = await fetch(
            "https://web-production-cecc.up.railway.app/api/articles/logs/support",
            {
              method: "POST",
              body: JSON.stringify({
                author_id: sessionId,
                article_id: parseInt(articleId),
              }),
              headers: {
                "Content-Type": "application/json",
              },
            }
          );
          
        });
      }
      if (readBtn) {
        readBtn.addEventListener("click", () => {
          document.querySelector("iframe").classList.remove("d-none")
        });
      }
    
      if (downloadBtn) {
        downloadBtn.addEventListener("click", () => {
          try{
            let fileExtension = item.file_name.split('.').pop();
            let fileUrl = `https://qcuj.online/Files/final-file/${encodeURIComponent(item.file_name)}`;
            
            if (fileExtension === "docx") {
              createCloudConvertJob(item.file_name,"docx", "pdf");
            }else if (fileExtension === "pdf") {
              let link = document.createElement("a");
              link.setAttribute("href", fileUrl);
              link.setAttribute("download", "");
              link.style.display = "none";
              link.setAttribute("target", "_blank");
              document.body.appendChild(link);
              link.click();
              document.body.removeChild(link);
            }else{
              createCloudConvertJob(item.file_name, fileExtension, "pdf")
            }
            handleDownloadLog(item.article_id, "download");
            Swal.fire({
              html: `
              <h4 style="color: var(--main, #0858A4); font-family: font-family: Arial, Helvetica, sans-serif">Download Started. Your download will start shortly. </h4>
              <p style="font-size: 16px;">If it doesn\'t start automatically, <a href="${fileUrl}">click here</a>.</p>'
  
              `,
              icon: 'success',
            })
          }catch(error){
          console.log(error,"---------")
            Swal.fire({
              html: '<h4 style="color: var(--main, #0858A4); font-family: font-family: Arial, Helvetica, sans-serif">Failed to download. No file available</h4>',
              icon: 'warning',
            })
          }
  
         
          
      });
      }
      if (epubBtn) {
        epubBtn.addEventListener("click", () => {
          try{
            Swal.fire({
              html: '<h4 style="color: var(--main, #0858A4); font-family: font-family: Arial, Helvetica, sans-serif">Download Started. Your download will start shortly.</h4>',
              icon: 'success',
            })
            var fileExtension = item.file_name.split('.').pop();
            createCloudConvertJob(item.file_name, fileExtension, "epub")
            handleDownloadLog(item.article_id,"download");
          }catch(error){
            Swal.fire({
              html: '<h4 style="color: var(--main, #0858A4); font-family: font-family: Arial, Helvetica, sans-serif">Failed to download. No article file available.</h4>',
              icon: 'warning',
            })
          }
        });
      }
    } else {
      // supportBtn.style.display = "none";
      downloadBtn.style.display = "none";
      epubBtn.style.display = "none";
      readBtn.style.display = "none";
      loginRedirect.style.display = "inline-block";
      
      readBtn.addEventListener("click", () => {
        window.location.href = "../php/login.php";
      });
      downloadBtn.addEventListener("click", () => {
          window.location.href = "../PHP/login.php";
      });
      epubBtn.addEventListener("click", () => {
        window.location.href = "../PHP/login.php";
      });
      supportBtn.addEventListener("click", () => {
        // window.location.href = "../PHP/login.php";
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
      <button class="btn btn-primary btn-md btn-article" style="border: 2px var(--main, #0858A4) solid; background-color: transparent; border-radius: 20px; color: var(--main, #0858A4); width: 100%;">Read Article</button>
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
