<?php
include 'userandroles_function.php';

$userlist = get_user_list();
$rolelist = get_role_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'header.php'; ?>

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
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#updateModal">Update</button>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#archiveModal">Archive</button>
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
                    <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addModal">Add Roles</button>
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
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#updateModal">Update</button>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#archiveModal">Archive</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>      
                </table>
            </div>
        </div>
        <!-- Include footer -->
        <?php include 'footer.php'; ?>
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
    </script>

     <!-- Add Modal -->
     <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
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
                            <input type="text" id="first_name" class="form-control" placeholder="First Name" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="xmiddlename" class="form-label">Middle Name</label>
                            <input type="text" id="middle_name" class="form-control" placeholder="Middle Name" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="xlastname" class="form-label">Last Name</label>
                            <input type="text" id="last_name" class="form-control" placeholder="Last Name" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="xemail">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="email" class="form-control" placeholder="juan.delacruz" aria-label="juan.delacruz" aria-describedby="basic-icon-default-email2" />
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
                                <option>Select Gender</option>
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
                            <input type="text" id="orcid" class="form-control" placeholder="ORCID" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="xorcidurl" class="form-label">ORCID URL</label>
                            <input type="text" id="orcidurl" class="form-control" placeholder="ORCID URL" />
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
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
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
                            <label for="xfirstname" class="form-label">First Name</label>
                            <input type="text" id="first_name" class="form-control" placeholder="First Name" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="xmiddlename" class="form-label">Middle Name</label>
                            <input type="text" id="middle_name" class="form-control" placeholder="Middle Name" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="xlastname" class="form-label">Last Name</label>
                            <input type="text" id="last_name" class="form-control" placeholder="Last Name" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="xemail">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="email" class="form-control" placeholder="juan.delacruz" aria-label="juan.delacruz" aria-describedby="basic-icon-default-email2" />
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
                                <option>Select Gender</option>
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
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label for="xorcid" class="form-label">ORCID</label>
                            <input type="text" id="orcid" class="form-control" placeholder="ORCID" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="xorcidurl" class="form-label">ORCID URL</label>
                            <input type="text" id="orcidurl" class="form-control" placeholder="ORCID URL" />
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>  

     <!-- Archive Modal -->
     <div class="modal fade" id="archiveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Archive User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to archive user 1?</h5>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
