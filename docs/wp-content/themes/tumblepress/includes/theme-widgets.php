<?php

/*---------------------------------------------------------------------------------*/
/* Loads all the .php files found in /includes/widgets/ directory */
/*---------------------------------------------------------------------------------*/


include( TEMPLATEPATH . '/includes/widgets/widget-colabs-ad-sidebar.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-colabs-adspace125.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-colabs-flickr.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-colabs-search.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-colabs-twitter.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-colabs-tabs.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-colabs-facebook-page.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-colabs-googlemaps.php' );

/*---------------------------------------------------------------------------------*/
/* Deregister Default Widgets */
/*---------------------------------------------------------------------------------*/
if (!function_exists('colabs_deregister_widgets')) {
	function colabs_deregister_widgets(){
	    unregister_widget('WP_Widget_Search');         
	}
}
add_action('widgets_init', 'colabs_deregister_widgets');  


?>