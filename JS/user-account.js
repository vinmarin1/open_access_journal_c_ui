document.getElementById('changeModeBtn2').addEventListener('click', function (event) {
    Swal.fire({
        icon: 'question',
        text: 'Switch to private mode?',
        showCancelButton: true,
        showConfirmButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            var xhr = new XMLHttpRequest();

            xhr.open('POST', '../PHP/public_account.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert('Account mode changed to Private');
                    window.location.href= '../PHP/user-dashboard.php';
                  
                }
            };

            xhr.send();
        }
    });
});










