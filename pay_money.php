<?php
		$DB_host = "localhost";
		$DB_user = "root";
		$DB_pass = "";
		$DB_name = "tolls_data";

		$conn = new MySQLi($DB_host,$DB_user,$DB_pass,$DB_name);
	$amount = $_GET['amount'];
	$user_id = $_GET["user_id"];
	$type = $_GET["ride_type"];
	$toll_id = $_GET["toll_id"];

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
	$amountNum = intval($amount);

	if($amountNum > $balance){
		echo "{status:false, reason:low_balance}";
	}
	else{
		$dateNow = date("d:m:Y H:i");
		$sql = "INSERT into tolls(toll_id,user_id,payment,ways,time) values('".$toll_id."', '".$user_id."',' ".$amountNum."', '".$type."','".$dateNow."')";
		if ($conn->query($sql) === TRUE) {	 
			$balance = $balance - $amountNum;
			$sql = "UPDATE user_table set balance='".$balance."' where user_id='" .$user_id."'";
			if ($conn->query($sql) === TRUE) {	 
				echo "{status:true, balance:".$balance."}";
			} 
			else{
				echo $conn->error;
			}
		} 
		else{
			echo $conn->error;
		}	
	}
		

	// $sql = "INSERT INTO doctor(name, ph, loc, spec)
	// VALUES ('".$name."', '".$ph."',' ".$loc."', '".$spec."')";

	// if ($conn->query($sql) === TRUE) {
		 
	//     echo "{'id': ".mysqli_insert_id($conn)."}";
	// } 

	$conn->close();
?>