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
  echo $bachelorsClasses;
  echo $bachelorsCount;
?>

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
  'degree_level' => 'masters',
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
  echo $mastersClasses;
  echo $mastersCount;
  // echo $mastersCount;
?>

<div class="<?php echo $bachelorsClasses; ?>">
  <?php foreach ($bachelorsDegrees as $post): ?>
  <?php $title = $post->post_title; ?>
  <?php $degreeID = $post->ID; ?>
  <?php $link = get_permalink($degreeID); ?>

    <div class="cardLinkWrapper item">
      <a href="<?php echo $link; ?>" class="cardLink ">

      <img class="cardLink__image" src="<?php the_field('program_image'); ?>" alt="Program Image">

      <div class="flexTestWrapper">
        <div class="cardLink__text">
          <h3 class="cardLink__heading"><?php echo $title; ?></h3>

        </div>
        <div class="cardLink__info">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat animi neque corrupti quae numquam recusandae laborum fuga veniam culpa enim.</p>
        </div>
      </div>
      <p class="cardLink__cta">View Program</p>
      </a>
    </div>

  <?php endforeach; ?>
</div>

<div class="<?php echo $mastersClasses; ?>">
  <?php foreach ($mastersDegrees as $post): ?>
  <?php $title = $post->post_title; ?>
  <?php $degreeID = $post->ID; ?>
  <?php $link = get_permalink($degreeID); ?>

    <div class="cardLinkWrapper item">
      <a href="<?php echo $link; ?>" class="cardLink ">

      <img class="cardLink__image" src="<?php the_field('program_image'); ?>" alt="Program Image">

      <div class="flexTestWrapper">
        <div class="cardLink__text">
          <h3 class="cardLink__heading"><?php echo $title; ?></h3>

        </div>
        <div class="cardLink__info">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat animi neque corrupti quae numquam recusandae laborum fuga veniam culpa enim.</p>
        </div>
      </div>
      <p class="cardLink__cta">View Program</p>
      </a>
    </div>

  <?php endforeach; ?>
</div>
