<?php
fwrite($fp, "PRIVMSG ".$Line[2]." :Bye Bye Channel.\r");
fwrite($fp, "QUIT ".$QuitMessage." \r");

unset($fp);

$fp = fsockopen($Host, $Port, $Erno, $Errstr, 30);

fwrite($fp, "NICK ".$Nick."\r\n");
fwrite($fp, "USER ".$Ident." ".$Host." bla :".$RealName."\r\n");
fwrite($fp, "PRIVMSG NickServ :IDENTIFY " .$Password. "\r\n");

foreach($Channels as $Channel) {
	fwrite($fp, "JOIN :".$Channel."\r\n");
}
foreach($Part_Channels as $Channel) {
	fwrite($fp, "PART :".$Channel."\r");
}