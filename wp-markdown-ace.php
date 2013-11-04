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

	public function __construct() {
		add_action( 'admin_init', array( $this, 'on_wp_admin_init' ) );
	}

	public function on_wp_admin_init() {
		if ( $this->editing_post() ) {
			print 'BOOYAH';
		}
	}

	/**
	 * @return boolean If editing or creating a post or a page
	 */
	private function editing_post() {
		return  strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post-new.php' ) ||
				strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post.php' );
	}
}

$wp_markdown_ace = new WP_Markdown_Ace();
