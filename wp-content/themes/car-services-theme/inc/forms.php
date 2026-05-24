<?php
/**
 * Front-end Form Submission Handlers
 *
 * Processes the theme's built-in fallback forms (contact page + Book Now
 * modal). These handlers only run when a third-party shortcode (CF7, WPForms,
 * etc.) has NOT been configured — in which case the fallback HTML <form>
 * submits here via admin-post.php.
 *
 * Actions:
 *   cs_contact_form — contact page form  (both logged-in and guests)
 *   cs_book_form    — Book Now modal form (both logged-in and guests)
 *
 * On success / failure the user is redirected back to the referring page
 * with a `?cs_status=sent` or `?cs_status=error` query string.
 * Templates can read this to show a confirmation or error message.
 *
 * @package Car_Services_Theme
 * @since   1.2.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -----------------------------------------------------------------------
 * Shared: build and send the notification e-mail.
 *
 * @param  array  $data   Sanitized form data.
 * @param  string $source 'contact' or 'booking' — used in e-mail subject.
 * @return bool           True if wp_mail() succeeded.
 * ----------------------------------------------------------------------- */
function car_services_send_form_email( array $data, $source = 'contact' ) {
	$to      = get_option( 'admin_email' );
	$label   = 'booking' === $source
		? esc_html__( 'New Booking Request', 'car-services-theme' )
		: esc_html__( 'New Contact Message', 'car-services-theme' );

	/* translators: 1: Label, 2: Site name, 3: Sender name */
	$subject = sprintf( '[%2$s] %1$s — %3$s', $label, get_bloginfo( 'name' ), $data['name'] );

	$body  = sprintf( "Name:    %s\n", $data['name'] );
	$body .= sprintf( "Email:   %s\n", $data['email'] );
	$body .= sprintf( "Phone:   %s\n", $data['phone'] );
	if ( ! empty( $data['service'] ) ) {
		$body .= sprintf( "Service: %s\n", $data['service'] );
	}
	if ( ! empty( $data['vehicle'] ) ) {
		$body .= sprintf( "Vehicle: %s\n", $data['vehicle'] );
	}
	$body .= sprintf( "\nMessage:\n%s\n", $data['message'] );

	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( $data['email'] ) {
		$headers[] = sprintf( 'Reply-To: %s <%s>', $data['name'], $data['email'] );
	}

	return wp_mail( $to, $subject, $body, $headers );
}

/* -----------------------------------------------------------------------
 * Contact page form handler  (action = cs_contact_form)
 * ----------------------------------------------------------------------- */
function car_services_handle_contact_form() {
	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	if ( empty( $_POST['cs_contact_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['cs_contact_nonce'] ), 'cs_contact_form' ) ) {
		wp_die( esc_html__( 'Security check failed. Please go back and try again.', 'car-services-theme' ), 403 );
	}

	$data = array(
		'name'    => sanitize_text_field( wp_unslash( $_POST['cs_name']    ?? '' ) ),
		'email'   => sanitize_email( wp_unslash( $_POST['cs_email']        ?? '' ) ),
		'phone'   => sanitize_text_field( wp_unslash( $_POST['cs_phone']   ?? '' ) ),
		'service' => sanitize_text_field( wp_unslash( $_POST['cs_service'] ?? '' ) ),
		'vehicle' => sanitize_text_field( wp_unslash( $_POST['cs_vehicle'] ?? '' ) ),
		'message' => sanitize_textarea_field( wp_unslash( $_POST['cs_message'] ?? '' ) ),
	);

	if ( empty( $data['name'] ) || empty( $data['message'] ) ) {
		wp_safe_redirect( add_query_arg( 'cs_status', 'error', wp_get_referer() ) );
		exit;
	}

	$sent = car_services_send_form_email( $data, 'contact' );

	wp_safe_redirect( add_query_arg( 'cs_status', $sent ? 'sent' : 'error', wp_get_referer() ) );
	exit;
}
add_action( 'admin_post_cs_contact_form',        'car_services_handle_contact_form' );
add_action( 'admin_post_nopriv_cs_contact_form', 'car_services_handle_contact_form' );

/* -----------------------------------------------------------------------
 * Book Now modal form handler  (action = cs_book_form)
 * ----------------------------------------------------------------------- */
function car_services_handle_book_form() {
	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	if ( empty( $_POST['cs_book_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['cs_book_nonce'] ), 'cs_book_form' ) ) {
		wp_die( esc_html__( 'Security check failed. Please go back and try again.', 'car-services-theme' ), 403 );
	}

	$data = array(
		'name'    => sanitize_text_field( wp_unslash( $_POST['cs_name']    ?? '' ) ),
		'email'   => sanitize_email( wp_unslash( $_POST['cs_email']        ?? '' ) ),
		'phone'   => sanitize_text_field( wp_unslash( $_POST['cs_phone']   ?? '' ) ),
		'service' => sanitize_text_field( wp_unslash( $_POST['cs_service'] ?? '' ) ),
		'vehicle' => '',
		'message' => sanitize_textarea_field( wp_unslash( $_POST['cs_message'] ?? '' ) ),
	);

	if ( empty( $data['name'] ) || empty( $data['phone'] ) ) {
		wp_safe_redirect( add_query_arg( 'cs_status', 'error', wp_get_referer() ) );
		exit;
	}

	$sent = car_services_send_form_email( $data, 'booking' );

	wp_safe_redirect( add_query_arg( 'cs_status', $sent ? 'sent' : 'error', wp_get_referer() ) );
	exit;
}
add_action( 'admin_post_cs_book_form',        'car_services_handle_book_form' );
add_action( 'admin_post_nopriv_cs_book_form', 'car_services_handle_book_form' );
