<?php
	session_start();
	date_default_timezone_set('Asia/Bangkok');

	include_once 'srvsql.php';

	if(!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		$ips	=	$_SERVER['HTTP_CLIENT_IP'];
	}
	else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$ips	=	$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
		$ips	=	$_SERVER['REMOTE_ADDR'];
	}

	function getBrowser(){ 
		$u_agent	=	$_SERVER['HTTP_USER_AGENT']; 
		$bname		=	'Unknown';
		$platform	=	'Unknown';
		$version	=	"";

		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'Linux';
		}
		else if(preg_match('/macintosh|mac os x/i', $u_agent))
		{
			$platform = 'Mac';
		}
		else if(preg_match('/windows|win32/i', $u_agent))
		{
			$platform = 'Windows';
		}

		if(preg_match('/MSIE/i',$u_agent)) 
		{ 
			$bname	=	'Internet Explorer'; 
			$ub		=	"MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname	=	'Mozilla Firefox'; 
			$ub		=	"Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname	=	'Google Chrome'; 
			$ub		=	"Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname	=	'Apple Safari'; 
			$ub		=	"Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname	=	'Opera'; 
			$ub		=	"Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname	=	'Netscape'; 
			$ub		=	"Netscape"; 
		} 

		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches))
		{
		}

		$i	=	count($matches['browser']);
		if ($i != 1) {
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub))
			{
				$version= $matches['version'][0];
			}
			else
			{
				$version= $matches['version'][1];
			}
		}
		else
		{
			$version= $matches['version'][0];
		}

		if ($version==null || $version=="") {$version="?";}
		return array(
			'userAgent'	=>	$u_agent,
			'name'		=>	$bname,
			'version'	=>	$version,
			'platform'	=>	$platform,
			'pattern'	=>	$pattern
		);
	}

	$ua =	getBrowser();

	$iPod				=	stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$iPhone				=	stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$iPad				=	stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$Android			=	stripos($_SERVER['HTTP_USER_AGENT'],"Android");
	$win10				=	stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 10");
	$win81				=	stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 6.3");
	$win8				=	stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 6.2");
	$win7				=	stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 6.1");
	$winvista			=	stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 6.0");
	$winserv2003x64		=	stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 5.2");
	$winxpnt			=	stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 5.1");
	$winxp				=	stripos($_SERVER['HTTP_USER_AGENT'],"windows xp");
	$win2000			=	stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 5.0");
	$winme				=	stripos($_SERVER['HTTP_USER_AGENT'],"windows me");
	$win98				=	stripos($_SERVER['HTTP_USER_AGENT'],"win98");
	$win95				=	stripos($_SERVER['HTTP_USER_AGENT'],"win95");
	$win16				=	stripos($_SERVER['HTTP_USER_AGENT'],"win16");
	$macosx				=	stripos($_SERVER['HTTP_USER_AGENT'],"macintosh|mac os x");
	$macos9				=	stripos($_SERVER['HTTP_USER_AGENT'],"mac_powerpc");
	$linux				=	stripos($_SERVER['HTTP_USER_AGENT'],"linux");
	$ubuntu				=	stripos($_SERVER['HTTP_USER_AGENT'],"ubuntu");
	$blackberry			=	stripos($_SERVER['HTTP_USER_AGENT'],"blackberry");
	$webos				=	stripos($_SERVER['HTTP_USER_AGENT'],"webos");

	if($iPod)
	{
		$devices	=	'iPod';
	}
	else if($iPhone)
	{
		$devices	=	'iPhone';
	}
	else if($iPad)
	{
		$devices	=	'iPad';
	}
	else if($Android)
	{
		$devices	=	'Android';
	}
	else if($win10)
	{
		$devices	=	'Windows 10';
	}
	else if($win81)
	{
		$devices	=	'Windows 8.1';
	}
	else if($win8)
	{
		$devices	=	'Windows 8';
	}
	else if($win7)
	{
		$devices	=	'Windows 7';
	}
	else if($winvista)
	{
		$devices	=	'Windows Vista';
	}
	else if($winserv2003x64)
	{
		$devices	=	'Windows Server2003 or Windows XP x64';
	}
	else if($winxpnt)
	{
		$devices	=	'Windows (NT) XP';
	}
	else if($winxp)
	{
		$devices	=	'Windows XP';
	}
	else if($win2000)
	{
		$devices	=	'Windows 2000';
	}
	else if($winme)
	{
		$devices	=	'Windows ME';
	}
	else if($win98)
	{
		$devices	=	'Windows 98';
	}
	else if($win95)
	{
		$devices	=	'Windows 95';
	}
	else if($win16)
	{
		$devices	=	'Windows 3.11';
	}
	else if($macosx)
	{
		$devices	=	'Mac OS X';
	}
	else if($macos9)
	{
		$devices	=	'Mac OS 9';
	}
	else if($linux)
	{
		$devices	=	'Linux';
	}
	else if($ubuntu)
	{
		$devices	=	'Ubuntu';
	}
	else if($blackberry)
	{
		$devices	=	'Blackberry';
	}
	else if($webos)
	{
		$devices	=	'Webos';
	}
	else
	{
		$devices	=	'Other';
	}





$srvsql			=	new	srvsql();
$connect_signin	=	$srvsql->connect_signin();




$goto_planning		=	array("10600211","14450001","13500007","14600006");
$goto_production	=	array("10600114","13590228","14610010","13590228","14620034","14380001");



if(!empty($_POST['username']) and !empty($_POST['password']))
{
	$sql		=	"
					SELECT		*
					FROM		[LeKise_Group].[dbo].[Employees_login]
					INNER JOIN	[LeKise_Group].[dbo].[Employees]	ON	[LeKise_Group].[dbo].[Employees].[emp_code]	=	[LeKise_Group].[dbo].[Employees_login].[emp_code]
					WHERE		(
								[LeKise_Group].[dbo].[Employees_login].[emp_code]			=	'".$_POST['username']."'
								AND		
								[LeKise_Group].[dbo].[Employees_login].[emp_password]		=	'".md5($_POST['password'])."'
								)
					";
	$query		=	sqlsrv_query($connect_signin,$sql) or die( 'SQL Error = <hr>'.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
	$row		=	sqlsrv_fetch_array($query);
	$has		=	sqlsrv_has_rows($query);
	if($has	==	0)
	{
		$sql_manual		=	"
							SELECT		*
							FROM		[LeKise_Group].[dbo].[Employees_login]
							INNER JOIN	[LeKise_Group].[dbo].[Employees_manual]	ON	[LeKise_Group].[dbo].[Employees_manual].[emp_code]	=	[LeKise_Group].[dbo].[Employees_login].[emp_code]
							WHERE		(
										[LeKise_Group].[dbo].[Employees_login].[emp_code]			=	'".$_POST['username']."'
										AND		
										[LeKise_Group].[dbo].[Employees_login].[emp_password]		=	'".md5($_POST['password'])."'
										)
							";
		$query_manual	=	sqlsrv_query($connect_signin,$sql_manual) or die( 'SQL Error = <hr>'.$sql_manual.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		$row_manual		=	sqlsrv_fetch_array($query_manual);
		$has_manual		=	sqlsrv_has_rows($query_manual);

		if($has_manual	==	0)
		{
			$sql_log	=	"
							INSERT INTO	[LeKise_Group].[dbo].[log_login]	VALUES
							(
								'".$_POST['username']."',
								'".date('Y-m-d')."',
								'".date('H:i:s')."',
								'".$ua['platform']."',
								'".$devices."',
								'Webapp',
								'".$ua['name']."',
								'".$ua['version']."',
								'om_auth/login_plan_pd',
								'".$ips."',
								'Lost Password'
							);
							";
			$query_log		=	sqlsrv_query($connect_signin,$sql_log) or die( 'SQL Error = <hr>'.$sql_log.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			echo "<script>alert('ตรวจสอบ Username หรือ Password');window.history.back();</script>";
		}
		else
		{
			$_SESSION['emp_id']				=	$row_manual['emp_id'];
			$_SESSION['emp_code']			=	$row_manual['emp_code'];
			$_SESSION['company_Code']		=	$row_manual['company_code'];
			$_SESSION['division_Code']		=	$row_manual['division_code'];
			$_SESSION['department_Code']	=	$row_manual['department_code'];
			$_SESSION['section_Code']		=	$row_manual['section_code'];
			$_SESSION['position_Code']		=	$row_manual['position_code'];
			$_SESSION['emp_TName_TH']		=	$row_manual['emp_TName_TH'];
			$_SESSION['emp_FName_TH']		=	$row_manual['emp_FName_TH'];
			$_SESSION['emp_LName_TH']		=	$row_manual['emp_LName_TH'];
			$_SESSION['emp_TName_EN']		=	$row_manual['emp_TName_EN'];
			$_SESSION['emp_FName_EN']		=	$row_manual['emp_FName_EN'];
			$_SESSION['emp_LName_EN']		=	$row_manual['emp_LName_EN'];

			$sql_log		=	"
								INSERT INTO	[LeKise_Group].[dbo].[log_login]	VALUES
								(
									'".$_POST['username']."',
									'".date('Y-m-d')."',
									'".date('H:i:s')."',
									'".$ua['platform']."',
									'".$devices."',
									'Webapp',
									'".$ua['name']."',
									'".$ua['version']."',
									'om_auth/login_plan_pd',
									'".$ips."',
									'Login Success'
								)
								";
			$query_log		=	sqlsrv_query($connect_signin,$sql_log)		or die( 'SQL Error = <hr>'.$sql_log.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
			
			if(in_array($_SESSION['emp_code'], $goto_planning))
			{
				$redirect	=	"window.location.href='../../om_planning'";
			}
			else
			if(in_array($_SESSION['emp_code'], $goto_production))
			{
				$redirect	=	"window.location.href='../../om_production'";
			}
			echo "<script>alert('ยินดีต้อนรับ ".$row['emp_TName_TH']."  ".$row['emp_FName_TH']."  ".$row['emp_LName_TH']." เข้าสู่ระบบ ');".$redirect."</script>";

			echo "<script>alert('ยินดีต้อนรับ ".$row['emp_TName_TH']."  ".$row['emp_FName_TH']."  ".$row['emp_LName_TH']." เข้าสู่ระบบ ');window.location.href='../index.php'</script>";
		}
	}
	else
	{
		$_SESSION['emp_id']				=	$row['emp_id'];
		$_SESSION['emp_code']			=	$row['emp_code'];
		$_SESSION['company_Code']		=	$row['company_code'];
		$_SESSION['division_Code']		=	$row['division_code'];
		$_SESSION['department_Code']	=	$row['department_code'];
		$_SESSION['section_Code']		=	$row['section_code'];
		$_SESSION['position_Code']		=	$row['position_code'];
		$_SESSION['emp_TName_TH']		=	$row['emp_TName_TH'];
		$_SESSION['emp_FName_TH']		=	$row['emp_FName_TH'];
		$_SESSION['emp_LName_TH']		=	$row['emp_LName_TH'];
		$_SESSION['emp_TName_EN']		=	$row['emp_TName_EN'];
		$_SESSION['emp_FName_EN']		=	$row['emp_FName_EN'];
		$_SESSION['emp_LName_EN']		=	$row['emp_LName_EN'];

		$sql_log		=	"
							INSERT INTO	[LeKise_Group].[dbo].[log_login]	VALUES
							(
								'".$_POST['username']."',
								'".date('Y-m-d')."',
								'".date('H:i:s')."',
								'".$ua['platform']."',
								'".$devices."',
								'Webapp',
								'".$ua['name']."',
								'".$ua['version']."',
								'om_auth/login_plan_pd',
								'".$ips."',
								'Login Success'
							)
							";
		$query_log		=	sqlsrv_query($connect_signin,$sql_log)		or die( 'SQL Error = <hr>'.$sql_log.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
		
		if(in_array($_SESSION['emp_code'], $goto_planning))
		{
			$redirect	=	"window.location.href='../../om_planning'";
		}
		else
		if(in_array($_SESSION['emp_code'], $goto_production))
		{
			$redirect	=	"window.location.href='../../om_production'";
		}
		echo "<script>alert('ยินดีต้อนรับ ".$row['emp_TName_TH']."  ".$row['emp_FName_TH']."  ".$row['emp_LName_TH']." เข้าสู่ระบบ ');".$redirect."</script>";
	}
}
else
{
	echo "<script>alert('กรุณาใส่ให้ครบทุกช่อง');window.history.back();</script>";
}
?>