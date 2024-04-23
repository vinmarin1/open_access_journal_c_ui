// document.addEventListener("DOMContentLoaded", fetchArticleDetails);

function getQueryParam(name) {
  const urlSearchParams = new URLSearchParams(window.location.search);
  return urlSearchParams.get(name);
}

const articleId = getQueryParam("articleId");
async function fetchArticleDetails() {
  const title = document.getElementById("title").value;
  const abstract = document.getElementById("abstract").value;
  const any = document.getElementById("any").value;
  try {
    const response = await fetch(
      "https://web-production-cecc.up.railway.app/api/check/article",
      {
        method: "POST",
        body: JSON.stringify({
          title: title,
          abstract: abstract + any,
        }),
        headers: {
          "Content-Type": "application/json",
        },
      }
    );
    const data = await response.json();
    // renderArticleDetails([data.selected_article]);
    renderRecommended(data.recommendations);
    renderJournal(data.journal)
  } catch (error) {
   
  }
}
// function renderNoArticleFound() {
//   const articleContainer = document.getElementById("article_details");
//   articleContainer.innerHTML = `
//   <section class="not-found">
//     <span>Article ${articleId} does not exist</span>
//     <img class="svg-not-found" src="../images/not-found.gif"/>
//     <div class="text">
//       <p>Illustration by <a href="https://icons8.com/illustrations/author/lZpGtGw5182N">Elisabet Guba</a> from <a href="https://icons8.com/illustrations">Ouch!</a></p>
//     </div>
//   </section>`
// }

// function renderArticleDetails(data) {
//   const articleContainer = document.getElementById("article_details");
//   data.forEach((item) => {
//     const articleElement = document.createElement("div");

//     articleElement.classList.add("article-details-body");



//   })}

function navigateToArticle(articleId) {
  window.location.href = `../PHP/article-details.php?articleId=${articleId}`;
}

async function renderRecommended(data) {
  const container = document.querySelector(".recommendation-article");
  const articleContainer = document.getElementById("similar-articles");
  articleContainer.innerHTML=""
  
  if (data.length < 1){
    articleContainer.classList.add("d-none")
    console.log("hello")
  }
  await data.splice(0,10).forEach((article) => {
    const articleElement = document.createElement("div");
    articleElement.classList.add("article","d-block");

    articleElement.innerHTML = `
      <p class="h6 h-50">${article.title}</p>
 
      <p class="article-content">${article.abstract.slice(0,180)}...</p>
      <button class="btn btn-primary btn-md btn-article" style="border: 2px var(--main, #0858A4) solid; background-color: transparent; border-radius: 20px; color: var(--main, #0858A4); width: 100%;">Read Article</button>
    `;
    articleElement.addEventListener("click", () =>
      navigateToArticle(article.article_id)
    );

    articleContainer.appendChild(articleElement);
  });
}
async function renderJournal(data) {
  const container = document.querySelector(".recommendation-article");
  const articleContainer = document.getElementById("journal-results");
  const gavelScore = data[0];
  const lampScore = data[1];
  const starScore = data[2];
  
  let rank;
  if (gavelScore > lampScore && gavelScore > starScore) {
    rank = "Gavel";
  } else if (lampScore > gavelScore && lampScore > starScore) {
    rank = "Lamp";
  } else if (starScore > gavelScore && starScore > lampScore) {
    rank = "Star";
  } else {
    rank = "Tie"; 
  }
  document.getElementById("gavel").innerHTML = gavelScore
  document.getElementById("lamp").innerHTML = lampScore
  document.getElementById("star").innerHTML = starScore
  document.getElementById("starRound").innerHTML = `${Math.floor(starScore)} `
  document.getElementById("lampRound").innerHTML = `${Math.floor(lampScore)} `
  document.getElementById("gavelRound").innerHTML = `${Math.floor(gavelScore)} `
  document.getElementById("rank").innerHTML = rank
  
}




document.getElementById("check").addEventListener("click", () => fetchArticleDetails())
