<?php require_once "_process/connect.php" ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<table border="1" align="center">
		<tr><th>machine</th><th>start</th><th>stop</th></tr>
	<?php 
		$sql = "SELECT * FROM machine ";
   		$query = sqlsrv_query($connect, $sql) or die($sql);

    	while ($row = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)) {
    		$machine_id = $row['id'];
    		$machine_name = $row['machine_name'];
    ?>
    	<tr>
    		<td><?php echo $machine_name ?></td>
    		<td><a target="_blank"  href="_login_start.php?machine_id=<?php echo $machine_id ?>">start</a></td>
    		<td><a target="_blank" href="_login_stop.php?machine_id=<?php echo $machine_id ?>">stop</a></td>
    	</tr>

    <?php
    	}
	 ?>

	</table>

</body>
</html>