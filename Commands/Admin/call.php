<?php

$Phone = FALSE;

if (preg_match('^[2-9]\d{2}-\d{3}-\d{4}$^', trim($Line[4]))) {
	$Phone = trim($Line[4]);
}
else {
	fwrite($fp, "PRIVMSG ".$Chan." :You can only call a USA/CA phone number. Ex. 555-555-5555.\r\n");
}

if ($Phone) {
	if (isset($Line[5])) {
		$Text = Phrase_Text($Line, 5);
	}
	else {
		$Text = "The user ".trim($Username[0])." told me to call you. You have been called by Annoying Girl.";
	}
	$Curl_Session = curl_init($TwillioPostURL);
	curl_setopt ($Curl_Session, CURLOPT_POST, 1);
	curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "Phone=".$Phone."&Text=".$Text."&AccountSid=".$AccountSid."&AuthToken=".$AuthToken);
	curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
	$Sid = curl_exec ($Curl_Session);
	curl_close ($Curl_Session);
	fwrite($fp, "PRIVMSG ".$Chan." :Okay, ".$Username[0].". I am calling ".$Line[4].".\r\n");
	print_r($Sid);
}