<?php  session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/css/bootstrap.css">

	<script src="css/js/bootstrap.min.js"></script>
	<script src="css/js/jquery.min.js"></script>
	<script src="css/js/bootstrap.js"></script>
</head>
<body>
<?

 	  @include('conn.php');

 		$strSQL = "SELECT * FROM `sys_user` WHERE username = '".mysql_real_escape_string($_POST['username'])."' and password = '".mysql_real_escape_string($_POST['password'])."'";
 		$objQuery = mysql_query($strSQL,$connect1);
 		$objResult = mysql_fetch_array($objQuery);
 		if(!$objResult)
 		{
      echo "<script>
         $(document).ready(function() {
                 $('#myModal').modal('show');
         });
        </script>";
 		}
 		else
 		{
 			$_SESSION["Username"] = $objResult["username"];
      $_SESSION["fnname"] = $objResult["fname"];
      $_SESSION["lnname"] = $objResult["lname"];
 			session_write_close();
 			echo "<script>
         window.location.href='index.php';
        </script>";
 		}

	?>

<form action="log.php" method="post" >
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ผิดพลาด</h4>
      </div>
      <div class="modal-body">
        Username หรือ Password ผิดพลาด
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger btn-lg" href="javascript:history.back(1)" role="button">Close</a>
      </div>
    </div>
  </div>
</div>
</form>
	</body>
</html>
