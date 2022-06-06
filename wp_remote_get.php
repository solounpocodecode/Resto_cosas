<?php
//Comentarios obligatorios para crear un plugin
/**
 * Plugin name: Query APIs
 * Plugin URI: https://omukiguy.com
 * Description: Get information from external APIs in WordPress
 * Author: Laurence Bahiirwa
 * Author URI: https://omukiguy.com
 * version: 0.1.0
 * License: GPL2 or later.
 * text-domain: query-apis
 */

//Si acceden a este archivo directamente, abortar
//Con esta linea de codigo hacemos que no puedan accerder a un archivo por la URL
defined( 'ABSPATH' ) or die( 'Unauthorized Access' );
function traer_informacionAPI() {
    $url = 'https://jsonplaceholder.typicode.com/users';
    $arguments = array(
        'method' => 'GET'
    );
	$response = wp_remote_get( $url, $arguments );
	if (is_wp_error( $response )) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} else {
		echo '<pre>';
		var_dump( wp_remote_retrieve_body( $response ) );
		echo '</pre>';
	}
}	

/**
 * Crear un menu personalizador para ver la informacion requerida
 */
function mostrar_informacionAPI() {
	add_menu_page(
		__( 'Query API Test Settings', 'query-apis' ),
		'Query API Test',
		'manage_options',
		'api-test.php',
		'traer_informacionAPI',
		'dashicons-testimonial',
		16
	);
}
add_action( 'admin_menu', 'mostrar_informacionAPI' );
?>