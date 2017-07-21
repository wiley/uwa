<?php
  $args = array(
    "posts_per_page" => -1,
    "post_type" => "degrees",
    "tax_query" => array(
      array(
        "taxonomy" => "degree_vertical",
        "field"    => "slug",
        "terms"    => $term->slug,
      )
  ),
  'degree_level' => 'bachelors',
  'orderby' => 'title',
  'order'   => 'ASC',
);
  $bachelorsDegrees = get_posts($args);
  $bachelorsCount = count($bachelorsDegrees);
  $bachelorsClasses = '';

  switch ($bachelorsDegrees) {
      case ($bachelorsCount == 1):
          $bachelorsClasses = 'single';
          break;
      case ($bachelorsCount == 2):
          $bachelorsClasses = 'double';
          break;
      case ($bachelorsCount >= 3):
          $bachelorsClasses = 'owl-carousel';
          break;
      default:
          echo "Your favorite color is neither red, blue, nor green!";
  }
?>
<div id="mainCarouselDescription" class="sr">You can enter into this carousel group by pressing enter. Once inside, you can tab through each program Item</div>
<div id="mainCarousel" class="<?php echo $bachelorsClasses; ?>" aria-label="Carousel for Online Bachelor's Degrees." aria-describedby="mainCarouselDescription">

  <?php foreach ($bachelorsDegrees as $post): ?>
  <?php $title = $post->post_title; ?>
  <?php $degreeID = $post->ID; ?>
  <?php $link = get_permalink($degreeID); ?>

  <?php if (get_field('program_subtitle', $degreeID)): ?>
    <?php $text = get_field('program_subtitle', $degreeID); ?>
  <?php endif; ?>

    <div class="cardLinkWrapper item">
      <a href="<?php echo $link; ?>" class="cardLink" aria-describedby="info<?php echo $degreeID; ?>">

      <img aria-hidden="true" class="cardLink__image" src="<?php the_field('program_image'); ?>" alt="Program Image for  <?php echo $title; ?>">

      <div class="flexTestWrapper">
        <div class="cardLink__text">
          <h3 class="cardLink__heading"><?php echo $title; ?></h3>
        </div>
        <div class="cardLink__info">
          <p id="info<?php echo $degreeID; ?>"><?php echo $text; ?></p>
          <div class="cardLink__cta-background"></div>
        </div>
      </div>
      <p aria-hidden="true" class="cardLink__cta">View Program <?php include('arrow.svg'); ?></p>
      </a>
    </div>

  <?php endforeach; ?>
</div>
