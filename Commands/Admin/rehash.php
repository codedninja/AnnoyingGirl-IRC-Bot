<?php
fwrite($fp, "PRIVMSG " .$Chan. " :- - - - - - - - - - Rehashing Please Wait... - - - - - - - - -\r\n");
$Commands = Command_List($Removed_Commands);
$Admin_Commands = Admin_Command_List($Removed_Commands);
fwrite($fp, "PRIVMSG " .$Chan. " :- - - - - - - - - - - Rehashing Complete - - - - - - - - - - -\r\n");