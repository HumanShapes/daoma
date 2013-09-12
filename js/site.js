var hasTouch = false;

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
    DAOMA.$_navWrapper = $('#main-nav');
    DAOMA.$_newUser = false;
  },

  init: function(){

    DAOMA.toggleMainNav();
    DAOMA.parallax();
    $('.city').on({
      mouseenter: function(){
        $('.refresh').show();
      },
      mouseleave: function(){
        $('.refresh').hide();
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
  },

  distanceCalc: function(){
    var url = window.location.origin + "/js/cities.json";
    var min = 0;
    var cur_city = $('.city').text();
    var new_city, miles, rand, max;

    $.getJSON(url, function(json) {
      max = json.length;

      do {
        rand = Math.floor(Math.random() * (max - min + 1)) + min;
        new_city = json[rand];
      } while (cur_city == new_city || typeof new_city === "undefined");

      $('.city span').html(new_city['city']);
      $('.miles strong').html(new_city['miles']);

    });

  }

};


// When DOM is ready
$(document).ready(function() {

  // Build daOMA object
  DAOMA.construct();
  DAOMA.init();
  DAOMA.distanceCalc();
});

// Functions that can be delayed after the whole page has been downloaded
$(window).load(function() {
  DAOMA.dropdownMenu();
});
