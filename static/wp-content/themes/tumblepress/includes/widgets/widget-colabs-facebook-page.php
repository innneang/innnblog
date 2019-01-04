<?php
/*---------------------------------------------------------------------------------*/
/* Facebook widget */
/*---------------------------------------------------------------------------------*/

class CoLabs_Facebook_Page extends WP_Widget {

   function CoLabs_Facebook_Page() {
  	   $widget_ops = array('description' => 'Facebook Page.' );
       parent::WP_Widget(false, $name = __('Facebook Page', 'colabsthemes'), $widget_ops);    
   }


   function widget($args, $instance) {        
       extract( $args );
   	$title = $instance['title'];
	$url = $instance['url'];
	$width = $instance['width'];
	$height = $instance['height'];
	if($url=='')$url='colorlabs';
	if($width=='')$width=260;
	if($height=='')$height=288;
	?>
		<?php echo $before_widget; ?>
        <?php if ($title) { echo $before_title . $title . $after_title; }else {echo $before_title .__('Stay Connected','colabsthemes'). $after_title;} 
		echo '<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F'.$url.'&amp;width='.$width.'&amp;colorscheme=dark&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=true&amp;height='.$height.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
		 echo $after_widget; 
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {                
       $title = esc_attr($instance['title']);
	   $url = esc_attr($instance['url']);
	   $width = esc_attr($instance['width']);
	   $height = esc_attr($instance['height']);

       ?>    
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','colabsthemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p> 
	   <p>
	   	   <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Facebook Page URL :','colabsthemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('url'); ?>"  value="<?php echo $url; ?>" class="widefat" id="<?php echo $this->get_field_id('url'); ?>" />
       </p>
	   <p>
	   	   <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:','colabsthemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('width'); ?>"  value="<?php echo $width; ?>" class="widefat" id="<?php echo $this->get_field_id('width'); ?>" />
       </p>
	    <p>
	   	   <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:','colabsthemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('height'); ?>"  value="<?php echo $height; ?>" class="widefat" id="<?php echo $this->get_field_id('height'); ?>" />
       </p>
       <?php 
   }

} 
register_widget('CoLabs_Facebook_Page');


?>