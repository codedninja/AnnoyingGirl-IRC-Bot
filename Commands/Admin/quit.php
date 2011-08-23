<?php
fwrite($fp, "PRIVMSG ".$Line[2]." :Bye Bye Channel.\r");
fwrite($fp, "QUIT "$QuitMessage" \r");
die();