<?php
$Flip = (rand(0, 1) > 0) ? 'heads' : 'tails';
fwrite($fp, "PRIVMSG ".$Chan." :" .$Username[0]. ": You fliped a coin and it landed on " .$Flip. ".\r\n");