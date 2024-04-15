<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>QCUJ | Journals</title>
    <link rel="stylesheet" href="../CSS/publication.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="header-container" id="header-container">
</header>
<nav class="navigation-menus-container" id="navigation-menus-container">
</nav>

<div class="main-container">
    <div class="content-over">
        <div class="cover-content">
            <p>Home / Journals</p>
            <h2 class="text-center">All Journals</h2>
        </div>
    </div>
    
    <section id="journals" class="d-flex flex-column gap-3">
    </section>
  
</div>




<div class="footer" id="footer">
    <!-- footer will be display here by fetching reusable files -->
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
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
    <script src="../JS/publication.js"></script>
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