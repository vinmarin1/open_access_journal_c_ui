<?php

include 'dbcon.php';
?>

<?php
                     // Fetch total users from the database
                $query = "SELECT COUNT(*) as totalUsers FROM author";
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
                $query = "SELECT COUNT(*) as totalArticles FROM article";
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
    // Fetch total logs from the database for journal_id=1
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
                logs.type IN ('read', 'download') && journal.journal_id=1
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
    // Fetch total logs from the database for journal_id=1
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
                logs.type IN ('read', 'download') && journal.journal_id=2
            GROUP BY 
                journal.journal_id, journal.journal, month
            ORDER BY 
                month, journal.journal_id;";

    $result = execute_query($query);
    $totalLamp = [];

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
                // Fetch total logs from the database where issues_id = 5
                $query = "SELECT COUNT(*) as totalOngoingarticles FROM article_final WHERE status_id = 5";
                $result = execute_query($query);

                // Check if the query was successful
                if ($result !== false) {
                    // Correct the variable name here
                    $totalOngoingarticles = $result[0]->totalOngoingarticles;
                } else {
                    $totalOngoingarticles = "Error fetching data";
                }
?>
