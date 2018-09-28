<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('angela_storage_get')) {
	function angela_storage_get($var_name, $default='') {
		global $ANGELA_STORAGE;
		return isset($ANGELA_STORAGE[$var_name]) ? $ANGELA_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('angela_storage_set')) {
	function angela_storage_set($var_name, $value) {
		global $ANGELA_STORAGE;
		$ANGELA_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('angela_storage_empty')) {
	function angela_storage_empty($var_name, $key='', $key2='') {
		global $ANGELA_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($ANGELA_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($ANGELA_STORAGE[$var_name][$key]);
		else
			return empty($ANGELA_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('angela_storage_isset')) {
	function angela_storage_isset($var_name, $key='', $key2='') {
		global $ANGELA_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($ANGELA_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($ANGELA_STORAGE[$var_name][$key]);
		else
			return isset($ANGELA_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('angela_storage_inc')) {
	function angela_storage_inc($var_name, $value=1) {
		global $ANGELA_STORAGE;
		if (empty($ANGELA_STORAGE[$var_name])) $ANGELA_STORAGE[$var_name] = 0;
		$ANGELA_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('angela_storage_concat')) {
	function angela_storage_concat($var_name, $value) {
		global $ANGELA_STORAGE;
		if (empty($ANGELA_STORAGE[$var_name])) $ANGELA_STORAGE[$var_name] = '';
		$ANGELA_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('angela_storage_get_array')) {
	function angela_storage_get_array($var_name, $key, $key2='', $default='') {
		global $ANGELA_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($ANGELA_STORAGE[$var_name][$key]) ? $ANGELA_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($ANGELA_STORAGE[$var_name][$key][$key2]) ? $ANGELA_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('angela_storage_set_array')) {
	function angela_storage_set_array($var_name, $key, $value) {
		global $ANGELA_STORAGE;
		if (!isset($ANGELA_STORAGE[$var_name])) $ANGELA_STORAGE[$var_name] = array();
		if ($key==='')
			$ANGELA_STORAGE[$var_name][] = $value;
		else
			$ANGELA_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('angela_storage_set_array2')) {
	function angela_storage_set_array2($var_name, $key, $key2, $value) {
		global $ANGELA_STORAGE;
		if (!isset($ANGELA_STORAGE[$var_name])) $ANGELA_STORAGE[$var_name] = array();
		if (!isset($ANGELA_STORAGE[$var_name][$key])) $ANGELA_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$ANGELA_STORAGE[$var_name][$key][] = $value;
		else
			$ANGELA_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('angela_storage_merge_array')) {
	function angela_storage_merge_array($var_name, $key, $value) {
		global $ANGELA_STORAGE;
		if (!isset($ANGELA_STORAGE[$var_name])) $ANGELA_STORAGE[$var_name] = array();
		if ($key==='')
			$ANGELA_STORAGE[$var_name] = array_merge($ANGELA_STORAGE[$var_name], $value);
		else
			$ANGELA_STORAGE[$var_name][$key] = array_merge($ANGELA_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('angela_storage_set_array_after')) {
	function angela_storage_set_array_after($var_name, $after, $key, $value='') {
		global $ANGELA_STORAGE;
		if (!isset($ANGELA_STORAGE[$var_name])) $ANGELA_STORAGE[$var_name] = array();
		if (is_array($key))
			angela_array_insert_after($ANGELA_STORAGE[$var_name], $after, $key);
		else
			angela_array_insert_after($ANGELA_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('angela_storage_set_array_before')) {
	function angela_storage_set_array_before($var_name, $before, $key, $value='') {
		global $ANGELA_STORAGE;
		if (!isset($ANGELA_STORAGE[$var_name])) $ANGELA_STORAGE[$var_name] = array();
		if (is_array($key))
			angela_array_insert_before($ANGELA_STORAGE[$var_name], $before, $key);
		else
			angela_array_insert_before($ANGELA_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('angela_storage_push_array')) {
	function angela_storage_push_array($var_name, $key, $value) {
		global $ANGELA_STORAGE;
		if (!isset($ANGELA_STORAGE[$var_name])) $ANGELA_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($ANGELA_STORAGE[$var_name], $value);
		else {
			if (!isset($ANGELA_STORAGE[$var_name][$key])) $ANGELA_STORAGE[$var_name][$key] = array();
			array_push($ANGELA_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('angela_storage_pop_array')) {
	function angela_storage_pop_array($var_name, $key='', $defa='') {
		global $ANGELA_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($ANGELA_STORAGE[$var_name]) && is_array($ANGELA_STORAGE[$var_name]) && count($ANGELA_STORAGE[$var_name]) > 0) 
				$rez = array_pop($ANGELA_STORAGE[$var_name]);
		} else {
			if (isset($ANGELA_STORAGE[$var_name][$key]) && is_array($ANGELA_STORAGE[$var_name][$key]) && count($ANGELA_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($ANGELA_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('angela_storage_inc_array')) {
	function angela_storage_inc_array($var_name, $key, $value=1) {
		global $ANGELA_STORAGE;
		if (!isset($ANGELA_STORAGE[$var_name])) $ANGELA_STORAGE[$var_name] = array();
		if (empty($ANGELA_STORAGE[$var_name][$key])) $ANGELA_STORAGE[$var_name][$key] = 0;
		$ANGELA_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('angela_storage_concat_array')) {
	function angela_storage_concat_array($var_name, $key, $value) {
		global $ANGELA_STORAGE;
		if (!isset($ANGELA_STORAGE[$var_name])) $ANGELA_STORAGE[$var_name] = array();
		if (empty($ANGELA_STORAGE[$var_name][$key])) $ANGELA_STORAGE[$var_name][$key] = '';
		$ANGELA_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('angela_storage_call_obj_method')) {
	function angela_storage_call_obj_method($var_name, $method, $param=null) {
		global $ANGELA_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($ANGELA_STORAGE[$var_name]) ? $ANGELA_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($ANGELA_STORAGE[$var_name]) ? $ANGELA_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('angela_storage_get_obj_property')) {
	function angela_storage_get_obj_property($var_name, $prop, $default='') {
		global $ANGELA_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($ANGELA_STORAGE[$var_name]->$prop) ? $ANGELA_STORAGE[$var_name]->$prop : $default;
	}
}
?>