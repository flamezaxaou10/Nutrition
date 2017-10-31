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
  $salefeed_id = $_GET['salefeed_id'];
  $feed_id = $_GET['feed_id'];
  $count = $_GET['count'];
  $unit_id = $_GET['unit_id'];
  $stock_id = $_GET['stock_id'];
    $delete = "DELETE FROM detail_sale_feed WHERE salefeed_id = '$salefeed_id' AND feed_id = '$feed_id'";
    mysql_query($delete,$connect1);

    //update stock_detail
    $sql = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES ('$stock_id','$feed_id','$count','$unit_id');";
    mysql_query($sql,$connect1);
    header("LOCATION:sale_feed_con.php?salefeed_id=$salefeed_id");

 ?>
