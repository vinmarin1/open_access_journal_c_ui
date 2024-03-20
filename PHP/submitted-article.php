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
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Judson:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

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
                    $sqlReviewraticle = "SELECT abstract FROM article WHERE article_id = :article_id AND author_id = :author_id";

                    $result = database_run($sqlReviewraticle, array(
                        'author_id' => $userId,
                        'article_id' => $articleId
                    ));

                    if ($result !== false) {
                        foreach ($result as $row) {
                            // Split the abstract into sentences
                            $sentences = preg_split('/(?<=[.?!])\s+/', $row->abstract, -1, PREG_SPLIT_NO_EMPTY);
                            
                            // Output each sentence with the first letter wrapped in a span for styling
                            foreach ($sentences as $sentence) {
                                echo '<span class="first-letter">' . substr($sentence, 0, 1) . '</span>' . substr($sentence, 1) . ' ';
                            }
                        }
                    } else {
                        echo "No articles found."; 
                    }
                ?>
            </p>
            <p class="keywords-title">Keywords</p>
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
                                                color: var(--main, #0858A4);
                                                border: 2px solid var(--main, #0858A4);
                                                border-radius: 10px;
                                                background-color: white;
                                                font-size: 15px;
                                                display: inline-block">' . trim($keyword) . '</li>';
                            }
                            
                        }
                    } else {
                        echo "No keywords for this article";
                    }
                ?>
             </div>
           



            <input type="text" id="abstract" name="abstract" style="display: none">
        </div>
    </div>
    <div class="column1">

        <!-- <div class="status">
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
        </div> -->
        <div class="comments-container">
            <div class="table-header">Reviewer Comments</div>
            <hr style="height: 2px solid;">
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

                            
                                $reviewerComments[$reviewerAlias]['comment'] = $comment;
                                $reviewerComments[$reviewerAlias]['decision'] = $decision;

                            
                                $reviewerAlias = getNextReviewerAlias($reviewerAlias);
                            }

                           
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
            <div class="logs-container">
               <!-- Button trigger modal -->
               <button type="button" class="btn btn-primary" id="log-btn" data-bs-toggle="modal" data-bs-target="#modal-dialog-centered">
                    View Logs
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modal-dialog-centered" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom: none">
                                <p class="logs-title">Recent Logs</p>
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                            </div>
                            <hr style="margin-top: -20px; width: 90%; border: 1px solid black; margin-left: auto; margin-right: auto">
                          
                            <div style="width: 90%; margin-left: auto; margin-right: auto; overflow-x: auto; height: 300px;">
                                <table class="table table-borderless">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Logs</th>
                                            <th></th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sqlDisplayLogs = "SELECT logs_article.article_id, logs_article.type, DATE(logs_article.date) as date FROM logs_article JOIN article ON logs_article.article_id = article.article_id WHERE logs_article.user_id = :userId AND logs_article.article_id = :article_id";

                                            $params = array(
                                                'userId' => $userId,
                                                'article_id' => $articleId
                                            );

                                            $sqlRun = database_run($sqlDisplayLogs, $params);

                                            if ($sqlRun !== false) {
                                                foreach ($sqlRun as $row) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row->type . '</td>';
                                                    echo '<td></td>';
                                                    echo '<td>' . $row->date . '</td>';
                                                    echo '</tr>';
                                                }
                                            } else {
                                                echo '<tr><td colspan="2">Something went wrong</td></tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>


                        
                            <div class="modal-footer" style="border-top: none;">
                                <button type="button" id="back-btn" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                            </div>
                        </div>
                    </div>
                </div>

             </div>
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
                        <th style="background-color: #F5F5F9; color: black">File</th>
                        <th style="background-color: #F5F5F9; color: black">Date</th>
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
                    <th scope="col" style="background-color: #F5F5F9; color: black">File Name</th>
                    <th scope="col" style="background-color: #F5F5F9; color: black">File Type</th>
                    <th scope="col" style="background-color: #F5F5F9; color: black">Action</th>
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
        
                <!-- <div class="keywords">
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
                                                    color: var(--main, #0858A4);
                                                    border: 1px solid var(--main, #0858A4);
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
                </div> -->
            </div>
        </div>
    <div class="main3">
        <table class="table table-light" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col" style="background-color: #F5F5F9; color: black">Status</th>
                    <th scope="col" style="background-color: #F5F5F9; color: black"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php

                        $sqlStatus = "SELECT article_status.status FROM article_status JOIN article ON article_status.status_id = article.status WHERE article.author_id = :author_id AND article.article_id = :article_id";

                        $result = database_run($sqlStatus, array('author_id' => $userId,
                        'article_id' => $articleId));

                        if ($result !== false) {
                        foreach ($result as $row) {
                            echo '<td>' . $row->status . '<td>';
                            // echo $row->status;
                        }
                        } else {
                        echo "No status for this article"; 
                        }
                    ?>
                </tr>
            </tbody>
        </table>



    </div>
    </div>

    <div class="main4">
        <div class="action-button">
            <div class="edit-btn-container">
                <?php

                    $sqlSelectedArticle = "SELECT article_id FROM article WHERE article_id = :article_id AND status = 4";

                    $sqlRun = database_run($sqlSelectedArticle, array('article_id' => $articleId));

                    if($sqlRun){
                        echo '  <button type="button" class="btn btn-primary btn-md" id="edit-submission">Edit Submission</button>';
                    }else{
                        echo '';
                    }
                ?>
            </div>
            <div class="btn-option">
                <button type="button" class="btn btn-secondary btn-md" id="cancel-submission">Cancel Submission</button>
                <button type="button" class="btn btn-primary btn-md" id="submit-submission">Submit Revision</button>
                    
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


