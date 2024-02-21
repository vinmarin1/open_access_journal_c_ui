document.addEventListener("DOMContentLoaded", generateQuestions);

async function generateQuestions() {
    // const generalQAData = [
    //     {
    //         "id": "1",
    //         "question": "How do I submit my article?",
    //         "answer": "This is the first item's accordion body. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
    //     },
    //     {
    //         "id": "2",
    //         "question": "Is there a publication fee associated with submitting to QOAJ?",
    //         "answer": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. "
    //     },
    //     {
    //         "id": "3",
    //         "question": "How much time to take publish the single research paper? ",
    //         "answer": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. "
    //     },
    //     {
    //         "id": "3",
    //         "question": "How can authors track the status of their submitted manuscripts throughout the review process? ",
    //         "answer": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. "
    //     },
    //     {
    //         "id": "3",
    //         "question": "How much time to take publish the single research paper? ",
    //         "answer": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. "
    //     },
    // ];
    const submissionsQAData = [
        {
            "id": "1",
            "question": "How do I submit my article?",
            "answer": "This is the first item's accordion body. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
        },
        {
            "id": "2",
            "question": "Another question?",
            "answer": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. "
        },
    ];
    const publicationQAData = [
        {
            "id": "1",
            "question": "How do I publish my article?",
            "answer": "This is the first item's accordion body. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
        }
    ];

    const response = await fetch(
        `https://web-production-cecc.up.railway.app/api/faqs/`,
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
    const generalQASContainer = document.getElementById("generalQAs");

    generalQASContainer.innerHTML = data.faqs.filter(faq => faq.category === 'GENERAL QUESTIONS').map(faq => `
        <div class="faq accordion-item">
            <h4 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${faq.id}" aria-expanded="false" aria-controls="collapse${faq.id}">
                    <span>${faq.question}</span>
                </button>
            </h4>
            <div class="accordion-collapse collapse" id="collapse${faq.id}">
                <div class="accordion-body">
                    ${faq.answer}
                </div>
            </div>
        </div>
    `).join('');

    const submissionQASContainer = document.getElementById("submissionQAs");

    submissionQASContainer.innerHTML = data.faqs.filter(faq => faq.category === 'SUBMITTING ARTICLES').map(faq => `
        <div class="faq accordion-item">
            <h4 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${faq.id}" aria-expanded="false" aria-controls="collapse${faq.id}">
                    <span>${faq.question}</span>
                </button>
            </h4>
            <div class="accordion-collapse collapse" id="collapse${faq.id}">
                <div class="accordion-body">
                    ${faq.answer}
                </div>
            </div>
        </div>
    `).join('');
}


document.addEventListener('DOMContentLoaded', function () {

    var faqToggles = document.querySelectorAll('.faq-toggle');

    faqToggles.forEach(function (toggle) {

        toggle.addEventListener('click', function () {

            var targetId = toggle.getAttribute('data-target');

            document.querySelectorAll('.main').forEach(function (container) {
                container.style.display = 'none';
            });

            document.getElementById(targetId + '-container').style.display = 'block';
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    var menuItems = document.querySelectorAll('.faq-toggle');

    menuItems.forEach(function (item) {
        item.addEventListener('click', function () {
            var target = this.getAttribute('data-target');
            var formattedTarget = target.replace(/-/g, ' ')
                                        .replace(/\b\w/g, function(char) {
                                            return char.toUpperCase();
                                        });
            document.getElementById('guideline-title').textContent = formattedTarget;
        });
    });
});

function downloadFile(event) {
    
    event.preventDefault();
    var fileUrl = event.target.href;
    var link = document.createElement('a');
    link.href = fileUrl;
    link.download = fileUrl.substring(fileUrl.lastIndexOf('/') + 1);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}