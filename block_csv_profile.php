<?php

class block_csv_profile extends block_base {

    function init() {
    	$this->title = get_string('csvprofile','block_csv_profile');
    }

    function has_config() {
    	return true;
    }
    
    function applicable_formats() {
        return array('site' => true);
    }

    function instance_allow_multiple() {
        return false;
    }

    function get_content() {
        global $CFG, $USER, $PAGE, $OUTPUT;

    	$currentcontext = context_system::instance();
	
        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->text = '';
        $this->content->footer = '';
        if (isloggedin() && has_capability('block/csv_profile:uploadcsv', $currentcontext, $USER->id)) {

            $renderer = $this->page->get_renderer('block_csv_profile');
            $this->content->text = $renderer->csv_profile_tree($currentcontext);

            $this->content->text .= $OUTPUT->single_button(new moodle_url('/blocks/csv_profile/edit.php',
                array('returnurl'=>$PAGE->url->out())),
				get_string('manageuploads','block_csv_profile'), 'get');

        }
        return $this->content;
    }

}
