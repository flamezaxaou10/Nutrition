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
    $eats = $_GET['eats'];
    $hn = $_GET['hn'];
    date_default_timezone_set("Asia/Bangkok");
    $d=strtotime("tomorrow");
    $todate = date("Y-m-d",$d);
    $sql = "DELETE FROM order_food WHERE HN = '$hn' AND eats='$eats' AND date_order = '$todate'";
    mysql_query($sql,$connect1);
 ?>
