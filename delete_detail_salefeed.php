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
    $feed_id = $_GET['feed_id'];
    $salefeed_id = $_GET['salefeed_id'];
    $sel = "SELECT * FROM detail_sale_feed WHERE salefeed_id = '$salefeed_id' AND feed_id = '$feed_id'";
    $res = mysql_query($sel,$connect1);
    while ($row = mysql_fetch_array($res)) {
      $count = $row['count'];
      $unit_id = $row['unit_id'];
      $sql = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES ('MT-06','$feed_id','$count','$unit_id')";
      mysql_query($sql,$connect1);
    }
    $sql = "DELETE FROM detail_sale_feed WHERE feed_id = '$feed_id' AND salefeed_id = '$salefeed_id'";
    mysql_query($sql,$connect1);
    header("LOCATION:sale_feed_con.php?salefeed_id=$salefeed_id");
 ?>
