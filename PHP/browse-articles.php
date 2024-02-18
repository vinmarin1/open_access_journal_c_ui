<?php
session_start();
$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./meta.php'); ?>
    <title>QCU PUBLICATION | BROWSE ARTICLES</title>
    <link rel="stylesheet" href="../CSS/browse-articles.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="header-container" id="header-container">

    </div>

    <nav class="navigation-menus-container" id="navigation-menus-container">

    </nav>

    <div class="content-over">
        <div class="cover-content">
            <p>Home / Browse / Articles</p>
            <h4>Articles</h4>
        </div>
        <form action="" method="GET" class="search-form w-50" style="min-width: 20rem;" id="search-form">
            <div class="search-container d-flex flex-sm-row flex-column align-sm-items-center align-items-start gap-1">
                <input list="articlesList" id="result" type="text" class="form-control me-2 py-3" placeholder="Search Articles..."
                    class="search-bar"
                    style="height: 30px; font-style: italic; background-color: white;" />
                    <!-- <datalist id="articlesList">
                       
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

    <div class="main-container container-fluid">
        <div class="row w-100">
        <div class="sidebar col-lg-3 col-md-12">
            <h4 style="color: #0858a4;"><b><span id="total"></span></b></h4>
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
                <h4 class="btn collapsed p-0" style="color: #0858a4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">
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
                    <span class="sort-by-text" style="color: #0858a4;">Sort by</span>
                    <span class="sort-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 20 20">
                            <path fill="#e6e6e6" d="M11 7H1l5 7zm-2 7h10l-5-7z" /></svg></span>
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

            <!-- Repeat for more articles -->
            <!-- Pagination -->
            <!-- Bootstrap Pagination -->
            <nav aria-label="Page navigation d-flex justify-items-center align-items-center w-100">
                <ul class="pagination d-flex flex-wrap w-100" id="pagination-container">
                    <!-- Display page numbers -->
                    <li class="page-item"><a class="page-link" href="javascript:void(0);"
                            onclick="changePage(0)">1</a></li>
                    </li>
                </ul>
            </nav>
        </div></div>
    </div>

    <div class="fluid-container">
        <div class="recommendation-article">
            <h4>Tailored for You: Recommended Articles Based on Your Interactions</h4>
            <div id="recommendations" class="articles-container">
            </div>
        </div>
    </div>
    </div>
    <div class="fluid-container">
        <div class="recommendation-article">
            <h4>Discover our Most Popular Article </h4>
            <div id="all-popular-articles" class="articles-container">
            </div>
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
    <script src="../JS/reusable-header.js"></script>
    <script src="../JS/home-recommended-api.js"></script>
    <script src="../JS/most-popular-api.js"></script>
    <script src="../JS/home-monthly-api.js"></script>
    <?php include '../JS/browse/browse.php'; ?>

</body>

</html>