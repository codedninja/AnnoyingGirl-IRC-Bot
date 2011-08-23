<?php

$data = 'http://'.trim($Line[4]);

// Create a curl handle to a non-existing location
$ch = curl_init($data);

// Execute
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);

// Check if any error occured
if(curl_errno($ch)) {	
	fwrite($fp, "PRIVMSG ".$Chan." :The domain is not available!\r\n");
}
else {
	fwrite($fp, "PRIVMSG ".$Chan." :The domain is available!\r\n");
}

// Close handle
curl_close($ch);