const keywordInput = document.querySelector('#keywords');
const keywordsDisplay = document.querySelector('#display-keywords');
const keywordBtn = document.querySelector('#keyword-btn');
const keywordsPreview = document.getElementById('input6');
const keywordsValidation = document.getElementById('keywords-validation');
let keywordArray = []; 

function generateKeywords(keywordInputValue){
    const wordCount = keywordArray.length;
    if (wordCount >= 5) {
        keywordsValidation.style.display = 'block';
    }
    else {
        keywordsValidation.style.display = 'none';
    }
    keywordArray.push(keywordInputValue); 
    keywordsPreview.value = keywordArray.join(',');
    console.log(keywordsPreview.value);
    const span = document.createElement('span');
    span.classList.add('keyTag','border', 'px-2', 'py-1', 'rounded', 'text-white', 'bg-secondary', 'd-flex', 'gap-2');
    span.textContent = keywordInputValue.trim(); 
    
    const deleteIcon = document.createElement('span');
    deleteIcon.innerHTML = '&#10006;'; 
    deleteIcon.classList.add('delete-icon');
    deleteIcon.addEventListener('click', function() {
        span.remove();
        if (wordCount > 5) {
            keywordsValidation.style.display = 'block';
        }
        else {
            keywordsValidation.style.display = 'none';
        }
        keywordArray = keywordArray.filter(keyword => keyword !== keywordInputValue);
    });


    span.appendChild(deleteIcon);
    keywordsDisplay.appendChild(span); 
    
    keywordInput.value = '';
}
function displayKeywords(event){
    let keywordInputValue = keywordInput.value;
    
    if ((event.key === "Enter" || event.keyCode == 13) && keywordInputValue.trim() !== "") {
      generateKeywords(keywordInputValue)
    }
}
function displayKeywordsByClick(event){
    event.preventDefault();
    let keywordInputValue = keywordInput.value;
    if (keywordInputValue.trim() != ""){
        generateKeywords(keywordInputValue);
    }
}

keywordInput.addEventListener("keydown", displayKeywords); 
keywordBtn.addEventListener("click", displayKeywordsByClick); 
document.addEventListener("DOMContentLoaded", function () {

const keywordList = document.querySelector("#keywordList");

fetch('../Helpers/extractedKeywords.json')
.then(response => response.json())
.then(data => {
    data.forEach(keyword => {
        const option = document.createElement("option");
        option.textContent = keyword;
        option.value = keyword;
        keywordList.appendChild(option);
    });
})
.catch(error => {
    console.error('Error fetching JSON:', error);
});

})