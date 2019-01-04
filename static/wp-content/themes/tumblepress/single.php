<?php get_header();?>
    <div id="content-body"><!---Content-->
    <?php while ( have_posts() ) : the_post(); ?>
    <div class="content clearfloat"><!---Post-->
		<?php if ( !has_post_format( 'link' ) && !has_post_format( 'quote' )) {?>
        <div class="title"><!---Title Post-->
        	<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'colabsthemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        </div><!---/Title Post-->
		<?php }?>
        <div class="post">
        	<?php 
			if (has_post_format( 'video' )){
				$embed = colabs_get_embed('colabs_embed',460,288,'single_video',$post->ID);
				if ($embed!=''){
					echo $embed; 	
				}
			}elseif ( has_post_format( 'image' )){
				colabs_image('width=460');
			}elseif(has_post_format( 'quote' )){
				the_content();
				$singleauthor=get_post_custom_values('colabs_single_author');
				if ($singleauthor[0]!=""){
				echo '<span class="quote-author">'.$singleauthor[0].'</span>';
				}
			}else{
				the_content();
			}
			?>

        </div>
        <?php colabs_meta_post();?>    	<!---/Info Post-->
		<?php echo colabs_share();?>
    </div><!---/Post-->
    <?php comments_template();?>
    <div class="paging">
    <span class="prev"><?php previous_post_link('<em>&larr;</em> %link'); ?></span>
    <span class="next"><?php next_post_link('<em>&rarr;</em> %link'); ?></span>
    
    </div>
    <?php endwhile;?>
    </div><!---/Content-->
<?php get_sidebar();?>
<?php get_footer();?>