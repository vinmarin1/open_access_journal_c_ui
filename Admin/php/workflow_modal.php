<?php
include 'function/workflow_function.php';
$aid = isset($_GET['aid']) ? $_GET['aid'] : 1;

$article_files = get_article_files($aid);
?>
<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Upload Files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xfiles" class="form-label">If you are uploading a revision of an existing file, please indicate which file.</label>
                            <select id="fileDropdown" class="form-select">
                                <option value="Null">Select File</option>
                                <?php foreach ($article_files as $article_filesval): ?>
                                    <option value="<?php echo $article_filesval->file_name; ?>"><?php echo $article_filesval->file_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xcomponent" class="form-label">Article Component</label>
                            <select id="fileDropdown1" class="form-select">
                                <option value="Null">Select Component</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="formFile" class="form-label">Upload File</label>
                            <input class="form-control" type="file" id="formFile" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addRecord()">Save changes</button>
                </div>
            </div>
        </div>
        </form>
    </div>