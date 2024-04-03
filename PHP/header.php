<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../CSS/header.css">
</head>
<body>
  <div class="d-none d-sm-flex header">
      <div class="logo">
          <img class="img-logo" src="../images/pahina-full.png" alt="">
      </div>
      <div class="links">
        <form action="search-articles.php" method="GET" class="form-inline d-flex gap-1" id="searchForm">
          <input id="searchInput" name="search" class="form-control mr-sm-2" type="search" placeholder="Search articles..." aria-label="Search">
          <!-- <button type="submit" class="btn btn-outline-secondary my-2 my-sm-0">Search</button> -->
        </form>
        <a href="donation.php" class="link text-muted">
          <span class="d-none d-lg-flex">SUPPORT US</span>
          <svg  class="d-none d-md-flex d-lg-none" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
          	<path fill="#a8b3b3" d="m12.1 18.55l-.1.1l-.11-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04 1 3.57 2.36h1.86C13.46 6 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05M16.5 3c-1.74 0-3.41.81-4.5 2.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5c0 3.77 3.4 6.86 8.55 11.53L12 21.35l1.45-1.32C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3" />
          </svg>
        </a>
        <a href="ex_submit.php" class="link text-muted">
          <span class="d-none d-md-flex">SUBMIT ARTICLE</span>
        </a>
      </div>
  </div>
</body>
</html>
