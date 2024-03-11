<?php
include 'function/redirect.php';
include 'function/questionnaire_function.php';

$answer_list= get_answer_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Questionnaire</h4>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h5 class="card-header mb-0">Add Question</h5>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table" id="DataTable1">
                    <thead>
                        <tr>
                            <th>Question Type</th>
                            <th>Question</th>
                            <th id="answerSectionTd">Choices</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <form id="addModalForm1">
                    <tbody>
                        <tr>
                            <td width="15%">
                                <div>
                                    <select id="question_type" name="question_type" class="form-select" onchange="showHideAnswerInput()">
                                        <option value="1">Short Answer</option>
                                        <option value="2">Selection</option>
                                    </select>
                                </div>
                            </td>
                            <td width="40%" id="questionTd">
                                <input type="text" id="question" name="question" class="form-control" placeholder="Question" required/>
                            </td>
                            <td width="40%" id="answerSectionTd1">
                                <input type="text" id="answer" name="answer" class="form-control" style="width: 100%;" placeholder="Choices Separated by a comma." />
                            </td>
                            <td width="5%">
                                <button type="button" class="btn btn-primary" onclick="addQuestion()">Add</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div></br>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h5 class="card-header mb-0">Question List</h5>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Question ID</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($answer_list as $answer_listval): ?>
                            <tr>
                                <td width="5%"><?php echo $answer_listval->reviewer_questionnaire_id; ?></td>
                                <td width="40%"><?php echo $answer_listval->question; ?></td>
                                <td width="35%">
                                <?php
                                    $answers = !empty($answer_listval->answer) ? explode(',', $answer_listval->answer) : [];
                                    ?>
                                    <?php if (!empty($answers)) { ?>
                                        <select name="answersDropdown" class="form-select">
                                            <?php foreach ($answers as $answer) { ?>
                                                <option value="<?php echo $answer; ?>"><?php echo $answer; ?></option>
                                            <?php } ?>
                                        </select>
                                <?php } ?>
                                </td>
                                <td width="10%">
                                    <button type="button" class="btn btn-success" onclick="updateModal(<?php echo $answer_listval->reviewer_questionnaire_id; ?>)"><i class="bx bx-edit-alt"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="archiveJournal(<?php echo $answer_listval->reviewer_questionnaire_id; ?>, '<?php echo $answer_listval->question; ?>')"><i class="bx bx-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>    
                </table>
            </div>
        </div>

        <!-- Include footer -->
        <?php include 'template/footer.php'; ?>
    </div>
    
<!-- Include the DataTables CSS and JS files -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- DataTables initialization script with status filter -->
<script>
    function showHideAnswerInput() {
        var question_typeDropdown = document.getElementById("question_type");
        var answerSectionTd = document.getElementById("answerSectionTd");
        var answerSectionTd1 = document.getElementById("answerSectionTd1");

        if (question_typeDropdown.value == "2") {
            answerSectionTd.style.display = "table-cell";
            answerSectionTd1.style.display = "table-cell";
        } else {
            answerSectionTd.style.display = "none";
            answerSectionTd1.style.display = "none";
        }
    }
    document.addEventListener("DOMContentLoaded", function () {
        showHideAnswerInput();
    });

    $(document).ready(function() {
        var dataTable = $('#DataTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "info": true 
        });
    });

    function addQuestion() {
        var form = document.getElementById('addModalForm1');

        var questionType = $('#question_type').val();
        var question = $('#question').val();
        var answer = $('#answer').val();

        if (!question || question.trim() === '') {
            alert("Question is required!");
            return; 
        }

        var formData = new FormData(form);
        formData.set('question_type', questionType);
        formData.set('question', question);
        formData.set('answer', answer);
        formData.set('action', 'add');

        $('#sloading').toggle();

        $.ajax({
            url: "../php/function/questionnaire_function.php",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                var response = JSON.parse(data);
                if (response.status) {
                    $('#sloading').toggle();
                    alert("Question added successfully");
                } else {
                    alert("Failed to add question. Please check all fields!");
                }
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error("Ajax request failed:", error);
            }
        });
    }

    function updateModal(questionId) {
        $.ajax({
            type: 'POST',
            url: '../php/function/questionnaire_function.php',
            data: { action: 'fetch', reviewer_questionnaire_id: questionId },
            dataType: 'json',
            success: function (response) {
                console.log('Response from server:', response);

                if (response.status === true && response.data.length > 0) {
                    const questionData = response.data[0];
                    console.log('Question Data:', questionData);

                    $('#xquestionid').val(questionData.reviewer_questionnaire_id);
                    $('#xquestion_type').val(questionData.question_type);
                    $('#xquestion').val(questionData.question);
                    $('#xanswer').val(questionData.answer);

                    if (questionData.question_type === '1') {
                        $('#answerSection').hide();
                    } else {
                        $('#answerSection').show();
                    }

                    $('#updateModal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error:', textStatus, errorThrown);
                console.log('Error fetching user data');
            }
        });
    }

    function saveChanges() {
        $('#sloading').toggle();
        console.log('Save button clicked');
        
        var questionId = $('#xquestionid').val();
        var updatedData = {
            question: $('#xquestion').val(),
            answer: $('#xanswer').val(),
        };
        console.log(questionId);
        console.log(updatedData);
        $.ajax({
            type: 'POST',
            url: '../php/function/questionnaire_function.php',
            data: {
                action: 'update',
                reviewer_questionnaire_id: questionId,
                updated_data: updatedData
            },
            dataType: 'json',
            success: function (response) {
                console.log('Update Response:', response);

                if (response.status === true) {
                    $('#sloading').toggle();
                    alert("Record updated successfully");
                    $('#updateModal').modal('hide');
                    location.reload();
                } else {
                    console.error('Error updating journal data:', response.message);
                    alert("Failed to update record. Please try again.");
                }
            },
        });
    }

    function archiveJournal(questionId, question) {
        $('#archiveModal').modal('show');
        $('#questionInfo').html('<strong>Question ID:</strong> ' + questionId + ' <br><strong>Question:</strong> ' + question);

        $('#archiveModalSave').off().on('click', function () {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/questionnaire_function.php",
                method: "POST",
                data: { action: "archive", reviewer_questionnaire_id: questionId },
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status) {
                        $('#sloading').toggle();
                        $('#archiveModalMessage').text('Question archived successfully');
                    } else {
                        $('#archiveModalMessage').text('Failed to archive 1uestion');
                    }
                        $('#archiveModal').modal('hide');
                        location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    $('#archiveModalMessage').text('Failed to archive 1uestion');
                    $('#archiveModal').modal('hide');
                    location.reload();
                }
            });
        });
    }
</script>
<style>
    #xquestion_type {
    background-color: #f0f0f0; 
    color: #888;
    cursor: not-allowed; 
}
</style>

     <!-- Update Modal -->
     <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Update Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <input type="hidden" id="xquestionid" class="form-control" placeholder="Journal" />
                            <label for="xquestion" class="form-label">Question Type</label>
                            <select id="xquestion_type" name="xquestion_type" class="form-select" disabled>
                                <option value="1">Short Answer</option>
                                <option value="2">Selection</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xquestion" class="form-label">Question</label>
                            <input type="text" id="xquestion" class="form-control" placeholder="Journal" />
                        </div>
                    </div>
                    <div class="row mb-2" id="answerSection">
                        <div class="col-md-12 mb-2">
                            <label for="xanswer" class="form-label">Answer</label>
                            <input type="text" id="xanswer" class="form-control" placeholder="Journal Title" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Archive Modal -->
    <div class="modal fade" id="archiveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalTitle">Archive Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to archive this question?</h5>
                        <p id="questionInfo"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="archiveModalSave">Save changes</button>
                </div>
            </div>
        </div>
    </div>