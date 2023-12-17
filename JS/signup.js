$(document).ready(function() {
    $("#form").on("submit", function(event) {
        event.preventDefault();

        const fname = $("#fname").val().trim();
        const mdname = $("#mdname").val().trim();
        const lname = $("#lname").val().trim();
        const email = $("#email").val().trim();
        const password = $("#password").val().trim();
        const genSelect = $("#genSelect").val().trim();
        const bdate = $("#bdate").val().trim();
        const pnumber = $("#pnumber").val().trim();
        const afiliations = $("#afiliations").val().trim();
        const position = $("#position").val().trim();
        const expertise = $("#expertise").val().trim();
        const bio = $("#bio").val().trim();
        const orcid = $("#orcid").val().trim();
        const country = $("#country").val().trim();

        const privacyPolicy = document.getElementById('privacyPolicy');

       


      
       

        if (fname === "" || mdname === "" || lname === "" || email === "" || password === "" || genSelect === "" || bdate === "" || pnumber === "" || position === "" || expertise === "" || bio === "" || orcid === "" || afiliations === "" || country === "" || !privacyPolicy.checked) {
            Swal.fire({
                icon: "warning",
                title: "Ooops...",
                text: "All fields are required",
                customClass: {
                    container: "custom-swal"
                },
                width: 350,
                height: true,
            });
        
        }
        else{
          

            $.ajax({
                type: "POST",
                url: "../php/signup-function.php",
                data: {
                    fname: fname,
                    mdname: mdname,
                    lname: lname,
                    email: email,
                    password: password,
                    genSelect: genSelect,
                    bdate: bdate,
                    pnumber: pnumber,
                    afiliations: afiliations,
                    position: position,                  
                    expertise: expertise,
                    bio: bio,
                    orcid: orcid,
                    country: country
                 
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                   
                    $("#form")[0].reset();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: "Registered Successfuly",
                            customClass: {
                                container: "custom-swal"
                            },
                            width: 350,
                            height: true,
                        });
                    } else {
                        
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: data.error,
                            customClass: {
                                container: "custom-swal"
                            },
                            width: 350,
                            height: true,
                        });
                    }
                }
            });
            
        }

        
    });
});


document.addEventListener('DOMContentLoaded', function () {


    const countryDropdown = document.getElementById('country');

    // Create and append the "Select a country" option
    const defaultOption = document.createElement('option');
    defaultOption.value = ''; // You can set this to an empty string or another appropriate value
    defaultOption.text = 'Select a country';
    countryDropdown.appendChild(defaultOption);
    
    // Fetch and append the countries
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
