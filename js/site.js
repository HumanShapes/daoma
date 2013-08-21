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
  },

  init: function(){

    DAOMA.toggleMainNav();

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
