<?php
include 'function/redirect.php';
include 'function/journal_function.php';

$journallist = get_journal_list();
?>

<!DOCTYPE html>
<html lang="en">
<style>
    .custom-body {
        height: 50%;
        overflow: auto; /* Enable vertical scrolling */
        max-height: 400px; /* Adjust the maximum height as needed */
        margin: 0 auto; /* Center the card horizontally */
    }
</style>
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Submission /</span> New Submission</h4>

            <div class="row">
                <div class="col-xl-12">
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <button
                                type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true"> Details</button>
                            </li>
                            <li class="nav-item">
                                <button
                                type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false"> Upload Files</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false"> Contributors</button>
                            </li>
                        </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12" id="dynamic-column">
                                    <h5 class="card-header">Article Details</h5>
                                    <p> Please provide the following details to help us manage your submission in our system. </p>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="defaultFormControlInput1" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" placeholder="Title" aria-describedby="defaultFormControlHelp" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="defaultFormControlInput2" class="form-label">Keywords</label>
                                            <input type="text" class="form-control" id="keyword" placeholder="Keywords" aria-describedby="defaultFormControlHelp" />
                                        </div>   
                                        <div class="mb-3">
                                            <label for="defaultFormControlInput3" class="form-label">Abstract</label>
                                            <div id="quill-abstract" style="height: 250px;"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="defaultFormControlInput3" class="form-label">Reference</label>
                                            <div id="quill-reference" style="height: 250px;"></div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4" style="margin-bottom: -28px;">
                                            <button type="submit" class="btn btn-primary" id="checkduplicate">Check</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" id="hidden-column" style="display: none; margin-top: 7%;">
                                    <div class="card mb-4">
                                        <h5 class="card-header">Duplication Checker</h5>
                                        <div class="card-body custom-body">
                                            <div class="mb-3">
                                                <label for="defaultFormControlInput2" class="form-label">Article</label>
                                                <div id="similar-title"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="defaultFormControlInput2" class="form-label">Results</label>
                                                <div id="similar-score"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-4">
                                        <h5 class="card-header">Journal Classification</h5>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="journalSelect" class="form-label">Select Journal</label>
                                                <select id="journalSelect" class="form-select">
                                                    <option value="">Select Journal</option>
                                                    <?php foreach ($journallist as $journallistval) : ?>
                                                        <option value="<?php echo $journallistval->journal_id; ?>"><?php echo $journallistval->journal; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary" id="nextButton" style="display: none;">Next</button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                            <p>
                            Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                            cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                            cheesecake fruitcake.
                            </p>
                            <p class="mb-0">
                            Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                            cotton candy liquorice caramels.
                            </p>
                        </div>

                        <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                            <p>
                            Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
                            cupcake gummi bears cake chocolate.
                            </p>
                            <p class="mb-0">
                            Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
                            roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
                            jelly-o tart brownie jelly.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Include footer -->
        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Include the DataTables CSS and JS files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $('#checkduplicate').on('click', function () {
            $('#dynamic-column').toggleClass('col-md-12 col-md-8');
            
            $('#hidden-column').toggle();

            $(this).hide();

            $('#nextButton').show();
        });

        var quill = new Quill('#quill-abstract', {
            theme: 'snow'
        });

        var quillTwo = new Quill('#quill-reference', {
            theme: 'snow'
        });

        document.getElementById('checkduplicate').addEventListener('click', function() {
            const title = document.getElementById('title').value;
            const abstract = quill.root.innerHTML;

            fetch('https://web-production-cecc.up.railway.app/check/duplication', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    title: title,
                    abstract: abstract,
                }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data);

                if (data.similar_articles && data.similar_articles.length > 0) {
                    document.getElementById('similar-title').innerHTML = data.similar_articles[0].title;
                    document.getElementById('similar-score').innerHTML = data.similar_articles[0] && data.similar_articles[0].score
                    ? `Score: ${data.similar_articles[0].score.title * 100}%`
                    : 'Score not available';
                    // document.getElementById('similar-abstract').innerHTML = data.similar_articles[0].abstract;
                } else {
                    console.log('No similar articles found.');
                }
            })
            .catch(error => console.error('Error:', error));
        });

        document.getElementById('checkduplicate').addEventListener('click', async function (event) {
        const abstract = quill.root.innerHTML;

        const response = await fetch('https://web-production-cecc.up.railway.app/api/check/journal', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                abstract: abstract,
            }),
        });

        const data = await response.json();
        const journalType = data.journal_classification;

        // Ensure the value exists in the dropdown before setting it
        const dropdown = document.getElementById('journalSelect');
        const optionExists = Array.from(dropdown.options).some(option => option.value === journalType);

        if (optionExists) {
            dropdown.value = journalType;
        } else {
            console.warn(`Journal type ${journalType} does not exist in the dropdown.`);
        }
    });

    </script>
    
</body>
</html>
