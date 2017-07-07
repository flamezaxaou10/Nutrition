<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{


header('location:login.php');
exit();
}

?>
<?php
  $id_output = $_GET['idoutputmat'];
  $mat_id = $_GET['mat_id'];
  $count = $_GET['count'];
  $stock_id = $_GET['stock_id'];
  $unit_id = $_GET['unit_id'];
  $delete = "DELETE FROM detail_outputmat WHERE id_outputmat = '$id_output' AND mat_id = '$mat_id'";
  mysql_query($delete,$connect1);

  //update stock_detail
  $sql = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES ('$stock_id','$mat_id','$count','$unit_id');";
  mysql_query($sql,$connect1);

  header("LOCATION:out_to_stock_con.php?idoutputmat=$id_output");
 ?>
