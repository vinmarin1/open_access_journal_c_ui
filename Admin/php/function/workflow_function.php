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
                $query = "SELECT * FROM article_final_files WHERE article_id = :aid AND filefrom = 'Production'";
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

if (!function_exists('check_article_reviewer')) {
    function check_article_reviewer($aid) {
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

if (!function_exists('check_reviewer_accept')) {
    function check_reviewer_accept($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM reviewer_assigned WHERE accept = 1 AND answer = 1";
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

if (!function_exists('check_reviewer_notcomplete')) {
    function check_reviewer_notcomplete($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM reviewer_assigned WHERE accept = 0 AND answer = 0 AND DATE(deadline) <= CURDATE();";
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

if (!function_exists('check_reviewer_ongoing')) {
    function check_reviewer_ongoing($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM reviewer_assigned WHERE accept = 0 AND answer = 0 AND DATE(deadline) >= CURDATE();";
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

if (!function_exists('get_discussion')) {
    function get_discussion($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM discussion WHERE article_id = :aid";
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

if (!function_exists('get_revision_files')) {
    function get_revision_files($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article_revision_files WHERE article_id = :aid";
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

if (!function_exists('get_copyeditingrevision_files')) {
    function get_copyeditingrevision_files($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article_revision_files WHERE article_id = :aid AND copyediting = 1";
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

if (!function_exists('get_copyedited_files')) {
    function get_copyedited_files($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article_final_files WHERE article_id = :aid AND copyedited = 1 AND filefrom = 'Copyedited'";
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

if (!function_exists('get_allcopyedited_files')) {
    function get_allcopyedited_files($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article_final_files WHERE article_id = :aid AND filefrom = 'Copyedited'";
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


if (!function_exists('get_issues_list')) {
    function get_issues_list($journal_id) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM issues WHERE journal_id = :journal_id AND status = 1";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':journal_id', $journal_id, PDO::PARAM_INT);
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

if (!function_exists('get_article_logs')) {
    function get_article_logs($aid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM logs_article WHERE article_id = :aid ORDER BY logs_id DESC;";
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

if (!function_exists('getauthordetails')) {
    function getauthordetails($author_id) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM author WHERE author_id = :author_id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT);
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



