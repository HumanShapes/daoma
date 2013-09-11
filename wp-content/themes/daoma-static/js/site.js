var hasTouch = false;


if (("ontouchstart" in document.documentElement)) {
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
    DAOMA.$_navWrapper = $('#main-nav');
    DAOMA.$_newUser = false;
  },

  init: function(){

    DAOMA.toggleMainNav();
    DAOMA.parallax();
    $('.city').on({
      mouseenter: function(){
        $('.refresh').toggle();
      },
      mouseleave: function(){
        $('.refresh').toggle();
      }
    });

  },

  initTouchEvents: function(){
    DAOMA.$_navWrapper.on('touchstart', ".btn", DAOMA.toggleMainNav());
  },

  toggleMainNav: function(){
    var $_mainNav = $('#main-nav');
    var $_mainNavBTN = $('#nav-icon');
    DAOMA.$_navWrapper.on('click', '#nav-icon', function(){
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
        var coords;
        if($bgObj.hasClass('right')){
          coords = '100% '+ yPos + 'px';
        }else{
          coords = '0 '+ yPos + 'px';
        }
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

  },

  dropdownMenu: function(){
    $(window).resize(function(){
      var $w = $(window).width();
      if( $w >= '830'){
        $('#main-nav ul').css("display", "");
      }
    });
  }

  // homeFadeIn: function(){
  //   if($.cookie('newUser')){
  //     DAOMA.log($.cookie('newUser') + " returning");
  //   }else{
  //     // $('.fadein_content').css({opacity: 0});
  //     $('.fadein_content').hide();
  //     $('.fadeout_opening').show();
  //     $.cookie('newUser', '0', { expires: 7, path: '/' });
  //     $('.fadeout_opening').fadeOut(2000, function(){
  //       $(this).hide();
  //     });
  //     $('.fadein_content').fadeIn(1500);
  //     DAOMA.log($.cookie('newUser') + " new");
  //   }
  // }
};


// When DOM is ready
$(document).ready(function() {

  // Build daOMA object
  DAOMA.construct();
  DAOMA.init();

});

// Functions that can be delayed after the whole page has been downloaded
$(window).load(function() {
  DAOMA.dropdownMenu();
});
