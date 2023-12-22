<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table with PHP Insert</title>
    <!-- Include DataTables CSS and JS files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
<body>

<!-- HTML form -->
<form id="myForm" method="post" action="table_function.php">
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" required><br>

    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" required><br>

    <label for="publicname">Public Name:</label>
    <input type="text" id="publicname" name="publicname" required><br>

    <label for="orcid">ORCID:</label>
    <input type="text" id="orcid" name="orcid" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <input type="button" value="Add to Table" onclick="addData()">
    <input type="button" value="Add to Table and Save" >

</form>

<!-- DataTable -->
<table class="table-cont mt-3" id="dataTable" border="1">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Public Name</th>
        <th>ORCID</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
 
    </tbody>
</table>

<script>
    // Initialize DataTable
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    // Function to add data to DataTable
    function addData() {
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var publicname = $('#publicname').val();
        var orcid = $('#orcid').val();
        var email = $('#email').val();

        // Add data to DataTable
        var table = $('#dataTable').DataTable();
        table.row.add([firstname, lastname, publicname, orcid, email]).draw(false);

        // Clear the form fields
        $('#myForm')[0].reset();
    }

    function addDataAndSubmit() {
    addData(); // Call the function to add data to the DataTable
    $('#myForm').submit(); // Submit the form
}

</script>

</body>
</html>
