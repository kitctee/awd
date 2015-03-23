$(document).ready(function () {
  $('.sidebar-toggle, .dark-overlay').click(function () {
    $('.sidebar, .dark-overlay').toggleClass('active');
  });
  
  $('.article-toggle, .dark-overlay2').click(function () {
    $('.articleSidebar, .dark-overlay2').toggleClass('active');
  });
  
  $('.nav-sidebar > li').each(function (i) {
    var row = $(this);
    setTimeout(function () {
      row.addClass('active');
    }, 200 * i);
  });
  $('.resultCell').each(function (i) {
    var row = $(this);
    setTimeout(function () {
      row.addClass('active');
    }, 200 * i);
  });
  
  $('.articleSidebar h4 a').on('click', function (event) {
    event.preventDefault();
    var scrollTo = $(this).attr('href'),
        $body = $('body'),
        section = $(scrollTo);
    $body.animate({
      scrollTop: section.offset().top - $body.offset().top - 40
    }, 300);
  });
  
  $('.glyphicon-th-large').on('click', function () {
    $('.resultTable').toggleClass('grid');
  });
  
  var $window = $(window);
  function checkWidth() {
    var windowsize = $window.width();
    if (windowsize > 922) {
      $('.sidebar, .dark-overlay').removeClass('active');
    }
    if (windowsize > 768) {
      var aSide = $('#articleSidebar'),
          aSideTop = aSide.offset().top,
          aSideH = aSide.outerHeight();
      $window.scroll(function() {
        var windowpos = $window.scrollTop(),
            windowH = $window.outerHeight(),
            $footer = $('#pageFooter').offset().top,
            $footerH = $('#pageFooter').outerHeight(),
            bPad = aSideH - windowH,
            achor = $footer - windowH;

        if (windowpos > aSideTop && windowpos < achor) {
          aSide.addClass('stick');
        } else if (windowpos > achor) {
          aSide.removeClass('stick');
          aSide.css({
            position: 'absolute',
            top: achor - 50,
            right: 0
          });
        } else {
          aSide.removeClass('stick');
          aSide.css({
            position: 'static',
            top: 'auto',
            right: 'auto',
            bottom: 'auto'
          });
        }
      });
    }
    if (windowsize < 768) {
      $('.resultTable').removeClass('grid');
    }
  }
  checkWidth();
  $(window).resize(checkWidth);
  
});