document.addEventListener("DOMContentLoaded", generateQuestions);

async function generateQuestions() {

    const response = await fetch(
          `https://web-production-cecc.up.railway.app/api/faqs/?limit=3&category=GENERAL QUESTIONS`,
        {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        }
      );
    
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
    
    const data = await response.json();
    const TopQASContainer = document.getElementById("top-faqs");

    TopQASContainer.innerHTML = data.faqs.map(faq => `
    <div class="faq accordion-item">
        <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${faq.id}" aria-expanded="true" aria-controls="collapseOne">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 15 15"><path fill="#e56f1f" fill-rule="evenodd" d="M.877 7.5a6.623 6.623 0 1 1 13.246 0a6.623 6.623 0 0 1-13.246 0M7.5 1.827a5.673 5.673 0 1 0 0 11.346a5.673 5.673 0 0 0 0-11.346m.75 8.673a.75.75 0 1 1-1.5 0a.75.75 0 0 1 1.5 0m-2.2-4.25c0-.678.585-1.325 1.45-1.325s1.45.647 1.45 1.325c0 .491-.27.742-.736 1.025c-.051.032-.111.066-.176.104a5.28 5.28 0 0 0-.564.36c-.242.188-.524.493-.524.961a.55.55 0 0 0 1.1.004a.443.443 0 0 1 .1-.098c.102-.079.215-.144.366-.232c.078-.045.167-.097.27-.159c.534-.325 1.264-.861 1.264-1.965c0-1.322-1.115-2.425-2.55-2.425c-1.435 0-2.55 1.103-2.55 2.425a.55.55 0 0 0 1.1 0" clip-rule="evenodd"/></svg>
            <span>${faq.question}</span>
        </button>
        </h2>
        <div id="collapse${faq.id}" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            ${faq.answer}
        </div>
        </div>
    </div>
    `).join('');

}


