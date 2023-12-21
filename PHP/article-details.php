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
  <div id="citation-container" class="d-none">
    <div id="citations" class="d-flex flex-column justify-content-between">
      <div class="citation-header d-flex justify-content-between">
        <h2>Citations</h2>  
        <button id="closeCiteModal" class="btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="m8 8.707l3.646 3.647l.708-.707L8.707 8l3.647-3.646l-.707-.708L8 7.293L4.354 3.646l-.707.708L7.293 8l-3.646 3.646l.707.708z" clip-rule="evenodd"/></svg>
        </button>
      </div>
      <select>
        <option value="APA">APA citation</option>
        <option value="MLA">MLA citation</option>
        <option value="Chicago">Chicago citation</option>
      </select>
      <div class="" id="citation-content">

      </div>
      <div class="citeation-footer d-flex justify-content-end gap-2">
        <button class=" cite-btn">Inline Citation</button>
        <button class=" cite-btn" id="copy-btn">Copy Reference</button>
      </div>
    </div>
  </div>

  <?php
  $active = check_login(false);
  echo '<script>const active = ' . ($active ? 'true' : 'false') . ';</script>';
  ?>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../JS/reusable-header.js"></script>
  <script src="../JS/home-recommended-api.js"></script>
  <script src="../JS/home-monthly-api.js"></script>
  <script src="../JS/article-details-api.js"></script>
</body>

</html>

<script></script>