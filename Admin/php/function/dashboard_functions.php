<?php

include 'dbcon.php';
?>

<?php
                     // Fetch total users from the database
                $query =  "SELECT COUNT(*) as totalUsers FROM author WHERE status = 1";
                $result = execute_query($query);

                // Check if the query was successful
                if ($result !== false) {
                    $totalUsers = $result[0]->totalUsers;
                } else {
                    $totalUsers = "Error fetching data";
                }
?>

<?php
                // Fetch total articles from the database
                $query = "SELECT COUNT(*) as totalArticles FROM article WHERE status = 1";
                $result = execute_query($query);
                
                // Check if the query was successful
                if ($result !== false) {
                    // Correct the variable name here
                    $totalArticles = $result[0]->totalArticles;
                } else {
                    $totalArticles = "Error fetching data";
                }
?>         

<?php
                // Fetch total logs from the database
                $query = "SELECT COUNT(*) as totalEngagements FROM logs";
                $result = execute_query($query);
                
                // Check if the query was successful
                if ($result !== false) {
                    // Correct the variable name here
                    $totalEngagements = $result[0]->totalEngagements;
                } else {
                    $totalEngagements = "Error fetching data";
                }
?>         

<?php
    // Fetch total logs from the database where issues_id = 5
    $query = "SELECT COUNT(*) as totalOngoingarticles FROM article WHERE status IN (2, 3, 4, 5)";
    $result = execute_query($query);

    // Check if the query was successful
    if ($result !== false) {
        // Correct the variable name here
        $totalOngoingarticles = $result[0]->totalOngoingarticles;
    } else {
        $totalOngoingarticles = "Error fetching data";
    }
?>


   
<?php
// Fetch total logs from the database for journal_id=1 for the current and selected years
$currentYear = date('Y'); // Get the current year

// Check if a specific year is selected from the dropdown
if (isset($_GET['selectedYear'])) {
    $selectedYear = $_GET['selectedYear'];
} else {
    $selectedYear = $currentYear; // Default to the current year if not selected
}

$query = "SELECT 
            journal.journal_id,
            journal.journal,
            MONTH(logs.date) AS month,
            COUNT(CASE WHEN logs.type = 'read' THEN logs.article_id END) AS monthly_reads,
            COUNT(CASE WHEN logs.type = 'download' THEN logs.article_id END) AS monthly_downloads
        FROM 
            journal
        LEFT JOIN 
            article ON journal.journal_id = article.journal_id
        LEFT JOIN 
            logs ON article.article_id = logs.article_id
        WHERE
            logs.type IN ('read', 'download') && 
            journal.journal_id = 1 &&
            YEAR(logs.date) = $selectedYear
        GROUP BY 
            journal.journal_id, journal.journal, month
        ORDER BY 
            month, journal.journal_id;";

$result = execute_query($query);
$totalGavel = [];

// Check if the query was successful
if ($result !== false) {
    // Convert the PHP array to a JSON string
    $jsonResult = json_encode($result);

    // Pass the JSON string to JavaScript
    echo "<script>var totalGavel = $jsonResult;</script>";
} else {
    $totalGavel = "Error fetching data";
    // Pass the error message to JavaScript
    // echo "<script>var totalGavelError = '$totalGavel';</script>";
}
?>



<?php
// Fetch total logs from the database for journal_id=2 and the current year
$currentYear = date('Y'); // Get the current year

// Check if a specific year is selected from the dropdown
if (isset($_GET['selectedYear'])) {
    $selectedYear = $_GET['selectedYear'];
} else {
    $selectedYear = $currentYear; // Default to the current year if not selected
}


$query = "SELECT 
            journal.journal_id,
            journal.journal,
            MONTH(logs.date) AS month,
            COUNT(CASE WHEN logs.type = 'read' THEN logs.article_id END) AS monthly_reads,
            COUNT(CASE WHEN logs.type = 'download' THEN logs.article_id END) AS monthly_downloads
        FROM 
            journal
        LEFT JOIN 
            article ON journal.journal_id = article.journal_id
        LEFT JOIN 
            logs ON article.article_id = logs.article_id
        WHERE
            logs.type IN ('read', 'download') && 
            journal.journal_id = 2 &&
            YEAR(logs.date) = $selectedYear 
        GROUP BY 
            journal.journal_id, journal.journal, month
        ORDER BY 
            month, journal.journal_id;";

$result = execute_query($query);
$totalLamp = [];

// Check if the query was successful
if ($result !== false) {
    // Convert the PHP array to a JSON string
    $jsonResult = json_encode($result);

    // Pass the JSON string to JavaScript
    echo "<script>var totalLamp = $jsonResult;</script>";
} else {
    $totalLamp = "Error fetching data";
    // Pass the error message to JavaScript
    echo "<script>var totalLampError = '$totalLamp';</script>";
}
?>



<?php
// Fetch total logs from the database for journal_id=3 and the current year
$currentYear = date('Y'); // Get the current year

// Check if a specific year is selected from the dropdown
if (isset($_GET['selectedYear'])) {
    $selectedYear = $_GET['selectedYear'];
} else {
    $selectedYear = $currentYear; // Default to the current year if not selected
}

$query = "SELECT 
            journal.journal_id,
            journal.journal,
            MONTH(logs.date) AS month,
            COUNT(CASE WHEN logs.type = 'read' THEN logs.article_id END) AS monthly_reads,
            COUNT(CASE WHEN logs.type = 'download' THEN logs.article_id END) AS monthly_downloads
        FROM 
            journal
        LEFT JOIN 
            article ON journal.journal_id = article.journal_id
        LEFT JOIN 
            logs ON article.article_id = logs.article_id
        WHERE
            logs.type IN ('read', 'download') && 
            journal.journal_id = 3 &&
            YEAR(logs.date) = $selectedYear
        GROUP BY 
            journal.journal_id, journal.journal, month
        ORDER BY 
            month, journal.journal_id;";

$result = execute_query($query);
$totalStar = [];

// Check if the query was successful
if ($result !== false) {
    // Convert the PHP array to a JSON string
    $jsonResult = json_encode($result);

    // Pass the JSON string to JavaScript
    echo "<script>var totalStar = $jsonResult;</script>";
} else {
    $totalStar = "Error fetching data";
    // Pass the error message to JavaScript
    echo "<script>var totalStarError = '$totalStar';</script>";
}
?>



<?php
// Fetch data from the database for published and not published articles
$query = "SELECT 
            COUNT(CASE WHEN status = 1 THEN 1 END) AS published_count,
            COUNT(CASE WHEN status = 6 THEN 1 END) AS not_published_count
          FROM article";

$result = execute_query($query);

if ($result !== false) {
    // Pass the PHP array to JavaScript using json_encode
    echo "<script>";
    echo "var doughnutChartData1 = " . json_encode($result) . ";";
    echo "</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching data from the database.');</script>";
}
?>


<?php
$currentYear = date("Y"); // Get the current year

$query = "SELECT 
            journal_id,
            COUNT(CASE WHEN MONTH(publication_date) BETWEEN 1 AND 3 AND YEAR(publication_date) = $currentYear AND status = 1 THEN 1 END) AS q1_count,
            COUNT(CASE WHEN MONTH(publication_date) BETWEEN 4 AND 6 AND YEAR(publication_date) = $currentYear AND status = 1 THEN 1 END) AS q2_count,
            COUNT(CASE WHEN MONTH(publication_date) BETWEEN 7 AND 9 AND YEAR(publication_date) = $currentYear AND status = 1 THEN 1 END) AS q3_count,
            COUNT(CASE WHEN MONTH(publication_date) BETWEEN 10 AND 12 AND YEAR(publication_date) = $currentYear AND status = 1 THEN 1 END) AS q4_count
          FROM article
          WHERE journal_id IN (1, 2, 3) AND status = 1
          GROUP BY journal_id";

$result = execute_query($query);

if ($result !== false) {
    // Pass the PHP array to JavaScript using json_encode
    echo "<script>";
    echo "var barChartData = " . json_encode($result) . ";";
    echo "</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching data from the database.');</script>";
}
?>


<?php
// Assuming you have a database connection and a function execute_query for executing SQL queries

// SQL query to fetch data for Doughnut Chart 2
$query = "SELECT position, COUNT(*) AS position_count
          FROM author
          WHERE position IN ('QCU', 'FACULTY', 'OTHERS')
          GROUP BY position";

$result2 = execute_query($query);

if ($result2 !== false) {
    // Convert the PHP array to a JSON string
    $jsonResult2 = json_encode($result2);

    // Pass the JSON string to JavaScript for doughnut chart
    echo "<script>var doughnutChartData2 = $jsonResult2;</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching data from the database.');</script>";
}
?>


<!-- Linechart2 function -->
<?php
// Assuming you have a function execute_query() for executing SQL queries

// Fetch data from the author table for QCU
$qcuQuery = "SELECT MONTH(date_added) AS month, COUNT(*) AS count
             FROM author
             WHERE position = 'QCU'
             GROUP BY MONTH(date_added)
             ORDER BY MONTH(date_added)";
$qcuResult = execute_query($qcuQuery);

// Check if the query was successful
if ($qcuResult !== false) {
    // Convert the PHP array to a JSON string
    $jsonResultQCU = json_encode($qcuResult);

    // Pass the JSON string to JavaScript for the line chart
    echo "<script>var lineChartDataQCU = $jsonResultQCU;</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching QCU data from the database.');</script>";
}
?>

<?php
// Fetch data from the author table for FACULTY
$facultyQuery = "SELECT MONTH(date_added) AS month, COUNT(*) AS count
                 FROM author
                 WHERE position = 'FACULTY'
                 GROUP BY MONTH(date_added)
                 ORDER BY MONTH(date_added)";
$facultyResult = execute_query($facultyQuery);

// Check if the query was successful
if ($facultyResult !== false) {
    // Convert the PHP array to a JSON string
    $jsonResultFaculty = json_encode($facultyResult);

    // Pass the JSON string to JavaScript for the line chart
    echo "<script>var lineChartDataFaculty = $jsonResultFaculty;</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching FACULTY data from the database.');</script>";
}
?>

<?php
// Fetch data from the author table for OTHERS
$othersQuery = "SELECT MONTH(date_added) AS month, COUNT(*) AS count
                FROM author
                WHERE position = 'OTHERS'
                GROUP BY MONTH(date_added)
                ORDER BY MONTH(date_added)";
$othersResult = execute_query($othersQuery);

// Check if the query was successful
if ($othersResult !== false) {
    // Convert the PHP array to a JSON string
    $jsonResultOthers = json_encode($othersResult);

    // Pass the JSON string to JavaScript for the line chart
    echo "<script>var lineChartDataOthers = $jsonResultOthers;</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching OTHERS data from the database.');</script>";
}
?>


<?php
$query = "SELECT MONTH(created_at) as month, COUNT(*) as donation_count FROM donation GROUP BY month";
$result3 = execute_query($query);

if ($result3 !== false) {
    // Convert the PHP array to a JSON string
    $jsonResult3 = json_encode($result3);

    // Pass the JSON string to JavaScript for the line chart
    echo "<script>var lineChartData3 = $jsonResult3;</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching data from the database.');</script>";
}
?>


<?php

$contributorQuery = "SELECT COUNT(*) as contributorCount FROM contributors WHERE orcid = orcid ";
$contributorResult = execute_query($contributorQuery);
if ($contributorResult !== false) {
    // Convert the PHP array to a JSON string
    $jsonContributorsResult = json_encode($contributorResult);

    // Pass the JSON string to JavaScript for the line chart
    echo "<script>var contributorData = $jsonContributorsResult;</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching data from the database for contributors.');</script>";
}
?>

<?php

// Fetch data from reviewer_assignment where accept = 1
$reviewerQuery = "SELECT COUNT(*) as reviewerCount FROM reviewer_assigned WHERE accept = 1";
$reviewerResult = execute_query($reviewerQuery);

if ($reviewerResult !== false) {
    // Convert the PHP array to a JSON string
    $jsonReviewerResult = json_encode($reviewerResult);

    // Pass the JSON string to JavaScript for the line chart
    echo "<script>var reviewerData = $jsonReviewerResult;</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching data from the database for reviewers.');</script>";
}
?>

