<!DOCTYPE html>
<html>
<head>
	<title>OM :: Planning :: Upload plan</title>

</head>
<body>
	<?php include("include/head.php"); ?>


	<div id="wrapper">

		<?php include("include/side_bar.php"); ?>
		<?php 
		require_once '_process/connect.php';
		$sql	=	"SELECT
						plan_log.*,machine.machine_name
					FROM
						[dbo].[planning_machine_log] AS plan_log
					LEFT JOIN dbo.machine ON plan_log.machine_id = machine.id ORDER BY id DESC";
		$query	=	sqlsrv_query($connect, $sql) or die($sql);
		?>

		<div id="page-wrapper" class="gray-bg">
			<?php include("include/top_nav.php"); ?>
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-10">
					<h2>OM Planning</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="index.php">Home</a>
						</li>
						<li class="breadcrumb-item active">
							<a href="_plan_upload.php">Plan Upload Log</a>
						</li>
					</ol>
				</div>  
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<table class="table table-bordered">
							<thead>
								<th>Date Upload</th>
								<th>Plan Date</th>
								<th>Machine</th>
								<th>Emp ID</th>
							</thead>
							<tbody>
			<?php while($row = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)) {  ?>
								<tr>
									<td><?php echo $row['date_up']->format('Y-m-d').' '.$row['time_up']->format('H:i:s');?></td>
									<td><?php echo $row['plan_date']->format('Y-m-d'); ?></td>
									<td><?php echo $row['machine_name'] ?></td>
									<td><?php echo $row['username'] ?></td>
									
								</tr>
			<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("include/footer.php"); ?>


</body>
</html>