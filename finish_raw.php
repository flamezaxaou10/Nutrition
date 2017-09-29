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
  $id_raw = $_GET["id_raw1"];
  $sql = "SELECT d.count,s.stock_id,d.mat_id,d.unit_id FROM detail_raw d JOIN stock_detail s ON d.mat_id = s.mat_id WHERE d.id_raw = '$id_raw' GROUP BY d.mat_id";
  $result = mysql_query($sql,$connect1);
  $n = 0;
  while ($row = mysql_fetch_array($result)) {
    $stock_id2 = $row['stock_id'];
    $mat_id2 = $row['mat_id'];
    $count2 = $row['count'];
    $unit_id2 = $row['unit_id'];
    $insert = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES ('$stock_id2','$mat_id2','$count2','$unit_id2')";
    mysql_query($insert,$connect1);
    $n++;
  }

  $sql = "DELETE FROM detail_raw WHERE id_raw = '$id_raw'";
  mysql_query($sql,$connect1);
  echo $n;
  for ($i=1; $i <= $n ; $i++) {
    if (isset($_GET["id_raw$i"])) {
      $id_raw = $_GET["id_raw$i"];
      $id_stock = $_GET["id_stock$i"];
      $mat_id = $_GET["mat_id$i"];
      $count = $_GET["count$i"];
      $unit_id = $_GET["unit_id$i"];


      $sql = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES('$id_stock','$mat_id','-$count','$unit_id')";
      mysql_query($sql,$connect1);

      $insert = "INSERT INTO detail_raw (id_raw,mat_id,count,unit_id) VALUES('$id_raw','$mat_id','$count','$unit_id')";
      mysql_query($insert,$connect1);
    }
  }
  header("LOCATION:raw.php");

 ?>
