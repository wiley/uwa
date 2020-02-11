<div class="program__side">
  <img src="<?php the_field('program_image'); ?>" alt="">
  <div class="program__details">
    <div class="program__details-line"></div>
    <h6 class="program__details-heading">Program Detail</h6>
    <div class="program__details-row">
      <p class="program__details-title">Next Start Date</p>
      <p class="program__details-dotted"></p>
      <p class="program__details-info">
        <?php if (get_field('next_start_date')): ?>
            <?php the_field('next_start_date'); ?>
        <?php elseif (get_field('start_by', 'options')): ?>
            <?php the_field('start_by', 'options'); ?>
        <?php endif; ?></p>

    </div>
    <div class="program__details-row">
      <p class="program__details-title">Est. Program Length</p>
      <p class="program__details-dotted"></p>
      <p class="program__details-info"><?php the_field('est_program_length'); ?></p>
    </div>
    <div class="program__details-row">
      <p class="program__details-title">Credit Hours</p>
      <p class="program__details-dotted"></p>
      <p class="program__details-info"><?php the_field('credit_hours'); ?></p>
    </div>
    <div class="program__details-row">
      <p class="program__details-title">Course Length</p>
      <p class="program__details-dotted"></p>
      <p class="program__details-info"><?php the_field('course_length'); ?></p>
    </div>
    <div class="program__details-row">
      <p class="program__details-title">Cost Per Credit</p>
      <p class="program__details-dotted"></p>
      <p class="program__details-info"><?php the_field('cost_per_credit'); ?></p>
    </div>

    <?php if (get_field('show_alabama_certification_info')): ?>
      <div class="program__details-row">
        <p class="program__details-title">Alabama Teaching Certification</p>
        <p class="program__details-dotted"></p>
        <p class="program__details-info"><?php the_field('alabama_teaching_certification'); ?></p>
      </div>
    <?php endif; ?>

  </div>
  <div id="optimizely-form-desktop"></div>
</div>
