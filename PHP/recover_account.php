<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>QCU TIMES | RECOVER ACCOUNT</title>
    <link rel="stylesheet" href="../CSS/recover_account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form id="form">
        <p class="h3" id="step1Label">Recover Account</p>
        <p class="h5 mb-5" style="text-align: center; display: none" id="step2Label">We've sent OTP code to this E-mail <br>
            <span class="h6">Please Enter the 5 digit code to recover you account</span><br>
            <span class="h6" style="color: blue" id="getEmail"></span>
        </p>
        <div id="firstStep">
            <div class="label">
                <label for="email">Email:</label><br>
            </div>
            <div class="input-group mb-3" id="inputFields">
                <input type="text" class="form-control"  aria-describedby="basic-addon1" name="email" id="email">
                <button type="button" class="btn btn-primary btn-md" id="sendBtn" disabled>

                    Next
                    <div class="spinner-border spinner-border-sm" role="status" id="spinner" style="display: none">
                        <span class="visually-hidden">Sending OTP...</span>
                    </div>
                </button>
            </div>
        </div>

        <div id="secondStep">
            <div class="label">
            </div>
            <div class="input-group mb-3" id="inputFields1">
                <input type="text" class="form-control" aria-describedby="basic-addon1" name="otp" id="otp" style="text-align: center">
                <button type="submit" class="btn btn-primary btn-md" id="otpBtn" disabled>Enter OTP</button>
            </div>
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../JS/recover_account.js"></script>

</body>
</html>
