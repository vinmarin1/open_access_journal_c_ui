function reusableFiles(url, targetId){
    fetch(url)
        .then(respose => respose.text())
        .then(data => {
            document.getElementById(targetId).innerHTML = data;
        })
        .catch(error => console.error('Error loading' + url + ': ', error));
    
  }

  reusableFiles('../PHP/header.php', 'header-container');
  reusableFiles('../PHP/navbar.php', 'navigation-menus-container');
  reusableFiles('../PHP/footer.php', 'footer');
  

