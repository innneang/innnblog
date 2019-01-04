<div id="sidebar"><!---Sidebar-->
  <div id="author"><!---Author-->
			<?php $aboutpage=get_option('colabs_about_page');
			if ($aboutpage!=''){
			query_posts('page_id='.$aboutpage);
			while ( have_posts() ) : the_post();
			$email = get_the_author_email();
			$more = '&nbsp;&nbsp;';
			echo get_avatar($email,45);
			?>
			<p><?php echo excerpt(40,$more);?></p>
			<?php 
			endwhile;
			}?>
        	<div class="socnet">
            	<ul>
					<?php if(get_option("colabs_social_twitter")){?>
                	<li><a href="<?php if (get_option("colabs_social_twitter")!=''){ echo get_option("colabs_social_twitter"); }else{ echo 'http://twitter.com/colorlabs'; }?>"><img src="<?php bloginfo("template_url")?>/images/twitter.png" alt="image"/></a></li>
                    <?php }?>
					<?php if(get_option("colabs_social_facebook")){?>
					<li><a href="<?php if (get_option("colabs_social_facebook")!=''){ echo get_option("colabs_social_facebook"); }else{ echo 'http://www.facebook.com/colorlabs'; }?>"><img src="<?php bloginfo("template_url")?>/images/facebook.png" alt="image"/></a></li>
                    <?php }?>
					<?php if(get_option("colabs_social_delicious")){?>
					<li><a href="<?php if (get_option("colabs_social_delicious")!=''){ echo get_option("colabs_social_delicious"); }else{ echo 'http://delicious.com/colorlabs'; }?>"><img src="<?php bloginfo("template_url")?>/images/delicious.png" alt="image"/></a></li>
                    <?php }?>
					<?php if(get_option("colabs_social_stumbleupon")){?>
					<li><a href="<?php if (get_option("colabs_social_stumbleupon")!=''){ echo get_option("colabs_social_stumbleupon"); }else{ echo 'http://www.stumbleupon.com/stumbler/colorlabs/'; }?>"><img src="<?php bloginfo("template_url")?>/images/stumbleupon.png" alt="image"/></a></li>
                    <?php }?>
					<?php if(get_option("colabs_social_linkedin")){?>
					<li><a href="<?php if (get_option("colabs_social_linkedin")!=''){ echo get_option("colabs_social_linkedin"); }else{ echo 'http://www.linkedin.com/colorlabs/'; }?>"><img src="<?php bloginfo("template_url")?>/images/linkedin.png" alt="image"/></a></li>
					<?php }?>
					<li><a href="<?php if(get_option("colabs_feed_url") != ''){ echo 'http://feeds.feedburner.com/'.get_option("colabs_feed_url");	}else{ bloginfo("rss2_url"); }?>"><img src="<?php bloginfo("template_url")?>/images/rss.png" alt="image"/></a></li>
            	</ul>
            </div>
  </div><!---/Author-->
<?php
	if ( is_active_sidebar( 'sidebar-widget' ) ) : dynamic_sidebar( 'sidebar-widget' ); endif;
?>          
  
</div><!---/Sidebar-->