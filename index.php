/*
Plugin Name: Late Düzenleme
Plugin URI: https://qnot.net
Description: Late Tarih Sezon Düzenleme 
Version: 1.0
Author: harew
Author URI: https://www.r10.net/profil/32747-harew1.html
*/

// Settings Page: TarihSezon
// Retrieving values: get_option( 'your_field_id' )
class TarihSezon_Settings_Page {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
	}

	public function wph_create_settings() {
		$page_title = 'Tarih Sezon';
		$menu_title = 'Tarih Sezon';
		$capability = 'manage_options';
		$slug = 'TarihSezon';
		$callback = array($this, 'wph_settings_content');
                $icon = 'dashicons-admin-appearance';
		$position = 2;
		add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
		
	}
    
	public function wph_settings_content() { ?>
		<div class="wrap">
			<h1>Tarih Sezon</h1>
			<?php settings_errors(); ?>
			<form method="POST" action="options.php">
				<?php
					settings_fields( 'TarihSezon' );
					do_settings_sections( 'TarihSezon' );
					submit_button();
				?>
			</form>
		</div> <?php
	}

	public function wph_setup_sections() {
		add_settings_section( 'TarihSezon_section', '', array(), 'TarihSezon' );
	}

	public function wph_setup_fields() {
		$fields = array(
                    array(
                        'section' => 'TarihSezon_section',
                        'label' => 'Tarih',
                        'id' => 'late_tarih',
                        'type' => 'text',
                    ),
        
                    array(
                        'section' => 'TarihSezon_section',
                        'label' => 'Sezon',
                        'id' => 'late_sezon',
                        'type' => 'text',
                    )
		);
		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'TarihSezon', $field['section'], $field );
			register_setting( 'TarihSezon', $field['id'] );
		}
	}
	public function wph_field_callback( $field ) {
		$value = get_option( $field['id'] );
		$placeholder = '';
		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}
		switch ( $field['type'] ) {
            
            
			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$placeholder,
					$value
				);
		}
		if( isset($field['desc']) ) {
			if( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', $desc );
			}
		}
	}
    
}
new TarihSezon_Settings_Page();
