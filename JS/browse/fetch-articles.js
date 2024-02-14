async function fetchData(input, dates,sort) {
    // get journal params from url
    function getQueryParam(name) {
      const urlSearchParams = new URLSearchParams(window.location.search);
      return urlSearchParams.get(name);
    }
    
    const journalId = getQueryParam("journal");
    const journalPreview = document.querySelector(".journal-preview");
    journalPreview.classList.add("d-none")
    if (journalId && journalId.split(",").length ==1){
      journalPreview.classList.add("d-flex")
      journalPreview.classList.remove("d-none")
      fetchJournal(journalId)
    }
  
  
    const articlesContainer = document.querySelector("#articles");
    articlesContainer.innerHTML=""
    const total = document.querySelector("#total");
    const loading = document.querySelector('#skeleton-container');
    
    loading.classList.add("d-flex")
    
  
    if(await fetchJournal(journalId)==false && (journalId && journalId !="") ){
      total.innerHTML = '0 searched article'
      loading.classList.add("d-none") 
      return  articlesContainer.innerHTML = input? `No match found for ${input }.` : "No match found";
      
    }
  
    // fetch articles
    try {
  
      const response = await fetch(
        `https://web-production-cecc.up.railway.app/api/articles/?sort=${sort}`,
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            journal: journalId && journalId!=null ? journalId : "",
            dates: dates,
            input: typeof input == "string" ? input : "",
          }),
        }
      );
  
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
  
      const data = await response.json();
  
     // display and render article items
     
    
      articleData = data.results
      function renderArticles(currentPage=0){
        articlesContainer.innerHTML = "";
        total.innerHTML = "";
        let noOfItems = 10;
  
        data.results
          .slice(currentPage * noOfItems, noOfItems * (currentPage + 1))
          .forEach((item) => {
            const articleDiv = document.createElement("div");
            articleDiv.classList.add("articles", "d-flex", "flex-column", "flex-md-row");
  
            articleDiv.addEventListener("click", () =>
              navigateToArticle(item.article_id)
            );
            const keywordsArray = item.keyword.split(",");
  
            let keywordsHTML = "";
            for (const keyword of keywordsArray) {
              keywordsHTML += `<span class="keyword">${keyword.trim()}</span>`;
            }
            let contributorsHTML = "";
            if (item.contributors != null) {
              contributorsHTML = "By ";
              for (const contributors of item.contributors.split(",")) {
                contributorsHTML += `<a href="https://orcid.org/${
                  contributors.split("->")[1]
                }"> <u>${contributors.split("->")[0]} </u> </a>  `;
              }
            }
            articleDiv.innerHTML = `
            <div class="article-details">
              <h6 style="color: #0858a4;"><strong>${item.title} - (${
                
                new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(new Date(item.publication_date))
              })</strong></h6>
            <p style="color: #454545;">${item.abstract.slice(0, 200)} </p>
              <div class="keywords">
              ${keywordsHTML}
              </div>
              ${
              item.article_contains 
                    ? `Terms found:  ${item.article_contains.join(", ")}`
                    : ""
              }
          </div>
          <div class="article-stats">
            <div class="stats-container">
                <div class="view-download">
                    <p class="stats-value" style="color: #0858a4;">${
                      item.total_reads
                    }</p>
                    <p class="stats-label" style="color: #959595;">VIEWS</p>
                </div>
                <div class="view-download">
                    <p class="stats-value" style="color: #0858a4;">${
                      item.total_downloads
                    }</p>
                    <p class="stats-label" style="color: #959595;">DOWNLOADS</p>
                </div>
                <div class="view-download">
                <p class="stats-value" style="color: #0858a4;">${
                  item.total_citations
                }</p>
                <p class="stats-label" style="color: #959595;">CITATIONS</p>
            </div>
            </div>
            <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
            <div class="published-info">
                <h6 class="publish-label" style="color: #0858a4;"><strong>Published in The ${
                  item.journal
                }</strong></h6>
                <p class="authors d-flex flex-wrap gap-1" style="color: #959595;width:20em">${contributorsHTML}</p>
                
            </div>
        </div>
          `;
  
            articlesContainer.appendChild(articleDiv);
            
          });
      total.innerHTML = `${data.total} searched articles`;
  
      loading.classList.add("d-none") 
      }
      renderArticles()
      // previewFilters()
      generatePagination(data.total)
      const buttons = document.querySelectorAll('.page-item');
   
      // Add click event listener to each button
      buttons.forEach((button,index) => {
        button.addEventListener('click', function() {
          renderArticles(index)
        });
      });
  
  
     
    } catch (error) {
      console.error("Error fetching data:", error);
      articlesContainer.innerHTML = input? `No match found for ${input }.` : "No match found"
      total.innerHTML = '0 searched article'
      loading.classList.add("d-none") 
    }
  }
  