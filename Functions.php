<?php
function Command_List($disabled_commands) {
	$dir = opendir('Commands');
	while (($file = readdir($dir)) !== false) {
		if ($file !== '.' && $file !== '..') {
			$file = substr($file, 0, -4);
			if (!isset($disabled_commands[$file])) {
				$function_list[$file] = true;
			}
		}
	}
	closedir($dir);
	return $function_list;
}

function Admin_Command_List($disabled_commands) {
	$dir = opendir('Commands/Admin');
	while (($file = readdir($dir)) !== false) {
		if ($file !== '.' && $file !== '..') {
			$file = substr($file, 0, -4);
			if (!isset($disabled_commands[$file])) {
				$function_list[$file] = true;
			}
		}
	}
	closedir($dir);
	return $function_list;
}

function Phrase_Text($Line, $Out) {
	$Output = array_slice($Line, $Out);
	$Output = implode(" ", $Output);
	return $Output;
}

function escape($str) {
	return mysql_escape_string(stripslashes(trim($str)));
}
?>