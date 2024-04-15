<?php
    include 'functions.php';
    $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./meta.php'); ?>
    <title>QCUJ | CONTACT US</title>
    <link rel="stylesheet" href="../CSS/contact-us.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

<div class="header-container" id="header-container">
</div>

<nav class="navigation-menus-container" id="navigation-menus-container">
</nav>


<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-2"><!-------BLANK SPACE-------></div>
        <div class="col-md-3 ">
            <form id="contactForm" method="POST" action="../PHP/contact-backend.php">
                <div class="row">
                    <div class="col-md-12">
                        <h2 >Contact Us</h2>
                        <p style="color: #959595;" >Feel free to contact us any time. We will get back to you as soon as we can.</p>
                    </div>
                    
                    <div class="col-md-12 fill-info">
                        <label  for="email">Email:</label>

                        <?php
                        if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
                            // Assuming $id is defined somewhere
                            $id = $_SESSION['id']; // Assuming you have the author_id in your session
                            
                            // Assuming your database_run function is defined and works correctly
                            $sqlSelectEmail = "SELECT email FROM author WHERE author_id = :author_id";
                            $result = database_run($sqlSelectEmail, array(':author_id' => $id));

                            if ($result) {
                                if (count($result) > 0) {
                                    $user = $result[0];
                                    $email = $user->email;
                                    // Display the email input field with the retrieved email
                                    echo '<input type="text" id="email" name="email" class="input form-control" value="' . $email . '" required>';
                                } else {
                                    echo "User not found.";
                                }
                            } else {
                                echo "Unable to fetch user info.";
                            }
                        } else 
                            echo '<input class="input form-control" type="text" id="email" name="email" required>'
                        
                        ?>
                        <label for="name">Name:</label>

                        <?php
                        if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
                            $sqlSelectName = "SELECT first_name, last_name FROM author WHERE author_id = :author_id";
                            $result = database_run($sqlSelectName, array(':author_id' => $id));

                            if ($result) {
                                
                                if (count($result) > 0) {
                                    $user = $result[0];
                                    $firstName = $user->first_name;
                                    $lastname = $user->last_name;
                                
                                    echo '<input class="input form-control" type="text" id="name" name="name" value="' . $firstName . " " .$lastname .'" required>';

                    
                                } else {
                                    echo "User not found.";
                                }
                            } else {
                                echo "Unable to fetch user info.";
                            }
                        } else 
                            echo '<input class="input form-control" type="text" id="name" name="name" required>'
                        ?>

                        

                        <label for="reason">Reasons:</label>
                        <select class="input form-control"  name="reason" id="reason" required>
                            <option value="Question">Question</option>
                            <option value="Suggestion">Suggestion</option>
                            <option value="Others">Others</option>
                        </select>

                        <label for="message">Message:</label>
                        <textarea class="input form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    
                    <div class="col-md-12 mt-3 mb-2 btn-info text-center">
                        <button type="submit" class="btn btn-md" id="btn1">Submit</button>
                    </div>

                    <script>
                        document.getElementById("contactForm").addEventListener("submit", function(event) {
                            event.preventDefault();
                            
                            Swal.fire({
                                title: 'Submitted!',
                                text: 'Your message has been submitted.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                                                        
                            setTimeout(function() {
                                document.getElementById("contactForm").submit();
                            }, 3000); // Adjust the timeout as needed
                        });
                    </script>
                </div>
            </form>
        </div>

        <div class="col-md-1"><!-------BLANK SPACE-------></div>

        <div class="col-md-4 ">
            <div class="row contact-info mb-2">
                <div class="col-md-12" style="color: #D9D9D9">
                    <p style="padding: 10px" >You can also contact us in our: </p>
                    <hr style="height: 2px; background-color: #959595; width: 100%">
                </div>

                <div class="col-md-12 mb-3 facebook">
                    <span><i onclick="window.location.href='https://www.facebook.com/QCUREPL'" class="fa-brands fa-facebook-f" style="font-size:14px; color: white"></i></span>
                    <span><a href="https://www.facebook.com/QCUREPL">https://www.facebook.com/QCUREPL</a></span>
                </div>

                <div class="col-md-12 mb-3 number">
                    <span><i class="fa-solid fa-phone" style="font-size:14px; color: white"></i></span>
                    <span><a href="#">645-6133</a></span>
                </div>

                <div class="col-md-12 mb-3 gmail">
                    <span><i onclick="window.location.href='' " class="fa-regular fa-envelope" style="font-size:14px; color: white"></i></span>
                    <span><a href="mailto:repl@qcu.edu.ph">repl@qcu.edu.ph</a></span>
                </div>

                <div class="col-md-12 mb-3 location">
                    <span><i onclick="window.location.href='https://maps.google.com/?q=673+Quirino+Highway,+San+Bartolome,+Novaliches+1116+Quezon+City,+Philippines' " class="fa-solid fa-location-dot" style="font-size:14px; color: white"></i></span>
                    <span><a href="https://maps.google.com/?q=673+Quirino+Highway,+San+Bartolome,+Novaliches+1116+Quezon+City,+Philippines">673 Quirino Highway, San Bartolome, Novaliches 1116 Quezon City, Philippines</a></span>
                </div>

                <div class="col-md-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.2200353739413!2d121.03112607457457!3d14.700145174632786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0d8a1abaadd%3A0x493213e5711bfe3d!2sQ.C.P.U%20Technical%20%26%20Vocational!5e0!3m2!1sen!2sph!4v1709320928704!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

</div>




<div class="footer" id="footer">
</div>

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
      })
      .catch(error => console.error('Error loading navbar.php:', error));
  }

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