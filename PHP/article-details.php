<?php
  include 'functions.php';
  $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QCU PUBLICATION | ARTICLE DETAILS</title>
  <link rel="stylesheet" href="../CSS/article-details.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="header-container" id="header-container">
    <!-- header will be display here by fetching reusable files -->
  </div>

  <nav class="navigation-menus-container" id="navigation-menus-container">
    <!-- navigation menus will be display here by fetching reusable files -->
  </nav>

  <div class="main-container" id="article_details">
  </div>

  <?php
  $active = check_login(false);
  echo '<script>const active = ' . ($active ? 'true' : 'false') . ';</script>';
  ?>

  <!-- 
<hr style="height: 2px; background-color: #0858a4 "> -->
  <div class="fluid-container">
    <div class="recommendation-article">
      <h4>More like this</h4>
      <div id="similar-articles" class="articles-container">

      </div>
    </div>
  </div>
  <?php
    if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true ){  
      echo '

    <div class="fluid-container">
      <div class="recommendation-article">
        <h4>Recommended for You</h4>
        <div id="recommendations" class="articles-container">

        </div>

      </div>
    </div>
    ';
    }
  ?>
  </div>
  </div>

  <div class="footer" id="footer">
    <!-- footer will be display here by fetching reusable files -->
  </div>
  <script>
    const sessionId = "<?php echo $author_id; ?>";
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="../JS/reusable-header.js"></script>
  <script src="../JS/home-recommended-api.js"></script>
  <script src="../JS/home-monthly-api.js"></script>
  <script src="../JS/article-details-api.js"></script>
</body>

</html>

<script></script>