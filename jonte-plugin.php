<?php
/**
 * @package JontePlugin
 */
 /*
 Plugin Name: Jonte Plugin
 Plugin URI: http://foghorn.se/iths/jonathanengman
 Description: This is my first plugin
 Version: 1.0.0
 Author: Jonte Engman
 Author URI: http://foghorn.se/iths/jonathanengman
 License: GPLv2 or later
 Text Domain: Jonte-Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Cannot access file' );
}

class Plugin 
{
    function __construct() {
        add_action( 'init', array( $this, 'custom_post_type') );
    }
    function activate() {

        $this->custom_post_type();

        flush_rewrite_rules();
    }

    function deactivate() {
       
    }

    function custom_post_type() {
        register_post_type( 'book', ['public' => true, 'label' => 'books'] );
    }
}

if ( class_exists( 'Plugin' ) ) {
    $jonteplugin = new Plugin( 'This is now initialized! ');
}

// activation
register_activation_hook( __FILE__, array( $jonteplugin, 'activate') );

// deactivation
register_deactivation_hook( __FILE__, array( $jonteplugin, 'deactivate') );