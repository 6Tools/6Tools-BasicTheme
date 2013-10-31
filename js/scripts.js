(function() {
  jQuery(function($) {
    var scroll;
    scroll = $("a.anchor--scroll");
    return scroll.on("click", function() {
      var currentHref;
      currentHref = $($(this).attr('href'));
      if (currentHref.length > 0) {
        jQuery('html, body').animate({
          scrollTop: currentHref.offset().top
        }, 1200);
      }
      return false;
    });
  });

}).call(this);
