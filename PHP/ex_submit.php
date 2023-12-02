<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TIMELINE</title>
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


<form action="" id="form">
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
    <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review-tab-pane" type="button" role="tab" aria-controls="review-tab-pane" aria-selected="false">Review</button>
  </li>
</ul>


<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="privacy-tab-pane" role="tabpanel" aria-labelledby="privacy-tab" tabindex="0">

  <p class="h5 pt-5" id="title-1">Submission Checklist</p>
  <p class="h6" id="sub-1">Indicate that this submission is ready to be considered by this journal by checking off the following (comments to the editor can be added below).</p>
 

  <div class="descript-1 pt-3">
    <p class="st-1">The submission has not been previously published, nor is it before another journal for consideration (or an explanation has been provided in Comments to the Editor).</p>
    <p class="st-2">Note that your paper will be submitted to iThenticate.com (Plagiarism Detection Software) to check the similarity score.</p>
    <p class="st-3">The submission file is in Microsoft Word document file format. Please do NOT submit in pdf.</p>
    <p class="st-4">Where available, URLs for online references have been provided.</p>
    <p class="st-5">The text is single-column; single-spaced; uses a 11-point font (except for section headings which is 12); employs italics, rather than underlining (except with URL addresses); and all illustrations, figures, and tables are placed within the text at the appropriate points, rather than at the end. The Book Antiqua font should be used for all text in the paper. Use A4 page set-up. The top and bottom margins are 1.4 inches and the right/left margins are 1.2 inches.</p>
    <p class="st-6">The text adheres to the stylistic and bibliographic requirements outlined in the Author Guidelines, which is found in About the Journal.</p>


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
  <input type="checkbox" id="check">
  <p class="st-7">The authors agree to the terms of this Copyright Notice, which will apply to this submission if and when it is published by this journal (comments to the editor can be added below).</p>


  

</div>

</div>
  

</div>

  <div class="tab-pane fade" id="article-tab-pane" role="tabpanel" aria-labelledby="article-tab" tabindex="0">
  
  <div class="article-details">
    <div class="details">
      <p class="h5 pt-5" id="title-4">Submission Details</p>
      <p class="h6" id="sub-6">Thank you for submitting to the QCU Journal. You will be asked to upload files, identify co-authors, and provide information such as the title and abstract.</p>
      <p class="h6" id="sub-7">Please provide the following details to help us manage your submission in our system.</p>
      <p class="h6" id="sub-8">Once you begin, you can save your submission and come back to it later. You will be able to review and correct any information before you submit</p>
    
    </div>
    <div id="vl"></div>

    <div class="input-details">

     
      
      <div class="form-floating">
        <h6 id="sub-9">Title</h6>

        <textarea class="form-control"  id="title" style="height: 50px"></textarea>
        
        <h6 id="sub-10">Keywords</h6>
        <textarea class="form-control"  id="keywords" style="height: 50px"></textarea>
     
      </div>

  
    
      

    </div>

    <div class="input-details-2 mt-5">
      <h6 id="sub-11">Abstract</h6>
      <div id="editor">
     
      </div>
      <h6 class="sub-12 mt-5" id="sub-12">Reference</h6>
      <div id="editor2">
     
      </div>
    </div>
   


    
  
    
  </div>
   

  </div>

  <div class="tab-pane fade" id="file-tab-pane" role="tabpanel" aria-labelledby="file-tab" tabindex="0">

  <div class="table-input">

  <h5 class="title6 mt-5" id="title-6">Upload Files</h5>
  <h6 class="sub13 mt-3" id="sub-13">Provide any files our editorial team may need to evaluate your submission. In addition to the main work, you may wish to submit data sets, conflict of interest statements, or other supplementary files if these will be helpful for our editors.</h6>

  <button type="button" class="btn btn-primary btn-sm mt-5" id="btn-upload">Upload File</button>
 
<table class="table table-hover" id="table-file">
  <thead>
    <tr >
 
      <th scope="col" style="background-color: #115272; color: white; font-weight: normal;">File Name</th>
      <th scope="col" style="background-color: #115272; color: white; font-weight: normal;">Type</th>
      <th scope="col" style="background-color: #115272; color: white; font-weight: normal;">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    
      <td>Some file name</td>
      <td>PDF FILE</td>
      <td><button class="btn btn-danger btn-sm">Delete</button></td>
    </tr>
  </tbody>
</table>

  </div>
 

  </div>

  <div class="tab-pane fade" id="contributors-tab-pane" role="tabpanel" aria-labelledby="contributors-tab" tabindex="0">
  
  <div class="contributors-container">

 
  <h5 class="title7 mt-5" id="title-7">Add Contributors</h5>
  <h6 class="sub14 mt-3" id="sub-14">Add details for all of the contributors to this submission. Contributors added here will be sent an email confirmation of the submission, as well as a copy of all editorial decisions recorded against this submission.</h6>

  <div class="cont">
    <h5 class="title8" id="title-8">Contributors</h5>
  <button type="button" class="btn btn-primary btn-sm" id="btn-contributor">Add Contributors</button>
  </div>
 
  <table class="table table-hover" id="table-file">
  <thead>
    <tr >
 
      <th scope="col" style="background-color: #115272; color: white; font-weight: normal;"></th>
      <th scope="col" style="background-color: #115272; color: white; font-weight: normal; margin-left: 80px">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    
      <td>Some contributors name</td>
      <td><button class="btn btn-outline-primary btn-sm" id="btn-update">Update</button><button class="btn btn-danger btn-sm" id="btn-delete">Delete</button></td>
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


  </div>

  <div class="tab-pane fade" id="review-tab-pane" role="tabpanel" aria-labelledby="review-tab" tabindex="0">
  <p>Some preview...</p>
  </div>
</div>
</form>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="../JS/reusable-header.js"></script>
<script src="../JS/ex_submit.js"></script>
</body>
</html>
