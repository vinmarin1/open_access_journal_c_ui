<?php
include 'dbcon.php';

    if (!function_exists('get_journalsubmission')) {
        function get_journalsubmission() {
            $pdo = connect_to_database();

            if ($pdo) {
                try {
                    $query = "SELECT 
                    j.journal_id,
                    j.journal,
                    DATE_FORMAT(DATE_ADD('2024-01-01', INTERVAL m.month_number - 1 MONTH), '%Y-%m') AS month_added,
                    COALESCE(COUNT(a.article_id), 0) AS article_count
                FROM 
                    (SELECT 1 AS month_number UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 
                    UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 
                    UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS m
                CROSS JOIN 
                    (SELECT DISTINCT journal_id, journal FROM journal) AS j
                LEFT JOIN 
                    article a ON j.journal_id = a.journal_id AND YEAR(a.date_added) = 2024 AND MONTH(a.date_added) = m.month_number
                GROUP BY 
                    j.journal_id, j.journal, month_added
                ORDER BY 
                    j.journal_id, month_added;
                ";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                    return $result;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    return false;
                }
            }

            return false;
        }
    }

    
    if (!function_exists('get_submissioncomparison')) {
        function get_submissioncomparison() {
            $pdo = connect_to_database();

            if ($pdo) {
                try {
                    $query = "SELECT
                    months.month_added,
                    COALESCE(published_counts.published_count, 0) AS published_count,
                    COALESCE(rejected_counts.rejected_count, 0) AS rejected_count,
                    COALESCE(ongoing_counts.ongoing_count, 0) AS ongoing_count
                FROM
                    (
                        SELECT DATE_FORMAT(DATE_ADD(CONCAT(YEAR(CURDATE()), '-01-01'), INTERVAL m.month_number - 1 MONTH), '%Y-%m') AS month_added
                        FROM (SELECT 1 AS month_number UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 
                            UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 
                            UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS m
                    ) AS months
                LEFT JOIN (
                    SELECT
                        DATE_FORMAT(a.date_added, '%Y-%m') AS month_added,
                        COUNT(*) AS published_count
                    FROM
                        article a
                    WHERE
                        a.status = 1
                        AND YEAR(a.date_added) = YEAR(CURDATE())
                    GROUP BY
                        DATE_FORMAT(a.date_added, '%Y-%m')
                ) AS published_counts ON months.month_added = published_counts.month_added
                LEFT JOIN (
                    SELECT
                        DATE_FORMAT(a.date_added, '%Y-%m') AS month_added,
                        COUNT(*) AS rejected_count
                    FROM
                        article a
                    WHERE
                        a.status = 6
                        AND YEAR(a.date_added) = YEAR(CURDATE()) 
                    GROUP BY
                        DATE_FORMAT(a.date_added, '%Y-%m')
                ) AS rejected_counts ON months.month_added = rejected_counts.month_added
                LEFT JOIN (
                    SELECT
                        DATE_FORMAT(a.date_added, '%Y-%m') AS month_added,
                        COUNT(*) AS ongoing_count
                    FROM
                        article a
                    WHERE
                        a.status BETWEEN 2 AND 5
                        AND YEAR(a.date_added) = YEAR(CURDATE())
                    GROUP BY
                        DATE_FORMAT(a.date_added, '%Y-%m')
                ) AS ongoing_counts ON months.month_added = ongoing_counts.month_added
                ORDER BY
                    months.month_added;                
                ";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                    return $result;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    return false;
                }
            }

            return false;
        }
    }

    if (!function_exists('get_usercount')) {
        function get_usercount() {
            $pdo = connect_to_database();

            if ($pdo) {
                try {
                    $query = "SELECT COUNT(*) AS user_count FROM author WHERE status = 1; ";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                    return $result;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    return false;
                }
            }

            return false;
        }
    }
    
    if (!function_exists('get_publishedcount')) {
        function get_publishedcount() {
            $pdo = connect_to_database();

            if ($pdo) {
                try {
                    $query = "SELECT COUNT(*) AS article_count FROM article WHERE status = 1; ";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                    return $result;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    return false;
                }
            }

            return false;
        }
    }

    if (!function_exists('get_engagementcount')) {
        function get_engagementcount() {
            $pdo = connect_to_database();

            if ($pdo) {
                try {
                    $query = "SELECT COUNT(*) AS engagement_count FROM logs";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                    return $result;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    return false;
                }
            }

            return false;
        }
    }

    if (!function_exists('get_ongoingcount')) {
        function get_ongoingcount() {
            $pdo = connect_to_database();

            if ($pdo) {
                try {
                    $query = "SELECT COUNT(*) AS article_count 
                    FROM article 
                    WHERE status BETWEEN 2 AND 5;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                    return $result;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    return false;
                }
            }

            return false;
        }
    }
?>