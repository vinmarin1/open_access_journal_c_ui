<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>Pahina | TESTING</title>
    <link rel="stylesheet" href="../CSS/testing.css">
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
        <button class="btn tbn-primary btn-md" id="btn2">As Reviewer</button>
        <button class="btn tbn-primary btn-md" id="btn2">As Reviewer</button>
    </div>
</div> 


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Outline on Side Only</title>
<style>
    .outline-side {
        width: 200px;
        height: 100px;
        background-color: #f0f0f0;
        border-right: 2px solid blue; /* Example of applying outline only to the right side */
        /* You can change 'border-right' to 'border-left', 'border-top', or 'border-bottom' for different sides */
    }
</style>
</head>
<body>

<div class="outline-side">
    This is a box with outline only on the right side.
</div>

</body>
</html>




<div class="footer" id="footer">
  
</div>


      <script>
          const sessionId = "<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 0; ?>";
       </script>  
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
      <script src="../JS/reusable-header.js"></script>
      <script src="../JS/home-recommended-api.js"></script>
      <script src="../JS/home-monthly-api.js"></script>
</body>
</html>