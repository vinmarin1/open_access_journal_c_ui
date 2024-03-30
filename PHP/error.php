<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>

<body style="min-height:100vh">
    <div class="header-container" id="header-container">
    </div>
    <section style="padding:4em 8%; ">
        <h1>Oops! We encountered an issue.</h1>
        <p>Don't worry it's not your fault please come back in a few minutes:</p>
        <?php
            if (isset ($_GET['message'])) {
                // Retrieve and display the error message
                $errorMessage = $_GET['message'];
                echo "<p>Error Message: $errorMessage</p>";
            } else {
               header("Location: index.php");
            }
        ?>
    </section>
    <div class="footer" id="footer"></div>
    <script src="../JS/reusable-header.js"></script>

</body>

</html>