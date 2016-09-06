<?php
/**
 * Plugin Name: ButterBean TinyMCE Control
 * Plugin URI:  https://github.com/slaFFik/butterbean-tinymce
 * Description: Add new control for ButterBean - TinyMCE.
 * Version:     0.1.1
 * Author:      slaFFik
 * Author URI:  https://ovirium.com
 *
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( ! class_exists( 'ButterBean_TinyMCE_Example' ) ) {

	final class ButterBean_TinyMCE_Example {
		/**
		 * Directory path to the plugin folder.
		 *
		 * @var string
		 */
		public $type = 'tinymce';
		/**
		 * Directory path to the plugin folder.
		 *
		 * @var string
		 */
		public $dir_path = '';
		/**
		 * Directory URI to the plugin folder.
		 *
		 * @var string
		 */
		public $dir_uri = '';

		/**
		 * Sets up initial actions.
		 */
		private function setup_actions() {
			$this->dir_path = trailingslashit( plugin_dir_path( __FILE__ ) );
			$this->dir_uri  = trailingslashit( plugin_dir_url( __FILE__ ) );

			// Call the register function.
			add_action( 'butterbean_register', array( $this, 'register' ), 10, 2 );
			add_filter( "butterbean_control_template", array( $this, 'get_control_template' ), 10, 2 );
		}

		/**
		 * Registers managers, sections, controls, and settings.
		 *
		 * @param  ButterBean $butterbean Instance of the `ButterBean` object.
		 * @param  string $post_type This plugins enables for all CPTs
		 */
		public function register( $butterbean, $post_type ) {
			/** @var $manager ButterBean_Manager */
			$butterbean->register_manager(
				'butterbean_tinymce_manager',
				array(
					'label'     => 'ButterBean TinyMCE',
					'post_type' => $post_type,
					'context'   => 'normal',
					'priority'  => 'high'
				)
			);

			$manager = $butterbean->get_manager( 'butterbean_tinymce_manager' );

			if ( ! class_exists( 'ButterBean_Control_Tinymce' ) ) {
				include_once $this->dir_path . 'controls/class-control-tinymce.php';
			}

			$butterbean->register_control_type( $this->type, 'ButterBean_Control_Tinymce' );

			$manager->register_section(
				'section_1',
				array(
					'label' => '1 TinyMCE Editor',
					'icon'  => 'dashicons-edit'
				)
			);
			$manager->register_control(
				'butterbean_tinymce_control_11', // Same as setting name.
				array(
					'type'        => $this->type,
					'section'     => 'section_1',
					'attr'        => array( 'class' => 'widefat' ),
					'label'       => 'Example TinyMCE 1.1',
					'description' => 'Tich test editing using TinyMCE.'
				)
			);
			$manager->register_setting(
				'butterbean_tinymce_control_11', // Same as control name.
				array( 'sanitize_callback' => 'wp_kses_post' )
			);

			$manager->register_section(
				'section_2',
				array(
					'label' => '2 TinyMCE Editors',
					'icon'  => 'dashicons-edit'
				)
			);
			$manager->register_control(
				'butterbean_tinymce_control_21', // Same as setting name.
				array(
					'type'        => $this->type,
					'section'     => 'section_2',
					'attr'        => array( 'class' => 'widefat' ),
					'label'       => 'Example TinyMCE 2.1',
					'description' => 'Tich test editing using TinyMCE.'
				)
			);
			$manager->register_setting(
				'butterbean_tinymce_control_21', // Same as control name.
				array( 'sanitize_callback' => 'wp_kses_post' )
			);
			$manager->register_control(
				'butterbean_tinymce_control_22', // Same as setting name.
				array(
					'type'        => $this->type,
					'section'     => 'section_2',
					'attr'        => array( 'class' => 'widefat' ),
					'label'       => 'Example TinyMCE 2.2',
					'description' => 'Tich test editing using TinyMCE.'
				)
			);
			$manager->register_setting(
				'butterbean_tinymce_control_22', // Same as control name.
				array( 'sanitize_callback' => 'wp_kses_post' )
			);

		}

		/**
		 * Register a new template file for a custom control.
		 *
		 * @param string $located Path to a template file.
		 * @param string $slug Control type.
		 *
		 * @return string
		 */
		public function get_control_template( $located, $slug ) {
			if ( $slug === $this->type && file_exists( $this->dir_path . 'tmpl/control-tinymce.php' ) ) {
				return $this->dir_path . 'tmpl/control-tinymce.php';
			}

			return $located;
		}

		/**
		 * Returns the instance.
		 *
		 * @return ButterBean_TinyMCE_Example
		 */
		public static function get_instance() {

			static $instance = null;

			if ( is_null( $instance ) ) {
				$instance = new self;
				$instance->setup_actions();
			}

			return $instance;
		}

		/**
		 * Constructor method.
		 */
		private function __construct() {
		}
	}

	ButterBean_TinyMCE_Example::get_instance();

}
