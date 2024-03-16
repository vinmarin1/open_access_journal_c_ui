<?php
  include 'functions.php';
  $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Welcome to QCU Journals, where you can find the latest articles, and updates on various topics. Explore our diverse collection now!">
  <meta name="keywords" content="QCU Publication, Open access Journal, QCUJ">
  <link rel="icon" type="image/png" href="../images/qcu-logo.webp">
  <title>QCU PUBLICATION | HOME</title>
  <link rel="stylesheet" href="../CSS/home.css">
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
        <div>
        <p>Quezon City University’s Journals</p>
        <h2>Find or Submit Research Articles
        </h2>
        <span class="max-w-75 d-md-flex d-none">Welcome to QCU Journals! Explore the latest research articles, delve into diverse topics, and stay updated with our dynamic content.</span>
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
            
            <div id="recently-added" class="articles-container ">
              <!-- fetch popular articles using api -->
            </div>
          </div>
          <div class="divider "></div>
          <div class="col-sm-12 col-xl-5 d-flex flex-column gap-2" id="most-popular-container">
            <h6 class="text-lg mb-2">
              <select
                class="form-select"
                id="sort-select"
              >
                <option value="total_interactions" selected>Most Popular (All)</option>
                <option value="total_reads">Most Viewed</option>
                <option value="total_downloads">Most Downloaded</option>
                <option value="total_citations">Most Cited</option>
              </select>
            
           
            </h6>
            <div id="most-popular">
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
                class="button">View Announcement</span>
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
        <div class="fluid-container" id="recommendation-section" style="padding: 2em 4%;">
        <div class="recommendation-article">
        <h2>Tailored for You: Based on Your Interactions</h2>
          <div id="recommendations" class="articles-container">
          </div>
          </div>
        </div>
      
        ';
      }
      ?>
    
    <div class="fluid-container mb-3 qoaj">
      <div class="About-container">
        <div class="ab-qoaj-left d-flex flex-column align-items-center align-items-sm-start gap-1">
          <h2 class="mb-3 text-center w-100">About QCUJ</h2>
            <p class="description">Say goodbye to research submission struggles! Quezon City University Journals (QCUJ) is
              a smooth online portal where you can easily submit your research for expert review. </p>
            <!-- <p class="description"><a href="https://qcu.edu.ph/" class="text-white">Quezon City University (QCU)</a>, recognized by the Commission on Higher Education (CHED), holds dear the values of cultivating a vibrant research culture and disseminating new knowledge for the betterment of society. Understanding that the impact of research accessibility, QCU has established the QCU Journals as a platform for its researchers to share their valuable findings and contributions.</p> -->
            <p class="description">This website is enhanced by an artificial intelligence and machine learning designed
              for QCUJto improve the user experience. All articles are freely available to download and read, without any
              paywalls or restrictions.</p>
  
            <!-- <br>
            <button style="background-color: #e56f1f; max-width:20em;" class="btn btn-md mt-1 w-100">See Features</button>
            <br>
            <div class="d-flex">
              <?php
              $sql = "SELECT COUNT(*) AS total FROM article WHERE status = 1";
              $total = database_run($sql);

              if ($total !== false) {
                echo "
                <div class='text1'>
                  <h2>{$total[0]->total}</h2>
                  <p>Articles published</p>
                </div>";
              }
              ?>
              <?php
              $sql_users = "SELECT COUNT(*) AS total FROM author WHERE status = 1";
              $total = database_run($sql_users);
              if ($total !== false) {
                echo "
                <div class='divider-line-2 d-lg-flex d-none'></div>
                  <div class='text1'>
                    <h2>{$total[0]->total}</h2>
                    <p>Total Users</p>
                  </div>
                ";
              }
              ?>
            </div> -->
        </div>
        <div class='ab-qoaj-right'>
          <img src="../images/qcuj.png" style="width:16em; height:16em" alt="" />
          <img src="../images/qcu-logo.webp" style="width:11em; height:11em" alt="" />
        </div>
      </div>
      <div class="vision-container" style="background-color:#ffff;">
          <h2 class="">Our Vision</h2>
          <p class="text-center text-muted ">Say goodbye to research submission struggles! Quezon City University Journals (QCUJ) is
            a smooth online portal <br/>where you can easily submit your research for expert review. </p>
            <!-- <p class="description"><a href="https://qcu.edu.ph/" class="text-white">Quezon City University (QCU)</a>, recognized by the Commission on Higher Education (CHED), holds dear the values of cultivating a vibrant research culture and disseminating new knowledge for the betterment of society. Understanding that the impact of research accessibility, QCU has established the QCU Journals as a platform for its researchers to share their valuable findings and contributions.</p> -->
         
            <br>
            <!-- <button style="background-color: #e56f1f; max-width:20em;" class="btn btn-md mt-1 w-100">See Features</button> -->
            <br>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-4 flex-wrap py-3 my-3">
              <?php
              $sql = "SELECT COUNT(*) AS total FROM article WHERE status = 1";
              $total = database_run($sql);

              if ($total !== false) {
                $rounded = round($total[0]->total / 10) * 10;
                echo "
                <div class='total-summary'>
                  <span>{$rounded}+</span>
                  <p>Articles published</p>
                </div>";
              }
              ?>
              <?php
              $sql_users = "SELECT COUNT(*) AS total FROM author WHERE status = 1";
              $total = database_run($sql_users);
              if ($total !== false) {
                $rounded = round($total[0]->total / 10) * 10;
                echo "
                <div class='divider-line-2 d-lg-flex d-none'></div>
                  <div class='total-summary'>
                    <span>{$rounded}+</span>
                    <p>Total Users</p>
                  </div>
                ";
              }
              ?>
               <?php
                $sql_views = "SELECT COUNT(*) AS total FROM logs WHERE type = 'read'";
                $total = database_run($sql_views);
                if ($total !== false) {
                  $rounded = round($total[0]->total / 10) * 10;
                  echo "
                  <div class='divider-line-2 d-lg-flex d-none'></div>
                    <div class='total-summary'>
                      <span>{$rounded}+</span>
                      <p>Total Article Views</p>
                    </div>
                  ";
                }
              ?>
             <?php
              $sql_downloads = "SELECT COUNT(*) AS total FROM logs WHERE type = 'download'";
              $total = database_run($sql_downloads);
              if ($total !== false) {
                  $rounded = round($total[0]->total / 10) * 10;
                  echo "
                  <div class='divider-line-2 d-lg-flex d-none'></div>
                  <div class='total-summary'>
                      <span>{$rounded}+</span>
                      <p>Total Downloads</p>
                  </div>
                  ";
              }
              ?>

            </div>
        </div>
          <!-- <img src="../images/qcuj.png" style="width:6em; height:6em" alt="" /> -->
    </div>

    <div class="fluid-container">
      <section id="features-container">
      <div class="text-center w-100">
          <h2 class="">What We Offer</h2>
          <p class=" text-center text-muted "> These are some of the QCUJ features you'll enjoy </p>
            </div>
        <div class="row gap-2 gy-8 gx-md-8 gy-lg-2 gx-xxl-5 justify-content-between">
          <div style="width: 26em" class="mb-4 border rounded p-4 d-flex flex-column justify-content-between">
            <div>
              <div class="badge p-3 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              	<path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6" />
              </svg>
              </div>
            </div>
            <h5 class="mb-3">Peer-Reviewed Articles</h5>
            <p class="mb-3 text-secondary"> Explore lots of peer-reviewed articles in different subjects, all checked carefully to make sure they're trustworthy.</p>
            <a href="./browse-articles.php" class="fw-bold text-decoration-none link-primary">
              View Articles
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                </path>
              </svg>
            </a>
          </div>

          <div style="width: 26em" class="mb-4 border rounded p-4 d-flex flex-column justify-content-between">
            <div>
              <div class="badge p-3 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
              	<path fill="white" d="M25 4.03c-.765 0-1.517.3-2.094.876L13 14.78l-.22.22l-.06.313l-.69 3.5l-.31 1.468l1.467-.31l3.5-.69l.313-.06l.22-.22l9.874-9.906A2.968 2.968 0 0 0 25 4.032zm0 1.94c.235 0 .464.12.688.343c.446.446.446.928 0 1.375L16 17.374l-1.72.344l.345-1.72l9.688-9.688c.223-.223.452-.343.687-.343zM4 8v20h20V14.812l-2 2V26H6V10h9.188l2-2z" />
              </svg>
              </div>
            </div>
            <h5 class="mb-3">Easier Submissions</h5>
            <p class="mb-3 text-secondary">If you're an author, our easy submission process and helpful tools like the AI-based journal classifier and duplicate checker make it simple to send in your work and get it reviewed quickly.</p>
 
            <?php
              if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
                echo '
                <a href="./ex_submit.php" class="fw-bold text-decoration-none link-primary">
                  Submit an Article
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                    </path>
                  </svg>
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
          <div style="width: 26em" class="mb-4 border rounded p-4 d-flex flex-column justify-content-between">
            <div>
              <div class="badge p-3 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              	<g fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
              		<rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
              		<path d="M12.667 8L10 12h4l-2.667 4" />
              	</g>
              </svg>
              </div>
            </div>
            <h5 class="mb-3">AI & Popularity based Recommendations</h5>
            <p class="mb-3 text-secondary">Experience article discovery with our system's popularity and AI based (personalized and relevant articles) recommendations and suggestions, guiding users to relevant content. </p>
            <a href="#!" class="fw-bold text-decoration-none link-primary">
              Check recommendations
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                </path>
              </svg>
            </a>
          </div>

        </div>

      </section>

    </div>
    <section id="procedure-container">
      <header>
        <h2>How to Publish an Article</h2>
        <span>Follow this step and publish your research</span>
      </header>
      <div class="procedures flex-lg-row flex-column">
        <div class="procedure ">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke-dasharray="14" stroke-dashoffset="14" d="M6 19h12"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.4s" values="14;0"/></path><path stroke-dasharray="18" stroke-dashoffset="18" d="M12 15 h2 v-6 h2.5 L12 4.5M12 15 h-2 v-6 h-2.5 L12 4.5"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="18;0"/></path></g></svg>
          </div>
          <h5 class="title">Submit Paper Online</h5>
          <div class="description">
            <p>Step 1: Create an account on the QCU Journals platform. This is your account for managing submissions, tracking their progress, and staying informed. Make sure your manuscript adheres to the specific formatting and style guidelines of your chosen journal.</p>
          </div>
        </div>
        <div class="procedure">
          <div class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"><path stroke-linejoin="round" d="M6 15.8L7.143 17L10 14M6 8.8L7.143 10L10 7"/><path d="M13 9h5m-5 7h5m4-4c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
          </div>
          <h5 class="title">Peer Review Process</h5>
          <div class="description">
            <p>Step 2: Your paper will be assigned to qualified experts in your field who will carefully assess your work based on criteria, providing valuable feedback and suggestions for improvement.</p>
          </div>
        </div>
        <div class="procedure">
          <div class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M3 13.5a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h9.25a.75.75 0 0 0 0-1.5H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9.75a.75.75 0 0 0-1.5 0V13a.5.5 0 0 1-.5.5zm12.78-8.82a.75.75 0 0 0-1.06-1.06L9.162 9.177L7.289 7.241a.75.75 0 1 0-1.078 1.043l2.403 2.484a.75.75 0 0 0 1.07.01z" clip-rule="evenodd"/></svg>
          </div>
          <h5 class="title">Accepted Paper</h5>
          <div class="description">
            <p>Step 3: Before final publication, the journal's editorial team will strictly copyedit your accepted paper, ensuring and enhancing the overall clarity and conciseness of your writing.</p>
          </div>
        </div>
        <div class="procedure">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path fill="currentColor" d="M688 312v-48c0-4.4-3.6-8-8-8H296c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h384c4.4 0 8-3.6 8-8m-392 88c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm376 116c-119.3 0-216 96.7-216 216s96.7 216 216 216s216-96.7 216-216s-96.7-216-216-216m107.5 323.5C750.8 868.2 712.6 884 672 884s-78.8-15.8-107.5-44.5C535.8 810.8 520 772.6 520 732s15.8-78.8 44.5-107.5C593.2 595.8 631.4 580 672 580s78.8 15.8 107.5 44.5C808.2 653.2 824 691.4 824 732s-15.8 78.8-44.5 107.5M761 656h-44.3c-2.6 0-5 1.2-6.5 3.3l-63.5 87.8l-23.1-31.9a7.92 7.92 0 0 0-6.5-3.3H573c-6.5 0-10.3 7.4-6.5 12.7l73.8 102.1c3.2 4.4 9.7 4.4 12.9 0l114.2-158c3.9-5.3.1-12.7-6.4-12.7M440 852H208V148h560v344c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V108c0-17.7-14.3-32-32-32H168c-17.7 0-32 14.3-32 32v784c0 17.7 14.3 32 32 32h272c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8"/></svg>
          </div>
          <h5 class="title">Paper Published</h5>
          <div class="description">
            <p>Step 4: After the copyediting stage, your paper undergoes a final review for formatting and compliance with journal guidelines. Upon final approval, your research will be published on the QCU Journals platform, becoming accessible to a global audience.</p>
          </div>
        </div>
      </div>
    </section>
    <section id="quick-links-container" class="">
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
    </section>
    <section id="faqs-container">
      <header>
        <h2>Frequently Asked Questions</h2>
        <span>For a comprehensive list, visit our dedicated <a href="./faqs.php">FAQ page.</a></span>
      </header>
      <div id="top-faqs" class="faqs accordion accordion-flush w-100 d-flex flex-column gap-3">
      
      </div>
      
    </section>
  </div>


  <div class="footer mt-3" id="footer">

  </div>

  <script>
    const sessionId = "<?php echo $author_id; ?>";
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
</body>

</html>