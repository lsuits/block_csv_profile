<?php

function block_csv_profile_update_users($csvcontent) {
    global $DB, $CFG;
    $userfield = block_csv_profile_get_fieldtype();
    $profilefieldid = block_csv_profile_get_profilefieldid();

    $stats = new StdClass();
    $stats->success = $stats->failed = 0; //init counters
    $log = get_string('updating','block_csv_profile')."\r\n";

    // Replace \r\n with \n, replace any leftover \r with \n, explode on \n
    $lines = explode("\n", preg_replace("/\r/", "\n", preg_replace("/\r\n/", "\n", $csvcontent)));
    if (end($lines) == '') {
        return array_slice($lines, 0, count($lines) - 1, true);
    } else {
        return $lines;
    }
    foreach ($lines as $line) {
        if($line=="") {
            continue;
        }

        $fields = array_map('trim', explode(',', $line));

        $user = $DB->get_record('user', array($userfield => $fields[0]));

        if($user && !$user->deleted) {
            $log .= get_string('updatinguser','block_csv_profile',fullname($user).' ('. $fields[1] .')')."\r\n";

            $data = new stdClass();
            $data->userid        = $user->id;
            $data->fieldid       = $profilefieldid;
            $data->data          = $fields[1];
            $data->dataformat    = 0;
            $DB->insert_record('user_info_data', $data);

            $log .= get_string('updateduser','block_csv_profile', fullname($user) . ' (' . $fields[1] . ')') . "\r\n";
            $stats->success++;
        } else {
            $log .= get_string('usernotfound','block_csv_profile', $fields[0]) . "\r\n";
            $stats->failed++;
        }
    }    
    $log .= get_string('done','block_csv_profile')."\r\n";
    $log = get_string('status','block_csv_profile',$stats).' '.get_string('updatelog','block_csv_profile')."\r\n\r\n".$log;
    return $log;
}

function block_csv_profile_get_fieldtype() {

    $userfieldid = (int)get_config('csv_profile', 'userfield');
    
    switch($userfieldid) {
    case 0:
    default:
        return 'username';
    case 1:
        return 'email';
    case 2:
        return 'idnumber';
    }
}

function block_csv_profile_get_profilefieldid() {
    global $CFG, $DB;

    $profilefield = (string)get_config('block_csv_profile', 'profilefield');
    $profilefid = $DB->get_record('user_info_field', array('shortname' => $profilefield));
    $profilefieldid = $profilefid->id;

    return $profilefieldid; 

}
