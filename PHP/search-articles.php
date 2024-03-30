<?php
if(isset($_GET['search'])) {
    $search = $_GET['search'];
    header("Location: browse-articles.php?search=" . urlencode($search));
    exit();
} else {
    header("Location:  browse-articles.php");
    exit();
}
?>
