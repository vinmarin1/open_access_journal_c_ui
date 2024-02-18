<?php
session_start();
$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>QCU PUBLICATION | QCU JOURNALS</title>
    <link rel="stylesheet" href="../CSS/all-issues.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">

</head>
<body>

<div class="header-container" id="header-container">
<!-- header will be display here by fetching reusable files -->
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
<!-- navigation menus will be display here by fetching reusable files -->
</nav>

<div class="main-container">
    <div class="content-over">
        <div class="cover-content">
            <p>Home / Issues</p>
            <h2 id="issue-title"></h2>
        </div>
    </div>


        <section class="pub-container d-flex gap-4">
            <div class="issue-title">
                <div class="pic-border">
                    <img class="img-fluid"  alt="">
                </div>
                <div class="issue-details">
                    <h4 style="color:#285581">Published in <h4 id="issue-journal"></h4></h4><br>
                    <p><strong style="color:#285581">ISSN (Online):</strong><br> <span id="issue-issn"></span> (Online)</p><br>
                    <p><strong style="color:#285581">Online Date Start:</strong><br> <span id="issue-date"></span></p><br>
                </div>
            </div>

            <div class="">
                <!-- <div class=" d-flex gap-2">
                    <div class="sort-header">
                        <span class="sort-by-text" style="color: #0858a4;">Sort by</span>
                        <span class="sort-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 20 20">
                                <path fill="#e6e6e6" d="M11 7H1l5 7zm-2 7h10l-5-7z" /></svg></span>
                    </div>
                    <div>
                        <select id="sortby" name="sortby" class="sort-dropdown form-select form-select-sm" >
                            <option value="" hidden>Latest</option>
                            <option value="title">Oldest</option>
                            <option value="recently_added">Popular</option>
                            <option value="publication-date">Most Downloaded</option>
                            <option value="publication-date">Most Cited</option>
                            <option value="publication-date">Most Gift</option>
                        </select>
                    </div>
                </div> -->
                <div class="">
                    <div class="continue-reading" id="articles-by-issue">

                    </div>
                    <nav aria-label="Page navigation d-flex justify-items-center align-items-center w-100">
                    <ul class="pagination">
                        <button class="page-item border bg-white border-primary py-2 px-4 link-primary rounded hover:opacity-80" id="previous-page">Previous</button>
                        <li class="page-item px-4 py-2" id="current-page">1</li>
                        <button class="page-item border bg-white border-primary py-2 px-4 rounded link-primary hover:opacity-80" id="next-page">Next</button>
                    </ul>

                    </nav>
                </div>
            </div>
        </section>
</div>

<div class="footer" id="footer">
    <!-- footer will be display here by fetching reusable files -->
</div>
<script>
        const sessionId = "<?php echo $author_id; ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../JS/reusable-header.js"></script>
    <script src="../JS/cloudConvert.js"></script>
    <script src="../JS/all-issues.js"></script>

</body>
</html>