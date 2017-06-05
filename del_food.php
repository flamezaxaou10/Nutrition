<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
	 $strSQL = "DELETE FROM order_normal";
$objQuery = mysql_query($strSQL, $connect1);
	 $strSQL2 = "DELETE FROM order_diss";
$objQuery2 = mysql_query($strSQL2, $connect1);
	 $strSQL3 = "DELETE FROM order_spec";
$objQuery3 = mysql_query($strSQL3, $connect1);
header("location:report.php");
?>