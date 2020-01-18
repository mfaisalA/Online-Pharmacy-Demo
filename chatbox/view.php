<style>
p{
border-top: 1px solid #EEEEEE;
margin-top: 0px; margin-bottom: 5px; padding-top: 5px;
}
</style>
<?php
session_start();
require_once 'connection.php';
if(isset($_SESSION['admin_id']) && ($_SESSION['admin_id'] == 'Admin')){
	$username = 'Admin';
}else{
	$username = $_SESSION['username'];
}

$sql = "SELECT * FROM user_chat_messages where username='$username' OR recipient='$username' ORDER BY message_time";
$qry = $con->prepare($sql);
$qry->execute();
$fetch = $qry->fetchAll();
foreach ($fetch as $row):

	$time = date("Y-m-d",strtotime($row['message_time']));
	$now = date("Y-m-d");
	if (($row['username'] == $username) && ($time == $now)) {
		$user = '<strong style="color:green;">'.$row['username'].'</strong>'.'-->'.$row['recipient']; 
	}else{
		$user = '<strong style="color:blue;">'.$row['username'].'</strong>'; 			
	}	
	if ($time == $now) {
		$hourAndMinutes = date("h:i A", strtotime($row['message_time']));
	}else{
		$hourAndMinutes = date("Y-m-d", strtotime($row['message_time']));
	}
	echo '<p>'.$user.':<em>('.$hourAndMinutes.')</em>'.'<br/>'.' '.'<img src="Images/img2/spechbubble_sq_line.png" width="10" height="10">'.' '. $row['message_content']. '</p>';

endforeach; 

?>