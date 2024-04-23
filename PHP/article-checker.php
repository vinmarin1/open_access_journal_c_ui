<?php
  include 'functions.php';
  $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('./meta.php'); ?>
  <title>QCUJ | Article Checker</title>
  <meta property="og:title" content="QCUJ | ARTICLE DETAILS">
  <meta property="og:description" content="Explore groundbreaking research at QCU with this in-depth article. Gain insights into innovative studies, findings, and academic contributions that shape the intellectual landscape. Stay informed about the latest discoveries in various fields presented in this comprehensive QCU research article. #QCUResearch #AcademicExcellence">
  <meta property="og:image" content="https://www.google.com/url?sa=i&url=https%3A%2F%2Fqcu.edu.ph%2F&psig=AOvVaw1F8jT0VsKUyfOBiTvO5pDV&ust=1706257892464000&source=images&cd=vfe&opi=89978449&ved=0CBMQjRxqFwoTCMDRto6Q-IMDFQAAAAAdAAAAABAE">
  <meta property="og:url" content="https://openaccessjournalcui-production.up.railway.app/PHP/index.php">

  <meta name="description" content="QCU Article Preview">

  <link rel="stylesheet" href="../CSS/home.css">
  <link rel="stylesheet" href="../CSS/index.css">
  <!-- <link rel="stylesheet" href="../CSS/index.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <header class="header-container" id="header-container">
    <!-- header will be display here by fetching reusable files -->
  </header>

  <nav class="navigation-menus-container" id="navigation-menus-container">
    <!-- navigation menus will be display here by fetching reusable files -->
  </nav>
  <div class="content-over" style="height:10em !important">
        <div class="cover-content">
            <!-- <p>Home / Journal and RRL Finder</p> -->
            <h2 class="">Journal Classifier for your research</h2>
            <span>Enter your title, abstract, and let our AI-driven engine do the rest. </span>
            
        </div>
  </div>
  <main class="main-container" id="article_details" style="padding:2% 8%">
    <div class="card p-4" >
    <div class="mb-3">
      <label for="" class="form-label"><b>Title</b></label>
      <input
        type="text"
        class="form-control form-control-sm"
        name=""
        id="title"
        aria-describedby="helpId"
        placeholder=""
      />
   
    </div>
    <div class="mb-3">
      <label for="" class="form-label"><b>Abstract or Summary of the Paper</b></label>
      <textarea
        type="text"
        class="form-control form-control-sm"
        name=""
        id="abstract"
        aria-describedby="helpId"
        placeholder=""
      ></textarea>
   
    </div>
    <div class="d-none mb-3">
      <label for="" class="form-label"><b>Abstract</b></label>
      <input
        type="text"
        class="form-control form-control-sm"
        name=""
        id="any"
        aria-describedby="helpId"
        placeholder=""
      />
   
    </div>
    <button type="button" name="" id="check" class="btn btn-primary w-50">Check article</button>
    </div>
  </main>
  <?php
  $active = check_login(false);
  echo '<script>const active = ' . ($active ? 'true' : 'false') . ';</script>';
  ?>

  <div class="fluid-container">
    <div class="recommendation-article" style="padding:2% 8%">
      <div class="d-flex flex-column gap-2 pb-2 w-100">
        <h4 class="mb-3">Journal Results: <small> <span class="text-muted" id="rank"></span></small></h4>
        <div class="card d-flex flex-row p-4 mt-2 mb-4 gap-4" id="journal-results">
          <div class="article" id="gavelCont">
            <h5 style="text-align:center" id="gavelRound"></h5>
            <h6 id="gavel" style="text-align:center"></h6>
            
            <p style="text-align:center">The Gavel</p>
            
          </div>
          <div class="article" id="lampCont">
            <h5 style="text-align:center" id="lampRound"></h5>
          
            <h6 id="lamp" style="text-align:center"></h6>
            <p style="text-align:center">The Lamp</p>
            
            
          </div>
          <div class="article" id="starCont">
            <h5 style="text-align:center" id="starRound"></h5>
          
            <h6 style="text-align:center" id="star"></h6>
            <p style="text-align:center">The Star</p>
          </div>
        </div>
        <h4 class="mt-4">Similar Articles:</h4>
        
        <div id="similar-articles" class="articles-container " style="width:85vw !important;">

        </div>

      </div>
 
    </div>
  </div>



  <footer class="footer" id="footer">
    <!-- footer will be display here by fetching reusable files -->
  </footer>
  <script>
    const sessionId = "<?php echo $author_id; ?>";
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  function showAlert() {
    Swal.fire({
      icon: 'info',
      title: 'Profile Incomplete',
      text: 'Please complete the required details in profile to submit article'
    });
  }
  </script>
  <script src="../JS/reusable-header.js"></script>
  <script src="../JS/home-recommended-api.js"></script>
  <script src="../JS/cloudConvert.js"></script>
  <script src="../JS/article-checker.js"></script>
  <script src="../JS/most-popular-api.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
function includeNavbar() {
  fetch('../PHP/navbar.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('navigation-menus-container').innerHTML = data;
      // Now that the content is loaded, you can attach event listeners or perform other operations as needed
      // For example, you can attach the notification button click event listener here
      attachNotificationButtonListener();
      playAudio();
    })
    .catch(error => console.error('Error loading navbar.php:', error));
}
// function playAudio() {
//   var x = document.getElementById("myAudio");
//   x.play();
// }


function attachNotificationButtonListener() {
  $(document).on('click', '#notification-button', function () {
    $("#notification-count").text("0");
    $("#notification-count").hide();
     
    // Send AJAX request to mark notifications as read
    $.ajax({
      url: "../PHP/mark_notifications_read.php",
      type: "POST",
      data: { author_id: <?php echo $_SESSION['id']; ?> },
      success: function (response) {
        console.log("Notifications marked as read:", response);
        // Update notification count on success
        // $("#notification-count").text("0");
        // $("#notification-count").hide();

      },
      error: function (xhr, status, error) {
        console.error("Error marking notifications as read:", error);
      }
    });
  });
}

// Call includeNavbar function to load navbar.php content
includeNavbar();


  </script>
</body>

</html>

<script></script>