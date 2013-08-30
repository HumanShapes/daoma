var hasTouch = false;
$.cookie('newUser', 1);

if (("ontouchstart" in document.documentElement)) {
    document.documentElement.className += " touch";
    hasTouch = true;
}

var DAOMA = {

  log: function (data){
    if( typeof console !== 'undefined'){
       console.log(data);
    }
  },

  construct: function(){
    DAOMA.$_primaryWrapper = $('.fadein_content');
  },

  init: function(){

    DAOMA.toggleMainNav();
    DAOMA.parallax();

    // Mobile functions
    if(hasTouch) { DAOMA.initTouchEvents(); }

  },

  initTouchEvents: function(){
    DAOMA.$_primaryWrapper.on('touchstart touchend', ".btn", DAOMA.toggleMainNav());
  },

  toggleMainNav: function(){
    var $_mainNav = $('#main-nav');
    var $_mainNavBTN = $('#nav-icon');
    DAOMA.$_primaryWrapper.on('click', '#nav-icon', function(){
      $_mainNavBTN.next('ul')
          .slideToggle(300, function(){
            if($_mainNavBTN.hasClass('active')){
              $_mainNavBTN.removeClass('active');
            }else{ $_mainNavBTN.addClass('active'); } // TODO: Add js script to check to see if mediaquery is larger then 830px
          });

    });
  },

  parallax: function(){
    $objWindow = $(window);

    $('div[data-type="background"]').each(function(){
      var $bgObj = $(this);
      $(window).scroll(function() {
        var yPos = -($objWindow.scrollTop() / $bgObj.data('speed'));
        var coords = '0 '+ yPos + 'px';

        $bgObj.css({ backgroundPosition: coords });
      });
    });

    // TODO: convert this to a better running script for parallax images.
    $('[data-type="image"]').each(function(){
      var $imgObj = $(this);
      var $imgObj_yPos = $imgObj.position().top;
      $(window).scroll( function(){
        var yPos = -($objWindow.scrollTop() / $imgObj.data('speed')) + $imgObj_yPos;
        var objPos = $imgObj.position();
        var coords = objPos.left + 'px ' + yPos + 'px';

        $imgObj.css({ left: 'auto', top: yPos + 'px' });
      });

    });

  }


};


// When DOM is ready
$(document).ready(function() {

  // Build daOMA object
  DAOMA.construct();
  DAOMA.init();

});

// Functions that can be delayed after the whole page has been downloaded
$(window).load(function() {

});
