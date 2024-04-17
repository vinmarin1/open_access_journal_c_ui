<?php
  include 'functions.php';
  $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
  $urli = isset($_GET['urli']) ? $_GET['urli'] : '';
  if (!empty($urli)) {
    header("Location: " . $urli);
    if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {

    }else{
      header("Location: ../PHP/login.php?urli=" . $urli);
    }  
} 
  else {
    header("Location: ");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Welcome to QCUJ, where you can find the latest articles, and updates on various topics. Explore our diverse collection now!">
  <meta name="keywords" content="QCUJ, Open access Journal, QCUJ">
  <link rel="icon" type="image/png" href="../images/pahina-full.png">
  <title>QCUJ | HOME</title>
  <link rel="stylesheet" href="../CSS/home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <header class="header-container" id="header-container">
  </header>
  <nav class="navigation-menus-container" id="navigation-menus-container">
  </nav>
  <main class="main-content" id="home">
    <div class="content-over">
      <div class="cover-content">
        <div class="mb-3">
        <p>Quezon City University Journals</p>
        <h2  class="mt-2" style="font-size:2.8em !important;">Find or Submit <br/>Research Articles
        </h2>
        <span style="max-width:700px" class="max-w-75 d-md-flex d-none">Welcome to QCUJ! Explore the latest research articles, delve into diverse topics, and stay updated with our dynamic content.</span>
        </div>
          <button class="btn  btn-md" id="btn1" onclick="window.location.href='browse-articles.php'">Browse
            articles</button>
            <?php
              if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
                  $sqlSelectProfile = "SELECT first_name, middle_name, last_name, birth_date, gender, marital_status, orc_id, afiliations, position, field_of_expertise FROM author WHERE author_id = :author_id";

                  $resultProfile = database_run($sqlSelectProfile, array(':author_id' => $author_id));

                  if ($resultProfile) {
                      if (count($resultProfile) > 0) {
                          $userProfile = $resultProfile[0];

                          // Check for the presence of all required fields
                          $requiredFields = ['first_name', 'last_name', 'birth_date', 'gender', 'marital_status', 'orc_id', 'afiliations', 'position', 'field_of_expertise'];

                          $profileComplete = true;
                          foreach ($requiredFields as $field) {
                              if (empty($userProfile->$field)) {
                                  $profileComplete = false;
                                  break;
                              }
                          }
                          if ($profileComplete) {
                            echo "<button class='btn btn-md' id='btn2' onclick='window.location.href=\"ex_submit.php\"'>Submit an Article</button>";
                        } else {
                            echo "<button class='btn btn-md' id='btn2'>Submit an Article</button>";
                            echo "<script>
                                    document.getElementById('btn2').addEventListener('click', function(event){
                                        Swal.fire({
                                            icon: 'warning',
                                            text: 'Please complete the required data in your profile details before submitting a paper'
                                        });
                                    });
                                  </script>";
                        }                        
                      } else {
                          echo "User not found.";
                      }
                  } else {
                      echo "Unable to fetch user info.";
                  }
              } else {
                echo "<button class='btn btn-md' id='btn2' onclick='window.location.href=\"ex_submit.php\"'>Submit an Article</button>";
              }
              ?>


         
      </div>

    </div>

    <div class="fluid-container">
      <div class="recommendation-article">
        <div class="container-fluid  gap-3 p-2 d-flex flex-column flex-xl-row justify-content-center">
          <div class="d-flex flex-column p-2 col-sm-12 col-xl-6">
            <h2>Recently Published Articles</h2>
            
            <div data-animate-in="up" id="recently-added" class="articles-container ">
              <!-- fetch popular articles using api -->
            </div>
          </div>
          <div data-animate-in="up" class="divider "></div>
          <div data-animate-in="up" class="col-sm-12 col-xl-5 d-flex flex-column gap-2" id="most-popular-container">
            <h6 class="text-lg mb-2">
              <select
                class="form-select"
                id="sort-select"
              >
                <option value="total_interactions" selected>Most Popular (All)</option>
                <option value="total_reads">Most Viewed</option>
                <option value="total_downloads">Most Downloaded</option>
                <option value="total_citations">Most Cited</option>
                <option value="total_support">Most Supported</option>
              </select>
            
           
            </h6>
            <div data-animate-in="up" id="most-popular">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
    
    <?php
      $query = "SELECT * FROM announcement WHERE announcementtype = 'Call for papers' AND status = 1";
      $announcements = database_run($query);

      if ($announcements !== false && !empty ($announcements)) {
        foreach ($announcements as $announcement) {
          ?>
          <div class="image-container">
            <img src="../Files/announcement-image/<?php echo $announcement->upload_image; ?>" alt="#" class="image">
            <div class="hover-details text-white">
              <h2>
                <?php echo $announcement->title; ?>
              </h2>
              <p>
                <?php echo $announcement->announcement_description; ?>
              </p>
              <p>
                <?php echo $announcement->announcement; ?>
              </p>
              <span onclick="window.location.href='./announcement.php?id=<?php echo $announcement->announcement_id; ?>'"
                class="button rounded-pill">View Announcement</span>
            </div>
          </div>
          <?php
        }
      } else {
        if ($announcements === false) {
          echo "No announcements available.";
        }
      }
      ?>
    
      <?php
      if (isset ($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
        echo '
        <div class="fluid-container" id="recommendation-section" style="padding: 6em 4%;">
        <div class="recommendation-article">
        <h2>Tailored for You: Based on Your Interactions</h2>
          <div data-animate-in="up" id="recommendations" class="articles-container">
          </div>
          </div>
        </div>
      
        ';
      }
      ?>
    
    <div  class="fluid-container mb-3 qoaj">
      <div class="About-container">
        <div class="ab-qoaj-left d-flex flex-column align-items-center align-items-sm-start gap-1">
          <h2 class="mb-3 text-center w-100">About QCUJ</h2>
            <p class="description">Say goodbye to research submission struggles! QCUJ  is
              a smooth online portal where you can easily submit your research for expert review. </p>
            <!-- <p class="description"><a href="https://qcu.edu.ph/" class="text-white">Quezon City University (QCU)</a>, recognized by the Commission on Higher Education (CHED), holds dear the values of cultivating a vibrant research culture and disseminating new knowledge for the betterment of society. Understanding that the impact of research accessibility, QCU has established the QCUJ as a platform for its researchers to share their valuable findings and contributions.</p> -->
            <p class="description">This website is enhanced by an artificial intelligence and machine learning designed
              for QCUJto improve the user experience. All articles are freely available to download and read, without any
              paywalls or restrictions.</p>
        </div>
        <div data-animate-in="up" class='ab-qoaj-right'>
          <img src="../images/pahina-final-light.png" style=" height:14em" alt="" />
          <img class="d-none d-md-flex" src="../images/qcu-logo.webp" style="width:11em; height:11em" alt="" />
        </div>
      </div>
      <div class="vision-container" style="background-color:#ffff;">
          <h2 class="">Our Vision</h2>
          <p class="text-center text-muted ">Say goodbye to research submission struggles! QCUJ  is
            a smooth online portal <br/>where you can easily submit your research for expert review. </p>
            <br>
            <br>
            <div data-animate-in="up"  class="d-flex flex-column flex-sm-row justify-content-center gap-4 flex-wrap py-3 my-3">
            <?php
              $sql = "
              SELECT 'Articles published' AS label, COUNT(*) AS total
              FROM article
              WHERE status = 1
              UNION ALL
              SELECT 'Total Users' AS label, COUNT(*) AS total
              FROM author
              WHERE status = 1
              UNION ALL
              SELECT 'Total Article Views' AS label, COUNT(*) AS total
              FROM logs
              WHERE type = 'read'
              UNION ALL
              SELECT 'Total Downloads' AS label, COUNT(*) AS total
              FROM logs
              WHERE type = 'download'
              ";

              $results = database_run($sql);
              if ($results !== false) {
                  foreach ($results as $row) {
                      $rounded = round($row->total / 10) * 10;
                      echo "
                      <div class='divider-line-2 d-lg-flex d-none'></div>
                      <div class='total-summary'>
                          <span class='count'>{$rounded}+</span>
                          <span>+</span>
                          <p>{$row->label}</p>
                      </div>
                      ";
                  }
              }
            ?>
            </div>
        </div>
    </div>

    <div data-animate-in="up" class="fluid-container">
      <section id="features-container">
        <div class="text-center w-100">
            <h2 class="">What We Offer</h2>
            <p class=" text-center text-muted "> These are some of the QCUJ features you'll enjoy </p>
        </div>
        <div class="row gap-2 gy-8 gx-md-8 gy-lg-2 gx-xxl-5 justify-content-center justify-sm-content-between">
          <div data-animate-in="up" style="cursor:default; width: 22em" >
            <div class="hover-container">
              <div>
                <img src="../images/peer-reviewed-articles.png" alt="Peer-Reviewed Articles" style="max-width: 100%; height: auto;">
              </div>
              <div class="mb-4 border bg-white p-4 d-flex flex-column justify-content-between">
                <h5 class="mb-3 ">Peer-Reviewed Articles</h5>
                <p class="mb-3 text-secondary"> Explore lots of peer-reviewed articles in different subjects, all checked carefully to make sure they're trustworthy.</p>
                <a href="./browse-articles.php" class="fw-bold text-decoration-none link-primary" style="width: fit-content;">
                  View Articles <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 26 26" fill="currentColor"><path d="M10 6V8H5V19H16V14H18V20C18 20.5523 17.5523 21 17 21H4C3.44772 21 3 20.5523 3 20V7C3 6.44772 3.44772 6 4 6H10ZM21 3V12L17.206 8.207L11.2071 14.2071L9.79289 12.7929L15.792 6.793L12 3H21Z"></path></svg>
                </a>
              </div>
            </div>
          </div>
          <div data-animate-in="up" style="cursor:default; width: 22em">
            <div class="hover-container">
              <div>
                <img src="../images/contribute-articles.png" alt="Peer-Reviewed Articles" style="max-width: 100%; height: auto;">
              </div>
              <div class="mb-4 border bg-white p-4 d-flex flex-column justify-content-between">
                <h5 class="mb-3">Easier Submissions</h5>
                <p class="mb-3 text-secondary">If you're an author, our easy submission process and helpful tools like the AI-based journal classifier and duplicate checker make it simple to send in your work and get it reviewed quickly.</p>
    
                <?php
                  if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
                    echo '
                    <a href="./ex_submit.php" class="fw-bold text-decoration-none link-primary" style="width: fit-content;">
                      Submit an Article <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 26 26" fill="currentColor"><path d="M10 6V8H5V19H16V14H18V20C18 20.5523 17.5523 21 17 21H4C3.44772 21 3 20.5523 3 20V7C3 6.44772 3.44772 6 4 6H10ZM21 3V12L17.206 8.207L11.2071 14.2071L9.79289 12.7929L15.792 6.793L12 3H21Z"></path></svg>
                    </a>
                    
                      '; 
                    } else{
                      echo '
                      <a href="./login.php" class="fw-bold text-decoration-none link-primary">
                        Login to Submit
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                          </path>
                        </svg>
                      </a>
                      
                        '; 
                    }
                  ?>
              </div>
            </div>
          </div>
          <div data-animate-in="up" style="cursor:default; width: 22em">
            <div class="hover-container">
              <div>
                <img src="../images/popularity-based-recommendations.png" alt="Peer-Reviewed Articles" style="max-width: 100%; height: auto;">
              </div>
              <div class="mb-4 border bg-white p-4 d-flex flex-column justify-content-between">
                <h5 class="mb-3">AI & Popularity based Recommendations</h5>
                <p class="mb-3 text-secondary">Experience article discovery with our system's popularity and AI based (personalized and relevant articles) recommendations and suggestions, guiding users to relevant content. </p>
                <a href="#!" class="fw-bold text-decoration-none link-primary" style="width: fit-content;">
                  Check recommendations <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 26 26" fill="currentColor"><path d="M10 6V8H5V19H16V14H18V20C18 20.5523 17.5523 21 17 21H4C3.44772 21 3 20.5523 3 20V7C3 6.44772 3.44772 6 4 6H10ZM21 3V12L17.206 8.207L11.2071 14.2071L9.79289 12.7929L15.792 6.793L12 3H21Z"></path></svg>
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                    </path>
                  </svg> -->
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <section  id="procedure-container">
      <header class="text-center">
        <h2>How to Publish an Article</h2>
        <span>Follow this step and publish your research. For more tutorials visit our  <a href="./tutorials.php">Tutorials page.</a> </span>
      </header>
      <div class="mt-2 procedures flex-lg-row flex-column">
        <div data-animate-in="up"  class="procedure">
          <img src="../images/home-step1.png" alt="Step 1">
          <h5 class="title">1. Submit Paper Online</h5>
        </div>
        <div data-animate-in="up" class="procedure">
          <img src="../images/home-step2.png" alt="Step 2">
          <h5 class="title">2. Peer Review Process</h5>
        </div>
        <div data-animate-in="up" class="procedure">
          <img src="../images/home-step3.png" alt="Step 3">
          <h5 class="title">3. Accepted Paper</h5>
        </div>
        <div data-animate-in="up" class="procedure">
         <img src="../images/home-step4.png" alt="Step 4">
         <h5 class="title">4. Paper Published</h5>
        </div>
      </div>
    </section>
    <!-- <section class="d-none" id="quick-links-container" class="">
      <header>
        <h2>Quick Links</h2>
      </header>
      <div class="quick-links">
        <a href="#" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h5>Check Paper Status</h5>
          </div>
        </a>
        <a href="./guidelines.php#author-guidelines" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h5>Publication Guidelines</h5>
          </div>
        </a>
        <a href="./guidelines.php#become-reviewer" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h5>Reviewer Guidelines</h5>
          </div>
        </a>
        <a href="./guidelines.php#templates-for-author" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h5>Paper Sample Format</h5>
          </div>
        </a>
        <a href="#" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h5>Certification</h5>
          </div>
        </a>
        <a href="donation.php" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h5>Donate to Support</h5>
          </div>
        </a>
      </div>
    </section> -->
    <section  id="faqs-container">
      <header class="text-center">
        <h2>Frequently Asked Questions</h2>
        <span>For a comprehensive list, visit our dedicated <a href="./faqs.php">FAQ page.</a></span>
      </header>
      <div data-animate-in="up" id="top-faqs" class="faqs accordion accordion-flush w-100 d-flex flex-column gap-3">
      
      </div>
      
    </section>
  </main>

<!-- <audio id="myAudio">
  <source src="../sound/iphone_sound.mp3" type="audio/mpeg">
</audio>

<button onclick="playAudio()">Play Audio</button> -->



  <footer class="footer mt-3" id="footer">
  </footer>

  
  <script>





    const sessionId = "<?php echo $author_id; ?>";
    window.addEventListener('scroll', function(e) {
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    if (window.pageYOffset >= (document.querySelector(".total-summary").offsetTop - window.innerHeight)) {
        if (!document.querySelector(".total-summary").classList.contains("animated")) {
            document.querySelectorAll('.count').forEach(function(element) {
                var startCount = 0;
                var endCount = parseInt(element.textContent);
                var duration = 2000;
                var startTime = null;

                function step(timestamp) {
                    if (!startTime) startTime = timestamp;
                    var progress = timestamp - startTime;
                    var percentage = Math.min(progress / duration, 1);
                    element.textContent = numberWithCommas(Math.ceil(startCount + percentage * (endCount - startCount)));
                    if (progress < duration) {
                        window.requestAnimationFrame(step);
                    }
                }

                window.requestAnimationFrame(step);
            });

            // Uncomment if necessary
            // document.getElementById("triggered").classList.add("show");
            document.querySelector(".total-summary").classList.add("animated");
        }
    }
});

  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../JS/reusable-header.js"></script>
  <script src="../JS/home-recommended-api.js"></script>
  <script src="../JS/recently-added-api.js"></script>
  <script src="../JS/most-downloaded-api.js"></script>
  <script src="../JS/home-faqs.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="../JS/animate.js"></script>
  
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