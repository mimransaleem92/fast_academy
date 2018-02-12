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
 * @package CIwY jsloader class
 * @version 0.0.2b 2010-04-30
 * @copyright 2009-2010 Fabio Ingala
 * @author Fabio Ingala (http://fabio.ingala.it) - fabio [at] ingala [dot] it
 * @link http://ciwy.sourceforge.net
 * @link http://sourceforge.net/projects/ciwy/files/ Get full documentation.
 * @link http://sourceforge.net/projects/ciwy/support Please submit all bug reports and feature requests to the forums.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */
define('YUI_AFTER',      'after');
define('YUI_BASE',       'base');
define('YUI_CSS',        'css');
define('YUI_DATA',       'DATA');
define('YUI_DEPCACHE',   'depCache');
define('YUI_DEBUG',      'DEBUG');
define('YUI_EMBED',      'EMBED');
define('YUI_FILTERS',    'filters');
define('YUI_FULLPATH',   'fullpath');
define('YUI_FULLJSON',   'FULLJSON');
define('YUI_GLOBAL',     'global');
define('YUI_JS',         'js');
define('YUI_JSON',       'JSON');
define('YUI_MODULES',    'modules');
define('YUI_SUBMODULES', 'submodules');
define('YUI_EXPOUND',    'expound');
define('YUI_NAME',       'name');
define('YUI_OPTIONAL',   'optional');
define('YUI_OVERRIDES',  'overrides');
define('YUI_PATH',       'path');
define('YUI_PKG',        'pkg');
define('YUI_PREFIX',     'prefix');
define('YUI_PROVIDES',   'provides');
define('YUI_RAW',        'RAW');
define('YUI_REPLACE',    'replace');
define('YUI_REQUIRES',   'requires');
define('YUI_ROLLUP',     'rollup');
define('YUI_SATISFIES',  'satisfies');
define('YUI_SEARCH',     'search');
define('YUI_SKIN',       'skin');
define('YUI_SKINNABLE',  'skinnable');
define('YUI_SUPERSEDES', 'supersedes');
define('YUI_TAGS',       'TAGS');
define('YUI_TYPE',       'type');
define('YUI_URL',        'url');

class YAHOO_util_Loader {

  /**
   * The base directory
   * @property base
   * @type string
   * @default http://yui.yahooapis.com/[YUI VERSION]/build/
   */
  var $base = "";

  /**
   * A filter to apply to result urls. This filter will modify the default path for
   * all modules. The default path is the minified version of the files (e.g., event-min.js).
   * Changing the filter alows for picking up the unminified (raw) or debug sources.
   * The default set of valid filters are:  YUI_DEBUG & YUI_RAW
   * @property filter
   * @type string (e.g.)
   * @default empty string (minified vesion)
   */
  var $filter = "";

  /**
   * An array of filters & filter replacement rules.  Used with $filter.
   * @property filters
   * @type array
   * @default
   */
  var $filters = array();

  /**
   * A list of modules to apply the filter to.  If not supplied, all
   * modules will have any defined filters applied.  Tip: Useful for debugging.
   * @property filterList
   * @type array
   * @default null
   */
  var $filterList = null;

  /**
   * Should we allow rollups
   * @property allowRollups
   * @type boolean
   * @default true
   */
  var $allowRollups = true;

  /**
   * Whether or not to load optional dependencies for the requested modules
   * @property loadOptional
   * @type boolean
   * @default false
   */
  var $loadOptional = false;

  /**
   * Force rollup modules to be sorted as moved to the top of
   * the stack when performing an automatic rollup.  This has a very small performance consequence.
   * @property rollupsToTop
   * @type boolean
   * @default false
   */
  var $rollupsToTop = false;

  /**
   * The first time we output a module type we allow automatic rollups, this
   * array keeps track of module types we have processed
   * @property processedModuleTypes
   * @type array
   * @default
   */
  var $processedModuleTypes = array();

  /**
   * All required modules
   * @property requests
   * @type array
   * @default
   */
  var $requests = array();

  /**
   * List of modules that have been been outputted via getLink() / getComboLink()
   * @property loaded
   * @type array
   * @default
   */
  var $loaded = array();

  /**
   * List of all modules superceded by the list of required modules
   * @property superceded
   * @type array
   * @default
   */
  var $superceded = array();

  /**
   * Keeps track of modules that were requested that are not defined
   * @property undefined
   * @type array
   * @default
   */
  var $undefined = array();

  /**
   * Used to determine if additional sorting of dependencies is required
   * @property dirty
   * @type boolean
   * @default true
   */
  var $dirty = true;

  /**
   * List of sorted modules
   * @property sorted
   * @type array
   * @default null
   */
  var $sorted = null;

  /**
   * List of modules the loader has aleady accounted for
   * @property accountedFor
   * @type array
   * @default
   */
  var $accountedFor = array();

  /**
   * The list of required skins
   * @property skins
   * @type array
   * @default
   */
  var $skins = array();

  /**
   * Contains the available module metadata
   * @property modules
   * @type array
   * @default YUI module metadata for the specified release
   */
  var $modules = array();

  /**
   * The APC cache key
   * @property fullCacheKey
   * @type string
   * @default null
   */
  var $fullCacheKey = null;

  /**
   * List of modules that have had their base pathes overridden
   * @property baseOverrides
   * @type array
   * @default
   */
  var $baseOverrides = array();

  /**
   * Used to determine if we have an APC cache hit
   * @property cacheFound
   * @type boolean
   * @default false
   */
  var $cacheFound = false;

  /**
   * Used to delay caching of module data
   * @property delayCache
   * @type boolean
   * @default false
   */
  var $delayCache = false;

  /* If the version is set, a querystring parameter is appended to the
    * end of all generated URLs.  This is a cache busting hack for environments
    * that always use the same path for the current version of the library.
    * @property version
    * @type string
    * @default null
  */
  var $version = null;
  var $versionKey = "_yuiversion";

  /* Holds the calculated skin definition
    * @property skin
    * @type array
    * @default
  */
  var $skin = array();

  /* Holds the module rollup metadata
    * @property rollupModules
    * @type array
    * @default
  */
  var $rollupModules = array();

  /* Holds global module information.  Used for global dependency support.
    * Note: Does not appear to be in use by recent metadata.  Might be deprecated?
    * @property globalModules
    * @type array
    * @default
  */
  var $globalModules = array();

  /* Holds information about what modules satisfy the requirements of others
    * @property satisfactionMap
    * @type array
    * @default
  */
  var $satisfactionMap = array();

  /* Holds a cached module dependency list
    * @property depCache
    * @type array
    * @default
  */
  var $depCache = array();

  /**
   * Combined into a single request using the combo service to pontentially reduce the number of
   * http requests required.  This option is not supported when loading custom modules.
   * @property combine
   * @type boolean
   * @default false
   */
  var $combine = false;

  /**
   * The base path to the combo service.  Uses the Yahoo! CDN service by default.
   * You do not have to set this property to use the combine option. YUI PHP Loader ships
   * with an intrinsic, lightweight combo-handler as well (see combo.php).
   * @property comboBase
   * @type string
   * @default http://yui.yahooapis.com/combo?
   */
  var $comboBase = "http://yui.yahooapis.com/combo?";

  /**
   * Holds the current combo url for the loaded CSS resources.  This is
   * built with addToCombo and retrieved with getComboLink.  Only used when the combine
   * is enabled.
   * @property cssComboLocation
   * @type string
   * @default null
   */
  var $cssComboLocation = null;

  /**
   * Holds the current combo url for the loaded JavaScript resources.  This is
   * built with addToCombo and retrieved with getComboLink.  Only used when the combine
   * is enabled.
   * @property jsComboLocation
   * @type string
   * @default null
   */
  var $jsComboLocation  = null;

  /**
   * The YAHOO_util_Loader class constructor
   * @constructor
   * @param {string} yuiVersion Defines which version of YUI metadata to load
   * @param {string} cacheKey Unique APC cache key.  This is combined with the YUI base
   * so that updates to YUI will force a new cache entry.  However, if your custom config
   * changes, this key should be changed (otherwise the old values will be used until the cache expires).
   * @param {array} modules A list of custom modules
   * @param {boolean} noYUI Pass true if you do not want the YUI metadata
   */
  function YAHOO_util_Loader($yuiVersion, $cacheKey=null, $modules=null, $noYUI=false) {
    if (!isset($yuiVersion)) {
      die("Error: The first parameter of YAHOO_util_Loader must specify which version of YUI to use!");
    }

    /*
    * Include the metadata config file that corresponds to the requested YUI version
    * Note: we attempt to find a prebuilt config_{version}.php file which contains an associative array,
    * but if not available we'll attempt to find and parse the YUI json dependency file.
    */
    // $parentDir = dirname(dirname(__FILE__));                                                // edit by etabeta on 24/12/2009 10:46 [GMT +1]
    $parentDir = dirname(__FILE__);                                                            // edit by etabeta on 24/12/2009 10:46 [GMT +1] - To put lib dir inside phploader dir
    $phpConfigFile = $parentDir . '/../phploader/lib/meta/config_' . $yuiVersion . '.php';     // edit by etabeta on 30/04/2010 18:32 [GMT +1]
    $jsonConfigFile = $parentDir . '/../phploader/lib/meta/json_' . $yuiVersion . '.txt';

    //echo '$phpConfigFile: ' . $phpConfigFile . '<br />';                                     // edit by etabeta on 24/12/2009 10:46 GMT +1 - To view var content

    if (file_exists($phpConfigFile) && is_readable($phpConfigFile)) {
      require($phpConfigFile);
    } else if (file_exists($jsonConfigFile) && is_readable($jsonConfigFile) && function_exists('json_encode')) {
      $jsonConfigString = file_get_contents($jsonConfigFile);
      $inf = json_decode($jsonConfigString, true);
      $GLOBALS['yui_current'] = $inf;
    } else {
      die("Unable to find a suitable YUI metadata file!");
    }

    global $yui_current;

    $this->apcttl = 0;
    $this->curlAvail  = function_exists('curl_exec');
    $this->apcAvail   = function_exists('apc_fetch');
    $this->jsonAvail  = function_exists('json_encode');
    $this->customModulesInUse = empty($modules) ? false : true;
    $this->base = $yui_current[YUI_BASE];
    $this->comboDefaultVersion = $yuiVersion;
    $this->fullCacheKey = null;
    $cache = null;

    if ($cacheKey && $this->apcAvail) {
      $this->fullCacheKey = $this->base . $cacheKey;
      $cache = apc_fetch($this->fullCacheKey);
    }

    if ($cache) {
      $this->cacheFound = true;
      $this->modules = $cache[YUI_MODULES];
      $this->skin = $cache[YUI_SKIN];
      $this->rollupModules = $cache[YUI_ROLLUP];
      $this->globalModules = $cache[YUI_GLOBAL];
      $this->satisfactionMap = $cache[YUI_SATISFIES];
      $this->depCache = $cache[YUI_DEPCACHE];
      $this->filters = $cache[YUI_FILTERS];
    } else {
      // set up the YUI info for the current version of the lib
      if ($noYUI) {
        $this->modules = array();
      } else {
        $this->modules = $yui_current['moduleInfo'];
      }

      if ($modules) {
        $this->modules = array_merge_recursive($this->modules, $modules);
      }

      $this->skin = $yui_current[YUI_SKIN];
      $this->skin['overrides'] = array();
      $this->skin[YUI_PREFIX] = "skin-";
      $this->filters = array(
              YUI_RAW => array(
                      YUI_SEARCH => "/-min\.js/",
                      YUI_REPLACE => ".js"
              ),
              YUI_DEBUG => array(
                      YUI_SEARCH => "/-min\.js/",
                      YUI_REPLACE => "-debug.js"
              )
      );

      foreach ($this->modules as $name=>$m) {

        if (isset($m[YUI_GLOBAL])) {
          $this->globalModules[$name] = true;
        }

        if (isset($m[YUI_SUPERSEDES])) {
          $this->rollupModules[$name] = $m;
          foreach ($m[YUI_SUPERSEDES] as $sup) {
            $this->mapSatisfyingModule($sup, $name);
          }
        }
      }
    }
  }

  /**
   * Retrieve the calculated url for the component in question
   * @method getUrl
   * @param {string} name YUI component name
   */
  function getUrl($name) {
    // figure out how to set targets and filters
    $url = "";
    $b = $this->base;
    if (isset($this->baseOverrides[$name])) {
      $b = $this->baseOverrides[$name];
    }

    if (isset($this->modules[$name])) {
      $m = $this->modules[$name];
      if (isset($m[YUI_FULLPATH])) {
        $url = $m[YUI_FULLPATH];
      } else {
        $url = $b . $m[YUI_PATH];
      }
    } else {
      $url = $b . $name;
    }

    if ($this->filter) {
      if (count($this->filterList) > 0 && !isset($this->filterList[$name])) {
        // skip the filter
      } else if (isset($this->filters[$this->filter])) {
        $filter = $this->filters[$this->filter];
        $url = preg_replace($filter[YUI_SEARCH], $filter[YUI_REPLACE], $url);
      }
    }

    if ($this->version) {
      $pre = (strstr($url, '?')) ? '&' : '?';
      $url .= $pre . $this->versionKey . '=' . $this->version;
    }

    return $url;
  }

  /**
   * Used to load YUI and/or custom components
   * @method load
   * @param string $varname [, string $... ] List of component names
   */
  function load() {
    //Expects N-number of named components to load
    $args = func_get_args();
    foreach ($args as $arg) {
      $this->loadSingle($arg);
    }
  }

  /**
   * Loads the requested module
   * @method loadSingle
   * @param string $name the name of a module to load
   * @return {boolean}
   */
  function loadSingle($name) {
    $skin = $this->parseSkin($name);

    if ($skin) {
      $this->skins[] = $name;
      $this->dirty = true;
      return true;
    }

    if (!isset($this->modules[$name])) {
      $this -> undefined[$name] = $name;
      return false;
    }

    if (isset($this->loaded[$name]) || isset($this->accountedFor[$name])) {
      // skip
    } else {
      $this->requests[$name] = $name;
      $this->dirty = true;
    }

    return true;
  }

  function mapSatisfyingModule($satisfied, $satisfier) {
    if (!isset($this->satisfactionMap[$satisfied])) {
      $this->satisfactionMap[$satisfied] = array();
    }

    $this->satisfactionMap[$satisfied][$satisfier] = true;
  }

  /**
   * Parses a module's skin.  A modules skin is typically prefixed.
   * @method parseSkin
   * @param string $name the name of a module to parse
   * @return {array}
   */
  function parseSkin($moduleName) {
    if (strpos( $moduleName, $this->skin[YUI_PREFIX] ) === 0) {
      return explode('-', $moduleName);
    }
    
    return null;
  }

  /**
   * Used to output each of the required html tags (i.e.) script or link
   * @method tags
   * @param {string} moduleType Type of html tag to return (i.e.) js or css.  Default is both.
   * @param {boolean} skipSort
   * @return {string}
   */
  function tags() {
    return '<script src="'.$this->getUrl('yuiloader').'"></script>';
  }
}
?>
