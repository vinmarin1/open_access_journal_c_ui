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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>




<div class="header-container" id="header-container">

</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">

</nav>

    <div class="content-over">
        <div class="cover-content">
            <p>Home / Browse / Articles</p>
            <h2>Articles</h2>
        </div>
        <form action="" method="GET" class="search-form" id="search-form">
            <div class="search-container d-flex align-items-center">
                <input id="result" type="text"  class="form-control me-2" placeholder="Search Articles..." class="search-bar" style="width: 583px; height: 30px; font-style: italic; background-color: white;" />
                <div class="d-flex flex-row-reverse">
                <button class="btn tbn-primary btn-md" id="btn3" >Search</button>
                <button class="btn tbn-primary btn-md" onclick="startConverting();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="white" d="M16 2a6 6 0 0 0-6 6v8a6 6 0 0 0 12 0V8a6 6 0 0 0-6-6ZM7 15a1 1 0 0 1 1 1a8 8 0 1 0 16 0a1 1 0 1 1 2 0c0 5.186-3.947 9.45-9.001 9.95L17 26v3a1 1 0 1 1-2 0v-3l.001-.05C9.947 25.45 6 21.187 6 16a1 1 0 0 1 1-1Z"/></svg>
                </button>
                </div>
            </div>
            <!-- <div id="result"></div> -->
         
            <div class="info-container">
                <span class="info-icon" >&#9432;</span>
                <span class="search-info" >SEARCH BY TITLE, AUTHOR, OR KEYWORD. FOR BETTER RESULTS SEPARATE IT WITH COMMAS (E.G. AI TECHNOLOGY, JUAN DELA CRUZ)</span>
            </div>
        </form>
    </div>

<div class="main-container">
    <div class="sidebar">
        <h4 style="color: #0858a4;"><b><span id="total"></span></b></h4>
        <!-- Filters Here -->
        <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
        <div class="filters">
            <h5 style="color: #0858a4;">Filter search results</h5>
            <!-- Journals, Year Published, etc. -->
            <div class="checkbox-container">
                        <h5 class="mb-2" style="color: #959595;"><b>JOURNALS</b></h5>
                        <label class="checkbox-label"><input type="checkbox" class="checkbox" /> The Gavel (20)</label><br>
                        <label class="checkbox-label"><input type="checkbox" class="checkbox" /> The Lamp (22)</label><br>
                        <label class="checkbox-label"><input type="checkbox" class="checkbox" /> The Star (30)</label><br>
            </div>
            <div class="checkbox-container">
                <h5 class="mb-2" style="color: #959595;"><b>YEAR PUBLISHED</b></h5>
                <label class="checkbox-label"><input type="checkbox" id="year1" class="checkbox" value=2022 /> 2022 (33)</label><br>
                <label class="checkbox-label"><input type="checkbox" id="year2" class="checkbox" value=2023 /> 2023 (44)</label><br>
                <label class="checkbox-label"><input type="checkbox" id="year3" class="checkbox" value=2024 /> 2024 (32)</label><br>
            </div>
        </div>
    </div>
    <div class="articles-containers">
        <!-- Article 1 -->
        <div class="sort-container">
            <div class="sort-header">
                <span class="sort-by-text" style="color: #0858a4;">Sort by</span>
                <span class="sort-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="#e6e6e6" d="M11 7H1l5 7zm-2 7h10l-5-7z"/></svg></span> <!-- Replace with an actual vector icon if available -->
            </div>
            <select id="sortby" name="sortby" class="sort-dropdown" style="color: #0858a4;">
            <option value="" hidden>Choose</option>
            <option value="title">Title</option>
            <option value="recently_added">Recently added</option>
            <option value="publication-date">Publication Date</option>
            <option value="popular">Interactions (All)</option>
            <option value="popular">Views</option>
            <option value="popular">Downloads</option>
            <option value="popular">Citations</option>
            <!-- Additional sort options here -->
            </select>
        </div>
        <hr style="border-top: 1px solid #ccc; margin: 10px 0;"> <!-- Add a horizontal line -->
        <div id="articles">

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
      </div>
      <div class="fluid-container">
      <div class="recommendation-article">
      <h4>Discover our Most Popular Article </h4>
        <div id="all-popular-articles" class="articles-container">
        </div>
        </div>
      </div>
      </div>
    '; 
  } else{
    echo '
      <div class="fluid-container">
      <div class="recommendation-article">
      <h4>Popular Articles this Month</h4>
        <div id="popular-articles" class="articles-container">
        </div>
        </div>
      </div>
      </div>
    '; 
  }
?>



<div class="footer" id="footer">

</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



<script>      
      const sessionId = "<?php echo $author_id; ?>";
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../JS/reusable-header.js"></script>
<script src="../JS/home-recommended-api.js"></script>
<script src="../JS/home-monthly-api.js"></script>
<script src="../JS/most-popular-api.js"></script>
<script src="../JS/browse-api.js"></script>
<script>
    

    const selectedYears = [];

    // Get references to the checkboxes
    const year1Checkbox = document.getElementById('year1');
    const year2Checkbox = document.getElementById('year2');
    const year3Checkbox = document.getElementById('year3');

    // Function to update the selectedYears array based on checkbox state
    const updateSelectedYears = (checkbox, year) => {
    if (checkbox.checked) {
        if (!selectedYears.includes(year)) {
        selectedYears.push(year);
        }
    } else {
        const index = selectedYears.indexOf(year);
        if (index !== -1) {
        selectedYears.splice(index, 1);
        }
    }
    }
    year1Checkbox.addEventListener('change', () => updateSelectedYears(year1Checkbox, "2022"));
    year2Checkbox.addEventListener('change', () => updateSelectedYears(year2Checkbox, "2023"));
    year3Checkbox.addEventListener('change', () => updateSelectedYears(year3Checkbox, "2024"));
    
    const sortSelect = document.querySelector("select");
    let sortSelected = "total_interactions"

    
    // handle search element event submit with sorting change
    document.getElementById('search-form').addEventListener('submit', function(event) {
        event.preventDefault(); 
        let searchInputValue = document.getElementById('result').value;
        let year = document.getElementById('year1').value;
        fetchData(searchInputValue, selectedYears, sortSelected);

    });

    // handle sort select element event change
    sortSelect.addEventListener('change', function(event) {
        event.preventDefault(); 
        let searchInputValue = document.getElementById('result').value;
        let year = document.getElementById('year1').value;
            sortSelected = sortSelect.value;
        fetchData(searchInputValue, selectedYears, sortSelected);
    });

    var result = document.getElementById('result');
   
    function startConverting() {
        result.innerText = ''; 
        console.log("voice")
        if ('webkitSpeechRecognition' in window) {
            var speechRecognizer = new webkitSpeechRecognition();
            speechRecognizer.continuous = false;
            speechRecognizer.interimResults = true;
            speechRecognizer.lang = 'en-US';
            speechRecognizer.start();
            var recognizing = false;

            speechRecognizer.onstart = function () {
                recognizing = true;
            };

            var finalTranscripts = '';

            speechRecognizer.onresult = function (event) {
                var interimTranscripts = '';
                for (var i = event.resultIndex; i < event.results.length; i++) {
                    var transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                    finalTranscripts += transcript.replace('.', ''); // Remove periods
                    } else {
                    interimTranscripts += transcript;
                    }
                }
                console.log(finalTranscripts);
                result.setAttribute("value", `${finalTranscripts + interimTranscripts}`);
                };
                    speechRecognizer.onend = function () {
                    recognizing = false;
                    fetchData(finalTranscripts, selectedYears, sortby);
                    
            };

            speechRecognizer.onerror = function (event) {
                // Handle error if needed
            };
        } else {
            result.innerHTML = 'Your browser is not supported. Please download Google Chrome or update your Google Chrome!';
        }
    }


</script>
</body>
</html>