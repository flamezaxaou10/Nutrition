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
$id_raw = $_GET['id_raw'];
$raw = $_GET['raw'];
$date = $_GET['date'];
$mat_id = $_GET['mat_id'];
$count = $_GET['count'];
$unit_id = $_GET['unit_id'];
$stock_id = $_GET['stock_id'];
$delete = "DELETE FROM detail_raw WHERE id_raw = '$id_raw' AND mat_id = '$mat_id'";
  mysql_query($delete,$connect1);

  //update stock_detail
  $sql = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES ('$stock_id','$mat_id','$count','$unit_id');";
  mysql_query($sql,$connect1);

  header("LOCATION:insert_raw.php?id_raw=$id_raw&id_stock=$id_stock&raw=$raw&date=$date&id_stock=$stock_id");
 ?>
