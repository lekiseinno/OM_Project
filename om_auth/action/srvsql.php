<?php
class srvsql
{
	public function connect_signin()
	{
		$serverName			=	"10.10.2.31";
		$connectionInfo		=	array(
										"Database"					=>	"LeKise_Group",
										"UID"						=>	"innovation_hr",
										"PWD"						=>	"Passw0rd@2018LeKise20i8",
										"MultipleActiveResultSets"	=>	true,
										"CharacterSet"				=>	'UTF-8',
										'ReturnDatesAsStrings'		=>	true
									);
		$connect_signin		=	sqlsrv_connect($serverName,$connectionInfo);
		if(!$connect_signin) {
			echo "<h1>Connection could not be established.</h1><hr><br />";
			die( '<pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		else
		{
			return	$connect_signin;
		}
	}

	public function connect_local()
	{
		$serverName			=	"localhost";
		$connectionInfo		=	array(
										"Database"					=>	"om_permission_authen",
										"UID"						=>	"innovation",
										"PWD"						=>	"Inno20i9",
										"MultipleActiveResultSets"	=>	true,
										"CharacterSet"				=>	'UTF-8',
										'ReturnDatesAsStrings'		=>	true
									);
		$connect_local		=	sqlsrv_connect($serverName,$connectionInfo);
		if(!$connect_local) {
			echo "<h1>Connection could not be established.</h1><hr><br />";
			die( '<pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		else
		{
			return	$connect_local;
		}
	}
}
?>

