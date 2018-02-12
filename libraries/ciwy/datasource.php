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
 * @package CIwY datasource class
 * @version 0.0.2b 2010-04-30
 * @copyright 2009-2010 Fabio Ingala
 * @author Fabio Ingala (http://fabio.ingala.it) - fabio [at] ingala [dot] it
 * @link http://ciwy.sourceforge.net
 * @link http://sourceforge.net/projects/ciwy/files/ Get full documentation.
 * @link http://sourceforge.net/projects/ciwy/support Please submit all bug reports and feature requests to the forums.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */

class Datasource {

  /**
   * Please modify according with your needs
   */

  /**
   * Default component configuration
   *
   * dataType
   * The type of data managed by this component between TYPE_UNKNOWN    ()
   *                                                    TYPE_LOCAL      ()
   *                                                    TYPE_XHR        ()
   *                                                    TYPE_SCRIPTNODE ()
   *                                                    TYPE_JSFUNCTION ()
   *
   * responseType
   * The type of data in response between               TYPE_JSARRAY   ()
   *                                                    TYPE_JSON      ()
   *                                                    TYPE_XML       ()
   *                                                    TYPE_TEXT      ()
   *                                                    TYPE_HTMLTABLE ()
   *
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  var $default_config = array(
      'dataType'     => 'TYPE_LOCAL',
      'responseType' => 'TYPE_JSARRAY',
  );

  /**
   * No modifications are necessary under this point
   */

  /**
   * The Code Igniter Superobject
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $CI;

  /**
   * The name of this component
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $component_name = 'datasource';

  /**
   * The component callback properties with theirs format
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $component_callback_property = array(
          'success'        => 'function',
          'failure'        => 'function',
          'scope'          => 'widget',
          'argument'       => 'object',
  );

  /**
   * The component parsed response properties with theirs format
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $component_parsed_response_property = array(
          'tId'            => 'number',
          'results'        => 'array',
          'error'          => 'boolean',
          'cached'         => 'boolean',
          'meta'           => 'object',
  );

  /**
   * The component properties with theirs format
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $component_property = array(
          'dataType'        => 'number',
          'liveData'        => 'object',
          'maxCacheEntries' => 'Number',
          'parseJSONArgs'   => 'mixed/array',
          'Parser'          => 'object',
          'responseSchema'  => 'object',
          'responseType'    => 'number',
          'useXPath'        => 'boolean',
  );

  /**
   * The list of data type
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $data_type = array(
          'TYPE_UNKNOWN'    => 'LocalDataSource',
          'TYPE_LOCAL'      => 'LocalDataSource',
          'TYPE_XHR'        => 'XHRDataSource',
          'TYPE_SCRIPTNODE' => 'ScriptNodeDataSource',
          'TYPE_JSFUNCTION' => 'FunctionDataSource',
  );

  /**
   * The component event properties
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $event_property = array(
          'cacheFlushEvent',
          'cacheRequestEvent',
          'cacheResponseEvent',
          'dataErrorEvent',
          'requestEvent',
          'responseCacheEvent',
          'responseEvent',
          'responseParseEvent',
  );

  /**
   * The list of response type
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $response_type = array(
      'TYPE_JSARRAY'   => array(
          'name'   => 'Array',
          'schema' => array(
              'fields'      => 'array',
          ),
      ),
      'TYPE_JSON'      => array(
          'name'   => 'JSON',
          'schema' => array(
              'resultsList' => 'string',
              'fields'      => 'array',
              'metaFields'  => 'object',
          ),
      ),
      'TYPE_XML'       => array(
          'name'   => 'XML',
          'schema' => array(
              'resultsNode' => 'string',
              'fields'      => 'array',
              'metaNode'    => 'string',
              'metaFields'  => 'object',
          ),
      ),
      'TYPE_TEXT'      => array(
          'name'   => 'Text',
          'schema' => array(
              'recordDelim' => 'string',
              'fieldDelim'  => 'string',
          ),
      ),
      'TYPE_HTMLTABLE' => array(
          'name'   => 'Table',
          'schema' => array(
              'fields'      => 'array',
          ),
      ),
  );

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
  );

  /**
   * To fire a new line at the end of the line in JS code.
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $new_line = "\n";

  /**
   * The class constructor. Performs several action:
   * -
   * @param none.
   * @return The HTML code.
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  function Datasource($instance) {
    $this->CI =& get_instance();                                                                   // Get CodeIgniter super object
    $this->_componentInitialize($instance);                                                        // Initialize the component
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] ' . $this->component_name . ' class initialized.');
  }

  /**
   * Set the datasource dataType property to a specific type.
   * @param string $type The dataType type.
   * @param $string $instance The instance in wich set the dataType.
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  function setDataType($type) {
    $instance = $this->CI->ciwy->current_instance[$this->component_name];
    if (!array_key_exists($type, $this->data_type)) {
      echo $type . ' is not a valid dataType.<br />';
    } else {
      $this->CI->ciwy->component_config[$instance]['dataType'] = $type;
    }
  }

  /**
   * Set the datasource dataType property to a specific type.
   * @param string $type The dataType type.
   * @param $string $instance The instance in wich set the dataType.
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  function setLocalData($local_data) {
    $instance = $this->CI->ciwy->current_instance[$this->component_name];
    $this->CI->ciwy->component_config[$instance]['localData'] = $local_data;

    /*
    // codice valido per TYPE_JSARRAY      -- INIZIO --
    foreach ($local_data[key($local_data)] as $key => $val) {
      $fields[] = $key;
    }
    $schema['fields'] = $fields;
    // codice valido per TYPE_JSARRAY       -- FINE --
    */
    
    // codice valido per TYPE_JSON e TYPE_JSARRAY         -- INIZIO --
    $schema['resultsList'] = 'ResultSet.Result';
    if (is_string(key($local_data))) {
      foreach ($local_data[key($local_data)] as $key => $val) {
        $fields[] = $key;
      }
    } else {
      $fields[] = 'field';
    }
    $schema['fields']      = $fields;
    $schema['metaFields']  = array(
        'totalRecords' => 'ResultSet.totalResultsReturned'
        );
    
    // codice valido per TYPE_JSON e TYPE_JSARRAY          -- FINE --


    $this->_setResponseSchema($schema);
  }

  /**
   * Set the autocomplete property to a specific value.
   * @param array [$property] An array vector as pair of property => value.
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
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
   *
   * @param string $type The responseType type.
   * @param $string $instance The instance in wich set the dataType.
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  function setResponseSchema() {
    $instance = $this->CI->ciwy->current_instance[$this->component_name];
    $schema = func_get_arg(0);
    if (is_array($schema)) {
      foreach($schema as $key => $val) {
        if ( ! isset($this->response_type[$this->CI->ciwy->component_config[$instance]['responseType']]['schema'][$key])) {
          $message = '[' . $this->CI->ciwy->library_name . '] '. $key . ' is not a '.$this->component_name .' responseSchema valid schema.';
          log_message('error', $message);
          show_error($message);
        } else {
          $this->CI->ciwy->component_config[$instance]['responseSchema'][$key] = $val;
        }
      }
    }
  }

  /**
   * Set the datasource responseType property to a specific type.
   * @param string $type The responseType type.
   * @param $string $instance The instance in wich set the dataType.
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  function setResponseType($type) {
    $instance = $this->CI->ciwy->current_instance[$this->component_name];
    if (!array_key_exists($type, $this->response_type)) {
      $message = '[' . $this->CI->ciwy->library_name . '] '. $type . ' is not a '.$this->component_name .' responseType valid type.';
      log_message('error', $message);
      show_error($message);
    } else {
      $this->CI->ciwy->component_config[$instance]['responseType'] = $type;
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
    $this->setDataType($this->default_config['dataType']);
    $this->setResponseType($this->default_config['responseType']);
    //print_r($this->CI->ciwy->component_config[$instance]);
    //$this->setResponseSchema($this->response_type[$this->default_config['responseType']]['schema']);
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] New ' . $this->component_name . ' instance is ' . $instance . '.');
    return $instance;
  }

  /**
   * Generate the JavaScript code according to componentConfigs.
   * @param none.
   * @return The JS code.
   * @access public
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _generate($instance) {
    //print_r($this->CI->ciwy->component_config[$instance]);
    $output = '';
    $output .= '    var ' . $instance . ' = new YAHOO.util.' . $this->data_type[$this->CI->ciwy->component_config[$instance]['dataType']] . '(' . $this->new_line;
    $get_data_function = '_get' . $this->data_type[$this->CI->ciwy->component_config[$instance]['dataType']];
    $output .= $this->$get_data_function($instance) . $this->new_line;
    $output .= '        );' . $this->new_line;
    $output .= '        '.$instance.'.responseType   = YAHOO.util.' . $this->data_type[$this->CI->ciwy->component_config[$instance]['dataType']] . '.';
    $output .= $this->CI->ciwy->component_config[$instance]['responseType'] . ';' . $this->new_line;
    $output .= '        ' . $instance . '.responseSchema = ' . $this->_getResponseSchema($instance) . '' . $this->new_line;
    $this->_getResponseSchema($instance);
    return $output;
  }
  
  function _getResponseSchema($instance) {
    $output  = '{' . $this->new_line;
    $count_element   = count($this->response_type[$this->CI->ciwy->component_config[$instance]['responseType']]['schema']);
    $current_element = 1;
    foreach($this->response_type[$this->CI->ciwy->component_config[$instance]['responseType']]['schema'] as $key => $val) {
      if (is_array($this->CI->ciwy->component_config[$instance]['responseSchema'][$key])) {
        $output .= '            ' . $key . ' : ' . $this->CI->ciwy->_jsArray($this->CI->ciwy->component_config[$instance]['responseSchema'][$key]);
      } else {
        $output .= '            ' . $key . ' : "' . $this->CI->ciwy->component_config[$instance]['responseSchema'][$key] . '"';
      }
      if ($current_element < $count_element) {
        $output .= ', ';                                                                           // Add a colon only if this isn't the last element
        $output .= $this->new_line;                                                                //
      } else {
        $output .= $this->new_line;                                                                //
      }
      $current_element ++;
    }
    $output .= '        };' . $this->new_line;
    //echo $this->CI->ciwy->_jsObjectArray($this->CI->ciwy->component_config[$instance]['responseSchema']);
    //echo 'ResponseSchema = ' . $output;
    return $output;
  }

  function _getLocalDataSource($instance) {
    $output = '';
    switch ($this->CI->ciwy->component_config[$instance]['responseType']) {
      case 'TYPE_JSARRAY':
        //$output .= $this->CI->ciwy->_jsObjectArray($this->CI->ciwy->component_config[$instance]['localData'], 12);
        $output .= $this->CI->ciwy->_jsLiteralArray($this->CI->ciwy->component_config[$instance]['localData'], 12);
        break;

      case 'TYPE_JSON':
        $output .= $this->CI->ciwy->_jsJson($this->CI->ciwy->component_config[$instance]['localData']);
        break;

      case 'TYPE_XML':
        $message = '[' . $this->CI->ciwy->library_name . '] '.$this->component_name.': TYPE_XML LocalDataSource not yet implemented, please collaborate with the developer';
        log_message('error', $message);
        show_error($message);
        break;

      case 'TYPE_TEXT':
        $message = '[' . $this->CI->ciwy->library_name . '] '.$this->component_name.': TYPE_TEXT LocalDataSource not yet implemented, please collaborate with the developer';
        log_message('error', $message);
        show_error($message);
        break;

      case 'TYPE_TABLE':
        $message = '[' . $this->CI->ciwy->library_name . '] '.$this->component_name.': TYPE_TABLE LocalDataSource not yet implemented, please collaborate with the developer';
        log_message('error', $message);
        show_error($message);
        break;

      default:
        $output = '_getLocalDataSource: Unknown responseType.';
        break;
    }
    return $output;
  }

  function _getXHRDataSource($instance) {
    $message = '[' . $this->CI->ciwy->library_name . '] '.$this->component_name.': XHRDataSource method not yet implemented, please collaborate with the developer';
    log_message('error', $message);
    show_error($message);
    return $output;
  }

  function _getScriptNodeDataSource($instance) {
    $message = '[' . $this->CI->ciwy->library_name . '] '.$this->component_name.': ScriptNodeDataSource method not yet implemented, please collaborate with the developer';
    log_message('error', $message);
    show_error($message);
  }

  function _getFunctionDataSource($instance) {
    $message = '[' . $this->CI->ciwy->library_name . '] '.$this->component_name.': FunctionDataSource method not yet implemented, please collaborate with the developer';
    log_message('error', $message);
    show_error($message);
  }

  function _setResponseSchema($schema) {
    $instance = $this->CI->ciwy->current_instance[$this->component_name];
    $this->CI->ciwy->component_config[$instance]['responseSchema'] = $schema;
  }
}