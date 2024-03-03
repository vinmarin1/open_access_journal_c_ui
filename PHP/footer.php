<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>Footer</title>
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
  <div class="foot" id="footer-container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 d-flex align-items-center gap-3">
            <img class="img-logo" src="../images/qcu-logo.webp" alt="">
            <div class="logotitle-wrapper">
                <div class="logotitle d-flex flex-column gap-1">
                    <a href="https://qcu.edu.ph/" class="text-decoration-none">QUEZON CITY UNIVERSITY</a>
                    <span>OPEN ACCESS JOURNAL</span>
                </div>
            </div>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-3 copyright text-md-right text-center">
            <p class="text-md-right text-center">Content on this site is licensed under a Creative Commons <a href="https://creativecommons.org/licenses/by-sa/4.0/">Attribution-<br>ShareAlike 4.0 International (CC BY-SA 4.0) license.</a></p>
        </div>
      </div>



      <div class="row text-center">
        <div class="col-md-12">
            <div class="links mb-3 text-center">
                <ul class="list-unstyled d-flex flex-column flex-md-row justify-content-md-center">
                    <li><a href="index.php">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" style="color: black" href="general-info.php">General Information</a></li>
                            <li><a class="dropdown-item" style="color: black" href="developers.php">The Developers</a></li>
                            <li><a class="dropdown-item" style="color: black" href="contact-us.php">Contact Us</a></li>
                        </ul>
                    </li>
                    <li><a href="publication.php">QCU Journals</a></li>
                    
                    <li><a href="announcement.php">Announcements</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                            Guidelines
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                            <li><a class="dropdown-item" style="color: black" href="./guidelines.php">For Contributors</a></li>
                            <li><a class="dropdown-item" style="color: black" href="./faqs.php">Frequently Asked Question</a></li>
                        </ul>
                    </li>
                    <li><a href="donation.php">Donation</a></li>
                </ul>
            </div>
        </div>
      </div> 
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>
</html>