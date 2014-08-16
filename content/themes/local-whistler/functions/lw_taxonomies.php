<?php

function list_terms( $desiredTaxonomy, $before = '<li>', $after = '</li>', $link = true ) {

  $args = array(
    'fields' => 'all'
  );

  $taxonomies = get_terms( $desiredTaxonomy, $args );

  if ( count( $taxonomies ) > 0) {

    foreach ( $taxonomies as $taxonomy ) {

      if ( $link != true) {
        $linkBefore = '';
        $linkAfter = '';
      }

      else {
        $linkBefore = '<a href="' . get_term_link( $taxonomy->slug, $desiredTaxonomy ) . '">';
        $linkAfter = '</a>';
      }

      echo $before .  $linkBefore . $taxonomy->name . $linkAfter . $after;

    }

  }

}

?>
