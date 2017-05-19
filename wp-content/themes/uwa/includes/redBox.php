<?php if( have_rows('cards') ):  ?>

  <?php while ( have_rows('cards') ) : the_row(); ?>

    <div class="card">

      <h4 class="card_header">
        <?php $card = get_sub_field('card'); ?>
        <?php print_r($card); ?>
      </h4>
      <div id="content-<?php echo $i; ?>" class="accord-content" aria-hidden="true"><?php the_sub_field('accordion_content'); ?></div>
      <span class="accord-trigger" aria-hidden="true"></span>
    </div>

  <?php endwhile; ?>

<?php endif; ?>
