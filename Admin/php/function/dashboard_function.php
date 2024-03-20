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

    if (!function_exists('get_userdemographics')) {
        function get_userdemographics() {
            $pdo = connect_to_database();

            if ($pdo) {
                try {
                    $query = "SELECT 
                        age_groups.age_group,
                        COALESCE(author_counts.count, 0) AS count
                    FROM 
                        (
                            SELECT '1-17' AS age_group
                            UNION SELECT '18-24'
                            UNION SELECT '25-34'
                            UNION SELECT '35-44'
                            UNION SELECT '44+'
                        ) AS age_groups
                    LEFT JOIN 
                        (
                            SELECT 
                                CASE 
                                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 17 THEN '1-17' 
                                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 24 THEN '18-24' 
                                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 25 AND 34 THEN '25-34' 
                                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 35 AND 44 THEN '35-44' 
                                    ELSE '44+'
                                END AS age_group,
                                COUNT(*) AS count
                            FROM 
                                author
                            WHERE 
                                birth_date IS NOT NULL AND birth_date != ''
                            GROUP BY 
                                age_group
                        ) AS author_counts
                    ON 
                        age_groups.age_group = author_counts.age_group;";

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

    if (!function_exists('get_donationamount')) {
        function get_donationamount() {
            $pdo = connect_to_database();
        
            if ($pdo) {
                try {
                    $query = "SELECT 
                        years.year_number,
                        CONCAT('Month ', months.month_number) AS month,
                        COALESCE(SUM(donation.amount), 0) AS total_donation
                    FROM (
                        SELECT 1 AS month_number
                        UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
                        UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
                    ) AS months
                    CROSS JOIN (
                        SELECT YEAR(CURRENT_DATE()) AS year_number
                    ) AS years
                    LEFT JOIN (
                        SELECT 
                            MONTH(created_at) AS donation_month, 
                            YEAR(created_at) AS donation_year,
                            amount
                        FROM 
                            donation
                    ) AS donation ON months.month_number = donation.donation_month AND years.year_number = donation.donation_year
                    GROUP BY years.year_number, months.month_number
                    ORDER BY years.year_number, months.month_number;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
        
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                    return $result;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    return false;
                }
            }
        
            return false;
        }
    }

    if (!function_exists('get_top5contributors_list')) {
        function get_top5contributors_list() {
            $firstDayOfMonth = date('Y-m-01');
            $lastDayOfMonth = date('Y-m-t');
            
            $sql = "SELECT 
                        contributors_id, 
                        article_id, 
                        contributor_type, 
                        firstname, 
                        lastname, 
                        publicname, 
                        orcid, 
                        email, 
                        date_added,
                        COUNT(*) AS email_count
                    FROM 
                        contributors
                    WHERE 
                        date_added BETWEEN '{$firstDayOfMonth}' AND '{$lastDayOfMonth}'
                    GROUP BY 
                        email
                    ORDER BY 
                        email_count DESC
                    LIMIT 5;";
                                
            $results = execute_query($sql);
    
            if (!empty($results)) {
                $data['top5contributorslist'] = $results;
                return $data;
            } else {
                $randomNames = getRandomNamesFromPastContributors();
                $data['top5contributorslist'] = $randomNames;
                return $data;
            }
        }
    }

    function getRandomNamesFromPastContributors() {
        $sql = "SELECT firstname, lastname,0 AS email_count FROM contributors ORDER BY RAND() LIMIT 5";
        $randomNames = execute_query($sql);
        
        return $randomNames;
    }    

    if (!function_exists('get_top5reviewer_list')) {
        function get_top5reviewer_list() {
            $firstDayOfMonth = date('Y-m-01');
            $lastDayOfMonth = date('Y-m-t');
            
            $sql = "SELECT 
                        a.author_id,
                        COUNT(ra.author_id) AS count_reviewed,
                        a.first_name,
                        a.last_name,
                        a.email
                    FROM 
                        author a
                    LEFT JOIN 
                        reviewer_assigned ra ON ra.author_id = a.author_id AND ra.accept = 1 AND ra.answer = 1 AND ra.date_issued BETWEEN '{$firstDayOfMonth}' AND '{$lastDayOfMonth}'
                    WHERE 
                        a.status = 1
                    GROUP BY 
                        a.author_id, a.first_name, a.last_name, a.email
                    HAVING 
                        count_reviewed > 0  -- Include only authors who have been reviewed at least once
                    ORDER BY 
                        count_reviewed DESC
                    LIMIT 5;
                    ";
            
            $results = execute_query($sql);
    
            if ($results !== false) {
                $data['top5reviewerlist'] = $results;
                return $data;
            } else {
                return array();
            }
        }
    }

    if (!function_exists('get_top5downloadedlist')) {
        function get_top5downloadedlist() {
            $firstDayOfMonth = date('Y-m-01');
            $lastDayOfMonth = date('Y-m-t');
            
            $sql = "SELECT 
                        a.`article_id`, 
                        a.`title`, 
                        COUNT(l.`read_history_id`) AS download_count
                    FROM 
                        `article` AS a
                    INNER JOIN 
                        `logs` AS l ON a.`article_id` = l.`article_id`
                    WHERE 
                        l.`type` = 'download'
                    AND
                        l.`date` BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth'
                    GROUP BY 
                        a.`article_id`, 
                        a.`title`
                    ORDER BY 
                        download_count DESC
                    LIMIT 5";
            
            $results = execute_query($sql);
    
            if ($results !== false) {
                $data['top5downloadedlist'] = $results;
                return $data;
            } else {
                return array(); 
            }
        }
    }
    
?>