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

    $sql = "DELETE FROM detail_sale_feed WHERE feed_id = '$feed_id' AND salefeed_id = '$salefeed_id'";
    mysql_query($sql,$connect1);
    header("LOCATION:sale_feed_con.php?salefeed_id=$salefeed_id");
 ?>
