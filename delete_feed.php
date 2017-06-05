<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
$id=$_GET['id'];
$id2=$_GET['id2'];
	include ('conn.php');
	$delete_product = "DELETE FROM detail_buymat WHERE id_detail='$id'";
	$query = mysql_query($delete_product,$connect1);
	echo( "<script> alert('ลบข้อมูลเรียบร้อย');
		  window.location='select_feed.php?id=$id2';</script>");

	if(!$delete_product){
	echo( "<script> alert('ไม่สามารถลบข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
		  window.location='select_feed.php';</script>");
}
?>
