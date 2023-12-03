document.addEventListener('DOMContentLoaded', function () {
  var tabButtons = document.querySelectorAll('.nav-link');
  var tabContent = document.querySelectorAll('.tab-pane input');

  var selectedTabIndex = 0; // Track the index of the currently selected tab

  for (var i = 1; i < tabButtons.length; i++) {
    tabButtons[i].disabled = true;
  }

  function updateStyles() {
    tabButtons.forEach(function (btn, i) {
      if (i === selectedTabIndex) {
        btn.style.backgroundColor = "#115272";
        btn.style.color = "white";
      } else {
        btn.style.backgroundColor = "white";
        btn.style.border = "1px solid";
        btn.style.color = "#115272";
      }
    });
  }

  tabContent.forEach(function (input, index) {
    input.addEventListener('input', function () {
      updateButtonStates(index);
      updateStyles();
    });

    input.addEventListener('focus', function () {
      updateStyles();
    });

    input.addEventListener('blur', function () {
      // Don't change styles on blur
    });
  });

  tabButtons.forEach(function (button, index) {
    button.addEventListener('click', function () {
      selectedTabIndex = index;

      tabButtons.forEach(function (btn, i) {
        if (i === index) {
          btn.style.backgroundColor = "#115272";
          btn.style.color = "white";
        } else {
          btn.style.backgroundColor = "white";
          btn.style.border = "1px solid";
          btn.style.color = "#115272";
        }
      });

      var currentInput = tabContent[index];
      if (currentInput.value === '') {
        return;
      }

      if (index < tabButtons.length - 1) {
        tabButtons[index + 1].disabled = false;
        tabButtons[index + 1].tab('show');
      }
    });

    // Set initial styles for the first button
    if (index === 0) {
      button.style.backgroundColor = "#115272";
      button.style.color = "white";
    }
  });

  function updateButtonStates(index) {
    for (var i = index + 1; i < tabButtons.length; i++) {
      tabButtons[i].disabled = tabContent[i - 1].value === '';
    }
  }
});


  var quill = new Quill('#editor', {
    theme: 'snow'
  });
  var quill = new Quill('#editor2', {
    theme: 'snow'
  });
  var quill = new Quill('#editor3', {
    theme: 'snow'
  });
  


  