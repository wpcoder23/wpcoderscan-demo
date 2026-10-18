<?php
/**
 * Plugin Name: Demo podatnej wtyczki
 * Description: CELOWO PODATNY kod do pokazania działania WPCoderScan. Nie instaluj tego na żadnej stronie.
 * Version: 1.0.0
 * License: GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Wstrzyknięcie SQL: dane z adresu trafiają wprost do zapytania.
function demo_find_order() {
	global $wpdb;
	return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}demo_orders WHERE id = " . $_GET['id'] );
}

// Odbity XSS: dane z adresu trafiają do HTML bez ucieczki.
function demo_render_search_box() {
	?>
	<div class="demo-search">
		<h2>Wyniki dla: <?php echo $_GET['q']; ?></h2>
		<input type="text" name="q" value="<?php echo $_GET['q']; ?>">
		<a href="<?php echo $_GET['back']; ?>">Wróć</a>
	</div>
	<?php
}

// Wstrzyknięcie obiektu PHP: dane z formularza trafiają do unserialize.
function demo_load_settings() {
	return unserialize( $_POST['settings'] );
}

// Brak kontroli dostępu: trasa REST bez permission_callback.
add_action(
	'rest_api_init',
	function () {
		register_rest_route(
			'demo/v1',
			'/orders',
			array(
				'methods'  => 'POST',
				'callback' => 'demo_find_order',
			)
		);
	}
);

// Brak sanitizacji opcji.
add_action(
	'admin_init',
	function () {
		register_setting( 'demo_group', 'demo_option' );
	}
);
