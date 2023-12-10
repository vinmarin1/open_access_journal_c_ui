
<?php
  include 'functions.php';
  $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | HOME</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>



<div class="header-container" id="header-container">
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
</nav>

<div class="main-content">
    <div class="content-over">
        <div class="cover-content">
        <p>Quezon City University’s Directory of Journals</p>
        <h2>Find or Submit Open Access Articles</h2>
        </div>
        <button class="btn  btn-md" id="btn1" onclick="window.location.href='browse-articles.php'">Browse articles</button>
    
        <?php 
  if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
    echo '<button class="btn btn-md" id="btn2" onclick="window.location.href=\'ex_submit.php\'">Be a contributor</button>';
  } else {
    echo '<button class="btn btn-md" id="btn2">Be a contributor</button>';
  }
?>



       
    </div>
    
    

<div class="fluid-container">
<div class="recommendation-article">
  <h4>Popular Articles this Month</h4>
  <div id="popular-articles" class="articles-container">
 
  </div>  
  </div>
</div>
<hr style="height: 2px; background-color: #115272; width: 100%">

<?php
  if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
    echo '
      <div class="fluid-container">
      <div class="recommendation-article">
      <h4>Recommendation articles for you</h4>
        <div id="recommendations" class="articles-container">
        </div>
        </div>
      </div>
      </div>
      '; 
  } 
  ?>

<div class="fluid-container mb-3 qoaj">
  <div class="About-container ">
    <div class="ab-qoaj-left">
        <h2 class="mb-3">About QOAJ</h2>
        <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis distinctio, debitis sed dolores iste, deserunt perspiciatis ducimus odio aliquam facere illo, quasi temporibus aut sint est mollitia saepe omnis amet?</p>
        <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis distinctio, debitis sed dolores iste, deserunt perspiciatis ducimus odio aliquam facere illo, quasi temporibus aut sint est mollitia saepe omnis amet?</p>
        <br>
          <button style="background-color: #E56F1F;" class="btn btn-md mt-1">Read More</button>
        <br>
    </div>
  
    <div class="ab-qoaj-right">
      <div class="text1">
      <h4>1,243</h4>
      <p>Articles published</p>
      </div>
      <div class="divider-line-2"></div>

      <div class="text1">
      <h4>89</h4>
      <p>Total Contribution</p>
      </div>
      <div class="divider-line-2"></div>

      <div class="text1">
      <h4>12,093</h4>
      <p>Page Visitors</p>
      </div>
      <div class="divider-line-2"></div>

      <div class="text1">
      <h4>3,668</h4>
      <p>Articles Downloads</p>
      </div>
    </div>
  </div>

</div>
<div class="fluid-container">
<div class="recommendation-container">
          <div class="offer-left">
          <h2 class="mb-3">QAJ OFFER Personalized Recommendations</h2>
          <p class="descript">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maiores similique culpa, molestiae velit quis cumque saepe vel error rerum a totam deleniti, reiciendis, alias perspiciatis et. Facere recusandae fuga voluptate?</p>
         
          <br>
          <button class="btn btn-primary btn-md mt-1">Try it Now</button>
          <br>
          </div>
         
                <div class="divider-line"></div>
                <div id="history" class="offer-right">
                  
                </div> 
                <div class="divider-line"></div>
              <div class="offer-right">
            
              </div> 
        </div>

    </div>
<img src="../images/Papers.png" alt="#" class="image">
<div class="container-fluid">
<h2 class="plans"><b>QOAJ PLANS</b></h2>
  <div class="ex-journal">

  <div class="example-journal">
  <div class="plans-inside">
    <h3><b>Basic</b></h3>
    <br>
    <hr style="height: 2px; background-color: #115272; width: 100%">
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Full access to view abstracts <br>for all articles.</p>
    </div>
    <div style="display: flex; align-items: center;">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Access to monthly popular <br>articles.</p>
    </div>
  </div>
</div>


<div class="example-journal" id="example-mid">
  <div class="plans-inside">
    <h3><b>Package</b></h3>
    <h5><b> PHP 1.00 / credit </b></h5>
    <hr style="height: 2px; background-color: #115272; width: 100%">
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Full access to view abstracts <br>for all articles.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px; " class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Access to monthly popular <br>articles.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Personalized content <br>suggestions.</p>
    </div>

    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">No advertisements.</p>
    </div>

    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Fixed amount of credit <br>points for downloading <br>and submitting articles<br> with no expiration.</p>
    </div>

  </div>
  <div id="btn-price">
    <button class="btn btn-primary btn-md mt-1" onclick="window.location.href='pricing.php'" >See Pricing</button>
  </div>
</div>

<div class="example-journal">
  <div class="plans-inside">
    <h3><b>Pro</b></h3>
    <h5><b>PHP 0.50 / credit</b></h5>
    <hr style="height: 2px; background-color: #115272; width: 100%">
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Full access to view abstracts <br>for all articles.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px; " class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Access to monthly popular <br>articles.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Personalized content <br>suggestions.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">No advertisements.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Fixed amount of credit  points <br>each month. Credits  that are not <br>utilized do not roll over at the end <br> of the month. They are, however, <br> up to 50% less expensive than packages. </p>
    </div>
  </div>
  <div class="btn-price">
    <button class="btn btn-primary btn-md mt-1" onclick="window.location.href='pricing.php'">See Pricing</button>
  </div>
</div>
  </div>
</div>

</div> 




<div class="footer" id="footer">
</div>


    <script>      
      const sessionId = "<?php echo $author_id; ?>";
    </script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
      <script src="../JS/reusable-header.js"></script>
      <script src="../JS/home-recommended-api.js"></script>
      <script src="../JS/home-monthly-api.js"></script>
</body>
</html>