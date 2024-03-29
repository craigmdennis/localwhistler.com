<?php
/*
Plugin Name: Local Whistler Geocoder
Description: A simple plugin for saving location data with posts. Conveniently converts addresses to lat/lng from the Post/Page Edit screen.
Version: 99.99
Contributors: martyspellerberg, mgibbs189, craigmdennis
Author: Craig Dennis
Author URI: http://simplebitdesign.com
License: GPLv2+
Notes: Customised for Local Whistler by Craig Dennis.
*/

class Address_Geocoder
{

    public $available_post_types = array();
    public $options;


    function __construct() {
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }


    /**
     * Initialize
     */
    function admin_init() {

        // Class properties
        $post_types = get_post_types();
        $excluded = array( 'attachment', 'revision', 'nav_menu_item' );
        $this->available_post_types = array_diff( $post_types, $excluded );
        $this->options = get_option( 'address_geocoder_options' );

        // Set some default options if none are already set
        if( !$this->options ) {
            $this->options = $this->available_post_types;
        }

        // Actions
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );

        // Settings
        register_setting( 'address_geocoder_options', 'address_geocoder_options', array( $this, 'validate_options' ) );
    }


    /**
     * Register the menu item under "Settings"
     */
    function admin_menu() {
        add_options_page( 'Address Geocoder', 'Address Geocoder', 'manage_options', 'address-geocoder-options', array( $this, 'options_page' ) );
    }


    /**
     * Enqueue admin scripts
     */
    function admin_enqueue_scripts() {

        // Load scripts only when necessary
        if ( $this->is_geocoder_needed() ) {
            wp_register_script( 'googlemaps', '//maps.googleapis.com/maps/api/js?key=AIzaSyCMXKbvuj1knT8E8nzZPUjADUIfR34jtZg&sensor=false' );
            wp_register_script( 'marty_geocode_js', plugins_url( '/address-geocoder.js', __FILE__ ) );

            wp_enqueue_script( 'googlemaps' );
            wp_enqueue_script( 'marty_geocode_js' );
        }
    }


    /**
     * Determine whether the geocoder metabox appears on the current page
     */
    function is_geocoder_needed() {

        $pagenow = isset( $GLOBALS['pagenow'] ) ? $GLOBALS['pagenow'] : '';

        if ( 'post.php' == $pagenow ) {
            $post_type = get_post_type( $_GET['post'] );
        }
        elseif ( 'post-new.php' == $pagenow ) {
            $post_type = isset( $_GET['post_type'] ) ? $_GET['post_type'] : 'post';
        }

        if ( !empty( $post_type ) && !empty( $this->options ) ) {
            if ( in_array( $post_type, $this->available_post_types ) && 'exclude' != $this->options[ $post_type ] ) {
                return true;
            }
        }

        return false;
    }


    /**
     * Add the "Geocoder" meta box to the appropriate pages
     */
    function add_meta_boxes( $post_type ) {
        if ( in_array( $post_type, $this->available_post_types ) && 'exclude' != $this->options[ $post_type ] ) {
            add_meta_box( 'martygeocoder', 'Business Address', array( $this, 'meta_box_html' ), $post_type, 'normal', 'high' );
        }
    }


    /**
     * Generate the meta box HTML
     */
    function meta_box_html( $object, $box ) {

        wp_nonce_field( 'save_latlng', 'geocoder_nonce' );
?>
        <div style="overflow:hidden; width:100%; padding-top: 6px;">
            <div id="geocodepreview" style="float:right; width:240px; height:180px; border:1px solid #DFDFDF;"></div>
            <div style="margin-right:260px">
                <p class="label" style="font-size: 12px; line-height: 1.5em; margin: 0 0 1em; padding: 0; color: #666666; text-shadow: 0 1px 0 #FFFFFF;">
                    <label style="color: #333333; font-size: 13px; line-height: 1.5em; font-weight: bold; padding: 0; margin: 0 0 3px; display: block; vertical-align: text-bottom;" for="martygeocoderaddress">Full Address</label>
                    The address field will be displayed as well as the map.
                </p>
                <input style="width:100%;" type="text" name="martygeocoderaddress" id="martygeocoderaddress" value="<?php echo esc_attr( get_post_meta( $object->ID, 'martygeocoderaddress', true ) ); ?>" />
                <input style="width:300px" type="hidden" name="martygeocoderlatlng" id="martygeocoderlatlng" value="<?php echo esc_attr( get_post_meta( $object->ID, 'martygeocoderlatlng', true ) ); ?>" />
                <p>
                    <a id="geocode" class="button">Lookup Address</a>
                </p>
            </div>
        </div>
<?php
    }


    /**
     * Generate the options page HTML
     */
    function options_page() {

        if ( ! isset( $_REQUEST['settings-updated'] ) ) {
            $_REQUEST['settings-updated'] = false;
        }
?>

<div class="wrap">
    <h2><?php _e( 'Address Geocoder' ); ?></h2>
    <form method="post" action="options.php">
        <?php settings_fields( 'address_geocoder_options' ); ?>
        <h3>Show Metabox on Post Types</h3>

        <?php foreach ( $this->options as $post_type => $status ) : ?>
        <?php $checked = ( 'exclude' != $status ) ? ' checked="checked"' : ''; ?>
        <p>
            <input type="checkbox" id="geocoder-type-<?php echo $post_type; ?>" name="address_geocoder_options[<?php echo $post_type ?>]" value="enabled" <?php echo $checked; ?> />
            <label class="description" for="geocoder-type-<?php echo $post_type; ?>"><?php echo $post_type; ?></label>
        </p>
        <?php endforeach; ?>

        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
        </p>
    </form>
</div>

<?php
    }


    /**
     * Validate the options
     */
    function validate_options( $input ) {
        foreach ( $this->available_post_types as $post_type ) {
            if ( !isset( $input[ $post_type ] ) ) {
                $input[ $post_type ] = 'exclude';
            }
        }
        return $input;
    }


    /**
     * Attach geocode data to posts
     */
    function save_post( $post_id, $post ) {

        // Skip when nonce isn't present
        if ( !isset( $_POST['geocoder_nonce'] ) || !wp_verify_nonce( $_POST['geocoder_nonce'], 'save_latlng' ) ) {
            return $post_id;
        }

        // Ensure proper access rights
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        // Save address
        $address_key = 'martygeocoderaddress';
        $address = isset( $_POST[ $address_key ] ) ? sanitize_text_field( $_POST[ $address_key ] ) : '';
        if ( empty( $address ) ) {
            delete_post_meta( $post_id, $address_key );
        }
        else {
            update_post_meta( $post_id, $address_key, $address );
        }

        // Save lat/lng
        $latlng_key = 'martygeocoderlatlng';
        $latlng = isset( $_POST[ $latlng_key ] ) ? sanitize_text_field( $_POST[ $latlng_key ] ) : '';
        if ( empty( $latlng ) ) {
            delete_post_meta( $post_id, $latlng_key );
        }
        else {
            update_post_meta( $post_id, $latlng_key, $latlng );
        }
    }
}


$address_geocoder = new Address_Geocoder();


// Backwards compatibility
function get_geocode_latlng( $post_id ) {
    return get_post_meta( $post_id, 'martygeocoderlatlng', true );
}

function get_geocode_lat( $post_id ) {
    $latlng = get_post_meta( $post_id, 'martygeocoderlatlng', true );
    $latlng = explode( ',', $latlng );
    return substr( $latlng[0], 1 );
}

function get_geocode_lng( $post_id ) {
    $latlng = get_post_meta( $post_id, 'martygeocoderlatlng', true );
    $latlng = explode( ',', $latlng );
    return substr( $latlng[1], 0, -1 );
}

function get_geocode_address( $post_id ) {
    return get_post_meta( $post_id, 'martygeocoderaddress', true );
}
