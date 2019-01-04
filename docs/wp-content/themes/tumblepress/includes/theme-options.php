<?php

//Enable CoLabsSEO on these custom Post types
//$seo_post_types = array('post','page');
//define("SEOPOSTTYPES", serialize($seo_post_types));

//Global options setup
add_action('init','colabs_global_options');
function colabs_global_options(){
	// Populate CoLabsThemes option in array for use in theme
	global $colabs_options;
	$colabs_options = get_option('colabs_options');
}

add_action('admin_head','colabs_options');  
if (!function_exists('colabs_options')) {
function colabs_options(){
	
// VARIABLES
$themename = "TumblePress";
$themeslug = "tumblepress";
$manualurl = 'http://colorlabsproject.com';
$shortname = "colabs";

//Access the WordPress Categories via an Array
$colabs_categories = array();  
$colabs_categories_obj = get_categories('hide_empty=0');
foreach ($colabs_categories_obj as $colabs_cat) {
    $colabs_categories[$colabs_cat->cat_ID] = $colabs_cat->cat_name;}
//$categories_tmp = array_unshift($colabs_categories, "Select a category:");

//Access the WordPress Pages via an Array
$colabs_pages = array();
$colabs_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($colabs_pages_obj as $colabs_page) {
    $colabs_pages[$colabs_page->ID] = $colabs_page->post_name; }
//$colabs_pages_tmp = array_unshift($colabs_pages, "Select a page:");       

//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) {
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }
    }
}

//Access the WordPress Categories via an Array
$colabs_portfolios = array();  
$colabs_portfolios_obj = get_categories('hide_empty=0&taxonomy=category_portfolio');
foreach ($colabs_portfolios_obj as $colabs_tax) {
    $colabs_portfolios[$colabs_tax->cat_ID] = $colabs_tax->cat_name;}
//$portfolios_tmp = array_unshift($colabs_portfolios, "Select a portfolio category:");

//More Options
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");

$other_entries_10 = array("Select a number:","1","2","3","4","5","6","7","8","9","10");

$other_entries_4 = array("Select a number:","1","2","3","4");

// THIS IS THE DIFFERENT FIELDS
$options = array();

// General Settings
$options[] = array( "name" => __("General Settings", "colabsthemes" ),
					"type" => "heading",
					"icon" => "general");

$options[] = array( "name" => __("Custom Favicon", "colabsthemes" ),
					"desc" => __("Upload a 16x16px ico image that will represent your website's favicon. Favicon/bookmark icon will be shown at the left of your blog's address in visitor's internet browsers.", "colabsthemes" ),
					"id" => $shortname."_custom_favicon",
					"std" => trailingslashit( get_bloginfo('template_url') ) . "images/favicon.png",
					"type" => "upload"); 
					
$options[] = array( "name" => __("Custom Logo Header", "colabsthemes" ),
					"desc" => __("Upload a logo for your theme at the header, or specify an image URL directly. Best image size in 153x51 px", "colabsthemes" ),
					"id" => $shortname."_logo_head",
					"std" => trailingslashit( get_bloginfo('template_url') ) . "images/logo.png",
					"type" => "upload");

$options[] = array( "name" => __("About Section", "colabsthemes" ),
					"desc" => __("Select about page.", "colabsthemes" ),
					"id" => $shortname."_about_page",
					"type" => "select2",
					"options" => $colabs_pages );

$options[] = array( "name" => __("Enable PressTrends Tracking", "colabsthemes" ),
					"desc" => __("PressTrends is a simple usage tracker that allows us to see how our customers are using our themes, so that we can help improve them for you. <strong>None</strong> of your personal data is sent to PressTrends.", "colabsthemes" ),
					"id" => $shortname."_pt_enable",
					"std" => "true",
					"type" => "checkbox");

/* //Social Settings	 */				
$options[] = array( "name" => __("Social Networking", "colabsthemes" ),
					"icon" => "misc",
					"type" => "heading");

$options[] = array( "name" => __("Twitter", "colabsthemes" ),
					"desc" => __("Enter your Twitter account", "colabsthemes" ),
					"id" => $shortname."_social_twitter",
					"std" => "http://twitter.com/colorlabs",
					"type" => "text");

$options[] = array( "name" => __("Facebook", "colabsthemes" ),
					"desc" => __("Enter your Facebook profile", "colabsthemes" ),
					"id" => $shortname."_social_facebook",
					"std" => "http://www.facebook.com/colorlabs",
					"type" => "text");
					
$options[] = array( "name" => __("Delicious", "colabsthemes" ),
					"desc" => __("Enter your Delicious account", "colabsthemes" ),
					"id" => $shortname."_social_delicious",
					"std" => "http://delicious.com/colorlabs",
					"type" => "text");					

$options[] = array( "name" => __("Stumbleupon", "colabsthemes" ),
					"desc" => __("Enter your Stumbleupon profile", "colabsthemes" ),
					"id" => $shortname."_social_stumbleupon",
					"std" => "http://www.stumbleupon.com/stumbler/colorlabs/",
					"type" => "text");  
					
$options[] = array( "name" => __("LinkedIn", "colabsthemes" ),
					"desc" => __("Enter your LinkedIn profile", "colabsthemes" ),
					"id" => $shortname."_social_linkedin",
					"std" => "http://www.linkedin.com/colorlabs/",
					"type" => "text"); 
					
$options[] = array( "name" => __("Enable/Disable Social Share Button", "colabsthemes" ),
					"desc" => __("Select which social share button you would like to enable on single post & pages.", "colabsthemes" ),
					"id" => $shortname."_single_share",
					"std" => array("fblike","twitter","google_plusone"),
					"type" => "multicheck2",
                    "class" => "",
					"options" => array(
                                    "fblike" => "Facebook Like Button",                                    
                                    "twitter" => "Twitter Share Button",
                                    "google_plusone" => "Google +1 Button",
                                )
                    ); 					

// Open Graph Settings
$options[] = array( "name" => __("Open Graph Settings", "colabsthemes" ),
					"type" => "heading",
					"icon" => "graph");

$options[] = array( "name" => __("Open Graph", "colabsthemes" ),
					"desc" => __("Enable or disable Open Graph Meta tags.", "colabsthemes" ),
					"id" => $shortname."_og_enable",
					"type" => "select2",
                    "std" => "",
                    "class" => "collapsed",
					"options" => array("" => "Enable", "disable" => "Disable") );

$options[] = array( "name" => __("Site Name", "colabsthemes" ),
					"desc" => __("Open Graph Site Name ( og:site_name ).", "colabsthemes" ),
					"id" => $shortname."_og_sitename",
					"std" => "",
                    "class" => "hidden",
					"type" => "text");

$options[] = array( "name" => __("Admin", "colabsthemes" ),
					"desc" => __("Open Graph Admin ( fb:admins ).", "colabsthemes" ),
					"id" => $shortname."_og_admins",
					"std" => "",
                    "class" => "hidden",
					"type" => "text");

$options[] = array( "name" => __("Image", "colabsthemes" ),
					"desc" => __("You can put the url for your Open Graph Image ( og:image ).", "colabsthemes" ),
					"id" => $shortname."_og_img",
					"std" => "",
                    "class" => "hidden last",
					"type" => "text");

//Dynamic Images 					                   
$options[] = array( "name" => __("Thumbnail Settings", "colabsthemes" ),
					"type" => "heading",
					"icon" => "image");
                    
$options[] = array( "name" => __("WordPress Featured Image", "colabsthemes" ),
					"desc" => __("Use WordPress Featured Image for post thumbnail.", "colabsthemes" ),
					"id" => $shortname."_post_image_support",
					"std" => "true",
					"class" => "collapsed",
					"type" => "checkbox");

$options[] = array( "name" => __("WordPress Featured Image - Dynamic Resize", "colabsthemes" ),
					"desc" => __("Resize post thumbnail dynamically using WordPress native functions (requires PHP 5.2+).", "colabsthemes" ),
					"id" => $shortname."_pis_resize",
					"std" => "true",
					"class" => "hidden",
					"type" => "checkbox");
                    
$options[] = array( "name" => __("WordPress Featured Image - Hard Crop", "colabsthemes" ),
					"desc" => __("Original image will be cropped to match the target aspect ratio.", "colabsthemes" ),
					"id" => $shortname."_pis_hard_crop",
					"std" => "true",
					"class" => "hidden last",
					"type" => "checkbox");
                    
$options[] = array( "name" => __("TimThumb Image Resizer", "colabsthemes" ),
					"desc" => __("Enable timthumb.php script which dynamically resizes images added thorugh post custom field.", "colabsthemes" ),
					"id" => $shortname."_resize",
					"std" => "true",
					"type" => "checkbox");
                    
$options[] = array( "name" => __("Automatic Thumbnail", "colabsthemes" ),
					"desc" => __("Generate post thumbnail from the first image uploaded in post (if there is no image specified through post custom field or WordPress Featured Image feature).", "colabsthemes" ),
					"id" => $shortname."_auto_img",
					"std" => "true",
					"type" => "checkbox");
                    
$options[] = array( "name" => __("Thumbnail Image in RSS Feed", "colabsthemes" ),
					"desc" => __("Add post thumbnail to RSS feed article.", "colabsthemes" ),
					"id" => $shortname."_rss_thumb",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => __("Thumbnail Image Dimensions", "colabsthemes" ),
					"desc" => __("Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.", "colabsthemes" ),
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_thumb_w',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_thumb_h',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Height')
								  ));

$options[] = array( "name" => __("Custom Field Image", "colabsthemes" ),
					"desc" => __("Enter your custom field image name to change the default name (default name: image).", "colabsthemes" ),
					"id" => $shortname."_custom_field_image",
					"std" => "",
					"type" => "text");
					
// Analytics ID, RSS feed
$options[] = array( "name" => __("Analytics ID, RSS feed", "colabsthemes" ),
					"type" => "heading",
					"icon" => "statistics");
                    
$options[] = array( "name" => __("Google Analytics", "colabsthemes" ),
					"desc" => __("Manage your website statistics with Google Analytics, put your Analytics Code here. ", "colabsthemes" ),
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => __("Feedburner URL", "colabsthemes" ),
					"desc" => __("Feedburner URL. This will replace RSS feed link. Start with http://.", "colabsthemes" ),
					"id" => $shortname."_feedlinkurl",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => __("Feedburner Comments URL", "colabsthemes" ),
					"desc" => __("Feedburner URL. This will replace RSS comment feed link. Start with http://.", "colabsthemes" ),
					"id" => $shortname."_feedlinkcomments",
					"std" => "",
					"type" => "text");

// Footer Settings
$options[] = array( "name" => __("Footer Settings", "colabsthemes" ),
					"type" => "heading",
					"icon" => "footer");    

$options[] = array( "name" => __("Enable / Disable Custom Credit (Right)", "colabsthemes" ),
					"desc" => __("Activate to add custom credit on footer area.", "colabsthemes" ),
					"id" => $shortname."_footer_credit",
					"class" => "collapsed",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => __("Footer Credit", "colabsthemes" ),
                    "desc" => __("You can customize footer credit on footer area here.", "colabsthemes" ),
                    "id" => $shortname."_footer_credit_txt",
                    "std" => "",
					"class" => "hidden last",                    
                    "type" => "textarea");
/* Contact Form */
$options[] = array( "name" => __("Contact Form", "colabsthemes" ),
					"type" => "heading",
					"icon" => "general");    
$options[] = array( "name" => __("Destination Email Address", "colabsthemes" ),
					"desc" => __("All inquiries made by your visitors through the Contact Form page will be sent to this email address.", "colabsthemes" ),
					"id" => $shortname."_contactform_email",
					"std" => "",
					"type" => "text"); 




// Add extra options through function
if ( function_exists("colabs_options_add") )
	$options = colabs_options_add($options);

if ( get_option('colabs_template') != $options) update_option('colabs_template',$options);      
if ( get_option('colabs_themename') != $themename) update_option('colabs_themename',$themename);   
if ( get_option('colabs_themeslug') != $themeslug) update_option('colabs_themeslug',$themeslug);
if ( get_option('colabs_shortname') != $shortname) update_option('colabs_shortname',$shortname);
if ( get_option('colabs_manual') != $manualurl) update_option('colabs_manual',$manualurl);

//PressTrends
$colabs_pt_auth = "7s6ud8k0mt1d99ar8jdu6na0sutidf68l"; 
update_option('colabs_pt_auth',$colabs_pt_auth);

// CoLabs Metabox Options
// Start name with underscore to hide custom key from the user
$colabs_metaboxes = array();
$colabs_metabox_settings = array();
global $post;

    //Metabox Settings
    $colabs_metabox_settings['post'] = array(
                                'id' => 'colabsthemes-settings',
								'title' => 'ColorLabs' . __( ' Post Format Item Settings', 'colabsthemes' ),
								'callback' => 'colabsthemes_metabox_create',
								'page' => 'post',
								'context' => 'normal',
								'priority' => 'high',
                                'callback_args' => ''
								);
                                    
	

if ( ( get_post_type() == 'post') || ( !get_post_type() ) ) {
	$colabs_metaboxes[] = array (  "name"  => $shortname."_single_author",
					            "std"  => "",
					            "label" => "Author Quote",
					            "type" => "text",
					            "desc" => "Enter the author for the quote");
								
	$colabs_metaboxes[] = array (	"name" => "image",
								"label" => "Post Custom Image",
								"type" => "upload",
								"desc" => "Upload an image or enter an URL.");
	
	$colabs_metaboxes[] = array (  "name"  => $shortname."_embed",
					            "std"  => "",
					            "label" => "Video Embed Code",
					            "type" => "textarea",
					            "desc" => "Enter the video embed code for your video (YouTube, Vimeo or similar)");
					            
} // End post



// Add extra metaboxes through function
if ( function_exists("colabs_metaboxes_add") ){
	$colabs_metaboxes = colabs_metaboxes_add($colabs_metaboxes);
    }
if ( get_option('colabs_custom_template') != $colabs_metaboxes){
    update_option('colabs_custom_template',$colabs_metaboxes);
    }
if ( get_option('colabs_metabox_settings') != $colabs_metabox_settings){
    update_option('colabs_metabox_settings',$colabs_metabox_settings);
    }
     
}
}



?>