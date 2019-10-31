<?php 

session_start();
session_destroy();
echo "<script>window.location.href='../om_auth/login_plan_pd.php'</script>";
?>