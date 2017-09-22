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
    $sql = "SELECT d.count,s.stock_id,d.mat_id,d.unit_id FROM detail_raw d JOIN stock_detail s ON d.mat_id = s.mat_id WHERE d.id_raw = '$id_raw' GROUP BY d.mat_id";
    $result = mysql_query($sql,$connect1);
    while ($row = mysql_fetch_array($result)) {
      $stock_id = $row['stock_id'];
      $mat_id = $row['mat_id'];
      $count = $row['count'];
      $unit_id = $row['unit_id'];
      $insert = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES ('$stock_id','$mat_id','$count','$unit_id')";
      mysql_query($insert,$connect1);
    }

    $sql = "DELETE FROM raw_system WHERE id_raw = '$id_raw'";
    mysql_query($sql,$connect1);

    $sql = "DELETE FROM detail_raw WHERE id_raw = '$id_raw'";
    mysql_query($sql,$connect1);

    header("LOCATION:raw.php");
 ?>
