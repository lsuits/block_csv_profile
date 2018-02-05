<?php

defined('MOODLE_INTERNAL') || die;


if ($ADMIN->fulltree) {
	$settings->add(
		new admin_setting_heading(
			'csv_profile/heading',
			'Setttings',
			'Select the type of field that will be used to identify each user.'
		)
	);
	
	$options = array(0 => 'username', 1 => 'email', 2 => 'idnumber');
	
	$settings->add(new admin_setting_configselect('block_csv_profile/userfield',
			get_string('userfield', 'block_csv_profile'), get_string('userfielddesc', 'block_csv_profile'),
			'', $options));
         $settings->add(new admin_setting_configtext('block_csv_profile/profilefield',
                'Field shortname', 'Please enter the shortname of the field you want to populate.', 'nsse'));
}


