<?php

//332
function Cache_Channel($Line, $db) {
	$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
	if ($conn) {
		mysql_select_db($db['database']);
		$Topic = Phrase_Text($Line, 4);
		$Channel = trim($Line[3]);
		mysql_query("INSERT INTO `Cache_Channels` (`Channel_Name`, `Channel_Topic`) VALUES ('".escape($Channel)."', '".escape($Topic)."')");
	}
	mysql_close($conn);
}

//353
function Cache_Who($Line, $db) {
	$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
	if ($conn) {
		mysql_select_db($db['database']); 
		array_pop($Line);
		$Users = array_slice($Line, 5);
		foreach ($Users as $User) {
			$User = trim($User, "&~+%@: ");
			$UEQ = mysql_query("SELECT * FROM Cache_Users WHERE User_Nick = '".mysql_real_escape_string($User)."'");
			$User_Exsists = mysql_num_rows($UEQ);
			if ($User_Exsists == 0) {
				$C_Nick = mysql_real_escape_string($User);
				mysql_query("INSERT INTO Cache_Users (User_Nick) VALUES ('".mysql_real_escape_string($C_Nick)."')");
			}
			$Channel 	=	$Line[4];
			$CID = Cache_Get_Channel_ID($Channel, $db);
			$UID = Cache_Get_User_ID($User, $db);
			$UinC = mysql_query("SELECT * FROM Cache_UinC WHERE User_ID = '{$UID}' AND Channel_ID = '{$CID}'");
			$UinC_Check =	mysql_num_rows($UinC);
			if ($UinC_Check == 0) {
				if ($Line[3] != "*") {
					mysql_query("INSERT INTO Cache_UinC (User_ID, Channel_ID) VALUES ('{$UID}', '{$CID}')");
				}
			}
		}
	}
	mysql_close($conn);
}
	
//Join
function Cache_Join($UserName, $Channel, $db) {
	$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
	if ($conn) {
		mysql_select_db($db['database']);
		mysql_query("INSERT INTO Cache_Users (User_Nick) VALUES ('".mysql_real_escape_string($UserName)."')");
		$CID = Cache_Get_Channel_ID($Channel, $db);
		$UID = Cache_Get_User_ID($UserName, $db);
		$UinC = mysql_query("SELECT * FROM Cache_UinC WHERE User_ID = '{$UID}' AND Channel_ID = '{$CID}'");
		$UinC_Check =	mysql_num_rows($UinC);
		if ($UinC_Check == 0) {
			mysql_query("INSERT INTO Cache_UinC (User_ID, Channel_ID) VALUES ('{$UID}', '{$CID}')");
		}
	}
	mysql_close($conn);
}

//Part
function Cache_Part($UserName, $Channel, $db) {
	$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
	if ($conn) {
		mysql_select_db($db['database']);
		$UID = Cache_Get_User_ID($UserName, $db);
		$CID = Cache_Get_Channel_ID($Channel, $db);
		mysql_query("DELETE FROM Cache_UinC WHERE User_ID = '{$UID}' AND Channel_ID = '{$CID}'");
	}
	mysql_close($conn);
}

//Quit
function Cache_Quit($UserName, $db) {
	$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
	if ($conn) {
		mysql_select_db($db['database']);
		$UID = Cache_Get_User_ID($UserName, $db);
		mysql_query("DELETE FROM Cache_Users WHERE User_ID = '{$UID}'");
		mysql_query("DELETE FROM Cache_UinC WHERE User_ID = '{$UID}'");
	}
	mysql_close($conn);
}

//Nick Change
function Cache_Nick($UserName, $New_UserName, $db) {
	$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
	if ($conn) {
		mysql_select_db($db['database']);
		$UID = Cache_Get_User_ID($UserName, $db);
		$NewNick = str_replace(":", "", $New_UserName);
		mysql_query("UPDATE `Cache_Users` SET `User_Nick` = '".mysql_real_escape_string($New_UserName)."' WHERE User_ID = '{$UID}'");
	}
	mysql_close($conn);
}

//Kicked
function Cache_Kick($UserName, $Channel, $db) {
	$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
	if ($conn) {
		mysql_select_db($db['database']);
		$UID = Cache_Get_User_ID($UserName, $db);
		$CID = Cache_Get_Channel_ID($Channel, $db);
		mysql_query("DELETE FROM Cache_UinC WHERE User_ID = '{$UID}' AND Channel_ID = '{$CID}'");
	}
	mysql_close($conn);
}

//Get Channel's ID
function Cache_Get_Channel_ID($Channel, $db) {
	$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
	if ($conn) {
		mysql_select_db($db['database']);
		$Chan1 = mysql_real_escape_string($Channel);
		$ChanQ = mysql_query("SELECT Channel_ID FROM Cache_Channels WHERE Channel_Name = '".$Chan1."'");
		$ChanID = mysql_fetch_array($ChanQ);
		$CID	= $ChanID['Channel_ID'];
		return $CID;
	}
	mysql_close($conn);
}

//Get User's ID
function Cache_Get_User_ID($User, $db) {
	$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
	if ($conn) {
		mysql_select_db($db['database']);
		$WhoQ	=	mysql_query("SELECT User_ID FROM Cache_Users WHERE User_Nick = '".mysql_real_escape_string($User)."'");
		$WhoID	=	mysql_fetch_array($WhoQ);
		$UID	=	$WhoID['User_ID'];
		return $UID;
	}
	mysql_close($conn);
}

//Run function on start up
function Cache_Initiate($db) {
	$conn = mysql_connect($db['host'], $db['user'], $db['password']);    
	if ($conn) {
		mysql_select_db($db['database']);
		mysql_query("TRUNCATE TABLE `Cache_Users`");
		mysql_query("TRUNCATE TABLE `Cache_Channels`");
		mysql_query("TRUNCATE TABLE `Cache_UinC`");
	}
	mysql_close($conn);
}