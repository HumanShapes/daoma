var hasTouch = false;


if (("ontouchstart" in document.documentElement)) {
  document.documentElement.className += " touch";
  hasTouch = true;
}

var Cities = [
  ["New York","1,246.3"],
  ["San Francisco","1,677.8"],
  ["Portland","1,653.0"],
  ["Los Angeles","1,548.9"],
  ["Chicago","472.3"],
  ["Brooklyn","1,253.6"],
  ["Toronto","976.2"]
];

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

    $('.fadeout_opening').addClass('is-hidden');
    window.setTimeout(function() {
      $('.fadeout_opening').addClass('is-removed');
    }, 800);

    DAOMA.toggleMainNav();
    DAOMA.parallax();
    $('.refresh, .city').on('click', function(){
      $('.refresh').addClass('is-acting');
      $('.miles strong').fadeOut(200);
      $('.city span').fadeOut(200, function(){
        DAOMA.distanceCalc();
      });
    });
  },

  initTouchEvents: function(){
    DAOMA.$_navWrapper.on('touchstart', ".btn", DAOMA.toggleMainNav());
  },

  toggleMainNav: function(){
    var $_mainNav = $('#main-nav');
    var $_mainNavBTN = $('#nav-icon');
    DAOMA.$_navWrapper.on('click', '#nav-icon', function(){
      DAOMA.log('click');
      $_mainNavBTN.next('nav').children('ul')
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
    var min = 0;
    var cur_city = $('.city span').text();
    var new_city;

    new_city = Cities[0];

    $('.city span').html(new_city[0]).fadeIn();
    $('.miles strong').html(new_city[1]).fadeIn(200, function(){
      $('.refresh').removeClass('is-acting');
    });

    Cities.shift();// Pull off first city
    Cities.push(new_city); // put first city at end
  }

};


// When DOM is ready
$(document).ready(function() {
  // Build daOMA object
  DAOMA.construct();
  DAOMA.init();
  var creativeClass = $('.creative-class');
  if(hasTouch){
    creativeClass.on('click', function(){
      this.css('background-color', '#fff');
      this.children('.content').fadeTo(0);
    });
  }

  var clip = new ZeroClipboard( $(".copy-link"), {
    moviePath: "/wp-content/themes/daoma/js/vendor/ZeroClipboard.swf"
  } );

  clip.on( 'load', function(client) {
    // alert( "movie is loaded" );
  } );

  clip.on( 'complete', function(client, args) {
    this.style.display = "none"; // "this" is the element that was clicked
    alert("Copied text to clipboard: " + args.text );

  } );

  $('.copy-link').on('click', function(){

  });

});

// Functions that can be delayed after the whole page has been downloaded
$(window).load(function() {
  DAOMA.dropdownMenu();
});
