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
        <p>Quezon City University’s Journals</p>
        <h4>Find or Submit Research Articles</h2>
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
        <h4>Recently Published Articles</h4>
        <div class="container-fluid p-2 d-flex flex-column flex-xl-row justify-content-center">
          <div id="recently-added" class="articles-container p-2 col-sm-12 col-xl-7">
            <!-- fetch popular articles using api -->
          </div>
          <div class="divider "></div>
          <div class="col-sm-12 col-xl-4 d-flex flex-column gap-2" id="most-popular-container">
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
    // Fetch data from the database
    $query = "SELECT * FROM announcement WHERE announcementtype = 'Call for papers' AND status = 1";
    $announcements = database_run($query);

    // Check if there are announcements
    if ($announcements !== false && !empty($announcements)) {
        // Loop through each announcement
        foreach ($announcements as $announcement) {
        ?>
        <div class="image-container">
         <img src="../Files/announcement-image/<?php echo $announcement->upload_image; ?>" alt="#" class="image">
                        <div class="hover-details text-white">
                        <h4><?php echo $announcement->title; ?></h4>
                        <p><?php echo $announcement->announcement_description; ?></p>
                        <p><?php echo $announcement->announcement; ?></p>
                        <!-- You can display additional details here if needed -->
                        <span onclick="window.location.href='./announcement.php?id=<?php echo $announcement->announcement_id; ?>'" class="button">View Announcement</span>
              </div>
          </div>
        <?php
    }
} else {
    // No announcements available or error occurred
    if ($announcements === false) {
        echo "No announcements available.";
    }
}
?>
      
    <?php
    if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
      echo '
        <div class="fluid-container" id="recommendation-section">
        <div class="recommendation-article">
        <h4>Tailored for You: Recommended Articles Based on Your Interactions</h4>
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
          <h4 class="mb-3">About QCUJ</h2>
            <p class="description">Say goodbye to research submission struggles! Open Access Journal System for QCU (OAJS QCU) is your new best friend, making sharing your work simple and quick. Think of it as a smooth online portal where you can easily submit your research for expert review. </p>
            <p class="description"><a href="https://qcu.edu.ph/" class="text-white">Quezon City University (QCU)</a>, recognized by the Commission on Higher Education (CHED), holds dear the values of cultivating a vibrant research culture and disseminating new knowledge for the betterment of society. Understanding that the impact of research hinges on its accessibility and publication, QCU has established the QCU Journals as a platform for its researchers to share their valuable findings and contributions.</p>
            <p class="description">This website is powered by an artificial intelligence and machine learning to improve the user experience. All articles are freely available to download and read, without any paywalls or restrictions.</p>

            <br>
            <button style="background-color: #E56F1F; max-width:20em;" class="btn btn-md mt-1 w-100">See Features</button>
            <br>
        </div>

        <div class="ab-qoaj-right">
          <div class="text1">
            <h4>1,243</h4>
            <p>Articles published</p>
          </div>
          <div class="divider-line-2"></div>
          <div class="text1">
            <h4>89</h4>
            <p>Total Contribution</p>
          </div>
        </div>
      </div>

    </div>

    <div class="fluid-container">
      <section id="features-container">
        <div class="row gy-8 gx-md-8 gy-lg-2 gx-xxl-5 justify-content-center">
          <!-- <div class="col-11 col-sm-6 col-lg-4 mb-4">
            <div class="badge  p-3 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-pie-chart"
                viewBox="0 0 16 16">
                <path
                  d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793V1.018zm1 0V7.5h6.482A7.001 7.001 0 0 0 8.5 1.018zM14.982 8.5H8.207l-4.79 4.79A7 7 0 0 0 14.982 8.5zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z">
                </path>
              </svg>
            </div>
            <h4 class="mb-3">Top Articles</h4>
            <p class="mb-3 text-secondary">We can help you to understand your target market and identify new
              opportunities for growth. We offer a variety of market research services, interviews, and focus groups.
            </p>
            <a href="#!" class="fw-bold text-decoration-none link-primary">
              Learn More
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                </path>
              </svg>
            </a>
          </div>
          <div class="col-11 col-sm-6 col-lg-4 mb-4">
            <div class="badge p-3 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                class="bi bi-aspect-ratio" viewBox="0 0 16 16">
                <path
                  d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z">
                </path>
                <path
                  d="M2 4.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H3v2.5a.5.5 0 0 1-1 0v-3zm12 7a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H13V8.5a.5.5 0 0 1 1 0v3z">
                </path>
              </svg>
            </div>
            <h4 class="mb-3">Personalized Recommendations</h4>
            <p class="mb-3 text-secondary">We can help you to create a visually appealing and user-friendly website. We
              take into account your brand identity and target audience when designing your website.</p>
            <a href="#!" class="fw-bold text-decoration-none link-primary">
              Learn More
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                </path>
              </svg>
            </a>
          </div>
          <div class="col-11 col-sm-6 col-lg-4 mb-4">
            <div class="badge p-3 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                class="bi bi-airplane-engines" viewBox="0 0 16 16">
                <path
                  d="M8 0c-.787 0-1.292.592-1.572 1.151A4.347 4.347 0 0 0 6 3v3.691l-2 1V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.191l-1.17.585A1.5 1.5 0 0 0 0 10.618V12a.5.5 0 0 0 .582.493l1.631-.272.313.937a.5.5 0 0 0 .948 0l.405-1.214 2.21-.369.375 2.253-1.318 1.318A.5.5 0 0 0 5.5 16h5a.5.5 0 0 0 .354-.854l-1.318-1.318.375-2.253 2.21.369.405 1.214a.5.5 0 0 0 .948 0l.313-.937 1.63.272A.5.5 0 0 0 16 12v-1.382a1.5 1.5 0 0 0-.83-1.342L14 8.691V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v.191l-2-1V3c0-.568-.14-1.271-.428-1.849C9.292.591 8.787 0 8 0ZM7 3c0-.432.11-.979.322-1.401C7.542 1.159 7.787 1 8 1c.213 0 .458.158.678.599C8.889 2.02 9 2.569 9 3v4a.5.5 0 0 0 .276.447l5.448 2.724a.5.5 0 0 1 .276.447v.792l-5.418-.903a.5.5 0 0 0-.575.41l-.5 3a.5.5 0 0 0 .14.437l.646.646H6.707l.647-.646a.5.5 0 0 0 .14-.436l-.5-3a.5.5 0 0 0-.576-.411L1 11.41v-.792a.5.5 0 0 1 .276-.447l5.448-2.724A.5.5 0 0 0 7 7V3Z">
                </path>
              </svg>
            </div>
            <h4 class="mb-3">Similar Articles</h4>
            <p class="mb-3 text-secondary">We can help you to improve your website's visibility in search engine results
              pages (SERPs). This can lead to more traffic to your website and more conversions.</p>
            <a href="#!" class="fw-bold text-decoration-none link-primary">
              Learn More
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                </path>
              </svg>
            </a>
          </div> -->
          <div class="col-11 col-sm-6 col-lg-4 mb-4">
            <div class="badge p-3 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            	<path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6" />
            </svg>
            </div>
            <h4 class="mb-3">Peer-Reviewed Articles</h4>
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

          <div class="col-11 col-sm-6 col-lg-4">
            <div class="badge p-3 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
            	<path fill="white" d="M25 4.03c-.765 0-1.517.3-2.094.876L13 14.78l-.22.22l-.06.313l-.69 3.5l-.31 1.468l1.467-.31l3.5-.69l.313-.06l.22-.22l9.874-9.906A2.968 2.968 0 0 0 25 4.032zm0 1.94c.235 0 .464.12.688.343c.446.446.446.928 0 1.375L16 17.374l-1.72.344l.345-1.72l9.688-9.688c.223-.223.452-.343.687-.343zM4 8v20h20V14.812l-2 2V26H6V10h9.188l2-2z" />
            </svg>
            </div>
            <h4 class="mb-3">Easier Submissions</h4>
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
          <div class="col-11 col-sm-6 col-lg-4">
            <div class="badge p-3 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            	<g fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            		<rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
            		<path d="M12.667 8L10 12h4l-2.667 4" />
            	</g>
            </svg>
            </div>
            <h4 class="mb-3">AI & Popularity based Recommendations</h4>
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
        <h2>Publication Procedure</h2>
        <span>Follow this step and publish your research</span>
      </header>
      <div class="procedures flex-md-row flex-column">
        <div class="procedure ">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke-dasharray="14" stroke-dashoffset="14" d="M6 19h12"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.4s" values="14;0"/></path><path stroke-dasharray="18" stroke-dashoffset="18" d="M12 15 h2 v-6 h2.5 L12 4.5M12 15 h-2 v-6 h-2.5 L12 4.5"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="18;0"/></path></g></svg>
          </div>
          <h4 class="title">Submit Paper Online</h4>
          <div class="description">
            <p>Step 1: Create an account on the QCU Journals platform. This is your account for managing submissions, tracking their progress, and staying informed. Make sure your manuscript adheres to the specific formatting and style guidelines of your chosen journal.</p>
          </div>
        </div>
        <div class="procedure">
          <div class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"><path stroke-linejoin="round" d="M6 15.8L7.143 17L10 14M6 8.8L7.143 10L10 7"/><path d="M13 9h5m-5 7h5m4-4c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
          </div>
          <h4 class="title">Peer Review Process</h4>
          <div class="description">
            <p>Step 2: Your paper will be assigned to qualified experts in your field who will carefully assess your work based on criteria, providing valuable feedback and suggestions for improvement.</p>
          </div>
        </div>
        <div class="procedure">
          <div class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M3 13.5a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h9.25a.75.75 0 0 0 0-1.5H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9.75a.75.75 0 0 0-1.5 0V13a.5.5 0 0 1-.5.5zm12.78-8.82a.75.75 0 0 0-1.06-1.06L9.162 9.177L7.289 7.241a.75.75 0 1 0-1.078 1.043l2.403 2.484a.75.75 0 0 0 1.07.01z" clip-rule="evenodd"/></svg>
          </div>
          <h4 class="title">Accepted Paper</h4>
          <div class="description">
            <p>Step 3: Before final publication, the journal's editorial team will strictly copyedit your accepted paper, ensuring and enhancing the overall clarity and conciseness of your writing.</p>
          </div>
        </div>
        <div class="procedure">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path fill="currentColor" d="M688 312v-48c0-4.4-3.6-8-8-8H296c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h384c4.4 0 8-3.6 8-8m-392 88c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm376 116c-119.3 0-216 96.7-216 216s96.7 216 216 216s216-96.7 216-216s-96.7-216-216-216m107.5 323.5C750.8 868.2 712.6 884 672 884s-78.8-15.8-107.5-44.5C535.8 810.8 520 772.6 520 732s15.8-78.8 44.5-107.5C593.2 595.8 631.4 580 672 580s78.8 15.8 107.5 44.5C808.2 653.2 824 691.4 824 732s-15.8 78.8-44.5 107.5M761 656h-44.3c-2.6 0-5 1.2-6.5 3.3l-63.5 87.8l-23.1-31.9a7.92 7.92 0 0 0-6.5-3.3H573c-6.5 0-10.3 7.4-6.5 12.7l73.8 102.1c3.2 4.4 9.7 4.4 12.9 0l114.2-158c3.9-5.3.1-12.7-6.4-12.7M440 852H208V148h560v344c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V108c0-17.7-14.3-32-32-32H168c-17.7 0-32 14.3-32 32v784c0 17.7 14.3 32 32 32h272c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8"/></svg>
          </div>
          <h4 class="title">Paper Published</h4>
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
            <h4>Check Paper Status</h4>
          </div>
        </a>
        <a href="./guidelines.php#author-guidelines" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h4>Publication Guidelines</h4>
          </div>
        </a>
        <a href="./guidelines.php#become-reviewer" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h4>Reviewer Guidelines</h4>
          </div>
        </a>
        <a href="./guidelines.php#templates-for-author" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h4>Paper Sample Format</h4>
          </div>
        </a>
        <a href="#" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h4>Certification</h4>
          </div>
        </a>
        <a href="donation.php" class="quick-link">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M1 6.5A3.5 3.5 0 0 1 4.5 3h4a3.5 3.5 0 0 1 3.469 3.031a3.537 3.537 0 0 1-.122 1.499A3.502 3.502 0 0 1 8.5 10h-.75a.75.75 0 0 1 0-1.5h.75a2 2 0 1 0 0-4h-4a2 2 0 0 0-1.262 3.552a4.494 4.494 0 0 0-.235 1.613A3.5 3.5 0 0 1 1 6.5m8 .25a.75.75 0 0 1-.75.75H7.5a2 2 0 1 0 0 4h4a2 2 0 0 0 1.263-3.551a4.495 4.495 0 0 0 .235-1.613A3.5 3.5 0 0 1 11.5 13h-4a3.5 3.5 0 1 1 0-7h.75a.75.75 0 0 1 .75.75"/></svg>
          </div>
          <div class="title">
            <h4>Donate to Support</h4>
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


  <div class="footer" id="footer">
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