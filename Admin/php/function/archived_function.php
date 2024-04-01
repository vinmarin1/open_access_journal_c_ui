<?php
require_once 'dbcon.php';

if (!function_exists('get_archived_list')) {
    function get_archived_list() {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM archive WHERE admin = 1";
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

if (!function_exists('get_userarchived_list')) {
    function get_userarchived_list() {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM author WHERE status = 0";
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

if (!function_exists('get_journalarchived_list')) {
    function get_journalarchived_list() {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM journal WHERE status = 0";
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

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'unarchiveuser':
        unarchiveUser();
        break;
    case 'unarchivejournal':
        unarchiveJournal();
        break;
}

function unarchiveUser()
{
    $authorId = $_POST['author_id'];

    $query = "UPDATE author SET status = 1 WHERE author_id = ?";
    $result = execute_query($query, [$authorId]);

    echo json_encode(['status' => $result !== false, 'message' => $result !== false ? 'User unarchived successfully' : 'Failed to unarchive user']);
}

function unarchiveJournal()
{
    $journalId = $_POST['journal_id'];

    $query = "UPDATE journal SET status = 1 WHERE journal_id = ?";
    $result = execute_query($query, [$journalId]);

    echo json_encode(['status' => $result !== false, 'message' => $result !== false ? 'Journal unarchived successfully' : 'Failed to unarchived journal']);
}


?>
