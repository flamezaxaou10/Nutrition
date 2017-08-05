<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}

$submit = $_POST['submit'];
$sql2 = "SELECT * FROM fpatient_info where hn = '".$_POST["hn"]."'";
$objQuery2 = mysql_query($sql2, $connect2);
$objReSult2 = mysql_fetch_array($objQuery2);

// $sql3 = "SELECT * FROM type_food where id_type = '".$_POST['food']."'";
// $objQuery3 = mysql_query($sql3, $connect1);
// $objReSult3 = mysql_fetch_array($objQuery3);

date_default_timezone_set("Asia/Bangkok");
$d=strtotime("tomorrow");
$date = date("Y-m-d",$d);
$hn = $_POST["hn"];
$fname = $objReSult2['fname'];
$lname = $objReSult2['lname'];
$eats = $_POST['eats2'];
$type_food = $_POST['food'];
//$type_name = $objReSult3['type_name'];
//$detail = $_POST['detail'];
$clinic = $objReSult2['clinic'];
$dep_name = $objReSult2['clinicdescribe'];
$roomno = $_POST['roomno'];
$bedno = $_POST['bedno'];
$weight = $objReSult2['weight'];
$height = $objReSult2['height'];
$eats = $_GET['eats'];
$hn = $_GET['hn'];
date_default_timezone_set("Asia/Bangkok");
$d=strtotime("tomorrow");
$todate = date("Y-m-d",$d);
$sql = "DELETE FROM order_food WHERE HN = '$hn' AND eats='$eats' AND date_order = '$todate'";
mysql_query($sql,$connect1);
$sql = "INSERT into order_food (hn, fname, lname, eats, type_food, clinic, dep_name, roomno, bedno, weight, height, date_order,type_order) values ('$hn','$fname','$lname','$eats','$type_food','$clinic','$dep_name','$roomno','$bedno','$weight','$height','$date','3')";
echo $sql;
mysql_query($sql, $connect1);
echo "complete <BR>";
?>
