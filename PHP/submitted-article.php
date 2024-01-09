<?php
session_start();

require 'dbcon.php';
$userId = $_SESSION['id'];
$articleId = isset($_GET['id']) ? $_GET['id'] : null;
?>


<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submitted Article</title>
<link href="../CSS/submitted-article.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<body>

<div class="header-container" id="header-container">
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
</nav>


<div class="article-title">
  <!-- Header content like title and authors goes here -->
    <div class="main-title">
        <div class="breadcrumbs">
            Dashboard / Author / Submitted Articles
        </div>
        <p id="title">
            <?php 
                $sqlReviewraticle = "SELECT title FROM article WHERE article_id =:article_id AND author_id =:author_id";

                $result = database_run($sqlReviewraticle, array('author_id' => $userId,
                        'article_id' => $articleId));

                if ($result !== false) {
                    foreach ($result as $row) {
                        echo $row->title;
                    }
                } else {
                    echo "No articles found."; 
                }
            ?>
        </p>

    </div>
</div>
<div class="row1">
    <div class="abstract">
    <!-- Abstract content goes here -->
        <div class="abstract-title">Abstract</div>
        <div class="abstract-content">
            <p id="display-abstract">
                <?php 
                    $sqlReviewraticle = "SELECT abstract FROM article WHERE article_id =:article_id AND author_id =:author_id";

                    $result = database_run($sqlReviewraticle, array('author_id' => $userId,
                            'article_id' => $articleId));

                    if ($result !== false) {
                        foreach ($result as $row) {
                            echo $row->abstract;
                        }
                    } else {
                        echo "No articles found."; 
                    }
                ?>
            </p>
        </div>
    </div>
    <div class="column1">

        <div class="status">
        <p id="display-status">
            <?php

                $sqlStatus = "SELECT article_status.status FROM article_status JOIN article ON article_status.status_id = article.status WHERE article.author_id = :author_id AND article.article_id = :article_id";

                $result = database_run($sqlStatus, array('author_id' => $userId,
                'article_id' => $articleId));

                if ($result !== false) {
                foreach ($result as $row) {
                echo $row->status;
                }
                } else {
                echo "No status for this article"; 
                }
            ?>
        </p>
        </div>

        <div class="submit-details">
            <!-- Submission details like dates and IDs goes here -->
            <div class="submit-section">
                <div class="submit-section-title"><p id="display-submittedOn">
                    <?php

                        $sqlStatus = "SELECT journal.journal FROM journal JOIN article ON journal.journal_id = article.journal_id WHERE article.author_id = :author_id AND article.article_id = :article_id";

                        $result = database_run($sqlStatus, array('author_id' => $userId,
                        'article_id' => $articleId));

                        if ($result !== false) {
                        foreach ($result as $row) {
                        echo $row->journal;
                        }
                        } else {
                        echo "No journal for this article"; 
                        }
                    ?>
                </p></div>
            </div>
            <div class="logs-date-container">
                <div class="logs">
                    
                    <div class="logs-title">Logs</div> <!-- Logs title -->
                    <div class="log-entry"><b>Review</b><br>1st version revision</div>
                    <div class="log-entry"><b>Review</b><br>Reviewed by Reviewer B</div>
                    <div class="log-entry"><b>Review</b><br>Reviewed by Reviewer A</div>
                    <div class="log-entry"><b>Review</b><br>Send for review</div>
                    <div class="log-entry"><p id="submitOn">

                    <?php

                    $sqlStatus = "SELECT journal.journal FROM journal JOIN article ON journal.journal_id = article.journal_id WHERE article.author_id = :author_id AND article.article_id = :article_id";

                    $result = database_run($sqlStatus, array('author_id' => $userId,
                    'article_id' => $articleId));

                    if ($result !== false) {
                    foreach ($result as $row) {
                    echo $row->journal;
                    }
                    } else {
                    echo "No journal for this article"; 
                    }
                    ?>
                    </p></div>
                </div>
                
                <div class="dates">
                    <div class="dates-title">Date</div>
                    <div class="date">2023-11-09</div>
                    <div class="date">2023-11-09</div>
                    <div class="date">2023-11-09</div>
                    <div class="date">2023-11-09</div>
                    <div class="date">2023-11-09</div>
                </div>
            </div>
            <a href="#" class="view-all-logs">View All Logs</a>
        </div>
    </div>
</div> 

<div class="row2">
    <div class="main2">
        <div class="files-submitted">
            <div class="table-header">Files Submitted</div>
            <table>
                <thead>
                    <tr>
                        <th>File</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> 
                            <?php

                                $sqlStatus = "SELECT article_files.file_name FROM article_files JOIN article ON article_files.article_id = article.article_id WHERE article.author_id = :author_id AND article.article_id = :article_id AND article_files.file_type = 'File with no author' ";

                                $result = database_run($sqlStatus, array('author_id' => $userId,
                                'article_id' => $articleId));

                                if ($result !== false) {
                                foreach ($result as $row) {
                                echo $row->file_name;
                                }
                                } else {
                                echo "No file for this article"; 
                                }
                            ?>
                        </td>
                        <td>
                            <?php

                                $sqlStatus = "SELECT article_files.date_added FROM article_files JOIN article ON article_files.article_id = article.article_id WHERE article.author_id = :author_id AND article.article_id = :article_id AND article_files.file_type = 'File with no author' ";

                                $result = database_run($sqlStatus, array('author_id' => $userId,
                                'article_id' => $articleId));

                                if ($result !== false) {
                                foreach ($result as $row) {
                                echo $row->date_added;
                                }
                                } else {
                                echo "No file for this article"; 
                                }
                            ?>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>Article AboutThe Future of Artificial Intelligence.pdf</td>
                        <td>2023-11-09</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
        <div class="files-submitted">
            <div class="table-header"></div>
        
                <div class="keywords">
                    <?php
                        $sqlKeyword = "SELECT keyword FROM article WHERE article_id = :article_id AND author_id = :author_id";
                        
                        $result = database_run($sqlKeyword, array('author_id' => $userId,
                        'article_id' => $articleId));

                        if ($result !== false) {
                            foreach ($result as $row) {
                                $keywords = explode(',', $row->keyword);
                                foreach ($keywords as $keyword) {
                                    echo '<li style="list-style-type: none; 
                                                    margin-right: 5px;
                                                    width: auto;
                                                    color: #0858a4;
                                                    border: 1px solid #0858a4;
                                                    border-radius: 10px;
                                                    background-color: white;
                                                    font-size: 12px;
                                                    display: inline-block">' . trim($keyword) . '</li>';
                                }
                                
                            }
                        } else {
                            echo "No keywords for this article";
                        }
                    ?>
                </div>
            </div>
        </div>
    <div class="main3">
        <div class="comments-container">
            <div class="table-header">Comments</div>
            <table>
                <thead>
                    <tr>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>For revision</td>
                    </tr>
                    <tr>
                        <td>Comment Comment Comment Comment Comm...</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="review-rubrics">
            <div class="section-header">Review Rubrics</div>
            <div class="section-body">
                <p>In the web browser: Does the Little Lemon web app match the UI/UX from the Figma mockup and wireframe?</p>
                <form>
                    <ul>
                        <li>
                            <label>
                                <input type="radio" name="question1" value="1">
                                1 point <span>A</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="question1" value="0">
                                0 points <span>B</span>
                            </label>
                        </li>
                    </ul>
                </form>

                <p>Using the web browser developer tools, does the web app use semantic HTML tags appropriately?</p>
                <form>
                    <ul>
                        <li>
                            <label>
                                <input type="radio" name="question2" value="1">
                                1 point <span>A</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="question2" value="0">
                                0 points <span>B</span>
                            </label>
                        </li>
                    </ul>
                </form>

                <p>Does the web app layout correctly for both mobile and desktop devices?</p>
                <form>
                    <ul>
                        <li>
                            <label>
                                <input type="radio" name="question3" value="1">
                                1 point <span>A</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="question3" value="0">
                                0 points <span>B</span>
                            </label>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="action-button">
                <button type="button" class="btn btn-primary btn-md" id="edit-submission">Edit Submission</button>
            </div>
        </div>
    </div>
</div>








<div class="footer" id="footer">
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="../JS/reusable-header.js"></script>
<script src="../JS/submitted-article.js"></script>


</body>
</html>


