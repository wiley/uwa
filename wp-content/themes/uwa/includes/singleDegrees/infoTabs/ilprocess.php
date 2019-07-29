<div id="content-ilprocess" class="ilprocess infoTabs__content" aria-labelledby="ilprocess" role="tabpanel">
  <h2 class="section-heading">IL Process</h2>

  <?php if (get_field('il_process_intro')): ?>
    <?php the_field('il_process_intro'); ?>
  <?php endif; ?>

  <?php if( have_rows('il_process_accordion') ): $i = 0;?>
    <?php include 'ilProcessAccordion.php'; ?>
  <?php endif; ?>

  <?php if (get_field('il_process_outro')): ?>
    <?php the_field('il_process_outro'); ?>
  <?php endif; ?>

</div>
