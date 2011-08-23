<?php
fwrite($fp, "PRIVMSG ".$Chan." :" .str_rot13(Phrase_Text($Line, 4)). ".\r\n");