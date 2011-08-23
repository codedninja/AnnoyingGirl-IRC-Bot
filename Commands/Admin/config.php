<?php

if (trim($Line[4]) == "AUV") {
	$Auto_Voice_Channels[$Line[5]] = trim($Line[5]);
	fwrite($fp, "PRIVMSG " .$Line[2]. " :Added " .trim($Line[5]). " to the auto voice list.\r\n");
}
elseif (trim($Line[4]) == "RAUV") {
	unset($Auto_Voice_Channels[$Line[5]]);
	fwrite($fp, "PRIVMSG " .$Line[2]. " :Removed " .trim($Line[5]). " from the auto voice list.\r\n");
}
elseif (trim($Line[4]) == "AOP") {
	$Auto_OP_Channels[$Line[5]] = trim($Line[5]);
	fwrite($fp, "PRIVMSG " .$Line[2]. " :Added " .trim($Line[5]). " to the auto OP list.\r\n");
}
elseif (trim($Line[4]) == "RAOP") {
	unset($Auto_OP_Channels[$Line[5]]);
	fwrite($fp, "PRIVMSG " .$Line[2]. " :Removed " .trim($Line[5]). " from the auto OP list.\r\n");
}
else {
	fwrite($fp, "PRIVMSG " .$Line[2]. " :Try \"@help config\".\r\n");
}