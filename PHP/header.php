<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>Header</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-none d-sm-flex justify-content-between align-items-center align-content-center header" style="padding:0.5em 4%" id="header-container">
        <div class="logotitle d-flex flex-column gap-1"><div>
          <img class="img-logo" src="../images/pahi.png" alt="">
        
          <a href="index.php" style="text-decoration:none;font-size:24px;">AHINA</a>  
          <!-- <span>Unfolding Pages, Enriching Minds</span> -->
          </div>
        </div>
        <div class="d-flex gap-5 align-items-center">
          <a href="donation.php" class="mr-4 d-flex gap-1 align-items-center text-muted" style="text-decoration:none;">
            <span class="text-muted" style="text-decoration:none;cursor:pointer;">SUPPORT US</span>
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
            	<path  d="m12.1 18.55l-.1.1l-.11-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04 1 3.57 2.36h1.86C13.46 6 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05M16.5 3c-1.74 0-3.41.81-4.5 2.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5c0 3.77 3.4 6.86 8.55 11.53L12 21.35l1.45-1.32C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3" />
            </svg> -->
          </a>
          <a href="browse-articles.php" class="mr-4 d-flex gap-1 align-items-center text-muted" style="text-decoration:none;">
            <span class="text-muted" style="text-decoration:none;cursor:pointer;">BROWSE ARTICLES</span>
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 12 12">
            	<path  d="M5 1a4 4 0 1 0 2.452 7.16l2.694 2.693a.5.5 0 1 0 .707-.707L8.16 7.453A4 4 0 0 0 5 1M2 5a3 3 0 1 1 6 0a3 3 0 0 1-6 0" />
            </svg> -->
          </a>
          <a href="ex_submit.php" class="mr-4 d-flex gap-1 align-items-center text-muted" style="text-decoration:none;">
            <span class="text-muted" style="text-decoration:none;cursor:pointer;">SUBMIT AN ARTICLE</span>
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 12 12">
            	<path  d="M5 1a4 4 0 1 0 2.452 7.16l2.694 2.693a.5.5 0 1 0 .707-.707L8.16 7.453A4 4 0 0 0 5 1M2 5a3 3 0 1 1 6 0a3 3 0 0 1-6 0" />
            </svg> -->
          </a>
          <!-- <input
            type="text"
            class="form-control"
            name=""
            id=""
            aria-describedby="helpId"
            placeholder="Browse articles..."
          /> -->
        </div>
        
    </div>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
      <script src="../JS/home.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>
</html>