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
 * @package CIwY json class
 * @version 0.0.03b 2010-08-01
 * @copyright 2009-2010 Fabio Ingala
 * @author Fabio Ingala (http://fabio.ingala.it) - fabio [at] ingala [dot] it
 * @link http://ciwy.sourceforge.net
 * @link http://sourceforge.net/projects/ciwy/files/ Get full documentation.
 * @link http://sourceforge.net/projects/ciwy/support Please submit all bug reports and feature requests to the forums.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */

class Json {

  /**
   * Please modify according with your needs
   */

  // Place here some component customization if necessary

  /**
   * No modifications are necessary under this point
   */

  /**
   * The Code Igniter Superobject
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
     */
  var $CI;

  /**
   * The name of this component
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $component_name = 'json';

  /**
   * The result set for JSON data
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $result_set = array(
      'totalResultsAvailable' => '',
      'totalResultsReturned'  => '',
      'firstResultReturned'   => '',
      'dataResult'            => '',
  );

  /**
   * To fire a new line at the end of the line in JS code.
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $new_line = "\n";

  /**
   * The class constructor. Performs several action:
   * -
   * @param string $instance The instance name.
   * @return The HTML code.
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function Json($instance) {
    $this->CI =& get_instance();                                                                   // Get CodeIgniter super object
    $this->_componentInitialize($instance);                                                        // Initialize the component
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] ' . $this->component_name . ' class initialized.');
  }

  /**
   * 
   * This is like a sub costructor.
   * @param string $instance The instance name.
   * @return string $currentIstance The new current instance
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _componentInitialize($instance) {
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] New ' . $this->component_name . ' instance is ' . $instance . '.');
    return $instance;
  }

  /**
   * 
   * @param none.
   * @return The JS code.
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _generate($instance = '') {
    $output = '';
    return $output;
  }
}