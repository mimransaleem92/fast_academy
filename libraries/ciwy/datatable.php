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
 * @package CIwY datatable class
 * @version 0.0.03b 2010-08-01
 * @copyright 2009-2010 Fabio Ingala
 * @author Fabio Ingala (http://fabio.ingala.it) - fabio [at] ingala [dot] it
 * @link http://ciwy.sourceforge.net
 * @link http://sourceforge.net/projects/ciwy/files/ Get full documentation.
 * @link http://sourceforge.net/projects/ciwy/support Please submit all bug reports and feature requests to the forums.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */

class Datatable {

  /**
   * Please modify according with your needs
   */

  /**
   * Default component configuration
   *
   * @access private
   * @since 0.0.03b (2010-08-01)
   * @see none
   */
  var $default_config = array(
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
   * The name of this widget
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $component_name = 'datatable';

  /**
   * The column properties with theirs format
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $column_property = array(
          'abbr'          => 'string',
          'children'      => 'objects',
          'className'     => 'string',
          'editor'        => 'string',
          'editorOptions' => 'object',
          'field'         => 'string',
          'formatter'     => 'string',
          'hidden'        => 'boolean',
          'key'           => 'string',  // Necessary property
          'label'         => 'string',
          'maxAutoWidth'  => 'number',
          'minWidth'      => 'number',
          'resizeable'    => 'boolean',
          'selected'      => 'boolean',
          'sortable'      => 'boolean',
          'sortOptions'   => 'object',
          'width'         => 'number',
  );

  /**
   * The widget properties with theirs format
   * @access private
   * @since 0.0.1b (2010-01-14)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  var $component_property = array(
          'caption'          => 'string',
          'currencyOptions'  => 'object',
          //'currencySymbol'   => '',
          'dateOptions'      => 'object',
          'draggableColumns' => 'boolean',
          'dynamicData'      => 'boolean',
          'formatRow'        => 'function',
          'generateRequest'  => 'function',
          'initialLoad'      => 'boolean/object',
          'initialRequest'   => 'mixed',
          'MSG_EMPTY'        => 'string',
          'MSG_ERROR'        => 'string',
          'MSG_LOADING'      => 'string',
          'MSG_SORTASC'      => 'string',
          'MSG_SORTDESC'     => 'string',
          'numberOptions'    => 'object',
          'paginator'        => 'object',
          'renderLoopSize'   => 'number',
          'selectionMode'    => 'string',
          'sortedBy'         => 'object',
          'summary'          => 'string',
  );

  /**
   * The datatable event properties
   * @access private
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  var $event_property = array(
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
  function Datatable($instance) {
    $this->CI =& get_instance();                                                                   // Get CodeIgniter super object
    $this->CI->ciwy->component_config[$instance]['dataSourceInstance'] = $this->CI->ciwy->loadComponent('datasource'); // Autocomplete need datasource to work
    $this->CI->ciwy->component_config[$this->CI->ciwy->component_config[$instance]['dataSourceInstance']]['componentInstance'] = $instance; // Tell to datasource instance for which component
    $this->_componentInitialize($instance);                                                        // Initialize the component
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] ' . $this->component_name . ' class initialized.');
  }

  /**
   * Set 
   * @param array [$property] An array vector as pair of property => value.
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function setColumnProperty() {
    $instance = $this->CI->ciwy->current_instance[$this->component_name];
    $columns = func_get_arg(0);
    if (is_array($columns)) {
      foreach($columns as $column => $properties) {
        //$properties = array_unshift($properties, array('key' => $column));
        $properties['key'] = $column;
        foreach ($properties as $key => $val) {
          if ( ! isset($this->column_property[$key])) {
            $message = '[' . $this->CI->ciwy->library_name . '] '. $key . ' is not a '.$this->component_name .' columnProperty.';
            log_message('error', $message);
            show_error($message);
          } else {
            //echo '$val['.$key.'] = ' . $val . '<br />';
            $this->CI->ciwy->component_config[$instance]['columnsConfig'][$column][$key] = $val;
            //$this->columnsConfigs[$this->currentinstance][$column][$key] = $val;
          }
        }
      }
    }
  }

  /**
   * Set
   * @param array [$property] An array vector as pair of property => value.
   * @return none
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function setProperty() {
    $instance   = $this->CI->ciwy->current_instance[$this->component_name];
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
   * Create a new JS component instance (for multiple instance of this component).
   * This is like a sub costructor.
   * @param none.
   * @return The new current instance
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _componentInitialize($instance) {
    $this->CI->ciwy->component_config[$instance]['container_id'] = $instance.'Container';          // Set the container_id value for the new instance
    //$this->datasourceinstance[$this->currentinstance] = $this->CI->ciwy->datasource->currentinstance; // Bind the autocomplete instance with the corrispondent datasource instance
    log_message('debug', '[' . $this->CI->ciwy->library_name . '] New ' . $this->component_name . ' instance is ' . $instance . '.');
    return $instance;
  }

  /**
   * Generate the HTML code that will contain the component.
   * @param string $instance The instance referefence
   * @return The HTML code.
   * @access public
   * @since 0.0.03b (2010-04-30)
   * @see none
   */
  function _container($instance) {
    return '<div id="' . $this->CI->ciwy->component_config[$instance]['container_id'] . '"></div>' . $this->new_line; // The HTML code where the component will be placed
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
    $output  = $this->CI->ciwy->datasource->_generate($this->CI->ciwy->component_config[$instance]['dataSourceInstance']);
    $output .= $this->_getColumnDefs($instance) . $this->new_line;
    $output .= $this->_getConfigs($instance) . $this->new_line;
    $output .= '    var ' . $instance . ' = new YAHOO.widget.DataTable("' . $this->CI->ciwy->component_config[$instance]['container_id'] . '", ';
    $output .=                                                              $instance . 'ColumnDefs, ';
    $output .=                                                              $this->CI->ciwy->component_config[$instance]['dataSourceInstance'] . ', ';
    $output .=                                                              $instance . 'Configs';
    $output .=                                                       ');' . $this->new_line;
    unset ($this->CI->ciwy->component_instances[$this->CI->ciwy->component_config[$instance]['dataSourceInstance']]); // Evita la doppia generazione di codice per datasource
    return $output;
  }

  /**
   *
   * @param string $instance The columnDef of given instance
   * @return The JS code.
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _getColumnDefs($instance) {
    $output = '    var ' . $instance . 'ColumnDefs = ' . $this->new_line;                                                                            // Reset the output content;
    $output .= $this->CI->ciwy->_jsObjectArray($this->CI->ciwy->component_config[$instance]['columnsConfig'], 8);
    $output .= ';';
    return $output;
  }

  /**
   *
   * @param string $instance The columnDef of given instance
   * @return The JS code.
   * @access public
   * @since 0.0.03b (2010-08-01)
   * @version 0.0.03b (2010-08-01)
   * @see none
   */
  function _getConfigs($instance) {
    //print_r($this->CI->ciwy->component_config[$instance]);
    $output = '    var ' . $instance . 'Configs = ' . $this->new_line;                                                                            // Reset the output content;
    //$output .= $this->CI->ciwy->_jsObjectList(array('caption' => 'prova'),8);
    $output .= $this->CI->ciwy->_jsObjectList($this->CI->ciwy->component_config[$instance]['Config'], 8);
    $output .= ';';
    return $output;
  }

}