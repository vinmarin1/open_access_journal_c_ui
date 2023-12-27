<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkbox Interaction</title>
</head>
<body>

  <label>
    <input type="checkbox" id="checkbox1"> Checkbox 1
  </label>

  <label>
    <input type="checkbox" id="checkbox2"> Checkbox 2
  </label>

  <script>
    
    var checkbox1 = document.getElementById('checkbox1');
    var checkbox2 = document.getElementById('checkbox2');

   
    checkbox1.addEventListener('change', function() {
     
      checkbox2.checked = checkbox1.checked;
    });

    checkbox2.addEventListener('change', function() {
     
      checkbox1.checked = checkbox2.checked;
    });
  </script>

</body>
</html>
