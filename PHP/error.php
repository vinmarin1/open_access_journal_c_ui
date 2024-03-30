<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>