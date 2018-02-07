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

require_once("$CFG->libdir/formslib.php");
class block_csv_profile_form extends moodleform {
    public function definition() {
        $mform = $this->_form;
        $data = $this->_customdata['data'];
        $options = $this->_customdata['options'];
        $mform->setType('id', PARAM_INT);
        $mform->addElement('static', 'name', "", get_string('description', 'block_csv_profile'));
        $mform->addElement('filepicker', 'userfile',
                get_string('uploadcsv', 'block_csv_profile'),
                null, array('accepted_types' => '*.csv'));
        $mform->addElement('filemanager', 'files_filemanager', get_string('resultfiles', 'block_csv_profile'), null, $options);
        $mform->addElement('html',
                '<style>#page-blocks-csv_profile-edit .fp-btn-add,
                 #page-blocks-csv_profile-edit .fp-btn-mkdir { display: none; }</style>'
                );
        $this->add_action_buttons(true, get_string('savechanges'));
        $this->set_data($data);
    }
}
