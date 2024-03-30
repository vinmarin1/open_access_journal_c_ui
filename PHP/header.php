<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../CSS/header.css">
</head>
<body>
  <div class="d-none d-sm-flex header">
      <div class="logo">
          <img class="img-logo" src="../images/pahina.png" alt="">
          <a href="index.php" style="text-decoration:none;font-size:24px;">AHINA</a>  
      </div>
      <div class="links">
        <a href="donation.php" class="link text-muted">
          <span>SUPPORT US</span>
        </a>
        <a href="ex_submit.php" class="link text-muted">
          <span>SUBMIT ARTICLE</span>
        </a>
        <form action="search-articles.php" method="GET" class="form-inline d-flex gap-1" id="searchForm">
          <input id="searchInput" name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button type="submit" class="btn btn-outline-secondary my-2 my-sm-0">Search</button>
        </form>
      </div>
  </div>
</body>
</html>
