<?php
function wpcf7_generate_rand_number( $wpcf7_data ) {
	$properties = $wpcf7_data->get_properties();
	$shortcode = '[rand-generator]';
	$mail = $properties['mail']['body'];
	$mail_2 = $properties['mail_2']['body'];
	if( preg_match( "/{$shortcode}/", $mail ) || preg_match( "/[{$shortcode}]/", $mail_2 ) ) {
		$option = 'wpcf7sg_' . $wpcf7_data->id();
		$sequence_number = (int)get_option( $option ) + 1;
		update_option( $option, $sequence_number );

		$properties['mail']['body'] = str_replace( $shortcode, $sequence_number, $mail );
		$properties['mail_2']['body'] = str_replace( $shortcode, $sequence_number, $mail_2 );

		$wpcf7_data->set_properties( $properties );
	}
}
add_action( 'wpcf7_before_send_mail', 'wpcf7_generate_rand_number' );
?>
