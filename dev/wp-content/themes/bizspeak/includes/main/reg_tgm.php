<?php


require_once THEMEWING_DIR . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'themewing_register_required_plugins');

if(!function_exists('themewing_register_required_plugins')):

	function themewing_register_required_plugins()
	{
		$plugins = array(

				array(
					'name'                  => 'js_composer',
					'slug'                  => 'js_composer',
					'source'                => 'http://themewinter.com/WP/plugins/online/js_composer.zip',
					'required'              => false,
					'version'               => '',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => '',
				),

				array(
					'name'                  => 'revslider',
					'slug'                  => 'revslider',
					'source'                => 'http://themewinter.com/WP/plugins/online/revslider.zip',
					'required'              => false,
					'version'               => '',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => '',
				),


				array(
					'name'                  => 'THW Team',
					'slug'                  => 'thw_team',
					'source'                => 'http://themewinter.com/WP/plugins/bizspeak/thw_team.zip',
					'required'              => true,
					'version'               => '',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => '',
				),


				array(
					'name'                  => 'THW Slider',
					'slug'                  => 'thw_slider',
					'source'                => 'http://themewinter.com/WP/plugins/bizspeak/thw_slider.zip',
					'required'              => true,
					'version'               => '',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => '',
				),

				array(
					'name'                  => 'thw partner',
					'slug'                  => 'thw_partner',
					'source'                => 'http://themewinter.com/WP/plugins/bizspeak/thw_partner.zip',
					'required'              => true,
					'version'               => '',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => '',
				),

				array(
					'name'                  => 'thw inustrial',
					'slug'                  => 'thw_inustrial',
					'source'                => 'http://themewinter.com/WP/plugins/bizspeak/thw_inustrial.zip',
					'required'              => true,
					'version'               => '',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => '',
				),

				array(
					'name'                  => 'Contact Form 7',
					'slug'                  => 'contact-form-7',
					'required'              => false,
					'version'               => '',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => 'https://downloads.wordpress.org/plugin/contact-form-7.4.2.2.zip',
				),
				array(
					'name'                  => 'Woocoomerce',
					'slug'                  => 'woocommerce',
					'required'              => false,
					'version'               => '',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => 'https://downloads.wordpress.org/plugin/woocommerce.3.1.0.zip',
				),
				array(
				'name'                  => 'Widget Settings Importer/Exporter',
				'slug'                  => 'widget-settings-importexport',
				'required'              => false,
				'version'               => '',
				'force_activation'      => false,
				'force_deactivation'    => false,
				'external_url'          => 'https://downloads.wordpress.org/plugin/widget-settings-importexport.1.5.0.zip',
				)
			);

	$config = array(
			'domain'            => 'bizspeak',
			'id'           		=> 'tgmpa',
			'default_path'      => '',
			'parent_slug'  		=> 'themes.php',
			'capability'   		=> 'edit_theme_options',
			'menu'              => 'install-required-plugins',
			'has_notices'       => true,
			'dismissable'  		=> true,
			'is_automatic'      => false,
			'message'           => '',
			'strings'           => array(
						'page_title'                                => __( 'Install Required Plugins', 'bizspeak' ),
						'menu_title'                                => __( 'Install Plugins', 'bizspeak' ),
						'installing'                                => __( 'Installing Plugin: %s', 'bizspeak' ),
						'oops'                                      => __( 'Something went wrong with the plugin API.', 'bizspeak'),
						'return'                                    => __( 'Return to Required Plugins Installer', 'bizspeak'),
						'plugin_activated'                          => __( 'Plugin activated successfully.','bizspeak'),
						'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'bizspeak' ),
						'nag_type'									=> 'updated'
				)
	);

	tgmpa( $plugins, $config );

	}

endif;
