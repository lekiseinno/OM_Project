<?php include("include/head.php"); ?>
<style type="text/css">
	th,td{text-align: center}
	#show_tbody_time td input{width: 100px;}
	.prodtxt-color{ color: black !important}

	}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<body>

    <div id="wrapper">

<?php include("include/side_bar.php"); ?>
<?php 
	require_once '_process/connect.php';
    $sql = "SELECT * FROM  machine ";
    $query = sqlsrv_query($connect, $sql) or die($sql);
   
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
	                        <a href="_plan_upload.php">Losstime input</a>
	                    </li>
	                </ol>
	            </div>  
	        </div>
	        <div class="wrapper wrapper-content animated fadeInRight">
	        	<div class="row">
	                <div class="col-lg-12">
	                    <div class="ibox ">
	                        <div class="ibox-content">
	                        	<form id="form_filter_table_losstime">	                        	
		                        	<div class="row">
		                        		<div class="col-4">
		                        			<span>Plan Date :</span>
											<input type="date" class="form-control input-lg" name="plan_date" id="plan_date" value="<?php echo date('Y-m-d') ?>">
		                        		</div>
		                        		<div class="col-4">
		                        			<span>Machine :</span>
											<select name="machine_id" class="form-control input-lg" id="machine">
									<?php while ($row = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)) { ?>
										<option value="<?php echo $row['id']?>"><?php echo $row['machine_name']?></option>
							<?php } ?>
											</select>
		                        		</div>
		                        		<div class="col-4"><br><button type="button" class="btn btn-lg btn-success" onclick="filter_table_losstime()">Filter</button></div>
		                        	</div>
	                        	</form><hr>
	                        	<form id="lostime-form">
	                        	<div class="table-responsive">
		                        	<table class="table table-bordered table-hover table-striped">
	                        			<thead>
	                        				<tr>
	                        					<th>order_no</th>
	                        					<!--<th>planning start</th>
	                        					<th>planning stop</th>
	                        					<th>machine start</th>
	                        					<th>machine stop</th>
	                        					<th>cons</th>
	                        					<th>output</th>-->
	                        					<th>losstime</th>
	                        					<th>action</th>
	                        				</tr>
	                        			</thead>
	                        			<tbody id="show_tbody_time"></tbody>
									</table>
								</div>
								<input type="hidden" name="count" class="count" value="0">
								</form>
	                        </div>
	                    </div>
	                </div>
	            </div>
			</div>
		</div>

		
		<div class="modal fade" id="modal-losstime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Losstime : <span class="prod_order_no"></span></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body losstime">

					</div>
				</div>
			</div>
		</div>

<?php include("include/footer.php"); ?>



<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->


<script type="text/javascript">
	$('.custom-file-input').on('change', function() {
	   let fileName = $(this).val().split('\\').pop();
	   $(this).next('.custom-file-label').addClass("selected").html(fileName);
	}); 


	function filter_table_losstime(){
		$.ajax({
            url: '_tbody_time.php',
            type: 'POST',
            dataType: 'TEXT',
            async: false,
            data: $("#form_filter_table_losstime").serialize()
        }).done(function(data) {
        	$('#show_tbody_time').html(data);
        }); 
	}	


	function show_sheets(value){
		var formData = new FormData($("#form_plan_upload")[0]);
		$.ajax({
            url: '_process/show_sheets.php',
            type: 'POST',
            dataType: 'TEXT',
            cache: false,
	        contentType: false,
	        processData: false,
            async: false,
            data: formData
        }).done(function(data) {
        	$('.show_sheets').html(data);
        }); 
	}

	function modal_losstime(planning_id,prod_order_no){
		$('#modal-losstime').modal('show');
		$('.prod_order_no').text(prod_order_no);
		$.ajax({
            url: '_modal_losstime.php',
            type: 'POST',
            dataType: 'TEXT',
            async: false,
            data: {planning_id:planning_id}
        }).done(function(data) {
        	$('.losstime').html(data);	
        }); 
	}


	function losstime_insert(planning_id,prod_order_no){

		$.ajax({
            url: '_process/losstime_insert.php',
            type: 'POST',
            dataType: 'TEXT',
            async: false,
            data: $(".losstime_insert").serialize()
        }).done(function(data) {
        	$('#modal-losstime').modal('hide');
        	filter_table_losstime();   	
        }); 
	}



	function	row_losstime_add(){
		$.ajax({
            url: '_row_losstime_add.php',
            type: 'POST',
            dataType: 'TEXT',
            async: false,
            data: {val:1}
        }).done(function(data) {
        	$(data).insertBefore(".tr-before");
        }); 
	}

	


</script>

