<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
	include ('conn.php');
	$delete_product = "DELETE FROM unit WHERE unit_id='".$_GET['id']."'";
	echo $delete_product; 
	$query = mysql_query($delete_product,$connect1);
	echo( "<script> alert('ลบข้อมูลเรียบร้อย');
		  window.location='unit.php';</script>");

	if(!$delete_product){
	echo( "<script> alert('ไม่สามารถลบข้อมูลได้ เกิดข้อผิิดพลาดบางประการ');
		  window.location='unit.php';</script>");
}
?>