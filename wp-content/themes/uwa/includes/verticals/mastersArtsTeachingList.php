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
  'degree_level' => 'mat-master-arts-teaching-programs',
  'orderby' => 'title',
  'order'   => 'ASC',
);
  $mastersDegrees = get_posts($args);
  $mastersCount = count($mastersDegrees);
  $mastersClasses = '';

  switch ($mastersDegrees) {
      case ($mastersCount == 1):
          $mastersClasses = 'single';
          break;
      case ($mastersCount == 2):
          $mastersClasses = 'double';
          break;
      case ($mastersCount >= 3):
          $mastersClasses = 'owl-carousel';
          break;
      default:
          echo "Your favorite color is neither red, blue, nor green!";
  }
?>

<div class="<?php echo $mastersClasses; ?>">
  <?php foreach ($mastersDegrees as $post): ?>
  <?php $title = $post->post_title; ?>
  <?php $degreeID = $post->ID; ?>
  <?php $link = get_permalink($degreeID); ?>

  <?php if (get_field('program_subtitle', $degreeID)): ?>
    <?php $text = get_field('program_subtitle', $degreeID); ?>
  <?php endif; ?>

    <div class="cardLinkWrapper item">
      <a href="<?php echo $link; ?>" class="cardLink ">

      <img class="cardLink__image" src="<?php the_field('program_image'); ?>" alt="Program Image">

      <div class="flexTestWrapper">
        <div class="cardLink__text">
          <h3 class="cardLink__heading"><?php echo $title; ?></h3>
        </div>

        <div class="cardLink__info">
          <p><?php echo $text; ?></p>

          <?php if ($mastersClasses == 'single'): ?>
            <div class="cardLink__cta__wrapper">
              <div class="cardLink__cta-background"></div>
              <p class="cardLink__cta">View Program <?php include('arrow.svg'); ?></p>
            </div>
          <?php else: ?>
            <!-- <div class="cardLink__cta-background"></div> -->
          <?php endif; ?>
          <div class="cardLink__cta-background"></div>
        </div>

      </div>
      <p class="cardLink__cta">View Program <?php include('arrow.svg'); ?></p>

      </a>
    </div>

  <?php endforeach; ?>
</div>
