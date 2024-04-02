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
            <h1>Tutorials</h1>
        </div>
    </div>

    <main class="d-flex flex-column-reverse flex-md-row gap-2">
        <aside class="">
        <div class="menu" id="for-contributors-menu">
            <!-- <h3>For Contributors</h3> -->
            <ul id="for-contributors">
                <li><b>Tutorials</b></li>
                <li class="faq-toggle" data-target="tutorial-on-publication">Tutorial on Publication</li>
                <li class="faq-toggle" data-target="tutorial-on-review">Tutorial on Review</li>
                <hr/>
                <li><b>Guidelines</b></li>
                <li class="faq-toggle" id="author-guidelines" data-target="author-guidelines"><a href="guidelines.php#author-guidelines">Author Guidelines</a></li>
                <li class="faq-toggle" data-target="templates-for-author"><a href="guidelines.php#templates-for-author">Templates for Author</a></li>
                <li class="faq-toggle" data-target="publication-policy"><a href="guidelines.php#publication-policy">Publication Policy</a></li>
                <li class="faq-toggle" data-target="article-submission"><a href="guidelines.php#article-submission">Article Submission</a></li>
                <li class="faq-toggle" data-target="peer-review-process"><a href="guidelines.php#peer-review-process">Peer-review Process</a></li>
                <li class="faq-toggle" id="become-a-reviewer" data-target="become-a-reviewer"><a href="guidelines.php#become-a-reviewer">Become A Reviewer</a></li>
                <hr/>
                <a href="faqs.php"><li class="faq-toggle" data-target="frequently-asked-questions"><b>FAQs</b></li></a>
            </ul>
            </div>           
        </aside>

        <div class="main" id="tutorial-on-publication-container" style="display: none;">
            <div class="header">
                <h2>Tutorial on Publication</h2>
            </div>
            <div class="category w-100">
                <div class="s-1">
                    <p>Welcome to our Publication Tutorial for Pahina. This guide simplifies the process, 
                    ensuring a smooth experience for all contributors. Let's make your publication journey hassle-free – get
                    started now! Begin your submission and share your insights with our scholarly community!</p>
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
                    <h3>Making a Submission</h3>
                    <p>After completing the registration, log in to your account.</p>
                    <p>Once you are logged in, click on 'Be a Contributor' to begin the process of submitting your articles.</p>
                    <img src="../images/Submission.png" alt="" class="img-sub">
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
                        <li>After you fill all the necessary information for your article, click the ‘Next’ button and proceed to the next step.</li>
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
            </div>
    	</div>
        <div class="main" id="tutorial-on-review-container" style="display: none;">
            <div class="header">
                    <h2>Tutorial on Review</h2>
                </div>
                <div class="category w-100">
                    <div class="s-1">
                        <p>Welcome to our Publication Tutorial for Pahina. This guide simplifies the process, ensuring a smooth experience for all contributors. Let's make your publication journey 
                            hassle-free – get started now! Begin your submission and share your insights with our scholarly community!</p>
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
                        <h3>Manage Contributions</h3>
                        <ol type="1">
                            <li>Click the menu at the top right where you can read your name.</li>
                            <li>Click My Contributions to proceed to the next step.</li>
                        </ol>
                      
                    </div>
                    <div class="s-2">
                        <h3>Select Article</h3>
                        <p>In this page, You will see all your Submissions and All your reviews. You may proceed as a Reviewer.</p>
                        <ol type="1">
                            <li>Click the ‘All Reviews’ to see the list of Articles and their status.</li>
                            <li>You can also click the notification bell to see the pending Article that needed to review.</li>
                        </ol>
                        <img src="../images/select-article.png" alt="" class="img-reg">
                    </div>
                    <div class="s-2">
                        <h3>Article Preview</h3>
                        <ol type="1">
                            <li>You can read the content of this Article through this page. </li>
                            <li>After you click the article, You can decide if you will accept to review or decline.</li>
                        </ol>
              
                    </div>
                    <div class="s-2">
                        <h3>Review Steps and Guidelines</h3>
                        <p>After the reviewer decide on accepting this Article, They can answer the Review Guidelines.</p>
                        <ol type="1">
                            <li>Read the following Rules and Guidelines by reviewing this Article.</li>
                            <li>After they read the Rules and Guidelines, The Reviewer may proceed on the checkbox below before they click the “next” button.</li>
                        </ol>
                        <img src="../images/step3a.png" alt="" class="img-reg">
                        <img src="../images/step3b.png" alt="" class="img-reg">
                    </div>
                    <div class="s-2">
                        <h3>Review Form</h3>
                        <p>The Reviewer are done to read the steps and Guidelines, They will now see the Review Form.</p>
                        <ol type="1">
                            <li>The Reviewer should answer all the Questions.</li>
                            <li>There is also a textbox beside of the Questions where the Reviewer can leave a comment.</li>
                            <li>Below of these Questionnaire, The Reviewer can click the ‘Submit’ Button if they are done.</li>
                        </ol>
                        <img src="../images/step4a.png" alt="" class="img-reg">
                        <img src="../images/step4b.png" alt="" class="img-reg">
                        <img src="../images/step4c.png" alt="" class="img-reg">
                    </div>
                    <div class="s-2">
                        <h3>Article View as Reviewer</h3>
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
</body>

</html>