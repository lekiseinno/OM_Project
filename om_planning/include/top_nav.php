<?php //session_start(); ?>
<div class="row border-bottom">
	<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
			<form role="search" class="navbar-form-custom" action="search_results.html">
				<div class="form-group">
					<input type="text" placeholder="Search for Date Report..." class="form-control" name="top-search" id="top-search">
				</div>
			</form>
		</div>
		<ul class="nav navbar-top-links navbar-right">
			<li>
				<span class="m-r-sm text-muted welcome-message">Welcome <?php echo $_SESSION['emp_TName_TH'].' '.$_SESSION['emp_FName_TH'].' '.$_SESSION['emp_LName_TH']; ?> To OM Planning.</span>
			</li>
			<li>
				<a href="logout.php">
					<i class="fa fa-sign-out"></i> Log out
				</a>
			</li>
		</ul>
	</nav>
</div>