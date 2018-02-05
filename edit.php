<?php

require('../../config.php');
require_once("$CFG->dirroot/blocks/csv_profile/edit_form.php");
require_once("$CFG->dirroot/blocks/csv_profile/locallib.php");
require_once("$CFG->dirroot/repository/lib.php");

GLOBAL $USER;
require_login();

$context = context_system::instance();
if (!has_capability('block/csv_profile:uploadcsv',$context,$USER->id)) {
    die("Unauthorized.");
}

$title = get_string('csvprofile','block_csv_profile');
$struser = get_string('user');

$PAGE->set_context($context);
$PAGE->set_url('/blocks/csv_profile/edit.php');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_pagelayout('standard');

$data = new stdClass();
$options = array('subdirs' => 1, 'maxbytes' => $CFG->userquota, 'maxfiles' => - 1, 'accepted_types' => '*.csv', 'return_types' => FILE_INTERNAL);

file_prepare_standard_filemanager($data, 'files', $options, $context, 'user', 'csvprofile', 0);

$mform = new block_csv_profile_form(null, array('data' => $data, 'options' => $options));

$formdata = $mform->get_data();
//3 options: file uploaded, cancelled, or saved
if ($mform->is_cancelled()) {
   redirect(new moodle_url($CFG->wwwroot.'/blocks/csv_profile/edit.php'));  
} else if ($formdata && $mform->get_file_content('userfile')) {
    
    //upload file, store, and process csv
    $content = $mform->get_file_content('userfile'); //save uploaded file
    $fs = get_file_storage();

    //Cleanup old files:
    //First, create target directory:
    if(!$fs->file_exists($context->id, 'user', 'csvprofile', 0, '/', 'History'))
    $fs->create_directory($context->id, 'user', 'csvprofile', 0, '/History/',$USER->id);

    //Second, move all files to created dir
    $areafiles = $fs->get_area_files($context->id, 'user', 'csvprofile',false, "filename", false);
    $filechanges = array("filepath"=>'/History/');
    foreach ($areafiles as $key => $areafile) {
        if($areafile->get_filepath()=="/")
        {
            $fs->create_file_from_storedfile($filechanges, $areafile); //copy file to new location
            $areafile->delete(); //remove old copy
        }
    }

    $filename = "upload_".date("Ymd_His").".csv";
    
    // Prepare file record object
    $fileinfo = array(
	    'contextid' => $context->id, // ID of context
	    'component' => 'user',     // usually = table name
	    'filearea' => 'csvprofile',     // usually = table name
	    'itemid' => 0,               // usually = ID of row in table
	    'filepath' => '/',           // any path beginning and ending in /
	    'filename' => $filename,// any filename
	    'userid' => $USER->id );
    
    // Create file containing uploaded file content
    $newfile = $fs->create_file_from_string($fileinfo, $content);

    // Read CSV and get results
    $log = block_csv_profile_update_users($content);

    //save log file, reuse fileinfo from csv file
    //$fileinfo['filename'] = "upload_".date("Ymd_His")."_log.txt";

    //$newfile = $fs->create_file_from_string($fileinfo['filename'], $log);

    mtrace($log);

    // Back to main page
    redirect(new moodle_url($CFG->wwwroot.('/blocks/csv_profile/edit.php'))); 
    
} else if ($formdata &&  !$mform->get_file_content('userfile')) {
    
    // Just show the updated filemanager
    $formdata = file_postupdate_standard_filemanager($formdata, 'files', $options, $context, 'user', 'csvprofile', 0);
    
}

echo $OUTPUT->header();
echo $OUTPUT->box_start('generalbox');
$mform->display();
echo $OUTPUT->box_end();
echo $OUTPUT->footer();
