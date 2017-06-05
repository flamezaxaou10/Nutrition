<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
	include ('conn.php');
	$delete_product = "DELETE FROM typestore WHERE type_id='".$_GET['id']."'";
	$query = mysql_query($delete_product,$connect1);
	if(!$query){

		echo( "<script> alert('ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลถูกใช้งานอยู่');
		  window.location='typestore.php';</script>");
	

	}else{
	echo( "<script> alert('ลบข้อมูลเรียบร้อย');
		  window.location='typestore.php';</script>");
}
?>