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

if (!function_exists('get_submission_files')) {
    function get_submission_files($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article_files WHERE article_id = :aid AND submission = 1";
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

if (!function_exists('get_review_files')) {
    function get_review_files($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article_files WHERE article_id = :aid AND review = 1";
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

if (!function_exists('get_copyediting_files')) {
    function get_copyediting_files($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article_files WHERE article_id = :aid AND copyediting = 1";
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

if (!function_exists('get_production_files')) {
    function get_production_files($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article_files WHERE article_id = :aid AND production = 1";
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

if (!function_exists('get_article_reviewer')) {
    function get_article_reviewer($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM reviewer_assigned WHERE article_id = :aid";
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

if (!function_exists('get_reviewer_details')) {
    function get_reviewer_details() {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM author";
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