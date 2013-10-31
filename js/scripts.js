(function() {
  jQuery(function($) {
    var bodyHeight, changeBodyHeight, changeDropdownMenuHeight, containerSlideMenu, contentHeight, input, scroll, searchform, wrapperSlideMenu;
    searchform = $(".searchform--compact form");
    input = searchform.find(".input-text");
    searchform.on("submit", function() {
      if (searchform.hasClass("close")) {
        searchform.removeClass("close");
        searchform.addClass("open");
        input.focus();
        return false;
      } else {
        searchform.removeClass("open");
        searchform.addClass("close");
        if (input.val() !== "") {
          return searchform.submit();
        } else {
          return false;
        }
      }
    });
    scroll = $("a.anchor--scroll");
    scroll.on("click", function() {
      var currentHref;
      currentHref = $($(this).attr('href'));
      if (currentHref.length > 0) {
        jQuery('html, body').animate({
          scrollTop: currentHref.offset().top
        }, 1200);
      }
      return false;
    });
    jQuery(".btn--open-close").on("click", function() {
      var parentEl;
      parentEl = $(this).parent();
      if (parentEl.hasClass("close")) {
        parentEl.removeClass("close");
        parentEl.addClass("open");
      } else {
        parentEl.removeClass("open");
        parentEl.addClass("close");
      }
      return false;
    });
    jQuery(".nav--main .has-dropdown").each(function(e) {
      var $backButton, backLabel;
      backLabel = "Retour";
      if ($(this).hasClass('en')) {
        backLabel = "Back";
      }
      $backButton = $("<li/>").append($("<a/>").attr("class", "btn--return").attr("href", "#").html(backLabel));
      $(this).find(".dropdown").prepend($backButton);
      return $(this).on("click", function(e) {
        if ($(e.target).is($(this).find(".btn--return"))) {
          $(this).find(".dropdown").removeClass("active");
          return false;
        } else if ($(e.target).attr("href") === "#") {
          $(this).find(".dropdown").addClass("active");
          return false;
        }
      });
    });
    changeDropdownMenuHeight = function() {
      var bodyHeight, menuTop;
      if ($(".nav--main").length > 0) {
        bodyHeight = $("body").height();
        menuTop = Math.floor($(".nav--main").offset().top + 1);
        return $(".dropdown").height(bodyHeight - menuTop);
      }
    };
    contentHeight = $(".content--secondary").height();
    $("body").css("height", "auto");
    changeBodyHeight = function() {};
    $("body").css("height", "auto");
    bodyHeight = $("body").height();
    if (bodyHeight < $(window).height()) {
      bodyHeight = $(window).height();
    }
    $("body").css("height", bodyHeight + "px");
    changeDropdownMenuHeight();
    changeBodyHeight();
    $(window).resize(_.debounce(changeBodyHeight, 500));
    $(window).load(function() {
      return changeBodyHeight();
    });
    jQuery(".btn__all-view").on("click", function() {
      return false;
    });
    jQuery(".btn_readmore").on("click", function() {
      $(this).parents('.article-blog').addClass("active");
      changeBodyHeight();
      changeDropdownMenuHeight();
      return false;
    });
    jQuery(".btn_reduce").on("click", function() {
      $(this).parents('.article-blog').removeClass("active");
      changeBodyHeight();
      changeDropdownMenuHeight();
      return false;
    });
    if ((jQuery().placeholder)) {
      $('input, textarea').placeholder();
    }
    jQuery(".btn_slideshow").on("click", function() {
      var filesJSON;
      filesJSON = jQuery.parseJSON($(this).attr('data-files'));
      $.swipebox(filesJSON, {
        hideBarsDelay: 0
      });
      return false;
    });
    if (jQuery("body").hasClass("is_mobile")) {
      jQuery(".btn--close").on("click", function() {
        jQuery(".container-mobile-slide-menu").removeClass("open");
        return jQuery(".container-mobile-slide-menu").addClass("close");
      });
      wrapperSlideMenu = jQuery("<div/>").attr("class", "wrapper-mobile-slide-menu close");
      containerSlideMenu = jQuery("<div/>").attr("class", "container-mobile-slide-menu close");
      jQuery("body").wrapInner(wrapperSlideMenu);
      jQuery("body").wrapInner(containerSlideMenu);
      jQuery(".btn_open-menu").on("click", function() {
        jQuery(".container-mobile-slide-menu").removeClass("close");
        jQuery(".container-mobile-slide-menu").addClass("open");
        return false;
      });
      return jQuery(".nav--mobile .has-dropdown").each(function(e) {
        var $backButton, backLabel;
        backLabel = "Retour";
        if ($(this).hasClass('en')) {
          backLabel = "Back";
        }
        $backButton = $("<li/>").append($("<a/>").attr("class", "btn--return").attr("href", "#").html(backLabel));
        $(this).find(".dropdown").prepend($backButton);
        return $(this).on("click", function(e) {
          if ($(e.target).is($(this).find(".btn--return"))) {
            $(this).find(".dropdown").removeClass("active");
            return false;
          } else if ($(e.target).attr("href") === "#") {
            $(this).find(".dropdown").addClass("active");
            return false;
          }
        });
      });
    }
  });

}).call(this);
