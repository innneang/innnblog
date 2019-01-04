<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 ie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8 ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php if ( function_exists( 'colabs_title') ){ colabs_title(); }else{ echo get_bloginfo('name'); ?>&nbsp;<?php wp_title(); } ?></title>
<?php
	if ( function_exists( 'colabs_meta') ) colabs_meta();
	if ( function_exists( 'colabs_meta_head') )colabs_meta_head(); 
    global $colabs_options;    
?>
   	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />    
    
<?php 
    if ( function_exists( 'colabs_head') ) colabs_head();
    wp_head(); 
?>
</head>

<body>
<div id="page"><!---Page-->
	<div id="header"><!---Header-->
	<?php if ( $colabs_options['colabs_logo_head'] != '' ){ ?>
		<div id="logo"><!---Logo--> 
        	<a href="<?php bloginfo('url'); ?>"><img src="<?php echo $colabs_options['colabs_logo_head']; ?>" alt="<?php bloginfo('name'); ?>" /></a>
        </div>
	<?php } ?>	
		<!---/Logo-->
  
      <a class="btn-navbar collapsed">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      
      <div class="nav-collapse collapse">
      	<div id="navbar1"><!---Navbar Top-->
    			<ul>
      			<li>
      			<a href="<?php echo add_query_arg( 'filter','standard',remove_query_arg('post_format'));?>"><?php echo __('Note','colabsthemes');?></a>
      			</li>
      			<?php wp_list_categories( 'taxonomy=post_format&title_li=&show_option_none=' );?>
    			</ul>
        </div><!---/Navbar Top-->
      </div>
      
		<?php if (is_category() || is_archive() || is_search() || is_tag()){?>
		<div class="post-result">
            <h3><?php dynamictitles();?></h3>
            <a href="#" class="close">&times;</a>
		</div>
		<?php }?>
    </div><!---/Header-->
