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
 * course_renderer.php
 *
 * This is built using the boost template to allow for new theme's using
 * Moodle's new Boost theme engine
 *
 * @package     theme_university
 * @copyright   2022 Debonair Training Ltd, debonairtraining.com
 * @author      Debonair Dev Team
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


namespace theme_university\output;

use moodle_url;
use lang_string;
use html_writer;
use stdClass;
use core_course_category;
use context_course;
use core_course_list_element;
use \theme_university\classes\local\util;
/**
 * This class has function for core course renderer
 * @package     theme_university
 * @copyright   2022 Debonair Training Ltd, debonairtraining.com
 * @author      Debonair Dev Team
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class core_renderer extends \theme_boost\output\core_renderer {

    /**
     * Renderer function for the frontpage available courses.
     * @return string
     */
    public function frontpage_available_courses() {
        /* available courses */
        global $CFG;
        $chelper = new coursecat_helper();
        $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_EXPANDED)->set_courses_display_options(array(
            'recursive' => true,
            'limit' => $CFG->frontpagecourselimit,
            'viewmoreurl' => new moodle_url('/course/index.php'),
            'viewmoretext' => new lang_string('fulllistofcourses')
        ));

        $chelper->set_attributes(array('class' => 'frontpage-course-list-all'));
        $courses = core_course_category::get(0)->get_courses($chelper->get_courses_display_options());
        $totalcount = core_course_category::get(0)->get_courses_count($chelper->get_courses_display_options());

        $rcourseids = array_keys($courses);
        $newcourse = get_string('availablecourses');

        $header = '<div id="frontpage-course-list"><h2>'.$newcourse.'</h2><div class="courses frontpage-course-list-all">';
        $footer = '</div></div>';
        $content = '';
        if (count($rcourseids) > 0) {
            $content .= '<div class="row">';
            foreach ($rcourseids as $courseid) {

                $rowcontent = '';

                $course = get_course($courseid);

                $no = get_config('theme_university', 'patternselect');
                $nimgp = (empty($no)||$no == "default") ? 'default/no-image' : 'cs0'.$no.'/no-image';
                $noimgurl = $this->output->image_url($nimgp, 'theme');
                $courseurl = new moodle_url('/course/view.php', array('id' => $courseid ));

                if ($course instanceof stdClass) {
                    $course = new core_course_list_element($course);
                }

                $imgurl = '';
                $context = context_course::instance($course->id);

                foreach ($course->get_course_overviewfiles() as $file) {
                    $isimage = $file->is_valid_image();
                    $imgurl = file_encode_url("$CFG->wwwroot/pluginfile.php",
                        '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                        $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
                    if (!$isimage) {
                        $imgurl = $noimgurl;
                    }
                }

                if (empty($imgurl)) {
                    $imgurl = $noimgurl;
                }

                $rowcontent .= '<div class="col-md-3 col-sm-6"><div class="fp-coursebox">
                <div class="fp-coursethumb"><a href="'.$courseurl.'"><img src="'.$imgurl.'" width="243" height="165" alt="">
                </a></div><div class="fp-courseinfo"><h5><a href="'.$courseurl.'">'.$course->get_formatted_name().'</a>
                </h5></div></div></div>';
                $content .= $rowcontent;
            }
            $content .= '</div>';
        }

        $coursehtml = $header.$content.$footer;
        echo $coursehtml;

        if (!$totalcount && !$this->page->user_is_editing() &&
            has_capability('moodle/course:create', \context_system::instance())) {
            // Print link to create a new course, for the 1st available category.
            echo $this->add_new_course_button();
        }
    }


    /**
     * Displays one course in the list of courses.
     *
     * This is an internal function, to display an information about just one course
     * please use {@see core_course_renderer::course_info_box()}
     *
     * @param coursecat_helper $chelper various display options
     * @param course_in_list|stdClass $course
     * @param string $additionalclasses additional classes to add to the main <div> tag (usually
     *    depend on the course position in list - first/last/even/odd)
     * @return string
     */
    protected function coursecat_coursebox(coursecat_helper $chelper, $course, $additionalclasses = '') {
        global $CFG;
        if (!isset($this->strings->summary)) {
            $this->strings->summary = get_string('summary');
        }
        if ($chelper->get_show_courses() <= self::COURSECAT_SHOW_COURSES_COUNT) {
            return '';
        }
        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }
        $content = '';
        $classes = trim('coursebox clearfix '. $additionalclasses);
        if ($chelper->get_show_courses() >= self::COURSECAT_SHOW_COURSES_EXPANDED) {
            $nametag = 'h3';
        } else {
            $classes .= ' collapsed';
            $nametag = 'div';
        }

        // Coursebox.
        $content .= html_writer::start_tag('div', array(
            'class' => $classes,
            'data-courseid' => $course->id,
            'data-type' => self::COURSECAT_TYPE_COURSE,
        ));

        $content .= html_writer::start_tag('div', array('class' => 'info'));

        // Course name.
        $coursename = $chelper->get_course_formatted_name($course);
        $coursenamelink = html_writer::link(new moodle_url('/course/view.php', array('id' => $course->id)),
                                            $coursename, array('class' => $course->visible ? '' : 'dimmed'));
        $content .= html_writer::tag($nametag, $coursenamelink, array('class' => 'coursename'));
        // If we display course in collapsed form but the course has summary or course contacts, display the link to the info page.
        $content .= html_writer::start_tag('div', array('class' => 'moreinfo'));
        if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_EXPANDED) {
            if ($course->has_summary() || $course->has_course_contacts() || $course->has_course_overviewfiles()) {
                $url = new moodle_url('/course/info.php', array('id' => $course->id));
                $image = $this->output->pix_icon('i/info', $this->strings->summary);
                $content .= html_writer::link($url, $image, array('title' => $this->strings->summary));
                // Make sure JS file to expand course content is included.
                $this->coursecat_include_js();
            }
        }
        $content .= html_writer::end_tag('div'); // Moreinfo.

        // Print enrolmenticons.
        if ($icons = enrol_get_course_info_icons($course)) {
            $content .= html_writer::start_tag('div', array('class' => 'enrolmenticons'));
            foreach ($icons as $pixicon) {
                $content .= $this->render($pixicon);
            }
            $content .= html_writer::end_tag('div'); // Enrolmenticons.
        }

        $content .= html_writer::end_tag('div'); // Enfo.

        if (empty($course->get_course_overviewfiles())) {
            $class = "content-block";
        } else {
            $class = "";
        }
        $content .= html_writer::start_tag('div', array('class' => 'content '.$class));
        $content .= $this->coursecat_coursebox_content($chelper, $course);
        // Content.
        $content .= html_writer::end_tag('div');
         // Coursebox.
        $content .= html_writer::end_tag('div');
        return $content;
    }

    /**
     * Promoted courses.
     * @return string
     */
    public function promoted_courses() {
        global $CFG , $DB;

        $pcourseenable = theme_university_get_setting('pcourseenable');
        if (!$pcourseenable) {
            return false;
        }

        $featuredcontent = '';
        /* Get Featured courses id from DB */
        $featuredids = theme_university_get_setting('promotedcourses');
        $rcourseids = (!empty($featuredids)) ? explode(",", $featuredids) : array();
        if (empty($rcourseids)) {
            return false;
        }

        $hcourseids = theme_university_hidden_courses_ids();

        if (!empty($hcourseids)) {
            foreach ($rcourseids as $key => $val) {
                if (in_array($val, $hcourseids)) {
                    unset($rcourseids[$key]);
                }
            }
        }

        foreach ($rcourseids as $key => $val) {
            $ccourse = $DB->get_record('course', array('id' => $val));
            if (empty($ccourse)) {
                unset($rcourseids[$key]);
                continue;
            }
        }

        if (empty($rcourseids)) {
            return false;
        }
        $fcourseids = $rcourseids;
        $totalfcourse = count($fcourseids);
        $promotedtitle = theme_university_get_setting('promotedtitle', 'format_html');
        $promotedtitle = theme_university_lang($promotedtitle);

        $featuredheader = '<div class="custom-courses-list" id="Promoted-Courses"><div class="container">
        <div class="titlebar with-felements"><h2>'.$promotedtitle.'</h2><div class="clearfix"></div>
        </div> <div class="row"> <div class="promoted_courses col-md-12" data-crow="'.$totalfcourse.'">';

        $featuredfooter = ' </div></div></div></div>';

        if (!empty($fcourseids)) {
            $rowcontent = '';
            foreach ($fcourseids as $courseid) {
                $course = get_course($courseid);
                $no = get_config('theme_university', 'patternselect');
                $nimgp = (empty($no)||$no == "default") ? 'default/no-image' : 'cs0'.$no.'/no-image';

                $noimgurl = $this->output->image_url($nimgp, 'theme');

                $courseurl = new moodle_url('/course/view.php', array('id' => $courseid ));

                if ($course instanceof stdClass) {
                    $course = new core_course_list_element($course);
                }

                $imgurl = '';

                $summary = theme_university_strip_html_tags($course->summary);
                $summary = theme_university_course_trim_char($summary, 75);

                $context = context_course::instance($course->id);
                $nostudents = count_role_users(5, $context);

                foreach ($course->get_course_overviewfiles() as $file) {
                    $isimage = $file->is_valid_image();
                    $imgurl = file_encode_url("$CFG->wwwroot/pluginfile.php",
                    '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                    $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
                    if (!$isimage) {
                        $imgurl = $noimgurl;
                    }
                }
                if (empty($imgurl)) {
                    $imgurl = $noimgurl;
                }
                $coursehtml = '<div class="col-md-3"><div class="course-box"><div class="thumb">
                <a href="'.$courseurl.'"><img src="'.$imgurl.'" width="135" height="135" alt=""></a></div>
                <div class="info"><h5><a href="'.$courseurl.'">'.$course->get_formatted_name().'</a></h5></div></div></div>';

                $rowcontent .= $coursehtml;
            }
            $featuredcontent .= $rowcontent;
        }
        $featuredcourses = $featuredheader.$featuredcontent.$featuredfooter;
        return $featuredcourses;
    }

    protected function completionbar($course) {
        global $CFG, $USER;
        require_once($CFG->libdir.'/completionlib.php');

        $info = new completion_info($course);
        $completions = $info->get_completions($USER->id);

        // Check if this course has any criteria.
        if (empty($completions)) {
            return array('', '');
        }

        $progressbar = '';
        $activityinfo = '';
        // Check this user is enroled.
        if ($info->is_tracked_user($USER->id)) {
            // For aggregating activity completion.
            $activities = array();
            $activities_complete = 0;

            // Loop through course criteria.
            foreach ($completions as $completion) {
                $criteria = $completion->get_criteria();
                $complete = $completion->is_complete();

                if ($criteria->criteriatype == COMPLETION_CRITERIA_TYPE_ACTIVITY) {
                    $activities[$criteria->moduleinstance] = $complete;
                    if ($complete) {
                        $activities_complete++;
                    }
                }
            }

            // Aggregate activities.
            if (!empty($activities)) {
                $per = floor(100 * ($activities_complete / count($activities)));
                $progressbar = html_writer::start_tag('div', array('class'=>'progressinfo clearfix'));
                $progressbar .= html_writer::tag('div', get_string('progress', 'tool_lp'), array('class'=>'float-left progresstitle'));
                $progressbar .= html_writer::tag('div', $per.'%', array('class'=>'float-right'));
                $progressbar .= html_writer::end_tag('div');
                $bar = html_writer::tag('div', '', array('class'=>'progress-bar-animated progress-bar bg-success', 'aria-valuemin'=>0, 'aria-valuemax'=>100, 'aria-valuenow'=>$per, 'style'=>"width: $per%"));
                $progressbar .= html_writer::tag('div', $bar, array('class'=>'progress'));

                $activity = new stdClass();
                $activity->total = count($activities);
                $activity->complete = $activities_complete;
                $activityinfo = get_string('activityoutof', 'theme_university', $activity);
            }
        }
        return array($progressbar, $activityinfo);
    }

    public function fp_marketingtiles() {
           global $PAGE;
           $hasmarketing1 = (empty($PAGE->theme->settings->marketing1 && $PAGE->theme->settings->togglemarketing == 2)) ? false : format_string($PAGE->theme->settings->marketing1);
           $marketing1content = (empty($PAGE->theme->settings->marketing1content)) ? false : format_text($PAGE->theme->settings->marketing1content);
           $marketing1buttontext = (empty($PAGE->theme->settings->marketing1buttontext)) ? false : format_string($PAGE->theme->settings->marketing1buttontext);
           $marketing1buttonurl = (empty($PAGE->theme->settings->marketing1buttonurl)) ? false : $PAGE->theme->settings->marketing1buttonurl;
           $marketing1target = (empty($PAGE->theme->settings->marketing1target)) ? false : $PAGE->theme->settings->marketing1target;
           $marketing1image = (empty($PAGE->theme->settings->marketing1image)) ? false : $PAGE->theme->settings->marketing1image;
           $market1ID = 'ab';

           $hasmarketing2 = (empty($PAGE->theme->settings->marketing2 && $PAGE->theme->settings->togglemarketing == 2)) ? false : format_string($PAGE->theme->settings->marketing2);
           $marketing2content = (empty($PAGE->theme->settings->marketing2content)) ? false : format_text($PAGE->theme->settings->marketing2content);
           $marketing2buttontext = (empty($PAGE->theme->settings->marketing2buttontext)) ? false : format_string($PAGE->theme->settings->marketing2buttontext);
           $marketing2buttonurl = (empty($PAGE->theme->settings->marketing2buttonurl)) ? false : $PAGE->theme->settings->marketing2buttonurl;
           $marketing2target = (empty($PAGE->theme->settings->marketing2target)) ? false : $PAGE->theme->settings->marketing2target;
           $marketing2image = (empty($PAGE->theme->settings->marketing2image)) ? false : $PAGE->theme->settings->marketing2image;
           $market2ID = 'ab1';

           $hasmarketing3 = (empty($PAGE->theme->settings->marketing3 && $PAGE->theme->settings->togglemarketing == 2)) ? false : format_string($PAGE->theme->settings->marketing3);
           $marketing3content = (empty($PAGE->theme->settings->marketing3content)) ? false : format_text($PAGE->theme->settings->marketing3content);
           $marketing3buttontext = (empty($PAGE->theme->settings->marketing3buttontext)) ? false : format_string($PAGE->theme->settings->marketing3buttontext);
           $marketing3buttonurl = (empty($PAGE->theme->settings->marketing3buttonurl)) ? false : $PAGE->theme->settings->marketing3buttonurl;
           $marketing3target = (empty($PAGE->theme->settings->marketing3target)) ? false : $PAGE->theme->settings->marketing3target;
           $marketing3image = (empty($PAGE->theme->settings->marketing3image)) ? false : $PAGE->theme->settings->marketing3image;
           $market3ID = 'ab2';

           $hasmarketing4 = (empty($PAGE->theme->settings->marketing4 && $PAGE->theme->settings->togglemarketing == 2)) ? false : format_string($PAGE->theme->settings->marketing4);
           $marketing4content = (empty($PAGE->theme->settings->marketing4content)) ? false : format_text($PAGE->theme->settings->marketing4content);
           $marketing4buttontext = (empty($PAGE->theme->settings->marketing4buttontext)) ? false : format_string($PAGE->theme->settings->marketing4buttontext);
           $marketing4buttonurl = (empty($PAGE->theme->settings->marketing4buttonurl)) ? false : $PAGE->theme->settings->marketing4buttonurl;
           $marketing4target = (empty($PAGE->theme->settings->marketing4target)) ? false : $PAGE->theme->settings->marketing4target;
           $marketing4image = (empty($PAGE->theme->settings->marketing4image)) ? false : $PAGE->theme->settings->marketing4image;
           $market4ID = 'ab3';

           $hasmarketing5 = (empty($PAGE->theme->settings->marketing5 && $PAGE->theme->settings->togglemarketing == 2)) ? false : format_string($PAGE->theme->settings->marketing5);
           $marketing5content = (empty($PAGE->theme->settings->marketing5content)) ? false : format_text($PAGE->theme->settings->marketing5content);
           $marketing5buttontext = (empty($PAGE->theme->settings->marketing5buttontext)) ? false : format_string($PAGE->theme->settings->marketing5buttontext);
           $marketing5buttonurl = (empty($PAGE->theme->settings->marketing5buttonurl)) ? false : $PAGE->theme->settings->marketing5buttonurl;
           $marketing5target = (empty($PAGE->theme->settings->marketing5target)) ? false : $PAGE->theme->settings->marketing5target;
           $marketing5image = (empty($PAGE->theme->settings->marketing5image)) ? false : $PAGE->theme->settings->marketing5image;
           $market5ID = 'ab4';

           $hasmarketing6 = (empty($PAGE->theme->settings->marketing6 && $PAGE->theme->settings->togglemarketing == 2)) ? false : format_string($PAGE->theme->settings->marketing6);
           $marketing6content = (empty($PAGE->theme->settings->marketing6content)) ? false : format_text($PAGE->theme->settings->marketing6content);
           $marketing6buttontext = (empty($PAGE->theme->settings->marketing6buttontext)) ? false : format_string($PAGE->theme->settings->marketing6buttontext);
           $marketing6buttonurl = (empty($PAGE->theme->settings->marketing6buttonurl)) ? false : $PAGE->theme->settings->marketing6buttonurl;
           $marketing6target = (empty($PAGE->theme->settings->marketing6target)) ? false : $PAGE->theme->settings->marketing6target;
           $marketing6image = (empty($PAGE->theme->settings->marketing6image)) ? false : $PAGE->theme->settings->marketing6image;
           $market6ID = 'ab5';

           $hasmarketing7 = (empty($PAGE->theme->settings->marketing7 && $PAGE->theme->settings->togglemarketing == 2)) ? false : format_string($PAGE->theme->settings->marketing7);
           $marketing7content = (empty($PAGE->theme->settings->marketing7content)) ? false : format_text($PAGE->theme->settings->marketing7content);
           $marketing7buttontext = (empty($PAGE->theme->settings->marketing7buttontext)) ? false : format_string($PAGE->theme->settings->marketing7buttontext);
           $marketing7buttonurl = (empty($PAGE->theme->settings->marketing7buttonurl)) ? false : $PAGE->theme->settings->marketing7buttonurl;
           $marketing7target = (empty($PAGE->theme->settings->marketing7target)) ? false : $PAGE->theme->settings->marketing7target;
           $marketing7image = (empty($PAGE->theme->settings->marketing7image)) ? false : $PAGE->theme->settings->marketing7image;
           $market7ID = 'ab6';

           $hasmarketing8 = (empty($PAGE->theme->settings->marketing8 && $PAGE->theme->settings->togglemarketing == 2)) ? false : format_string($PAGE->theme->settings->marketing8);
           $marketing8content = (empty($PAGE->theme->settings->marketing8content)) ? false : format_text($PAGE->theme->settings->marketing8content);
           $marketing8buttontext = (empty($PAGE->theme->settings->marketing8buttontext)) ? false : format_string($PAGE->theme->settings->marketing8buttontext);
           $marketing8buttonurl = (empty($PAGE->theme->settings->marketing8buttonurl)) ? false : $PAGE->theme->settings->marketing8buttonurl;
           $marketing8target = (empty($PAGE->theme->settings->marketing8target)) ? false : $PAGE->theme->settings->marketing8target;
           $marketing8image = (empty($PAGE->theme->settings->marketing8image)) ? false : $PAGE->theme->settings->marketing8image;
           $market8ID = 'ab7';

           $hasmarketing9 = (empty($PAGE->theme->settings->marketing9 && $PAGE->theme->settings->togglemarketing == 2)) ? false : format_string($PAGE->theme->settings->marketing9);
           $marketing9content = (empty($PAGE->theme->settings->marketing9content)) ? false : format_text($PAGE->theme->settings->marketing9content);
           $marketing9buttontext = (empty($PAGE->theme->settings->marketing9buttontext)) ? false : format_string($PAGE->theme->settings->marketing9buttontext);
           $marketing9buttonurl = (empty($PAGE->theme->settings->marketing9buttonurl)) ? false : $PAGE->theme->settings->marketing9buttonurl;
           $marketing9target = (empty($PAGE->theme->settings->marketing9target)) ? false : $PAGE->theme->settings->marketing9target;
           $marketing9image = (empty($PAGE->theme->settings->marketing9image)) ? false : $PAGE->theme->settings->marketing9image;
           $market9ID = 'ab8';

           $fp_marketingtiles = ['hasmarkettiles' => ($hasmarketing1 || $hasmarketing2 || $hasmarketing3 || $hasmarketing4 || $hasmarketing5 || $hasmarketing6) ? true : false, 'markettiles' => array(
               array(
                   'hastile' => $hasmarketing1,
                   'tileimage' => $marketing1image,
                   'content' => $marketing1content,
                   'title' => $hasmarketing1,
                   'classid' => $market1ID,
                   'button' => "<a href = '$marketing1buttonurl' title = '$marketing1buttontext' alt='$marketing1buttontext' class='btn btn-default' style='color: #05345C; background-color: white;' target='$marketing1target'> $marketing1buttontext </a>"
               ) ,
               array(
                   'hastile' => $hasmarketing2,
                   'tileimage' => $marketing2image,
                   'content' => $marketing2content,
                   'title' => $hasmarketing2,
                   'classid' => $market2ID,
                   'button' => "<a href = '$marketing2buttonurl' title = '$marketing2buttontext' alt='$marketing2buttontext' class='btn btn-default' style='color: #05345C; background-color: white;' target='$marketing2target'> $marketing2buttontext </a>"
               ) ,
               array(
                   'hastile' => $hasmarketing3,
                   'tileimage' => $marketing3image,
                   'content' => $marketing3content,
                   'title' => $hasmarketing3,
                   'classid' => $market3ID,
                   'button' => "<a href = '$marketing3buttonurl' title = '$marketing3buttontext' alt='$marketing3buttontext' class='btn btn-default' style='color: #05345C; background-color: white;' target='$marketing3target'> $marketing3buttontext </a>"
               ) ,
               array(
                   'hastile' => $hasmarketing4,
                   'tileimage' => $marketing4image,
                   'content' => $marketing4content,
                   'title' => $hasmarketing4,
                   'classid' => $market4ID,
                   'button' => "<a href = '$marketing4buttonurl' title = '$marketing4buttontext' alt='$marketing4buttontext' class='btn btn-default' style='color: #05345C; background-color: white;' target='$marketing4target'> $marketing4buttontext </a>"
               ) ,
               array(
                   'hastile' => $hasmarketing5,
                   'tileimage' => $marketing5image,
                   'content' => $marketing5content,
                   'title' => $hasmarketing5,
                   'classid' => $market5ID,
                   'button' => "<a href = '$marketing5buttonurl' title = '$marketing5buttontext' alt='$marketing5buttontext' class='btn btn-default' style='color: #05345C; background-color: white;' target='$marketing5target'> $marketing5buttontext </a>"
               ) ,
               array(
                   'hastile' => $hasmarketing6,
                   'tileimage' => $marketing6image,
                   'content' => $marketing6content,
                   'title' => $hasmarketing6,
                   'classid' => $market6ID,
                   'button' => "<a href = '$marketing6buttonurl' title = '$marketing6buttontext' alt='$marketing6buttontext' class='btn btn-default' style='color: #05345C; background-color: white;' target='$marketing6target'> $marketing6buttontext </a>"
               ) ,
               array(
                   'hastile' => $hasmarketing7,
                   'tileimage' => $marketing7image,
                   'content' => $marketing7content,
                   'title' => $hasmarketing7,
                   'classid' => $market7ID,
                   'button' => "<a href = '$marketing7buttonurl' title = '$marketing7buttontext' alt='$marketing7buttontext' class='btn btn-default' style='color: #05345C; background-color: white;' target='$marketing7target'> $marketing7buttontext </a>"
               ) ,
               array(
                   'hastile' => $hasmarketing8,
                   'tileimage' => $marketing8image,
                   'content' => $marketing8content,
                   'title' => $hasmarketing8,
                   'classid' => $market8ID,
                   'button' => "<a href = '$marketing8buttonurl' title = '$marketing8buttontext' alt='$marketing8buttontext' class='btn btn-default' style='color: #05345C; background-color: white;' target='$marketing8target'> $marketing8buttontext </a>"
               ) ,
               array(
                   'hastile' => $hasmarketing9,
                   'tileimage' => $marketing9image,
                   'content' => $marketing9content,
                   'title' => $hasmarketing9,
                   'classid' => $market9ID,
                   'button' => "<a href = '$marketing9buttonurl' title = '$marketing9buttontext' alt='$marketing9buttontext' class='btn btn-default' style='color: #05345C; background-color: white;' target='$marketing9target'> $marketing9buttontext </a>"
               ) ,
           ) , ];
           return $this->render_from_template('theme_university/fpmarkettiles', $fp_marketingtiles);
       }

       public function bannerimage_settings() {
              global $PAGE;
              $hasBanner = (empty($PAGE->theme->settings->bannerimage && $PAGE->theme->settings->togglemarketing == 2)) ? false : format_string($PAGE->theme->settings->bannerimage);
              $bannerimage = (empty($PAGE->theme->settings->banner1image)) ? false : $PAGE->theme->settings->banner1image;
              $templatecon = [
                'imagebanner' => $bannerimage
              ];
              return $this->render_from_template('theme_university/banner', $templatecon);
            }
}
