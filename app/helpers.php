<?php

if (!function_exists('format_employee_name')) {
	function format_employee_name($name, $prefix = null)
	{
		return trim(($prefix ? $prefix . ' - ' : '') . $name);
	}
}


