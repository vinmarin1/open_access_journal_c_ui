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
          WHERE position IN ('STUDENT', 'FACULTY', 'OTHERS')
          GROUP BY position";

$result2 = execute_query($query);

// Check if the query was successful
if ($result2 !== false) {
    if (empty($result2)) {
        // If no data is returned, initialize the result array with default values
        $defaultValues = [
            ['position' => 'STUDENT', 'position_count' => 0],
            ['position' => 'FACULTY', 'position_count' => 0],
            ['position' => 'OTHERS', 'position_count' => 0]
        ];
        $jsonResult2 = json_encode($defaultValues);
    } else {
        // Convert the PHP array to a JSON string
        $jsonResult2 = json_encode($result2);
    }

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
$qcuQuery = "SELECT MONTH(date_added) as month, 
COUNT(CASE WHEN position = 'STUDENT' THEN 1 END) as student_count 
FROM author
GROUP BY month";
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
    $facultyQuery = "SELECT MONTH(date_added) as month, 
    COUNT(CASE WHEN position = 'FACULTY' THEN 1 END) as faculty_count 
    FROM author
    GROUP BY month";
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
        $othersQuery = "SELECT MONTH(date_added) as month, 
        COUNT(CASE WHEN position = 'OTHERS' THEN 1 END) as others_count 
        FROM author
        GROUP BY month ";
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
// Funtion for Donations Count
$query = "SELECT MONTH(created_at) as month, COUNT(*) as donation_count FROM donation GROUP BY month";
$result3 = execute_query($query);

// If no data is fetched, initialize the result array with default values of 0 for all months
if ($result3 === false || empty($result3)) {
    $result3 = [];
    for ($i = 1; $i <= 12; $i++) {
        $result3[] = ['month' => $i, 'donation_count' => 0];
    }
}
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
// Function For Contributors Count
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








<?php
// Assuming you have a function execute_query() for executing SQL queries

// Function for submit Student count
$studentQuery = "SELECT 
months.month AS month,
COALESCE(COUNT(author.author_id), 0) AS student_count
FROM 
(
    SELECT 1 AS month
    UNION SELECT 2
    UNION SELECT 3
    UNION SELECT 4
    UNION SELECT 5
    UNION SELECT 6
    UNION SELECT 7
    UNION SELECT 8
    UNION SELECT 9
    UNION SELECT 10
    UNION SELECT 11
    UNION SELECT 12
) AS months
LEFT JOIN article ON MONTH(article.date_added) = months.month
LEFT JOIN author ON article.author_id = author.author_id
           AND author.position = 'STUDENT'
           AND YEAR(article.date_added) = YEAR(CURRENT_DATE())
GROUP BY months.month";
               
$studentResult1 = execute_query($studentQuery);

// If no data is fetched, initialize the result array with default values of 0 for all months
if ($studentResult1 === false || empty($studentResult1)) {
    $studentResult1 = [];
    for ($i = 1; $i <= 12; $i++) {
        $studentResult1[] = ['month' => $i, 'student_count' => 0];
    }
}

// Check if the query was successful
if ($studentResult1 !== false) {
    // Convert the PHP array to a JSON string
    $jsonResultStudent1 = json_encode($studentResult1);

    // Pass the JSON string to JavaScript for the line chart
    echo "<script>var lineChartDataStudent = $jsonResultStudent1;</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching QCU data from the database.');</script>";
}
?>



<?php
// Fetch data from the author table for others
$othersQuery = "SELECT 
months.month AS month,
COALESCE(COUNT(author.author_id), 0) AS others_count
FROM 
(
    SELECT 1 AS month
    UNION SELECT 2
    UNION SELECT 3
    UNION SELECT 4
    UNION SELECT 5
    UNION SELECT 6
    UNION SELECT 7
    UNION SELECT 8
    UNION SELECT 9
    UNION SELECT 10
    UNION SELECT 11
    UNION SELECT 12
) AS months
LEFT JOIN article ON MONTH(article.date_added) = months.month
LEFT JOIN author ON article.author_id = author.author_id
           AND author.position = 'OTHERS'
           AND YEAR(article.date_added) = YEAR(CURRENT_DATE())
GROUP BY months.month";

$othersResult1 = execute_query($othersQuery);

if ($othersResult1 === false || empty($othersResult1)) {
    $othersResult1 = [];
    for ($i = 1; $i <= 12; $i++) {
        $othersResult1[] = ['month' => $i, 'others_count' => 0];
    }
}
// Check if the query was successful
if ($othersResult1 !== false) {
    // Convert the PHP array to a JSON string
    $jsonResultOthers1 = json_encode($othersResult1);

    // Pass the JSON string to JavaScript for the line chart
    echo "<script>var lineChartDataStudent = $jsonResultOthers1;</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching QCU data from the database.');</script>";
}
?>


<?php
// Fetch data from the author table for faculty
$facultyQuery = "SELECT 
months.month AS month,
COALESCE(COUNT(author.author_id), 0) AS faculty_count
FROM 
(
    SELECT 1 AS month
    UNION SELECT 2
    UNION SELECT 3
    UNION SELECT 4
    UNION SELECT 5
    UNION SELECT 6
    UNION SELECT 7
    UNION SELECT 8
    UNION SELECT 9
    UNION SELECT 10
    UNION SELECT 11
    UNION SELECT 12
) AS months
LEFT JOIN article ON MONTH(article.date_added) = months.month
LEFT JOIN author ON article.author_id = author.author_id
           AND author.position = 'FACULTY'
           AND YEAR(article.date_added) = YEAR(CURRENT_DATE())
GROUP BY months.month";

$facultyResult1 = execute_query($facultyQuery);

if ($facultyResult1 === false || empty($facultyResult1)) {
    $facultyResult1 = [];
    for ($i = 1; $i <= 12; $i++) {
        $facultyResult1[] = ['month' => $i, 'faculty_count' => 0];
    }
}
// Check if the query was successful
if ($facultyResult1 !== false) {
    // Convert the PHP array to a JSON string
    $jsonResultFaculty1 = json_encode($facultyResult1);

    // Pass the JSON string to JavaScript for the line chart
    echo "<script>var lineChartDataStudent = $jsonResultFaculty1;</script>";
} else {
    // Handle the error if the query fails
    echo "<script>console.error('Error fetching QCU data from the database.');</script>";
}
?>




<!-- BarChart line 2 User Gender Demog graphics -->
<?php
$currentYear = date("Y"); // Get the current year

// Query to fetch male author counts by month
$maleQuery = "SELECT months.month_num AS month,
                COALESCE(COUNT(author.date_added), 0) AS male_count
                FROM (
                SELECT 1 AS month_num
                UNION SELECT 2
                UNION SELECT 3
                UNION SELECT 4
                UNION SELECT 5
                UNION SELECT 6
                UNION SELECT 7
                UNION SELECT 8
                UNION SELECT 9
                UNION SELECT 10
                UNION SELECT 11
                UNION SELECT 12
                ) AS months
                LEFT JOIN author ON MONTH(author.date_added) = months.month_num
                        AND author.gender = 'Male'
                        AND YEAR(author.date_added) = YEAR(CURRENT_DATE())
                GROUP BY months.month_num
                ORDER BY months.month_num";

// Execute male query
$maleResult = execute_query($maleQuery);

// Check if both queries executed successfully
if ($maleResult !== false ) {
    // Pass the PHP arrays to JavaScript using json_encode
    echo "<script>";
    echo "var maleData = " . json_encode($maleResult) . ";";
    echo "</script>";
} else {
    // Handle the error if any of the queries fail
    echo "<script>console.error('Error fetching data from the database.');</script>";
}
?>
<?php
$currentYear = date("Y"); // Get the current year

// Query to fetch female author counts by month
        $femaleQuery = "SELECT months.month_num AS month,
        COALESCE(COUNT(author.date_added), 0) AS female_count
        FROM (
        SELECT 1 AS month_num
        UNION SELECT 2
        UNION SELECT 3
        UNION SELECT 4
        UNION SELECT 5
        UNION SELECT 6
        UNION SELECT 7
        UNION SELECT 8
        UNION SELECT 9
        UNION SELECT 10
        UNION SELECT 11
        UNION SELECT 12
        ) AS months
        LEFT JOIN author ON MONTH(author.date_added) = months.month_num
                AND author.gender = 'Female'
                AND YEAR(author.date_added) = YEAR(CURRENT_DATE())
        GROUP BY months.month_num
        ORDER BY months.month_num";

// Execute female query
$femaleResult = execute_query($femaleQuery);

// Check if both queries executed successfully
if ($femaleResult !== false) {
    // Pass the PHP arrays to JavaScript using json_encode
    echo "<script>";
    echo "var femaleData = " . json_encode($femaleResult) . ";";
    echo "</script>";
} else {
    // Handle the error if any of the queries fail
    echo "<script>console.error('Error fetching data from the database.');</script>";
}
?>





    <?php
    $currentYear = date("Y"); // Get the current year

    // Query to fetch count of authors aged 10 to 25 by month
    $Age1Query = "SELECT 
                        MONTH(date_added) AS month,
                        SUM(CASE 
                                WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 10 AND 25 THEN 1
                                ELSE 0
                            END) AS count_age_10_to_25
                    FROM 
                        author
                    GROUP BY 
                        MONTH(date_added)";

    // Execute the query
    $Ageresult1 = execute_query($Age1Query);

    // Check if the query executed successfully
    if ($Ageresult1 !== false) {
        // Pass the PHP array to JavaScript using json_encode
        echo "<script>";
        echo "var countData1 = " . json_encode(array_column($Ageresult1, 'count_age_10_to_25')) . ";";
        echo "</script>";
    } else {
        // Handle the error if the query fails
        echo "<script>console.error('Error fetching data Age1 from the database.');</script>";
    }
    ?>

    <?php
    $currentYear = date("Y"); // Get the current year

    // Query to fetch count of authors aged 26 to 40 by month
    $Age2Query = "SELECT 
                        MONTH(date_added) AS month,
                        SUM(CASE 
                                WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 26 AND 40 THEN 1
                                ELSE 0
                            END) AS count_age_26_to_40
                    FROM 
                        author
                    GROUP BY 
                        MONTH(date_added)";

    // Execute the query
    $Ageresult2 = execute_query($Age2Query);

    // Check if the query executed successfully
    if ($Ageresult2 !== false) {
        // Pass the PHP array to JavaScript using json_encode
        echo "<script>";
        echo "var countData2 = " . json_encode(array_column($Ageresult2, 'count_age_26_to_40')) . ";";
        echo "</script>";
    } else {
        // Handle the error if the query fails
        echo "<script>console.error('Error fetching data Age2 from the database.');</script>";
    }
    ?>

    <?php
    $currentYear = date("Y"); // Get the current year

    // Query to fetch count of authors aged 41 to 80 by month
    $Age3Query = "SELECT 
                        MONTH(date_added) AS month,
                        SUM(CASE 
                                WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 41 AND 80 THEN 1
                                ELSE 0
                            END) AS count_age_41_to_80
                    FROM 
                        author
                    GROUP BY 
                        MONTH(date_added)";

    // Execute the query
    $Ageresult3 = execute_query($Age3Query);

    // Check if the query executed successfully
    if ($Ageresult3 !== false) {
        // Pass the PHP array to JavaScript using json_encode
        echo "<script>";
        echo "var countData3 = " . json_encode(array_column($Ageresult3, 'count_age_41_to_80')) . ";";
        echo "</script>";
    } else {
        // Handle the error if the query fails
        echo "<script>console.error('Error fetching data Age3 from the database.');</script>";
    }
    ?>
