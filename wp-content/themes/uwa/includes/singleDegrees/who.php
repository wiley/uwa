<div class="who">
  <?php if ( $post_id == '541' ): ?>
    <h2 class="section-title">Who is this program for?</h2>
  <?php else: ?>
    <h2 class="section-title">Who is this degree for?</h2>
  <?php endif; ?>

  <?php if (get_field('who_info')): ?>
      <?php the_field('who_info'); ?>
  <?php endif; ?>
</div>
