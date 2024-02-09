<?php
include 'dbcon.php';

// Check if the function is not already defined
if (!function_exists('get_allarticle_list')) {
    function get_allarticle_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article";
                $stmt = $pdo->query($query);

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

if (!function_exists('get_journal_list')) {
    function get_journal_list($journal_id = null) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM journal WHERE status = 1";

                if (!empty($journal_id)) {
                    $query .= " AND journal_id = :journal_id";
                }

                $stmt = $pdo->prepare($query);

                if (!empty($journal_id)) {
                    $stmt->bindParam(':journal_id', $journal_id, PDO::PARAM_INT);
                }

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

if (!function_exists('get_article_list')) {
    function get_article_list($cid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article WHERE journal_id = :cid";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':cid', $cid, PDO::PARAM_INT);
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

if (!function_exists('get_contributor_list')) {
    function get_contributor_list() {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM contributors";
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

if (!function_exists('get_journal_detail')) {
    function get_journal_detail($cid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM journal WHERE journal_id = :cid";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':cid', $cid, PDO::PARAM_INT);
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
