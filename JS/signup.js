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
        const sclname = $("#sclname").val().trim();
        const expertise = $("#expertise").val().trim();
        const bio = $("#bio").val().trim();
        const orcid = $("#orcid").val().trim();
        const orcidUrl = $("#orcidUrl").val().trim();

        if (fname === "" || mdname === "" || lname === "" || email === "" || password === "" || genSelect === "" || bdate === "" || pnumber === "" || sclname === "" || expertise === "" || bio === "") {
            Swal.fire({
                icon: "warning",
                title: "Ooops...",
                text: "All feilds are required",
                customClass: {
                    container: "custom-swal"
                },
                width: 350,
                height: true,
            });
        
        }else {
          

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
                    sclname: sclname,
                    expertise: expertise,
                    bio: bio,
                    orcid: orcid,
                    orcidUrl: orcidUrl
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
