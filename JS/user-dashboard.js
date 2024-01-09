function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  
  // Get the element with id="defaultOpen" and click on it to make it the default active tab
  document.getElementById("defaultOpen").click();
  
    // Your JavaScript for Chart.js and 'Add New' functionality
    window.onload = function() {
      var ctx = document.getElementById('articlesChart').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'bar', // Change to 'bar' for bar graph
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Views',
            backgroundColor: 'rgba(10, 51, 91, 0.7)', // Increased alpha value
            borderColor: '#0056b3',
            data: [0, 300, 200, 320, 450, 325, 400, 430, 450, 500, 550, 500],
          },
          {
            label: 'Downloads',
            backgroundColor: 'rgba(229, 111, 31, 0.7)', // Increased alpha value
            borderColor: '#E56F1F',
            data: [0, 200, 300, 350, 400, 420, 410, 480, 400, 430, 570, 600],
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
              usePointStyle: true
            }
          }
        }
      });
    };