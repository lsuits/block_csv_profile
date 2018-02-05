<?php

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

class block_csv_profile_form extends moodleform {
    function definition() {
        $mform = $this->_form;

        $data    = $this->_customdata['data'];
        $options = $this->_customdata['options'];
        
        $mform->setType('id', PARAM_INT);

        $mform->addElement('static', 'name', "", get_string('description', 'block_csv_profile'));
        
    	$mform->addElement('filepicker', 'userfile', get_string('uploadcsv','block_csv_profile'), null, array('accepted_types' => '*.csv'));

        $mform->addElement('filemanager', 'files_filemanager', get_string('resultfiles','block_csv_profile'), null, $options);
        $mform->addElement('html','<style>#page-blocks-csv_profile-edit .fp-btn-add, #page-blocks-csv_profile-edit .fp-btn-mkdir { display: none; }</style>');

        $this->add_action_buttons(true, get_string('savechanges'));

        $this->set_data($data);
    }
}
