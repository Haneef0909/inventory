<!DOCTYPE html>
<html>
	<head>
		<title>PostgreSQL Database Connection Establisment</title>
	</head>
	<body>
		<form action="connection.php" method="POST">
			<label>Server Name</label><br><input type="text" name="server"> <br>
			<label>Port</label><br><input type="text" name="port"> <br>
			<label>Database Name</label><br><input type="text" name="database"> <br>
			
			<label >Select Mode</label><br>
			<input id = "r1" type="radio" name="authentication" value="wa" checked onchange="f1()"><label>Windows Authentication</label>
			<input id = "r2" type="radio" name="authentication" value="sa" onchange="f1()"><label>PostgreSQL Server Authentication</label> <br>
			
			<div id="jadoodiv" style="display: none;">
				<label>Username</label><br><input type="text" name="username"> <br>
				<label>Password</label><br><input type="text" name="password"> <br>
			</div>
			<button type="submit" name="submitbtn">Connect</button>
		</form>

		<script type="text/javascript">
			function f1(){
			if (document.getElementById("r2").checked == true)
				document.getElementById("jadoodiv").style.display = "block";
			else if (document.getElementById("r2").checked == false)
				document.getElementById("jadoodiv").style.display = "none";
			}
		</script>
	</body>
</html>

<?php
 
require '../vendor/autoload.php';
 
use inventory\Connection as Connection;

if(isset($_POST['submitbtn'])) {

    if($_POST['authentication'] == "sa")
        $connectionInfo = array( "server"=>$_POST['server'], "port"=>$_POST['port'], "database"=>$_POST['database'], "user"=>$_POST['username'], "password"=>$_POST['password'] );
    else if($_POST['authentication'] == "wa")
        $connectionInfo = array( "database"=>$_POST['database']);

    // build connection
    try {
        Connection::get()->connect();
		echo 'A connection to the PostgreSQL database sever has been established successfully.';
		header("Location:connection1.php");
  		exit();
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
}
?>