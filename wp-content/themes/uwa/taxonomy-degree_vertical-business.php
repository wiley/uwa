<?php get_header(); ?>
<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  ?>
<?php
$degreeTypes = get_terms([
    'taxonomy' => 'degree_vertical',
    'hide_empty' => true,
]);
// print("<pre>".print_r($degreeTypes,true)."</pre>");
?>

<style media="screen">
  .owl-carousel .owl-dots.disabled, .owl-carousel .owl-nav.disabled {
    /*display: block !important;*/
  }
</style>

  <div class="content">
    <main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

      <div class="intro">
        <div class="intro__breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
          <?php if(function_exists('bcn_display'))
          {
              bcn_display();
          }?>
        </div>
        <h2 class="intro__headline">Become a Leader and Increase Your Earning Potential</h2>
        <p class="intro__text">Choose an online business degree designed for your budget and your schedule at the University of West Alabama. You’ll develop the skills and knowledge needed for success, in a fully online program from one of Alabama’s oldest and most prestigious universities.</p>
        <a href="/online-degrees" class="intro__link">Browse All Degrees <?php include('library/images/arrow.svg'); ?></a>
      </div>


        <div class="mainDegrees degreeType">
          <div class="wrap">
            <h2 id="mainDegreesHeadline" class="mainDegrees__headline">Online Bachelor’s Degrees</h2>
            <p id="mainDegreesText" class="mainDegrees__text">Pursue a successful future in business with a fully online bachelor’s degree. Choose from a wide range of fields and specialties, including the one-of-a-kind integrated marketing communications programs that span several areas of study.</p>
            <?php include ('includes/verticals/bachelorsList.php'); ?>
          </div>
        </div>

        <div class="mastersDegrees degreeType">
          <div class="wrap">
            <div class="narrow">
              <h2 class="mainDegrees__headline">Online Bachelor’s Degrees</h2>
              <p class="mainDegrees__text">Forbes reports salary gains of 40 percent to 50 percent post-MBA. Advance your business career and earning potential with a fully online MBA. Choose from elective concentrations in General Business or Finance.</p>            </div>
            <?php include ('includes/verticals/mastersList.php'); ?>
          </div>
        </div>

    </main>
  </div>


<!-- Add current class to main nav item -->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var menuItem = $('#menu-item-168')
        $('#menu-main').find(menuItem).addClass('current-menu-item current-page-item');
    });
</script>

<?php get_footer(); ?>
<script type="text/javascript">

</script>
