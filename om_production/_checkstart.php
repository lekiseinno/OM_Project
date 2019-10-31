<?php 
	require_once '_process/connect.php';
	$machine_id = $_POST['machine_id'];
	$arr = array();
	$sql_pdr = "SELECT prod_order_no,order_start_time FROM orderStartStopTime WHERE  machine_id = '$machine_id' AND order_end_time is null";
    $query_pdr = sqlsrv_query($connect, $sql_pdr) or die($sql_pdr);
    $row_pdr = sqlsrv_fetch_array($query_pdr,SQLSRV_FETCH_ASSOC);
    
    $now = strtotime(date('Y-m-d H:i:s'));

    if($row_pdr['prod_order_no']!=''){
		$arr['prod_order_no'] = $row_pdr['prod_order_no'];
	    $time =$now - strtotime($row_pdr['order_start_time']->format('Y-m-d H:i:s'));

	    $hours = floor($time/(60*60));
		$minutes = floor((($time%(60*60))/60));
		$micro = $time%60;

		$arr['hours'] = $hours;
		$arr['minutes'] = $minutes;
		$arr['micro'] = $micro;

		$myJSON = json_encode($arr);
	}else{
		$myJSON='';
	}


	echo $myJSON;
 


 ?>
