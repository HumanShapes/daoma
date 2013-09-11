// ajaxLoop.js
jQuery(function($){
  var page = 1;
  var stateObj = { page: "BOLD News" };
  var currPage = window.location.pathname.split( 'page/' );
  var dirs = currPage[0].split( '/' );
  if (currPage[1]) {
    page = currPage[1].replace(/\//g,'');
  }
  var baseDir = dirs[1];
  var postType;
  if (baseDir == 'actions') {
    // right now we only allow for actions and posts, if we need more then this needs reworked
    postType = 'actions';
  } else {
    postType = 'post';
  }

  // Check if it's a date archive
  var loopYear = null;
  var loopMonth = null;
  var isnum = /^\d+$/.test(postType);
  if (isnum) {
    // It's a date archive
    loopYear = loopDate[1];
    loopMonth = loopDate[2];
  }

  // Check if it's a tag archive
  var tag;
  var category;
  if (baseDir == 'tag') {
    tag = dirs[2];
  } else if (baseDir == 'category') {
    category = dirs[2];
  }

  var loading = false;
  var $window = $(window);
  var $content = $("body .primary > .posts");
  var load_posts = function(){
      $.ajax({
        type     : "GET",
        data     : {numPosts: 10, pageNumber: page, postType: postType, year: loopYear, month: loopMonth, postTag: tag, postCategory: category},
        dataType   : "html",
        url    : window.location.origin + "/wp-content/themes/albion/loop-handler.php",
        beforeSend : function(){
         		//
        },
        success  : function(data){
          $data = $($.parseHTML(data));
          if($data.length){
            $data.hide();
            $content.append(data);
            history.pushState(stateObj, "Page "+page+"", currPage[0]+"page/"+page+"/");
            $data.fadeIn(500, function(){
              $("#temp_load").remove();
              loading = false;
            });
            combineShareCount.combine();
          } else {
            $('#load-more-posts').remove();
          }
        },
        error   : function(jqXHR, textStatus, errorThrown) {
          alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }
    });
  }
  $('#load-more-posts').click(function(e) {
      $('.js-unhide-before-trying-ajax').show();
      if(!loading) {
      	loading = true;
      	page++;
      	load_posts();
      	loading = false;
      }
    // }
	  e.preventDefault();
  });
});