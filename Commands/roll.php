<?php
if (isset($Line[4]) && isset($Line[5])) {
	$s = 0;
	$i = 0;
	while ($i < $Line[4]) {
		$s += rand(1, $Line[5]);
		++$i;
	}
}
else {
	$s = rand(1, 6);
}
fwrite($fp, "PRIVMSG ".$Chan." :" .$Username[0]. ": You Rolled a " .$s. ".\r\n");