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
 * The single_submission_page_viewed event
 *
 * @package mod_panoptosubmission
 * @copyright  Panopto 2021
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_panoptosubmission\event;

defined('MOODLE_INTERNAL') || die();
/**
 * The single_submission_page_viewed event class.
 *
 * @package mod_panoptosubmission
 * @copyright  Panopto 2021
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class single_submission_page_viewed extends \core\event\base {
    protected function init() {
        $this->data['crud'] = 'r'; // c(reate), r(ead), u(pdate), d(elete)
        $this->data['edulevel'] = self::LEVEL_TEACHING;
        $this->data['objecttable'] = 'panoptosubmission_submission';
    }
 
    public static function get_name() {
        return get_string('eventsingle_submission_page_viewed', 'panoptosubmission');
    }
 
    public function get_description() {
        return "The user with id '{$this->userid}' viewed the submission with id '{$this->objectid}'"
        . " for the Panopto Student Submission activity with the course module id of '{$this->contextinstanceid}'.";
    }
 
    public function get_url() {
        return new \moodle_url('/mod/panoptosubmission/single_submission.php', array('cmid' => $this->contextinstanceid));
    }
 
    public function get_legacy_logdata() {
        return array($this->courseid, 'panoptosubmission', 'view submission page',
            $this->get_url(), $this->objectid, $this->contextinstanceid);
    }
}