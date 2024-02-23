<?php
include 'function/submission_functions.php';

$journal = get_journal_list();
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>ADMIN | QCU OPEN ACCESS JOURNAL</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../images/qcu-logo.webp" />

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
</head>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="dashboard.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="../assets/img/qculogo.png" alt="QCULogo" class="w-100"/>
            </span>
              <span class="app-brand-text demo menu-text fw-bold ms-2">QCU Journal</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>
          <ul class="menu-inner py-1">
          <li class="menu-header small text-uppercase"><span class="menu-header-text">Main</span></li>
            <!-- Dashboards -->

            <li class="menu-item">
              <a href="dashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Boxicons">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="journalview.php" class="menu-link <?php if(basename($_SERVER['PHP_SELF']) == 'allsubmissionlist.php') echo 'active'; ?>">
                  <i class="menu-icon tf-icons bx bx-detail"></i>
                  <div data-i18n="Boxicons">Submission</div>
              </a>
          </li>
          
            <?php
              if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
                $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';

                  if(empty($journal_id) && $journal_id !== NULL) {
              ?>

              <li class="menu-header small text-uppercase"><span class="menu-header-text">Secondary</span></li>
                <li class="menu-item">
                  <a href="announcementlist.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-detail"></i>
                    <div data-i18n="Boxicons">Announcement</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="issuelist.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-detail"></i>
                    <div data-i18n="Boxicons">Issue</div>
                  </a>
                </li>   

                <li class="menu-item">
                  <a href="faqslist.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-detail"></i>
                    <div data-i18n="Boxicons">FAQS</div>
                  </a>
                </li>  

                <?php
                  }
              }
              ?>

            <!-- Forms & Tables -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Settings</span></li>
              <!-- Tables -->
              <li class="menu-item">
                <a href="journallist.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-table"></i>
                  <div data-i18n="Tables">Journal</div>
                </a>
              </li>

              <?php
              if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
                $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';

                  if(empty($journal_id) && $journal_id !== NULL) {
              ?>

              <li class="menu-item">
                <a href="userandroleslist.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-table"></i>
                  <div data-i18n="Tables">User & Roles</div>
                </a>
              </li>

              <li class="menu-item">
                <a href="questionnaire.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-table"></i>
                  <div data-i18n="Tables">Questionnaire</div>
                </a>
              </li>

            <!-- Reports -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">OTHERS</span></li>
            <!-- Tables -->
            <li class="menu-item">
              <a href="reportlist.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">Reports</div>
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

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
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
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/profile.jpg" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/profile.jpg" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                          <?php
                              if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
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
          </nav
      
