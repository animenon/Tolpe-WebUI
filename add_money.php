<?php
		$DB_host = "localhost";
		$DB_user = "root";
		$DB_pass = "";
		$DB_name = "tolls_data";

	$amount = $_GET['amount'];
	$user_id = $_GET["user_id"];


		$conn = new MySQLi($DB_host,$DB_user,$DB_pass,$DB_name);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}	

	$sql1 = "Select balance from user_table where email_id ='$user_id'";
	$balance = 0;
	$result = $conn->query($sql1);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
			$balance = $row['balance'];
		}
	}
	$balance = $balance + intval($amount);
	$sql = "UPDATE  user_table set balance ='".$balance."' where user_id='".$user_id."'";
	if ($conn->query($sql) === TRUE) {
		 
		echo "{status:true, balance:".$balance."}";
	} 

	$conn->close();
?>