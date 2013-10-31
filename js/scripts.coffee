# Fichier principal de scripts en coffeescript
# Idealement il pourrait inclure d'autre fichier .coffee lors de la compilation
# pour decomposer les taches en plusieurs fichiers
# 
# @author : mOveo

#include 'generic.coffee'

jQuery ($) ->
  
  #Anchor with animation
  #@author : mOveo
  #usage : add class anchor--scroll
  scroll = $ "a.anchor--scroll"
  scroll.on "click", ->
    currentHref = $($(this).attr 'href')
    jQuery('html, body').animate scrollTop:currentHref.offset().top, 1200 if currentHref.length > 0
    false