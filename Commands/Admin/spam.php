<?php
$x = 0;
while ($Line[5] > $x) {
	fwrite($fp, "PRIVMSG ".$Line[4]." :" .Phrase_Text($Line, 6). ".\r");
	$x ++;
	sleep(1);
}