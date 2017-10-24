<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{


header('location:login.php');
exit();
}
$username=$_SESSION["Username"];

?>
<?php
  $id_output = $_GET['id_output'];
  $sql = "SELECT * FROM detail_outputmat WHERE id_outputmat = '$id_output'";
  $query = mysql_query($sql,$connect1);
  $num = mysql_num_rows($query);
  if ($num > 0){
    header("LOCATION:out_stock.php");
  }
  else {
    header("LOCATION:delete_out_stock.php?idoutputmat=$id_output");
  }
 ?>
