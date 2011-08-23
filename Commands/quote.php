<?php
$Conn = mysql_connect($db['host'], $db['user'], $db['password']);    
if ($Conn) {
	mysql_select_db($db['database']); 
	$Results = mysql_query("SELECT * FROM `Quotes` WHERE `ID` = '" .escape($Line[4]). "' LIMIT 1");
	$Quote  = mysql_fetch_array($Results);
	if (!$Quote) {
		fwrite($fp, "PRIVMSG " .$Chan. " : Sorry, but I couldn't get that quote.\r\n");
	}
	else {
		fwrite($fp, "PRIVMSG " .$Chan. " : Quote " .trim($Line[4]). ": " .$Quote[3]. "\r\n");
	}
}
mysql_close($Conn);