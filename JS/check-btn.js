function updateButtonState() {
    const titleInput = document.getElementById('title');
    const keywordsInput = document.getElementById('keywords');
    const abstractInput = document.getElementById('abstract');
    const referenceInput = document.getElementById('reference');
   
    const formFloat = document.getElementById('form-floating-2');
  
    if (titleInput.value.trim() !== '' && keywordsInput.value.trim() !== '') {
     
      formFloat.style.display = 'inline-block';
    } else {
      
      formFloat.style.display = 'none';
    }
  }
  
  var titleInput = document.getElementById('title');
  var keywordsInput = document.getElementById('keywords');
  var abstractInput = document.getElementById('abstract');
  var referenceInput = document.getElementById('reference');
  
  titleInput.addEventListener('input', updateButtonState);
  keywordsInput.addEventListener('input', updateButtonState);
  abstractInput.addEventListener('input', updateButtonState);
  referenceInput.addEventListener('input', updateButtonState);
  
  