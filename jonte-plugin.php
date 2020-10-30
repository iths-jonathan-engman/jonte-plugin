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

if ( !class_exists( 'Plugin' ) ) {

    class Plugin 
    {
        public $plugin;
        function __construct() {
            $this->plugin = plugin_basename( __FILE__ );
        }

        function register() {
            add_action( 'admin_enqueue_scripts', array ( $this, 'enqueue') );

            add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

            add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
        }

        public function settings_link( $links ) {
            $settings_link = '<a href="admin.php?page=jonte_plugin">Settings</a>';
            array_push( $links, $settings_link );
            return $links;
        }

        public function add_admin_pages() {
			add_menu_page( 'Jonte Plugin', 'Jonte', 'manage_options', 'jonte_plugin', array( $this, 'admin_index' ), 'dashicons-smiley', 110 );
		}

        public function admin_index() {
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
        }

        protected function create_post_type() {
            add_action( 'init', array( $this, 'custom_post_type') );
        }


        function custom_post_type() {
            register_post_type( 'book', ['public' => true, 'label' => 'books'] );
        }

        function enqueue() {
            wp_enqueue_style ( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
            wp_enqueue_style ( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ) );
        }

        function activate() {
            require_once plugin_dir_path( __FILE__ ) . 'inc/jonte-plugin-activate.php';
            JontePluginActivate::activate();
        }

    }

        $jonteplugin = new Plugin( 'This is now initialized! ');
        $jonteplugin->register();


        // activation
        register_activation_hook( __FILE__, array( $jonteplugin, 'activate') );

        // deactivation
        require_once plugin_dir_path( __FILE__ ) . 'inc/jonte-plugin-deactivate.php';
        register_deactivation_hook( __FILE__, array( 'JontePluginDeactivate', 'deactivate') );

}