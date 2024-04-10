<?php
session_start();
$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pahina | Guidelines</title>
    <link rel="stylesheet" href="../CSS/faqs.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <header class="header-container" id="header-container">

    </header>

    <nav class="navigation-menus-container" id="navigation-menus-container">

    </nav>

    <div class="content-over">
        <div class="cover-content">
            <p>Home / Tutorials</p>
            <!-- <h1 id="guideline-title">Tutorial on Publication</h1> -->
        </div>
    </div>

    <main class="d-flex flex-column-reverse flex-md-row-reverse gap-4 py-4">
        <aside class="">
        <div class="menu" id="for-contributors-menu">
            <!-- <h3>For Contributors</h3> -->
            <ul id="for-contributors">
                <li><b>Tutorials</b></li>
                <li class="faq-toggle"  data-target="tutorial-on-registration"><a href="tutorials.php#tutorial-on-registration">Be a Contributor</a></li>
                <li class="faq-toggle" data-target="tutorial-on-publication" ><a href="tutorials.php#tutorial-on-publication">Submit a Paper</a></li>
                <li class="faq-toggle"  data-target="tutorial-on-review"><a href="tutorials.php#tutorial-on-review">Become a Reviewer</a></li>
                
                <hr/>
                <li><b>Guidelines</b></li>
                <li><a href="guidelines.php#author-guidelines">Author Guidelines</a></li>
                <li><a href="guidelines.php#templates-for-author">Templates for Author</a></li>
                <li><a href="guidelines.php#publication-policy">Publication Policy</a></li>
                <li><a href="guidelines.php#article-submission">Article Submission</a></li>
                <li><a href="guidelines.php#peer-review-process">Peer-review Process</a></li>
                <li><a href="guidelines.php#become-a-reviewer">Become A Reviewer</a></li>
                <hr/>
                <a href="faqs.php"><li><b>FAQs</b></li></a>
            </ul>
            </div>           
        </aside>
        <section class="main" id="procedure-container" style="display:flex; flex-direction:column;gap:4em">
          <header class="text-center">
            <h2>How to's</h2>
            <span>This will show you step by step tutorial for the process</span>
          </header>
          <div class="mt-2 procedures flex-lg-row flex-column">
          <div class="procedure " >
              <div class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16"><path fill="var(--secondary)" fill-rule="evenodd" d="M3 13.5a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h9.25a.75.75 0 0 0 0-1.5H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9.75a.75.75 0 0 0-1.5 0V13a.5.5 0 0 1-.5.5zm12.78-8.82a.75.75 0 0 0-1.06-1.06L9.162 9.177L7.289 7.241a.75.75 0 1 0-1.078 1.043l2.403 2.484a.75.75 0 0 0 1.07.01z" clip-rule="evenodd"/></svg>
              </div>
              <a class="faq-toggle" href="#tutorial-on-registration" data-target="tutorial-on-registration" >
              
              <h5 class="title">Be a Contributor</h5>
              <div class="description">
                <p class="text-muted">Step 3: Before final publication, the journal's editorial team will strictly copyedit your accepted paper, ensuring and enhancing the overall clarity and conciseness of your writing.</p>
              </div>
            </a>  
            </div>
            <div class="procedure "  >
              <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="var(--secondary)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke-dasharray="14" stroke-dashoffset="14" d="M6 19h12"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.4s" values="14;0"/></path><path stroke-dasharray="18" stroke-dashoffset="18" d="M12 15 h2 v-6 h2.5 L12 4.5M12 15 h-2 v-6 h-2.5 L12 4.5"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="18;0"/></path></g></svg>
              </div>
              <a class="faq-toggle" href="#tutorial-on-publication" data-target="tutorial-on-publication">
                  <h5 class="title">Submit a Paper</h5>
                  <div class="description">
                    <p class="text-muted">Step 1: Create and update your account necessary detail. Here you can manage submissions, and track its progress. Make sure your manuscript adheres to the formatting and guidelines of your chosen journal.</p>
                  </div>
              </a>
            </div>
            <div class="procedure "  >
            
              <div class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="var(--secondary)" stroke-linecap="round" stroke-width="1.5"><path stroke-linejoin="round" d="M6 15.8L7.143 17L10 14M6 8.8L7.143 10L10 7"/><path d="M13 9h5m-5 7h5m4-4c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
              </div>
              <a class="faq-toggle" href="#tutorial-on-review" data-target="tutorial-on-review">
              <h5 class="title">Review a Paper</h5>
              <div class="description">
                <p class="text-muted">Step 2: Your paper will be assigned to qualified experts in your field who will carefully assess your work based on criteria, providing valuable feedback and suggestions for improvement.</p>
              </div>
            </a>
            </div>
           
          </div>
        </section>
        <div class="main" id="tutorial-on-publication-container" style="display:none">
            <div class="category w-100">
            <div class="mb-4">
                <h2 style="font-size:32px !important">Submit a Paper</h2>
            </div>
                <div class="s-1">
                    <p>At Pahina, we value your contributions and are dedicated to facilitating a smooth and rewarding publication journey. To assist you every step of the way, we've curated a comprehensive tutorial to provide clear guidance, ensuring that authors feel confident and empowered throughout their submission experience. Join us in sharing knowledge and advancing scholarship – submit your manuscript today and let's embark on this enriching journey together.</p> 
                    <ul>
                        <li>Before you submit a paper you must register first.  <a href="tutorials.php#tutorial-on-registration">Learn How to register</a></li> 
                    </ul>
                </div>
                <div class="s-2">
                    <h3>Submit a Paper</h3>
                    <p>Begin your publication journey by click</p>
                    <ol type="1">
                        <li>Look for a button where you can read ‘Submit an Article’</li>
                        <li>Click the Button to proceed.</li>
                    </ol>
                    <img src="../images/submit.png" alt="" class="img-reg">
                </div>
                <div class="s-2">
                    <h3>Step 1: Privacy</h3>
                    <p>Begin your publication journey by following and reading the submission checklist.</p>
                    <ol type="1">
                        <li>Review and complete all items on the submission checklist before proceeding.</li>
                        <li>Read the copyright notice for terms regarding content use and protection.</li>
                        <li>Review the privacy statement to understand how personal information is handled.</li>
                        <li>Put a check on a Checkbox and proceed to the next tab.</li>
                    </ol>
                    <img src="../images/step1.png" alt="" class="img-reg">
                </div>
                <div class="s-2">
                    <h3>Step 2: Article Details</h3>
                    <p>Write all the information needed and follow the instruction below.</p>
                    <ol type="1">
                        <li>Title - Enter a clear and informative title for your article.</li>
                        <li>Abstract - Summarize your article's key points briefly.</li>
                        <li>Keywords - List relevant keywords for searchability.</li>
                        <li>Reference - Provide a list of sources following the required citation style.</li>
                        <li>Originality Checker: This will automatically show up after you fill in all the needed information. This checker will make sure that this article is unique.</li>
                        <li>Journal classification- this will determine what type of journal your article is in. It's either the lamp, the star, or the gavel.</li>
                        <li>After you fill all the necessary information for your article, click the ‘Next’ button and proceed to the next step</li>
                    </ol>
                    <img src="../images/step2.png" alt="" class="img-reg">
                </div>
                <div class="s-2">
                    <h3>Step 3: Upload File</h3>
                    <ol type="1">
                        <li>You can click add file to upload your article in which type of file you are going to submit.</li>
                        <li>After you upload your file, click the ‘Next’ button and proceed to the next step.</li>
                    </ol>
                    <img src="../images/step3.png" alt="" class="img-reg">
                </div>
                <div class="s-2">
                    <h3>Step 4: Contributors</h3>
                    <p>Add details for all of the contributors to this submission. Contributors added here will be sent an email confirmation
                        of the submission, as well as a copy of all editorial decisions recorded against this submission.</p>
                    <ol type="1">
                        <li>If you have a co-author you can click the ‘Add contributor’.</li>
                        <li>Fill up their information in the box provided.</li>
                        <li>If you want to delete a data that you added, you can fill the checkbox and click the ‘Delete data’.</li>
                        <li>If you are done you will now proceed to the next step by clicking the ‘next’ button.</li>
                    </ol>
                    <img src="../images/step4.png" alt="" class="img-reg">
                </div>
                <div class="s-2">
                    <h3>Step 5: Notes</h3>
                    <p>Provide the following details to help our editorial team manage your submission.</p>
                    <ol type="1">
                        <li>Just click the space below and write the notes that you want to tell in our Editorial team.</li>
                        <li>After you write your notes you can proceed to the next step by clicking the ‘next’ button.</li>
                    </ol>
                    <img src="../images/step5.png" alt="" class="img-reg">
                </div>
                <div class="s-2">
                    <h3>Step 6: Preview</h3>
                    <p>Provide the following details to help our editorial team manage your submission.</p>
                    <ol type="1">
                        <li>Review the information you have entered before you complete your submission. You can change
                            any of the details displayed here by clicking the edit button at the top of each section.</li>
                        <li>When you are done, you can click the ‘Submit’ button below.</li>
                    </ol>
                    <img src="../images/step6.png" alt="" class="img-reg">
                </div>
                <div class="s-2">
                    <h3>Author’s view.</h3>
                    <p>Author’s view of their Contributions.</p>
                    <ol type="1">
                        <li>Click ‘All Submissions’ to see your submitted article as well as its status, date, and which journal it was submitted to</li>
                    </ol>
                    <img src="../images/authorsview.png" alt="" class="img-reg">
                </div>
            </div>
    	</div>
        <div class="main" id="tutorial-on-review-container" style="display: none;">
                <div class="category w-100">
                    <div class="mb-4">
                        <h2 style="font-size:32px !important">Become a Reviewer</h2>
                    </div>
                    <div class="s-1">
                        <p>Welcome to our Publication Tutorial for Pahina. This guide simplifies the process, ensuring a smooth experience for all contributors. Let's make your publication journey 
                            hassle-free – get started now! Begin your submission and share your insights with our scholarly community!</p>
                        <ul>
                            <li>Before you can review, you must register first.  <a href="tutorials.php#tutorial-on-registration">Learn How to register</a></li> 
                        </ul>
                    </div>
                    <div class="s-2">
                        <h3>Select Article</h3>
                        <p>In this page, You will see all your Submissions and All your reviews. You may proceed as a Reviewer.</p>
                        <ol type="1">
                            <li>Click the menu at the top right where you can read your name and then click My Contributions.</li>
                            <li>Click the ‘All Invitation’ to see the list of Articles and their status.</li>
                            <li>Select one Article that you want to review.</li>
                        </ol>
                        <img src="../images/select-article.png" alt="" class="img-reg">
                    </div>
                    <div class="s-2">
                        <h3>Review the Article</h3>
                        <ol type="1">
                            <li>Decide if you're going to accept or decline the article. </li>
                            <li>A message box will show up to ask if you will accept the invitation.</li>
                        </ol>
                        <img src="../images/review-article.png" alt="" class="img-reg">
                    </div>
                    <div class="s-2">
                        <h3>Review Steps and Guidelines</h3>
                        <p>After the reviewer decide on accepting this Article, They can answer the Review Guidelines.</p>
                        <ol type="1">
                            <li>Read the following Rules and Guidelines by reviewing this Article.</li>
                            <li>After they read the Rules and Guidelines, The Reviewer may proceed on the checkbox below before they click the “next” button.</li>
                        </ol>
                        <img src="../images/step3a.png" alt="" class="img-reg">
                    </div>
                    <div class="s-2">
                        <h3>Review Form</h3>
                        <p>The Reviewer are done to read the steps and Guidelines, They will now see the Review Form. The Reviewer should answer all the Questions.</p>
                        <ol type="1">
                            <li>There is also a textbox below of each questions where the Reviewer can leave a comment.</li>
                            <li>Below of these Questionnaire, The Reviewer can click the ‘Submit’ Button if they are done.</li>
                            <li>A message box will show up and ask you ‘Submit it now?’. </li>
                            
                        </ol>
                        <img src="../images/step3z.jpg" alt="" class="img-reg">
                    </div>
                    <div class="s-2">
                        <h3>Reviewed Article</h3>
                        <p>This is the round 1 in reviewing an Article.</p>
                        <ol type="1">
                            <li>The Reviewer can view the status and Updates of their reviewed article.</li>
    
                        </ol>
                        <img src="../images/reviewed-article.png" alt="" class="img-reg">
                    </div>
                </div>
        </div>
        <div class="main" id="tutorial-on-registration-container" style="display: none;">
        <div class="category w-100">
                    <div class="mb-4">
                        <h2 style="font-size:32px !important">Be a Contributor</h2>
                    </div>
                    <div class="s-1">
                  
                   
                    <p>Become an integral part of Pahina's scholarly community by exploring various avenues for participation.Whether you're lending your expertise as a reviewer, sharing groundbreaking research as an author, supporting our mission through donations, or actively engaging in scholarly discourse, your efforts are recognized through our <b>contributions points system, badges, and certificates</b>.<br/> Join us in cultivating a culture of knowledge exchange and academic excellence, fostering inclusivity and collaboration across the global academic landscape. Together, let's elevate accessibility and impact within scholarly research through Pahina</p><br/>
                    <div class="d-flex justify-content-center">
                        <div class="d-flex flex-column justify-content-between text-center">
                        <img width="200px" src="../images/thirdd_review_badges.png"/>
                        <span>Review Badge</span>
                        </div>
                        <div class="d-flex flex-column justify-content-between text-center">
                        <img width="200px" src="../images/third_publication_badges.png"/>
                        <span>Publication Badge</span>
                        </div>
                        <div class="d-flex flex-column justify-content-between text-center">
                        <img width="166px" src="../images/third_donation_badges.png"/>
                        <span>Donation Badge</span>
                        </div>
                    </div>
                    
                </div>
                <div class="s-2">
                    <h3>Registering with Open Access Journal</h3>
                    <p>Begin your publication journey by registering with Pahina. Follow these simple steps
                        to create your account:</p>
                    <ol type="1">
                        <li>Visit our journal website and click on the "Register" button.</li>
                        <li>Fill in the required information, including your name, email address, and a secure password.</li>
                        <li>Read and agree to the terms and conditions.</li>
                        <li>Click "Register" to complete the registration process.</li>
                    </ol>
                    <img src="../images/Registration.png" alt="" class="img-reg">
                </div>
                <div class="s-2">
                    <h3>Logging in to  Pahina website.</h3>
                    <p>After completing the registration, log in to your account.</p>
                    <ol type="1">
                        <li> Write your Email.</li>
                        <li>next is your password.</li>
                        <li>If it’s your first time to login, You need to input the OTP code that has sent to your Gmail.</li>
                        <li>When you are done just click ‘Verify’ to proceed.</li>
                    </ol>
                    <img src="../images/Login.png" alt="" class="img-reg">
                </div>
                <div class="s-2">
                    <h3>Complete your Personal Information.</h3>
                    <p>The user must complete all the information before they can Publish or Submit a paper.</p>
                    <ol type="1">
                        <li> Go to your profile.</li>
                        <li>Click then icon to edit your Information.</li>
                        <li>Complete all the missing information about you.</li>
                        <li>Click save if you are done.</li>
                    </ol>
                    <img src="../images/Profile.png" alt="" class="img-reg">
                     </div>
                </div>
        </div>
    </main>

    <div class="footer" id="footer">

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../JS/reusable-header.js"></script>

    <script src="../JS/faqs.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    function includeNavbar() {
    fetch('../PHP/navbar.php')
        .then(response => response.text())
        .then(data => {
        document.getElementById('navigation-menus-container').innerHTML = data;
        // Now that the content is loaded, you can attach event listeners or perform other operations as needed
        // For example, you can attach the notification button click event listener here
        attachNotificationButtonListener();
        })
        .catch(error => console.error('Error loading navbar.php:', error));
    }

    function attachNotificationButtonListener() {
    $(document).on('click', '#notification-button', function () {
        // Send AJAX request to mark notifications as read
        $.ajax({
        url: "../PHP/mark_notifications_read.php",
        type: "POST",
        data: { author_id: <?php echo $_SESSION['id']; ?> },
        success: function (response) {
            console.log("Notifications marked as read:", response);
            // Update notification count on success
            $("#notification-count").text("0");
        },
        error: function (xhr, status, error) {
            console.error("Error marking notifications as read:", error);
        }
        });
    });
    }

    // Call includeNavbar function to load navbar.php content
    includeNavbar();


    </script>
</body>

</html>