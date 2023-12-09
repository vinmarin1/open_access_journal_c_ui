 // Get all tabs

document.addEventListener('DOMContentLoaded', function() {
    var tabs = document.querySelectorAll('.tab');
    
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    // Function to check for data and toggle no-data-message
            function checkData() {
                var tableBody = document.querySelector('table tbody');
                var alertMessage = document.getElementById('alertMessage');
                var noDataMessage = document.querySelector('.no-data-message');
                var dataRows = tableBody.querySelectorAll('tr:not(.no-data-message)');

                // If there's no data, show both the alert-message and no-data-message
                if (dataRows.length === 0) {
                    alertMessage.style.display = 'block'; // Show the alert
                    noDataMessage.style.display = 'table-row'; // Show the no-data-message
                    document.querySelector('.stats-section').style.display = 'none'; // Hide the stats-section
                } else {
                    alertMessage.style.display = 'none'; // Hide the alert
                    noDataMessage.style.display = 'none'; // Hide the no-data-message
                    document.querySelector('.stats-section').style.display = 'grid'; // Show the stats-section
                }
            }

    // Call checkData initially in case the table starts out empty
    checkData();
});