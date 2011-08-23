#!/usr/bin/php -q
<?php

function bot() {
	include("Config.php");
	include("Functions.php");
	include("Cache.php");
	$Readbuffer = "";
	$Running = FALSE;
	
	//Command list
	$Commands = Command_List($Removed_Commands);
	$Admin_Commands = Admin_Command_List($Removed_Commands);
	
	//Refresh Cache Database
	Cache_Initiate($db);
	
	while(1) {
		if (!$fp) {
			//echo $errstr." (".$errno.")\n";
			$fp = fsockopen($Host, $Port, $Erno, $Errstr, 30);
		}
		else {
			// write data through the socket to join the channel
			fwrite($fp, "NICK ".$Nick."\r\n");
			fwrite($fp, "USER ".$Ident." ".$Host." bla :".$RealName."\r\n");
			fwrite($fp, "PRIVMSG NickServ :IDENTIFY " .$Password. "\r\n");
			
			foreach($Channels as $Channel) {
				fwrite($fp, "JOIN :".$Channel."\r\n");
			}
			foreach($Part_Channels as $Channel) {
				fwrite($fp, "PART :".$Channel."\r");
			}
			// loop through each line to look for ping
			while (!feof($fp)) {
				$Line = split("[ ]+", fgets($fp, 1024));
				$Username = split("!", str_replace(":", "", $Line[0]));
				if (isset($Line[1]) && $Line[1] == "PRIVMSG") {
					$Command = str_replace(":", "", str_replace($Admin_Prefix, "", str_replace($User_Prefix, "", trim($Line[3]))));
					$Command1 = preg_split("//", $Line[3]);
					if ($Line[2] == $Nick) {
						$Chan = $Username[0];
					}
					else {
						$Chan = $Line[2];
					}
					if ($Command1[2] == $User_Prefix) {
						if ($Commands[$Command] == 1) {
							require("Commands/".$Command.".php");
						}
						elseif ($Command == "source") {
							fwrite($fp, "PRIVMSG ".$Line[2]." :Here you go " .$Source_Code. "\r\n");
						}
					}
					elseif ($Command1[2] == $Admin_Prefix) {
						if ($Admin_Commands[$Command] == 1) {
							if (in_array($Username[1], $Admins)) {
								require("Commands/Admin/".$Command.".php");
							}
							elseif ($Command == "login") {
								require("Commands/Admin/".$Command.".php");
							}
							else {
								fwrite($fp, "PRIVMSG ".$Username[0]." :Admin Only.\r\n");
							}
						}
					}
				}
				elseif (isset($Line[1]) && $Line[1] == "QUIT") {
					if (in_array($Username[1], $Admins)) {
						unset($Admins[$Username[0]]);
						print_r($Admins);
					}
					Cache_Quit(trim($Username[0]), $db);
				}
				elseif (isset($Line[1]) && $Line[1] == "JOIN") {
					$Channel = split(":", $Line[2]);
					if (in_array(trim($Channel[1]), $Auto_Voice_Channels)) {
						fwrite($fp, "MODE " .trim($Channel[1]). " +v " .trim($Username[0]). "\r\n");
					}
					if (in_array(trim($Channel[1]), $Auto_OP_Channels)) {
						fwrite($fp, "MODE " .trim($Channel[1]). " +o " .trim($Username[0]). "\r\n");
					}
					
					if ($Username != $Nick) {
						Cache_Join(trim($Username[0]), trim($Channel[1]), $db);
					}
				}
				elseif (isset($Line[1]) && $Line[1] == "PART") {
					Cache_Part(trim($Username[0]), trim($Channel[1]), $db);
				}
				elseif (isset($Line[1]) && $Line[1] == 332) {
					Cache_Channel($Line, $db);
				}
				elseif (isset($Line[1]) && $Line[1] == 353) {
					Cache_Who($Line, $db);
				}
				elseif (isset($Line[1]) && $Line[1] == "NICK") {
					Cache_Nick(trim($Username[0]), trim($Line[2]), $db);
				}
				elseif  (isset($Line[1]) && $Line[1] == "KICK") {
					Cache_Kick(trim($Username[0]), trim($Line[2]), $db);
				}
				elseif ($Line[0] == "PING") {
					fwrite($fp, "PONG ".$Line[1]."\r\n"); 
				}
				else {
				}
			}
		}
	}
}
fclose($fp);
?>
