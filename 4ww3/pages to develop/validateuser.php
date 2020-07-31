<?php
	function validatePattern(&$errors, $field, $finame, $pattern)
	{
		if (empty($finame))
			$errors[$finame] = 'Required';
		else if (!preg_match($pattern, $field[$finame]))
			$errors[$finame] = 'Invalid';
	}
?>