<?php

  function post_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case '' :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
        <?php echo get_avatar( $comment, 40 ); ?>

        <p class="comment-meta">
          <?php printf( __( '%s' ), sprintf( '%s', get_comment_author_link() ) ); ?>

                  <a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                      <?php printf( __( '%1$s' ), get_comment_date() ); ?>
                  </a>

                  <?php if ( $comment->comment_approved == '0' ) : ?>
                      <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
                  <?php endif; ?>
              </p>
      </div>

      <div class="comment-body"><?php comment_text(); ?></div>

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div>
    </div>

    <?php
        break;
      case 'pingback'  :
      case 'trackback' :
    ?>

    <li class="post pingback">
      <p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)' ), ' ' ); ?></p>
    <?php

      break;
    endswitch;
  }

?>
