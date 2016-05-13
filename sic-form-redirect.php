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
 * Description: User enters a password in to a form field and is redirected to a page of your choice.
 * Version:     1.0.0
 * Author:      Your Name
 * Author URI:  https://sicdigital.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

add_shortcode( 'pw-redirect-field', 'sic_password_field' );

add_action( 'admin_post_nopriv_sic_pw_submit', 'sic_redirect_from_password' );
add_action( 'admin_post_sic_pw_submit', 'sic_redirect_from_password' );

//Create a shortcode that outputs a password form with some hidden fields to pass extra data
function sic_password_field( $atts ) {
	$a = shortcode_atts( array(
		'page' => '/',
	), $atts );

	return "<form method='post' action='" . esc_url( admin_url('admin-post.php') ) . "'><input name='pw-redirect' type='password'><input name='page' type='hidden' value='". $a['page'] ."'/><input type='hidden' name='action' value='sic_pw_submit'/><input type='submit' value='submit'/></form>";
}

function sic_redirect_from_password() {
	if ( isset( $_POST['pw-redirect'] )) {

		//Make an array of keys that you want to accept, if $_POST['pw-redirect'] is equal to one of these set $key_valid to true
		$key_valid = true;

		if($key_valid){
			wp_redirect($_POST['page'] . '?key=' . $_POST['pw-redirect']);
		}else{
			echo 'Key is incorrect';
		}
	}
}