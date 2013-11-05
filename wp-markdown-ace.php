<?php
/**
 * Plugin Name: wp-markdown-ace
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Makes the post editor into a good Markdown editor
 * Version: 0.1
 * Author: Jimmy Börjesson @alcesleo
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: GPL2
 */

class WP_Markdown_Ace {

	private static $PLUGIN_URL;

	public function __construct() {

		// TODO: More dynamic
		self::$PLUGIN_URL = WP_PLUGIN_URL.'/wp-ace';

		add_action( 'admin_init', array( $this, 'on_admin_init' ) );
	}

	/**
	 * Takes action on correct admin-pages
	 */
	public function on_admin_init() {
		if ( $this->editing_post() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'on_admin_enqueue_scripts' ) );
		}
	}

	/**
	 * Enques the javascripts
	 */
	public function on_admin_enqueue_scripts() {
		// custom styles
		wp_register_style( 'ace_editor_css', self::$PLUGIN_URL.'/css/textarea.css', false );
		wp_enqueue_style( 'ace_editor_css' );

		// ace editor
		wp_register_script( 'ace_editor', self::$PLUGIN_URL.'/js/ace/src/ace.js', false );
		wp_enqueue_script( 'ace_editor' );

		// ace markdown mode
		wp_register_script( 'ace_mode_markdown', self::$PLUGIN_URL.'/js/ace/src/mode-markdown.js', array( 'ace_editor' ) );
		wp_enqueue_script( 'ace_mode_markdown' );

		// initialization in footer
		wp_register_script( 'ace_replace_textarea', self::$PLUGIN_URL.'/js/replace-textarea.js', array( 'ace_editor' ), true );
		wp_enqueue_script( 'ace_replace_textarea' );
	}

	/**
	 * @return boolean If editing or creating a post or a page
	 */
	private function editing_post() {
		return  strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post-new.php' ) ||
				strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post.php' );
	}
}

// Instanciate the plugin
$wp_markdown_ace = new WP_Markdown_Ace();
