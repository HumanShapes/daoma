var hasTouch = false;

if (("ontouchstart" in document.documentElement)) {
    document.documentElement.className += " touch";
    hasTouch = true;
}

var BOLD = {
  construct: function(){
    BOLD.$_primaryWrapper = $('.primary');
  },

  init: function(){
    //BOLDsharePopup.init();
    newsletterValidate();
  },

  fbs_click: function(width, height) {
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
    u=location.href;
    t=document.title;
    window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer', windowFeatures);
    return false;
  },

  bold_calendar_buttons: function() {
    // Just check to see which buttons should be visible
    if ( $('.calendar .month:last').is(':visible') ) {
      $('.calendar .btn-next').css("visibility", 'hidden');
    } else {
      $('.calendar .btn-next').css("visibility", 'visible');
    }
    if ( $('.calendar .month:first').is(':visible') ) {
      $('.calendar .btn-prev').css("visibility", 'hidden');
    } else {
      $('.calendar .btn-prev').css("visibility", 'visible');
    }
  },

  bold_events_calendar: function() {
    var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    for (var i = 0; i < 12; i++) {
      month = months[i];
      var eventCount = $('.event[rel="'+month+'"]').size();
      var $monthContainer = $('.month[rel="'+month+'"] ul');
      if (eventCount >= 1) {
        $('.event[rel="'+month+'"]').each(function(){
          $(this).appendTo($monthContainer);
        });
      } else {
        $monthContainer.append('<p class="no-events">There are no events at this time.</p>');
      }
    }
    // Button actions
    $('.calendar .btn-next').click(function(){
      $('.calendar .month:visible').eq(1).hide().prev().hide().end().next().show().next().show();
      BOLD.bold_calendar_buttons();
      return false;
    });
    $('.calendar .btn-prev').click(function(){
      $('.calendar .month:visible').eq(0).hide().next().hide().end().prev().show().prev().show();
      BOLD.bold_calendar_buttons();
      return false;
    });
  },

  log: function (data){
    if( typeof console !== 'undefined'){
       console.log(data);
    }
  }
};

var combineShareCount = {
  combine: function(){
    $('.socialcount').each(function() {
      var totalCount;
      var number = 0;
      $(this).find('.count').each(function() {
        if ( $(this).text() ) {
          var number = parseInt( $(this).text() );
          totalCount = totalCount + number;
        }
      });
      $(this).parents('.social-share').find('.btn-share').text(totalCount);
    });
  }
};

$(document).ready(function() {
  var slider = $('.slides').unslider({
    delay: 10000,
    speed: 500,
    dots: true,
    fluid: true,
    loop: 0,
    items: '>div',
    item: '>div',
    activeClass : 'active',
    complete: function(e) {
      var slideNum = $('li.active').index();
      $('.slides-text p').hide();
      $('.slides-text p').eq(slideNum).show();
    }
  });
    
  $('.dots').each(function() {
    if ($(this).children('li').length < 2) {
      $(this).hide();
    }
  });

  $('#search').on('click', 'label', function(){
    if($('#search').hasClass('is-active')){
      $('#search').removeClass('is-active').find("input")
        .animate({
          width: '0'
        }, 300);
    }else{
      $('#search').addClass('is-active').find("input")
        .animate({
          width: '140px'
        }, 300);
    }
  });

  $('.meta-filters').waypoint('sticky', {
    wrapper: '<div class="filter-wrap" />'
  });

  $('.mobile-menu-icon').on('click', function(e){
    e.preventDefault();
    $('body').toggleClass('show-mobile-nav');
  });

  $('.b-logo').on('mouseenter', function() {
    $(this).toggleClass('is-depressed');
    if ($(".b-logo.is-depressed").length == $(".b-logo").length) {
      $('.b-logo').removeClass('is-depressed');
    }
  });

  $('nav.next-prev').on({
    mouseenter: function(){
      var $btn = $(this);
      var $msg = $btn.siblings('.msg');
      switch($btn.find('p').attr('class')){
        case "btn-next":
          $msg.html('<span>next</span>');
          break;
        case "btn-prev":
          $msg.html('<span>previous</span>');
          break;
      }
    },
    mouseleave: function(){
      $(this).siblings('.msg').html('&nbsp;');
    }
  }, 'a');

  $('#newsletter form').validate({
    /* This removes the default error messages */
    errorPlacement: function() {
      return true;
    },
    onfocusout: false,
    rules: {
      name: {
        required: true
      },
      email: {
        required: true,
        email: true
      },
      zip: {
        required: true,
        minlength: 5,
        number: true
      }
    },
    showErrors: function(errorMap, errorList) {
        $(".form-errors").html("All fields must be completed correctly.").show();
    },
    submitHandler: function(form) {
      $(".form-errors").hide();
      $(".submit-element span").show();

      var name = $('#name').val();
      var email = $('#email').val();
      var zip = $('#zip').val();
      var $url = window.location.origin + '/wp-content/themes/albion/partials/newsletter-submit.php';

      var dataString = 'name='+ name + '&email=' + email + '&zip=' + zip;

      $(form).ajaxSubmit({
        type: 'POST',
        url: $url,
        data: dataString,
        success: function() {

          $('#newsletter h1:eq(0)').fadeOut('fast');
          $(form).fadeOut('fast', function(){
            $('.response').fadeIn('fast');
          });

          setTimeout(function() {
            $('.response').fadeOut('fast', function(){
              $(form).fadeIn(400);
              $(form).resetForm();
              $('#newsletter h1:eq(0)').fadeIn(400);
            });

          }, 10000);
        }
      });
    }
  });

  BOLD.bold_events_calendar();

});

// Functions that can be delayed after the whole page has been downloaded
$(window).load(function() {
  // shareLink.init();
  combineShareCount.combine();
});
