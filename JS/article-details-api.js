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
      keywordsHTML += `<a href="">${keyword.trim()}</a>`;
    }

    let contributorsHTML = "";
    if (item.contributors != null) {
      for (const contributors of item.contributors.split(";")) {
        contributorsHTML += `<a href="https://orcid.org/${contributors.split(".")[1]}">${contributors.split(".")[0]}</a> | `;
      }
    }
    articleElement.innerHTML = `
      <div class="content-over">
        <div class="article-title">
            <p>${item.journal}</p>
            <h3>${item.title}</h3>
            <div class="after-title">
                <div class="authors" id="popup-link">
                    <p style= "font-size: small; color: gray" >Author/s</p>
                    <p>${contributorsHTML}<span class="arrow-icon">&#10151;</span></p>

                    <div class="popup-form">
                    <!-- Your form content goes here -->
                    <form>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-1">
                                    <!-- Content for the first column -->
                                    <!-- Profile Image -->
                                    <img src="../images/profile.jpg" alt="Profile Picture" class="profile-pic">
                                </div>
    
                                <div class="col-md-10 col-12 text-md-left prof-info">
                                    <!-- Content for the second column -->
                                    <h2>Donalyn Dizon</h2>
                                    <a href="#!">Reviewer / Author</a>
                                </div>
    
                                <div class="col-md-1 col-12 text-center">
                                    <!-- Content for the third column -->
                                    <img src="../images/View.png" alt="viewer" class="viewer">
                                </div>
    
                            </div>
    
                            <hr style="height: 1px; background-color: #959595; width: 100%;">
    
                            <div class="row">
                                <div class="col-md-10 text-md-left">
                                    <!-- Content for the first column -->
                                    <h2 style="color:#6C757D; font-weight: bold; font-size: 25px">Badges</h2>
                                </div>
    
                                
                                <div class="col-md-2  text-center">
                                    <!-- Content for the second column -->
                                    <span class="xp-label" >56/100</span>
                                </div>
    
    
                                <div class="col-md-12">
                                    <!-- Content for the third column -->
                                    <div class="xp-container">
                                    <!-- XP Bar -->
                                        <div class="xp-bar">
                                            <div class="progress-bar">
                                                <div class="progress" style="width: 56%;"></div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-md-3 col-12 d-flex align-items-center">
                                    <!-- Content for the first column -->
                                    <div class="badge-box text-center mx-auto">
                                        <img src="../images/badge1.jpg" alt="Profile Picture" class="img-badge">
                                    </div>
                                </div>
    
                                
                                <div class="col-md-2 col-12 d-flex align-items-center">
                                    <!-- Content for the second column -->
                                    <div class="badge-box text-center mx-auto">
                                        <img src="../images/badge2.jpg" alt="Profile Picture" class="img-badge">
                                    </div>
                                </div>
    
    
                                <div class="col-md-2 col-12 d-flex align-items-center">
                                    <!-- Content for the third column -->
                                    <div class="badge-box text-center mx-auto">
                                        <img src="../images/badge3.jpg" alt="Profile Picture" class="img-badge">
                                    </div>
                                </div>
    
                                <div class="col-md-2 col-12 d-flex align-items-center">
                                    <!-- Content for the third column -->
                                    <div class="badge-box text-center mx-auto">
                                        <img src="../images/badge1.jpg" alt="Profile Picture" class="img-badge">
                                    </div>
                                </div>
    
                                <div class="col-md-3 col-12 d-flex align-items-center">
                                    <!-- Content for the third column -->
                                    <div class="badge-box text-center mx-auto">
                                        <img src="../images/badge2.jpg" alt="Profile Picture" class="img-badge">
                                    </div>
                                </div>
                            </div>
                            
    
                            <div class="row">
                                <div class="col-md-9 col-12 text-md-left text-center">
                                    <!-- Content for the first column -->
                                    <span style="color:#6C757D" >Showing 1 to 5 of badges</span>
                                </div>
    
                                <div class="col-md-3 col-12 text-center mt-2">
                                    <!-- Content for the second column -->
                                    <button class="btn btn-primary btn-md" id="seeMore-btn">See more</button>
                                </div>
                            </div>
    
    
                        </div>      
    
                    </form>
                    </div>


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
                  <button class="btn" id="share-btn">
                    <h4>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18 22q-1.25 0-2.125-.875T15 19q0-.175.025-.363t.075-.337l-7.05-4.1q-.425.375-.95.588T6 15q-1.25 0-2.125-.875T3 12q0-1.25.875-2.125T6 9q.575 0 1.1.213t.95.587l7.05-4.1q-.05-.15-.075-.337T15 5q0-1.25.875-2.125T18 2q1.25 0 2.125.875T21 5q0 1.25-.875 2.125T18 8q-.575 0-1.1-.212t-.95-.588L8.9 11.3q.05.15.075.338T9 12q0 .175-.025.363T8.9 12.7l7.05 4.1q.425-.375.95-.587T18 16q1.25 0 2.125.875T21 19q0 1.25-.875 2.125T18 22"/></svg>
                      Share
                    </h4>
                  </button>
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
        handleDownloadLog(item.article_id,"download");
        createCloudConvertJob(item.file_name, "pdf");
       
      });
    }
    if (epubBtn) {
      epubBtn.addEventListener("click", () => {
        handleDownloadLog(item.article_id,"download");
        createCloudConvertJob(item.file_name, "epub");
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
  const articleContainer = document.getElementById("similar-articles");

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


async function handleDownloadLog(articleId,type) {
  await fetch(
    "https://web-production-cecc.up.railway.app/api/articles/logs",
    {
      method: "POST",
      body: JSON.stringify({
        type: type,
        author_id: sessionId,
        article_id: parseInt(articleId),
      }),
      headers: {
        "Content-Type": "application/json",
      },
    }
  );
}

function createCloudConvertJob(file, format) {
  const apiKey =
    "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmQ1NTQ0ZmYwYzE2NTdmNjZhOGExZmQ5YmQ3YjIzODU0YmRiMDhjYjYxNGM1MzE2N2E0NWZmNmJhYzkxYjA2ZGRhYWQ5ZjBiZWFhZmIwOWIiLCJpYXQiOjE3MDEyNDI1MzYuNDg0NDY3LCJuYmYiOjE3MDEyNDI1MzYuNDg0NDY5LCJleHAiOjQ4NTY5MTYxMzYuNDc5ODk1LCJzdWIiOiI2NjI5Njk0NCIsInNjb3BlcyI6WyJ1c2VyLnJlYWQiLCJ1c2VyLndyaXRlIiwidGFzay5yZWFkIiwidGFzay53cml0ZSIsInByZXNldC5yZWFkIiwicHJlc2V0LndyaXRlIiwid2ViaG9vay5yZWFkIiwid2ViaG9vay53cml0ZSJdfQ.BoMmx1_yaPK38lstapuVDFcp474cbqOhwVDIikM7a8H1e8R0I1isn4UZYiON6OGG0ckBSEm-mJbQ0wNaAHjfcpG378098a6uw2YfyJVVgkZP9lr5k2gOCCJXRq3eP5trwXAr9kdkxGZrfn7d9SWr9xF_wFGgd3x5nLjZuLlmjYDAOPx62BVLaDUSQkOg77CeyXFQIR91GuhwdanJF19ASGbWLGypZ1n4RtwIwfChRyNBbOSFo0RsKYzZzaF2v0QyfBGtmRmQJWB6GyC-VXl_DEdld5WnOCt5xPkreE9XKUthI0WgpbId98yCEcx3ZF4T7hRDylLrXJi_c_F-xz85s8MfPpx9_27X1xF7e4cMqUkeeQTANh4fzMSibSx8vZV6sC5Py3fsfj_gQ2D3gG-UqEo2srHS5xhetCW39TqRtgThvwpICHoRV-Q3GZx73BUqgLz0-HlEp7-ZuLZKoJIq6-2HnYZeWtAPuX08dvwWWoCR5E8NvMlZ3vBby8YHuN7pMYpm_LOuebgUyJW-5Ok9yfKy_4wNyq_yadYktpZlfPQ2-QrRucQ6gbkMxyKswqBgwt5D3NL6wWPLu2hnCkprg1SqC459xY4LcPWSRZDUf_S9nqlHbIOrS7vkTYRtkeA81ZpbrkI_v9NU6LjDZfd2k_G13WywEiIUo_wi9cPlpxs";

  const apiUrl = "https://api.cloudconvert.com/v2/jobs";

  const jsonData = {
    tasks: {
      "import-1": {
        operation: "import/url",
        url: `https://openaccessjournalcui-production.up.railway.app/Files/submitted-article/${file}`,
        filename: file,
      },
      "task-1": {
        operation: "convert",
        input_format: "docx",
        output_format: format,
        engine: "calibre",
        input: ["import-1"],
      },
      "export-1": {
        operation: "export/url",
        input: ["task-1"],
        inline: true,
        archive_multiple_files: true,
      },
    },
    tag: "jobbuilder",
  };

  fetch(apiUrl, {
    method: "POST",
    body: JSON.stringify(jsonData),
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${apiKey}`,
    },
  })
    .then((response) => response.json())
    .then((data) => {
      const downloadUrl = `https://sync.api.cloudconvert.com/v2/jobs/${data.data.id}?redirect=true`;

      fetch(downloadUrl, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${apiKey}`,
        },
      })
        .then((response) => {
          response.blob().then((blob) => {
            console.log(window.URL.createObjectURL(blob));
            const url = window.URL.createObjectURL(blob);

            const link = document.createElement("a");
            link.href = url;
            link.download = `filename.${format}`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
          });
        })
        .catch((error) => {
          console.error("Error fetching file content:", error);
        });
    })
    .catch((error) => {
      console.error("Error creating job:", error);
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

