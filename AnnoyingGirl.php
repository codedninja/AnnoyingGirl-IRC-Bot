<?php

// Webpage for replies from twilio.

$AccountSid = "";
$AuthToken = "";
$FolderPath = "http://www.example.com/twilio";

if (isset($_POST['Phone']) && isset($_POST['Text'])) {
	if ($_POST['AccountSid'] == $AccountSid && $_POST['AuthToken'] == $AuthToken) {
		
		$Open_Xml = fopen("twilio.xml", "w");
		fwrite($Open_Xml, "<?xml version='1.0' encoding='utf-8' ?>\n");
		fwrite($Open_Xml, "<Response>\n");
		fwrite($Open_Xml, "	<Say voice=\"woman\">\n");
		fwrite($Open_Xml, "		".$_POST['Text']."\n");
		fwrite($Open_Xml, "	</Say>\n");
		fwrite($Open_Xml, "	<Hangup/>\n");
		fwrite($Open_Xml, "</Response>");
		fclose($Open_Xml);
		
		/* Include the PHP TwilioRest library */
		require "twilio.php";
    
		/* Twilio REST API version */
		$ApiVersion = "2008-08-01";
    
		/* Instantiate a new Twilio Rest Client */
		$client = new TwilioRestClient($_POST['AccountSid'], $_POST['AuthToken']);
    
		/* Initiate a new outbound call by POST'ing to the Calls resource */
		$response = $client->request("/$ApiVersion/Accounts/".$_POST['AccountSid']."/Calls", 
			"POST", array(
			"Caller" => "347-632-0269",
			"Called" => trim($_POST['Phone']),
			"Url" => $FolderPath. "/twilio.xml"
		));
		
		if($response->IsError) {
			echo "Error: {$response->ErrorMessage}";
		}
		else {
			echo "Started call: {$response->ResponseXml->Call->Sid}";
		}
	}
	else {
		echo "You don't belong here!";
	}
}
else {
	echo "Wrong vars";
}
?>
	