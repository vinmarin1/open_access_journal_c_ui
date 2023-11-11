function reusableFiles(url, targetId){
    fetch(url)
        .then(respose => respose.text())
        .then(data => {
            document.getElementById(targetId).innerHTML = data;
        })
        .catch(error => console.error('Error loading' + url + ': ', error));
    
  }

  reusableFiles('../php/header.php', 'header-container');
  reusableFiles('../php/navbar.php', 'navigation-menus-container');
  reusableFiles('../php/footer.php', 'footer');

  

