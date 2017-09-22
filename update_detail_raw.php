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
  $id_stock = $_GET['id_stock'];
  $mat_id = $_GET['mat_id'];
  $count = $_GET['count'];
  $unit_id = $_GET['unit_id'];
  $sql = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES('$id_stock','$mat_id','-$count','$unit_id')";
  mysql_query($sql,$connect1);
  $insert = "INSERT INTO detail_raw (id_raw,mat_id,count,unit_id) VALUES('$id_raw','$mat_id','$count','$unit_id')";
  mysql_query($insert,$connect1);

  header("LOCATION:insert_raw.php?id_raw=$id_raw&id_stock=$id_stock&raw=$raw&date=$date");


 ?>
