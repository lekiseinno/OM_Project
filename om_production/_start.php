<?php 
    require_once '_process/connect.php';
    $machine_id = $_GET['machine_id'];
    $sql_time = "SELECT * FROM machine WHERE  id = '$machine_id'";
    $query_time = sqlsrv_query($connect, $sql_time) or die($sql_time);
    $row = sqlsrv_fetch_array($query_time,SQLSRV_FETCH_ASSOC);
    $machine_id = $row['id'];
    $machine_name = $row['machine_name'];

    
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>OM Planning</title>
	<meta charset="utf-8">
	<link href="Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="Assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="Assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="Assets/css/animate.css" rel="stylesheet">
    <link href="Assets/css/style.css" rel="stylesheet">

    <link href="Assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="Assets/css/plugins/select2/select2.min.css" rel="stylesheet">
    <style type="text/css">.display_none{display: none}</style>
</head>
<body style="font-size: 50px;font-weight: bold;background-color: #2f4050" onload="prod_order_no.focus()">
	<div class="container" align="center" ><br>
		<div class="main">
            <input type="hidden" name="machine_id" value="<?php echo $machine_id ?>" id="machine_id">
			<div style="color: white">ORDER START : <?php echo $machine_name ?></div>
            <div id="timer" style="color: yellow"></div>
			<input type="text" name="prod_order_no" class="form-control" style="font-size: 50px;margin-bottom: 10px" id="prod_order_no" >
			<button type="button" class="btn btn-lg btn-primary order_start" style="display: none">START</button>

		</div>
		<div class="icon-load" style="color: white;font-size:150px;display: none"><i  class="fa fa-spinner "></i></div>

		<div class="icon-success" style="display: none;font-size: 50px">
			<i class="fa fa-check-circle" style="color: #1ab394" ></i> 
			<font color="white">บันทึกสำเร็จ</font>
		</div>

		<div class="icon-false" style="display: none;font-size: 50px">
			<i class="fa fa-exclamation-circle" style="color: #ed5565"></i>
			<font color="white">บันทึกไม่สำเร็จ</font>
		</div>
        <div class="row">
            <div align="center" class="toporder col-md-6" style="margin-top: 10px"></div>
            <div align="center" class="toptime col-md-6" style="margin-top: 10px"></div>
        </div>
        
	</div>
    
</body>
</html>

	<script src="Assets/js/jquery-3.1.1.min.js"></script>
    <script src="Assets/js/popper.min.js"></script>
    <script src="Assets/js/bootstrap.js"></script>
    <script src="Assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="Assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="Assets/js/plugins/flot/jquery.flot.js"></script>
    <script src="Assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="Assets/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="Assets/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="Assets/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="Assets/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="Assets/js/plugins/flot/curvedLines.js"></script>

    <!-- Peity -->
    <script src="Assets/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="Assets/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="Assets/js/inspinia.js"></script>
    <script src="Assets/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="Assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="Assets/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="Assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Sparkline -->
    <script src="Assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="Assets/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="Assets/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Datatable -->
    <script src="Assets/js/plugins/dataTables/datatables.min.js"></script>
    <script src="Assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- Data picker -->
    <script src="Assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Select2 -->
    <script src="Assets/js/plugins/select2/select2.full.min.js"></script>


    <script type="text/javascript">

        var input = document.getElementById("prod_order_no");
        input.addEventListener("keyup", function(event) {
          if (event.keyCode === 13 ) {
           event.preventDefault();
           if($('#prod_order_no').val().length!=12){
                $('#prod_order_no').val('');
           }else{
                $(".order_start").click();
           }
           
          }
        });


        toporder();
        toptime();


    	$(".order_start").click(function(){

    		$('.icon-success').hide();
    		$('.icon-false').hide();

    		var prod_order_no = $('#prod_order_no').val();
            var machine_id = $('#machine_id').val();
    		$('.icon-load').show();

    		setTimeout(function(){
				$.ajax({
		            url: '_process/order_start.php',
		            type: 'POST',
		            dataType: 'TEXT',
		            async: false,
		            data: {prod_order_no:prod_order_no,machine_id:machine_id}
		        }).done(function(data) {
		        	data=parseInt(data)+0;
		        	if(data==1){
		        		$('.icon-load').hide();
		        		$('.icon-success').show();
                        setTimeout(function(){$('.icon-success').hide();},1000);
	
		        	}else{
		        		$('.icon-load').hide();
		        		$('.icon-false').show();
                        setTimeout(function(){$('.icon-success').hide();},1000);
		        	}
		        	$('#prod_order_no').val('');
		        	$('#prod_order_no').focus();

                    toptime();
                    toporder();
                    checkstart();
		        }); 
		    }, 1000);
		});


        $(function(){
            setInterval(function(){
                toporder();
                toptime();
                checkstart();
            },10000);    
        });


        



        function toptime(){
            var machine_id = $('#machine_id').val();
            $.ajax({
                    url: '_toptime.php',
                    type: 'POST',
                    dataType: 'TEXT',
                    async: false,
                    data: {machine_id:machine_id}
                }).done(function(data) {
                    $('.toptime').html(data);
                });
        }


        function toporder(){
            var machine_id = $('#machine_id').val();
            $.ajax({
                    url: '_toporder.php',
                    type: 'POST',
                    dataType: 'TEXT',
                    async: false,
                    data: {machine_id:machine_id,cate:'start'}
                }).done(function(data) {
                    $('.toporder').html(data);
                });
        }







        var micro = 0;
        var minutes = 0;
        var hours = 0;
        var timer_is_on=0;
        var pdr = '';



        function checkstart(){
            var machine_id = $('#machine_id').val();
            $.ajax({
                    url: '_checkstart.php',
                    type: 'POST',
                    dataType: 'TEXT',
                    async: false,
                    data: {machine_id:machine_id}
                }).done(function(data) {
                 
                    if(data!=''){
                        var obj = JSON.parse(data);   
                         micro = parseInt(obj.micro);
                         minutes = parseInt(obj.minutes);
                         hours = parseInt(obj.hours);
                         pdr = obj.prod_order_no;
                         $('#prod_order_no').addClass('display_none');
                         $('#timer').removeClass('display_none');
                         doTimer();
                    }else{
                        $('#prod_order_no').removeClass('display_none');
                        $('#timer').addClass('display_none');
                    }
                });
        }


        function timedCount(){
            var width = 2;
            var fill = 0;
            hours1 = pad(hours, width , fill);
            minutes1 = pad(minutes, width , fill);
            micro1 = pad(micro, width , fill);

            $("#timer").html(pdr+'<br>'+hours1+':'+ minutes1+':'+ micro1);
                micro=micro+1;
            if (micro%60==0){
                minutes+=1;
                micro=0;
            }
            if (minutes%60==0&&minutes!=0){
                hours+=1;
                minutes=0;
            }
            t=setTimeout("timedCount()",1000);
        }


        function doTimer(){
            if(!timer_is_on){
              timer_is_on=1;
              timedCount();
            }
        }

        function pad(n, width , fill) {
          n = n + '';
          return n.length >= width ? n : new Array(width - n.length + 1).join(fill) + n;
        }
       checkstart();
    </script>


<?php sqlsrv_close($connect) ?>

    