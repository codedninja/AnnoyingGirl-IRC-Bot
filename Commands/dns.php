<?php
if (preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', trim($Line[4]))) {
	fwrite($fp, "PRIVMSG ".$Chan." :" .$Username[0]. ": " .gethostbyaddr(trim($Line[4])). ".\r\n");
}
else {
	fwrite($fp, "PRIVMSG ".$Chan." :Sorry, couldn't reverse that IP.\r\n");
}