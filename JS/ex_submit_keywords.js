const keywordInput = document.querySelector('#keywords');
const keywordsDisplay = document.querySelector('#display-keywords');
let keywordArray = []; 


function displayKeywords(event){
    const keywordsPreview = document.getElementById('input6');

    let keywordInputValue = keywordInput.value;
    if ((event.key === "Enter" || event.keyCode == 13) && keywordInputValue !== "") {
        
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
            keywordArray = keywordArray.filter(keyword => keyword !== keywordInputValue);
        });


        span.appendChild(deleteIcon);
        keywordsDisplay.appendChild(span); 
        
        keywordInput.value = '';
        
    }
    
}

keywordInput.addEventListener("keypress", displayKeywords); 
keywordInput.addEventListener("keydown", displayKeywords); 
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