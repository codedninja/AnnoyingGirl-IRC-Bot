<?php
$Quote = Phrase_Text($Line, 4);
$conn = mysql_connect($db['host'], $db['user'], $db['password']);
if ($conn) {
	mysql_select_db($db['database'], $conn);
	$Add = mysql_query("INSERT INTO `Quotes` (`Quote`, `Username`) VALUE ('" .escape($Quote). "', '" .escape($Username[0]). "')");
	$ID = mysql_query("SELECT `ID` FROM `Quotes` WHERE `Quote` = '" .escape($Quote). "' LIMIT 1");
	if (!$ID || !$Add) {
		fwrite($fp, "PRIVMSG " .$Chan. " : Sorry, but I couldn't add that quote.\r\n");
	}
	else {
		$ID = mysql_fetch_array($ID);
		fwrite($fp, "PRIVMSG " .$Chan. " : I have added your quote to database. Id " .$ID['ID']. "\r\n");
	}
}
mysql_close($conn);