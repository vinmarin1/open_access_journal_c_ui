<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>

<body>
    <div class="header-container" id="header-container">
        <!-- header will be display here by fetching reusable files -->
    </div>
    <section style="padding:4em 8%; min-height:50vh">
        <h1>Oops! We encountered an issue.</h1>
        <p>Don't worry it's not your fault please come back in a few minutes:</p>
        <?php
            if (isset ($_GET['message'])) {
                // Retrieve and display the error message
                $errorMessage = $_GET['message'];
                echo "<p>Error Message: $errorMessage</p>";
            } else {
                // If no error message is provided, display a generic error message
               header("Location: index.php");
            }
        ?>
    </section>
    <div class="footer" id="footer"></div>
    <script src="../JS/reusable-header.js"></script>

</body>

</html>