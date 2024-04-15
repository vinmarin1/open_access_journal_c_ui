<?php
session_start();
$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./meta.php'); ?>
    <title>QCUJ | Indexing</title>
    <link rel="stylesheet" href="../CSS/indexing.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <header class="header-container" id="header-container">

    </header>

    <nav class="navigation-menus-container" id="navigation-menus-container">

    </nav>

    <div class="content-over">
        <div class="cover-content">
            <p>Home / Indexing</p>
            <h1 class="d-flex flex-column gap-1">
                QCUJ Indexing
                <span class="w-50">Advancing Science and Technology: A Commitment to Quality through Quezon City University's Pioneering Open Access Journal</span>
            </h1>
        </div>
    </div>

    <main id="indexing-container" class="d-flex flex-column gap-4">
      <h2>We are Indexed or Abstracted at:</h2>
      <div class="d-flex flex-wrap gap-4 border rounded w-100 p-4 min-w-50">
        <a href="https://scholar.google.com/" target="_blank">
            <div class="index rounded">
                <img class="img-fluid " src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Google_Scholar_logo_2015.PNG?20150923212704" alt="">
                <h3>Google Scholar</h3>
            </div>
        </a>

      </div>
    </main>

    <div class="footer" id="footer">

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../JS/reusable-header.js"></script>

    <script src="../JS/faqs.js"></script>
</body>

</html>