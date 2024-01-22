<?php
require 'dbcon.php';

if (!empty($_GET)) {
    session_start();

    $_SESSION['product'] = $_GET['item_name'];
    $_SESSION['txn_id'] = $_GET['tx'];
    $_SESSION['amount'] = $_GET['amt'];
    $_SESSION['currency'] = $_GET['cc'];
    $_SESSION['status'] = $_GET['st'];
    $_SESSION['payer_id'] = $_GET['payer_id'];
    $_SESSION['payer_email'] = $_GET['payer_email'];
    $_SESSION['payer_name'] = $_GET['first_name'].' '.$_GET['last_name'];

    $product = $_SESSION['product'];
    $txn_id = $_SESSION['txn_id'];
    $payer_id = $_SESSION['payer_id'];
    $payer_name = $_SESSION['payer_name'];
    $payer_firstname = $_GET['first_name'];
    $payer_lastname = $_GET['last_name'];
    $payer_email = $_SESSION['payer_email'];
    $currency = $_SESSION['currency'];
    $amount = $_SESSION['amount'];
    $status = $_SESSION['status'];
    $created_at = date('y-m-d h:i:s');

    $sql = "INSERT INTO donation (donation_id, donator_id, donator_name, donator_email, item_id, item_name, currency, amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        $result = database_run($sql, array($txn_id, $payer_id, $payer_name, $payer_email, $txn_id, $product, $currency, $amount, $status), true);

        if ($result) {
            header('Location: donation.php?payer_firstname=' . urlencode($payer_firstname) . '&payer_lastname=' . urlencode($payer_lastname). '&payer_email=' . urlencode($payer_email). '&amount=' . urlencode($amount));
            exit(); 
        } else {
            echo "Failed to insert payment information.";
        }
    } catch (PDOException $e) {
        error_log("Error in insertDonation: " . $e->getMessage());
        echo "An error occurred while processing the payment.";
    }
}
?>
