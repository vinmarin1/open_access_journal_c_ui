// speech recognition search
function startConverting() {
    var result = document.querySelector("#result");
    var voiceButton = document.getElementById("voiceSearch")
    result.innerText = "";
    if ("webkitSpeechRecognition" in window) {
      var speechRecognizer = new webkitSpeechRecognition();
      speechRecognizer.continuous = false;
      speechRecognizer.interimResults = true;
      speechRecognizer.lang = "en-US";
      speechRecognizer.start();
      var recognizing = false;
      speechRecognizer.onstart = function () {
        voiceButton.classList.add("bg-secondary")
        voiceButton.innerHTML=`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><circle cx="18" cy="12" r="0" fill="white"><animate attributeName="r" begin=".67" calcMode="spline" dur="1.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite" values="0;2;0;0"/></circle><circle cx="12" cy="12" r="0" fill="white"><animate attributeName="r" begin=".33" calcMode="spline" dur="1.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite" values="0;2;0;0"/></circle><circle cx="6" cy="12" r="0" fill="white"><animate attributeName="r" begin="0" calcMode="spline" dur="1.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite" values="0;2;0;0"/></circle></svg>`
  
        recognizing = true;
      };
      var finalTranscripts = "";
      speechRecognizer.onresult = function (event) {
        var interimTranscripts = "";
        for (var i = event.resultIndex; i < event.results.length; i++) {
          var transcript = event.results[i][0].transcript;
          if (event.results[i].isFinal) {
            finalTranscripts += transcript.replace(".", ""); // Remove periods
          } else {
            interimTranscripts += transcript;
          }
        }
        result.setAttribute("value", `${finalTranscripts + interimTranscripts}`);
      };
      speechRecognizer.onend = function () {
        voiceButton.innerHTML =`<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="white" d="M16 2a6 6 0 0 0-6 6v8a6 6 0 0 0 12 0V8a6 6 0 0 0-6-6ZM7 15a1 1 0 0 1 1 1a8 8 0 1 0 16 0a1 1 0 1 1 2 0c0 5.186-3.947 9.45-9.001 9.95L17 26v3a1 1 0 1 1-2 0v-3l.001-.05C9.947 25.45 6 21.187 6 16a1 1 0 0 1 1-1Z" /></svg>`
        voiceButton.classList.remove("bg-secondary")
        recognizing = false;
        searchInputValue = finalTranscripts;
        fetchData(finalTranscripts, selectedYears, sortby)
      };
      speechRecognizer.onerror = function (event) {};
    } else {
  
      result.innerHTML =
        "Your browser is not supported. Please download Google Chrome or update your Google Chrome!";
         function swal() {
          Swal.fire({
            icon: "warning",
            text: "Sorry. Voice search is not supported in your browser. Please try using Google Chrome or another supported browser."
          });
        };
        swal()
        voiceButton.setAttribute("disabled","true")
        voiceButton.classList.add("bg-secondary")
        voiceButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="white" d="M4.93 12.01a1 1 0 0 1 1.13.848a6.001 6.001 0 0 0 7.832 4.838l.293-.107l1.509 1.509a7.94 7.94 0 0 1-2.336.787l-.358.053V21a1 1 0 0 1-1.993.117L11 21v-1.062a8.005 8.005 0 0 1-6.919-6.796a1 1 0 0 1 .848-1.132ZM12 2a5 5 0 0 1 4.995 4.783L17 7v5a4.98 4.98 0 0 1-.691 2.538l-.137.22l.719.719c.542-.76.91-1.652 1.048-2.619a1 1 0 0 1 1.98.284a7.96 7.96 0 0 1-1.412 3.513l-.187.25l2.165 2.166a1 1 0 0 1-1.32 1.497l-.094-.083L3.515 4.93a1 1 0 0 1 1.32-1.497l.094.083l2.23 2.23A5.002 5.002 0 0 1 12 2m-5 8.404l6.398 6.398A5 5 0 0 1 7 12z"/></g></svg>`
    }
  }
  