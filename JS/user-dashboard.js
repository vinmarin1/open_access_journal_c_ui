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
    /* More badge hover */
    document.addEventListener("DOMContentLoaded", function () {
      var popup = document.getElementById("popup");
      var seeMoreButton = document.getElementById("see-more");
      var hideTimeout;
  
      seeMoreButton.addEventListener("mouseover", function (e) {
          popup.style.display = "block";
          positionPopup(e);
      });
  
      seeMoreButton.addEventListener("mousemove", function (e) {
          positionPopup(e);
      });
  
      seeMoreButton.addEventListener("mouseout", function () {
          hideTimeout = setTimeout(function () {
              popup.style.display = "none";
          }, 200);
      });
  
      popup.addEventListener("mouseover", function () {
          clearTimeout(hideTimeout);
      });
  
      popup.addEventListener("mouseout", function (e) {
          if (!e.relatedTarget || !e.relatedTarget.closest(".popup-container")) {
              popup.style.display = "none";
          }
      });
  
      function positionPopup(e) {
          var buttonRect = seeMoreButton.getBoundingClientRect();
  
          // Position the popup to the right side of the button
          popup.style.top = buttonRect.top + buttonRect.height / 2 - popup.offsetHeight / 2 + "px";
          popup.style.left = buttonRect.left + buttonRect.width + 20 + "px"; // Adjust as needed
      }
  });
  
  
  
    /**Hide details toggle **/
    document.addEventListener('DOMContentLoaded', function () {
      const icon = document.getElementById('toggleIcon');
      const label = document.getElementById('positionLabel');
      const label1 = document.getElementById('genderLabel');
      const label2 = document.getElementById('birthdayLabel');
      const label3 = document.getElementById('countryLabel');
      const label4 = document.getElementById('orcidLabel');
  
      icon.addEventListener('click', toggleDetails);
  
      function toggleDetails() {
          if (label.classList.contains('bullet')) {
              label.innerHTML = 'Student';
              label1.innerHTML = 'Female';
              label2.innerHTML = '10/24/2002';
              label3.innerHTML = 'Philippines';
              label4.innerHTML = '048469754';
              label.classList.remove('bullet');
          } else {
              label.innerHTML = '********';
              label1.innerHTML = '********';
              label2.innerHTML = '********';
              label3.innerHTML = '********';
              label4.innerHTML = '********';
              label.classList.add('bullet');
          }
  
          icon.classList.toggle('ri-eye-line');
          icon.classList.toggle('ri-eye-close-line');
      }
  });
  /* edit profile form */
  document.addEventListener('DOMContentLoaded', function () {
    const editIcon = document.getElementById('editIcon');
    const editForm = document.getElementById('editForm');
    const closeIcon = document.getElementById('closeIcon');
    const saveButton = document.getElementById('saveButton');

    editIcon.addEventListener('click', openEditForm);
    closeIcon.addEventListener('click', closeEditForm);
    saveButton.addEventListener('click', saveChanges);

    function openEditForm() {
        editForm.style.display = 'block';
    }

    function closeEditForm() {
        editForm.style.display = 'none';
    }

    function saveChanges() {
        // Add logic to save changes to the backend or perform any necessary actions
        closeEditForm();
    }
});

//add keyword
document.getElementById('addExpertiseButton').addEventListener('click', function() {
  // Get the input value
  var inputValue = document.getElementById('fieldofexpertise').value;

  // Create a new keyword element
  var keywordElement = document.createElement('div');
  keywordElement.className = 'keyword';

  // Create a span for the keyword text
  var keywordText = document.createElement('span');
  keywordText.textContent = inputValue;

  // Create a close button
  var closeButton = document.createElement('span');
  closeButton.className = 'close-btn';
  closeButton.textContent = 'x';

  // Add an event listener to remove the keyword when the close button is clicked
  closeButton.addEventListener('click', function() {
      keywordElement.remove();
  });

  // Append elements to the keyword container
  keywordElement.appendChild(keywordText);
  keywordElement.appendChild(closeButton);
  document.getElementById('keywordContainer').appendChild(keywordElement);

  // Clear the input field
  document.getElementById('fieldofexpertise').value = '';
});
  
  
  
  
  
  
  