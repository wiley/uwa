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

<style>
  .menu-item-has-children {
    position: relative;
  }
  .sub-menu__toggle {
    position: absolute;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    vertical-align: initial;
    -webkit-transition: 0.25s ease;
    transition: 0.25s ease;
    border: 2px solid transparent;
    background-size: 17px !important;
    background-repeat: no-repeat;
    background: url(/wp-content/themes/uwa/library/images/arrow-down-red.svg);
    background-position: center;
    top: 32px;
    width: 25px;
    height: 25px;
    padding: 0 !important;
    background-size: 75%;
    right: 8px !important;
  }
</style>
