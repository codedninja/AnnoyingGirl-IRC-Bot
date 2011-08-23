<?php

fwrite($fp, "PRIVMSG ".$Username[0]." :These are the user commands list.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."help : List the commands I can do.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."host <Domain>: Perform a DNS lookups.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."ping <Domain> or <IP>: Ping a domain or ip from where ever I am located.\r\n");

fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."rules : List the rules for this channel.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."addquote <Quote>: Add a quote to the database.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."quote <ID>: Grabs a quote from the database.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."dns <Domain>: Return IP address from a domain.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."flip: Flips a coin for you.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."roll <# of Dice> <Sides of each dice>: Flips a coin for you.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."rot13 <message>: Encrypts message with ROT13.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."user <username>: Searches database for a username and prints out info about the user.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :- - - - - ".$User_Prefix."user info: Prints info about you.\r\n");
fwrite($fp, "PRIVMSG ".$Username[0]." :".$User_Prefix."version :Prints the version number of the bot.\r\n");