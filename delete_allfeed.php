<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
$id=$_GET['id'];
	include ('conn.php');


	$delete = "DELETE FROM buymeterial  WHERE id_mat='$id'";
	$query = mysql_query($delete,$connect1);
  echo( "<script> alert('ยกเลิกการสั่งวัตถุดิบ');
window.location='insert_feed.php';</script>");

?>
