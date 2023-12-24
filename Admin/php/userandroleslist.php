<?php
include 'function/userandroles_function.php';

$userlist = get_user_list();
$rolelist = get_role_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> User & Roles</h4>

        <ul class="nav nav-tabs mb-3" id="statusTabs">
            <li class="nav-item">
                <a class="nav-link active" id="tabUser" onclick="toggleTab('user')">User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabRoles" onclick="toggleTab('roles')">Roles</a>
            </li>
        </ul>

        <div class="card user-list" style="display: block;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h5 class="card-header mb-0">User List</h5>
                <div style="display: flex; margin-top: 15px; margin-right: 15px;">
                    <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addModal">Add User</button>
                    <button type="button" id="tabPublished" class="btn btn-primary">Download</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTableUser">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userlist as $userlistval): ?>
                            <tr>
                                <td width="5%"><?php echo $userlistval->author_id; ?></td>
                                <td width="50%"><?php echo $userlistval->last_name; ?>, <?php echo $userlistval->first_name; ?></td>
                                <td width="50%"><?php echo $userlistval->email; ?></td>
                                <td width="10%">
                                    <button type="button" class="btn btn-outline-success" onclick="updateModal(<?php echo $userlistval->author_id; ?>)">Update</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="archiveUser(<?php echo $userlistval->author_id; ?>, '<?php echo $userlistval->first_name; ?>', '<?php echo $userlistval->last_name; ?>')">Archive</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>    
                </table>
            </div>
        </div>

        <div class="card roles-list" style="display: none;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h5 class="card-header mb-0">Roles List</h5>
                <div style="display: flex; margin-top: 15px; margin-right: 15px;">
                    <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addRoleModal">Add Roles</button>
                    <button type="button" id="tabPublished" class="btn btn-primary">Download</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTableRole">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rolelist as $rolelistval): ?>
                            <tr>
                                <td width="5%"><?php echo $rolelistval->admin_role_id; ?></td>
                                <td width="35%"><?php echo $rolelistval->role; ?></td>
                                <td width="50%"><?php echo $rolelistval->role_name; ?></td>
                                <td width="10%">
                                    <button type="button" class="btn btn-outline-success" onclick="updateModalRole('<?php echo $rolelistval->admin_role_id; ?>')">Update</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="archiveRole(<?php echo $rolelistval->admin_role_id; ?>, '<?php echo $rolelistval->role; ?>', '<?php echo $rolelistval->role_name; ?>')">Archive</button>
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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        function toggleTab(tab) {
            var otherTab = (tab === 'user') ? 'roles' : 'user';

            document.querySelector('.' + tab + '-list').style.display = 'block';
            document.querySelector('.' + otherTab + '-list').style.display = 'none';

            document.getElementById('tabUser').classList.remove('active');
            document.getElementById('tabRoles').classList.remove('active');

            document.getElementById('tab' + tab.charAt(0).toUpperCase() + tab.slice(1)).classList.add('active');
        }

        $(document).ready(function() {
            var dataTable = $('#DataTableUser').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
            });
        });

        $(document).ready(function() {
            var dataTable = $('#DataTableRole').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
            });
        });

        function addRecord() {
        $('#sloading').toggle();
        var form = document.getElementById('addModalForm');

        if (form.checkValidity()) {
            var formData = {
                first_name: $("#first_name").val(),
                middle_name: $("#middle_name").val(),
                last_name: $("#last_name").val(),
                email: $("#email").val(),
                phone_number: $("#phone_number").val(),
                gender: $("#gender").val(),
                dob: $("#dob").val(),
                orcid: $("#orcid").val(),
                orcidurl: $("#orcidurl").val(),
                school_name: $("#school_name").val(),
                field_expertise: $("#field_expertise").val(),
                action: "add"
            };

            $.ajax({
                url: "../php/function/userandroles_function.php",
                method: "POST",
                data: formData,
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.status) {
                        $('#sloading').toggle();
                        alert("Record added successfully");
                    } else {
                        alert("Email is already used");
                    }
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                }
            });
        } else {
            form.reportValidity();
        }
    }

    function archiveUser(authorId, firstName, lastName) {
        $('#archiveModal').modal('show');
        $('#archiveModalTitle').text('Archive User');
        $('#userInfo').html('<strong>Name:</strong> ' + lastName + ', ' + firstName + '<br><strong>ID:</strong> ' + authorId);

        $('#archiveModalSave').off().on('click', function () {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/userandroles_function.php",
                method: "POST",
                data: { action: "archive", author_id: authorId },
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status) {
                        $('#sloading').toggle();
                        $('#archiveModalMessage').text('User archived successfully');
                    } else {
                        $('#archiveModalMessage').text('Failed to archive user');
                    }
                        $('#archiveModal').modal('hide');
                        location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    $('#archiveModalMessage').text('Failed to archive user');
                    $('#archiveModal').modal('hide');
                    location.reload();
                }
            });
        });
    }

    function updateModal(authorId) {
        $.ajax({
            type: 'POST',
            url: '../php/function/userandroles_function.php',
            data: { action: 'fetch', author_id: authorId },
            dataType: 'json',
            success: function (response) {
                console.log('Response from server:', response);

                if (response.status === true && response.data.length > 0) {
                    const userData = response.data[0];
                    console.log('User Data:', userData);

                    $('#xauthorid').val(userData.author_id);
                    $('#xfirst_name').val(userData.first_name);
                    $('#xmiddle_name').val(userData.middle_name);
                    $('#xlast_name').val(userData.last_name);
                    $('#xemail').val(userData.email);
                    $('#xphone_number').val(userData.phone_number);
                    $('#xgender').val(userData.gender);
                    $('#xdob').val(userData.birth_date);
                    $('#xorcid').val(userData.orc_id);
                    $('#xorcidurl').val(userData.url_orc_id);
                    $('#xschool_name').val(userData.school_name);
                    $('#xfield_expertise').val(userData.field_of_expertise);

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
        
        var authorId = $('#xauthorid').val();
        var updatedData = {
            first_name: $('#xfirst_name').val(),
            middle_name: $('#xmiddle_name').val(),
            last_name: $('#xlast_name').val(),
            email: $('#xemail').val(),
            phone_number: $('#xphone_number').val(),
            gender: $('#xgender').val(),
            dob: $('#xdob').val(),
            orc_id: $('#xorcid').val(),
            url_orc_id: $('#xorcidurl').val(),
            school_name: $('#xschool_name').val(),
            field_of_expertise: $('#xfield_expertise').val(),
        };

        $.ajax({
            type: 'POST',
            url: '../php/function/userandroles_function.php',
            data: {
                action: 'update',
                author_id: authorId,
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
                    console.error('Error updating user data:', response.message);
                    alert("Failed to update record. Please try again.");
                }
            },
        });
    }

    function addRoleRecord() {
        $('#sloading').toggle();
        var form = document.getElementById('addModalRoleForm');

        if (form.checkValidity()) {
            var formData = {
                role: $("#role").val(),
                role_name: $("#role_name").val(),
                action: "addrole"
            };

            $.ajax({
                url: "../php/function/userandroles_function.php",
                method: "POST",
                data: formData,
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.status) {
                        $('#sloading').toggle();
                        alert("Record added successfully");
                    } else {
                        alert("All fields required");
                    }
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                }
            });
        } else {
            form.reportValidity();
        }
    }

    function updateModalRole(roleId) {
        $.ajax({
            type: 'POST',
            url: '../php/function/userandroles_function.php',
            data: { action: 'fetchrole', role_id: roleId },
            dataType: 'json',
            success: function (response) {
                console.log('Response from server:', response);

                if (response.status === true && response.data.length > 0) {
                    const roleData = response.data[0];
                    console.log('Role Data:', roleData);

                    $('#xroleid').val(roleData.admin_role_id);
                    $('#xrole').val(roleData.role);
                    $('#xrole_name').val(roleData.role_name);
                    $('#updateRoleModal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error:', textStatus, errorThrown);
                console.log('Error fetching user data');
            }
        });
    }

    function saveChangesRole() {
        $('#sloading').toggle();
        console.log('Save button clicked');
        
        var roleId = $('#xroleid').val();
        var updatedRoleData = {
            role: $('#xrole').val(),
            role_name: $('#xrole_name').val(),
        };

        $.ajax({
            type: 'POST',
            url: '../php/function/userandroles_function.php',
            data: {
                action: 'updaterole',
                role_id: roleId,
                updated_roledata: updatedRoleData
            },
            dataType: 'json',
            success: function (response) {
                console.log('Update Response:', response);

                if (response.status === true) {
                    $('#sloading').toggle();
                    alert("Record updated successfully");
                    $('#updateRoleModal').modal('hide');
                    location.reload();
                } else {
                    console.error('Error updating user data:', response.message);
                    alert("Failed to update record. Please try again.");
                }
            },
        });
    }

    function archiveRole(roleId, role, role_name) {
        $('#archiveRoleModal').modal('show');
        $('#archiveModalTitle').text('Archive Role');
        $('#roleInfo').html('<strong>Role:</strong> ' + role + ' <br><strong>Role_Name:</strong> ' + role_name + ' <br><strong>ID:</strong> ' + roleId);

        $('#archiveRoleModalSave').off().on('click', function () {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/userandroles_function.php",
                method: "POST",
                data: { action: "archiverole", role_id: roleId },
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.status) {
                        $('#sloading').toggle();
                        $('#archiveRoleModalMessage').text('Role archived successfully');
                    } else {
                        $('#archiveRoleModalMessage').text('Failed to archive role');
                    }
                    $('#archiveRoleModal').modal('hide');
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    $('#archiveRoleModalMessage').text('Failed to archive role');
                    $('#archiveRoleModal').modal('hide');
                }
            });
        });
    }
    </script>

     <!-- Add Modal -->
     <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
     <form id="addModalForm">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-4 mb-2">
                            <label for="xfirstname" class="form-label">First Name</label>
                            <input type="text" id="first_name" class="form-control" placeholder="First Name" required/>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="xmiddlename" class="form-label">Middle Name</label>
                            <input type="text" id="middle_name" class="form-control" placeholder="Middle Name" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="xlastname" class="form-label">Last Name</label>
                            <input type="text" id="last_name" class="form-control" placeholder="Last Name" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="xemail">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="email" class="form-control" placeholder="juan.delacruz" aria-label="juan.delacruz" aria-describedby="basic-icon-default-email2" required/>
                                <span id="semail" class="input-group-text">@example.com</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="xphone_number">Phone No</label>
                            <div class="input-group input-group-merge">
                                <span id="sphone_number" class="input-group-text"><i class="bx bx-phone"></i></span>
                                <input type="text" id="phone_number" class="form-control phone-mask" placeholder="639 799 8941" aria-label="639 799 8941" aria-describedby="basic-icon-default-phone2" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label for="xgender" class="form-label">Gender</label>
                            <select id="gender" class="form-select">
                                <option value="Null">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="xdob" class="form-label">DOB</label>
                            <input type="date" id="dob" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <label for="xorcid" class="form-label">ORCID</label>
                            <input type="text" id="orcid" class="form-control" placeholder="ORCID" required/>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="xorcidurl" class="form-label">ORCID URL</label>
                            <input type="text" id="orcidurl" class="form-control" placeholder="ORCID URL" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label for="xschoolname" class="form-label">SCHOOL NAME</label>
                            <input type="text" id="school_name" class="form-control" placeholder="SCHOOL NAME" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="xexpertise" class="form-label">EXPERTISE</label>
                            <input type="text" id="field_expertise" class="form-control" placeholder="EXPERTISE" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Notify user by email.</label>
                            </div>
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

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-4 mb-2">
                            <input type="hidden" id="xauthorid" class="form-control"/>
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" id="xfirst_name" class="form-control" placeholder="First Name" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" id="xmiddle_name" class="form-control" placeholder="Middle Name" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" id="xlast_name" class="form-control" placeholder="Last Name" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="xemail" class="form-control" placeholder="juan.delacruz" aria-label="juan.delacruz" aria-describedby="basic-icon-default-email2" />
                                <span id="semail" class="input-group-text">@example.com</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="phone_number">Phone No</label>
                            <div class="input-group input-group-merge">
                                <span id="sphone_number" class="input-group-text"><i class="bx bx-phone"></i></span>
                                <input type="text" id="xphone_number" class="form-control phone-mask" placeholder="639 799 8941" aria-label="639 799 8941" aria-describedby="basic-icon-default-phone2" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="xgender" class="form-select">
                                <option>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="dob" class="form-label">DOB</label>
                            <input type="date" id="xdob" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label for="orcid" class="form-label">ORCID</label>
                            <input type="text" id="xorcid" class="form-control" placeholder="ORCID" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="orcidurl" class="form-label">ORCID URL</label>
                            <input type="text" id="xorcidurl" class="form-control" placeholder="ORCID URL" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label for="school_name" class="form-label">SCHOOL NAME</label>
                            <input type="text" id="xschool_name" class="form-control" placeholder="SCHOOL NAME" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="field_expertise" class="form-label">EXPERTISE</label>
                            <input type="text" id="xfield_expertise" class="form-control" placeholder="EXPERTISE" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateModalSave" onclick="saveChanges()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Archive Modal -->
     <div class="modal fade" id="archiveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalTitle">Archive User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to archive this user?</h5>
                        <p id="userInfo"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="archiveModalSave">Save changes</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Add Role Modal -->
     <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
     <form id="addModalRoleForm">
        <div class="modal-dialog modal-dialog-centered modal-m" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xrole" class="form-label">Role</label>
                            <input type="text" id="role" class="form-control" placeholder="Role" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xrole_name" class="form-label">Role Name</label>
                            <input type="text" id="role_name" class="form-control" placeholder="Role Name" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addRoleRecord()">Save changes</button>
                </div>
            </div>
        </div>
        </form>
    </div>

    <!-- Update Role Modal -->
    <div class="modal fade" id="updateRoleModal" tabindex="-1" aria-hidden="true">
    <form id="">
        <div class="modal-dialog modal-dialog-centered modal-m" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Update Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <input type="hidden" id="xroleid" class="form-control"/>
                            <label for="xrole" class="form-label">Role</label>
                            <input type="text" id="xrole" class="form-control" placeholder="Role" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xrole_name" class="form-label">Role Name</label>
                            <input type="text" id="xrole_name" class="form-control" placeholder="Role Name" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChangesRole()">Save changes</button>
                </div>
            </div>
        </div>
        </form>
    </div>

    <!-- Archive Role Modal -->
    <div class="modal fade" id="archiveRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalTitle">Archive Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to archive this role?</h5>
                        <p id="roleInfo"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="archiveRoleModalSave">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
