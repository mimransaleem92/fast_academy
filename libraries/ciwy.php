<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * @package CIwY main class
 * @version 0.0.03b 2010-08-01
 * @copyright 2009-2010 Fabio Ingala
 * @author Fabio Ingala (http://fabio.ingala.it) - fabio [at] ingala [dot] it
 * @link http://ciwy.sourceforge.net
 * @link http://sourceforge.net/projects/ciwy/files/ Get full documentation.
 * @link http://sourceforge.net/projects/ciwy/support Please submit all bug reports and feature requests to the forums.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */

class Ciwy {

  /**
   * Please modify according with your needs
   */

  /**
   * The path of CIwY library
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @see none
   */
  var $ciwy_path           = 'application/libraries/ciwy/';

  /**
   * The path where YUI reside locally.
   * Used only when yuiloader_method is 'php'
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @see none
   */
  var $yui_path            = 'yui/build/';

  /**
   * Define wich YUI loader use between PHPLoader and YUILoader (Javascript).
   * Possible values are: 'php' or 'js' (Actually 'js' does not work)
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $yuiloader_method    = 'php';

  /**
   * The YUI Loader configuration
   *   - allowRollups (boolean) Should Loader use aggregate files (like yahoo-dom-event.js  or utilities.js) that combine several YUI components in a single HTTP request? Default: true.
   *   - base         (string)  Allows you to specify a different location (as a full or relative filepath) for the YUI build directory. By default, YUI PHP Loader will serve files from Yahoo's servers.
   *   - combine      (boolean) If set to true, YUI files will be combined into a single request using the combo service provided on the Yahoo! CDN
   *   - comboBase    (string)  The base path to the Yahoo! CDN service. Default: "http://yui.yahooapis.com/combo?  Note: YUI PHP Loader also ships with an intrinsic, lightweight combo-handler (see combo.php). Refer to the included examples for example code and an illustration of how you might want to use this functionality.
   *   - filter       (string)  A filter to apply to result urls. This filter will modify the default path for all modules. The default path for the YUI library is the minified version of the files.
   *   - loadOptional (boolean) Should loader load optional dependencies for the components you're requesting? (Note: If you only want some but not all optional dependencies, you can list out the dependencies you want as part of your required list.) Default: false.
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  var $yuiloader_config    = array(
      'allowRollups' => TRUE,
      'base'         => 'http://yui.yahooapis.com/',
      'combine'      => FALSE,
      'comboBase'    => 'http://yui.yahooapis.com/combo?',
      'filter'       => 'MIN',
      'loadOptional' => FALSE,
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
  public $CI;

  /**
   * Library name
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  public $library_name     = 'CIwY';

  /**
   * The CIwY version
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @see none
   */
  public $ciwy_version     = '0.0.03b';                                                                 // The CIwY version

  /**
   * The YUI version used with CIwY
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @see none
   */
  public $yui_version      = '2.8.0r4';                                                                 // The YUI version

  /**
   * The utility/widgets configurations
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $component_config    = array();

  /**
   * The utility/widgets instances
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $component_instances = array();

  /**
   * The current utility/widgets instances
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $current_instance    = array();

  /**
   * Tracks wich component (Widget or Utility) is loaded.
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $loaded_component    = array();

  /**
   * The list of CIwY component
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @see none
   */
  var $yui_component       = array(
      'animation'     => array('name' => 'Animation',          'type' => 'utility', 'prefix' => 'anim'),         // Just minimal functionality
      'autocomplete'  => array('name' => 'AutoComplete',       'type' => 'widget',  'prefix' => 'ac'),           // Just minimal functionality
      'button'        => array('name' => 'Button',             'type' => 'widget',  'prefix' => 'button'),
      'calendar'      => array('name' => 'Calendar',           'type' => 'widget',  'prefix' => 'cal'),          // Just minimal functionality
      'carousel'      => array('name' => 'Carousel',           'type' => 'widget',  'prefix' => 'carousel'),
      'charts'        => array('name' => 'Charts',             'type' => 'widget',  'prefix' => 'chart'),
      'colorpicker'   => array('name' => 'Color Picker',       'type' => 'widget',  'prefix' => 'colpick'),
      'connection'    => array('name' => 'Connection Manager', 'type' => 'utility', 'prefix' => 'connman'),
      'container'     => array('name' => 'Container',          'type' => 'widget',  'prefix' => 'cont'),
      'containercore' => array('name' => 'Container Core',     'type' => 'widget',  'prefix' => 'contcore'),
      'cookie'        => array('name' => 'Cookie',             'type' => 'utility', 'prefix' => 'cookie'),
      'datasource'    => array('name' => 'Data Source',        'type' => 'utility', 'prefix' => 'ds'),           // Just minimal functionality
      'datatable'     => array('name' => 'DataTable',          'type' => 'widget',  'prefix' => 'dt'),           // Just minimal functionality
      'dom'           => array('name' => 'DOM Collection',     'type' => 'utility', 'prefix' => 'dom'),
      'dragdrop'      => array('name' => 'Drag and Drop',      'type' => 'utility', 'prefix' => 'dd'),           // Just minimal functionality
      'editor'        => array('name' => 'Rich Text Editor',   'type' => 'widget',  'prefix' => 'editor'),
      'element'       => array('name' => 'Element',            'type' => 'utility', 'prefix' => 'element'),
      'event'         => array('name' => 'Event',              'type' => 'utility', 'prefix' => 'event'),
      'font'          => array('name' => 'Fonts',              'type' => 'utility', 'prefix' => 'font'),
      'get'           => array('name' => 'Get',                'type' => 'utility', 'prefix' => 'get'),
      'grids'         => array('name' => 'Grids',              'type' => 'utility', 'prefix' => 'grids'),
      'history'       => array('name' => 'Browser History',    'type' => 'utility', 'prefix' => 'browser'),
      'imagecropper'  => array('name' => 'ImageCropper',       'type' => 'widget',  'prefix' => 'imgcrop'),
      'imageloader'   => array('name' => 'ImageLoader',        'type' => 'utility', 'prefix' => 'imgloader'),
      'json'          => array('name' => 'JSON',               'type' => 'utility', 'prefix' => 'json'),         // Just minimal functionality
      'layout'        => array('name' => 'Layout Manager',     'type' => 'widget',  'prefix' => 'layout'),
      'logger'        => array('name' => 'Logger',             'type' => 'utility', 'prefix' => 'logger'),
      'menu'          => array('name' => 'Menu',               'type' => 'widget',  'prefix' => 'menu'),
      'paginator'     => array('name' => 'Paginator',          'type' => 'widget',  'prefix' => 'pag'),
      'profiler'      => array('name' => 'Profiler',           'type' => 'widget',  'prefix' => 'prof'),
      'profilerview'  => array('name' => 'Profiler view',      'type' => 'widget',  'prefix' => 'profview'),
      'progressbar'   => array('name' => 'Progress Bar',       'type' => 'widget',  'prefix' => 'progbar'),
      'resize'        => array('name' => 'Resize',             'type' => 'utility', 'prefix' => 'resize'),
      'reset'         => array('name' => 'Reset',              'type' => 'utility', 'prefix' => 'reset'),
      'selector'      => array('name' => 'Selector',           'type' => 'utility', 'prefix' => 'slector'),
      'slider'        => array('name' => 'Slider',             'type' => 'widget',  'prefix' => 'slider'),
      'storage'       => array('name' => 'Storage',            'type' => 'utility', 'prefix' => 'storage'),
      'swf'           => array('name' => 'SWF',                'type' => 'utility', 'prefix' => 'swf'),
      'swfstore'      => array('name' => 'SWFStore',           'type' => 'utility', 'prefix' => 'swfstore'),
      'tabview'       => array('name' => 'TabView',            'type' => 'widget',  'prefix' => 'tabview'),
      'treeview'      => array('name' => 'TreeView',           'type' => 'widget',  'prefix' => 'treeview'),
      'uploader'      => array('name' => 'Uploader',           'type' => 'widget',  'prefix' => 'upld'),
      'yahoo'         => array('name' => 'Yahoo',              'type' => 'widget',  'prefix' => 'yahoo'),
      'yuiloader'     => array('name' => 'yuiloader',          'type' => 'widget',  'prefix' => 'yahooloader'),  //
      'yuitest'       => array('name' => 'yuitest',            'type' => 'widget',  'prefix' => 'yuitest'),
  );

  /**
   * The YUI Loader path
   *   - path         (string) The path where YUI loader reside inside the CIwY folder
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @see none
   */
  var $yuiloader_path      = array(
      'php' => 'phploader/',
      'js'  => 'jsloader/',
  );

  /**
   * The intent step used to generate js code
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  var $js_intent           = 4;

  /**
   * To fire a new line at the end of the line in JS code.
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @see none
   */
  var $new_line            = "\n";

  /**
   * Class constructor.
   * @param none
   * @return none
   * @access public
   * @since 0.0.1b (2010-01-14)
   * @see none
   */
  function Ciwy() {
    $this->CI =& get_instance();                                                                   // Get CodeIgniter super object

    $this->yuiloader_config['base'] .= $this->yui_version . '/build/';                             // Set the YUI base

    if ($this->yuiloader_method == 'js' OR $this->yuiloader_method == 'php') {
      $yuiloader_class = $this->ciwy_path.$this->yuiloader_path[$this->yuiloader_method].'loader'.EXT;
      require_once($yuiloader_class);                                                              // Require the YUI Loader class
      $this->yuiloader = new YAHOO_util_Loader($this->yui_version);                                // Instantiate the "YUI component loader"
      log_message('debug', '['.$this->library_name.'] '.$this->yuiloader_method.'loader instantiated.');
    } else {
      $message = '[' . $this->library_name . '] Variable $yuiloade_method not set properly (current value is "'.$this->yuiloader_method.'"). Use "js" or "php".';
      log_message('error', $message);
      show_error($message);
    }

    foreach ($this->yuiloader_config as $key => $val) {                                            // Set YUI Loader configuration
      $this->yuiloader->$key = $this->yuiloader_config[$key];
    }

    if ($this->yuiloader_config['filter'] == 'DEBUG') {
      $this->yuiloader->load('logger', 'dragdrop');                                                // Load supplementary YUI utilities if in debug mode
    }

    $this->_setAvailableComponent();
    log_message('debug', '[' . $this->library_name . '] ' . $this->library_name . ' super class initialized.'); // Debugging purpouse
  }

  /**
   * Set which components are available into object property.
   * @param none.
   * @return none.
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  private function _setAvailableComponent() {
    foreach ($this->yui_component as $key => $val) {
      $filename = $this->ciwy_path.$key.EXT;
      if(file_exists($filename)) {
        $this->yui_component[$key]['available'] = TRUE;
      } else {
        $this->yui_component[$key]['available'] = FALSE;
      }
      $this->loaded_component[$key] = 0;
    }
  }

  /**
   * Generate the JavaScript code according with the settings.
   * @param none.
   * @return The JS code.
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   * @TODO eternally in progress ;-)
   */
  function generate() {
    $output = '';
    $output .= '<script type="text/javascript">'.$this->new_line;                                  // Generate HTML & Javascript code for CIwY widgets and utilities
    $output .= '  (function() {'.$this->new_line;
    $output .= '    var Dom = YAHOO.util.Dom,'.$this->new_line;                                    // Define Dom variable
    $output .= '        Event = YAHOO.util.Event;'.$this->new_line;                                // Define Event variable
    if ($this->yuiloader_config['filter'] == 'DEBUG') {
      $output .= '    var myLogReader = new YAHOO.widget.LogReader("myLogger");' . $this->new_line;
    }
    if ($this->yuiloader_method == 'js') {
      $output .= $this->ciwy->yuiloader->_generate();                                    // ?!?!?!?!?
    } elseif ($this->yuiloader_method == 'php') {
      //print_r($this->component_instances);
      while (list($instance, $component) = each($this->component_instances)) {
        $output .= $this->CI->ciwy->$component->_generate($instance);
      }
      /*
      foreach ($this->component_instances as $instance => $component) {
        $output .= $this->CI->ciwy->$component->_generate($instance);
      }
      */

      /*
      foreach ($this->loadedComponent as $key => $utility) {                                             // Generate JS Object for each instance of each widget
        $utility_instances[$utility] = $this->get_utilityInstances($utility);
        foreach ($utility_instances[$utility] as $key2 => $instance) {
          $output .= $this->CI->ciwy->$utility->_generate($instance);
        }
      }
      foreach ($this->loadedWidget as $key => $widget) {                                             // Generate JS Object for each instance of each widget
        $widget_instances[$widget] = $this->get_widgetInstances($widget);
        foreach ($widget_instances[$widget] as $key2 => $instance) {
          $output .= $this->CI->ciwy->$widget->_generate($instance);
        }
      }
      */
    } else {
      $message = 'Variable $yuiloade_method not set properly (current value is "'.$this->yuiloader_method.'"). Use "js" or "php".';
      log_message('error', $message);
      show_error($message);
    }
    /*
    foreach ($this->loadedWidget as $key => $widget) {                                             // Define vars for each instance of each widget
      $widget_instances[$widget] = $this->CI->ciwy->$widget->widgetInstance;
      $widget_instances[$widget] = $this->get_instances($widget);
      //print_r($widget_instances);
      foreach ($widget_instances[$widget] as $key2 => $instance) {
        $output .= '        '.$instance.' = null;'.$this->new_line;
      }
    }
    */
    $output .= '  })();'.$this->new_line;
    $output .= '</script>'.$this->new_line;
    return $output;
  }

  /**
   *
   * @param
   * @return string
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function yuiTags($moduleType = null, $skipSort = false) {
    return $this->yuiloader->tags($moduleType, $skipSort);
  }

  /**
   * YUI Component loader. Load specified YUI component provided as:
   * - list of text arguments provided as one component for each argument - Note: automatic instance_name will be created
   * - non-associative array (eg. 'component_name', 'other_component_name', ...) - Note: automatic instance_name will be created
   * - associative array (provided as (eg. 'instance_name' => 'component_name', 'other_instance_name' => 'other_component_name', ...) - Note: each widget can be instaciated multiple time
   * - list of associative array (one associative array for each argument)
   * @param string The name of the YUI component to load and init
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function loadComponent() {
    $args = func_get_args();
    foreach ($args as $arg) {
      if(is_array($arg)) {
        foreach ($arg as $instance => $component) {
          if (is_string($instance)) {
            $instance[$this->_loadSingleComponent($component, $instance)] = $component;
          } else {
            $instance[$this->_loadSingleComponent($component)]            = $component;
          }
        }
      } else {
        $instance = $this->_loadSingleComponent($arg);
      }
    }
    return $instance;
  }

  /**
   * Load single component (private function)
   * @param string $component The name of the YUI component to load and init
   * @return none
   * @access public
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  private function _loadSingleComponent($component, $instance = '') {
    $component_file = $this->ciwy_path.$component.EXT;
    if (file_exists($component_file)) {                                                            // Verify if the CIwY component is available
      if ($this->loaded_component[$component] == 0) {                                              // Verify if the component was previously loaded
        $instance = $this->_createInstance($component, $instance);                                 // Create a new instance with a legal instance name
        require_once($component_file);                                                             // Load the right CIwY class file
        $this->CI->ciwy->$component = new $component($instance);                                   // Instantiate a new object from the CIwY class file
        $this->yuiloader->load($component);                                                        // Tells to "YUI component loader" wich module to load
        log_message('debug', '[' . $this->library_name . '] ' . $component . ' class initialized.'); // Debugging purpouse
      } else {
        $instance = $this->_createInstance($component, $instance);                                 // Create a new instance with a legal instance name
        $this->CI->ciwy->$component->_componentInitialize($instance);                              // Initialize the YUI component with the new instance
      }
    } else {
      $message = '[' . $this->library_name . '] _loadSingleComponent - The requeste YUI component "'.$component.'" is not available in your system.';
      log_message('error', $message);
      show_error($message);
    }
    return $instance;
  }

  /**
   * Create a new instance of a component.
   * This is like a sub costructor. Performs several action:
   * - Set a default container name;
   * - Set a default namespace;
   * - Set locale calendars labels if environment language is not 'english'.
   * @param string $component The component name.
   * @param string $instance The chosen instance name.
   * @return string $instance The name of the new component instance
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _createInstance($component, $instance = '') {
    if ($instance == '' OR in_array($instance, $this->component_instances)) {                      // Check if the new instance name was provided as function parameter and if conflicts with old ones
      $this->loaded_component[$component] = $this->loaded_component[$component] + 1;               // Increase the number of the automatically generated instance_name
      $instance = $this->yui_component[$component]['prefix'].$this->loaded_component[$component];  // The automatically generated instance_name
    }
    $this->component_instances[$instance] = $component;
    $this->current_instance[$component] = $instance;                                               // Set the current_instance for the component
    $this->component_config[$instance]  = '';                                                      // Initialize the component configuration
    return $instance;
  }

  /**
   * Create a new  instance of a given component (Widget or Utility)
   * @param string $component The name of the YUI component (Widget or Utility)
   * @return boolean Return the status of the operation
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.2b (2010-04-30)
   * @see none
   */
  /*
  function createInstance($component, $instance = '') {
    if (in_array($component, $this->loaded_component)) {                                           // Verify if the component was previously loaded
      $this->ciwy->$component->_create_instance($instance);                                          // Create a new JS instance only if the component was previously loaded
    } else {
      $message = '[' . $this->library_name . '] createInstance() error: YUI component not previously loaded. To create a new instance of the "'.$component.'" YUI component, You need to load it before.';
      log_message('error', $message);
      show_error($message);
    }
  }
  */

  /**
   * Get the container for the given componet
   * @param string $component The name of the YUI component
   * @param string [$instance] The name of the component instance
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function container($component, $instance = '') {
    if (isset($this->loaded_component[$component])) {                                              // Verify if the component was previously loaded
      if ($this->loaded_component[$component] > 0) {
        if ($instance == '' OR !in_array($instance, $this->component_instances)) {
          $instance = $this->current_instance[$component];                                         // Force the istance name to current instance if no or wrong istance name was provided
        }
        $container = $this->CI->ciwy->$component->_container($instance);
      } else {
        $message = '[' . $this->library_name . '] container() error: YUI component not previously loaded. To get the HTML container of the "'.$component.'" YUI component, You need to load it before.';
        log_message('error', $message);
        show_error($message);
      }
    } else {
      $message = '[' . $this->library_name . '] container() error: The requeste YUI component "'.$component.'" is not available in your system.';
      log_message('error', $message);
      show_error($message);
    }
    return $container;
  }

  /**
   * Get the current instance name of a given widget
   * @param string $widget The name of the YUI widget
   * @return string $instance the current instance name of spcified widget
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function getCurrentInstance($component) {
    $instance = FALSE;
    if (in_array($component, $this->loadedComponent)) {
      $instance = $this->CI->ciwy->$component->widgetInstance[$this->CI->ciwy->$widget->currentInstance];
    }
    return $instance;
  }

  /**
   * Builds JS code with the right sintax.
   * @param array $array The list of elements of an object
   * @return string $output The JS code that descibe an object
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _propertyWrapper($property, $datatype) {
    switch ($datatype) {
      case 'array':
        $property_wrapper = $this->_jsArray($property);
        //print_r($property);
        //echo $property_wrapper;
        break;

      case 'boolean':
        //$property_wrapper = $property;
        $property_wrapper = $this->_jsValue($property);
        break;

      case 'boolean/object':
        //$property_wrapper = $property;
        $property_wrapper = $this->_jsValue($property);
        break;

      case 'char/array':
        if (is_array($property)) {
          $property_wrapper = $this->_jsArray($property);
        } else {
          $property_wrapper = '"'.addslashes($property).'"';
        }
        break;

      case 'integer':
        $property_wrapper = $property;
        break;

      case 'list':
        $property_wrapper = $this->_jsArray($property);
        break;

      case 'string':
        $property_wrapper = '"'.addslashes($property).'"';
        break;

      case 'json':
        $property_wrapper = $this->_jsJson($property);
        //print_r($property);
        //echo $property_wrapper;
        break;

      default:
        echo 'Property "'.$property.'" not recognized.<br />';
        $property_wrapper = 'property type error';
        break;
    }
    return $property_wrapper;
  }

  /**
   * YUI Object builder.
   * @param array $array The list of elements of an object
   * @return string $output The JS code that descibe an object
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @see none
   */
  /*
  function _jsObject($array) {
    $output = '';                                                                                  // Reset the output content
    $count = count($array);
    $current = 1;
    $output .= '{';
    foreach($array as $key => $val) {
      if ($val) {
        $output .= $key.':';
        if (is_array($val)) {
          $output .= '[';
          $output .= $this->_jsArray($array[$key]);
          $output .= ']';
        } else {
          $output .= '"' . addslashes($val) . '"';
        }
        $output .= '';
        if ($current < $count) {
          $output .= ',';                                                        // Add a colon only if this isn't the last element
        }
      }
      $current ++;
    }
    $output .= '}';
    return $output;
  }
  */

  /**
   * Build an array list in JavaScript literal notation
   * @param array $array The php array that will be converted in JavaScript array
   * @return string $output The JS code tha descibe the given array
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  /*
  function _jsList($array) {
    $output          = '{';                                                                        // Reset the output content;
    $count_element   = count($array);
    $current_element = 1;
    foreach($array as $key => $val) {
        if (is_int($val) or is_float($val)) {
          $output .= $val;
        } elseif (is_bool($val)) {
          if ($val) {
            $output .= 'true';
          } else {
            $output .= 'false';
          }
        } elseif (is_string($val)) {
          $output .= '"' . addslashes($val) . '"';
        }
        if ($current_element < $count_element) {
          $output .= ', ';                                                                         // Add a colon only if this isn't the last element
        }
      $current_element ++;
    }
    $output .= '}';
    return $output;
  }
  */

  /**
   * Build an associative array in JavaScript literal notation
   * @param array $array The php array that will be converted in JavaScript array
   * @return string $output The JS code tha descibe the given array
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  /*
  function _jsArray($array) {
    $output          = '{';                                                                        // Reset the output content;
    $count_element   = count($array);
    $current_element = 1;
    foreach($array as $key => $val) {
      if (is_array($val)) {
        $output .= '"' . addslashes($key) . '" ';
        $output .= $this->_jsList($val);
        if ($current_element < $count_element) {
          $output .= ', ' . $this->new_line;                                                       // Add a colon only if this isn't the last element
        }
      } else {
        if (is_int($val) or is_float($val)) {
          $output .= '"' . addslashes($key) . '": ';
          $output .= $val;
        } elseif (is_bool($val)) {
          $output .= '"' . addslashes($key) . '": ';
          if ($val) {
            $output .= 'true';
          } else {
            $output .= 'false';
          }
        } elseif (is_string($val)) {
          $output .= '"' . addslashes($key) . '": ';
          $output .= '"' . addslashes($val) . '"';
        }
        if ($current_element < $count_element) {
          $output .= ', ';                                                                         // Add a colon only if this isn't the last element
        }
      }
      $current_element ++;
    }
    $output .= '}';
    return $output;
  }
  */

  /**
   * Like phpinfo() show CIwY configuration info.
   * @param none
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function ciwyinfo() {
    $YUI_widget            = '';
    $YUI_widget_available  = '';
    $YUI_utility           = '';
    $YUI_utility_available = '';
    foreach ($this->yui_component as $key => $val) {
      if ($this->yui_component[$key]['type'] == 'widget') {
        $YUI_widget .= $this->yui_component[$key]['name'].', ';
        if ($this->yui_component[$key]['available']) {
          $YUI_widget_available .= $this->yui_component[$key]['name'].', ';
        }
      } elseif ($this->yui_component[$key]['type'] == 'utility') {
        $YUI_utility .= $this->yui_component[$key]['name'].', ';
        if ($this->yui_component[$key]['available']) {
          $YUI_utility_available .= $this->yui_component[$key]['name'].', ';
        }
      }
    }
    //$YUI_widget_available = substr($YUI_widget_available, 0 , strlen($YUI_widget_available) - 20);
    //$YUI_utility_available = substr($YUI_utility_available, 0 , strlen($YUI_utility_available) - 20);

    $data = array(
            'CIwY version'            => $this->ciwy_version,
            'YUI version'             => $this->yui_version,
            'CI version'              => CI_VERSION,
            'PHPLoader version'       => $this->yuiloader->loader_version,
            'JSLoader version'        => $this->ciwy_version,
            'CIwY path'               => BASEPATH . $this->ciwy_path,
            'YUI path (local)'        => base_url().$this->yui_path,
            'YUI path (remote)'       => $this->yuiloader_config['base'],
            'YUI Loader method'       => $this->yuiloader_method,
            'PHP-Loader lib path'     => BASEPATH . $this->ciwy_path . $this->yuiloader_path['php'],
            'JS-Loader lib path'      => BASEPATH . $this->ciwy_path . $this->yuiloader_path['js'],
            'YUI widgets'             => substr($YUI_widget, 0 , strlen($YUI_widget) - 2),
            'YUI utilities'           => substr($YUI_utility, 0 , strlen($YUI_utility) - 2),
            'CIwY widgets availabe'   => substr($YUI_widget_available, 0 , strlen($YUI_widget_available) - 2),
            'CIwY utilities availabe' => substr($YUI_utility_available, 0 , strlen($YUI_utility_available) - 2),

    );
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <style type="text/css">
      body {background-color: #ffffff; color: #000000;}
      body, td, th, h1, h2 {font-family: sans-serif;}
      pre {margin: 0px; font-family: monospace;}
      a:link {color: #000099; text-decoration: none; background-color: #ffffff;}
      a:hover {text-decoration: underline;}
      table {border-collapse: collapse;}
      .center {text-align: center;}
      .center table { margin-left: auto; margin-right: auto; text-align: left;}
      .center th { text-align: center !important; }
      td, th { border: 1px solid #000000; font-size: 75%; vertical-align: baseline;}
      h1 {font-size: 150%;}
      h2 {font-size: 125%;}
      .p {text-align: left;}
      .e {background-color: #ccccff; font-weight: bold; color: #000000; width: 200px;}
      .h {background-color: #9999cc; font-weight: bold; color: #000000;}
      .v {background-color: #cccccc; color: #000000;}
      .vr {background-color: #cccccc; text-align: right; color: #000000;}
      img {float: right; border: 0px;}
      hr {width: 600px; background-color: #cccccc; border: 0px; height: 1px; color: #000000;}
    </style>
    <title>ciwyinfo()</title>
    <meta name="ROBOTS" content="NOINDEX,NOFOLLOW,NOARCHIVE" />
    <link  href="'.base_url().'system/'.$this->ciwy_path.'user_guide/images/favicon.gif" rel="icon" type="image/gif"/>
  </head>
  <body>
    <div class="center">
      <table border="0" cellpadding="3" width="600">
        <tr class="h">
          <td><a href="http://ciwy.sourceforge.net/"><img border="0" src="'.base_url().'system/'.$this->ciwy_path.'user_guide/images/ciwy_logo.png" alt="CIwY Logo" /></a><h1 class="p">CIwY Version '.$data['CIwY version'].'</h1></td>
        </tr>
      </table><br />
      <table border="0" cellpadding="3" width="600">'.$this->new_line;
    foreach ($data as $key => $val) {
      echo '        <tr><td class="e">'.htmlentities($key).'</td><td class="v">'.$val.'</td></tr>'.$this->new_line;
    }
    echo '      </table><br />'.$this->new_line;
    echo '    </div>
  </body>
</html>';
  }

  /**
   * Add to the YUI loader the 'reset', 'fonts', 'grids' YUI pattern.
   * @param none
   * @return none
   * @access public
   * @since 0.0.2b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function yuiRFG() {
    $this->loadComponent('reset', 'fonts', 'grids');                                                            // Tells to "YUI component loader" wich module to load
  }

  /**
   * Generate the json data from array.
   * @param array $array The data in array format
   * @return string $output The data in JSON format
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _jsJson($array, $resultSet = '') {
    $output = '';
    if (is_array($array)) {
      if ($resultSet == '') {
        $totalResultsAvailable = $totalResultsReturned  = count($array);
        $firstResultReturned   = 1;
      } else {
        $totalResultsAvailable = $resultSet['totalResultsAvailable'];
        $totalResultsReturned  = $resultSet['totalResultsReturned'];
        $firstResultReturned   = $resultSet['firstResultReturned'];
      }
      $output .= '{';
      $output .= '"ResultSet":{' . $this->new_line;
      $output .= '"totalResultsAvailable":' . $totalResultsAvailable . ',' . $this->new_line;      // TODO recuperare l'elenco di questi campi da datasource.responseSchema
      $output .= '"totalResultsReturned":' . $totalResultsReturned . ',' . $this->new_line;
      $output .= '"firstResultPosition":' . $firstResultReturned . ',' . $this->new_line;
      $output .= '"Result":[' . $this->new_line;

      $current_pointer = 1;
      $count_element   = count($array);
      foreach ($array as $key => $val) {
        $output .= $this->CI->ciwy->_jsObjectList($val);
        if ($current_pointer < $count_element) {
          $output .= ',' . $this->new_line;                                                        // Add a colon only if this isn't the last element
        }
        $current_pointer ++;
      }
      $output .= $this->new_line . ']}}' . $this->new_line;
    }
    return $output;
  }

  /**
   * Output the JS value in the correct way
   * @param mixed $value The value to output with JS sintax
   * @return string $jsValue The value in JS syntax
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  function _jsValue($value) {
    $output = '';
    if (is_int($value) or is_float($value)) {
      $output .= $value;
    } elseif (is_bool($value)) {
      if ($value) {
        $output .= 'true';
      } else {
        $output .= 'false';
      }
    } elseif (is_string($value)) {
      $output .= '"' . addslashes($value) . '"';
    } else {
      $output .= 'Unable to recognize type of ' . $value . ', please refer to the developer';
    }
    return $output;
  }

  /**
   * Build a JS array of object from a given php array
   * @param array $array The php array to convert in JS array of objects
   * @param integer $intent Number of spaces per intent
   * @return string $js_object_array The JS array of objects
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  function _jsObjectArray($array, $intent = 0) {
    $count_element   = count($array);
    $current_element = 1;
    $output = str_repeat(' ', $intent) . '[' . $this->new_line;                                    // Reset the output content;
    foreach ($array as $key => $val) {
      $new_intent = $intent + $this->js_intent;
      $output .= $this->CI->ciwy->_jsObjectList($val, $new_intent);
      if ($current_element < $count_element) {
        $output .= ', ';                                                                           // Add a colon only if this isn't the last element
      }
      $current_element ++;
      $output .= $this->new_line;                                                                  // Add a colon only if this isn't the last element
    }
    $output .= str_repeat(' ', $intent) . ']';
    //$output .= $this->new_line;
    return $output;
  }

  function _jsLiteralArray($array, $intent = 0) {
    $is_array        = FALSE;
    $count_element   = count($array);
    $current_element = 1;
    $output = str_repeat(' ', $intent) . '[' . $this->new_line;                                    // Reset the output content;
    $output_array = str_repeat(' ', $intent + $this->js_intent);
    $output_list  = str_repeat(' ', $intent + $this->js_intent);

    foreach ($array as $key => $val) {
      if(is_string($key)) {
        $is_array = TRUE;
      }
      $output_list  .= $this->_jsValue($val);
      if (is_array($val)) {
        $output_array .= $this->CI->ciwy->_jsObjectList($val, $intent + $this->js_intent) . $this->new_line;
        //$output_array .= $key . ': ' . $this->new_line;
        //$output_array .= $this->_jsLiteralArray($val, $intent + $this->js_intent * 2);
      } else {
        $output_array .= $key . ': ' . $this->_jsValue($val);
      }
      if ($current_element < $count_element) {
        $output_list  .= ', ';                                                                     // Add a colon only if this isn't the last element
        $output_array .= ', ';                                                                     // Add a colon only if this isn't the last element
      } else {
        $output_list  .= $this->new_line;                                                                     // Add a colon only if this isn't the last element
      }
      $current_element ++;
      //$output_array .= $this->new_line;                                                                         // Add a colon only if this isn't the last element
    }
    if ($is_array) {
      $output .= $output_array;
      unset($output_list);
    } else {
      $output .= $output_list;
      unset($output_array);
    }
    $output .= str_repeat(' ', $intent) . ']';
    return $output;
  }


  /**
   * Build a JS list of object from a given php array
   * @param array $array The php array to convert in JS list of objects
   * @param integer $intent Number of spaces per intent
   * @return string $js_object_list The JS list of objects
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  function _jsObjectList($array, $intent = 0) {
    $output          = str_repeat(' ', $intent) . '{ ';
    $count_element   = count($array);
    $current_element = 1;
    foreach($array as $key => $val) {
      $output .= '"' . addslashes($key) . '": ';
      if (is_array($val)) {
        $new_intent = $intent + 4;
        $output .= $this->_arrayToList($val, $new_intent);
      } else {
        $output .= $this->_jsValue($val);
      }
      if ($current_element < $count_element) {
        $output .= ', ';                                                                           // Add a colon only if this isn't the last element
        //$output .= $this->new_line;                                                                //
      } else {
        //$output .= $this->new_line;                                                                //
      }
      $current_element ++;
    }
    //$output .= str_repeat(' ', $intent);
    $output .= ' }';
    return $output;
  }

  function _jsArray($array, $intent = 0) {
    $output          = str_repeat(' ', $intent) . '[';                                                                        // Reset the output content;
    $count_element   = count($array);
    $current_element = 1;
    foreach($array as $key => $val) {
      if (is_array($val)) {
        $new_intent = $intent + 4;
        $output .= $this->_arrayToList($val, $new_intent);
      } else {
        $output .= $this->_jsValue($val);
      }
      if ($current_element < $count_element) {
        $output .= ', ';                                                                           // Add a colon only if this isn't the last element
        //$output .= $this->new_line;                                                                //
      } else {
        //$output .= $this->new_line;                                                                //
      }
      $current_element ++;
    }
    $output .= str_repeat(' ', $intent) . ']';
    return $output;
  }

  /*
  function _arrayToArray($array) {
    $output          = '[';                                                                        // Reset the output content;
    $count_element   = count($array);
    $current_element = 1;
    foreach($array as $key => $val) {
      if (is_array($val)) {
        //$output .= '"' . addslashes($key) . '": ';
        $output .= '{';
        foreach($val as $key2 => $val2) {
          //$output .= $this->_arrayToArray($val);
          $output .= '"' . addslashes($key2) . '": ';
          if (is_int($val2) or is_float($val2)) {
            $output .= $val;
          } elseif (is_bool($val2)) {
            if ($val2) {
              $output .= 'true';
            } else {
              $output .= 'false';
            }
          } elseif (is_string($val2)) {
            $output .= '"' . addslashes($val2) . '"';
          } else {
            $output .= $val2 . ' has non recognized data type, please refer to developer';
          }
        }
        $output .= '}';
      } else {
        $output .= '"' . addslashes($key) . '": ';
        if (is_int($val) or is_float($val)) {
          $output .= $val;
        } elseif (is_bool($val)) {
          if ($val) {
            $output .= 'true';
          } else {
            $output .= 'false';
          }
        } elseif (is_string($val)) {
          $output .= '"' . addslashes($val) . '"';
        } else {
          $output .= $val . ' has non recognized data type, please refer to developer';
        }
      }
      if ($current_element < $count_element) {
        $output .= ', ' . $this->new_line;                                                         // Add a colon only if this isn't the last element
      }
      $current_element ++;
    }
    $output .= ']';
    return $output;
  }
  */
}