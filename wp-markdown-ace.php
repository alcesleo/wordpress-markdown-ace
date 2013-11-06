<?php
/**
 * Plugin Name: MarkdownAce
 * Plugin URI: https://github.com/alcesleo/wordpress-markdown-ace
 * Description: Turns the post/page-editor into Ace editor (http://ace.c9.io/)
 * Version: 0.1
 * Author: Jimmy Börjesson @alcesleo
 * Author URI: https://github.com/alcesleo
 * License: GPLv2 or later
 */

class WP_Markdown_Ace {

	private static $PLUGIN_PATH;
	private static $PLUGIN_DIR;
	private static $PLUGIN_URL;

	public function __construct() {

		self::$PLUGIN_PATH = plugin_basename( dirname( __FILE__ ) );
		self::$PLUGIN_DIR  = WP_PLUGIN_DIR.'/'.self::$PLUGIN_PATH.'/';
		self::$PLUGIN_URL  = WP_PLUGIN_URL.'/'.self::$PLUGIN_PATH.'/';

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
		wp_register_script( 'ace_editor', self::$PLUGIN_URL.'/js/ace-builds/src/ace.js', false );
		wp_enqueue_script( 'ace_editor' );

		// ace markdown mode
		wp_register_script( 'ace_mode_markdown', self::$PLUGIN_URL.'/js/ace-builds/src/mode-markdown.js', array( 'ace_editor' ) );
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
