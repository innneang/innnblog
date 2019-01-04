<?php $options = get_option('diary'); ?>
<?php get_header(); ?>
	<div class="content">
		<article class="article">
			<div id="content_box">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="post excerpt <?php echo (++$j % 2 == 0) ? 'last' : ''; ?>">
							<header>
								<h2 class="title">
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
								</h2>
                <?php if($options['mts_headline_meta'] == '1') { ?>
								<div class="post-info">
								<?php _e('Posted by ','mythemeshop'); the_author_posts_link(); ?><?php _e(' in ', 'mythemeshop'); the_category(', ') ?> <?php _e(' On ','mythemeshop'); the_time('F j, Y'); ?>
								</div>
		<?php } ?>
								<?php if ( has_post_thumbnail() ) { ?> 
								<?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('featured',array('title' => '')); echo '</div>'; ?>
								<?php } ?>
</a>
							</header><!--.header-->
							
							<div class="post-content image-caption-format-1">
								<?php echo excerpt(38);?>
							</div>
                            <div class="readMore"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php _e('Read More','mythemeshop'); ?></a></div>
						</div><!--.post excerpt-->
					<?php endwhile; else: ?>
						<div class="post excerpt">
							<div class="no-results">
								<p><strong><?php _e('There has been an error.', 'mythemeshop'); ?></strong></p>
								<p><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'mythemeshop'); ?></p>
								<?php get_search_form(); ?>
							</div><!--noResults-->
						</div>
					<?php endif; ?>
						
<?php if ($options['mts_pagenavigation'] == '1') { ?>
<?php pagination($additional_loop->max_num_pages);?>
<?php } else { ?>
<div class="pnavigation2">
<div class="nav-previous"><?php next_posts_link( __( '&larr; '.'Older posts', 'mythemeshop' ) ); ?></div>
<div class="nav-next"><?php previous_posts_link( __( 'Newer posts'.' &rarr;', 'mythemeshop' ) ); ?></div>
</div>
<?php } ?>
							
			</div>
		</article>
<?php get_footer(); ?>