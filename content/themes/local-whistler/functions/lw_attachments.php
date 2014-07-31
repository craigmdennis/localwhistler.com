<?php

define( 'ATTACHMENTS_DEFAULT_INSTANCE', false );
define( 'ATTACHMENTS_SETTINGS_SCREEN', false ); // disable the Settings screen

function premium_gallery( $attachments )
{
  $args = array(

    // title of the meta box (string)
    'label'         => 'Gallery',

    // all post types to utilize (string|array)
    'post_type'     => 'business',

    'priority'      => 'high',

    // allowed file type(s) (array) (image|video|text|audio|application)
    'filetype'      => 'image',  // no filetype limit

    // text for 'Attach' button in meta box (string)
    'button_text'   => __( 'Add images to the gallery', 'premium_gallery' ),

    // text for modal 'Attach' button (string)
    'modal_text'    => __( 'Add to gallery', 'premium_gallery' ),

    /**
     * Fields for the instance are stored in an array. Each field consists of
     * an array with three keys: name, type, label.
     *
     * name  - (string) The field name used. No special characters.
     * type  - (string) The registered field type.
     *                  Fields available: text, textarea
     * label - (string) The label displayed for the field.
     */

    'fields'        => array(
      array(
        'name'  => 'title',                          // unique field name
        'type'  => 'text',                           // registered field type
        'label' => __( 'Title', 'premium_gallery' ),     // label to display
      ),
    ),

  );

  $attachments->register( 'premium_gallery', $args ); // unique instance name
}

add_action( 'attachments_register', 'premium_gallery' );

?>
