<?php
session_start();
$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <form action="" method="GET" class="search-form" id="search-form">
            <div class="search-container d-flex align-items-center">
                <input list="articlesList" id="result" type="text" class="form-control me-2 py-3" placeholder="Search Articles..."
                    class="search-bar"
                    style="width: 583px; height: 30px; font-style: italic; background-color: white;" />
                    <datalist id="articlesList">
                       
                    </datalist>
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

            <div class="info-container">
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
            <!-- Filters Here -->
            <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
            <div class="filters">
                <h5 style="color: #0858a4;">Filter search results</h5>
                <!-- Journals, Year Published, etc. -->
                <div class="checkbox-container">
                    <h5 class="mb-2" style="color: #959595;"><b>JOURNALS</b></h5>
                    <div id="journals-container" class="d-flex flex-column">
         
                    </div>
                </div>
                <div class="checkbox-container">
                    <h5 class="mb-2" style="color: #959595;"><b>YEAR PUBLISHED</b></h5>
                    <div id="years-container" class="d-flex flex-column">
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
                        <option value="" hidden>Recently added</option>
                        <option value="title">Title</option>
                        <option value="recently_added">Recently added</option>
                        <option value="publication-date">Publication Date</option>
                        <optgroup label="Popularity">
                            <option value="popular">All</option>
                            <option value="views">Views</option>
                            <option value="downloads">Downloads</option>
                            <option value="citations">Citations</option>
                        </optgroup>

                    </select>
                </div>
            </div>
            <div id="skeleton-container" class="">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
            <div id="articles" class="d-flex flex-column gap-2 mb-4 w-100">

            </div>

            <!-- Repeat for more articles -->
            <!-- Pagination -->
            <!-- Bootstrap Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" id="pagination-container">
                    <!-- Display "Previous" link if not on the first page -->
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0);" onclick="changePage('previous')"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <!-- Display page numbers -->
                    <li class="page-item"><a class="page-link" href="javascript:void(0);"
                            onclick="changePage(0)">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(1)">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(2)">3</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(3)">4</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(4)">5</a>
                    </li>
          
          
                    <!-- Display "Next" link if not on the last page -->
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0);" onclick="changePage('next')" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
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
            <div class="d-flex flex-sm-column flex-xl-row container-fluid gap-4 justify-content-between" style="width:85%;">
                <div id="popular-monthly" class="articles-container col-sm-12 col-lg-7">
                    <!-- fetch popular articles using api -->
                </div>
                <div class="divider "></div>
                <div class="col-sm-12 col-lg-4 d-flex flex-column gap-2" id="most-popular-container">
                    <h6 class="text-lg mb-2">
                        <select class="form-select" id="sort-select">
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
    <script src="../JS/most-downloaded-api.js"></script>
    <script src="../JS/home-monthly-api.js"></script>
    <script src="../JS/browse-api.js"></script>

</body>

</html>