<?php

$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
if ($conn) {
	mysql_select_db($db['database']); 
	$Check = mysql_query("SELECT * FROM `Admins` WHERE `Username` = '" .escape(trim($Username[0])). "' AND `Password` = '".mysql_escape_string(sha1(trim($Line[4]))). "' AND `Vhost` = '" .$Username[1]. "' LIMIT 1");
	if (!mysql_num_rows($Check)) {
		$vhost = mysql_fetch_array($Check);
		fwrite($fp, "PRIVMSG ".$Username[0]." :Wrong password. Or you are not an admin!\r\n");
	}
	else {
		$Admins[$Username[0]] = $Username[1];
		fwrite($fp, "PRIVMSG ".$Username[0]." :You are now logged in!\r\n");
	}
}
mysql_close($conn);