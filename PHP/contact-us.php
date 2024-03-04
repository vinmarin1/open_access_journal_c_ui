<?php
    include 'functions.php';
    $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./meta.php'); ?>
    <title>QCU PUBLICATION | CONTACT US</title>
    <link rel="stylesheet" href="../CSS/contact-us.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #285581;" >Contact Us</h2>
                    <p style="color: #959595;" >Feel free to contact us any time. We will get back to you as soon as we can.</p>
                </div>
                <div class="col-md-12 fill-info">
                    <label  for="email">Email:</label>
                    <input class="input form-control" type="text" id="email" name="email">

                    <label for="name">Name:</label>
                    <input class="input form-control" type="text" id="name" name="name">

                    <label for="reasons">Reasons:</label>
                    <select class="input form-control"  name="reasons" id="reasons">
                        <option value="volvo">Question</option>
                        <option value="saab">Suggestion</option>
                        <option value="opel">Others</option>
                    </select>

                    <label for="message">Message:</label>
                    <textarea class="input form-control" id="message" name="message" rows="4" ></textarea>
                </div>
                <div class="col-md-12 mt-3 mb-2 btn-info text-center">
                    <button class="btn btn-md" id="btn1" onclick="window.location.href='browse-articles.php'">Browse articles</button>
                </div>
            </div>
        </div>

        <div class="col-md-1"><!-------BLANK SPACE-------></div>

        <div class="col-md-4 ">
            <div class="row contact-info mb-2">
                <div class="col-md-12" style="color: #D9D9D9">
                    <p style="padding: 10px" >You can also contact us in our: </p>
                    <hr style="height: 2px; background-color: #959595; width: 100%">
                </div>

                <div class="col-md-12 mb-4 facebook">
                    <span><i onclick="window.location.href='https://www.facebook.com/QCUREPL'" class="fa-brands fa-facebook-f" style="font-size:20px; color: white"></i></span>
                    <span><a href="https://www.facebook.com/QCUREPL">https://www.facebook.com/QCUREPL</a></span>
                </div>

                <div class="col-md-12 mb-4 number">
                    <span><i class="fa-solid fa-phone" style="font-size:20px; color: white"></i></span>
                    <span><a href="#">645-6133</a></span>
                </div>

                <div class="col-md-12 mb-4 gmail">
                    <span><i onclick="window.location.href='' " class="fa-regular fa-envelope" style="font-size:20px; color: white"></i></span>
                    <span><a href="mailto:repl@qcu.edu.ph">repl@qcu.edu.ph</a></span>
                </div>

                <div class="col-md-12 mb-4 location">
                    <span><i onclick="window.location.href='https://maps.google.com/?q=673+Quirino+Highway,+San+Bartolome,+Novaliches+1116+Quezon+City,+Philippines' " class="fa-solid fa-location-dot" style="font-size:20px; color: white"></i></span>
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
<script src="../JS/reusable-header.js"></script>
</body>

</html>