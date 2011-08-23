<?php
$Hosts = split("\n", shell_exec("host " .trim($Line[4])));
foreach($Hosts as $Host) {
	fwrite($fp, "PRIVMSG " .$Username[0]. " : " .$Host. "\r\n");
}