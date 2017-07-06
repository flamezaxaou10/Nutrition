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
  $id_stock = $_GET['id_stock'];
  $mat_id = $_GET['mat_id'];
  $id_output = $_GET['idoutputmat'];
  $count = $_GET['count'];
  $unit_id = $_GET['unit_id'];
  $sql = "UPDATE SELECT * FROM stock_detail GROUP BY mat_id SET count = '$count' WHERE mat_id = '$mat_id'";
  mysql_query($sql,$connect1);
  $insert = "INSERT INTO detail_outputmat (id_outputmat,mat_id,count,unit_id) VALUES('$id_output','$mat_id','$count','$unit_id')";
  mysql_query($insert,$connect1);

  //header("LOCATION:out_to_stock.php?idoutputmat=$id_output&id_stock=$id_stock");
 ?>
