<?php
include 'dbcon.php';

if (!function_exists('get_report_list')) {
    function get_report_list() {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM reports";
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
        function get_counter_list($month, $year) {
            $month = $_GET["m"] ?? date('m');
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
                logs l ON a.article_id = l.article_id AND MONTH(l.date) = ? AND YEAR(l.date) = ?
            WHERE 
                a.status = 1
            GROUP BY 
                a.article_id;";
                    
            $results = execute_query($sql, [$month, $year]);

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
                a.author_id, a.first_name, a.last_name, a.email;";
        
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

?>