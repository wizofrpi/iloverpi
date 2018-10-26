(function($) {
  $('.channel .infos .icon').click(function() {
    $(this).parents('.channel').toggleClass('closed opened');
  });
  
  $('#menu-wrapper .toggle-menu').click(function() {
    $('#menu-wrapper').toggleClass('open');
  });
  
  $('.action-back').click(function(e) {
    $('#content-wrapper').toggleClass('opened');
    e.stopImmediatePropagation();
  });
  
  $(document).on('click', '#content-wrapper.opened #main', function(e) {
    $('.action-back').click();
  });
  
  // CHAT
  $('#channel-list li').click(function() {
    $(this).addClass('active').siblings().removeClass('active');
  });
})(jQuery);
