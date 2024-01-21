<?php
session_start();
$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | FAQs</title>
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
            <p>Home / Guidelines / FAQs</p>
            <h1>Frequently Asked Questions (FAQs)</h1>
        </div>
    </div>

    <main class="d-flex flex-column-reverse flex-md-row gap-2">
        <aside class="">
            <div class="menu" id="for-contributors-menu">
                <h3>For Contributors</h3>
                <ul id="for-contributors">
                    <li>Author Guideline</li>
                    <li>Article Submission</li>
                    <li>Peer-review Process</li>
                    <li>Become A Reviewer</li>
                    <li>Formatting Guidelines</li>
                    <li>Tutorial on Publication</li>
                    <li>Tutorial on Publication</li>
                </ul>
            </div>           
        </aside>
        <div class="main " id="faqs-container"> 
            <div class="header">
                <h2>Frequently Asked Questions</h2>
                <form action="" class="border" id="search-input">
                    <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="content">
                <div class="category w-100">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 15 15"><path fill="#e56f1f" fill-rule="evenodd" d="M.877 7.5a6.623 6.623 0 1 1 13.246 0a6.623 6.623 0 0 1-13.246 0M7.5 1.827a5.673 5.673 0 1 0 0 11.346a5.673 5.673 0 0 0 0-11.346m.75 8.673a.75.75 0 1 1-1.5 0a.75.75 0 0 1 1.5 0m-2.2-4.25c0-.678.585-1.325 1.45-1.325s1.45.647 1.45 1.325c0 .491-.27.742-.736 1.025c-.051.032-.111.066-.176.104a5.28 5.28 0 0 0-.564.36c-.242.188-.524.493-.524.961a.55.55 0 0 0 1.1.004a.443.443 0 0 1 .1-.098c.102-.079.215-.144.366-.232c.078-.045.167-.097.27-.159c.534-.325 1.264-.861 1.264-1.965c0-1.322-1.115-2.425-2.55-2.425c-1.435 0-2.55 1.103-2.55 2.425a.55.55 0 0 0 1.1 0" clip-rule="evenodd"/></svg>
                        General Questions
                    </h3>
                    <div id="generalQAs" class="faqs accordion accordion-flush w-100 d-flex flex-column gap-0" id="faqs">
                    </div>
                </div>
                <div class="category w-100">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 15 15"><path fill="#e56f1f" fill-rule="evenodd" d="M.877 7.5a6.623 6.623 0 1 1 13.246 0a6.623 6.623 0 0 1-13.246 0M7.5 1.827a5.673 5.673 0 1 0 0 11.346a5.673 5.673 0 0 0 0-11.346m.75 8.673a.75.75 0 1 1-1.5 0a.75.75 0 0 1 1.5 0m-2.2-4.25c0-.678.585-1.325 1.45-1.325s1.45.647 1.45 1.325c0 .491-.27.742-.736 1.025c-.051.032-.111.066-.176.104a5.28 5.28 0 0 0-.564.36c-.242.188-.524.493-.524.961a.55.55 0 0 0 1.1.004a.443.443 0 0 1 .1-.098c.102-.079.215-.144.366-.232c.078-.045.167-.097.27-.159c.534-.325 1.264-.861 1.264-1.965c0-1.322-1.115-2.425-2.55-2.425c-1.435 0-2.55 1.103-2.55 2.425a.55.55 0 0 0 1.1 0" clip-rule="evenodd"/></svg>
                        Submitting to QCUJ
                    </h3>
                    <div id="submissionQAs" class="faqs accordion accordion-flush w-100 d-flex flex-column gap-0" id="faqs">
                    
                    </div>
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