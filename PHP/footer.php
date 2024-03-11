<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./meta.php'); ?>
    <title>Footer</title>
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .links a {
            color:white;
            margin: 5px;
            text-decoration: none;
            font-size: 15px;
            margin: 0 20px 10px 0;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: normal;
        }
    </style>
</head>

<body>
    <div class="text-white" style="background-color:#0858a4; padding: 2em 6%;">
        <div class="row">
            <div class="col-12 col-md-7 d-flex flex-column gap-4">
                <div class="d-flex gap-2 justify-content-center justify-content-md-start">
                    <img class="img-logo" src="../images/qcu-logo.webp" alt="">
                    <div class=" d-flex flex-column gap-1">
                        <h4>QUEZON CITY UNIVERSITY JOURNALS</h4>
                        <a href="https://qcu.edu.ph/" class="text-decoration-none text-white">Quezon City University, Philippines</a>
                    </div>
                </div>
                <div class="links">
                    <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                        <li><a href="index.php">Home</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                About Us
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <li><a class="dropdown-item" style="color: black" href="general-info.php">General
                                        Information</a></li>
                                <li><a class="dropdown-item" style="color: black" href="developers.php">The
                                        Developers</a></li>
                                <li><a class="dropdown-item" style="color: black" href="contact-us.php">Contact Us</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="publication.php">QCU Journals</a></li>

                        <li><a href="announcement.php">Announcements</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Guidelines
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                <li><a class="dropdown-item" style="color: black" href="./guidelines.php">For
                                        Contributors</a></li>
                                <li><a class="dropdown-item" style="color: black" href="./faqs.php">Frequently Asked
                                        Question</a></li>
                            </ul>
                        </li>
                        <li><a href="donation.php">Donation</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-5 d-flex flex-column justify-content-center justify-content-md-start text-center text-md-start">
                <span>Content on this site is licensed under a Creative Commons </span>
                <span class="mb-2 d-none d-sm-flex">Attribution-ShareAlike 4.0 International <a class="text-center text-white"
                        href="https://creativecommons.org/licenses/by-sa/4.0/">(CC BY-SA 4.0) </a>license.
                </span>
                <span>@QCUJ  <?php echo date("Y"); ?></span>
            </div>
        </div>
    </div>
    
</body>

</html>