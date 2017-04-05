<?php 

require ("../../assets/config.php");


$jsonData = array();
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$pro_id = isset($_GET['pro_id']) ? $_GET['pro_id'] : '';


	
	$dbusername= DB_USER;
	$dbpassword= DB_PASSWORD;
	$servername = DB_HOST;
	$dbname = DB_NAME;

	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	
	if($pro_id)
	{
		$sql = "SELECT user_id FROM users WHERE fire_user_id='$pro_id'";
		$result = $conn->query($sql);
		
		while ($row = $result->fetch_assoc()) {
			$user_id = $row['user_id'];
			
		}
	}
	
	 $sql = "SELECT username, profile_image FROM users WHERE user_id='$user_id'";
	$result = $conn->query($sql);
	
	$x = 0;
	while ($row = $result->fetch_assoc()) {
		
		
		$jsonData[$x]=json_encode($row);
		$x++;
	}
	$outputArr['AppData']=$jsonData;
	echo json_encode($outputArr);
	$conn->close();
	exit();
?>
