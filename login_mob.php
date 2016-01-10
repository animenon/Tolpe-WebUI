<?php
		$DB_host = "localhost";
		$DB_user = "root";
		$DB_pass = "";
		$DB_name = "tolls_data";

		$uname = $_GET['user_id'];
		$password = $_GET["pass"];


  
		$conn = new MySQLi($DB_host,$DB_user,$DB_pass,$DB_name);
			
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}	

		$query = $conn->query("SELECT * FROM users WHERE email_id='$uname'");
		$row=$query->fetch_array();
		$hash=password_hash($row['password'], PASSWORD_DEFAULT);

		if(password_verify($password, $hash))
		{
			echo "{status:true}";
		}
		else
		{
			echo "{status:false}";
		}

		
	$conn->close();
?>