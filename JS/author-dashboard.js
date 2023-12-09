// Your JavaScript for Chart.js and 'Add New' functionality
window.onload = function() {
  var ctx = document.getElementById('articlesChart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Views',
        backgroundColor: 'rgba(10, 51, 91, 0.2)', // Updated to your color in rgba
        borderColor: '#0A335B', // Updated to your color in hex
        pointBackgroundColor: '#0A335B', // Point color
        pointBorderColor: '#0A335B', // Point border color
        pointRadius: 5, // Adjust the radius as needed
        pointHoverRadius: 7, // Radius on hover
        pointStyle: 'circle', // Style of the point
        data: [0, 300, 200, 320, 450, 325, 400, 430, 450, 500, 550, 500],
        fill: false,
      },
      {
        label: 'Downloads',
        backgroundColor: 'rgba(229, 111, 31, 0.2)', // Updated to your color in rgba
        borderColor: '#E56F1F', // Updated to your color in hex
        pointBackgroundColor: '#E56F1F', // Point color
        pointBorderColor: '#E56F1F', // Point border color
        pointRadius: 5, // Adjust the radius as needed
        pointHoverRadius: 7, // Radius on hover
        pointStyle: 'circle', // Style of the point
        data: [0, 200, 300, 350, 400, 420, 410, 480, 400, 430, 570, 600],
        fill: false,
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      legend: {
        labels: {
          usePointStyle: true // Use point style for legend icons too
        }
      }
    }
  });
};

  // Get all tabs
  var tabs = document.querySelectorAll('.tab');
  
  // Add click event listener to each tab
  tabs.forEach(function(tab) {
    tab.addEventListener('click', function() {
      // Remove active class from all tabs
      tabs.forEach(function(tab) {
        tab.classList.remove('active');
      });
      // Add active class to clicked tab
      this.classList.add('active');
    });
  });