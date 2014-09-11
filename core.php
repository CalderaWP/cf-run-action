<?php
/**
 * Plugin Name: Caldera Forms - Run Action
 * Plugin URI:  
 * Description: Runs an action on submit
 * Version:     1.0.0
 * Author:      David Cramer
 * Author URI:  
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */



// add filters
add_filter('caldera_forms_get_form_processors', 'cf_run_action_register_processor');
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
function cf_run_action_process($config, $form){
	
	$data = array();
	foreach($form['fields'] as $field_id=>$field){
		$data[$field['slug']] = Caldera_Forms::get_field_data($field_id, $form);
	}

	do_action($config['action'], $data, $form);

}


add_action('my_text_action', 'my_test_function');
function my_test_function($data){
	update_option('test_form_option', $data);
}
