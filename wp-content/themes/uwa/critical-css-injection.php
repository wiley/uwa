<?php if ( !is_front_page() && !is_archive() && !is_singular('degrees')): ?>
  <style>
    <?php include('library/css/build/minified/critical-interior.css'); ?>
  </style>
<?php endif; ?>

<?php if ( is_front_page()): ?>
  <style>
    <?php include('library/css/build/minified/critical-home.css'); ?>
  </style>
<?php endif; ?>

<?php if ( is_post_type_archive( 'degrees') ): ?>
  <style>
  <?php include('library/css/build/minified/critical-online-degrees.css'); ?>
  </style>
<?php endif; ?>

<?php if ( is_tax('degree_level') ): ?>
  <style>
    <?php include('library/css/build/minified/critical-degree-levels.css'); ?>
  </style>
<?php endif; ?>

<?php if ( is_tax('degree_vertical') ): ?>
  <style>
    <?php include('library/css/build/minified/critical-areas-study.css'); ?>
  </style>
<?php endif; ?>

<?php if ( is_singular('degrees') ): ?>
  <style>
  <?php include('library/css/build/minified/critical-program-page.css'); ?></style>
  <style>
    .form__wrapper {
        visibility: hidden;
        transform: translateY(-120%);
    }
  </style>
<?php endif; ?>
