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

$sql3 = "SELECT * FROM type_food where id_type = '".$_POST['food']."'"; 
$objQuery3 = mysql_query($sql3, $connect1);
$objReSult3 = mysql_fetch_array($objQuery3);

$sql = "INSERT into order_food (hn, fname, lname, eats, type_food, type_name, detail_food, clinic, dep_name, roomno, bedno, weight, height, date_order,type_order) values ('".$objReSult2['hn']."', '".$objReSult2['fname']."', '".$objReSult2['lname']."', '".$_POST['eats']."', '".$_POST['food']."', '".$objReSult3['type_name']."', '".$_POST['detail']."', '".$objReSult2['clinic']."', '".$objReSult2['clinicdescribe']."', '".$objReSult2['roomno']."', '".$objReSult2['bedno']."', '".$_POST['weight']."', '".$_POST['height']."', CURDATE() ,'3')";
echo $sql;
mysql_query($sql, $connect1);
echo "complete <BR>";
?>