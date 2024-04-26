<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../CSS/header.css">
  <!-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> -->
</head>
<body>
  <div class="d-none d-sm-flex header">
      <div class="logo" onclick="window.location.href = 'index.php';" style="cursor:pointer;">
          <img class="img-logo" src="../images/qcuj-final.png" alt="">
      </div>
      <div class="links">
        <form action="search-articles.php" method="GET" class="form-inline d-flex gap-1" id="searchForm">
          <input id="searchInput" name="search" class="form-control mr-sm-2 border-2" type="search" placeholder="Search by title, keyword, author..." aria-label="Search" style="width:300px">
          <!-- <button type="submit" class="btn btn-outline-secondary my-2 my-sm-0">Search</button> -->
        </form>
        <!-- <a href="donation.php" class="link text-muted">
          <span class="d-none d-lg-flex">SUPPORT US</span>
          <svg  class="d-none d-md-flex d-lg-none" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
          	<path fill="#a8b3b3" d="m12.1 18.55l-.1.1l-.11-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04 1 3.57 2.36h1.86C13.46 6 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05M16.5 3c-1.74 0-3.41.81-4.5 2.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5c0 3.77 3.4 6.86 8.55 11.53L12 21.35l1.45-1.32C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3" />
          </svg>
        </a> -->
        <?php
          require 'dbcon.php';
          session_start();


          if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] !== true) {
            echo '<a href="login.php" class="link text-muted">
                    <span class="d-none d-md-flex">SUBMIT ARTICLE</span>
                  </a>';
        } else {
            if ($_SESSION['role'] === 'Admin') {
            } else {
                $id = $_SESSION['id'];
                $sqlSelectProfile = "SELECT first_name, last_name, birth_date, gender, marital_status, orc_id, afiliations, position, field_of_expertise, country FROM author WHERE author_id = :author_id";
                $resultProfile = database_run($sqlSelectProfile, [':author_id' => $id]);
        
                if ($resultProfile && count($resultProfile) > 0) {
                    $userProfile = $resultProfile[0];
        
                    $requiredFields = ['first_name', 'last_name', 'birth_date', 'gender', 'marital_status', 'orc_id', 'afiliations', 'position', 'field_of_expertise', 'country'];
        
                    $profileComplete = true;
                    foreach ($requiredFields as $field) {
                        if (empty($userProfile->$field)) {
                            $profileComplete = false;
                            break;
                        }
                    }
        
                    if (!$profileComplete) {
                        echo '<a href="#" onclick="showAlert();"  class="link text-muted">
                                <span class="d-none d-md-flex">SUBMIT ARTICLE</span>
                              </a>';
                    } else {
                        echo '<a href="ex_submit.php" class="link text-muted">
                                <span class="d-none d-md-flex">SUBMIT ARTICLE</span>
                              </a>';
                    }
                } else {
                    echo 'ERROR: Please provide us your profile details';
                }
            }
        }        
        ?>


      </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  function showAlert() {
      // You can customize the sweet alert here
      Swal.fire({
          icon: 'info',
          title: 'Missing',
          text: 'Please log in to submit an article.'
      });
  }
  </script>

  <!-- <script>

// // Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

// var pusher = new Pusher('cabcad916f55a998eaf5', {
//   cluster: 'ap1'
// });

// var channel = pusher.subscribe('my-channel');
// channel.bind('my-event', function(data) {
//   alert(JSON.stringify(data));
//   console.log("Notif");
// });
</script> -->
</body>
</html>
