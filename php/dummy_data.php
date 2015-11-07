<?php 
require('connection.php');

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomNumber($length = 11) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


for($i=0; $i<30; $i++){

$theSms = "SMS " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString();

$theWsms = "Watsapp SMS " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . 
generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString() . " " . generateRandomString();

//$date = "2015-".rand(1,12)."-".rand(1,30);
$date = "2015-08-15";
$senderSms = '';
$senderWhatsapp = '';
$smsContent ="";
$whatsappContent = "";
switch (rand(0,3)) {
    case 0:
        $chooseMethod = "WhatsappPref";
		$smsContent = $theSms;
		$whatsappContent = $theWsms;
		$senderSms = "SMS Sender ID";
		$senderWhatsapp = "WhatsApp Sender ID";
		$status = "Pending";
        break;
    case 1:
       $chooseMethod = "Whatsapp";
	   $whatsappContent = $theWsms;
	   $senderWhatsapp = "WhatsApp Sender ID";
	   $status = "";
        break;
    case 2:
        $chooseMethod = "SMS";
		$smsContent = $theSms;
		$senderSms = "SMS Sender ID";
		$status = "";
        break;
	case 3:
        $chooseMethod = "SMSPref";
		$smsContent = $theSms;
		$whatsappContent = $theWsms;
		$senderSms = "SMS Sender ID";
		$senderWhatsapp = "WhatsApp Sender ID";
		$status = "";
        break;
}


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


$singleNumber = generateRandomNumber();

/*
echo $date;
echo "<br>";
echo $chooseMethod; 
echo "<br>";
echo $smsContent;
echo "<br>";
echo $whatsappContent;
echo "<br>";
echo $senderSms;
echo "<br>";
echo $senderWhatsapp;


echo $singleNumber;
echo "<br>";
*/



	$affected_rows = $db->exec("INSERT INTO `messages` ( `DATE`, `METHOOD`, `SENDER_ID_SMS` , `SENDER_ID_WAPP` , `DEST_NUM` , `STATUS` , `MESSAGE_SMS` , `MESSAGE_WAPP` )
	VALUES (
	'$date', '$chooseMethod ', '$senderSms', '$senderWhatsapp', '$singleNumber', '$status', '$smsContent', '$whatsappContent'
	)");

	
}
echo $singleNumber;
echo "<br>";
echo $date;
?>