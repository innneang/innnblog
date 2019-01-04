<?php get_header();?>
<div id="content-body"><!---Content-->
  <?php while ( have_posts() ) : the_post(); ?>
  <div class="content clearfloat">
    <div class="title"><!---Title Post-->
      <h2 class="post-title">
        <?php the_title(); ?>
      </h2>
    </div>
    <!---/Title Post-->
    <div class="post">
      <?php the_content();?>
    </div>
  </div>
  <?php endwhile;?>
</div>
<!---/Content-->
<?php get_sidebar();?>
<?php get_footer();?>
