<?php  
// error_reporting(E_ERROR | E_PARSE);
set_time_limit(0);
include_once('config.php');
$passkey = $_GET['passkey'];
$application = $_GET['app'];
$target_group  = $_GET['group'];
$medium  = $_GET['medium'];
$message = $_GET['body'];
// Check if api key was provided
if(!isset($passkey)){
echo json_encode(
array(
'code'  => 1,
'message' => 'API key is required.'
)
);

die();
}
if(!isset($application)){
echo json_encode(
array(
'code'  => 2,
'message' => 'project 5560: application name is required.'
)
);

die();
}
if(!isset($target_group)){
echo json_encode(
array(
'code'  => 3,
'message' => 'project 5560: Target group name is required.'
)
);

die();
}
if(!isset($message) || $message == ""){
echo json_encode(
array(
'code'  => 4,
'message' => 'project 5560: message body is required.'
)
);

die();
}
if(!isset($medium)){
echo json_encode(
array(
'code'  => 4,
'message' => 'project 5560: medium name missed'
)
);

die();
}
if($medium != 'telegram'){
echo json_encode(
array(
'code'  => 4,
'message' => 'project 5560: medium not Valid.'
)
);

die();
}

$conn = mysqli_connect($mysqlhost, $user, $password, 'project');

date_default_timezone_set('America/Santiago');
$date  = date('Y-m-d G:i:s');

// Check if application id exists
$q = $conn->query("SELECT application FROM api WHERE application = '$application'");
if($q->num_rows == 0){
echo json_encode(
array(
'code'  => 6,
'message' => 'project 5560: application doesn\'t exist. '
)
);

die();
}
$q = $conn->query("SELECT target_group FROM api WHERE target_group = '$target_group'");
if($q->num_rows == 0){
echo json_encode(
array(
'code'  => 7,
'message' => 'project 5560: target_group doesn\'t exist.'
)
);

die();
}




$q = $conn->query("SELECT `passkey` FROM api WHERE passkey = '$passkey' AND application = '$application' AND target_group = '$target_group' AND Valid = 1");

if($q->num_rows == 0){
echo json_encode(
array(
'code'  => 5,
'message' => 'project 5560: API key is no more Valid'
)
);

die();
}

$q = $conn->query("SELECT `passkey` FROM api WHERE passkey = '$passkey' AND application = '$application' AND target_group = '$target_group' AND Valid = 1 AND Expiry_date >= CURRENT_DATE()");

if($q->num_rows == 0){
echo json_encode(
array(
'code'  => 5,
'message' => 'project 5560: Your API has expired'
)
);

die();
}

// Check API key hasn't expired / 1 week
/* $d_generated = $q->fetch_assoc()['date_generated'];
$d_expires   = strtotime($d_generated . '+7 days');
$d_today     = strtotime($date);

if($d_today >= $d_expires){

// Set is_valid to false
$conn->query("UPDATE api_keys SET is_valid = 0 WHERE api_key = '$api_key'");

echo json_encode(
array(
'code'  => 4,
'message' => 'API key has expired.'
)
);

die();
}
*/

if($medium == 'telegram'){

// Get chat_id
$sql = "SELECT DISTINCT chat_id,Name FROM users WHERE application = '$application' AND target_group = '$target_group'";
$result = mysqli_query($conn, $sql);
if($result->num_rows != 0){
$chatid = array();
if (mysqli_num_rows($result) > 0) {
	while($row_numbers = mysqli_fetch_assoc($result)){
		$chatid[] = $row_numbers;
	}
}
foreach ($chatid as $number) {
if ($number['chat_id'] != ''){
echo json_encode(
array(
'Telegram' => $number['Name'] 
)
);
echo "<br>";
file_get_contents("https://api.telegram.org/bot5777772489:AAFXgG0yyxHKcDvdbklBFwnmRj3oG6JC47k/sendMessage?chat_id=" . $number['chat_id'] . "&text=" . urlencode($message));
usleep(250000);
}
}


};
};


?>



