<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit Article</title>
<link href="../CSS/ex_submit.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<body>

<div class="header-container" id="header-container">
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
</nav>


<form action="ex_submit_con.php" method="post" id="form" enctype="multipart/form-data">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation" style="margin-left: -10px;">
    <button class="nav-link active" id="privacy-tab" data-bs-toggle="tab" data-bs-target="#privacy-tab-pane" type="button" role="tab" aria-controls="privacy-tab-pane" aria-selected="true">Privacy</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="article-tab" data-bs-toggle="tab" data-bs-target="#article-tab-pane" type="button" role="tab" aria-controls="article-tab-pane" aria-selected="false">Article Details</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="file-tab" data-bs-toggle="tab" data-bs-target="#file-tab-pane" type="button" role="tab" aria-controls="file-tab-pane" aria-selected="false">Upload File</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contributors-tab" data-bs-toggle="tab" data-bs-target="#contributors-tab-pane" type="button" role="tab" aria-controls="contributors-tab-pane" aria-selected="false">Contributors</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment-tab-pane" type="button" role="tab" aria-controls="comment-tab-pane" aria-selected="false">Notes</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review-tab-pane" type="button" role="tab" aria-controls="review-tab-pane" aria-selected="false">Preview</button>
  </li>
</ul>


<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="privacy-tab-pane" role="tabpanel" aria-labelledby="privacy-tab" tabindex="0">

  <p class="h5 pt-5" id="title-1">Submission Checklist</p>
  <p class="h6" id="sub-1">Indicate that this submission is ready to be considered by this journal by checking off the following (comments to the editor can be added below).</p>
 

  <div class="descript-1 pt-3">
    <div class="form-check" id="checkList-1">
    <input type="checkbox" id="check-1">
    <p class="st-1">The submission has not been previously published, nor is it before another journal for consideration (or an explanation has been provided in Comments to the Editor).</p>
    </div>
   <div class="form-check" id="checkList-2">
   <input type="checkbox" id="check-2">
   <p class="st-2">Note that your paper will be submitted to iThenticate.com (Plagiarism Detection Software) to check the similarity score.</p>
   </div>
    <div class="form-check" id="checkList-3">
    <input type="checkbox" id="check-3">
    <p class="st-3">The submission file is in Microsoft Word document file format. Please do NOT submit in pdf.</p>
    </div>
    <div class="form-check" id="checkList-4">
    <input type="checkbox" id="check-4">
    <p class="st-4">Where available, URLs for online references have been provided.</p>
    </div>
    <div class="form-check" id="checkList-5">
    <input type="checkbox" id="check-5">
    <p class="st-4">Where available, URLs for online references have been provided.</p>
    </div>
    <div class="form-check" id="check-6">
    <input type="checkbox" id="check-6">
    <p class="st-5" style="width: 90%; display: inline-block">The text is single-column; single-spaced; uses a 11-point font (except for section headings which is 12); employs italics, rather than underlining (except with URL addresses); and all illustrations, figures, and tables are placed within the text at the appropriate points, rather than at the end. The Book Antiqua font should be used for all text in the paper. Use A4 page set-up. The top and bottom margins are 1.4 inches and the right/left margins are 1.2 inches.</p>
    </div>
    <div class="form-check" id="check-7">
    <input type="checkbox" id="check-7">
    <p class="st-6">The text adheres to the stylistic and bibliographic requirements outlined in the Author Guidelines, which is found in About the Journal.</p>

    </div>
  
   



  </div>
  
  <hr id="line-1">

  <p class="h5 pt-3" id="title-2">Copyright Notice</p>
  <p class="h6 pt-3" id="sub-2">Authors who publish with this journal also agree to the following terms: </p>
  <p class="h6 pt-3" id="sub-3">Authors are able to enter into separate, additional contractual arrangements for the non-exclusive distribution of the journal's published version of the work (e.g., post it to an institutional repository or publish it in a book), with an acknowledgement of its initial publication in this journal.</p>
  <p class="h6 pt-3" id="sub-4">Authors are permitted and encouraged to post their work online (e.g., in institutional repositories or on their website) as this can lead to productive exchanges, as well as earlier and greater citation of published work.</p>

  <hr id="line-2">

  <p class="h5 pt-3" id="title-3">Journal's Privacy Statement</p>
  <p class="h6" id="sub-5">The names and email addresses entered in this journal site will be used exclusively for the stated purposes of this journal and will not be made available for any other purpose or to any other party</p>

  <div class="descript-2 pt-3">

  <div class="form-check">
  <input type="checkbox" id="check" name="check" value="1">
  <p class="st-7">The authors agree to the terms of this Copyright Notice, which will apply to this submission if and when it is published by this journal (comments to the editor can be added below).</p>


  

</div>

</div>
  

</div>

  <div class="tab-pane fade" id="article-tab-pane" role="tabpanel" aria-labelledby="article-tab" tabindex="0">
  
  <div class="article-details">
    <div class="details">
      <p class="h5 pt-5" id="title-4">Article Details</p>
      <p class="h6" id="sub-6" style="#0858a4">Please provide the following details to help us manage your submission in our system.</p>
     
    
    </div>
   

    <div class="input-details">

     
      
      <div class="form-floating" id="form-floating">
        <h6 id="sub-9">Title</h6>

    
        <input class="form-control" type="text"  id="title" name="title">
        <p id="title-validation" style="color: red; display: none;">Title should consist of 10 words and less than 20 words*</p>
        
        <h6 id="sub-11">Abstract</h6>

        <div id="editor">
      
        </div>
        <input class="form-control" type="text" id="abstract" name="abstract"  style="display: none;">
        <p id="abstract-validation" style="color: red; display: none;">Maximum of 1000 words*</p>

      </div>

      <div class="form-floating-2" id="form-floating-2">
        <!-- <h5 id="duplication-title">Checking of Details</h5> -->
        <div class="duplicated-article">
          <h6 class="checker-titles">Duplication Checker</h6>
          <h6></h6>
          <!-- <label id="label-title">Article: </label> -->
          <p id="label-title">Article:</p>
          <div id="similar-title"></div>
         
        
          <div id ="similar-abstract"></div>
        
          <!-- <label  id="label-result">Result: </label> -->
          <p id="label-result">Result:</p>
          
          <div id="result-duplication"></div>
        </div>
        <div class="journal-type-container">
          <h6 class="checker-titles">Journal Classification</h6>
          <select class="form-select" name="journal-type" id="journal-type">
         
            <option value="1" id="gavel">The Gavel</option>
            <option value="2" id="lamp">The Lamp</option>
            <option value="3" id="star">The Star</option>
          </select>
          <p class="suggestion-title">QOAJ can suggest journal based on your article</p>
        </div>
        <button type="button" class="btn btn-primary btn-sm" id="check-duplication">Check</button>
        <!-- <button type="button" class="btn btn-primary btn-sm" id="btn-okay">Okay</button> -->
      </div>

  
    
      

    </div>

    <div class="input-details-2 mt-3" id="form-floating-3">

    <h6 id="sub-10">Keywords</h6>
      <input class="form-control" type="text" id="keywords" name="keywords">
      <p id="keywords-validation" style="color: red; display: none;">Keywords should consist at least 1 and a maximum of 4 commas</p>

      
      <h6 class="sub-12 mt-5" id="sub-12">Reference</h6>

      <div id="editor2">
    
      </div>
      <input class="form-control" type="text" id="reference"  name="reference" style="display: none;">

      

    </div>
   


    
  
    
  </div>
   

  </div>

  <div class="tab-pane fade" id="file-tab-pane" role="tabpanel" aria-labelledby="file-tab" tabindex="0">

  <div class="table-input">

  <h5 class="title6 mt-5" id="title-6">Upload Files</h5>
  <h6 class="sub13 mt-3" id="sub-13">Provide any files our editorial team may need to evaluate your submission. In addition to the main work, you may wish to submit data sets, conflict of interest statements, or other supplementary files if these will be helpful for our editors.</h6>

  <!-- <button type="button" class="btn btn-primary btn-sm mt-5" onclick="openFileModal()" id="upload-btn">Upload File</button> -->

  <input type="file" class="form-control" name="file_name" id="file_name" accept=".docx" style="display: none">
  <input type="file" class="form-control" name="file_name2" id="file_name2" accept=".docx" style="display: none">
  <input type="file" class="form-control" name="file_name3" id="file_name3" accept=".docx" style="display: none">

<table class="table table-hover" id="table-file">
  <thead>
    <tr>
      <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">File Name</th>
      <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">Type</th>
      <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">Action</th>
    </tr>
  </thead>
  <tbody id="fileList">
    <tr>
      <td id="fileName1"></td>
      <td id="fileType1">File with author</td>
      <td>
        <button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px" id="addFileName" onclick="openFilename(1)">Add File</button>
        <button type="button" class="btn btn-danger btn-sm" id="deleteFileName" onclick="deleteFilename(1)">Delete</button>
      </td>
    </tr>
    <tr>
      <td id="fileName2"></td>
      <td id="fileType2">File with no author</td>
      <td>
        <button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px" id="addFileName2" onclick="openFilename(2)">Add File</button>
        <button type="button" class="btn btn-danger btn-sm" id="deleteFileName2" onclick="deleteFilename(2)">Delete</button>
      </td>
    </tr>
    <tr>
      <td id="fileName3"></td>
      <td id="fileType3">Title Page</td>
      <td>
        <button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px" id="addFileName3" onclick="openFilename(3)">Add File</button>
        <button type="button" class="btn btn-danger btn-sm" id="deleteFileName3" onclick="deleteFilename(3)">Delete</button>
      </td>
    </tr>
  </tbody>
</table>

  </div>
 

  </div>

  <div class="tab-pane fade" id="contributors-tab-pane" role="tabpanel" aria-labelledby="contributors-tab" tabindex="0">
  
  <div class="contributors-container">

  <?php
if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
  $first_name = $_SESSION['first_name'];
    
  $firstName = isset($_SESSION['first_name']) ? ucfirst($_SESSION['first_name']) : '';
  $middleName = isset($_SESSION['middle_name']) ? ' ' . ucfirst($_SESSION['middle_name']) : '';
  $lastName = isset($_SESSION['last_name']) ? ' ' . ucfirst($_SESSION['last_name']) : '';
  $contributor = $firstName . $middleName . $lastName;
  echo "<p id='contributor' style='display: none'>$contributor
  </p>";

}
?>
 
  <h5 class="title7 mt-5" id="title-7">Add Contributors</h5>
  <h6 class="sub14 mt-3" id="sub-14">Add details for all of the contributors to this submission. Contributors added here will be sent an email confirmation of the submission, as well as a copy of all editorial decisions recorded against this submission.</h6>

  <div class="cont">
    <!-- <h5 class="title8" id="title-8">Contributors</h5> -->
  <button type="button" class="btn btn-primary btn-sm"id="contributor-btn">Add Contributors</button>
  </div>
 
  <table class="table table-striped" id="table-contributor" name="table-contributor">
  <thead>
    <tr >
 
      <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">Contributors</th>
      <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    
      <td name="contributor" id="contributor"><?php echo $contributor; ?></td>
      <td></td>
    </tr>
  </tbody>
</table>

  </div>

  </div>

  <div class="tab-pane fade" id="comment-tab-pane" role="tabpanel" aria-labelledby="comment-tab" tabindex="0">
    <div class="comment-container mt-5">

    <h5 class="title8" id="title-8">Author Notes</h5>
    <h6 class="sub15" id="sub-15">Please provide the following details to help our editorial team manage your submission.</h6>
    <div id="editor3"></div>

    </div>
    <input class="form-control" type="text" id="notes" name="notes" style="display: none;">


  </div>

  <div class="tab-pane fade" id="review-tab-pane" role="tabpanel" aria-labelledby="review-tab" tabindex="0">

  <h5 class="title9" id="title-9f">Review and Submit</h5>
  <h6 class="sub16" id="sub-16f">Review the information you have entered before you complete your submission. You can change any of the details displayed here by clicking the edit button at the top of each section.</h6>
  <h6 class="sub17" id="sub-17f">
  Once you complete your submission, a member of our editorial team will be assigned to review it. Please ensure the details you have entered here are as accurate as possible.</h6>

  <div class="article-info-container">
    <div class="article-header">
      <h5 class="title10" id="title-10f">Details</h5>
      <button type="button" class="btn btn-outline-light btn-sm" id="update-cont-2">View</button>
    </div>
    <div class="editable-content mt-5" id="editable-content">
      <label id="sub-26">Title: </label><br>
      <input type="text" class="form-control" id="input5f1" readonly><br>
      <label id="sub-27">Keywords: </label><br>
      <input type="text" class="form-control" id="input6" readonly><br>
      <label id="sub-28">Abstract: </label><br>
      <input type="text" class="form-control" id="input7" readonly><br>
      <label id="sub-29">Reference: </label><br>
      <input type="text" class="form-control" id="input8" readonly><br>
    </div>

  
    <div class="file-container">
      <h5 class="title11" id="title-11">Files: </h5>
      <div class="file-header-container">
        <h5 class="title1f" id="title1f">File Name</h5>
        <button type="button" class="btn btn-outline-light btn-sm" id="update-cont-3">View</button>
    
      </div>
      <div class="file-content-container mt-3">
        <input type="text" class="form-control" id="input9" readonly>
        <input type="text" class="form-control" id="input9f" readonly>
        <input type="text" class="form-control" id="input9g" readonly>
      </div>
    </div>

    <div class="cont-container">
      <h5 class="title12" id="title-12">Contributors: </h5>
      <div class="cont-header-container">
        <h5 class="title13" id="title-13">Contributors Name</h5>
        <button type="button" class="btn btn-outline-light btn-sm" id="update-cont-4">View</button>
    
      </div>
      <div class="file-content-container mt-3">
        <input type="text" class="form-control" id="input10" readonly>
      </div>
    </div>
    
   

  </div>


  </div>
</div>
<div id="btn-action">
<button type="submit" class="btn btn-success btn-sm" id="submit">Submit</button>
<button type="button" class="btn btn-primary btn-sm" id="next">Next</button>

<button type="button" class="btn btn-secondary btn-sm" id="prev">Prev</button>

</div>


</form>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="../JS/reusable-header.js"></script>
<script src="../JS/ex_submit.js"></script>
<script src="../JS/ex_submit_duplicate_article.js"></script>
<script src="../JS/ex_submit_journal_type.js"></script>

</body>
</html>