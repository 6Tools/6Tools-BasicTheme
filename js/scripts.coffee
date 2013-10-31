# Fichier principal de scripts en coffeescript
# Idealement il pourrait inclure d'autre fichier .coffee lors de la compilation
# pour decomposer les taches en plusieurs fichiers
# 
# @author : mOveo

#include 'generic.coffee'

jQuery ($) ->
  
  #Searchform hidden
  #@author : mOveo
  #usage : add class searchform--compact
  searchform = $ ".searchform--compact form"
  input = searchform.find(".input-text")
  #input.hide()
  searchform.on "submit", ->
    if searchform.hasClass "close"
      #searchform.css 'width', '100%'
      searchform.removeClass "close"
      searchform.addClass "open"
      input.focus()
      false
    
    else
      #input.hide()
      searchform.removeClass "open"
      searchform.addClass "close"
      
      if input.val() != ""
        searchform.submit()
      else
        false
  
  
  #Anchor with animation
  #@author : mOveo
  #usage : add class anchor--scroll
  scroll = $ "a.anchor--scroll"
  scroll.on "click", ->
    currentHref = $($(this).attr 'href')
    jQuery('html, body').animate scrollTop:currentHref.offset().top, 1200 if currentHref.length > 0
    false
    
    
    
  #Open / Close content
  #@author : mOveo
  
  jQuery( ".btn--open-close" ).on "click", ->
    parentEl = $(this).parent()
    
    if parentEl.hasClass "close"
      parentEl.removeClass "close"
      parentEl.addClass "open"
    else
      parentEl.removeClass "open"
      parentEl.addClass "close"
    false
    
    
    
  #Menu MultiLevelPush
  #jQuery(".current-menu-ancestor .dropdown").addClass("active");
  jQuery(".nav--main .has-dropdown").each (e) ->
    backLabel = "Retour"
    if $(this).hasClass('en')
      backLabel = "Back"
    $backButton = $("<li/>").append($("<a/>").attr("class", "btn--return").attr("href" , "#").html(backLabel));
    $(this).find(".dropdown").prepend( $backButton )
      
    $(this).on "click", (e) ->
      if $(e.target).is $(this).find(".btn--return")
        $(this).find(".dropdown").removeClass("active")
        false
      else if $(e.target).attr("href") == "#"
        $(this).find(".dropdown").addClass("active")
        false
        
        
  #Dropdown menu height
  changeDropdownMenuHeight = ->
    if $(".nav--main").length > 0
      bodyHeight = $("body").height()
      menuTop = Math.floor $(".nav--main").offset().top + 1
      $(".dropdown").height(bodyHeight - menuTop)
    
      
  #Main content full height
  contentHeight = $(".content--secondary").height()
  $("body").css("height", "auto");
  changeBodyHeight = ->
  $("body").css("height", "auto");
  bodyHeight = $("body").height();

  if(bodyHeight < $(window).height())
      bodyHeight = $(window).height()

  $("body").css("height", bodyHeight + "px");
  changeDropdownMenuHeight()
    
  changeBodyHeight()
  
  $( window ).resize( _.debounce( changeBodyHeight, 500 ) );
  
  $(window).load ->
    changeBodyHeight()
  
  
  #Display all references
  jQuery(".btn__all-view").on "click", ->
    false
    
  #Readmore button
  jQuery(".btn_readmore").on "click", ->
    $(this).parents('.article-blog').addClass "active"
    changeBodyHeight()
    changeDropdownMenuHeight()
    false
    
  jQuery(".btn_reduce").on "click", ->
    $(this).parents('.article-blog').removeClass "active"
    changeBodyHeight()
    changeDropdownMenuHeight()
    false
  
  if(jQuery().placeholder) 
    $('input, textarea').placeholder();
    
    
  #Fullscreen slideshow
  jQuery(".btn_slideshow").on "click", ->
    filesJSON = jQuery.parseJSON($(this).attr 'data-files')
    $.swipebox(filesJSON,{hideBarsDelay : 0});
    false
    
    
  #Mobile slide menu
  if jQuery("body").hasClass "is_mobile"
  
    jQuery(".btn--close").on "click", ->
      jQuery(".container-mobile-slide-menu").removeClass "open"
      jQuery(".container-mobile-slide-menu").addClass "close"
      
      
    wrapperSlideMenu = jQuery("<div/>").attr "class", "wrapper-mobile-slide-menu close"
    containerSlideMenu = jQuery("<div/>").attr "class", "container-mobile-slide-menu close"
    jQuery("body").wrapInner(wrapperSlideMenu)
    jQuery("body").wrapInner(containerSlideMenu)
    
    jQuery(".btn_open-menu").on "click", ->
      jQuery(".container-mobile-slide-menu").removeClass "close"
      jQuery(".container-mobile-slide-menu").addClass "open"
      false
      
    jQuery(".nav--mobile .has-dropdown").each (e) ->
      backLabel = "Retour"
      if $(this).hasClass('en')
        backLabel = "Back"
      $backButton = $("<li/>").append($("<a/>").attr("class", "btn--return").attr("href" , "#").html(backLabel));
      $(this).find(".dropdown").prepend( $backButton )
      $(this).on "click", (e) ->
        if $(e.target).is $(this).find(".btn--return")
          $(this).find(".dropdown").removeClass("active")
          false
        else if $(e.target).attr("href") == "#"
          $(this).find(".dropdown").addClass("active")
          false