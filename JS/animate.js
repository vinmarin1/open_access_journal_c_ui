$(function() {
  var html = $('html');
  
  // Detections
  if (!("ontouchstart" in window)) {
    html.addClass("noTouch");
  } else {
    html.addClass("isTouch");
  }
  
  if (document.documentMode || /Edge/.test(navigator.userAgent)) {
    if (navigator.appVersion.indexOf("Trident") === -1) {
      html.addClass("isEDGE");
    } else {
      html.addClass("isIE isIE11");
    }
  } else if (navigator.appVersion.indexOf("MSIE") !== -1) {
    html.addClass("isIE");
  }
  
  if (navigator.userAgent.indexOf("Safari") != -1 && navigator.userAgent.indexOf("Chrome") == -1) {
    html.addClass("isSafari");
  }

  // On Screen
  $.fn.isOnScreen = function() {
    var elementTop = $(this).offset().top,
      elementBottom = elementTop + $(this).outerHeight(),
      viewportTop = $(window).scrollTop(),
      viewportBottom = viewportTop + $(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
  };

  function detection() {
    var items = $("[data-animate-in], [data-detect-viewport]");
    items.each(function() {
      var el = $(this);
      if (el.isOnScreen()) {
        el.addClass("in-view");
      } else {
        el.removeClass("in-view");
      }
    });
  }

  var w = $(window);
  var debounceTimeout;

  function handleScroll() {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(function() {
      detection();
    }, 50); 
  }

  w.on("scroll", handleScroll);
  
  w.on("resize", function() {
    throttleResize(handleScroll);
  });

  function throttleResize(callback) {
    var resizeTimeout;
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(callback, 80); 
  }

  $(document).ready(function() {
    setTimeout(function() {
      detection();
    }, 1000);

    $("[data-animate-in], [data-detect-viewport]").each(function() {
      var d = $(this).data("animate-in-delay") || 0;
      $(this).css("transition-delay", d + "s");
    });
  });
});
