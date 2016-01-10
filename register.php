<?php
include_once 'dbconnect.php';

if(isset($_POST['btn-login']))
{
	 $email = $MySQLi_CON->real_escape_string(trim($_POST['user_email']));
	 $upass = $MySQLi_CON->real_escape_string(trim($_POST['password1']));
	 $upass1 = $MySQLi_CON->real_escape_string(trim($_POST['password2']));
	 $uname = $MySQLi_CON->real_escape_string(trim($_POST['username']));
	 $phone = $MySQLi_CON->real_escape_string(trim($_POST['phone']));
	 
	 $query = $MySQLi_CON->query("SELECT * FROM users WHERE email_id='$email'");
	 
	 if($query->num_rows>0){
		 $msg = "This email address is already registered!";
	 }
	 else
	 {
		 if($upass != $upass1){
			 $msg = "Passwords don't match";
		}
		else{
			$sql=("INSERT into users(email_id,password,user_name) values('$email','$upass','$uname')");
			$sql1=("INSERT into user_table(email_id,phone) values('$email','$phone')");
			
			if ((($MySQLi_CON->query($sql)) and ($MySQLi_CON->query($sql1))) === TRUE) {
				$ui=$MySQLi_CON->query("SELECT user_id from users where email_id='$email'");
				$uiArr=$ui->fetch_array();
				$res=$MySQLi_CON->query("UPDATE user_table SET user_id='$uiArr[0]' WHERE email_id='$email'");
				header("Location: login.php?thankyou=1");
			}
			else {
				echo "Error: " . $sql . "<br>" . $MySQLi_CON->error;
			}
		}
	 }
	 
	 
	
	$MySQLi_CON->close();
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login | Easy Tolls</title>
	<style type="text/css">
		html {padding-top: 2rem;border: none;}
		.login {color: #666;}
		.login legend {font-family: 'Oswald', sans-serif;font-weight: lighter;font-size: 30px;padding: 0;color: #888;}
		.login .login-form {max-width: 330px;padding: 2rem;margin: 0 auto;}
		.login .form-group {margin: 0;margin-bottom: 2rem;padding: 0;}
		.login form {border: 1px solid #CEE1F1; border-radius: 4px}
	</style>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body style="background-image:url('http://www.trbimg.com/img-5464d33d/turbine/bs-md-toll-violators-20141113');background-repeat: no-repeat;background-size: cover;">
	<div class="container login">
		<form class="login-form form-horizontal" method="post" style="background: rgb(25, 25, 54);background: rgba(25, 25, 54, .3);color:#663300;">
			<?php
				  if(isset($msg)){
				     echo $msg;
				  }
			?>
			<fieldset>
				<legend>Register</legend>
				<div class="form-group">
					<label for="username">Username :</label>
					<input class="form-control" type="text" placeholder="Username" name="username" required/>
					<br/>
					<label for="user_email">Email Address :</label>
					<input class="form-control" type="text" placeholder="Email Address" name="user_email" required/>
					<br/>
					<label for="phone">Mobile Number :</label>
					<input class="form-control" type="text" placeholder="Mobile number" name="phone" required/>
					<br/>
					<label for="password1">Password :</label>
					<input class="form-control" type="password" placeholder="Password" name="password1" required/>
					<br/>
					<label for="password2">Repeat Password :</label>
					<input class="form-control" type="password" placeholder="Password" name="password2" required/>
					<br/>
					
				</div>
					<button type="submit" class="btn btn-lg btn-default btn-block"  name="btn-login"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;Register</button>
					
			</fieldset>
					<br />
					<label for="btn-reg">Already a member?</label>
					<a href="register.php" class="btn btn-lg btn-default btn-block"  name="btn-reg">Login&nbsp;&nbsp;<span class="glyphicon glyphicon-log-in"></span></a>
		</form>
		
	</div>
</body>
</html>