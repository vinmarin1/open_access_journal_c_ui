<?php
require 'dbcon.php';
require '../vendor/autoload.php';

$options = array(
    'cluster' => 'ap1',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    'cabcad916f55a998eaf5',
    '0aef8b4d2da6760f5726',
    '1764683',
    $options
);

if (!empty($_GET)) {
    session_start();

    $_SESSION['product'] = $_GET['item_name'];
    $_SESSION['txn_id'] = $_GET['tx'];
    $_SESSION['amount'] = $_GET['amt'];
    $_SESSION['currency'] = $_GET['cc'];
    $_SESSION['status'] = $_GET['st'];
    $_SESSION['payer_id'] = $_GET['payer_id'];
    $_SESSION['payer_email'] = $_GET['payer_email'];
    $_SESSION['payer_name'] = $_GET['first_name'] . ' ' . $_GET['last_name'];

    $author_id = $_SESSION['product'];
    $product = "Donation";
    $txn_id = $_SESSION['txn_id'];
    $payer_id = $_SESSION['payer_id'];
    $payer_name = $_SESSION['payer_name'];
    $payer_firstname = $_GET['first_name'];
    $payer_lastname = $_GET['last_name'];
    $payer_email = $_SESSION['payer_email'];
    $currency = $_SESSION['currency'];
    $amount = $_SESSION['amount'];
    $point_earned = $amount / 50;
    $status = $_SESSION['status'];
    $created_at = date('y-m-d h:i:s');

    $sql = "INSERT INTO donation (author_id, donation_id, donator_id, donator_name, donator_email, item_id, item_name, currency, amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        $result = database_run($sql, array($author_id, $txn_id, $payer_id, $payer_name, $payer_email, $txn_id, $product, $currency, $amount, $status), true);

        if ($result) {
            $data['message'] = 'hello world';
            $pusher->trigger('my-channel', 'my-event', $data);

            $sql2 = "INSERT INTO `user_points`(`user_id`, `email`, `action_engage`, `point_earned`) VALUES (?, ?, ?, ?)";

            $result2 = database_run($sql2, array($author_id, $payer_email, $product, $point_earned), true);

            $title = 'Send Donation';
            $description = $payer_name . ' Send Donation PHP ' . $amount;

            $sql3 = "INSERT INTO `notification`(`author_id`, `title`, `description`, 1) VALUES (?, ?, ?, ?)";

            $result3 = database_run($sql3, array($author_id, $title, $description), true);

            header('Location: donation.php?payer_firstname=' . urlencode($payer_firstname) . '&payer_lastname=' . urlencode($payer_lastname) . '&payer_email=' . urlencode($payer_email) . '&amount=' . urlencode($amount));
            exit();
        } else {
            echo "Failed to insert payment information.";
        }
    } catch (PDOException $e) {
        error_log("Error in insertDonation: " . $e->getMessage());
        echo "An error occurred while processing the payment.";
    }
}
