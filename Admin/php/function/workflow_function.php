<?php
include 'dbcon.php';

// Check if the function is not already defined
if (!function_exists('get_article_data')) {
    function get_article_data($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article WHERE article_id = :aid";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
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

if (!function_exists('get_article_files')) {
    function get_article_files($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article_files WHERE article_id = :aid";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
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

if (!function_exists('get_article_discussion')) {
    function get_article_discussion($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM issues WHERE issues_id = :aid";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
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

if (!function_exists('get_article_participant')) {
    function get_article_participant($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM issues WHERE article_id = :aid";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
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

if (!function_exists('get_article_contributor')) {
    function get_article_contributor($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM contributors WHERE article_id = :aid";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
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