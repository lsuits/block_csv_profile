<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * CSV profile field import/update/delete block.
 *
 * @package   block_csv_profile
 * @copyright 2012 onwared Ted vd Brink, Brightally custom code
 * @copyright 2018 onwards Robert Russo, Louisiana State University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['manageuploads'] = 'Manage uploaded files';
$string['pluginname'] = 'Update profile fields with CSV';
$string['csvprofile'] = 'Update profiles CSV';
$string['uploadcsv'] = 'Upload your CSV here:';
$string['csv_profile:uploadcsv'] = 'Upload your CSV here:';
$string['resultfiles'] = 'Result of your profile updates:';
$string['title'] = 'Update {$a} profile fields';
$string['description'] = 'You can upload your CSV file with usernames, emails, or idnumber of Moodle users here, so that the "{$a}" field will be updated.';
$string['updating'] = 'Updating profile fields...<br />';
$string['alreadyupdated'] = 'User {$a} already has the required profile field.<br />';
$string['updatinguser'] = 'Updating user {$a} - ';
$string['updateduser'] = 'User profile field updated for {$a}.<br />';
$string['deleteduser'] = 'User profile field deleted for moodle userid {$a}.<br />';
$string['inserteduser'] = 'User profile field inserted for {$a}.<br />';
$string['fieldnotfound'] = 'Could not find field {$a}.<br />';
$string['usernotfound'] = 'Could not find user {$a}.<br />';
$string['done'] = 'Updating profile fields done.<br />';
$string['status'] = 'Updating profile fields done.<br />Result: {$a->success} inserted, {$a->updatesuccess} updated, {$a->failed} failed, and {$a->deleted} deleted.<br /><br />';
$string['updatelog'] = 'Log of updates:';
$string['csv_profile:addinstance'] = 'Add a new CSV Profile Block';
$string['csv_profile:myaddinstance'] = 'Add a new CSV Profile Block';
$string['userfield'] = 'User Field';
$string['userfielddesc'] = 'The field that identifies a user for updating their profile field';
