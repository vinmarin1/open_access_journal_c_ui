<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | BROWSE ARTICLES</title>
    <link rel="stylesheet" href="../CSS/browse-articles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>

<?php

include('dbcon.php');
// Assuming you have a database connection

// Fetch the total count of articles from the database
$query = "SELECT COUNT(*) AS total_articles FROM article";
$vars = array(); // Assuming no variables are needed for this query

$data = database_run($query, $vars);    

if ($data) {
    $totalArticles = $data[0]->total_articles;
} else {
    // Handle database error
    $totalArticles = 0; 
}   
?>


<div class="header-container" id="header-container">

</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">

</nav>

    <div class="content-over">
        <div class="cover-content">
            <p>Home / Browse / Articles</p>
            <h2>Articles</h2>
        </div>
        <form action="/search" method="GET" class="search-form">
            <div class="search-container">
                <input type="text" name="form-control me-2" class="form-control me-2" placeholder="Search Journals" class="search-bar" style="width: 583px; height: 30px; font-style: italic; background-color: white;" />
                <!-- Remove the unnecessary closing button tag -->
            </div>
            <div class="info-container">
                <span class="info-icon" >&#9432;</span>
                <span class="search-info" >SEARCH BY TITLE, AUTHOR, OR KEYWORD. FOR BETTER RESULTS SEPARATE IT WITH COMMAS (E.G. AI TECHNOLOGY, JUAN DELA CRUZ)</span>
            </div>
        </form>
    </div>

<div class="main-container">
    <div class="sidebar">
        <h4 style="color: #115272;"><b><?php echo $totalArticles; ?> searchable articles</b></h4>
        <!-- Filters Here -->
        <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
        <div class="filters">
            <h5 style="color: #115272;">Filter search results</h5>
            <!-- Journals, Year Published, etc. -->
            <div class="checkbox-container">
                        <h5 class="mb-2" style="color: #959595;"><b>JOURNALS</b></h5>
                        <label class="checkbox-label"><input type="checkbox" class="checkbox" /> The Gavel</label><br>
                        <label class="checkbox-label"><input type="checkbox" class="checkbox" /> The Lamp</label><br>
                        <label class="checkbox-label"><input type="checkbox" class="checkbox" /> The Star</label><br>
            </div>
            <div class="checkbox-container">
                <h5 class="mb-2" style="color: #959595;"><b>YEAR PUBLISHED</b></h5>
                <label class="checkbox-label"><input type="checkbox" class="checkbox" /> 2022</label><br>
                <label class="checkbox-label"><input type="checkbox" class="checkbox" /> 2023</label><br>
                <label class="checkbox-label"><input type="checkbox" class="checkbox" /> 2024</label><br>
            </div>
        </div>
    </div>
    <div class="articles-containers">
        <!-- Article 1 -->
        <div class="sort-container">
            <div class="sort-header">
                <span class="sort-by-text" style="color: #115272;">Sort by</span>
                <span class="sort-icon">▼</span> <!-- Replace with an actual vector icon if available -->
            </div>
            <select id="sortby" name="sortby" class="sort-dropdown" style="color: #115272;">
            <option value="recently_added">Recently added</option>
            <option value="most_viewed">Most viewed</option>
            <option value="most_downloaded">Most downloaded</option>
            <!-- Additional sort options here -->
            </select>
        </div>
        <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
        <div class="articles">
            <div class="article-details">
                <h6 style="color: #115272;"><strong>Article About The Future of Artificial Intelligence: Advancements and Ethical Considerations (MARCH 2023)</strong></h6>
                <p style="color: #454545;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                <div class="keywords">
                    <span class="keyword">technology</span>
                    <span class="keyword">covid-19</span>
                    <span class="keyword">innovation</span>
                    <!-- Add more keywords here -->
                </div>
            </div>
            <div class="article-stats">
                <div class="stats-container">
                    <div class="view-download">
                        <p class="stats-value" style="color: #115272;">10.2k</p>
                        <p class="stats-label" style="color: #959595;">VIEWS</p>
                    </div>
                    <div class="view-download">
                        <p class="stats-value" style="color: #115272;">48k</p>
                        <p class="stats-label" style="color: #959595;">DOWNLOADS</p>
                    </div>
                </div>
                <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
                <div class="published-info">
                    <h6 class="publish-label" style="color: #115272;"><strong>Published in The Gavel</strong></h6>
                    <p class="authors" style="color: #959595;">M. Baumgart, N. Drumil, M. Consani</p>
                </div>
            </div>
        </div>
        <div class="articles">
            <div class="article-details">
                <h6 style="color: #115272;"><strong>Article About The Future of Artificial Intelligence: Advancements and Ethical Considerations (MARCH 2023)</strong></h6>
                <p style="color: #454545;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                <div class="keywords">
                    <span class="keyword">technology</span>
                    <span class="keyword">covid-19</span>
                    <span class="keyword">innovation</span>
                    <!-- Add more keywords here -->
                </div>
            </div>
            <div class="article-stats">
                <div class="stats-container">
                    <div class="view-download">
                        <p class="stats-value" style="color: #115272;">10.2k</p>
                        <p class="stats-label" style="color: #959595;">VIEWS</p>
                    </div>
                    <div class="view-download">
                        <p class="stats-value" style="color: #115272;">48k</p>
                        <p class="stats-label" style="color: #959595;">DOWNLOADS</p>
                    </div>
                </div>
                <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
                <div class="published-info">
                    <h6 class="publish-label" style="color: #115272;"><strong>Published in The Gavel</strong></h6>
                    <p class="authors" style="color: #959595;">M. Baumgart, N. Drumil, M. Consani</p>
                </div>
            </div>
        </div>
        <div class="articles">
            <div class="article-details">
                <h6 style="color: #115272;"><strong>Article About The Future of Artificial Intelligence: Advancements and Ethical Considerations (MARCH 2023)</strong></h6>
                <p style="color: #454545;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                <div class="keywords">
                    <span class="keyword">technology</span>
                    <span class="keyword">covid-19</span>
                    <span class="keyword">innovation</span>
                    <!-- Add more keywords here -->
                </div>
            </div>
            <div class="article-stats">
                <div class="stats-container">
                    <div class="view-download">
                        <p class="stats-value" style="color: #115272;">10.2k</p>
                        <p class="stats-label" style="color: #959595;">VIEWS</p>
                    </div>
                    <div class="view-download">
                        <p class="stats-value" style="color: #115272;">48k</p>
                        <p class="stats-label" style="color: #959595;">DOWNLOADS</p>
                    </div>
                </div>
                <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
                <div class="published-info">
                    <h6 class="publish-label" style="color: #115272;"><strong>Published in The Gavel</strong></h6>
                    <p class="authors" style="color: #959595;">M. Baumgart, N. Drumil, M. Consani</p>
                </div>
            </div>
        </div>
        <div class="articles">
            <div class="article-details">
                <h6 style="color: #115272;"><strong>Article About The Future of Artificial Intelligence: Advancements and Ethical Considerations (MARCH 2023)</strong></h6>
                <p style="color: #454545;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                <div class="keywords">
                    <span class="keyword">technology</span>
                    <span class="keyword">covid-19</span>
                    <span class="keyword">innovation</span>
                    <!-- Add more keywords here -->
                </div>
            </div>
            <div class="article-stats">
                <div class="stats-container">
                    <div class="view-download">
                        <p class="stats-value" style="color: #115272;">10.2k</p>
                        <p class="stats-label" style="color: #959595;">VIEWS</p>
                    </div>
                    <div class="view-download">
                        <p class="stats-value" style="color: #115272;">48k</p>
                        <p class="stats-label" style="color: #959595;">DOWNLOADS</p>
                    </div>
                </div>
                <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
                <div class="published-info">
                    <h6 class="publish-label" style="color: #115272;"><strong>Published in The Gavel</strong></h6>
                    <p class="authors" style="color: #959595;">M. Baumgart, N. Drumil, M. Consani</p>
                </div>
            </div>
        </div>
    <!-- Repeat for more articles -->
    <!-- Pagination -->
        <!-- Bootstrap Pagination -->
        <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <!-- Display "Previous" link if not on the first page -->
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="changePage('previous')" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <!-- Display page numbers -->
            <li class="page-item"><a class="page-link active" href="javascript:void(0);" onclick="changePage(1)">1</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(2)">2</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(3)">3</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(4)">4</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(5)">5</a></li>

            <!-- Display "Next" link if not on the last page -->
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="changePage('next')" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
        </nav>
    </div>
</div>


<div class="fluid-container">
<div class="recommendation-article">
<h4>Recommended for you</h4>
  <div class="articles-container">
  <div class="article">
  <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
    <div class="article-info">
      <p class="info">THE LAMP</p>
      <span class="views"></span>103 views
    </div>
    <p class="author">By Jane Delacruz</p>
    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
    background-color: transparent;
    border-radius: 20px;
    color: #115272;
    width: 100%;">Read Article</button>
  </div>
  <div class="article">
  <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
    <div class="article-info">
      <p class="info">THE LAMP</p>
      <span class="views"></span>103 views
    </div>
    <p class="author">By Jane Delacruz</p>
    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
    background-color: transparent;
    border-radius: 20px;
    color: #115272;
    width: 100%;">Read Article</button>
  </div>

  <div class="article">
  <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
    <div class="article-info">
      <p class="info">THE LAMP</p>
      <span class="views"></span>103 views
    </div>
    <p class="author">By Jane Delacruz</p>
    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
    background-color: transparent;
    border-radius: 20px;
    color: #115272;
    width: 100%;">Read Article</button>
  </div>

  <div class="article">
  <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
    <div class="article-info">
      <p class="info">THE LAMP</p>
      <span class="views"></span>103 views
    </div>
    <p class="author">By Jane Delacruz</p>
    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
    background-color: transparent;
    border-radius: 20px;
    color: #115272;
    width: 100%;">Read Article</button>
  </div>

  <div class="article">
  <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
    <div class="article-info">
      <p class="info">THE LAMP</p>
      <span class="views"></span>103 views
    </div>
    <p class="author">By Jane Delacruz</p>
    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
    background-color: transparent;
    border-radius: 20px;
    color: #115272;
    width: 100%;">Read Article</button>
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




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../JS/reusable-header.js"></script>

</body>
</html>