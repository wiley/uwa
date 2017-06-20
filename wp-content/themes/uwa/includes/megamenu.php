<script id="degrees-menu-template" type="text/template">
  <?php
  // your taxonomy name
    $verticalsTaxonomy = 'degree_vertical';
    // get the terms of taxonomy
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

  <?php
  // loop through all terms
  // foreach( $degreeTypes as $type ) {
  //
  //     // Get the term link
  //     $type_link = get_term_link( $type );
  //
  //     if( $type->count > 0 )
  //         // display link to term archive
  //         echo '<a href="' . esc_url( $type_link ) . '">' . $type->name .'</a>';
  //
  //     elseif( $type->count !== 0 )
  //         // display name
  //         echo '' . $type->name .'';
  // }
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
        <li class="label">By Areas of Study</li>
        <?php foreach ($degreeTypes as $type ): ?>
          <?php
            $url = get_term_link( $type );
            $name = $type->name;
          ?>
          <li><a href="<?php echo esc_url( $url ); ?>"><?php echo $name; ?></a></li>
        <?php endforeach; ?>
        <!-- <li><a href="#">Business</a></li>
        <li><a href="#">Teaching</a></li>
        <li><a href="#">Psychology & Counseling</a></li> -->
      </ul>
    </ul>
</script>
