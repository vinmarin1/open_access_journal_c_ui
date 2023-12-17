
document.addEventListener('DOMContentLoaded', function () {


    
     const myForm = document.getElementById('form');
     const submitButton = document.getElementById('signUpBtn');
 
     myForm.addEventListener('submit', function (event) {
       
         const inputs = myForm.querySelectorAll('input');
         const privacyAgrrement = document.getElementById('privacyPolicy');
         let hasEmptyField = false;
 
         inputs.forEach(function (input) {
             if (input.value.trim() === '') {
                 hasEmptyField = true;
             }
         });
 

         privacyAgrrement.addEventListener('change', function(event) {

         });
       
         if (hasEmptyField) {
             event.preventDefault();
             Swal.fire({
                html: '<h4 style="color: 0858a4;  font-family: Arial, Helvetica, sans-serif;">All filled must be fill</h4>',
                icon: 'warning',
             });
         }else if(hasEmptyField === false && !privacyAgrrement.checked){
            event.preventDefault();
            Swal.fire({
               html: '<h4 style="color: 0858a4;  font-family: Arial, Helvetica, sans-serif;">You must agree with the privacy and policy of the website to proceed</h4>',
               icon: 'warning',
            });
         }
         else{
            Swal.fire({
                html: '<h4 style="color: 0858a4;  font-family: Arial, Helvetica, sans-serif;">Registered Successfuly</h4>',
                icon: 'success',
             });
            inputs.value = '';

         }
     });



    const countryDropdown = document.getElementById('country');

    fetch('https://restcountries.com/v3.1/all')
        .then(response => response.json())
        .then(data => {
           
            data.forEach(country => {
                const option = document.createElement('option');
                option.value = country.name.common;
                option.text = country.name.common;
                countryDropdown.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching country data:', error));

     
});

