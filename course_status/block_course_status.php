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
 * Block definition class for the block_pluginname plugin.
 *
 * @package   block_course_status
 * @copyright 2023, bhupathi
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// ...This file will hold the class definition for the block, and is used both to manage it as a plugin and to render it onscreen.
class block_course_status extends block_base {
    public function init() {
         $this->title = get_string('pluginname', 'block_course_status');
    }
    // Get the course data start with this function.
    public function get_content() {

        if ($this->content !== null) {
            return $this->content;
        }
        if (!isloggedin() || isguestuser()) {
            // Only real users can access testblock block.
            return;
        }

        /*We are creating a renderable and telling our renderer to render it. than this,
         it should hold all the data required for the renderer to display page.*/
        $renderable = new \block_course_status\output\course_status();
        $renderer = $this->page->get_renderer('block_course_status');
        $this->content = new stdClass();
        $this->content->text = $renderer->render($renderable);
        $this->content->footer = '';
        return $this->content;
    }

    // ...It would be really nice to be able to add multiple blocks of this type to a single course
    public function instance_allow_multiple() {
        return true;
    }

    // ...This function indicates where to block vissible
    public function applicable_formats() {
        return array(
        'all' => false,
        'site' => false,
        'my' => false,
        'site-index' => false,
        'course-view' => true,
        'course-view-social' => false,
        'mod' => false,
        'mod-quiz' => false
        );
    }
}
