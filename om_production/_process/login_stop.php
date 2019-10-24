<?php 
session_start();

include("connect.php");

if($_POST['username']==$_POST['password']){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$machine_id = $_POST['machine_id'];
	$type = "stop";

	$sql = "INSERT INTO [dbo].[start_stop_login_log]
				           ([username]
				           ,[type]
				           ,[machine_id]
				           ,[date_log]
				           ,[time_log]
				           )
     				VALUES(
     						'$username'
     						,'$type'
     						,'$machine_id'
     						,GETDATE()
     						,GETDATE()
     						
     		)";


     $_SESSION['machine_id_stop']  = $machine_id;
     $_SESSION['username_stop']  = $username;

     $query = sqlsrv_query( $connect, $sql ) or die($sql);

	header("location:../_stop.php?machine_id=$machine_id");
}else{

	header("location:../_login_start.php");
}

 ?>
