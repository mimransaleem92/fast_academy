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
 * @package CIwY dragdrop class
 * @version 0.0.03b 2010-08-01
 * @copyright 2009-2010 Fabio Ingala
 * @author Fabio Ingala (http://fabio.ingala.it) - fabio [at] ingala [dot] it
 * @link http://ciwy.sourceforge.net
 * @link http://sourceforge.net/projects/ciwy/files/ Get full documentation.
 * @link http://sourceforge.net/projects/ciwy/support Please submit all bug reports and feature requests to the forums.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */

class Dragdrop {

  /**
   * Please modify according with your needs
   */

  /**
   * Default componet configuration
   *
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  var $default_config = array(
      'elementReference' => '',
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
  var $component_name = 'dragdrop';
  
  /**
   * The widget properties with theirs format
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $component_property = array(
      'elementReference' => 'string',   // CIwY component property
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
   * - Create a new utility instance.
   * @param none.
   * @return The HTML code.
   * @access public
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function Dragdrop($instance) {
    $this->CI =& get_instance();                                                                   // Get CodeIgniter super object
    $this->_componentInitialize($instance);                                                        // Initialize the component
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] ' . $this->component_name . ' class initialized.');
  }


  function setIdElement($instance) {
    $this->setProperty(array('elementReference' => $this->CI->ciwy->component_config[$instance]['container_id']));
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
    $this->setProperty($this->default_config);
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] New ' . $this->component_name . ' instance is ' . $instance . '.');
    return $instance;
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
    if ($this->CI->ciwy->component_config[$instance]['Config']['elementReference'] != '') {
      $output = '    var ' . $instance . ' = new YAHOO.util.DD("'.$this->CI->ciwy->component_config[$instance]['Config']['elementReference'].'");' . $this->new_line;
    }
    return $output;
  }
}