<?php
//Connection Vars
$Host = "";											//IRC Server
$Port = 6667;										//IRC Server Port
$Nick = "AnnoyingGirl";								//IRC Bot Username
$Ident = "AnnoyingGirl";							//IRC Bot Ident
$RealName = "AnnoyingGirl";							//IRC Bot RealName
$Password = "vAwr2bru2h";							//Password to identify with ChanServ
$QuitMessage = "http://www.codedninja.com/";		//Message to say when Quit()

//Channel Vars
$Channels = array("");								//Channels to join
$Part_Channels = array();							//Channels to part on connect
$Removed_Commands = array();						//Removed Commands from being rand
$Auto_Voice_Channels = array("");					//Gives voice to people who join these channels
$Auto_OP_Channels = array();						//Gives OP to people who join these channels

//Command Vars
$User_Prefix = "!";									//Prefix for user based commands
$Admin_Prefix = "@";								//Prefix for admin based commands

//Database Vars
$db = array("host" => "localhost", "database" => "annoyinggirl", "user" => "root", "password" => "root");
$Admins = array();

//Twillio Vars
$AccountSid = "";									//Twilio AccountSid
$AuthToken = "";									//Twilio AuthToken
$TwillioPostURL = "http://example.com/AnnoyingGirl.php";	//URL to AnnoyingGirl.php file

//Version and Source code
$Version = "AnnoyingGirl v 2.1.6";
$Source_Code = "http://www.konnitiwa.info/annoyinggirl/beta/AnnoyingGirl-2.1.6.tar.gz";