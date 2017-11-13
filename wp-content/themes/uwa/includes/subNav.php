<?php
  $hasChildrenPages = get_pages(array(
      'child_of' => $post->ID,
      'title_li' => ''
      // 'exclude' => $post->ID
  ));
?>

<?php
  $hasSiblingPages = get_pages(array(
      'child_of' => $post->post_parent,
      'title_li' => ''
      // 'exclude' => $post->ID
  ));
?>


<?php if ($hasChildrenPages): ?>
  <div class="intro__subNav" typeof="BreadcrumbList" vocab="https://schema.org/">
    <ul class="subpagesNav hasChildrenPages">
      <?php
      $subpageNav = wp_list_pages(array(
          'child_of' => $post->ID,
          'title_li' => '',
					'depth'    => 1
          // 'exclude' => $post->ID
      ))
      ?>
    </ul>
  </div>

<?php elseif ($hasSiblingPages): ?>
  <div class="intro__subNav" typeof="BreadcrumbList" vocab="https://schema.org/">
    <ul class="subpagesNav hasSiblingPages">
      <?php
      $subpageNav = wp_list_pages(array(
          'child_of' => $post->post_parent,
          'title_li' => '',
          'depth'    => 1
          // 'exclude' => $post->ID
      ))
      ?>
    </ul>
  </div>

<?php else: ?>
  <div class="intro__breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
  </div>
<?php endif; ?>
