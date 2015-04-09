<?php
/**
 * Plugin Name: Caldera Forms - Run Action
 * Plugin URI:  
 * Description: Runs an action on submit
 * Version: 1.0.0
 * Author:      David Cramer
 * Author URI:
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Translation Domain: cf-run-action
 */


add_filter('caldera_forms_get_form_processors', 'cf_run_action_register_processor');
/**
 * Add processor
 *
 * @uses "caldera_forms_get_form_processors" filter
 *
 * @since 1.0.0
 *
 * @return array Processors
 */
function cf_run_action_register_processor($pr){
	$pr['run_action'] = array(
		"name"              =>  __('Run Action'),
		"description"       =>  __("Run Action on submission"),
		"author"            =>  'David Cramer',
		"author_url"        =>  'http://cramer.co.za',
		"processor"         =>  'cf_run_action_process',
		"template"          =>  plugin_dir_path(__FILE__) . "config.php",
	);

	return $pr;
}

/**
 * Callback function for the processor
 *
 * @since 1.0.0
 *
 * @param array $config Processor settings. Key 'action' has action name.
 * @param array $form Form submission data.
 */
function cf_run_action_process( $config, $form){
	
	$data = array();
	foreach($form['fields'] as $field_id=>$field){
		$data[$field['slug']] = Caldera_Forms::get_field_data($field_id, $form);
	}

	/**
	 * The action this processor calls. Named according to form setting.
	 *
	 * @param array $data Array of form data, keyed by field ID.
	 * @param array $form Form submission data.
	 */
	do_action($config['action'], $data, $form);

}


