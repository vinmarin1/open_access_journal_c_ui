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
  <form id="form" action="revision-file.php" method="POST" enctype="multipart/form-data">
    <div class="main-title">
        <div class="breadcrumbs">
            Dashboard / Author / Submitted Articles <span id="title-validation" style="color: red">The title should be between 10 and 20 words in length</span>
        </div>
        <input type="text" value="<?php echo $articleId ?>" id="getArticleId" name="getArticleId" style="display: none">
        <p id="title" name="title">
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
        <div class="abstract-title">Abstract <span id="abstract-validation" style="color: red">The abstract should be between 50 and 200 words in length</span></div>
        <div class="abstract-content">
            <p id="display-abstract" name="display-abstract">
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
                <div class="log-entry mt-4" id="logEntries">
                    <?php
                        $sqlLogs = "SELECT logs_article.type FROM logs_article JOIN article ON logs_article.article_id = article.article_id WHERE logs_article.article_id = :article_id";
                        $sqlRunLogs = database_run($sqlLogs, array('article_id' => $articleId));

                        if ($sqlRunLogs !== false){
                            $count = 0;
                            foreach ($sqlRunLogs as $logsRow){
                                if ($count < 5) {
                                    echo '<p style="display: block">' . $logsRow->type . '</p>';
                                } else {
                                    echo '<p style="display: none">' . $logsRow->type . '</p>';
                                }
                                $count++;
                            }
                        } else {
                            echo 'no logs for this article';
                        }
                    ?>
                </div>

            </div>

            <div class="dates">
                <div class="dates-title">Date</div>
                <div class="date" id="logDates">
                    <?php
                        $sqlLogsDate = "SELECT logs_article.date FROM logs_article JOIN article ON logs_article.article_id = article.article_id WHERE logs_article.article_id = :article_id";
                        $sqlDateParams = database_run($sqlLogsDate, array('article_id' => $articleId));

                        if ($sqlDateParams !== false){
                            $count = 0;
                            foreach ($sqlDateParams as $logsDate){
                                if ($count < 5) {
                                    echo '<p style="display: block">' . $logsDate->date . '</p>';
                                } else {
                                    echo '<p style="display: none">' . $logsDate->date . '</p>';
                                }
                                $count++;
                            }
                        } else {
                            echo 'no logs for this article';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="btn-group mb-3">
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="viewAllLogs()" id="viewLogsBtn">View All Logs</button>
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="hideLogs()" id="hideLogsBtn" style="display: none">Hide Logs</button>
        </div>
       

        </div>
    </div>
</div> 

<div class="row2">
    <div class="main2">
        <div class="files-submitted">
            <div class="table-header" id="table">Files Submitted</div>
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
        <div class="files-submitted" id="reviseFile" style="display: none">
        <div class="table-header">Upload Revise file</div>
            <div class="btnUploadFile">
                <input type="file" class="form-control" name="file_name" id="file_name" accept=".docx" style="display: none">
            </div>
            <table class="table table-hover" id="table-file">
                <thead>
                    <tr>
                    <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">File Name</th>
                    <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">File Type</th>
                    <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">Action</th>
                    </tr>
                </thead>
                <tbody id="fileList">
                    <tr>
                    <td id="fileName1"></td>
                    <td id="fileType1">File with no author</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px" id="addFileName" onclick="openFilename(1)">Add File</button>
                        <button type="button" class="btn btn-danger btn-sm" id="deleteFileName" onclick="deleteFilename(1)">Delete</button>
                    </td>
                    </tr>
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
    <div class="main3" style="wdith: 100%; padding-left: 100px">
        <div class="comments-container">
            <div class="table-header">Discussion</div>
            <div class="discussion-container">
                <?php
                    $userId = $_SESSION['id'];    

                    $sqlDiscussion = "SELECT * FROM discussion WHERE article_id = $articleId";
                    $resultDiscussion = database_run($sqlDiscussion);

                    if ($resultDiscussion !== false) {
                        foreach ($resultDiscussion as $rowDiscussion) {
                            // Output discussion button with a unique ID
                            echo '<button type="button" class="btn btn-secondary btn-sm" style="width: 100%; margin-top: 5px;" onclick="toggleDiscussion(' . $rowDiscussion->discussion_id . ')">' . $rowDiscussion->discussion_type . '</button>';

                            // Output discussion messages container with a unique ID and initially hide it
                            echo '<div id="discussion' . $rowDiscussion->discussion_id . '" style="display:none; width: 100%; height: auto; border: none; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; backround-color: #0066cc;">';

                            // Fetch discussion messages and sender names for the selected discussion
                            $discussionId = $rowDiscussion->discussion_id;
                            $sqlMessages = "SELECT discussion_message.userId, discussion_message.message, discussion_message.fromuser FROM discussion_message
                                            WHERE discussion_message.discussion_id = $discussionId";

                            $resultMessages = database_run($sqlMessages);

                            if ($resultMessages !== false) {
                                foreach ($resultMessages as $rowMessage) {
                                    echo '<div>';
                                    
                                    // Check if the message is from the current user
                                    if ($rowMessage->userId == $userId) {
                                        // Apply different style for the current user's message (right side)
                                        echo '<p style="font-weight: lighter; display: block; margin-left: 5px; background-color: #ECF0F1; color: black; width: 50%; margin-left: auto; border-radius: 30px 30px 0 0; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">' . $rowMessage->message . '</p>';
                                    } else {
                                        // Apply style for other users' messages (left side)
                                        echo '<p style="font-weight: lighter; display: block; margin-top:5px; margin-left: 5px">' . $rowMessage->fromuser .'</p>';
                                        echo '<p style="font-weight: lighter; display: block; margin-top:5px; margin-left: 5px">'. 'Subject: ' . $rowDiscussion->subject . '</p>';
                                        echo '<p style="font-weight: lighter; display: block; margin-left: 5px; background-color: #ECF0F1; color: black; width: 50%; border-radius: 30px 30px 0 0; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">' . $rowMessage->message . '</p>';
                                    }

                                    echo '</div>';
                                }
                            } else {
                                echo '<p class="dmessageNtFound">Discussion messages not found</p>';
                            }

                            echo '<style>
                                        
                                #reply-message::-webkit-scrollbar {
                                    display: none;
                                }
                            </style>';

                            echo '<div style="position: relative; margin-top: 10px; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">';

                            // Textarea with a specific max-width, height, and disabled resize
                            // Inside your loop
                            echo '<textarea class="form-control" name="reply-message" id="reply-message-' . $discussionId . '" cols="10" rows="4" style="resize: none; max-width: 100%; height: 10vh; overflow-y: auto; padding-right: 80px;"></textarea>';

                            // Reply button inside the textarea, positioned at the lower-right bottom
                            echo '<button type="button" onclick="sendReply(' . $discussionId . ', ' . $articleId . ')" style="position: absolute; bottom: 15px; right: 15px; padding: 5px; background-color: #0066cc; color: #fff; border: none; border-radius: 3px; cursor: pointer;">Reply</button>';
                            echo '</hr>';
                            echo '</div>';
                            
                            echo '</div>';
                            
                        }
                    } else {
                        echo '<p class="dmessageNtFound">No discussion for this article yet</p>';
                    }
                ?>




<!-- <script>
    // JavaScript function to toggle the visibility of discussion messages
    function toggleDiscussion(discussionId) {
        var discussionContainer = document.getElementById('discussion' + discussionId);
        if (discussionContainer.style.display === 'none') {
            discussionContainer.style.display = 'block';
        } else {
            discussionContainer.style.display = 'none';
        }
    }
</script> -->


            </div>
        </div>
       
    </div>
    <div id="loadingOverlay">
        <div id="loadingSpinner"></div>
    </div>
    </form>
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


