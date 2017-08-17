<?php get_header(); ?>
<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  ?>
<?php
$degreeTypes = get_terms([
    'taxonomy' => 'degree_vertical',
    'hide_empty' => false,
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
        <h2 class="intro__headline">Enhance Your Impact on Students’ Lives</h2>
        <p class="intro__text">Achieve your career goals with an online education degree designed for your budget and your schedule at the University of West Alabama. You’ll develop the skills and knowledge needed for advancement inside or outside the classroom, in a convenient online format from one of Alabama’s oldest and most prestigious universities.</p>
        <div class="intro__link"></div>
      </div>


        <div class="mainDegrees degreeType">
          <div class="wrap">
            <h2 id="mainDegreesHeadline" class="mainDegrees__headline">Online Bachelor’s Degrees</h2>
            <p id="mainDegreesText" class="mainDegrees__text">Take charge of your future with an online business degree designed for your budget and your schedule at the University of West Alabama. You’ll develop the skills and knowledge needed for real-world success, in a fully online program from one of Alabama’s oldest and most prestigious universities.</p>
            <?php include ('includes/verticals/bachelorsList.php'); ?>
          </div>
        </div>

        <div class="mastersDegrees degreeType">
          <div class="wrap">
            <div class="narrow">
              <h2 class="mainDegrees__headline">Online Master's Degrees</h2>
              <p class="mainDegrees__text">Take charge of your future with an online business degree designed for your budget and your schedule at the University of West Alabama. You’ll develop the skills and knowledge needed for real-world success, in a fully online program from one of Alabama’s oldest and most prestigious universities.</p>
            </div>
            <?php include ('includes/verticals/mastersList.php'); ?>
          </div>
        </div>


        <div class="degreeType">
          <div class="wrap">
            <div class="narrow">
              <h2 class="mainDegrees__headline">MAT Degrees</h2>
              <p class="mainDegrees__text">Develop practical skills and knowledge that you need in the classroom. You’ll learn how to apply what you learn and enhance your career as an expert teacher.</p>
            </div>
            <?php include ('includes/verticals/mastersArtsTeachingList.php'); ?>
          </div>
        </div>

        <div class="degreeType coloredBackground">
          <div class="wrap">
            <div class="narrow">
              <h2 class="mainDegrees__headline">MEd Degrees</h2>
              <p class="mainDegrees__text">Focus on theoretical aspects of education to build your career in or outside the classroom. Learn more about the science of education and how to apply strategic aspects of education, like curriculum and course planning, to current and future career roles.</p>
            </div>
            <?php include ('includes/verticals/mastersEducationList.php'); ?>
          </div>
        </div>

        <div class="degreeType coloredBackground">
          <div class="wrap">
            <div class="narrow">
              <h2 class="mainDegrees__headline">Teaching Certificates</h2>
              <p class="mainDegrees__text">Increase your education by building on your skills and knowledge. Achieve your goals with a teaching certificate.</p>
            </div>
            <?php include ('includes/verticals/teachingCertificatesList.php'); ?>
          </div>
        </div>

        <div class="degreeType">
          <div class="wrap">
            <div class="narrow">
              <h2 class="mainDegrees__headline">Alternative Teaching Certification</h2>
              <p class="mainDegrees__text">Earn master’s-level teaching certification in Alabama and an MAT or MEd degree. Alternative Class A programs allow you to pursue a teaching career or change your teaching area.</p>
            </div>
            <?php include ('includes/verticals/alternativeTeachingCertificationList.php'); ?>
          </div>
        </div>

        <div class="degreeType coloredBackground">
          <div class="wrap">
            <div class="narrow">
              <h2 class="mainDegrees__headline">Education Specialist</h2>
              <p class="mainDegrees__text">Gain the knowledge of a PhD or EdD program with the speed of a master’s degree. You’ll expand your education past the master’s degree level but without the cost and time required of a typical doctoral degree.</p>
            </div>
            <?php include ('includes/verticals/educationSpecialistList.php'); ?>
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
