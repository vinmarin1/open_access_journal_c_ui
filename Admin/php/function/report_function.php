<?php
include 'dbcon.php';

    if (!function_exists('get_report_list')) {
        function get_report_list($journal_id = null) {
            $pdo = connect_to_database();

            if ($pdo) {
                try {
                    $query = "SELECT * FROM reports";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    if (!empty($journal_id)) {
                        $query .= " WHERE admin = 0";
                    }
    
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

    if (!function_exists('get_notification_list')) {
        function get_notification_list() {
            $pdo = connect_to_database();
    
            if ($pdo) {
                try {
                    $query = "SELECT * FROM notification WHERE admin = 1 ORDER BY id DESC";
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
    

    if (!function_exists('get_archive_article_list')) {
        function get_archive_article_list($month, $year) {
            $month = $_GET["m"] ?? date('m');
            $yearx = $_GET["y"] ?? date('Y');

            $sql = "SELECT `article_id`, `title`, `archive_date` FROM `article` WHERE `status` = 0 AND MONTH(`archive_date`) = ? AND YEAR(`archive_date`) = ?";

            $results = execute_query($sql, [$month, $year]);

            $data = array();

            if ($results !== false) {
                $data['articlelist'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }

    if (!function_exists('get_published_article_list')) {
        function get_published_article_list($month, $year) {
            $month = $_GET["m"] ?? date('m');
            $year = $_GET["y"] ?? date('Y');

            $sql = "SELECT `article_id`, `title`, `publication_date` FROM `article` WHERE `status` = 1 AND MONTH(`publication_date`) = ? AND YEAR(`publication_date`) = ?";

            $results = execute_query($sql, [$month, $year]);

            $data = array();

            if ($results !== false) {
                $data['articlelist'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }

    if (!function_exists('get_allmtd_article_list')) {
        function get_allmtd_article_list($month, $year, $status) {
            $sql = "SELECT `article_id`, `title`, `status`, `date_added` FROM `article` WHERE 1 ";
    
            $params = [];
    
            if ($status !== '10') {
                $sql .= "AND `status` = ?";
                $params[] = $status;
            }
    
            $sql .= "AND MONTH(`date_added`) = ? AND YEAR(`date_added`) = ?";
    
            $params[] = $month;
            $params[] = $year;
    
            $results = execute_query($sql, $params);
    
            $data = array();
    
            if ($results !== false) {
                $data['articlelist'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }

    if (!function_exists('get_allytd_article_list')) {
        function get_allytd_article_list($year, $status) {
            $sql = "SELECT `article_id`, `title`, `status`, `date_added` FROM `article` WHERE 1 ";
    
            $params = [];
    
            if ($status !== '10') {
                $sql .= "AND `status` = ?";
                $params[] = $status;
            }
    
            $sql .= "AND YEAR(`date_added`) = ?";
    
            $params[] = $year;
    
            $results = execute_query($sql, $params);
    
            $data = array();
    
            if ($results !== false) {
                $data['articlelist'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }

    if (!function_exists('get_donation_list')) {
        function get_donation_list($month, $year) {
            $month = $_GET["m"] ?? date('m');
            $yearx = $_GET["y"] ?? date('Y');

            $sql = "SELECT * FROM `donation` WHERE MONTH(`created_at`) = ? AND YEAR(`created_at`) = ?";

            $results = execute_query($sql, [$month, $year]);

            $data = array();

            if ($results !== false) {
                $data['donationlist'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }
    
    if (!function_exists('get_donationforgraph')) {
        function get_donationforgraph() {
            $sql = "SELECT 
                    years.year_number,
                    CONCAT('Month ', months.month_number) AS month,
                    COALESCE(SUM(donation.amount), 0) AS total_donation
                FROM (
                    SELECT 1 AS month_number
                    UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
                    UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
                ) AS months
                CROSS JOIN (
                    SELECT 2023 AS year_number
                    UNION SELECT YEAR(CURRENT_DATE()) AS year_number
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
                ORDER BY years.year_number, months.month_number;
                ";
                            
            $results = execute_query($sql);
    
            $data = array();
    
            if ($results !== false) {
                $data['donationforgraph'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }

    if (!function_exists('get_top5donators_list')) {
        function get_top5donators_list() {
            $firstDayOfMonth = date('Y-m-01');
            $lastDayOfMonth = date('Y-m-t');
            
            $sql = "SELECT 
                    donator_name,
                    donator_email,
                    SUM(amount) AS total_amount
                FROM 
                    donation 
                WHERE 
                    created_at BETWEEN '{$firstDayOfMonth}' AND '{$lastDayOfMonth}'
                GROUP BY 
                    donator_name, donator_email
                ORDER BY 
                    total_amount DESC
                LIMIT 5;";
                                
            $results = execute_query($sql);
    
            if (!empty($results)) {
                $data['top5donatorslist'] = $results;
                return $data;
            } else {
                $randomNames = getRandomNamesFromPastContributors();
                $data['top5donatorslist'] = $randomNames;
                return $data;
            }
        }
    }

    if (!function_exists('get_published_article_total')) {
        function get_published_article_total($month, $year) {
            $month = $_GET["m"] ?? date('m');
            $year = $_GET["y"] ?? date('Y');

            $sql = "SELECT `article_id`, `title`, `publication_date` FROM `article` WHERE `status` = 1 AND MONTH(`publication_date`) = ? AND YEAR(`publication_date`) = ?";

            $results = execute_query($sql, [$month, $year]);

            $data = array();

            if ($results !== false) {
                $data['articlelist'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }

    if (!function_exists('get_counter_list')) {
        function get_counter_list($year) {
            $year = $_GET["y"] ?? date('Y');

            $sql = "SELECT 
                a.article_id, 
                a.author_id AS article_author_id,
                a.journal_id, 
                a.issues_id, 
                a.title, 
                a.author, 
                a.volume, 
                a.privacy, 
                a.date AS article_date, 
                a.abstract, 
                a.keyword, 
                a.references, 
                a.comment, 
                a.content, 
                a.status, 
                a.round, 
                a.workflow, 
                a.date_added, 
                a.publication_date, 
                a.archive_date, 
                COUNT(CASE WHEN l.type = 'read' THEN 1 END) AS read_count,
                COUNT(CASE WHEN l.type = 'download' THEN 1 END) AS download_count
            FROM 
                article a 
            LEFT JOIN 
                logs l ON a.article_id = l.article_id AND YEAR(l.date) = ?
            WHERE 
                a.status = 1
            GROUP BY 
                a.article_id;";
                    
            $results = execute_query($sql, [$year]);

            $data = array();

            if ($results !== false) {
                $data['counterlist'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }

    if (!function_exists('get_topcontributors_list')) {
        function get_topcontributors_list() {
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
                    GROUP BY 
                        email;";
                            
            $results = execute_query($sql);
    
            $data = array();
    
            if ($results !== false) {
                $data['topcontributorslist'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
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

    if (!function_exists('get_contributorsgraph')) {
        function get_contributorsgraph() {
            $sql = "SELECT 
                years.year_number,
                CONCAT('Month ', months.month_number) AS month,
                COUNT(contributors.contributors_id) AS total_contributes
            FROM (
                SELECT 1 AS month_number
                UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
                UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
            ) AS months
            CROSS JOIN (
                SELECT 2023 AS year_number
                UNION SELECT YEAR(CURRENT_DATE()) AS year_number
            ) AS years
            LEFT JOIN (
                SELECT 
                    MONTH(date_added) AS donation_month, 
                    YEAR(date_added) AS donation_year,
                    contributors_id
                FROM 
                    contributors
            ) AS contributors ON months.month_number = contributors.donation_month AND years.year_number = contributors.donation_year
            GROUP BY years.year_number, months.month_number
            ORDER BY years.year_number, months.month_number;
                ";
                            
            $results = execute_query($sql);
    
            $data = array();
    
            if ($results !== false) {
                $data['contributorsforgraph'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }

    if (!function_exists('get_topreviewer_list')) {
        function get_topreviewer_list() {

            $sql = "SELECT 
                a.author_id,
                COALESCE(COUNT(ra.author_id), 0) AS count_reviewed,
                a.first_name,
                a.last_name,
                a.email
            FROM 
                author a
            LEFT JOIN 
                reviewer_assigned ra ON ra.author_id = a.author_id AND ra.accept = 1 AND ra.answer = 1
            WHERE 
                a.status = 1
            GROUP BY 
                a.author_id, a.first_name, a.last_name, a.email
            ORDER BY 
                count_reviewed DESC;";
        
            $results = execute_query($sql);
    
            $data = array();
    
            if ($results !== false) {
                $data['topreviewerlist'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
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
                return array(); // Return an empty array if there are no results or an error occurs
            }
        }
    }

    if (!function_exists('get_reviewersgraph')) {
        function get_reviewersgraph() {
            $sql = "SELECT 
                years.year_number,
                CONCAT('Month ', months.month_number) AS month,
                COUNT(ra.reviewer_assigned_id) AS total_reviews
            FROM (
                SELECT 1 AS month_number
                UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
                UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
            ) AS months
            CROSS JOIN (
                SELECT 2023 AS year_number
                UNION SELECT YEAR(CURRENT_DATE()) AS year_number
            ) AS years
            LEFT JOIN (
                SELECT 
                    MONTH(date_issued) AS donation_month, 
                    YEAR(date_issued) AS donation_year,
                    reviewer_assigned_id
                FROM 
                    reviewer_assigned
            ) AS ra ON months.month_number = ra.donation_month AND years.year_number = ra.donation_year
            GROUP BY years.year_number, months.month_number
            ORDER BY years.year_number, months.month_number;
                ";
                            
            $results = execute_query($sql);
    
            $data = array();
    
            if ($results !== false) {
                $data['reviewersforgraph'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }

    if (!function_exists('get_totalreportforgraph')) {
        function get_totalreportforgraph($year) {
            $year = $_GET["y"] ?? date('Y');

            $sql = "SELECT 
                    years.year_number,
                    CONCAT('Month ', months.month_number) AS month,
                    COALESCE(SUM(CASE WHEN logs.type = 'read' THEN 1 ELSE 0 END), 0) AS total_read,
                    COALESCE(SUM(CASE WHEN logs.type = 'download' THEN 1 ELSE 0 END), 0) AS total_download
                FROM (
                    SELECT 1 AS month_number UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 
                    UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 
                    UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
                ) AS months
                CROSS JOIN (
                    SELECT DISTINCT YEAR(date) AS year_number FROM logs WHERE YEAR(date) = ?
                ) AS years
                LEFT JOIN logs ON months.month_number = MONTH(logs.date) AND years.year_number = YEAR(logs.date)
                GROUP BY years.year_number, months.month_number
                ORDER BY years.year_number, months.month_number;

                ";
                            

            $results = execute_query($sql, [$year]);

    
            $data = array();
    
            if ($results !== false) {
                $data['totalreportforgraph'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }

    if (!function_exists('get_journal_data')) {
        function get_journal_data($journal_id) {
            $sql = "SELECT 
                        j.*,
                        COUNT(CASE WHEN a.`status` = 1 THEN 1 END) AS published_count,
                        COUNT(CASE WHEN a.`status` BETWEEN 2 AND 5 THEN 1 END) AS ongoing_count,
                        COUNT(CASE WHEN a.`status` = 6 THEN 1 END) AS reject_count
                    FROM 
                        `journal` AS j";
    
            if (!empty($journal_id)) {
                $sql .= " LEFT JOIN `article` AS a ON j.`journal_id` = a.`journal_id`";
            } else {
                $sql .= " LEFT JOIN `article` AS a ON j.`journal_id` = a.`journal_id`";
            }
    
            if (!empty($journal_id)) {
                $sql .= " WHERE j.`journal_id` = ?";
                $sql .= " GROUP BY j.`journal_id`";
            } else {
                $sql .= " GROUP BY j.`journal_id`";
            }
    
            if (!empty($journal_id)) {
                $results = execute_query($sql, [$journal_id]);
            } else {
                $results = execute_query($sql);
            }
    
            $data = array();
    
            if ($results !== false) {
                $data['journaldata'] = $results;
                return $data;
            } else {
                return array('status' => true, 'data' => []);
            }
        }
    }
    
    if (!function_exists('get_journal_data1')) {
        function get_journal_data1($journal_id, $current_year) {
            $sql = "SELECT 
                        j.*,
                        COUNT(CASE WHEN a.`status` = 1 THEN 1 END) AS published_count,
                        COUNT(CASE WHEN a.`status` BETWEEN 2 AND 5 THEN 1 END) AS ongoing_count,
                        COUNT(CASE WHEN a.`status` = 6 THEN 1 END) AS reject_count
                    FROM 
                        `journal` AS j";
    
            if (!empty($journal_id)) {
                $sql .= " LEFT JOIN `article` AS a ON j.`journal_id` = a.`journal_id` AND YEAR(a.`date_added`) = ?";
            } else {
                $sql .= " LEFT JOIN `article` AS a ON j.`journal_id` = a.`journal_id` AND YEAR(a.`date_added`) = ?";
            }
    
            if (!empty($journal_id)) {
                $sql .= " WHERE j.`journal_id` = ?";
            }
    
            $sql .= " GROUP BY j.`journal_id`";
    
            if (!empty($journal_id)) {
                $results = execute_query($sql, [$current_year, $journal_id]);
            } else {
                $results = execute_query($sql, [$current_year]);
            }
    
            $data = array();
    
            if ($results !== false) {
                $data['journaldata1'] = $results;
                return $data;
            } else {
                return array('status' => false, 'data' => []);
            }
        }
    }
    
?>