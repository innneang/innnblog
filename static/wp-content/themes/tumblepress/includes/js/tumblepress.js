(function($){
$(window).load(function(){

	/* Equal height function
	----------------------------------------------*/
	function equalHeight(group) {
        var tallest = 0;
        group.each(function(){
            var thisHeight = jQuery(this).outerHeight();
            if(thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest);  
    }
	//equalHeight( $('#colabs_twitter-3 li') );
});

$(document).ready(function(){
	
	/* Sooperfish Dropdown menu
	----------------------------------------------*/
	$('#navbar1 ul').sooperfish({
		hoverClass : 'sfHover',
		animationShow : {height:'show'},
		speedShow : 200,
		delay:100,
		animationHide : {height:'hide'},
		speedHide : 200,
		autoArrows : true,
		dualColumn: 1000,
		tripleColumn: 1000
	});
	// Add class to superfish parent
	$('.sf-parent').hover(function(){
		$(this).addClass('sf-hover');
	}, function(){
		$(this).removeClass('sf-hover');
	});
	// Add arrow to dropdown menu
	$('.sf-arrow').html('&rsaquo;');	

  	/* Simple Tooltip for author meta
  	----------------------------------------------*/
  	$('.meta-author').hover(function(){
		$(this).find('.author-description')
			.stop(true, true)
			.animate({
			top: '45px',
			opacity: 'show'
		});
	}, function(){
		$(this).find('.author-description')
			.stop(true, true)
			.animate({
			top: '25px',
			opacity: 'hide'
		});
	});

    /* Close post-result when close button clicked
  	----------------------------------------------*/
    $('.post-result .close').click(function(e){
        e.preventDefault();
        $(this).parent().fadeOut(500);
    });

  /* Mobile nav collapse
  ------------------------------------------------------------------- */
  $('.btn-navbar').click(function(e){
    e.preventDefault();
    var $el = $(this),
        $navCollapse = $el.next('.nav-collapse');

    // If collapsed
    if( $el.hasClass('collapsed') ) {
      $navCollapse.height( $navCollapse.children().outerHeight(true) );
      $el.removeClass('collapsed');
    } else {
      $navCollapse.height(0);
      $el.addClass('collapsed');
    }
  });

});
})(jQuery);
