<div id="content-details" class="details infoTabs__content active" aria-labelledby="details" role="tabpanel">
  <h2 class="section-heading">Course Details</h2>

  <?php if (get_field('course_info_intro')): ?>
    <?php the_field('course_info_intro'); ?>
  <?php endif; ?>

  <?php if( have_rows('course_info_accordion') ): $i = 0;?>
    <?php include 'courseInfoAccordion.php'; ?>
  <?php endif; ?>

  <?php if (get_field('course_info_outro')): ?>
    <?php the_field('course_info_outro'); ?>
  <?php endif; ?>

  <?php if( have_rows('concentration_accordion') ): $i = 0;?>

    <?php if (get_field('concentrations_intro')): ?>
      <div class="concentrationsIntroWrapper" style="margin-top: 3.5em;"><?php the_field('concentrations_intro'); ?></div>
    <?php endif; ?>

    <?php if (get_field('concentration_accordion')): ?>
      <?php include 'concentrationAccordion.php'; ?>
    <?php endif; ?>


  <?php endif; ?>
</div>
