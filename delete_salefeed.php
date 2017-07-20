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
    $sql = "DELETE FROM detail_sale_feed WHERE salefeed_id = '$salefeed_id'";
    mysql_query($sql,$connect1);
    $sql = "DELETE FROM sale_feed WHERE salefeed_id = '$salefeed_id'";
    mysql_query($sql,$connect1);
    header("LOCATION:sale_feed.php");
 ?>
