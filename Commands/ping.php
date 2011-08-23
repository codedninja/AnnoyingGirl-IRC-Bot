<?php
$Ping = split("\n", system("ping " .trim($Line[4])." -c1 | grep time=| cut -d ' ' -f8,9"));
foreach($Ping as $Ping_Line) {
	fwrite($fp, "PRIVMSG " .$Chan. " : " .$Ping_Line. "\r\n");
}