$(document).ready(function () {
  $('.sidebar-toggle, .dark-overlay').click(function () {
    $('.sidebar, .dark-overlay').toggleClass('active')
  });
  
  $('.nav-sidebar > li').each(function(i){
    var row = $(this);
    setTimeout(function() {
  //          row.addClass('active', !row.hasClass('active'));
      row.addClass('active');
    }, 300*i);
  });
  $('.resultCell').each(function(i){
    var row = $(this);
    setTimeout(function() {
  //          row.addClass('active', !row.hasClass('active'));
      row.addClass('active');
    }, 300*i);
  });
  
});