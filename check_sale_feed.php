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
  $salefeed_id = $_GET['salefeed_id'];
  $sql = "SELECT * FROM detail_sale_feed WHERE salefeed_id = '$salefeed_id'";
  $query = mysql_query($sql,$connect1);
  $num = mysql_num_rows($query);
  if ($num > 0){
    header("LOCATION:sale_feed.php");
  }
  else {
    header("LOCATION:delete_salefeed.php?salefeed_id=$salefeed_id");
  }
 ?>
