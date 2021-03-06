<?php
/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class Peervadoo {
	private $peervadoo_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'peervadoo_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'peervadoo_page_init' ) );
	}

	public function peervadoo_add_plugin_page() {
		add_options_page(
			'Peervadoo', // page_title
			'Peervadoo', // menu_title
			'manage_options', // capability
			'peervadoo', // menu_slug
			array( $this, 'peervadoo_create_admin_page' ) // function
		);
	}

	public function peervadoo_create_admin_page() {
		$this->peervadoo_options = get_option( 'peervadoo_option_name' ); ?>

		<div class="wrap">
			<h2>Peervadoo</h2>
			<p>You can find your API Token by logging in to https://api.peervadoo.com/addapp</p>
            <h3>Shortcode Instructions:</h3>
            <p>[peervadoo url="" autoplay="true" muted="false" watermark=""]</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'peervadoo_option_group' );
					do_settings_sections( 'peervadoo-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function peervadoo_page_init() {
		register_setting(
			'peervadoo_option_group', // option_group
			'peervadoo_option_name', // option_name
			array( $this, 'peervadoo_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'peervadoo_setting_section', // id
			'Settings', // title
			array( $this, 'peervadoo_section_info' ), // callback
			'peervadoo-admin' // page
		);

		add_settings_field(
			'peervadoo_api_token_0', // id
			'Peervadoo API Token', // title
			array( $this, 'peervadoo_api_token_0_callback' ), // callback
			'peervadoo-admin', // page
			'peervadoo_setting_section' // section
		);

		add_settings_field(
			'video_player_1', // id
			'Video Player', // title
			array( $this, 'video_player_1_callback' ), // callback
			'peervadoo-admin', // page
			'peervadoo_setting_section' // section
		);
	}

	public function peervadoo_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['peervadoo_api_token_0'] ) ) {
			$sanitary_values['peervadoo_api_token_0'] = sanitize_text_field( $input['peervadoo_api_token_0'] );
		}

		if ( isset( $input['video_player_1'] ) ) {
			$sanitary_values['video_player_1'] = $input['video_player_1'];
		}

		return $sanitary_values;
	}

	public function peervadoo_section_info() {

	}

	public function peervadoo_api_token_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="peervadoo_option_name[peervadoo_api_token_0]" id="peervadoo_api_token_0" value="%s">',
			isset( $this->peervadoo_options['peervadoo_api_token_0'] ) ? esc_attr( $this->peervadoo_options['peervadoo_api_token_0']) : ''
		);
	}

	public function video_player_1_callback() {
		?> <select name="peervadoo_option_name[video_player_1]" id="video_player_1">
			<?php $selected = (isset( $this->peervadoo_options['video_player_1'] ) && $this->peervadoo_options['video_player_1'] === 'clappr') ? 'selected' : '' ; ?>
			<option value="clappr" <?php echo $selected; ?>>Clappr</option>
			<?php $selected = (isset( $this->peervadoo_options['video_player_1'] ) && $this->peervadoo_options['video_player_1'] === 'videojs') ? 'selected' : '' ; ?>
			<option value="videojs" <?php echo $selected; ?>>VideoJS</option>
		</select>
		<?php
	}

}
if ( is_admin() )
	$peervadoo = new Peervadoo();

/*
 * Retrieve this value with:
 * $peervadoo_options = get_option( 'peervadoo_option_name' ); // Array of All Options
 * $peervadoo_api_token_0 = $peervadoo_options['peervadoo_api_token_0']; // peervadoo API Token
 * $video_player_1 = $peervadoo_options['video_player_1']; // Video Player
 */
