<?php
/**
 * TinyMCE control class.
 *
 * @since  1.0.0
 * @access public
 */
class ButterBean_Control_Tinymce extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'tinymce';

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value'] = $this->get_value();
	}

	/**
	 * Gets the attributes for the control.
	 * Sets the new id attribute, as it's required for TinyMCE to function properly.
	 * Sets new class .tinymce for easier js initialization.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_attr() {
		$this->attr = parent::get_attr();

		$this->attr['class'] .= ' tinymce';
		$this->attr['id'] = $this->get_field_name();

		return $this->attr;
	}
}
