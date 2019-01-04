<?php
/*---------------------------------------------------------------------------------*/
/* Adspace Widget */
/*---------------------------------------------------------------------------------*/

class CoLabs_AdWidget125 extends WP_Widget {

	function CoLabs_AdWidget125() {
		$widget_ops = array('description' => 'A set of two 125px by 125px advertisements, use in Sidebar only.' );
		parent::WP_Widget(false, __('ColorLabs - Ad 125', 'colabsthemes'),$widget_ops);      
	}

	function widget($args, $instance) {  
		extract( $args );
		
		$adcode = $instance['adcode'];
		$image = $instance['image'];
		$href = $instance['href'];
		$alt = $instance['alt'];
		$adcode2 = $instance['adcode2'];
		$image2 = $instance['image2'];
		$href2 = $instance['href2'];
		$alt2 = $instance['alt2'];
		$width=125;
		$height=125;
		echo $before_widget; 
        echo '<div class="ads125">';

		?>
		<div class="left">
		<?php
		if($adcode != ''){
		?>
		
		<?php echo $adcode; ?>
		
		<?php } else { ?>
		
			<a href="<?php echo $href; ?>"><img src="<?php echo get_template_directory_uri(); ?>/scripts/timthumb.php?src=<?php echo $image; ?>&amp;w=<?php echo $width; ?>&amp;h=<?php echo $height; ?>&amp;zc=1" alt="<?php echo $alt;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" /></a>
	
		<?php
		}
		?>
		</div>
		<div class="right">
		<?php
		if($adcode2 != ''){
		?>
		
		<?php echo $adcode2; ?>
		
		<?php } else { ?>
		
			<a href="<?php echo $href2; ?>"><img src="<?php echo get_template_directory_uri(); ?>/scripts/timthumb.php?src=<?php echo $image2; ?>&amp;w=<?php echo $width; ?>&amp;h=<?php echo $height; ?>&amp;zc=1" alt="<?php echo $alt2;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" /></a>
	
		<?php
		}
		?>
		</div>
		<?php
		echo '</div>';
		echo $after_widget;

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form($instance) {        
		
		$adcode = esc_attr($instance['adcode']);
		$image = esc_attr($instance['image']);
		$href = esc_attr($instance['href']);
		$alt = esc_attr($instance['alt']);
		$adcode2 = esc_attr($instance['adcode2']);
		$image2 = esc_attr($instance['image2']);
		$href2 = esc_attr($instance['href2']);
		$alt2 = esc_attr($instance['alt2']);
		?>
       
		<p><strong>Left Ad</strong></p>
		<p>
            <label for="<?php echo $this->get_field_id('adcode'); ?>"><?php _e('Ad Code:','colabsthemes'); ?></label>
            <textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo $adcode; ?></textarea>
        </p>
        <p><strong>or</strong></p>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Url:','colabsthemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Link URL:','colabsthemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo $href; ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alt text:','colabsthemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $alt; ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
        </p>
        <hr style=" border-left: none; border-right: none; border-top: 1px solid #D9D9D9; border-bottom: 1px solid #F7F7F7; margin: 20px 0 15px 0;" />
		<p><strong>Right Ad</strong></p>
		<p>
            <label for="<?php echo $this->get_field_id('adcode2'); ?>"><?php _e('Ad Code:','colabsthemes'); ?></label>
            <textarea name="<?php echo $this->get_field_name('adcode2'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode2'); ?>"><?php echo $adcode2; ?></textarea>
        </p>
        <p><strong>or</strong></p>
        <p>
            <label for="<?php echo $this->get_field_id('image2'); ?>"><?php _e('Image Url:','colabsthemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('image2'); ?>" value="<?php echo $image2; ?>" class="widefat" id="<?php echo $this->get_field_id('image2'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href2'); ?>"><?php _e('Link URL:','colabsthemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href2'); ?>" value="<?php echo $href2; ?>" class="widefat" id="<?php echo $this->get_field_id('href2'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('alt2'); ?>"><?php _e('Alt text:','colabsthemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt2'); ?>" value="<?php echo $alt2; ?>" class="widefat" id="<?php echo $this->get_field_id('alt2'); ?>" />
        </p>
        <?php
	}
} 

register_widget('CoLabs_AdWidget125');
?>