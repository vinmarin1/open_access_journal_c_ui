<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>QCUJ | Issues</title>
    <link rel="stylesheet" href="../CSS/issues.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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
            <p>Home / Browse / Journal / Issues</p>
            <h2 >Issues</h2>
        </div>
    </div>

    <section id="journals" class="d-flex flex-column flex-md-row gap-5" >
        <div class="pub-container mb-3 w-50" id="journal" style="min-width:300px">
            <div class="journal-title">
                <h3 id="journal_title">
                </h3>
            </div>
            <div class="journal-details">
                <p style="text-align: justify;" class="d-none" id="journal_details">
                </p>
                <div style="text-align: justify;"  id="journal_subject">
                </div>
                <h5>Other links</h5>
                <a href="issues.php?journal_id=1">Gavel</a> |
                <a href="issues.php?journal_id=2">Lamp</a> |
                <a href="issues.php?journal_id=3">Star</a> |
            </div>
         
            <!-- <hr style="height: 1px; background-color: var(--main, #0858A4); width: 100%"> -->
        </div>
        <div id="issues-per-year-container" class="container w-100">
            <div id="skeleton-container" class="d-flex">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="all-issues">
            </div>
        </div>
   
    </section>

</div>




<div class="footer" id="footer">
    <!-- footer will be display here by fetching reusable files -->
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../JS/reusable-header.js"></script>
    <script src="../JS/issues.js"></script>
    <!--<script src="../JS/publication.js"></script>-->
</body>
</html>