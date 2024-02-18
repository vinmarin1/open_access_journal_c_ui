<?php
    include 'functions.php';
    $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | ABOUT</title>
    <link rel="stylesheet" href="../CSS/general-info.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="header-container" id="header-container">
</div>

<nav class="navigation-menus-container" id="navigation-menus-container">
</nav>

<div class="main-content" id="home">
    <div class="content-over">
        <div class="cover-content">
            <p>Home / About Us / General Information</p>
            <h4>General Information</h2>
        </div>
    </div> 
    
    <div class="container-fluid second-container">
        <div class="row">
            <div class="col-md-1"><!------ blank space -------></div>

            <div class="col-md-11 head-text">
                <div class="container-fluid row">
                    <div class="col-md-5 col-12">
                        <h4 class="mt-4" style="color:#F4900C" >We Think, We Research, We Write:</h4>
                        <h4 style="color:#FFFFFF" >Building Knowledge, Uniting Minds!</h4>
                        <hr style="height: 5px; background-color: #F4900C; width: 87%">
                    </div>
                        
                    <p style="text-align: justify;" >Explore, collaborate, and build knowledge together at QCU's Open Access Journal. Join us in uniting minds through research and writing, shaping a vibrant academic community.</p>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-1"> <!------ blank space -------> </div>

        <div class="col-md-6">
            <div class="story" id="ourStory" >
                <h3>OUR STORY</h3>
                <p>In the bustling heart of Quezon City University, a dedicated team known as the Research Management Office (RMO) plays a vital role in nurturing innovation and discovery. Led by a seasoned director, this hub of research activity is divided into three specialized units, each with a distinct mission.  
                <br>
                <br>
                The Publications Unit serves as the voice of QCUs research endeavors, meticulously transforming raw findings into polished journals, reports, and even newsletters. Under their watchful eye, the University's research outputs gain a platform to reach wider audiences and spark dialogue.
                <br>
                <br>
                Meanwhile, the Intellectual Property Unit stands as a guardian of ingenuity. They guide researchers and creators through the complex world of intellectual property rights, ensuring their ideas are protected and nurtured to their full potential. By fostering university-industry partnerships and facilitating technology transfer, they turn research breakthroughs into tangible benefits for both creators and the university.
                <br>
                <br>
                The Center for Quezon City Studies is a hive of passionate detectives, piecing together the city's rich history and vibrant culture. They team up with experts from all over to shine a light on the city's unique soul, sharing their discoveries through books, journals, and lively discussions.
                <br>
                <br>
                Together, these units they empower researchers, protect ideas, and celebrate the city's heritage, all while contributing to the university's vibrant intellectual landscape. Their story is one of dedication, innovation, and a shared passion for pushing the boundaries of knowledge.
            </div>

            <div class="story">
                <h3>WHAT'S DIFFERENCE IN US</h3>
                <p>QCU Journal aims to challenge conventional publication by incorporating technology into the user experience. The journal uses AI features to recommend articles based on the user's reading preferences. More so, we keep track of the trending articles in the data analytics dashboard to provide insights on pressing issues without compromising the system's integrity. To maintain the journal's credibility, the system incorporates plagiarism checkers while suggesting which journal an article belongs to through machine learning. With the open-access journal, we help reach a global audience and bring the most relevant articles to people of different backgrounds. </p>
            </div>
        </div>


        <div class="col-md-4">
            <div class="mt-2 mb-2 img-story">
                <img src="../images/story.png" alt="" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1">  <!------ blank space -------> </div>

        <div class="col-md-11 mb-4">
            <h3 style="color:#115272;" >EXECUTIVE OFFICIALS</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1">  <!------ blank space -------> </div>

        <div class="col-md-3 mb-2 executives text-center">
            <div class="executives-content">
                <img src="../images/principal.png" alt="" class="img-fluid">
                <p class="mt-2">Dr. Theresita V. Atienza</p>
                <p style="background-color: #E5F5FF; font-weight:normal; font-size: medium; ">University President</p>
            </div>
        </div>

        <div class="col-md-1">  <!------ blank space -------> </div>

        <div class="col-md-3 mb-2 executives text-center">
            <div class="executives-content">
                <img src="../images/vice-principal.png" alt="" class="img-fluid">
                <p class="mt-2">Dr. Bradford Antonio C. Martinez</p>
                <p style="background-color: #E5F5FF; font-weight:normal; font-size: medium; ">University Vice-President</p>
            </div>
        </div>

        <div class="col-md-1">  <!------ blank space -------> </div>

        <div class="col-md-3 mb-2 executives text-center">
            <div class="executives-content">
                <img src="../images/OICVP.png" alt="" class="img-fluid">
                <p class="mt-2">Ms. Pia Angelina Tan</p>
                <p style="background-color: #E5F5FF; font-weight:normal; font-size: medium; ">OIC, Vice President for Administration and Finance</p>
            </div>
        </div>

    </div>


    <div class="row mt-5">
        <div class="col-md-1">  <!------ blank space -------> </div>

        <div class="col-md-11 mb-4">
            <h3 style="color:#115272;">PUBLICATION UNIT TEAM</h3>
        </div>
    </div>

    <div class="row">

        <div class="col-md-1">  <!------ blank space -------> </div>

        <div class="col-md-3 mb-3 executives text-center">
            <div class="uniteam-content">
                <img src="../images/Director.jpg" alt="" class="img-fluid">
                <p class="mt-2">Angelito P. Baustista, Jr.</p>
                <p style="background-color: #E5F5FF; font-weight:normal; font-size: medium; "> LPT, MA Comm - Director of Research Management Office</p>
            </div>
        </div>

        <div class="col-md-1">  <!------ blank space -------> </div>

        <div class="col-md-3 mb-3 executives text-center">
            <div class="uniteam-content">
                <img src="../images/assistant.jpg" alt="" class="img-fluid">
                <p class="mt-2">Bernard F. Gaya</p>
                <p style="background-color: #E5F5FF; font-weight:normal; font-size: medium; "> Administrative support assistant
</p>
            </div>
        </div>

        <div class="col-md-1">  <!------ blank space -------> </div>

        <div class="col-md-3 mb-3 executives text-center">
            <div class="uniteam-content">
                <img src="../images/Head-Publication.jpg" alt="" class="img-fluid">
                <p class="mt-2">Candice Erika J. Rudi</p>
                <p style="background-color: #E5F5FF; font-weight:normal; font-size: medium; ">Head of Publication</p>
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