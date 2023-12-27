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


<?php
