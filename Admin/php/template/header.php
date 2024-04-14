<?php
include 'function/submission_functions.php';

$journal = get_journal_list();
// $notication = get_notification_count();
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>ADMIN | Pahina</title>

  <!-- <meta name="description" content="" /> -->

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="../../images/pahina-full.png">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/css/new.css" />
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <!-- Quill CSS -->
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

  <!-- Quill JavaScript -->
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<style>
#text{
  color: white;
}
</style>
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background-color: #004e98 !important">
        <div class="app-brand demo">
          <a href="dashboard.php" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="../../images/pahina-final-light.png" alt="QCULogo" class="w-75" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Pahina Journal</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>
        <ul class="menu-inner py-1">
          <li class="menu-header small text-uppercase" id="text"><span class="menu-header-text" id="text">Main</span></li>
          <!-- Dashboards -->
          <?php
          if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
            $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';

            if (empty($journal_id) && $journal_id !== NULL) {
          ?>

            <li class="menu-item">
              <a href="dashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div data-i18n="Boxicons" id="text">Dashboard</div>
              </a>
            </li>

          <?php
            }
          }
          ?>

          <?php
          if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
            $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';

            if (!empty($journal_id)) {
          ?>
          <li class="menu-item">
            <a href="editordashboard.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-dashboard"></i>
              <div data-i18n="Boxicons" id="text">Dashboard</div>
            </a>
          </li>

          <?php
            }
          }
          ?>

          <li class="menu-item">
            <a href="journalview.php" class="menu-link <?php if (basename($_SERVER['PHP_SELF']) == 'allsubmissionlist.php') echo 'active'; ?>">
              <i class="menu-icon tf-icons bx bx-windows"></i>
              <div data-i18n="Boxicons" id="text">Submission</div>
            </a>
          </li>

          <li class="menu-header small text-uppercase" id="text"><span class="menu-header-text" id="text">Secondary</span></li>
          
          <?php
          if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
            $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';

            if (empty($journal_id) && $journal_id !== NULL) {
          ?>
              <li class="menu-item">
                <a href="announcementlist.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-microphone"></i>
                  <div data-i18n="Boxicons" id="text">Announcement</div>
                </a>
              </li>

              <?php
            }
          }
          ?>
              <li class="menu-item">
                <a href="issuelist.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-list-plus"></i>
                  <div data-i18n="Boxicons" id="text">Issue</div>
                </a>
              </li>

              <?php
              if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
                $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';

                if (empty($journal_id) && $journal_id !== NULL) {
              ?>

              <li class="menu-item">
                <a href="faqslist.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-message-check"></i>
                  <div data-i18n="Boxicons" id="text">FAQS</div>
                </a>
              </li>

              <li class="menu-item">
                <a href="message.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-message-alt-check"></i>
                  <div data-i18n="Boxicons" id="text">Message</div>
                </a>
              </li>


          <?php
            }
          }
          ?>

          <!-- Forms & Tables -->
          <li class="menu-header small text-uppercase" id="text"><span class="menu-header-text" id="text">Settings</span></li>
          <!-- Tables -->
          <li class="menu-item">
            <a href="journallist.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-detail"></i>
              <div data-i18n="Tables" id="text">Journal</div>
            </a>
          </li>

          <?php
          if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
            $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';

            if (empty($journal_id) && $journal_id !== NULL) {
          ?>

              <li class="menu-item">
                <a href="userandroleslist.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-user-circle"></i>
                  <div data-i18n="Tables" id="text">User & Roles</div>
                </a>
              </li>

              <li class="menu-item">
                <a href="questionnaire.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-list-minus"></i>
                  <div data-i18n="Tables" id="text">Questionnaire</div>
                </a>
              </li>

              <?php
            }
          }
          ?>
              <!-- Reports -->
              <li class="menu-header small text-uppercase" id="text"><span class="menu-header-text" id="text">OTHERS</span></li>
              <!-- Tables -->
              <li class="menu-item">
                <a href="reportlist.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-report"></i>
                  <div data-i18n="Tables" id="text">Reports</div>
                </a>
              </li>

            <?php
            if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
              $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';
                if (empty($journal_id) && $journal_id !== NULL) {
              ?>
                  <li class="menu-item">
                    <a href="archivelist.php" class="menu-link">
                      <i class="menu-icon tf-icons bx bxs-archive"></i>
                      <div data-i18n="Tables" id="text">Archived</div>
                    </a>
                  </li>
            <?php
                }
              }
            ?>

          <!-- Misc -->
          <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item">
              <a
                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
              </a>
            </li> -->
        </ul>
      </aside>
      <script>
        // Get the current URL
        var currentUrl = window.location.href;

        // Get all menu links
        var menuLinks = document.querySelectorAll('.menu-link');

        // Loop through each menu link
        menuLinks.forEach(function(link) {
          // Check if the link's href matches the current URL or is a parent of the current URL
          if (currentUrl.startsWith(link.href) || currentUrl === link.href) {
            // Add the "active" class to the parent <li> element
            link.parentNode.classList.add('active');
          }
        });
      </script>
      <!-- / Menu -->
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm" style="color: black;"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <!-- <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Search..."
                    aria-label="Search..." />
                </div>
              </div> -->
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="bell-icon" href="#" data-toggle="tooltip" data-placement="bottom" href="javascript:void(0);" data-bs-toggle="dropdown" title="Notification" aria-label="Notification" style="position: relative; margin-right: 10px;">
                      <i class="menu-icon tf-icons bx bx-bell" style="position: relative; color: black;"></i>
                      <span id="notification-count" class="badge bg-danger rounded-circle" style="position: absolute; top: -8px; right: -2px;"></span>
                  </a>
                  <ul id="notification-list" class="dropdown-menu dropdown-menu-end">
                  </ul>
              </li>

              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <?php
                  if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) { 
                      $profile_pic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : '';
                      if (!empty($profile_pic)) {
                          echo '<div class="avatar avatar-online">
                                    <img src="../' . $profile_pic . '" alt="" class="w-40 h-40 object-fit-cover rounded-circle" />
                                </div>';
                      } else {
                          echo '<div class="avatar avatar-online">
                                    <img src="../assets/img/profile.jpg" alt="" class="w-40 h-40 object-fit-cover rounded-circle" />
                                </div>';
                      }
                  }
                  ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                        <?php
                          if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) { 
                              $profile_pic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : '';
                              if (!empty($profile_pic)) {
                                  echo '<div class="avatar avatar-online">
                                            <img src="../' . $profile_pic . '" alt="" class="w-40 h-40 object-fit-cover rounded-circle" />
                                        </div>';
                              } else {
                                  echo '<div class="avatar avatar-online">
                                            <img src="../assets/img/profile.jpg" alt="" class="w-40 h-40 object-fit-cover rounded-circle" />
                                        </div>';
                              }
                          }
                          ?>
                        </div>
                        <div class="flex-grow-1">
                          <?php
                          if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
                            $firstName = isset($_SESSION['first_name']) ? ucfirst($_SESSION['first_name']) : '';
                            $middleName = isset($_SESSION['middle_name']) ? ' ' . ucfirst($_SESSION['middle_name']) : '';
                            $lastName = isset($_SESSION['last_name']) ? ' ' . ucfirst($_SESSION['last_name']) : '';

                            echo '<span class="fw-medium d-block">' . $firstName . $middleName . $lastName . '</span>';
                          }
                          ?>
                          <small class="text-muted">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../../PHP/author-dashboard.php">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">User Dashboard</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../../PHP/logout.php">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.2/howler.core.min.js"></script>
<script>
var pusher = new Pusher('cabcad916f55a998eaf5', {
  cluster: 'ap1'
});
var channel = pusher.subscribe('my-channel');

channel.bind('my-event', function(data) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var newData = JSON.parse(xhr.responseText);
        var timer;
        var sound = new Howl({
          src: ['data:audio/mpeg;base64,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zpQCgqZMQU1FMy4xMDBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV//uSRPcPA01ou4DDFTBX4xfZBCMATOGi1gGEdkGSNFrYMQ7JVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVQ==']
        });

        sound.play();
        updateNotifications(newData);
        clearInterval(timer);
      } else {
        console.error('Failed to fetch notification data:', xhr.statusText);
      }
    }
  };
  xhr.open('GET', 'function/get_notification_count.php', true);
  xhr.send();
});

function updateNotifications(data) {
  var notificationCount = document.getElementById('notification-count');

    if (data.count == 0) {
        notificationCount.textContent = '';
        notificationCount.style.display = 'none'; 
    } else {
        notificationCount.textContent = data.count; 
        notificationCount.style.display = 'block';
    }

    var notificationList = document.getElementById('notification-list');
    notificationList.innerHTML = '';

    var headerItem = document.createElement('li');
    headerItem.innerHTML = `
        <a class="dropdown-item">Notification</a>
    `;
    notificationList.appendChild(headerItem);

    if (data.data && data.data.length) {
        data.data.slice(0, 5).forEach(notification => {
            var listItem = document.createElement('li');

            var chunks = [];
            for (var i = 0; i < notification.description.length; i += 50) {
                chunks.push(notification.description.substr(i, 50));
            }
            var formattedDescription = chunks.join('<br>');
            var notificationTime = new Date(notification.created);

            var currentTime = new Date();
            var options = {
              timeZone: 'Asia/Manila',
              hour12: false
            };
            var currentTimeManila = currentTime.toLocaleString('en-US', options);

            var timeDifference = Math.abs(currentTime - notificationTime);
            var timeAgo;

            if (timeDifference < 60000) {
                const seconds = Math.floor(timeDifference / 1000);
                timeAgo = seconds + (seconds === 1 ? ' second ago' : ' seconds ago');
            } else if (timeDifference < 3600000) {
                const minutes = Math.floor(timeDifference / 60000);
                timeAgo = minutes + (minutes === 1 ? ' minute ago' : ' minutes ago');
            } else if (timeDifference < 86400000) {
                const hours = Math.floor(timeDifference / 3600000);
                timeAgo = hours + (hours === 1 ? ' hour ago' : ' hours ago');
            } else {
                const days = Math.floor(timeDifference / 86400000);
                timeAgo = days + (days === 1 ? ' day ago' : ' days ago');
            }

            var article_id = notification.article_id;
            var id = notification.id;
            var currentMonth = '<?php echo date('n'); ?>';
            var currentYear = '<?php echo date('Y'); ?>';

            var donationHref = "donationreportmtd.php?m=" + currentMonth + "&y=" + currentYear;
            var articleHref = "workflow.php?aid=" + article_id;

            listItem.innerHTML = `
                <li style="background-color: ${notification.read == 1 ? '#d9dee3 !important' : 'white !important'};">
                    <a href="${notification.title === 'Send Donation' ? donationHref : articleHref}" class="dropdown-item notification-link">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <span class="align-middle"><b>${notification.title}</b></span>
                                <br>
                                <span class="notification-description" style="word-wrap: break-word; max-width: 100%;">${formattedDescription}</span>
                                <br>
                                <span class="align-middle">${timeAgo}</span>
                            </div>
                        </div>
                    </a>
                </li>
                <div class="dropdown-divider" style="background-color: #d9dee3 !important;"></div>
            `;

            notificationList.appendChild(listItem);

            var notificationLink = listItem.querySelector('.notification-link');
            notificationLink.addEventListener('click', function(event) {
                event.preventDefault();
                var href = notificationLink.href;
                window.location.href = href;
            });

            listItem.addEventListener('click', function() {
                $.ajax({
                    type: 'POST',
                    url: 'function/update_notification.php',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            console.log(response.message);
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error: ' + status + ' - ' + error);
                    }
                });
            });
        });

        if (data.data.length > 5) {
            var seeAllItem = document.createElement('li');
            seeAllItem.innerHTML = `
                <a class="dropdown-item text-center" href="notification.php">See All</a>
            `;
            notificationList.appendChild(seeAllItem);
        }
    } else {
        console.error('No notification data available or data is invalid.');
    }
}

window.addEventListener('load', function() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var data = JSON.parse(xhr.responseText);
        updateNotifications(data);
      } else {
        console.error('Failed to fetch notification data:', xhr.statusText);
      }
    }
  };
  xhr.open('GET', 'function/get_notification_count.php', true);
  xhr.send();
});
</script>