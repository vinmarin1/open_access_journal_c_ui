<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | DONATION</title>
    <link rel="stylesheet" href="../CSS/donation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="header-container" id="header-container">
<!-- header will be display here by fetching reusable files -->
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
<!-- navigation menus will be display here by fetching reusable files -->
</nav>


<div class="main-container">
    <div class="content-over">

    </div>

    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-1">
                <!------ Blank Space ------>
            </div>

            <div class="col-md-10">
                <h2>Donate to Empower Knowledge Sharing</h2>
                <span><p>We believe in the power of open access to knowledge and the transformative impact it can have on education, research, and global progress. By contributing to our open-access journal system, you're helping us break down barriers to information and make scholarly content freely available to everyone, anywhere.</p></Span>
            </div>

            <div class="col-md-1">
                <!------ Blank Space ------>
            </div>
        </div>

        <div class="row">
        <div class="col-md-1">
                <!------ Blank Space ------>
            </div>
            <div class="col-md-5 mt-5 helps">
                <h2>How your donation helps</h2>
                <div class="row mb-4 mt-5">
                    <div class="col-md-5">
                        <img src="../images/donate.png" alt="donate.png">
                    </div>
                    <div class="col-md-6">
                        <h3>Accessibility</h3>
                        <p>We strive to make our platform accessible to as many users as possible. Your donation supports efforts to enhance user experience and ensure inclusivity.</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-5">
                        <img src="../images/donate.png" alt="donate.png">
                    </div>
                    <div class="col-md-6">
                        <h3>Quality Content</h3>
                        <p>Funding allows us to uphold rigorous editorial standards, ensuring the publication of high-quality, peer-reviewed research.</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-5">
                        <img src="../images/donate.png" alt="donate.png">
                    </div>
                    <div class="col-md-6">
                        <h3>Global Reach</h3>
                        <p>We aim to expand our reach and engage with diverse communities. Your support facilitates outreach programs and collaborations with institutions worldwide.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-5">
                        <h2>How Does it Work?</h2>
                        <ol start="1" type="1">
                            <li>Click the 'Donate' Button: Select your donation amount and complete the simple and secure payment process.</li>
                            <li>Earn Hearts: For every amount donated, you earn a heart. Watch your impact grow with each contribution.</li>
                            <li>Choose Articles to Support: Navigate to our articles and allocate your hearts to the research that resonates with you.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-md-1">
                <!------ Blank Space ------>
            </div>
            <form id="donateForm" method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr"  class="col-md-4 mb-5 mt-5 payment-form">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between mt-3">
                                <span class="step active" style="margin-left: 30px;" title="Amount">1</span>
                                <!-- <span class="step" title="Personal Info">2</span> -->
                                <span class="step" style="margin-right: 30px;"  title="Payment Method"> 2</span>
                            </div>
                            <input type="hidden" name="business" value="sb-gju3a29373225@business.example.com">
                            <input type="hidden" name="item_name" value="Donation">
                            <input type="hidden" name="item_number" value="1">
                            <input type="hidden" name="amount" id="amount">
                            <input type="hidden" name="currency_code" value="PHP">
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="return" value="https://openaccessjournalcui-production.up.railway.app/PHP/success.php">
                            <input type="hidden" name="cancel_return" value="https://openaccessjournalcui-production.up.railway.app/PHP/donation.php">

                            <!---- Step 1 ------>
                            <div class="tab" id="tab1">
                                <div class="container-fluid">
                                    <h2 style="color: black; margin-top:40px ">Select an Amount</h2>
                                    <div class="row amountBtn mt-4">
                                        <div class="col-md-4 col-6">
                                            <button type="button" onclick="selectAmount(100)"> 
                                                <h3>PHP 100 </h3>
                                                <span style="color:red; font-size:25px">&hearts;</span>
                                                <span style="margin-left:10px">2</span>
                                                
                                            </button>
                                        </div>

                                        <div class="col-md-4 col-6">
                                            <button type="button" onclick="selectAmount(200)"> 
                                                <h3>PHP 200</h3>
                                                <span style="color:red; font-size:25px">&hearts;</span>
                                                <span style="margin-left:10px">4</span>
                                            </button>
                                        </div>

                                        <div class="col-md-4 col-6  mt-md-0 mt-4">
                                            <button type="button" onclick="selectAmount(300)"> 
                                                <h3>PHP 300</h3>
                                                <span style="color:red; font-size:25px">&hearts;</span>
                                                <span style="margin-left:10px">6</span>
                                            </button>
                                        </div>
                                    
                                        <div class="col-md-4 col-6 mt-4">
                                            <button type="button" onclick="selectAmount(500)"> 
                                                <h3>PHP 500</h3>
                                                <span style="color:red; font-size:25px">&hearts;</span>
                                                <span style="margin-left:10px">10</span>
                                            </button>
                                        </div>

                                        <div class="col-md-4 col-6 mt-4">
                                            <button type="button" onclick="selectAmount(1000)"> 
                                                <h3>PHP 1000</h3>
                                                <span style="color:red; font-size:25px">&hearts;</span>
                                                <span style="margin-left:10px">20</span>
                                            </button>
                                        </div>

                                        <div class="col-md-4 col-6 mt-4">
                                            <button type="button" onclick="selectAmount(2000)"> 
                                                <h3>PHP 2000</h3>
                                                <span style="color:red; font-size:25px">&hearts;</span>
                                                <span style="margin-left:10px">40</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row custAmount mt-5">
                                        <div class="col-md-12">
                                            <button type="button"  onclick="togglePopup()">
                                                <h3> + Custom Amount</h3>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Popup form -->
                                    <div id="overlay" onclick="togglePopup()"></div>
                                    <div id="customAmountPopup">
                                        <form>
                                            <label for="customAmount">Enter Custom Amount:</label>  
                                            <input type="number" id="customAmount" required>
                                            <button type="button" onclick="handleCustomAmountSubmit()">Submit</button>
                                        </form>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12 mt-3">
                                            <span id="earnLabel" style="color:#A6A6A6" >Earn: </span>
                                            <span id="heartPoints"></span>
                                            <span style="color:red; font-size:25px">&hearts;</span>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <p>Your donation, regardless of its size, contributes to a future where knowledge is a shared resource. Join us on this journey toward a more equitable and collaborative world.</p>
                                        </div>                                        
                                    </div>
                                </div>

                            </div>

                        <!---- Step 3 ------>
                        <div class="tab" id="donateSum">
                            <input type="hidden" name="donateamout" value="<?php echo isset($_GET['amount']) ? $_GET['amount'] : ''; ?>">
                                <h2 style="color: black; margin-top:40px">Donation Summary</h2>

                                <div class="row">
                                    <div class="col-md-12 mt-4 d-flex align-items-center justify-content-center">
                                        <p style="color: #A6A6A6;">Dear <?php echo isset($_GET['payer_firstname']) ? $_GET['payer_firstname'] : ''; ?>, thank you for your support!</p>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-6 col-6">
                                        <span><h4 style="font-weight: bold;">Amount</h4></span>
                                    </div>
                                    <div class="col-md-6 col-6 text-end">
                                        <span><h4 style="font-weight: bold;">PHP <?php echo isset($_GET['amount']) ? $_GET['amount'] : ''; ?></h4></span>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6 col-6">
                                        <span><h4 style="font-weight: bold;">First Name</h4></span>
                                    </div>
                                    <div class="col-md-6 col-6 text-end">
                                        <span><h5><?php echo isset($_GET['payer_firstname']) ? $_GET['payer_firstname'] : ''; ?></h5></span>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6 col-6">
                                        <span><h4 style="font-weight: bold;">Last Name</h4></span>
                                    </div>
                                    <div class="col-md-6 col-6 text-end">
                                        <span><h5><?php echo isset($_GET['payer_lastname']) ? $_GET['payer_lastname'] : ''; ?></h5></span>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-5 col-4">
                                        <span><h4 style="font-weight: bold;">Email</h4></span>
                                    </div>
                                    <div class="col-md-7 col-7 text-end">
                                        <span><h5><?php echo isset($_GET['payer_email']) ? $_GET['payer_email'] : ''; ?></h5></span>
                                    </div>
                                </div>



                            <div class="col-md-12 blanks mt-5"> <!----------- Blank Space--------------> </div>
                        </div>

                        <div class="col-md-12 donate" style="float:right;">
                            <button type="button" id="donateBtn" onclick="donate(1)" style="font-size: 25px;">DONATE</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

</div>





<div class="footer" id="footer">
    <!-- footer will be display here by fetching reusable files -->
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../JS/reusable-header.js"></script>
    <script src="../JS/donation.js"></script>
</body>
</html>