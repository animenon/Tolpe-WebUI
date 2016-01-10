<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: login.php");
}

$query = $MySQLi_CON->query("SELECT * FROM user_table WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$query = $MySQLi_CON->query("SELECT user_name FROM users WHERE user_id=".$_SESSION['userSession']);
$userName=$query->fetch_array();
$MySQLi_CON->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home|Easy Tolls</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
 
<body>
	<div style="position:relative;margin:20px;padding:10px;padding-left:30px;padding-right:40px;background-color:#6699FF;border-radius: 15px;">
		<H3 style="float:left;"><span>Hello <?php echo "$userName[0]"; ?>!</span></H3>
		<p style="float:right;"><button type="submit" class="btn btn-lg btn-default btn-block"  name="btn-login"><a href="logout.php?logout='bye'" style="text-decoration:none;"><span class="	glyphicon glyphicon-log-out"></span>Logout</a></button></p>
		<div style="clear: both;"></div>
	</div>
	
	<div style="position:relative;margin:20px;padding:5%;background-color:#6699FF;border-radius: 5px;height:400px;">
		<?php
			$DB_host = "localhost";
			$DB_user = "root";
			$DB_pass = "";
			$DB_name = "tolls_data";
			  
			  $MySQLi_CON = new MySQLi($DB_host,$DB_user,$DB_pass,$DB_name);
				
				 if($MySQLi_CON->connect_errno)
				 {
					 die("ERROR : -> ".$MySQLi_CON->connect_error);
				 }
			$query = $MySQLi_CON->query("SELECT * FROM user_table where user_id='".$_SESSION['userSession']."'");
			$userRow=$query->fetch_array();
		?>
<div class="dashboard">    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="list-group">
                    <div class="list-group-item active">
                        <div class="row">
                            <div class="col-sm-3">Name</div>
                            <div class="col-sm-3">Email</div>
                            <div class="col-sm-3">Phone Number</div>
                            <div class="col-sm-3">Balance</div>
                        </div>
                    </div>			
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-sm-3"><?php echo "$userName[0]"; ?></div>
                            <div class="col-sm-3"><?php echo "$userRow[3]";?></div>
							<div class="col-sm-3"><?php echo "$userRow[4]";?></div>
                            <div class="col-sm-3"><?php echo "$userRow[2]";?></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

		
	</div>
</body>
</html>