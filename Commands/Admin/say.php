<?php
$Channel = preg_split("//", $Line[4]);
if ($Channel[1] == "#") {
	fwrite($fp, "PRIVMSG ".trim($Line[4])." :" .Phrase_Text($Line, 5). ".\r");
}
else {
	fwrite($fp, "PRIVMSG ".$Line[2]." :" .Phrase_Text($Line, 4). ".\r");
}