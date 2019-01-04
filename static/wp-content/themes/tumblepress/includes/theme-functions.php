<?php 
//PLEASE UPDATE TABLE OF CONTENTS ON FUNCTIONS ADDED / REMOVED
/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Excerpt
- Page navigation
- CoLabsTabs - Popular Posts
- CoLabsTabs - Latest Posts
- CoLabsTabs - Latest Comments
- Post Meta
- Dynamic Titles
- WordPress 3.0 New Features Support
- using_ie - Check IE
- post-thumbnail - WP 3.0 post thumbnails compatibility
- automatic-feed-links Features
- Twitter button - twitter
- Facebook Like Button - fblike
- Facebook Share Button - fbshare
- Google +1 Button - [google_plusone]
-- Load Javascript for Google +1 Button
- colabs_link - Alternate Link & RSS URL
- Open Graph Meta Function
- colabs_share - Twitter, FB & Google +1
- Post meta Portfolio

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* SET GLOBAL CoLabs VARIABLES
/*-----------------------------------------------------------------------------------*/

// Slider Tags
  $GLOBALS['slide_tags_array'] = array();
// Duplicate posts 
  $GLOBALS['shownposts'] = array();
  
  
/*-----------------------------------------------------------------------------------*/
/* Excerpt
/*-----------------------------------------------------------------------------------*/

//Add excerpt on pages
if(function_exists('add_post_type_support'))
add_post_type_support('page', 'excerpt');

/** Excerpt character limit */
/* Excerpt length */
function colabs_excerpt_length($length) {
if( get_option('colabs_excerpt_length') != '' ){
        return get_option('colabs_excerpt_length');
    }else{
        return 100;
    }
}
add_filter('excerpt_length', 'colabs_excerpt_length');

/** Remove [..] in excerpt */
function colabs_trim_excerpt($text) {
  return rtrim($text,'[...]');
}
add_filter('get_the_excerpt', 'colabs_trim_excerpt');

/** Add excerpt more */
function colabs_excerpt_more($more) {
    global $post;
  return '<span class="more"><a href="'. get_permalink($post->ID) . '">'. __( 'Read more', 'colabsthemes' ) . '&hellip;</a></span>';
}
//add_filter('excerpt_more', 'colabs_excerpt_more');

// Shorten Excerpt text for use in theme
function colabs_excerpt($text, $chars = 120) {
  $text = $text." ";
  $text = substr($text,0,$chars);
  $text = substr($text,0,strrpos($text,' '));
  $text = $text."...";
  return $text;
}

//Custom Excerpt Function
function excerpt($limit,$text) {
  global $post;
  
  $output = $post->post_excerpt;
  if ($output!=''){
  $excerpt = $output;
  }else{
  $excerpt = explode(' ',get_the_excerpt(), $limit);
  array_pop($excerpt);
  $excerpt = implode(" ",$excerpt).$text;
  }
  echo $excerpt;
}

// get_the_excerpt filter
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_trim_excerpt');

function custom_trim_excerpt($text) { // Fakes an excerpt if needed
global $post;
  if ( '' == $text ) {
    $text = get_the_content('');

    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 45);
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words) > $excerpt_length) {
      array_pop($words);
            $excerpt_more = apply_filters('excerpt_more', '...');
      array_push($words, '...');
            array_push($words, $excerpt_more);
      $text = implode(' ', $words);
    }
  }
  return $text;
}


/*-----------------------------------------------------------------------------------*/
/* Breadcrumbs */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('the_breadcrumb')){
function the_breadcrumb() {
     echo 'You are here: ';
     if (!is_home()) {
         echo '<a href="';
         echo get_option('home');
         echo '">';
         echo 'Home';
         echo "</a>  ";
    
         if (is_single()) {    
               echo the_title();
         } elseif (is_page()) {
            echo the_title();
         }
         elseif (is_tag()) {
            single_tag_title();
         }
         elseif (is_day()) {
            echo "Archive for "; the_time('F jS, Y');
         }
         elseif (is_month()) {
            echo "Archive for "; the_time('F, Y');
         }
         elseif (is_year()) {
            echo "Archive for "; the_time('Y');
         }
         elseif (is_author()) {
            echo "Author Archive";
         }
         elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
            echo "Blog Archives";
         }
         elseif (is_search()) {
            echo "Search Results : ";
      the_search_query();
         }
         elseif (is_404()) {
            echo "404 Error";
         }
      elseif (is_category()) {
           $category = get_the_category();
       echo $category[0]->cat_name;
         }
     elseif (is_tax()) {
          $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
      echo $term->name;
         }
     }else{
        echo '<a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo "</a>";
     }
}}

/*End of Breadcrumbs*/


/*-----------------------------------------------------------------------------------*/
/* Page navigation */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('colabs_pagenav')) {
  function colabs_pagenav() {
  
    if (function_exists('wp_pagenavi') ) { ?>
      
  <?php wp_pagenavi(); ?>
      
    <?php } else { ?>    
      
      <?php if ( get_next_posts_link() || get_previous_posts_link() ) { ?>

                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Previous Entries', 'colabsthemes' ) ); ?></div>
                <div class="nav-next"><?php previous_posts_link( __( 'Next Entries <span class="meta-nav">&raquo;</span>', 'colabsthemes' ) ); ?></div>

      <?php } ?>

    <?php }
  }
}

if (!function_exists('colabs_postnav')) {
  function colabs_postnav() {
    ?>
    <div class="navigation">
        <div class="navleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
        <div class="navright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
        <div class="clear"></div>
    </div><!--/.navigation-->
    <?php 
  }
}


/*-----------------------------------------------------------------------------------*/
/* CoLabs 404 */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('colabs_404')) {
  function colabs_404(){
?>
        <div class="content clearfloat"><!---Post-->
          <div class="title"><!---Title Post-->
          <h2 class="post-title"><?php _e('No posts found. Try a different search?','colabsthemes');?></h2>
      </div>
    </div>

<?php    
  }
}



/*-----------------------------------------------------------------------------------*/
/* CoLabsTabs - Popular Posts */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('colabs_tabs_popular')) {
  function colabs_tabs_popular( $posts = 5, $size = 35 ) {
    global $post;
    $size=0;
    $args = array(
    'showposts' => $posts,
    'caller_get_posts' => 1,
    'orderby' => 'comment_count',
      'tax_query' => array(
              array( 'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array('post-format-quote','post-format-link'),
                    'operator' => 'NOT IN'
                    )
              )
      );
    query_posts( $args );
    while ( have_posts() ) : the_post(); 
  ?>
  <li>
    <?php if ($size <> 0) {
    if(colabs_image('return=true&link=url')!=''){
    colabs_image('height='.$size.'&width='.$size.'&class=thumbnail&single=true'); 
    }else{
    $noimg=get_bloginfo( 'template_url').'/images/noimage.jpg';
    ?>
    <img src="<?php echo get_template_directory_uri(); ?>/scripts/timthumb.php?src=<?php echo $noimg; ?>&amp;w=<?php echo $size; ?>&amp;h=<?php echo $size; ?>&amp;zc=1" alt="image" width="<?php echo $size; ?>px" height="<?php echo $size; ?>px"/>
    <?php }}?>
    <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
    
  </li>
  <?php endwhile;
  }
}


/*-----------------------------------------------------------------------------------*/
/* CoLabsTabs - Latest Posts */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('colabs_tabs_latest')) {
  function colabs_tabs_latest( $posts = 5, $size = 35 ) {
    global $post;
    $size=0;
    $args = array(
    'showposts' => $posts,
    'caller_get_posts' => 1,
    'orderby' => 'post_date',
    'order' => 'desc',
      'tax_query' => array(
              array( 'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array('post-format-quote','post-format-link'),
                    'operator' => 'NOT IN'
                    )
              )
      );
    query_posts( $args );
    while ( have_posts() ) : the_post(); 
  ?>
  <li>
    <?php if ($size <> 0) {
    if(colabs_image('return=true&link=url')!=''){
    colabs_image('height='.$size.'&width='.$size.'&class=thumbnail&single=true'); 
    }else{
    $noimg=get_bloginfo( 'template_url').'/images/noimage.jpg';
    ?>
    <img src="<?php echo get_template_directory_uri(); ?>/scripts/timthumb.php?src=<?php echo $noimg; ?>&amp;w=<?php echo $size; ?>&amp;h=<?php echo $size; ?>&amp;zc=1" alt="image" width="<?php echo $size; ?>px" height="<?php echo $size; ?>px"/>
    <?php }}?>
    <div class="tabright">
    <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
    <span class="meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
    </div>
  </li>
  <?php endwhile; 
  }
}


/*-----------------------------------------------------------------------------------*/
/* CoLabsTabs - Latest Comments */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('colabs_tabs_comments')) {
  function colabs_tabs_comments( $posts = 5, $size = 35 ) {
    global $wpdb;
    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
    comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
    comment_type,comment_author_url,
    SUBSTRING(comment_content,1,50) AS com_excerpt
    FROM $wpdb->comments
    LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
    $wpdb->posts.ID)
    WHERE comment_approved = '1' AND comment_type = '' AND
    post_password = ''
    ORDER BY comment_date_gmt DESC LIMIT ".$posts;
    
    $comments = $wpdb->get_results($sql);
    
    foreach ($comments as $comment) {
    ?>
    <li>
      <?php echo get_avatar( $comment, $size ); ?>
      <div class="tabright">
      <a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php _e('on ', 'colabsthemes'); ?> <?php echo $comment->post_title; ?>">
                <span class="author"><?php echo strip_tags($comment->comment_author); ?></span></a>: <span class="comment"><?php echo strip_tags($comment->com_excerpt); ?>...</span>
      
      </div>
    </li>
    <?php 
    }
  }
}


/*-----------------------------------------------------------------------------------*/
/* Post Meta */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('colabs_post_meta')) {
  function colabs_post_meta( ) {
?>
    <div class="date"> 
    Author :<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a> &nbsp; &nbsp; 
    <?php if(is_single() || is_category()){?>
        Category : <?php the_category(', ') ?>  &nbsp; &nbsp; 
    <?php }?>
        <span class="date-t">
            <?php the_time('j M ') ?> | <a href="<?php the_permalink(); ?>#comments">
            <?php comments_number('No Comments', '1 Comment', '% Comments'); ?></a>   
            <?php edit_post_link('Edit', '', '  '); ?>
        </span>
    </div>
<?php 
  }
}


/*-----------------------------------------------------------------------------------*/
/* Dynamic Titles */
/*-----------------------------------------------------------------------------------*/
// This sets your <title> depending on what page you're on, for better formatting and for SEO

function dynamictitles() {
  
if ( is_author() ) {
      
      wp_title(__('Author','colabsthemes').'');  
    echo '<span class="topic-cat">';
    the_author_posts_link();
    echo '</span>';
    
} else if ( is_category() ) {
      echo (__('Topic','colabsthemes').'');
    echo '<span class="topic-cat">';
      wp_title('');
    echo '</span>'; 

} else if ( is_tag() ) {
     
      echo (__('Tag archive for','colabsthemes').'');
    echo '<span class="topic-cat">';
      wp_title('');
    echo '</span>';
} else if ( is_tax() ) {
      echo (__('Format Post for ','colabsthemes'));
    echo '<span class="topic-cat">';
    if(get_query_var('filter') != "standard") {
    echo ucwords(get_post_format());
    }else{
    echo (__('Note','colabsthemes').'');
    }
    echo '</span>';
} else if ( is_archive() ) {
      
      echo (__('Archive for','colabsthemes').'');
    echo '<span class="topic-cat">';
      wp_title('');
    echo '</span>';
} else if ( is_search() ) {
      
      echo (__('Search Results for','colabsthemes'));
    echo '<span class="topic-cat">';
    the_search_query();
    echo '</span>';
} else if ( is_404() ) {
      
      echo (__('404 Error (Page Not Found)','colabsthemes').'');
    
} 
}


/*-----------------------------------------------------------------------------------*/
/* WordPress 3.0 New Features Support */
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_nav_menus') ) {
  add_theme_support( 'nav-menus' );
    register_nav_menus( array(
  'bottommenu' =>__('bottom menu')
) );    
}

/* CallBack functions for menus in case of earlier than 3.0 Wordpress version or if no menu is set yet*/
function primarymenu(){ ?>
    <div id="top-menu" class="ddsmoothmenu">
    <ul class="menu" id="menu-menu">
        <li><div> Go to Admin > Appearance > Menus to set up the menu. </div></li>
        </ul>
  </div>
<?php }
if (!function_exists('colabs_nav')) {

function colabs_nav($div_id) {

    if ( function_exists( 'wp_nav_menu' ) )

        if ( $div_id == 'foot-menu' )

        wp_nav_menu('menu_id=&fallback_cb=colabs_nav_fallback&theme_location='.$div_id.'&depth=1&after=');

        else

        wp_nav_menu('menu_class=&menu_id=&fallback_cb=colabs_nav_fallback&theme_location='.$div_id);

    else

        colabs_nav_fallback($div_id);

}}

if (!function_exists('colabs_nav_fallback')) {
function colabs_nav_fallback($div_id){
    if (is_array($div_id)){ $div_id = $div_id['theme_location']; }
    if ( $div_id == 'main-menu' ){
        wp_page_menu('&depth=0&title_li=');
    };
    if ( $div_id == 'footer' || $div_id == 'top' ){
        wp_page_menu('show_home='.__('Home','colabsthemes').'&depth=1&title_li=&menu_class=menu left');
        };
}}


/*-----------------------------------------------------------------------------------*/
/* using_ie - Check IE */
/*-----------------------------------------------------------------------------------*/
//check IE
function using_ie()
{
    if (isset($_SERVER['HTTP_USER_AGENT']) && 
    (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
        return true;
    else
        return false;    
}


/*-----------------------------------------------------------------------------------*/
/*  WP 3.0 post thumbnails compatibility */
/*-----------------------------------------------------------------------------------*/
if(function_exists( 'add_theme_support')){
  //if(get_option( 'colabs_post_image_support') == 'true'){
    if( get_option('colabs_post_image_support') ){
        add_theme_support( 'post-thumbnails' );   
    // set height, width and crop if dynamic resize functionality isn't enabled
    if ( get_option( 'colabs_pis_resize') <> "true" ) {
      $hard_crop = get_option( 'colabs_pis_hard_crop' );
      if($hard_crop == 'true') {$hard_crop = true; } else { $hard_crop = false;} 
      add_image_size( 'content-thumb', 155, 98, $hard_crop);
      add_image_size( 'big-thumb', 455, 291, $hard_crop);
      add_image_size( 'sidebar-thumb', 260, 195, $hard_crop);
      
    }
  }
} 


/*-----------------------------------------------------------------------------------*/
/*  automatic-feed-links Features  */
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) && get_option('colabs_feedlinkurl') == '' ) {
add_theme_support( 'automatic-feed-links' );
}


/*-----------------------------------------------------------------------------------*/
/* colabs_link - Alternate Link & RSS URL */
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_head', 'colabs_link' );
if (!function_exists('colabs_link')) {
function colabs_link(){ 
?>  
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('colabs_feedlinkurl') ) { echo get_option('colabs_feedlinkurl'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
  <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/includes/css/slider.css" />
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/includes/css/dropdown.css" />
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/includes/css/picbox/picbox.css" />
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/includes/css/fancybox/jquery.fancybox-1.3.4.css" />
<?php 
}}


/*-----------------------------------------------------------------------------------*/
/*  Open Graph Meta Function    */
/*-----------------------------------------------------------------------------------*/
function colabs_meta_head(){
    do_action( 'colabs_meta' );
}
add_action( 'colabs_meta', 'og_meta' );  

if (!function_exists('og_meta')) {
function og_meta(){ ?>
  <?php if ( is_home() && get_option( 'colabs_og_enable' ) == '' ) { ?>
  <meta property="og:title" content="<?php echo bloginfo('name');; ?>" />
  <meta property="og:type" content="author" />
  <meta property="og:url" content="<?php echo get_option('home'); ?>" />
  <meta property="og:image" content="<?php echo get_option('colabs_og_img'); ?>"/>
  <meta property="og:site_name" content="<?php echo get_option('colabs_og_sitename'); ?>" />
  <meta property="fb:admins" content="<?php echo get_option('colabs_og_admins'); ?>" />
  <meta property="og:description" content="<?php echo get_option('blogdescription '); ?>" />
  <?php } ?>
  
  <?php if ( ( is_page() || is_single() ) && get_option( 'colabs_og_enable' ) == '' ) { ?>
  <meta property="og:title" content="<?php the_title(); ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="<?php echo get_post_meta($post->ID, 'yourls_shorturl', true) ?>" />
  <meta property="og:image" content="<?php $values = get_post_custom_values("Image"); ?><?php echo get_option('home'); ?>/<?php echo $values[0]; ?>"/>
  <meta property="og:site_name" content="<?php echo get_option('colabs_og_sitename'); ?>" />
  <meta property="fb:admins" content="<?php echo get_option('colabs_og_admins'); ?>" />
  <?php } ?>
    
    <meta name="viewport" content="width=1024,maximum-scale=1.0" />
<?php
}}


/*-----------------------------------------------------------------------------------*/
/*  colabs_share - Twitter, FB & Google +1    */
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'colabs_share' ) ) {
function colabs_share() {
    
$return = '';


$colabs_share_twitter = get_option('colabs_single_share_twitter');
$colabs_share_fblike = get_option('colabs_single_share_fblike');
$colabs_share_fb = get_option('colabs_single_share_fb');
$colabs_share_google_plusone = get_option('colabs_single_share_google_plusone');


    //Share Button Functions 
    global $colabs_options;
    $url = get_permalink();
    $share = '';
    
    //Twitter Share Button
    if(function_exists('colabs_shortcode_twitter') && $colabs_share_twitter == "true"){
        $tweet_args = array(  'url' => $url,
                'style' => 'vertical',
                'source' => ( $colabs_options['colabs_twitter_username'] )? $colabs_options['colabs_twitter_username'] : '',
                'text' => '',
                'related' => '',
                'lang' => '',
                'float' => 'left'
                        );

        $share .= colabs_shortcode_twitter($tweet_args);
    }
    
    //Facebook Like Button
    if(function_exists('colabs_shortcode_fblike') && $colabs_share_fblike == "true"){
    $fblike_args = 
    array(  
        'float' => 'left',
        'url' => '',
        'style' => 'box_count',
        'showfaces' => 'false',
        'width' => '62',
        'height' => '',
        'verb' => 'like',
        'colorscheme' => 'light',
        'font' => 'arial'
        );
        $share .= colabs_shortcode_fblike($fblike_args);    
    }
        
    //Google +1 Share Button
    if( function_exists('colabs_shortcode_google_plusone') && $colabs_share_google_plusone == "true"){
        $google_args = array(
            'size' => 'tall',
            'language' => '',
            'count' => '',
            'href' => $url,
            'callback' => '',
            'float' => 'left'
          );        

        $share .= colabs_shortcode_google_plusone($google_args);       
    }
    
    $return .= '<div class="clear"></div><div class="social_share clearfloat">'.$share.'</div><div class="clear"></div>';
    
    return $return;
}
}
/*Search widget*/
function custom_search( $form ) {

    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'custom_search' );
function the_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }
   
 
     if(1 != $pages)
     {
         echo "<div id='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a class='page' href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a class='page' href='".get_pagenum_link($paged - 1)."'>Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='page current'>".$i."</span>":"<a class='page' href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a class='page' href='".get_pagenum_link($paged + 1)."'>Next</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='page' href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


/*-----------------------------------------------------------------------------------*/
// Add support for a variety of post formats
/*-----------------------------------------------------------------------------------*/

$my_post_formats = array( 'video', 'image' ,'quote', 'link' );
add_theme_support( 'post-formats', $my_post_formats );
/*-----------------------------------------------------------------------------------*/
/*  colabs_meta_post  */
/*-----------------------------------------------------------------------------------*/
function colabs_meta_post(){
?>
  <div class="info-post"><!---Info Post-->
        <ul>
      <?php if ( has_post_format( 'quote' )){ ?>
      <li class="category"><a href="<?php echo get_post_format_link('quote');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/quote.png" alt="image"/> <?php echo __('Quote','colabsthemes');?></a></li>
      <?php }elseif ( has_post_format( 'image' )){ ?>
      <li class="category"><a href="<?php echo get_post_format_link('image');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/photo.png" alt="image"/> <?php echo __('Photo','colabsthemes');?></a></li>
      <?php }elseif ( has_post_format( 'link' )){ ?>
      <li class="category"><a href="<?php echo get_post_format_link('link');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/link.png" alt="image"/> <?php echo __('Link','colabsthemes');?></a></li>
      <?php }elseif ( has_post_format( 'video' )){ ?>
      <li class="category"><a href="<?php echo get_post_format_link('video');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/video.png" alt="image"/> <?php echo __('Video','colabsthemes');?></a></li>
      <?php }else{ ?>
      <li class="category"><a href="<?php echo add_query_arg( 'filter','standard',remove_query_arg('post_format'));?>"><img src="<?php echo get_template_directory_uri(); ?>/images/note.png" alt="image"/> <?php echo __('Note','colabsthemes');?></a></li>
      <?php }?>
      <?php if ( !has_post_format( 'quote' )) {?>
      <li class="meta-author">
        <?php the_author_posts_link(); ?>
        <div class="author-description">
        <?php 
        $email = get_the_author_email();
        echo get_avatar($email,45);?>
        <p><?php the_author_meta( 'description' ); ?></p>
        </div>
      </li>
      <?php }?>
            <li class="date"><?php the_time('j F Y'); ?></li>
      <?php 
      
      $category = get_the_category(); 
      if ($category[0]->cat_name!=''){?>
      <li class="category">
      <?php the_category(', '); ?>
      </li>
      <?php } ?>
      <?php 
      if(is_single()){
      $tags = get_the_tags();
      foreach ($tags as $tag){
      $havetag[]=$tag->name;
      }
      if($havetag[0]!=''){
      ?>
            <li class="tags"><?php the_tags('',', '); ?></li>
      <?php }}?>
            <li><a href="<?php the_permalink(); ?>#respond"><?php comments_number( __('0 comment','colabsthemes'), __('1 Comment','colabsthemes'), __('% Comments','colabsthemes') ); ?></a></li>
      <?php edit_post_link( __( 'Edit', 'colabsthemes' ), '<li class="edit">', '</li>' ); ?>
        </ul>
    </div>
<?php 
}


/*-----------------------------------------------------------------------------------*/
/* Register Query Variables*/
/*-----------------------------------------------------------------------------------*/
add_filter('query_vars', 'my_queryvars' );
function my_queryvars( $qvars )
{
$qvars[] = 'filter';
return $qvars;
}


/*-----------------------------------------------------------------------------------*/
/* Twitter button - twitter
/*-----------------------------------------------------------------------------------*/
/*

Source: http://twitter.com/goodies/tweetbutton

Optional arguments:
 - style: vertical, horizontal, none ( default: vertical )
 - url: specify URL directly 
 - source: username to mention in tweet
 - related: related account 
 - text: optional tweet text (default: title of page)
 - float: none, left, right (default: left)
 - lang: fr, de, es, js (default: english)
*/
if( ! function_exists('colabs_shortcode_twitter') ) {
function colabs_shortcode_twitter($atts, $content = null) {
    extract(shortcode_atts(array( 'url' => '',
                    'style' => 'vertical',
                    'source' => '',
                    'text' => '',
                    'related' => '',
                    'lang' => '',
                    'float' => 'left'), $atts));
  $output = '';

  if ( $url )
    $output .= ' data-url="'.$url.'"';
    
  if ( $source )
    $output .= ' data-via="'.$source.'"';
  
  if ( $text ) 
    $output .= ' data-text="'.$text.'"';

  if ( $related )       
    $output .= ' data-related="'.$related.'"';

  if ( $lang )      
    $output .= ' data-lang="'.$lang.'"';
  
  $output = '<div class="colabs-sc-twitter '.$float.'"><a href="http://twitter.com/share" class="twitter-share-button"'.$output.' data-count="'.$style.'">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>';  
  return $output;
}
}
//add_shortcode( 'twitter', 'colabs_shortcode_twitter' );



/*-----------------------------------------------------------------------------------*/
/* Facebook Like Button - fblike
/*-----------------------------------------------------------------------------------*/
/*

Source: http://developers.facebook.com/docs/reference/plugins/like

Optional arguments:
 - float: none (default), left, right
 - url: link you want to share (default: current post ID)
 - style: standard (default), button
 - showfaces: true or false (default)
 - width: 450
 - verb: like (default) or recommend
 - colorscheme: light (default), dark
 - font: arial (default), lucida grande, segoe ui, tahoma, trebuchet ms, verdana

*/
if( ! function_exists('colabs_shortcode_fblike') ) {
function colabs_shortcode_fblike($atts, $content = null) {
    extract(shortcode_atts(array( 'float' => 'none',
                    'url' => '',
                    'style' => 'standard',
                    'showfaces' => 'false',
                    'width' => '450',
                                    'height' => '60',
                    'verb' => 'like',
                    'colorscheme' => 'light',
                    'font' => 'arial'), $atts));

  global $post;

  if ( ! $post ) {

    $post = new stdClass();
    $post->ID = 0;

  } // End IF Statement

  $allowed_styles = array( 'standard', 'button_count', 'box_count' );

  if ( ! in_array( $style, $allowed_styles ) ) { $style = 'standard'; } // End IF Statement

  if ( !$url )
    $url = get_permalink($post->ID);

  if ( ! $height || ! is_numeric( $height ) ) { $height = '60'; } // End IF Statement
  if ( $showfaces == 'true')
    $height = '100';

  if ( ! $width || ! is_numeric( $width ) ) { $width = 450; } // End IF Statement

  switch ( $float ) {

    case 'left':

      $float = 'fl';

    break;

    case 'right':

      $float = 'fr';

    break;

    default:
    break;

  } // End SWITCH Statement

  $output = '
<div class="colabs-fblike '.$float.'">
<iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout='.$style.'&amp;show_faces='.$showfaces.'&amp;width='.$width.'&amp;action='.$verb.'&amp;colorscheme='.$colorscheme.'&amp;font=' . $font . '" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px"></iframe>
</div>
  ';
  return $output;

}
}
//add_shortcode( 'fblike', 'colabs_shortcode_fblike' );


/*-----------------------------------------------------------------------------------*/
/* Google +1 Button - [google_plusone]
/*-----------------------------------------------------------------------------------*/
if( ! function_exists('colabs_shortcode_google_plusone') ) {
function colabs_shortcode_google_plusone ( $atts, $content = null ) {

  global $post;

  $defaults = array(
            'size' => '',
            'language' => '',
            'count' => '',
            'href' => '',
            'callback' => '',
            'float' => 'none'
          );

  $atts = shortcode_atts( $defaults, $atts );

  extract( $atts );

  $allowed_floats = array( 'left' => ' fl', 'right' => ' fr', 'none' => '' );
  if ( ! in_array( $float, array_keys( $allowed_floats ) ) ) { $float = 'none'; }

  $output = '';
  $tag_atts = '';

  // Make sure we only have Google +1 attributes in our array, after parsing the "float" parameter.
  unset( $atts['float'] );

  if ( $atts['href'] == '' & isset( $post->ID ) ) {
    $atts['href'] = get_permalink( $post->ID );
  }

  foreach ( $atts as $k => $v ) {
    if ( ${$k} != '' ) {
      $tag_atts .= ' ' . $k . '="' . ${$k} . '"';
    }
  }

  $output = '<div class="shortcode-google-plusone' . $allowed_floats[$float] . '"><g:plusone' . $tag_atts . '></g:plusone>';

  // Enqueue the Google +1 button JavaScript from their API.
  add_action( 'wp_footer', 'colabs_shortcode_google_plusone_js' );
  //add_action( 'colabs_shortcode_generator_preview_footer', 'colabs_shortcode_google_plusone_js' );
    //do_action ( 'colabs_shortcode_generator_preview_footer' );
    
    //$output .=  '<script src="https://apis.google.com/js/plusone.js" type="text/javascript"></script>' . "\n" . '<script type="text/javascript">gapi.plusone.go();</script>' . "\n";    
    
    $output .= '</div><!--/.shortcode-google-plusone-->' . "\n";
                    
  return $output . "\n";

} // End colabs_shortcode_google_plusone()
}
//add_shortcode( 'google_plusone', 'colabs_shortcode_google_plusone' );


/*-----------------------------------------------------------------------------------*/
/* Load Javascript for Google +1 Button
/*-----------------------------------------------------------------------------------*/

if( ! function_exists('colabs_shortcode_google_plusone_js') ) {
  function colabs_shortcode_google_plusone_js () {
    echo '<script src="https://apis.google.com/js/plusone.js" type="text/javascript"></script>' . "\n";
    echo '<script type="text/javascript">gapi.plusone.go();</script>' . "\n";
  } // End colabs_shortcode_google_plusone_js()
}