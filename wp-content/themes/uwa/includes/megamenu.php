<script id="degrees-menu-template" type="text/template">
  <?php
    $verticalsTaxonomy = 'degree_vertical';
    $degreeTypes = get_terms( $verticalsTaxonomy, $args = array(
      'hide_empty' => false, // do not hide empty terms
    ));
  ?>

  <?php
  // your taxonomy name
    $levelsTaxonomy = 'degree_level';
    // get the terms of taxonomy
    $degreeLevels = get_terms( $levelsTaxonomy, $args = array(
      'hide_empty' => false, // do not hide empty terms
    ));
  ?>


    <ul id="" class="degrees-menu sub-menu">
      <ul class="degrees-menu__submenu">
        <li class="label">By Program Type</li>
        <?php foreach ($degreeLevels as $level ): ?>
          <?php
            $url = get_term_link( $level );
            $name = $level->name;
          ?>
          <li><a href="<?php echo esc_url( $url ); ?>"><?php echo $name; ?></a></li>
        <?php endforeach; ?>
      </ul>

      <ul class="degrees-menu__submenu">
        <li class="label">By Area of Study</li>
        <?php foreach ($degreeTypes as $type ): ?>
          <?php
            $url = get_term_link( $type );
            $name = $type->name;
          ?>
          <li><a href="<?php echo esc_url( $url ); ?>"><?php echo $name; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </ul>
</script>
