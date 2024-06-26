<?php
session_start();
$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>QCUJ | BROWSE ARTICLES</title>
    <link rel="stylesheet" href="../CSS/browse-articles.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="header-container" id="header-container">
    </header>
    <nav class="navigation-menus-container" id="navigation-menus-container">
    </nav>
    <div class="content-over">
        <div class="cover-content">
            <p>Home / Browse / Articles</p>
            <h4>Articles</h4>
        </div>
        <form action="" method="GET" class="search-form w-50" style="min-width: 20rem;" id="search-form">
            <div class="search-container d-flex flex-sm-row flex-column align-sm-items-center align-items-start gap-1" >
                <div style="position:relative;" class="w-100 search-container d-flex flex-sm-row flex-column align-sm-items-center align-items-start gap-1">
                    <input list="articlesList" id="result" type="text" class="form-control me-2 py-3" placeholder="Search Articles..."
                        class="search-bar"
                        style="height: 30px; font-style: italic; background-color: white;" />
                    <span   style="z-index:99; position:absolute; right:20px;top:0px;cursor:pointer;" data-toggle="modal" data-target="#exampleModalCenter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                        	<path fill="currentColor" d="M2.909 26.182h1.939v4.848H2.909z" class="ouiIcon__fillSecondary" />
                        	<path fill="currentColor" d="M4.848 16.62V0H2.91v16.62a3.879 3.879 0 1 0 1.94 0m-.97 5.683a1.94 1.94 0 1 1 0-3.879a1.94 1.94 0 0 1 0 3.879" />
                        	<path fill="currentColor" d="M14.545 16.485h1.939V31.03h-1.939z" class="ouiIcon__fillSecondary" />
                        	<path fill="currentColor" d="M16.485 6.924V0h-1.94v6.924a3.879 3.879 0 1 0 1.94 0m-.97 5.682a1.94 1.94 0 1 1 0-3.879a1.94 1.94 0 0 1 0 3.88" />
                        	<path fill="currentColor" d="M26.182 26.182h1.939v4.848h-1.939z" class="ouiIcon__fillSecondary" />
                        	<path fill="currentColor" d="M28.121 16.62V0h-1.94v16.62a3.879 3.879 0 1 0 1.94 0m-.97 5.683a1.94 1.94 0 1 1 0-3.879a1.94 1.94 0 0 1 0 3.879" />
                        </svg>
                    </span>
                </div>  <!-- <datalist id="articlesList">
                    </datalist> -->
                <div class="d-flex gap-1 flex-row-reverse">
                    <button class="btn tbn-primary btn-md" id="btn3">Search</button>
                    <button class="btn tbn-primary btn-md" id="voiceSearch" onclick="startConverting();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                            <path fill="white"
                                d="M16 2a6 6 0 0 0-6 6v8a6 6 0 0 0 12 0V8a6 6 0 0 0-6-6ZM7 15a1 1 0 0 1 1 1a8 8 0 1 0 16 0a1 1 0 1 1 2 0c0 5.186-3.947 9.45-9.001 9.95L17 26v3a1 1 0 1 1-2 0v-3l.001-.05C9.947 25.45 6 21.187 6 16a1 1 0 0 1 1-1Z" />
                            </svg>
                    </button>
                </div>
            </div>
            <!-- <div id="result"></div> -->

            <div class="info-container d-none d-sm-flex">
                <span class="info-icon">&#9432;</span>
                <span class="search-info">SEARCH BY TITLE, AUTHOR, OR KEYWORD. FOR BETTER RESULTS SEPARATE IT WITH
                    COMMAS (E.G. AI TECHNOLOGY, JUAN DELA CRUZ)</span>
            </div>
        </form>
    </div>
    
    <form action="" method="GET" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Refine Search</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="mb-3 d-flex flex-column">
                <label for="" class="form-label">Any of these words</label>
                <input
                    type="text"
                    class="form-control"
                    name=""
                    id="any-words"
                    aria-describedby="helpId"
                    placeholder=""
                />
            </div>
            <div class="mb-3 d-flex flex-column d-none">
                <label for="" class="form-label">None of these words</label>
                <input
                    type="text"
                    class="form-control"
                    name=""
                    id=""
                    aria-describedby="helpId"
                    placeholder=""
                />
            </div>
            <div class="mb-3 d-flex flex-column">
                <label for="" class="form-label">Exact words</label>
                <input
                    type="text"
                    class="form-control"
                    name=""
                    id="exact-words"
                    aria-describedby="helpId"
                    placeholder=""
                />
            </div>
            <div class="mb-3 d-flex flex-column">
                <label for="" class="form-label">Journals</label>
                <div id="journals-refine-container" class="d-flex flex-row flex-wrap gap-2">
                
                </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="refine_search" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
          </div>
        </div>
      </div>
    </form>
    <div class="main-container container-fluid">
        <div class="row w-100">
            <div class="sidebar col-lg-3 col-md-12">
                <h4 style="color: var(--main, #0858A4);"><b><span id="total"></span></b></h4>
                <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> 
                <!-- Filters Here -->
                <div class="journal-preview flex-row flex-lg-column">
                    <div>
                    <img />
                    <h2 class="journal"></h2>
                    </div>
                    <ul>
                        <li class="issn">
                            <h3>ISSN (online)</h3>
                            <span></span>
                        </li>
                        <li class="date">
                            <h3>Online Date Start</h3>
                            <span></span>
                        </li>
                        <li class="info">
                            <h3>Further Information</h3>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
                
                <div class="filters">
                    <h4 class="btn collapsed p-0" style="color: var(--main, #0858A4);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">
                        Filter search results
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="7" viewBox="0 0 16 7"><path fill="currentColor" d="M8 6.5a.47.47 0 0 1-.35-.15l-4.5-4.5c-.2-.2-.2-.51 0-.71c.2-.2.51-.2.71 0l4.15 4.15l4.14-4.14c.2-.2.51-.2.71 0c.2.2.2.51 0 .71l-4.5 4.5c-.1.1-.23.15-.35.15Z"/></svg>
                    </h4>
                   
                    <!-- Journals, Year Published, etc. -->
                    <div class="collapse show" id="collapseFilters">
                        <div class="checkbox-container">
                            <h5 class="mb-2" style="color: #959595;"><b>JOURNALS</b></h5>
                            <div id="journals-container" class="d-flex flex-row flex-lg-column flex-wrap gap-2">
                
                            </div>
                        </div>
                        <div class="checkbox-container">
                            <h5 class="mb-2" style="color: #959595;"><b>YEAR PUBLISHED</b></h5>
                            <div id="years-container" class="d-flex flex-row flex-lg-column flex-wrap gap-2">
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>
            <div class="articles-containers col-lg-9 col-md-12">
                <!-- Article 1 -->
                <div class="sort-container d-flex gap-2">
                    <div class="sort-header">
                        <span class="sort-by-text" style="color: var(--main, #0858A4);">Sort by</span>
                        <span class="sort-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <path fill="#e6e6e6" d="M11 7H1l5 7zm-2 7h10l-5-7z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <select id="sortby" name="sortby" class="sort-dropdown form-select form-select-sm px-8" >
                            <option value="" hidden>Choose</option>
                            <option value="title">Title</option>
                            <!-- <option value="recently_added">Recently added</option> -->
                            <option value="publication-date">Publication Date</option>
                            <optgroup label="Popularity">
                                <option value="popular">All</option>
                                <option value="views">Views</option>
                                <option value="downloads">Downloads</option>
                                <option value="citations">Citations</option>
                            </optgroup>
                        </select>
                    </div>
                    <div id="selected-filters"></div>
                    
                </div>
                <div id="skeleton-container" class="">
                    <div></div>
                    <div></div>
                </div>
                <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
                <div id="articles" class="d-flex flex-column gap-2 mb-4 w-100 p-0 m-0">
                </div>
                <nav aria-label="Page navigation d-flex justify-items-center align-items-center w-100">
                    <ul class="pagination d-flex flex-wrap w-100" id="pagination-container">
                        <!-- Display page numbers -->
                        <li class="page-item"><a class="page-link" href="javascript:void(0);"
                                onclick="changePage(0)">1</a></li>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="fluid-container">
        <div class="recommendation-article">
            <h4>Top Picks for <?php echo date('F '); ?></h4>
            <div id="popular-monthly" class="articles-container ">
                <!-- fetch popular articles using api -->
            </div>
        </div>
    </div>
    </div>

    <div class="footer" id="footer">

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        const sessionId = "<?php echo $author_id; ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function showAlert() {
        Swal.fire({
        icon: 'info',
        title: 'Profile Incomplete',
        text: 'Please complete the required details in profile to submit article'
        });
    }
    </script>
    <script src="../JS/reusable-header.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
function includeNavbar() {
  fetch('../PHP/navbar.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('navigation-menus-container').innerHTML = data;
      // Now that the content is loaded, you can attach event listeners or perform other operations as needed
      // For example, you can attach the notification button click event listener here
      attachNotificationButtonListener();
      attachNotificationItemClickListener();
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

function attachNotificationItemClickListener() {
  const notificationItems = document.querySelectorAll('.notification-item');

  notificationItems.forEach(item => {
    item.addEventListener('click', function () {
      const notificationId = this.dataset.notificationId;
      markNotificationAsRead(notificationId);
    });
  });

  function markNotificationAsRead(notificationId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../PHP/mark_as_read.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Handle success or display any feedback to the user
        console.log('Notification marked as read');
      }
    };
    xhr.send('notification_id=' + encodeURIComponent(notificationId));
  }
}

// Call this function in your code wherever appropriate, such as after loading notifications
// attachNotificationItemClickListener();


// Call includeNavbar function to load navbar.php content
includeNavbar();

    </script>
    <!-- <script src="../JS/most-popular-api.js"></script> -->
    <script src="../JS/home-monthly-api.js"></script>
    <?php include '../JS/browse/browse.php'; ?>


</body>

</html>