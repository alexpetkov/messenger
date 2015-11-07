<?php

require('connection.php');

header('Content-Type: application/json');


$pagenum = $_GET['page'];
$pagesize = $_GET['size'];
$offset = ($pagenum - 1) * $pagesize;
$search = $_GET['search'];
$searchStatus = $_GET['status'];

if (($search != "")&&($searchStatus != "")) {
    $where = "WHERE DATE LIKE '" . $search . "'";
	$and = "AND STATUS LIKE '" . $searchStatus . "'";
}elseif (($search == "")&&($searchStatus != "")) {
    $where = "";
	$and = "WHERE STATUS LIKE '" . $searchStatus . "'";
}elseif (($search != "")&&($searchStatus == "")) {
    $where = "WHERE DATE LIKE '" . $search . "'";
	$and = "";
}

 elseif (($search == "")&&($searchStatus == "")) {
    $where = "";
	$and = "";
}



$sql = "SELECT COUNT(*) AS count FROM messages $where $and";
$result = $db->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
$count = $row['count'];
$theSql = "SELECT * FROM messages $where $and ORDER BY DATE DESC, ID DESC LIMIT $offset, $pagesize";

$result = $db->query($theSql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $CurrentItems[] = array(
        'msgID' => $row['ID'],
        'msgDate' => $row['DATE'],
        'msgMethood' => $row['METHOOD'],
        'msgSmsSenderID' => $row['SENDER_ID_SMS'],
        'msgWappSenderID' => $row['SENDER_ID_WAPP'],
        'msgDest' => $row['DEST_NUM'],
        'msgStatus' => $row['STATUS'],
		'msgSmsContent' => $row['MESSAGE_SMS'],
		'msgWappContent' => $row['MESSAGE_WAPP']
        );
	
}

$myData = array('CurrentItems' => $CurrentItems, 'totalCount' => $count);

echo json_encode($myData);
?>