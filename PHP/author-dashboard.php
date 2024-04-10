<?php 
require_once 'dbcon.php';
session_start();
if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] !== true) {
	header('Location: ./login.php');
	exit();
  }
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('./meta.php'); ?>
  <title>Pahina | AUTHOR DASHBOARD</title>
  <link rel="stylesheet" href="../CSS/author_dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="header-container" id="header-container">
    <!-- header will be display here by fetching reusable files -->
  </div>

  <nav class="navigation-menus-container" id="navigation-menus-container">
    <!-- navigation menus will be display here by fetching reusable files -->
  </nav>

  <div class="main-container">
    <div class="content-over">
      <div class="cover-content">
        <p>Home / My Contributions</p>
        <h2 class="text-center">My Contributions</h2>
      </div>
      <!-- <div>
        <button class="btn tbn-primary btn-md" id="btn1" onclick="window.location.href='author-dashboard.php'">My
          Contributions</button>
        <button class="btn tbn-primary btn-md" id="btn2" onclick="window.location.href='user-dashboard.php'">Edit/View Profile</button>
      </div> -->
    </div>
    <div class="main">
      <div class="">
        <div class="articles-section">
        <div class="row ">
            <!-- Graph placeholder -->
        
          <!-- <div class="graph-section">
            <h3>Published Articles Engagement</h3>
            <canvas id="articlesChart" width="400" height="120"></canvas>
          </div> -->
          <!-- <div class="d-flex flex-wrap gap-4">
            <div class="stat-card top-card ">
              <h2>Total Views</h2>
              <p>98 <span class="increase">+11%</span></p>
            </div>
            <div class="stat-card top-card">
              <h2>Total Downloads</h2>
              <p>98 <span class="increase">+11%</span></p>
            </div>
            <div class="stat-card top-card">
              <h2>Total Views</h2>
              <p>98 <span class="increase">+11%</span></p>
            </div>
            <div class="stat-card top-card">
              <h2>Total Downloads</h2>
              <p>98 <span class="increase">+11%</span></p>
            </div>
          </div> -->

        </div>
          <?php
          if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
              $sqlSelectProfile = "SELECT first_name, middle_name, last_name, birth_date, gender, marital_status, orc_id, afiliations, position, field_of_expertise FROM author WHERE author_id = :author_id";

              $resultProfile = database_run($sqlSelectProfile, array(':author_id' => $id));

              if ($resultProfile) {
                  if (count($resultProfile) > 0) {
                      $userProfile = $resultProfile[0];

                      // Check for the presence of all required fields
                      $requiredFields = ['first_name', 'middle_name', 'last_name', 'birth_date', 'gender', 'marital_status', 'orc_id', 'afiliations', 'position', 'field_of_expertise'];

                      $profileComplete = true;
                      foreach ($requiredFields as $field) {
                          if (empty($userProfile->$field)) {
                              $profileComplete = false;
                              break;
                          }
                      }
                      if ($profileComplete) {
                          echo '<button class="btn" id="btn3" onclick="window.location.href=\'ex_submit.php\'">Submit an Article</button>';
                      } else {
                          echo '<button class="btn" id="btn3D">Submit an Article</button>';
                          echo "<script>
                                      document.getElementById('btn3D').addEventListener('click', function(event){
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
          }
          ?>
          <div class="tabs">
            <ul class="" id="myTab" role="tablist" style="margin-left:-40px; margin-bottom:0">
              <div role="presentation" class="tab active">
                <li class="w-100 p-2  active" id="submissions-tab" data-bs-toggle="tab"
                  data-bs-target="#submissions-tab-pane" type="button" role="tab" aria-controls="submissions-tab-pane"
                  aria-selected="true" style="list-style-type: none ">
                  All Submissions
                </li>
              </div>
              <div role="presentation" class="tab">
                <li class="w-100 p-2" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button"
                  role="tab" aria-controls="reviews-tab-pane" aria-selected="false" style="list-style-type: none ">
                  All Reviews
                </li>
              </div>
              <div role="presentation" class="tab">
                <li class="w-100 p-2" id="archive-tab" data-bs-toggle="tab" data-bs-target="#archive-tab-pane" type="button"
                  role="tab" aria-controls="archive-tab-pane" aria-selected="false" style="list-style-type: none ">
                  All Invitation
                </li>
              </div>
            </ul>

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="submissions-tab-pane" role="tabpanel"
                aria-labelledby="submissions-tab" tabindex="0">
                <!-- <table>
                  <thead>
                    <tr>
                      <th><input type="checkbox"></th>
                      <th>Title</th>
                      <th>Date</th>
                      <th>Journal</th>
                      <th>
                        <center>Status</center>
                      </th>
                      <th>
                        <center>Action</center>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td>Blockchain Beyond Cryptocurrency: Transforming...</td>
                      <td>May 31, 2015</td>
                      <td>The Star</td>
                      <td>
                        <center><span class="status-label pending">Pending</span></center>
                      </td>
                      <td>
                        <center>...</center>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td>Industries with Distributed Ledger Technology</td>
                      <td>October 24, 2018</td>
                      <td>The Star</td>
                      <td>
                        <center><span class="status-label published">Published</span></center>
                      </td>
                      <td>
                        <center>...</center>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td>Industries with Distributed Ledger Technology</td>
                      <td>October 24, 2018</td>
                      <td>The Star</td>
                      <td>
                        <center><span class="status-label published">Published</span></center>
                      </td>
                      <td>
                        <center>...</center>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td>Industries with Distributed Ledger Technology</td>
                      <td>October 24, 2018</td>
                      <td>The Star</td>
                      <td>
                        <center><span class="status-label published">Published</span></center>
                      </td>
                      <td>
                        <center>...</center>
                      </td>
                    </tr>
                  </tbody>
                </table> -->
                <?php
  
                  $journalNames = array(
                      1 => 'The Gavel',
                      2 => 'The Lamp',
                      3 => 'The Star',
                  );
              
                  $journalStatus = array(
                      1 => array('text' => 'PUBLISHED', 'color' => 'gold', 'borderColor' => 'gold'),
                      2 => array('text' => 'PRODUCTION', 'color' => 'blue', 'borderColor' => 'darkblue'),
                      3 => array('text' => 'COPYEDITING', 'color' => 'orange', 'borderColor' => 'darkorange'),
                      4 => array('text' => 'REVIEW', 'color' => 'green', 'borderColor' => 'green'),
                      5 => array('text' => 'PENDING', 'color' => 'gray', 'borderColor' => 'darkgray'),
                      6 => array('text' => 'REJECT', 'color' => 'red', 'borderColor' => 'darkred'),
                  );
              
                  if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
                    
              
                      // Assuming you want 10 items per page
                      $itemsPerPage = 10;
                      $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
              
                      $query = "SELECT * FROM article WHERE `author_id` = :author_id LIMIT " . ($currentPage - 1) * $itemsPerPage . ", $itemsPerPage";
                      $vars = array(':author_id' => $id);
              
                      $result = database_run($query, $vars);
              
                      if ($result !== false && count($result) > 0) {
                          echo '<table class="table table-hover">';
                          echo '<thead>';
                          echo '<tr>
                                      <th><input type="checkbox"></th>
                                      <th>Title</th>
                                      <th>Journal</th>
                                      <th>Date</th>
                                      <th><center>Status</center></th>
                                      <th><center>Action</center></th>
                                  </tr>';
                          echo '</thead>';
              
                          echo '<tbody>';
                          foreach ($result as $row) {
                              echo '<tr>';
                              echo '<td><input type="checkbox"></td>';
                              echo '<td><a style="text-decoration: none; color: gray; display: inline-block;" href="submitted-article.php?id=' . $row->article_id . '">' . $row->title . '</a></td>';

                           
              
                              $journalName = isset($journalNames[$row->journal_id]) ? $journalNames[$row->journal_id] : '';
                              echo '<td>' . $journalName . '</td>';
                              echo '<td>' . $row->date_added . '</td>';
              
                              $statusInfo = isset($journalStatus[$row->status]) ? $journalStatus[$row->status] : array('text' => '', 'color' => '', 'borderColor' => '');
                              echo '<td><center><span class="badge badge-pill" style="background-color: ' . $statusInfo['color'] . '; border: 1px solid ' . $statusInfo['borderColor'] . ';">' . $statusInfo['text'] . '</span></center></td>';
                              echo '<td><center>...</center></td>';
                              echo '</tr>';
                          }
                          echo '</tbody>';
                          echo '</table>';
              
                          
                          $query = "SELECT COUNT(*) as total FROM article WHERE `author_id` = :author_id";
                          $countResult = database_run($query, $vars);
                          $totalCount = $countResult[0]->total;
              
                          $totalPages = ceil($totalCount / $itemsPerPage);
              
                  
                          echo '<nav aria-label="Page navigation example" class="mt-3">';
                          echo '<ul class="pagination justify-content-end">';
                          for ($i = 1; $i <= $totalPages; $i++) {
                              echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                          }
                          echo '</ul>';
                          echo '</nav>';

                                  } else {
                                      echo  '<div class="p-4">You have not submitted any article yet</div>';
                                  }
                              }
                            
                ?>





                <!-- <div class="pagination">
                  Showing 1 to 10 of 50 entries
                  <div class="pagination-controls">
                    <button>«</button>
                    <button>‹</button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>4</button>
                    <button>›</button>
                    <button>»</button>
                  </div>
                </div> -->
              </div>
              <div class="tab-pane fade " id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab"
                tabindex="0">


              <?php

                $journalNamesReviewer = array(
                  1 => 'The Gavel',
                  2 => 'The Lamp',
                  3 => 'The Star',
                );

                $journalStatusReviewer = array(
                  1 => array('text' => 'PUBLISHED', 'color' => 'green', 'borderColor' => 'darkgreen'),
                  2 => array('text' => 'PRODUCTION', 'color' => 'blue', 'borderColor' => 'darkblue'),
                  3 => array('text' => 'COPYEDITING', 'color' => 'orange', 'borderColor' => 'darkorange'),
                  4 => array('text' => 'REVIEW', 'color' => 'green', 'borderColor' => 'green'),
                  5 => array('text' => 'PENDING', 'color' => 'gray', 'borderColor' => 'darkgray'),
                  6 => array('text' => 'REJECT', 'color' => 'red', 'borderColor' => 'darkred'),
                );

                if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
                    
              
                  // Assuming you want 10 items per page
                  $itemsPerPageReviewer = 10;
                  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                  
                  $queryReviewer = "SELECT reviewer_assigned.*, article.*
                                    FROM reviewer_assigned 
                                    JOIN article ON article.article_id = reviewer_assigned.article_id 
                                    WHERE article.status < 5 AND reviewer_assigned.accept = 1 AND reviewer_assigned.answer = 1 AND  reviewer_assigned.author_id = :author_id 
                                    LIMIT " . ($currentPage - 1) * $itemsPerPageReviewer . ", $itemsPerPageReviewer";
                  
                  $varsReviewer = array(':author_id' => $id);
                  
                  $resultReviewer = database_run($queryReviewer, $varsReviewer);
                  
          
                  if ($resultReviewer !== false && count($resultReviewer) > 0) {
                      echo '<table class="table table-hover">';
                      echo '<thead>';
                      echo '<tr>
                                  <th><input type="checkbox"></th>
                                  <th>Title</th>
                                  <th>Journal</th>
                                  <th>Date Issued</th>
                                  <th style="text-align: center;">Status</th>
                                 
                               
                              </tr>';
                      echo '</thead>';
          
                      echo '<tbody>';
                      foreach ($resultReviewer as $rowReviewer) {
                          echo '<tr>';
                          echo '<td><input type="checkbox"></td>';
                       

                          $queryTitle = "SELECT article.title FROM article JOIN reviewer_assigned ON article.article_id = reviewer_assigned.article_id WHERE article.status < 5 AND reviewer_assigned.accept = 1 AND reviewer_assigned.answer = 1 AND  reviewer_assigned.author_id = :author_id;
                          ";
                          $titleResult = database_run($queryTitle, array(':author_id' => $id));
                          if ($titleResult !== false && count($titleResult) > 0) {
                              echo '<td>' . $rowReviewer->title . '</td>';
                          } else {
                              echo '<td>Unknown Title</td>';
                          }

                          $journalName = isset($journalNames[$rowReviewer->journal_id]) ? $journalNames[$rowReviewer->journal_id] : '';
                          echo '<td>' . $journalName . '</td>';

                         $dateIssued = ($rowReviewer->date_issued);
                         echo  '<td>' . $dateIssued . '</td>';

                           
                         $statusInfo = isset($journalStatusReviewer[$rowReviewer->status]) ? $journalStatusReviewer[$rowReviewer->status] : array('text' => '', 'color' => '', 'borderColor' => '');
                        echo '<td><center><span class="badge badge-pill" style="background-color: ' . $statusInfo['color'] . '; border: 1px solid ' . $statusInfo['borderColor'] . ';">' . $statusInfo['text'] . '</span></center></td>';
                        // echo '<td><center>...</center></td>';
                        echo '</tr>';

                          

                        
          
                          echo '</tr>';
                      }
                      echo '</tbody>';
                      echo '</table>';
          
                      
                      $queryReviewr = "SELECT COUNT(*) as total FROM reviewer_assigned WHERE `author_id` = :author_id";
                      $countResultReviewer = database_run($queryReviewr, $varsReviewer);
                      $totalCount = $countResultReviewer[0]->total;
          
                      $totalPages = ceil($totalCount / $itemsPerPage);
          
              
                      echo '<nav aria-label="Page navigation example" class="mt-3">';
                      echo '<ul class="pagination justify-content-end">';
                      for ($i = 1; $i <= $totalPages; $i++) {
                          echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                      }
                      echo '</ul>';
                      echo '</nav>';

                              } else {
                                  echo '<div class="p-4">You are not assign as reviewer yet.</div>';
                              }
                          }
                
              

              ?>

           



            
                </div>
                <div class="tab-pane fade " id="archive-tab-pane" role="tabpanel" aria-labelledby="archive-tab"
                tabindex="0">
                
                <?php

                $journalNamesArchives = array(
                  1 => 'The Gavel',
                  2 => 'The Lamp',
                  3 => 'The Star',
                );

                $journalStatusArchive = array(
                  1 => array('text' => 'PUBLISHED', 'color' => 'green', 'borderColor' => 'darkgreen'),
                  2 => array('text' => 'PRODUCTION', 'color' => 'blue', 'borderColor' => 'darkblue'),
                  3 => array('text' => 'COPYEDITING', 'color' => 'orange', 'borderColor' => 'darkorange'),
                  4 => array('text' => 'REVIEW', 'color' => 'green', 'borderColor' => 'green'),
                  5 => array('text' => 'PENDING', 'color' => 'gray', 'borderColor' => 'darkgray'),
                  6 => array('text' => 'REJECT', 'color' => 'red', 'borderColor' => 'darkred'),
                );

                if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
                    

                  // Assuming you want 10 items per page
                  $itemsPerPageArchive = 10;
                  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                  
                  $sqlArchive = "SELECT reviewer_assigned.*, article.*
                                    FROM reviewer_assigned 
                                    JOIN article ON article.article_id = reviewer_assigned.article_id 
                                    WHERE article.status < 5  AND  reviewer_assigned.author_id = :author_id ORDER BY reviewer_assigned.date_issued DESC
                                    LIMIT " . ($currentPage - 1) * $itemsPerPageArchive . ", $itemsPerPageArchive";
                  
                  $varsAchive = array(':author_id' => $id);
                  
                  $resultReviewer = database_run($sqlArchive, $varsAchive);
                  

                  if ($resultReviewer !== false && count($resultReviewer) > 0) {
                      echo '<table class="table table-hover">';
                      echo '<thead>';
                      echo '<tr>
                                  <th><input type="checkbox"></th>
                                  <th>Title</th>
                                  <th>Journal</th>
                                  <th>Date Issued</th>
                                  <th style="text-align: center;">Status</th>
                                  <th>Invitation</th>
                                
                              
                              </tr>';
                      echo '</thead>';

                      echo '<tbody>';
                      foreach ($resultReviewer as $rowReviewer) {
                          echo '<tr>';
                          echo '<td><input type="checkbox"></td>';
                      

                          $queryTitle = "SELECT article.title FROM article JOIN reviewer_assigned ON article.article_id = reviewer_assigned.article_id WHERE article.status < 5 AND  reviewer_assigned.author_id = :author_id ;
                          ";
                          $titleResult = database_run($queryTitle, array(':author_id' => $id));
                          if ($titleResult !== false && count($titleResult) > 0) {
                            $invitationTitle = $rowReviewer->accept;

                            if ($invitationTitle == 0) {
                                echo '<td><a style="text-decoration: none; color: black; font-weight: bold; display: inline-block;" href="review-process.php?id=' . $rowReviewer->article_id . '">' . $rowReviewer->title . '</a></td>';
                            } else {
                                echo '<td style="font-weight: bold; color: #6c757d;">' . $rowReviewer->title . '</td>';
                            }
                            

                          } else {
                              echo '<td>Title not found</td>';
                          }

                        $journalName = isset($journalNames[$rowReviewer->journal_id]) ? $journalNames[$rowReviewer->journal_id] : '';
                        echo '<td>' . $journalName . '</td>';

                        $dateIssued = ($rowReviewer->date_issued);
                        echo  '<td>' . $dateIssued . '</td>';

                          
                        $statusInfo = isset($journalStatusArchive[$rowReviewer->status]) ? $journalStatusArchive[$rowReviewer->status] : array('text' => '', 'color' => '', 'borderColor' => '');
                        echo '<td><center><span class="badge badge-pill" style="background-color: ' . $statusInfo['color'] . '; border: 1px solid ' . $statusInfo['borderColor'] . ';">' . $statusInfo['text'] . '</span></center></td>';
                  
                        $invitation = $rowReviewer->accept;
                        $statusText = ($invitation == 1 ? 'Accepted' : ($invitation == 2 ? 'Declined' : 'Pending'));
                        $statusColor = ($invitation == 1 ? 'green' : ($invitation == 2 ? 'orange' : 'gray'));
                        
                        echo '<td style="font-weight: bold; color: ' . $statusColor . ';">' . $statusText . ' </td>';
                     
                        


                      
                      
                       
                        echo '</tr>';

                          

                        

                          echo '</tr>';
                      }
                      echo '</tbody>';
                      echo '</table>';

                      
                      $queryReviewr = "SELECT COUNT(*) as total FROM reviewer_assigned WHERE `author_id` = :author_id";
                      $countResultReviewer = database_run($queryReviewr, $varsReviewer);
                      $totalCount = $countResultReviewer[0]->total;

                      $totalPages = ceil($totalCount / $itemsPerPage);


                      echo '<nav aria-label="Page navigation example" class="mt-3">';
                      echo '<ul class="pagination justify-content-end">';
                      for ($i = 1; $i <= $totalPages; $i++) {
                          echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                      }
                      echo '</ul>';
                      echo '</nav>';

                              } else {
                                  echo '<div class="p-4">You are not invited to as reviewer yet for article</div>';
                              }
                          }



                ?>



                </div>
              </div>
            </div>
            <hr class="full-width">
          </div>
        </div>



      </div>
    </div>

    <div class="footer" id="footer">
      <!-- footer will be display here by fetching reusable files -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../JS/reusable-header.js"></script>
    <script src="../JS/author-dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        })
        .catch(error => console.error('Error loading navbar.php:', error));
    }

    function attachNotificationButtonListener() {
      $(document).on('click', '#notification-button', function () {
        // Send AJAX request to mark notifications as read
        $.ajax({
          url: "../PHP/mark_notifications_read.php",
          type: "POST",
          data: { author_id: <?php echo $_SESSION['id']; ?> },
          success: function (response) {
            console.log("Notifications marked as read:", response);
            // Update notification count on success
            $("#notification-count").text("0");
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