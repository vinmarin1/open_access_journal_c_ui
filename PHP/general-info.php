<?php
    include 'functions.php';
    $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./meta.php'); ?>
    <title>Pahina | ABOUT</title>
    <link rel="stylesheet" href="../CSS/general-info.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="header-container" id="header-container">
</div>

<nav class="navigation-menus-container" id="navigation-menus-container">
</nav>
<section class="d-flex flex-column gap-5">
    <img src="../images/who.png"/>
    <h3>OUR STORY</h3>
</section>
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-1"> <!------ blank space -------> </div>

        <div class="col-md-5">
            <div class="story" id="ourStory" >
                <p><span class="story-headline">Research Management Office (RMO) plays a vital role in nurturing innovation and discovery.</span> 
                <br/>
                Led by a seasoned director, this hub of research activity is divided into three specialized units, each with a distinct mission.  
                <br>
                <br>
                <b>The Publications Unit </b> serves as the voice of QCUs research endeavors, meticulously transforming raw findings into polished journals, reports, and even newsletters. Under their watchful eye, the University's research outputs gain a platform to reach wider audiences and spark dialogue.
                <br>
                <br>
                <b>The Intellectual Property Unit </b>stands as a guardian of ingenuity. They guide researchers and creators through the complex world of intellectual property rights, ensuring their ideas are protected and nurtured to their full potential. By fostering university-industry partnerships and facilitating technology transfer, they turn research breakthroughs into tangible benefits for both creators and the university.
                <br>
                <br>
                <b>The Center for Quezon City Studies</b> is a hive of passionate detectives, piecing together the city's rich history and vibrant culture. They team up with experts from all over to shine a light on the city's unique soul, sharing their discoveries through books, journals, and lively discussions.
                <br>
                <br>
                <!-- Together, these units they empower researchers, protect ideas, and celebrate the city's heritage, all while contributing to the university's vibrant intellectual landscape. Their story is one of dedication, innovation, and a shared passion for pushing the boundaries of knowledge. -->
            </div>

            <!-- <div class="story">
                <h2>WHAT'S DIFFERENCE IN US</h2>
                <p>QCU Journal aims to challenge conventional publication by incorporating technology into the user experience. The journal uses AI features to recommend articles based on the user's reading preferences. More so, we keep track of the trending articles in the data analytics dashboard to provide insights on pressing issues without compromising the system's integrity. To maintain the journal's credibility, the system incorporates plagiarism checkers while suggesting which journal an article belongs to through machine learning. With the open-access journal, we help reach a global audience and bring the most relevant articles to people of different backgrounds. </p>
            </div> -->
        </div>


        <div data-animate-in="up" class="col-md-5">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li
                        data-bs-target="#carouselId"
                        data-bs-slide-to="0"
                        class="active"
                        aria-current="true"
                        aria-label="First slide"
                    ></li>
                    <li
                        data-bs-target="#carouselId"
                        data-bs-slide-to="1"
                        aria-label="Second slide"
                    ></li>
                    <li
                        data-bs-target="#carouselId"
                        data-bs-slide-to="2"
                        aria-label="Third slide"
                    ></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img
                            src="../images/story1.jpg"
                            class="w-100 d-block"
                            alt="First slide"
                        />
                    </div>
                    <div class="carousel-item">
                        <img
                            src="../images/story.jpg"
                            class="w-100 d-block"
                            alt="Second slide"
                        />
                    </div>
                    <div class="carousel-item">
                        <img
                            src="../images/story2.jpg"
                            class="w-100 d-block"
                            alt="Third slide"
                        />
                    </div>
                </div>
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselId"
                    data-bs-slide="prev"
                >
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselId"
                    data-bs-slide="next"
                >
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            
        </div>
    </div>
    </div>

    <section>
       <h3  >EXECUTIVE OFFICIALS</h3>
    </section>

    <section data-animate-in="up" class="d-flex justify-content-center flex-wrap gap-3">

            <div class="executives-content">
                <img src="../images/principal.png" alt="" class="img-fluid">
                <p class="mt-2">Dr. Theresita V. Atienza</p>
                <p style="font-weight:normal; font-size: medium; ">University President</p>
            </div>


            <div class="executives-content">
                <img src="../images/vice-principal.png" alt="" class="img-fluid">
                <p class="mt-2">Dr. Bradford Antonio C. Martinez</p>
                <p style="font-weight:normal; font-size: medium; ">University Vice-President</p>
            </div>


            <div class="executives-content">
                <img src="../images/OICVP.png" alt="" class="img-fluid">
                <p class="mt-2">Ms. Pia Angelina Tan</p>
                <p style="font-weight:normal; font-size: medium; ">OIC, Vice President for Administration and Finance</p>
            </div>

    </section>


    <section class="mt-5">
            <h2 >PUBLICATION UNIT TEAM</h2>
    </section>

    <section data-animate-in="up" class="d-flex flex-wrap justify-content-center gap-3">
            <div class="uniteam-content">
                <img src="../images/Head-Publication.jpg" alt="" class="img-fluid">
                <p class="mt-2">Candice Erika J. Rudi</p>
                <p style="font-weight:normal; font-size: medium; ">Head of Publication</p>
            </div>
            <div class="uniteam-content">
                <img src="../images/Director.jpg" alt="" class="img-fluid">
                <p class="mt-2">Angelito P. Baustista, Jr.</p>
                <p style="font-weight:normal; font-size: medium; ">  LPT, MA Comm - Director of Research Management Office
                </p>
            </div>
            <div class="uniteam-content">
                <img src="../images/assistant.jpg" alt="" class="img-fluid">
                <p class="mt-2">Bernard F. Gaya </p>
                <p style="font-weight:normal; font-size: medium; ">Administrative support assistant</p>
            </div>
    </section>









<div class="footer" id="footer">
</div>

<script>
    const sessionId = "<?php echo $author_id; ?>";
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../JS/reusable-header.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../JS/animate.js"></script>
<script>
//  todo: make this code reusable
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