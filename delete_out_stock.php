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
    $id_output = $_GET['id'];
    $sql = "SELECT d.count,s.stock_id,d.mat_id,d.unit_id FROM detail_outputmat d JOIN stock_detail s ON d.mat_id = s.mat_id WHERE d.id_outputmat = '$id_output' GROUP BY d.mat_id";
    $result = mysql_query($sql,$connect1);
    while ($row = mysql_fetch_array($result)) {
      $stock_id = $row['stock_id'];
      $mat_id = $row['mat_id'];
      $count = $row['count'];
      $unit_id = $row['unit_id'];
      $insert = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES ('$stock_id','$mat_id','$count','$unit_id')";
      mysql_query($insert,$connect1);
    }

    $sql = "DELETE FROM output_material WHERE id_outputmat = '$id_output'";
    mysql_query($sql,$connect1);

    $sql = "DELETE FROM detail_outputmat WHERE id_outputmat = '$id_output'";
    mysql_query($sql,$connect1);

    header("LOCATION:out_stock.php");
 ?>
