<?php

// Register widgetized areas

if (!function_exists('the_widgets_init')) {
	function the_widgets_init() {
	    if ( !function_exists('register_sidebars') )
	        return;
    //Sidebar
  register_sidebar( array(
		'name' => __( 'Sidebar', 'colabsthemes' ),
		'id' => 'sidebar-widget',
		'description' => __( 'Sidebar widget area', 'colabsthemes' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

    }
}

add_action( 'init', 'the_widgets_init' );


    
?>