<?php
/**
 * Plugin Name
 *
 * @package     Form Redirector
 * @author      Michael Chacon
 * @copyright   2016 Michael Chacon
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Form Redirector
 * Plugin URI:  https://example.com/plugin-name
 * Description: User enters a password in to a form field and is redirected to a page of your choice.
 * Version:     1.0.0
 * Author:      Your Name
 * Author URI:  https://sicdigital.com
 * Text Domain: plugin-name
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

add_shortcode( 'pw-redirect-field', 'sic_password_field' );

//add_action('admin_post_custom_form_submit','sic_redirect_from_password');
add_action( 'admin_post_nopriv_sic_pw_submit', 'sic_redirect_from_password' );
add_action( 'admin_post_sic_pw_submit', 'sic_redirect_from_password' );


function sic_password_field( $atts ) {
	$a = shortcode_atts( array(
		'page' => '/',
	), $atts );

	return "<form method='post' action='" . esc_url( admin_url('admin-post.php') ) . "'><input name='pw-redirect' type='password'><input name='page' type='hidden' value='". $a['page'] ."'/><input type='hidden' name='action' value='sic_pw_submit'/><input type='submit' value='submit'/></form>";
}

function sic_redirect_from_password() {
	if ( isset( $_POST['pw-redirect'] )) {
		wp_redirect($_POST['page'] . '?key=' . $_POST['pw-redirect']);
	}
}