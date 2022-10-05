<?php
include_once('config.php');
$conn = mysqli_connect($mysqlhost, $user, $password, 'project');
// Fetching all numbers whos Chat id isnt updated
$sql = "SELECT DISTINCT Name,Phone FROM users WHERE chat_id is NULL";
//
$result = mysqli_query($conn, $sql);

$phne = array();
if (mysqli_num_rows($result) > 0) {
	while($row_numbers = mysqli_fetch_assoc($result)){
		$phone[] = $row_numbers;
	}
};
if (mysqli_num_rows($result) > 0) {
foreach ($phone as $number) {

sleep(2);
$update=json_decode(file_get_contents("https://api.telegram.org/bot5777772489:AAFXgG0yyxHKcDvdbklBFwnmRj3oG6JC47k/sendContact?chat_id=191650344&phone_number=" . $number['Phone'] . "&first_name=" . $number['Name']), TRUE);

$user_id=$update["result"]["contact"]["user_id"]; 


$message_id=$update["result"]["message_id"];


if($user_id != "") {
$sqlupdate="UPDATE `users` SET `chat_id`='" . $user_id . "'  WHERE `Phone`=" . $number['Phone'];
mysqli_query($conn, $sqlupdate);
echo "Chat id found as ". $user_id ." for username " . $number['Name'] . ", "  . $number['Phone']. "...Updating database.........." . PHP_EOL;
echo "<br>";
} else {
echo $number['Name'] . "," .$number['Phone'] .  " has not opted in" . PHP_EOL;
};
};
};

?>
