<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CIwY CodeIgniter wrapper for YUI (http://ciwy.sourceforge.net)
 *
 * CIwY (CodeIgniter wrapper for YUI) is a YAHOO! User Interface wrapper, based
 * on CodeIgniter Framework.
 * Make easy embedding YUI in CodeIgniter web application.
 *
 * Copyright (c) 2009-2010, Fabio Ingala
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the author nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package CIwY calendar class
 * @version 0.0.03b 2010-08-01
 * @copyright 2009-2010 Fabio Ingala
 * @author Fabio Ingala (http://fabio.ingala.it) - fabio [at] ingala [dot] it
 * @link http://ciwy.sourceforge.net
 * @link http://sourceforge.net/projects/ciwy/files/ Get full documentation.
 * @link http://sourceforge.net/projects/ciwy/support Please submit all bug reports and feature requests to the forums.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */

class Calendar {

  /**
   * Please modify according with your needs
   */

  /**
   * Default component configuration
   *
   * propertiesSetMode
   * The mode how to set properties between config (In the constructor, via an object literal)
   *                                        queue  (Via "queueProperty" and then "fireQueue")
   *                                        set    (Via "setProperty")
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  var $default_config = array(
      'propertiesSetMode' => 'config',
  );

  /**
   * No modifications are necessary under this point
   */

  /**
   * The Code Igniter Superobject
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @see none
   */
  var $CI;

  /**
   * The name of this widget
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $component_name = 'calendar';

  /**
   * The widget properties with theirs format
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $component_property = array(
          'close'                   => 'boolean',
          'hide_blank_weeks'        => 'boolean',
          'iframe'                  => 'boolean',
          'locale_months'           => 'array',
          'locale_weekdays'         => 'array',
          'maxdate'                 => 'string',
          'mindate'                 => 'string',
          'multi_select'            => 'boolean',
          'nav_arrow_left'          => 'string',
          'nav_arrow_right'         => 'string',
          'navigator'               => 'boolean/object', // The object name or true|false to activate|deactivate the navigator functionality
          'pagedate'                => 'string',
          'selected'                => 'string',
          'show_week_footer'        => 'boolean',
          'show_week_header'        => 'boolean',
          'show_weekdays'           => 'boolean',
          'start_weekday'           => 'integer',
          'title'                   => 'string',
          'DATE_DELIMITER'          => 'string',
          'DATE_FIELD_DELIMITER'    => 'string',
          'DATE_RANGE_DELIMITER'    => 'string',
          'MD_DAY_POSITION'         => 'integer',
          'MD_MONTH_POSITION'       => 'integer',
          'MDY_DAY_POSITION'        => 'integer',
          'MDY_MONTH_POSITION'      => 'integer',
          'MDY_YEAR_POSITION'       => 'integer',
          'MONTHS_LONG'             => 'list',
          'MONTHS_SHORT'            => 'list',
          'MY_LABEL_MONTH_POSITION' => 'integer',
          'MY_LABEL_MONTH_SUFFIX'   => 'string',
          'MY_LABEL_YEAR_POSITION'  => 'integer',
          'MY_LABEL_YEAR_SUFFIX'    => 'string',
          'MY_MONTH_POSITION'       => 'integer',
          'MY_YEAR_POSITION'        => 'integer',
          'PAGES'                   => 'integer',
          'WEEKDAYS_1CHAR'          => 'list',
          'WEEKDAYS_LONG'           => 'list',
          'WEEKDAYS_MEDIUM'         => 'list',
          'WEEKDAYS_SHORT'          => 'list',
          'YEAR_OFFSET'             => 'integer'
  );

  /**
   * The calendar event properties
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $event_property = array(
          'beforeDeselectEvent' => '',
          'beforeHideEvent'     => '',
          'beforeHideNavEvent'  => '',
          'beforeRenderEvent'   => '',
          'beforeSelectEvent'   => '',
          'beforeShowEvent'     => '',
          'beforeShowNavEvent'  => '',
          'changePageEvent'     => '',
          'clearEvent'          => '',
          'deselectEvent'       => '',
          'hideEvent'           => '',
          'hideNavEvent'        => '',
          'renderEvent'         => '',
          'resetEvent'          => '',
          'selectEvent'         => '',
          'showEvent'           => '',
          'showNavEvent'        => '',
  );

  /**
   * The calendar navigator properties
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $navigator_property = array(
          'cancel'       => 'string',
          'initialFocus' => 'string',
          'invalidYear'  => 'string',
          'month'        => 'string',
          'monthFormat'  => 'object',
          'strings'      => 'object',
          'submit'       => 'string',
          'year'         => 'string',
  );

  /**
   * The navigator strings Properties (the text to display in the navigator window)
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $navigator_strings_property = array(
          'cancel'       => 'string',
          'invalidYear'  => 'string',
          'month'        => 'string',
          'submit'       => 'string',
          'year'         => 'string',
  );

  /**
   * To fire a new line at the end of the line in JS code.
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $new_line = "\n";

  /**
   * The class constructor. Performs several action:
   * - Load calendar lang if not loaded previously;
   * - Load CodeIgniter calendar library if not loaded previously;
   * - Create a new widget instance.
   * @param none.
   * @return The HTML code.
   * @access public
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function Calendar($instance) {
    $this->CI =& get_instance();                                                                   // Get CodeIgniter super object
    if ( ! in_array('calendar_lang'.EXT, $this->CI->lang->is_loaded, TRUE)) {                      // Load CodeIgniter calendar lang if not loaded previously
      $this->CI->lang->load('calendar');
    }
    $this->CI->load->library('calendar');                                                          // Load CodeIgniter calendar Library TODO check if previously loaded and load if necessary
    $this->_componentInitialize($instance);                                                        // Initialize the component
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] ' . $this->component_name . ' class initialized.');
  }

  /**
   * Set the navigato calendar property to a specific value.
   * @param array [$property] An array vector as pair of property => value.
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function setNavigatorProperty() {
    $instance = $this->CI->ciwy->current_instance[$this->component_name];
    $properties = func_get_arg(0);
    if (is_array($properties)) {
      foreach($properties as $key => $val) {
        if ( ! isset($this->navigator_property[$key])) {
          $message = '[' . $this->CI->ciwy->library_name . '] '. $key . ' is not a ' . $this->component_name . ' navigatorProperty.';
          log_message('error', $message);
          show_error($message);
        } else {
          $this->CI->ciwy->component_config[$instance]['navigatorConfig'][$key] = $val;
        }
      }
    }
  }

  /**
   * Set the current instance calendar property to a specific value.
   * @param array $property An array vector as pair of property => value.
   * @return none
   * @access public
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function setProperty() {
    $instance = $this->CI->ciwy->current_instance[$this->component_name];
    $properties = func_get_arg(0);
    if (is_array($properties)) {
      foreach($properties as $key => $val) {
        if ( ! isset($this->component_property[$key])) {
          $message = '[' . $this->CI->ciwy->library_name . '] '. $key . ' is not a '.$this->component_name .' Property.';
          log_message('error', $message);
          show_error($message);
        } else {
          $this->CI->ciwy->component_config[$instance]['Config'][$key] = $val;
        }
      }
    }
  }

  /**
   * Set the mode how to set the properties between 'config', 'queue' or 'set'.
   * If none or wrong parameter is passed to the function, it will set the mode to 'config' (default mode).
   * @param string $mode The mode how to set properties between 'config', 'queue' or 'set'.
   * @return none
   * @access public
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function setPropertiesMode() {
    $mode = func_get_arg(0);
    if ($mode != '' AND ($mode == 'config' OR $mode == 'queue' OR $mode == 'set') ) {
      $this->default_config['propertiesSetMode'] = $mode;
    } else {
      $this->default_config['propertiesSetMode'] = 'config';
    }
  }

  /**
   * Create a new JS widget instance (for multiple instance o this widget).
   * This is like a sub costructor. Performs several action:
   * - Set a default container name;
   * - Set a default namespace;
   * - Set locale calendars labels if environment language is not 'english'.
   * @param none.
   * @return The new current instance
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _componentInitialize($instance) {
    $this->CI->ciwy->component_config[$instance]['container_id'] = $instance.'Container';          // Set the container_id value for the new instance
    if ($this->CI->config->item('language') != 'english') {                                        // Set locale calendar preferences if environment language is not 'english'
      $this->_setMdyPosition();                                                                    // Set the position of day, month abd year in the field.
      $this->_setMonth();                                                                          // Set weekday month according with CI.
      $this->_setWeekday();                                                                        // Set weekday labels according with CI.
    }
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] New ' . $this->component_name . ' instance is ' . $instance . '.');
    return $instance;
  }

  /**
   * Generate the HTML code that will contain the widget.
   * @param none.
   * @return The HTML code.
   * @access public
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _container($instance) {
    return '<div id="'.$this->CI->ciwy->component_config[$instance]['container_id'].'"></div>' . $this->new_line; // Generate HTML div container
  }

  /**
   * Generate the JavaScript code according to the settings for the CIwY core
   * @param none.
   * @return The JS code.
   * @access public
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _generate($instance) {
    $output = '';
    if (isset($this->CI->ciwy->component_config[$instance]['Config']['navigator'])) {
      if (strtolower($this->CI->ciwy->component_config[$instance]['Config']['navigator']) != true AND strtolower($this->CI->ciwy->component_config[$instance]['Config']['navigator']) != false) {
        $output .= $this->_getNavigatorConfigs($instance);
      }
    }
    $output .=  '    '.$instance.' = new YAHOO.widget.';
    if (@$this->CI->ciwy->component_config[$instance]['Config']['PAGES'] > 1) {
      $output .= 'CalendarGroup';                                                                  // Use CalendarGroup widget when PAGES widgetProperty is more than 1
    } else {
      $output .= 'Calendar';                                                                       // Use Calendar widget when PAGES widgetProperty is 1 or not set
    }
    $output .= '("'.$instance.'", "'.$this->CI->ciwy->component_config[$instance]['container_id'].'"';

    if ($this->default_config['propertiesSetMode'] == 'config') {
      $output .= ', '.$this->_getConfigs($instance);
    }
    $output .= ');'.$this->new_line;

    if ($this->default_config['propertiesSetMode'] == 'queue') {                                                   // Set widget properties in 'queue' mode
      $output .= $this->_getQueueProperty($instance);
    }

    if ($this->default_config['propertiesSetMode'] == 'set') {                                                     // Set widget properties in 'set' mode
      $output .= $this->_getSetProperty($instance);
    }

    $output .= '    '.$instance.'.render();'.$this->new_line;
    return $output;
  }

  /**
   * Get the calendar navigatorProperty in the right way.
   * @param string $navigatorProperty The name of the navigatorProperty.
   * @return The JS code.
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _getNavigatorConfigs($instance) {
    $output  = '    var ' . $this->CI->ciwy->component_config[$instance]['Config']['navigator'] . ' = {' . $this->new_line;
      foreach($this->navigator_strings_property as $key => $val) {
        $navigator_strings_configs = FALSE;
        if (isset($this->CI->ciwy->component_config[$instance]['navigatorConfig'][$key])) {
          if (!$navigator_strings_configs) {
            $output .= '      strings : {';
            $navigator_strings_configs = TRUE;                                                           // Almost one navigator strings config is set
          }
          $output .= '      $key: "' . addslashes($this->CI->ciwy->component_config[$instance]['navigatorConfig'][$key]) . '"' . $this->new_line;
        }
      }
      if ($navigator_strings_configs) {
        $output .= '    },';
      }
      if (isset($this->CI->ciwy->component_config[$instance]['navigatorConfig']['monthFormat'])) {
        $output .= '      monthFormat: YAHOO.widget.Calendar.' . $this->CI->ciwy->component_config[$instance]['navigatorConfig']['monthFormat'] . ',' . $this->new_line;
      } else {
        $output .= '      monthFormat: YAHOO.widget.Calendar.LONG,' . $this->new_line;
      }
      if (isset($this->CI->ciwy->component_config[$instance]['navigatorConfig']['initialFocus'])) {
        $output .= '      initialFocus: "' . $this->CI->ciwy->component_config[$instance]['navigatorConfig']['initialFocus'] . '",' . $this->new_line;
      } else {
        $output .= '      initialFocus: "year",' . $this->new_line;
      }
      $output .= '    };'.$this->new_line;
      return $output;
  }

  /**
   * Get the calendar settings in 'config' mode.
   * @param none
   * @return The JS code.
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _getConfigs($instance) {
    $count_element   = count($this->CI->ciwy->component_config[$instance]['Config']);
    $current_element = 1;
    $output  = '{'.$this->new_line;                                                                // Start a new output
    foreach($this->CI->ciwy->component_config[$instance]['Config'] as $key => $val) {
      $output .= '        '.$key.':';
      $output .= $this->CI->ciwy->_propertyWrapper($this->CI->ciwy->component_config[$instance]['Config'][$key], $this->component_property[$key]);
      if ($current_element < $count_element) {
        $output .= ', ' . $this->new_line;                                                         // Add a colon only if this isn't the last element
      } else {
        $output .= $this->new_line;
      }
      $current_element ++;
    }

    $output .= '    }';
    return $output;
  }

  /**
   * Get the calendar settings in 'queue' mode.
   * @param none
   * @return The JS code.
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _getQueueProperty($instance) {
    $output = '';
    foreach($this->CI->ciwy->component_config[$instance]['Config'] as $key => $val) {
      $output .= '    ' . $instance . '.cfg.queueProperty("' . $key . '", ';
      $output .= $this->CI->ciwy->_propertyWrapper($this->CI->ciwy->component_config[$instance]['Config'][$key], $this->component_property[$key]);
      $output .= ', false);' . $this->new_line;
    }
    $output .= '    ' . $instance . '.cfg.fireQueue();' . $this->new_line;
    return $output;
  }

  /**
   * Get the calendar settings in 'set' mode.
   * @param none
   * @return The JS code.
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _getSetProperty($instance) {
    $output = '';
    foreach($this->CI->ciwy->component_config[$instance]['Config'] as $key => $val) {
      if ($this->CI->ciwy->component_config[$instance]['Config'][$key] != '') {
        $output .= '    ' . $instance . '.cfg.setProperty("' . $key . '", ';
        $output .= $this->CI->ciwy->_propertyWrapper($this->CI->ciwy->component_config[$instance]['Config'][$key], $this->component_property[$key]);
        $output .= ', false);' . $this->new_line;
      }
    }
    return $output;
  }

  /**
   * Set month labels according with CI.
   * @param none
   * @return none
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _setMonth() {
    $instance = $this->CI->ciwy->current_instance[$this->component_name];
    $yui_months_type = array('MONTHS_LONG' => 'long', 'MONTHS_SHORT' => 'short');
    foreach($yui_months_type as $key => $val) {
      $this->CI->calendar->month_type = $yui_months_type[$key];
      $counter = 1;
      $months = '';
      while ($counter <= 12) {
        if ($counter < 10) {
          $month_name = '0'.$counter;
        } else {
          $month_name = $counter;
        }
        $months[] = $this->CI->calendar->get_month_name($month_name);
        $counter ++;
      }
      $this->CI->ciwy->component_config[$instance]['Config'][$key] = $months;
    }
  }

  /**
   * Set weekday labels according with CI.
   * @param none
   * @return none
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _setWeekday() {
    $instance = $this->CI->ciwy->current_instance[$this->component_name];
    $yui_day_names = array('WEEKDAYS_SHORT' => '', 'WEEKDAYS_MEDIUM' => 'short','WEEKDAYS_LONG' => 'long');
    foreach($yui_day_names as $key => $val) {
      $day_names = $this->CI->calendar->get_day_names($val);
      $this->CI->ciwy->component_config[$instance]['Config'][$key] = $day_names;
    }

    $day_names = $this->CI->calendar->get_day_names('short');
    foreach($day_names as $key => $val) {
      $day_names[$key] = substr($val,0,1);
    }
    $this->CI->ciwy->component_config[$instance]['Config']['WEEKDAYS_1CHAR'] = $day_names;
  }

  /**
   * Set the position of day, month abd year in the field.
   * The default mode is RFC822: day/month, day/month/year, month/year
   * @param string [$fmt] The format.
   * @return The JS code.
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _setMdyPosition($fmt = 'DATE_RFC822') {
    $formats = array(
            'DATE_ATOM'    => array('MD_DAY_POSITION' => '2', 'MD_MONTH_POSITION' => '1', 'MDY_DAY_POSITION' => '3', 'MDY_MONTH_POSITION' => '2', 'MDY_YEAR_POSITION' => '1', 'MY_MONTH_POSITION' => '2', 'MY_YEAR_POSITION' => '1', 'MY_LABEL_MONTH_POSITION' => '2', 'MY_LABEL_YEAR_POSITION' => '1'),
            'DATE_COOKIE'  => array('MD_DAY_POSITION' => '1', 'MD_MONTH_POSITION' => '2', 'MDY_DAY_POSITION' => '1', 'MDY_MONTH_POSITION' => '2', 'MDY_YEAR_POSITION' => '3', 'MY_MONTH_POSITION' => '1', 'MY_YEAR_POSITION' => '2', 'MY_LABEL_MONTH_POSITION' => '1', 'MY_LABEL_YEAR_POSITION' => '2'),
            'DATE_ISO8601' => array('MD_DAY_POSITION' => '2', 'MD_MONTH_POSITION' => '1', 'MDY_DAY_POSITION' => '3', 'MDY_MONTH_POSITION' => '2', 'MDY_YEAR_POSITION' => '1', 'MY_MONTH_POSITION' => '2', 'MY_YEAR_POSITION' => '1', 'MY_LABEL_MONTH_POSITION' => '2', 'MY_LABEL_YEAR_POSITION' => '1'),
            'DATE_RFC822'  => array('MD_DAY_POSITION' => '1', 'MD_MONTH_POSITION' => '2', 'MDY_DAY_POSITION' => '1', 'MDY_MONTH_POSITION' => '2', 'MDY_YEAR_POSITION' => '3', 'MY_MONTH_POSITION' => '1', 'MY_YEAR_POSITION' => '2', 'MY_LABEL_MONTH_POSITION' => '1', 'MY_LABEL_YEAR_POSITION' => '2'),
            'DATE_RFC850'  => array('MD_DAY_POSITION' => '1', 'MD_MONTH_POSITION' => '2', 'MDY_DAY_POSITION' => '1', 'MDY_MONTH_POSITION' => '2', 'MDY_YEAR_POSITION' => '3', 'MY_MONTH_POSITION' => '1', 'MY_YEAR_POSITION' => '2', 'MY_LABEL_MONTH_POSITION' => '1', 'MY_LABEL_YEAR_POSITION' => '2'),
            'DATE_RFC1036' => array('MD_DAY_POSITION' => '1', 'MD_MONTH_POSITION' => '2', 'MDY_DAY_POSITION' => '1', 'MDY_MONTH_POSITION' => '2', 'MDY_YEAR_POSITION' => '3', 'MY_MONTH_POSITION' => '1', 'MY_YEAR_POSITION' => '2', 'MY_LABEL_MONTH_POSITION' => '1', 'MY_LABEL_YEAR_POSITION' => '2'),
            'DATE_RFC1123' => array('MD_DAY_POSITION' => '1', 'MD_MONTH_POSITION' => '2', 'MDY_DAY_POSITION' => '1', 'MDY_MONTH_POSITION' => '2', 'MDY_YEAR_POSITION' => '3', 'MY_MONTH_POSITION' => '1', 'MY_YEAR_POSITION' => '2', 'MY_LABEL_MONTH_POSITION' => '1', 'MY_LABEL_YEAR_POSITION' => '2'),
            'DATE_RSS'     => array('MD_DAY_POSITION' => '1', 'MD_MONTH_POSITION' => '2', 'MDY_DAY_POSITION' => '1', 'MDY_MONTH_POSITION' => '2', 'MDY_YEAR_POSITION' => '3', 'MY_MONTH_POSITION' => '1', 'MY_YEAR_POSITION' => '2', 'MY_LABEL_MONTH_POSITION' => '1', 'MY_LABEL_YEAR_POSITION' => '2'),
            'DATE_W3C'     => array('MD_DAY_POSITION' => '2', 'MD_MONTH_POSITION' => '1', 'MDY_DAY_POSITION' => '3', 'MDY_MONTH_POSITION' => '2', 'MDY_YEAR_POSITION' => '1', 'MY_MONTH_POSITION' => '2', 'MY_YEAR_POSITION' => '1', 'MY_LABEL_MONTH_POSITION' => '2', 'MY_LABEL_YEAR_POSITION' => '1'),
            'test'         => array('MD_DAY_POSITION' => '2', 'MD_MONTH_POSITION' => '1', 'MDY_DAY_POSITION' => '2', 'MDY_MONTH_POSITION' => '1', 'MDY_YEAR_POSITION' => '3', 'MY_MONTH_POSITION' => '1', 'MY_YEAR_POSITION' => '2', 'MY_LABEL_MONTH_POSITION' => '1', 'MY_LABEL_YEAR_POSITION' => '2'),
    );

    if ( ! isset($formats[$fmt])) {                                                                // If the format is wrong, will use the standard format
      $fmt = 'DATE_RFC822';
    }

    $this->setProperty($formats[$fmt]);
  }
}