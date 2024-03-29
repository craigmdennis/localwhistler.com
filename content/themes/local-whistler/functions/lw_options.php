<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
  register_setting( 'localwhistler_options', 'lw_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
  add_theme_page( __( 'Theme Options', 'localwhistler' ), __( 'Theme Options', 'localwhistler' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create array for social links
 */
$social_links = array(
  'twitter',
  'instagram',
  'facebook',
  'google-plus'
);

/**
 * Create array for sort options
 */
$select_options = array(
  '0' => array(
    'value' =>  'title-ASC',
    'label' => __( 'A-Z', 'localwhistler' )
  ),
  '1' => array(
    'value' =>  'title-DESC',
    'label' => __( 'Z-A', 'localwhistler' )
  ),
  '2' => array(
    'value' => 'date-ASC',
    'label' => __( 'Oldest First', 'localwhistler' )
  ),
  '3' => array(
    'value' => 'date-DESC',
    'label' => __( 'Newest First', 'localwhistler' )
  )
);

/**
 * Create the options page
 */
function theme_options_do_page() {
  global $select_options;

  if ( ! isset( $_REQUEST['settings-updated'] ) )
    $_REQUEST['settings-updated'] = false;

  ?>
  <div class="wrap">
    <?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Theme Options', 'localwhistler' ) . "</h2>"; ?>

    <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
    <div class="updated fade"><p><strong><?php _e( 'Options saved', 'localwhistler' ); ?></strong></p></div>
    <?php endif; ?>

    <form method="post" action="options.php">
      <?php settings_fields( 'localwhistler_options' ); ?>
      <?php $options = get_option( 'lw_options' ); ?>

      <table class="form-table">

        <?php
        /**
         * Business Order
         */
        ?>
        <tr valign="top"><th scope="row"><?php _e( 'Default business order', 'localwhistler' ); ?></th>
          <td>
            <select name="lw_options[selectinput]">
              <?php
                $selected = $options['selectinput'];
                $p = '';
                $r = '';

                foreach ( $select_options as $option ) {
                  $label = $option['label'];
                  if ( $selected == $option['value'] ) // Make default first in list
                    $p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                  else
                    $r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                }
                echo $p . $r;
              ?>
            </select>
          </td>
        </tr>

        <?php
        /**
         * A sample text input option
         */
        ?>
        <tr valign="top">
          <th scope="row">
            <label class="description" for="lw_options[analytics]">
              <?php _e( 'Google Analytics Code', 'localwhistler' ); ?>
            </label>
          </th>
          <td>
            <input id="lw_options[analytics]" class="regular-text" type="text" name="lw_options[analytics]" value="<?php esc_attr_e( $options['analytics'] ); ?>" />
          </td>
        </tr>

        <?php global $social_links; ?>
        <?php foreach ( $social_links as $social) : ?>
          <tr valign="top">
            <th scope="row">
              <label class="description" for="lw_options[<?php echo $social; ?>]">
                <?php _e( ucwords(str_replace('-', ' ', $social)) . ' URL', 'localwhistler' ); ?>
              </label>
            </th>
            <td>
              <input id="lw_options[<?php echo $social; ?>]" class="regular-text" type="text" name="lw_options[<?php echo $social; ?>]" value="<?php esc_attr_e( $options[$social] ); ?>" />
            </td>
          </tr>
        <?php endforeach; ?>

      </table>

      <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'localwhistler' ); ?>" />
      </p>
    </form>
  </div>
  <?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
  global $social_links, $select_options;

  // Say our text option must be safe text with no HTML tags
  $input['analytics'] = wp_filter_nohtml_kses( $input['analytics'] );

  foreach ( $social_links as $social) :
    $input[$social] = wp_filter_nohtml_kses( $input[$social] );
  endforeach;

  return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
