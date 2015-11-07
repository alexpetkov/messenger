<?php

require('connection.php');

// Process form to MySql

$data = json_decode(file_get_contents('php://input'),true);
$chooseMethod = $data[chooseMethod];
if($chooseMethod!=''){
$senderSms = $data[senderSms];
$senderWhatsapp = $data[senderWhatsapp];
$smsContent = addslashes($data[smsContent]);
$whatsappContent = addslashes($data[whatsappContent]);
$destinationNumbers = $data[destinationNumbers];

// Breaking the destination numbers in Array
$singleNumberArray = explode("\n", $destinationNumbers);


// Walk the Array of numbers and generate query to DB
		foreach ($singleNumberArray as $singleNumber) {
			$singleNumber = trim($singleNumber);
			switch (rand(0,3)) {
			case 0:
				$status = "Pending";
				break;
			case 1:
				$status = "Sent";
				break;
			case 2:
				$status = "Delivered";
				break;
			case 3:
				$status = "Failed";
				break;
		}
	
		$date = date('Y-m-d');
		
		
		$affected_rows = $db->prepare("INSERT INTO `messages` ( `DATE`, `METHOOD`, `SENDER_ID_SMS` , `SENDER_ID_WAPP` , `DEST_NUM` , `STATUS` , `MESSAGE_SMS` , `MESSAGE_WAPP` )
		VALUES (
		'$date', '$chooseMethod', '$senderSms', '$senderWhatsapp', '$singleNumber', '$status', '$smsContent', '$whatsappContent'
		)");
		
		$affected_rows->execute();
		
		
	}



}

?>