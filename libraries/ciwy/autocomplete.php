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
 * @package CIwY autocomplete class
 * @version 0.0.03b (2010-08-01)
 * @copyright 2009-2010 Fabio Ingala
 * @author Fabio Ingala (http://fabio.ingala.it) - fabio [at] ingala [dot] it
 * @link http://ciwy.sourceforge.net
 * @link http://sourceforge.net/projects/ciwy/files/ Get full documentation.
 * @link http://sourceforge.net/projects/ciwy/support Please submit all bug reports and feature requests to the forums.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */

class Autocomplete {

  /**
   * Please, if necessary, modify according with your needs
   */

  /**
   * Default component configuration
   *
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $default_config = array(
  );

  /**
   * No modifications are necessary under this point
   */

  /**
   * The Code Igniter Superobject
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $CI;

  /**
   * The name of this widget
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $component_name = 'autocomplete';

  /**
   * The widget properties with theirs format
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  private $component_property = array(
          'allowBrowserAutocomplete' => 'boolean',
          'alwaysShowContainer'      => 'boolean',
          'animVert'                 => 'boolean',
          'animHoriz'                => 'boolean',
          'animSpeed'                => 'integer',
          'applyLocalFilter'         => 'boolean',
          'autoHighlight'            => 'boolean',
          'delimChar'                => 'char/array',
          'forceSelection'           => 'boolean',
          'highlightClassName'       => 'string',
          'maxResultsDisplayed'      => 'integer',
          'minQueryLength'           => 'integer',
          'prehighlightClassName'    => 'string',
          'queryDelay'               => 'integer',
          'queryMatchCase'           => 'boolean',
          'queryMatchConstains'      => 'boolean',
          'queryMatchSubset'         => 'boolean',
          'queryQuestionMark'        => 'boolean',
          'resultTypeList'           => 'boolean',
          'suppressInputUpdate'      => 'boolean',
          'typeAhead'                => 'boolean',
          'typeAheadDelay'           => 'integer',
          'useIFrame'                => 'boolean',
          'useShadow'                => 'boolean',
      );

  /**
   * To fire a new line at the end of the line in JS code.
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  private $new_line = "\n";

  /**
   * The class constructor.
   * @param string $instance The instance name of the component for the first object call.
   * @return none.
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function Autocomplete($instance) {
    $this->CI =& get_instance();                                                                   // Get CodeIgniter super object
    $this->CI->load->helper('form');                                                               // Load CodeIgniter calendar Library TODO check if previously loaded and load if necessary
    $this->CI->ciwy->component_config[$instance]['dataSourceInstance'] = $this->CI->ciwy->loadComponent('datasource'); // Autocomplete need datasource to work
    $this->CI->ciwy->component_config[$this->CI->ciwy->component_config[$instance]['dataSourceInstance']]['componentInstance'] = $instance; // Tell to datasource instance for which component
    $this->_componentInitialize($instance);                                                        // Initialize the component
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] ' . $this->component_name . ' class initialized.');
  }

  /**
   * Set the current instance autocomplete property to a specific value.
   * @param array $property An array vector as pair of property => value.
   * @return none.
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   * @todo Move this method in ciwy class because it could be the same for every component
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
   * Create a new YUI component instance (for multiple instance of this component).
   * @param string $instance The instance name of the component to initializate
   * @return The new current instance
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _componentInitialize($instance) {
    $this->CI->ciwy->component_config[$instance]['containerId']     = $instance.'Container';      // Set the container_id value for the new instance
    $this->CI->ciwy->component_config[$instance]['outerContainer']  = $instance.'OuterContainer'; // Set the outer container_id value for the new instance
    $this->CI->ciwy->component_config[$instance]['inputAttributes'] = array(
            'name'        => $instance.'_input',
            'id'          => $instance.'_input',
            'value'       => '',
            'maxlength'   => '',
            'size'        => '',
            'style'       => '',
    );
    $this->CI->ciwy->component_config[$instance]['Config'] = array();
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] New ' . $this->component_name . ' instance is ' . $instance . '.');
    return $instance;
  }

  /**
   * Generate the HTML code that will contain the widget.
   * @param string $instance The instance name of the container to generate
   * @return The HTML code.
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _container($instance) {
    $output  = '<div id="' . $this->CI->ciwy->component_config[$instance]['outerContainer'] . '">' . $this->new_line;
    $output .= '  '. form_input($this->CI->ciwy->component_config[$instance]['inputAttributes']) . $this->new_line;
    $output .= '  <div id="' . $this->CI->ciwy->component_config[$instance]['containerId'] . '"></div>' . $this->new_line;
    $output .= '</div>' . $this->new_line;
    return $output;
  }

  /**
   * Generate the JavaScript code according to the settings.
   * @param string $instance The instance name of the JS code to generate
   * @return The JS code.
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _generate($instance) {
    $output  = $this->CI->ciwy->datasource->_generate($this->CI->ciwy->component_config[$instance]['dataSourceInstance']); // Because datasource code is generated here we need to avoid dual code generation (see below)

    $output .= '    var ' . $instance . ' = new YAHOO.widget.AutoComplete("' . $this->CI->ciwy->component_config[$instance]['inputAttributes']['name'] . '", "';
    $output .=                                                                $this->CI->ciwy->component_config[$instance]['containerId'] . '", ';
    $output .=                                                                $this->CI->ciwy->component_config[$instance]['dataSourceInstance'];
    $output .=                                                         ');' . $this->new_line;
    if (count($this->CI->ciwy->component_config[$instance]['Config']) > 0) {
      foreach ($this->CI->ciwy->component_config[$instance]['Config'] as $key => $val) {
        $output .= '        ' . $instance . '.' . $key . str_repeat(' ', 24 - strlen($key)) . ' = ' . $this->CI->ciwy->_property_wrapper($val, $this->component_property[$key]) . ';' . $this->new_line;
      }
    }
    unset ($this->CI->ciwy->component_instances[$this->CI->ciwy->component_config[$instance]['dataSourceInstance']]); // Avoid dual code generation for data source
    return $output;
  }

}