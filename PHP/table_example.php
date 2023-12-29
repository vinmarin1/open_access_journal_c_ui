<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
<style>



  button{
    width: 120px;
    font-size: 11px;
  }

  input[type="checkbox"]{
    margin-right: 5px;
    
  }

  .cAuthor{
    display: inline-block;
    font-size: 12px;
    font-weight: bold;
  
  }

  .pContact{
    display: inline-block;
    font-size: 12px;
    margin-left: 10px;
    font-weight: bold;
  }

  table th{
    font-size: 11px;
    font-weight: normal;
    width: 100px;
  }

  table thead{
    background-color: #0858a4;
  }
  

  table tr td{
    font-size: 12px;
    font-weight: normal;
  }

  .form-control{
    height: 30px;
  }

  #cont-col{
    width: 150px;
  }



</style>
</head>
<body>
  <div class="container-fluid contributor-table-container mt-5">

    <div class="btn-container">
      <button type="button" class="btn btn-success btn-sm" onclick="addRow()">Add Contributor</button>
      <button type="button" class="btn btn-danger btn-sm" onclick="deleteData()">Delete Data</button>
      <button type="button" class="btn btn-primary btn-sm" onclick="saveData()">Save Data</button>
    </div>

    <form class="form  mt-4" id="contributorForm">
        <table class="table table-striped" id="contributorTable" >
            <thead>
                <tr>
                    <th style=" background-color: #0858a4; color: white; font-weight: bold;">First Name</th>
                    <th style=" background-color: #0858a4; color: white; font-weight: bold;">Last Name</th>
                    <th style=" background-color: #0858a4; color: white; font-weight: bold;">Public Name</th>
                    <th style=" background-color: #0858a4; color: white; font-weight: bold;">ORCID</th>
                    <th style=" background-color: #0858a4; color: white; font-weight: bold;">Email</th>
                    <th id="cont-col" style=" background-color: #0858a4; color: white; font-weight: bold;">Contributor Type</th>
                    <th style=" background-color: #0858a4; color: white; font-weight: bold; width: 30px">Action</th>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>asda</th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
  

    </form>
  </div>
 

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script>
function addRow() {
    var index = $('#contributorTable tbody tr').length; // Get the current row index
    var newRow = '<tr>' +
        '<td><input class="form-control" type="text" name="firstname[]"></td>' +
        '<td><input class="form-control" type="text" name="lastname[]"></td>' +
        '<td><input class="form-control" type="text" name="publicname[]"></td>' +
        '<td><input class="form-control" type="text" name="orcid[]"></td>' +
        '<td><input class="form-control" type="text" name="email[]"></td>' +
        '<td class="align-middle">' +
        '<div class="form-check cAuthor">' +
        '<input class="form-check-input" type="checkbox" name="contributor_type_coauthor[' + index + ']" value="Co-Author">' +
        '<label class="form-check-label"> Co-Author</label>' +
        '</div>' +
       '<div class="form-check pContact">' +
        '<input class="form-check-input" type="checkbox" name="contributor_type_primarycontact[' + index + ']" value="Primary Contact">' +
        '<label class="form-check-label"> Primary Contact</label>' +
        '</div>' +
        '</td>'
        +
        '<td class="align-middle"><input class="form-check-input" type="checkbox" name="selectToDelete"></td>' +
        '</tr>';
    
    $('#contributorTable tbody').append(newRow);
}
function saveData() {
    var formData = new FormData($('#contributorForm')[0]);

    // Add contributor types for each row
    $('#contributorTable tbody tr').each(function(index, row) {
        var coAuthorCheckbox = $(row).find('input[name="contributor_type_coauthor[]"]');
        var primaryContactCheckbox = $(row).find('input[name="contributor_type_primarycontact[]"]');

        if (coAuthorCheckbox.is(':checked')) {
            formData.append('contributor_type_coauthor[' + index + ']', 'Co-Author');
        }

        if (primaryContactCheckbox.is(':checked')) {
            formData.append('contributor_type_primarycontact[' + index + ']', 'Primary Contact');
        }
    });

    $.ajax({
        type: 'POST',
        url: 'save_cont.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            alert('Data saved successfully!');
        },
        error: function(error) {
            alert('Error saving data');
            console.log(error);
        }
    });
}


function deleteData() {
    // Iterate through each checkbox
    $('input[name="selectToDelete"]:checked').each(function() {
        // Delete the corresponding row
        $(this).closest('tr').remove();
    });
}
</script>	

</body>
</html>

