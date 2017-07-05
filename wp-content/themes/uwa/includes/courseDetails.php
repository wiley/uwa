<div class="course-details">
  <h3>Course Details</h3>
  <?php if (get_field('course_details_text')): ?>
    <?php the_field('course_details_text') ?>
  <?php endif; ?>

  <?php if( have_rows('course_info_accordion') ): $i = 0;?>
    <?php include 'courseInfoAccordion.php'; ?>
  <?php endif; ?>

  <?php if (get_field('course_details_bottom_text')): ?>
    <div class="course-details__bottomText"><?php the_field('course_details_bottom_text') ?></div>
  <?php endif; ?>

</div>
