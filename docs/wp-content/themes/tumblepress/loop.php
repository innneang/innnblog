<?php if(get_query_var('filter') == "standard") {   
	  $args = array(
	    'tax_query' => array(
	            array( 'taxonomy' => 'post_format',
	                  'field' => 'slug',
	                  'terms' => array('post-format-video','post-format-quote','post-format-image','post-format-link'),
	                  'operator' => 'NOT IN'
	                  )
	            )
	    );
    query_posts( $args );
}
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="content clearfloat"><!---Post-->
    <?php if ( !has_post_format( 'link' ) && !has_post_format( 'quote' )) {?>
        <div class="title"><!---Title Post-->
        	<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'colabsthemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        </div><!---/Title Post-->
	<?php }?>
    <div class="post">
		
			<div class="post-thumb">
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
			}elseif(has_post_format( 'link' )){
				the_content();
			}else{
			?>
				<p>
				<?php 
				the_content();
				?>
				</p>
        	<?php 
			}
			?>
        	</div>
    </div>
    <?php colabs_meta_post();?>    	<!---/Info Post-->
		
 </div><!---/Post-->
<?php endwhile;?>
<?php else : ?>
<?php colabs_404();?>
<?php endif; ?>
<?php the_pagination();?>