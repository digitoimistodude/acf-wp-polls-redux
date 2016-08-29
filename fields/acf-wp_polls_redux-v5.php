<?php

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// Check if class already exists
if( !class_exists('acf_field_wp_polls_redux') ) :


class acf_field_wp_polls_redux extends acf_field {


 /**
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct( $settings ) {

		/**
		*  Name (string) Single word, no spaces. Underscores allowed
		*/
		$this->name = 'wp_polls_redux';


		/**
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/

		$this->label = __('WP-Polls', 'acf-wp_polls_redux');


		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/

		$this->category = 'relational';


		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/

		$this->defaults = array(
			'font_size'	=> 14,
		);


		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('wp_polls_redux', 'error');
		*/

		$this->l10n = array(
			'error'	=> __('Error! Please enter a higher value', 'acf-wp_polls_redux'),
		);


		/*
		*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
		*/

		$this->settings = $settings;


		// do not delete!
    	parent::__construct();

	}


	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/

	function render_field_settings( $field ) {

		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/

		acf_render_field_setting( $field, array(
			'label'			=> __('WP-Polls','acf-wp_polls_redux'),
			'instructions'	=> __('Choose the poll you want to display.','acf-wp_polls_redux'),
			'name'			=> 'acfpoll',
		));

	}



	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/

	function render_field( $field ) {
    global $wpdb;

    $polls = $wpdb->get_results("SELECT pollq_id, pollq_question, pollq_active FROM $wpdb->pollsq WHERE pollq_active != -1", ARRAY_A);
    $choices = array();

    foreach( $polls as $poll ) {
      $choices[ $poll['pollq_id']] = $poll['pollq_question'].($poll['pollq_active']==0?' [closed]':'' );
    }

    ?>

    <select name="<?php echo esc_attr($field['name']) ?>">
      <option><?php _e(' - Choose - ', 'acf-wp_polls_redux'); ?></option>
      <?php foreach( $choices as $choice_id => $choice ) {

        if ( $field['value'] == $choice_id ) { ?>

          <option value="<?php echo $choice_id; ?>" selected><?php echo $choice; ?></option>

        <?php } else { ?>

          <option value="<?php echo $choice_id; ?>"><?php echo $choice; ?></option>

        <?php }
      } ?>
    </select>

		<?php
	}

}


// Initialize
new acf_field_wp_polls_redux( $this->settings );

// Class_exists check
endif;

?>
