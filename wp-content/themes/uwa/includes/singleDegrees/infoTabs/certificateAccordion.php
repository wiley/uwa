<div class="accordion">
  <?php while ( have_rows('certificate_accordion') ) : the_row(); $i++; ?>

    <div class="accord">

      <h4 class="accord-header">
        <button aria-controls="content-<?php echo $i; ?>" aria-expanded="false">
          <?php the_sub_field('accordion_header'); ?>
          <div class="iconsWrapper">
            <span class="plus"><?php include ( 'icon-plus.svg'); ?></span>
            <span class="minus"><?php include ( 'icon-minus.svg'); ?></span>
          </div>
        </button>
      </h4>

      <div id="content-<?php echo $i; ?>" class="accord-content" aria-hidden="true"><?php the_sub_field('accordion_content'); ?></div>
      <span class="accord-trigger" aria-hidden="true"></span>
    </div>

  <?php endwhile; ?>
</div>
