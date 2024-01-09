<?php
  include 'functions.php';
  $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

  <div class="main-content">
    <div class="content-over">
      <div class="cover-content">
        <p>Quezon City University’s Journals</p>
        <h4>Find or Submit Research Articles</h2>
          <button class="btn  btn-md" id="btn1" onclick="window.location.href='browse-articles.php'">Browse
            articles</button>
          <?php 
          if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
            echo '<button class="btn btn-md" id="btn2" onclick="window.location.href=\'ex_submit.php\'">Be a contributor</button>';
          } else {
            echo '<button class="btn btn-md" id="btn2">Be a contributor</button>';
          }
        ?>
      </div>

    </div>

    <div class="fluid-container">
      <div class="recommendation-article">
        <h4>Recently Published Articles</h4>
        <div class="d-flex container flex-wrap gap-4 justify-content-between">
          <div id="popular-articles" class="articles-container col-sm-12 col-lg-7">
            <!-- fetch popular articles using api -->
          </div>
          <div class="divider "></div>
          <div class="col-sm-12 col-lg-4 d-flex flex-column gap-2" id="most-downloaded">
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
    <img src="../images/Papers.png" alt="#" class="image">
    <!-- <hr style="height: 2px; background-color: #0858a4; width: 100%"> -->

    <?php
  if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
    echo '
      <div class="fluid-container">
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
      <div class="About-container ">
        <div class="ab-qoaj-left">
          <h4 class="mb-3">About QOAJ</h2>
            <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis distinctio, debitis
              sed dolores iste, deserunt perspiciatis ducimus odio aliquam facere illo, quasi temporibus aut sint est
              mollitia saepe omnis amet?</p>
            <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis distinctio, debitis
              sed dolores iste, deserunt perspiciatis ducimus odio aliquam facere illo, quasi temporibus aut sint est
              mollitia saepe omnis amet?</p>
            <br>
            <button style="background-color: #E56F1F;" class="btn btn-md mt-1">Read More</button>
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
          <div class="divider-line-2"></div>

          <div class="text1">
            <h4>12,093</h4>
            <p>Page Visitors</p>
          </div>
          <div class="divider-line-2"></div>

          <div class="text1">
            <h4>3,668</h4>
            <p>Articles Downloads</p>
          </div>
        </div>
      </div>

    </div>

    <div class="fluid-container">
      <div class="recommendation-container">

        <div class="row gy-8 gx-md-8 gy-lg-2 gx-xxl-5 justify-content-center">
          <div class="col-11 col-sm-6 col-lg-4 mb-4">
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
          </div>
          <div class="col-11 col-sm-6 col-lg-4 mb-4">
            <div class="badge p-3 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-alarm"
                viewBox="0 0 16 16">
                <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z">
                </path>
                <path
                  d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z">
                </path>
              </svg>
            </div>
            <h4 class="mb-3">Voice Search</h4>
            <p class="mb-3 text-secondary">We can help you to promote your business online through a variety of digital
              marketing channels, including SEO, PPC, social media marketing, and email marketing..</p>
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

          <div class="col-11 col-sm-6 col-lg-4">
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
            <h4 class="mb-3">Easier Submissions</h4>
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
          <div class="col-11 col-sm-6 col-lg-4">
            <div class="badge p-3 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                class="bi bi-airplane-engines" viewBox="0 0 16 16">
                <path
                  d="M8 0c-.787 0-1.292.592-1.572 1.151A4.347 4.347 0 0 0 6 3v3.691l-2 1V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.191l-1.17.585A1.5 1.5 0 0 0 0 10.618V12a.5.5 0 0 0 .582.493l1.631-.272.313.937a.5.5 0 0 0 .948 0l.405-1.214 2.21-.369.375 2.253-1.318 1.318A.5.5 0 0 0 5.5 16h5a.5.5 0 0 0 .354-.854l-1.318-1.318.375-2.253 2.21.369.405 1.214a.5.5 0 0 0 .948 0l.313-.937 1.63.272A.5.5 0 0 0 16 12v-1.382a1.5 1.5 0 0 0-.83-1.342L14 8.691V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v.191l-2-1V3c0-.568-.14-1.271-.428-1.849C9.292.591 8.787 0 8 0ZM7 3c0-.432.11-.979.322-1.401C7.542 1.159 7.787 1 8 1c.213 0 .458.158.678.599C8.889 2.02 9 2.569 9 3v4a.5.5 0 0 0 .276.447l5.448 2.724a.5.5 0 0 1 .276.447v.792l-5.418-.903a.5.5 0 0 0-.575.41l-.5 3a.5.5 0 0 0 .14.437l.646.646H6.707l.647-.646a.5.5 0 0 0 .14-.436l-.5-3a.5.5 0 0 0-.576-.411L1 11.41v-.792a.5.5 0 0 1 .276-.447l5.448-2.724A.5.5 0 0 0 7 7V3Z">
                </path>
              </svg>
            </div>
            <h4 class="mb-3">Peer Reviewed Articles</h4>
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
          </div>

        </div>

      </div>

    </div>

    <!-- <div class="container-fluid">
<h4 class="plans">QOAJ PLANS</h2>
  <div class="ex-journal">

  <div class="example-journal">
  <div class="plans-inside">
    <h3><b>Basic</b></h3>
    <br>
    <hr style="height: 2px; background-color: #0858a4; width: 100%">
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Full access to view abstracts <br>for all articles.</p>
    </div>
    <div style="display: flex; align-items: center;">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Access to monthly popular <br>articles.</p>
    </div>
  </div>
</div>


<div class="example-journal" >
  <div class="plans-inside">
    <h3><b>Package</b></h3>
    <h5><b> PHP 1.00 / credit </b></h5>
    <hr style="height: 2px; background-color: #0858a4; width: 100%">
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Full access to view abstracts <br>for all articles.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px; " class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Access to monthly popular <br>articles.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Personalized content <br>suggestions.</p>
    </div>

    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">No advertisements.</p>
    </div>

    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Fixed amount of credit <br>points for downloading <br>and submitting articles<br> with no expiration.</p>
    </div>

  </div>
  <div id="btn-price">
    <button class="btn btn-primary btn-md mt-1" onclick="window.location.href='pricing.php'" >See Pricing</button>
  </div>
</div>

<div class="example-journal">
  <div class="plans-inside">
    <h3><b>Pro</b></h3>
    <h5><b>PHP 0.50 / credit</b></h5>
    <hr style="height: 2px; background-color: #0858a4; width: 100%">
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Full access to view abstracts <br>for all articles.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px; " class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Access to monthly popular <br>articles.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Personalized content <br>suggestions.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">No advertisements.</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 20px">
      <i style="color: green; margin-right: 30px; margin-left: 60px" class="fa-solid fa-check"></i>
      <p style="margin: 0;" class="text-xs">Fixed amount of credit  points <br>each month. Credits  that are not <br>utilized do not roll over at the end <br> of the month. They are, however, <br> up to 50% less expensive<br/> than packages. </p>
    </div>
  </div>
  <div class="btn-price">
    <button class="btn btn-primary btn-md mt-1" onclick="window.location.href='pricing.php'">See Pricing</button>
  </div>
</div>
  </div> -->
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
  <script src="../JS/home-recommended-api.js"></script>
  <script src="../JS/recently-added-api.js"></script>
  <script src="../JS/most-downloaded-api.js"></script>
</body>

</html>