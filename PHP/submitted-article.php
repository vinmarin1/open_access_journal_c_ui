<?php
require 'dbcon.php';
session_start();
if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] !== true) {
	header('Location: ./login.php');
	exit();
  }

$userId = $_SESSION['id'];
$articleId = isset($_GET['id']) ? $_GET['id'] : null;
?>


<!DOCTYPE html>
<html>
<?php include('./meta.php'); ?>
<title>QCU PUBLICATION | Submitted Article</title>
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
            Dashboard / Author / Submitted Articles <span id="title-validation" style="color: red">The minimum word for title is 5 and maximum of 100 words</span>
        </div>
        <input type="text" value="<?php echo $articleId ?>" id="getArticleId" name="getArticleId" style="display: none">
        <p id="title" name="title">
            <?php 
            $sqlReviewraticle = "SELECT title FROM article WHERE article_id =:article_id AND author_id =:author_id";

            $result = database_run($sqlReviewraticle, array('author_id' => $userId, 'article_id' => $articleId));

            if ($result !== false) {
                foreach ($result as $row) {
                    echo $row->title;
                }
            } else {
                echo "No articles found."; 
            }
            ?>
        </p>
        <input type="text" id="titleInput" name="titleInput" style="display: none">
     
       

    </div>
</div>
<div class="row1">
    <div class="abstract">
    <!-- Abstract content goes here -->
        <div class="abstract-title">Abstract <span id="abstract-validation" style="color: red">The minimum word for abstract is 10 and maximum of 300 words</span></div>
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
            <input type="text" id="abstract" name="abstract" style="display: none">
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
        <div class="retrtiveFileDownload">

        </div>
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
                        $sqlStatus = "SELECT article_files.file_name FROM article_files JOIN article ON article_files.article_id = article.article_id WHERE article.author_id = :author_id AND article.article_id = :article_id AND article_files.file_type = 'File with no author name' ";

                        $result = database_run($sqlStatus, array('author_id' => $userId, 'article_id' => $articleId));

                        if ($result !== false) {
                            foreach ($result as $row) {
                                $fileName = $row->file_name;
                                $filePath = '../Files/submitted-article/' . $fileName;

                                echo "<a href='download.php?file=$filePath' download>$fileName</a><br>";
                            }
                        } else {
                            echo "No file for this article";
                        }
                        ?>

                        </td>
                        <td>
                            <?php

                                $sqlStatus = "SELECT article_files.date_added FROM article_files JOIN article ON article_files.article_id = article.article_id WHERE article.author_id = :author_id AND article.article_id = :article_id AND article_files.file_type = 'File with no author name' ";

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
        <!-- <button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px" id="downloadFileName" onclick="downloadFile(1)">Download</button> -->
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
                    <td id="fileType1">
                    <select class="form-control" name="selectRevisionFileType" id="selectRevisionFileType">
                            <option value="" disabled selected>Select a File Type</option>
                            <option value="File with author name">File with author name</option>
                            <option value="File with no author name">File with no author name</option>
                            <option value="Title Page">Title Page</option>
                    </select>
                    </td>
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
    <div class="main3" >
        <div class="comments-container" style="padding-left: 50px">
            <div class="table-header">Reviewer Comments</div>
            <div class="discussion-container">
                <?php
                    $sqlReviewComments = "SELECT reviewer_assigned.comment, reviewer_assigned.decision 
                                        FROM reviewer_assigned 
                                        JOIN article ON reviewer_assigned.article_id = article.article_id 
                                        WHERE reviewer_assigned.answer = 1 
                                            AND reviewer_assigned.accept = 1 
                                            AND reviewer_assigned.comment_accessible = 1 
                                            AND reviewer_assigned.article_id = $articleId";

                    $sqlRun = database_run($sqlReviewComments);

                    if ($sqlRun) {
                        $result = $sqlRun;

                        if (!empty($result)) {
                            $reviewerComments = array();
                            $reviewerAlias = 'Reviewer A';

                            foreach ($result as $row) {
                                $comment = $row->comment;
                                $decision = $row->decision;

                                // Append comment and decision to the reviewer's array
                                $reviewerComments[$reviewerAlias]['comment'] = $comment;
                                $reviewerComments[$reviewerAlias]['decision'] = $decision;

                                // Increment reviewer alias for the next comment
                                $reviewerAlias = getNextReviewerAlias($reviewerAlias);
                            }

                            // Display the comments with reviewer aliases
                            foreach ($reviewerComments as $reviewerAlias => $reviewerData) {
                                echo '<p>' . $reviewerAlias . ' comment: ' . $reviewerData['comment'] . '</p>';
                                echo '<p class="style="margin-top: 0px">' . $reviewerAlias . ' decision: ' . $reviewerData['decision'] . '</p>';
                            }
                        }
                    }

                    function getNextReviewerAlias($currentAlias)
                    {
                        return ++$currentAlias;
                    }
                ?>





            </div>
        </div>
        <div class="review-rubrics">
          
            <div class="action-button" style="padding-left: 40px">
                <?php

                    $sqlSelectedArticle = "SELECT article_id FROM article WHERE article_id = :article_id AND status = 4";

                    $sqlRun = database_run($sqlSelectedArticle, array('article_id' => $articleId));

                    if($sqlRun){
                       echo '  <button type="button" class="btn btn-primary btn-md" id="edit-submission">Edit Submission</button>';
                    }else{
                        echo '';
                    }
                ?>
                <!-- <button type="button" class="btn btn-primary btn-md" id="edit-submission">Edit Submission</button> -->
                <button type="button" class="btn btn-primary btn-md" id="submit-submission">Submit Revision</button>
                <!-- <button type="button" class="btn btn-success btn-md" id="submitRevision">Submit Revision</button> -->
                <button type="button" class="btn btn-secondary btn-md" id="cancel-submission">Cancel Submission</button>
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


