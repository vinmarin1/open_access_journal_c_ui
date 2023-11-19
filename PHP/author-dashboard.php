<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | AUTHOR DASHBOARD</title>
    <link rel="stylesheet" href="../CSS/author-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="header-container" id="header-container">
<!-- header will be display here by fetching reusable files -->
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
<!-- navigation menus will be display here by fetching reusable files -->
</nav>

<div class="main-container">
    <div class="content-over">
        <div class="cover-content">
        <h3><strong>Hello,</strong><br>
    <?php
    if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
        $firstName = isset($_SESSION['first_name']) ? ucfirst($_SESSION['first_name']) : '';
        $middleName = isset($_SESSION['middle_name']) ? ' ' . ucfirst($_SESSION['middle_name']) : '';
        $lastName = isset($_SESSION['last_name']) ? ' ' . ucfirst($_SESSION['last_name']) : '';
       
        echo $firstName . $middleName . $lastName;
    }
    ?>
</h3>


        </div>
        <button class="btn tbn-primary btn-md" id="btn2" onclick="window.location.href='author-dashboard.php'">As Author</button>
        <button class="btn tbn-primary btn-md" id="btn2" onclick="window.location.href='reviewer-dashboard.php'">As Reviewer</button>
    </div>
    <div class="dashboard">
  <div class="status-boxes">
    <div class="status-box pending">
      <div class="status-label">Pending</div>
      <div class="status-value">0</div>
    </div>
    <div class="status-box publish">
      <div class="status-label">Publish</div>
      <div class="status-value">0</div>
    </div>
    <div class="status-box declined">
      <div class="status-label">Declined</div>
      <div class="status-value">0</div>
    </div>
    <div class="status-box total-views">
      <div class="status-label">Total Views</div>
      <div class="status-value">0</div>
    </div>
  </div>
  <div class="contribution-section">
    <div class="contribution-text">
      <h2>Be the best Author and be our Contributor</h2>
      <p>All of our journals are handled by dedicated Editors who are active in the specific communities they serve and are discoverable in the COU students and others School to spread related articles of what they are looking for.</p>
    </div>
	<div class="vertical-line"></div>
    <div class="contribution-actions">
    <button class="rounded-button" onclick="window.location.href='browse-articles.php'">Browse Articles</button>
    <button class="rounded-button" onclick="window.location.href='timeline.php'">Be a Contributer</button>
    <button class="rounded-button " onclick="window.location.href='reviewer-dashboard.php'">For Reviewer</button>
    </div>
  </div>
</div>


<div class="fluid-container">
<div class="recommendation-article">
<h4><strong>Your Published Articles</strong></h4>
  <div class="articles-container">
  <div class="article">
  <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
    <div class="article-info">
      <p class="info">THE LAMP</p>
      <span class="views"></span>103 views
    </div>
    <p class="author">By Jane Delacruz</p>
    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
    background-color: transparent;
    border-radius: 20px;
    color: #115272;
    width: 100%;">Read Article</button>
  </div>
  <div class="article">
  <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
    <div class="article-info">
      <p class="info">THE LAMP</p>
      <span class="views"></span>103 views
    </div>
    <p class="author">By Jane Delacruz</p>
    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
    background-color: transparent;
    border-radius: 20px;
    color: #115272;
    width: 100%;">Read Article</button>
  </div>

  <div class="article">
  <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
    <div class="article-info">
      <p class="info">THE LAMP</p>
      <span class="views"></span>103 views
    </div>
    <p class="author">By Jane Delacruz</p>
    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
    background-color: transparent;
    border-radius: 20px;
    color: #115272;
    width: 100%;">Read Article</button>
  </div>

  <div class="article">
  <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
    <div class="article-info">
      <p class="info">THE LAMP</p>
      <span class="views"></span>103 views
    </div>
    <p class="author">By Jane Delacruz</p>
    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
    background-color: transparent;
    border-radius: 20px;
    color: #115272;
    width: 100%;">Read Article</button>
  </div>

  <div class="article">
  <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
    <div class="article-info">
      <p class="info">THE LAMP</p>
      <span class="views"></span>103 views
    </div>
    <p class="author">By Jane Delacruz</p>
    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
    background-color: transparent;
    border-radius: 20px;
    color: #115272;
    width: 100%;">Read Article</button>
  </div>

  
  
  </div>
</div>
</div>



<div class="footer" id="footer">
    <!-- footer will be display here by fetching reusable files -->
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../JS/reusable-header.js"></script>
</body>
</html>