<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['userSession'])!="")
{
 header("Location: home.php");
 exit;
}

if(isset($_POST['btn-login']))
{
	$email = $MySQLi_CON->real_escape_string(trim($_POST['user_email']));
	$upass = $MySQLi_CON->real_escape_string(trim($_POST['password']));

	$query = $MySQLi_CON->query("SELECT * FROM users WHERE email_id='$email'");
	$row=$query->fetch_array();
	$hash=password_hash($row['password'], PASSWORD_DEFAULT);

	if(password_verify($upass, $hash))
	{
	$_SESSION['userSession'] = $row['user_id'];
	header("Location: home.php");
	}
	else
	{
		$msg = "Email or Password does not exists !";
	}

	$MySQLi_CON->close();
	
}

	if(isset($_GET['thankyou'])){
		$msg = "Kindly login with your credentials..";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login | Easy Tolls</title>
	<style type="text/css">
		html {padding-top: 5rem;border: none;}
		.login {color: #666;}
		.login legend {font-family: 'Oswald', sans-serif;font-weight: lighter;font-size: 30px;padding: 0;color: #888;}
		.login .login-form {max-width: 330px;padding: 2rem;margin: 0 auto;}
		.login .form-group {margin: 0;margin-bottom: 2rem;padding: 0;}
		.login form {border: 1px solid #CEE1F1; border-radius: 4px}
	</style>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body style="background-image:url('http://www.w2skp.com/wp-content/uploads/2013/11/Toll_%C2%A9.jpg');background-repeat: no-repeat;background-size: cover;">
	<div class="container login">
		<form class="login-form form-horizontal" method="post" style="background: rgb(25, 25, 54);background: rgba(25, 25, 54, .3);color:#663300;">
			<?php
				  if(isset($msg)){
				     echo $msg;
				  }
			?>
			<fieldset>
				<legend>Dashboard</legend>
				<div class="form-group">
					<label for="user">Username</label>
					<input class="form-control" type="text" placeholder="Enter Email Address" name="user_email" required/>
					<br/>
					<label for="password">Password</label>
					<input class="form-control" type="password" placeholder="Enter Password" name="password" required/>
					<br/>
					<!--
					<label>
						<input type="checkbox" name="required">&nbsp;Remember Me
					</label>
					-->
				</div>
					<button type="submit" class="btn btn-lg btn-default btn-block"  name="btn-login"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Login</button>
					
			</fieldset>
					<br />
					<label for="btn-reg">Not a member yet?</label>
					<a href="register.php" class="btn btn-lg btn-default btn-block"  name="btn-reg">Register&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span></a>
		</form>
		
	</div>
</body>
</html>