<?php
  include ('conn.php');
  session_start();
  if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
  {
  header('location:login.php');
  exit();
  }
  include "conn.php";
  $ID = $_GET['id'];
  $sql = "DELETE FROM input_material WHERE id_inputmat = '$ID'";
  $objQuery = mysql_query($sql,$connect1);

  $sql = "DELETE FROM detail_inputmat WHERE id_inputmat = '$ID'";
  $objQuery = mysql_query($sql,$connect1);

  echo( "<script> alert('ลบข้อมูลเรียบร้อย');
		  window.location='mat_to_stock.php';</script>");

	if(!$delete_product){
	echo( "<script> alert('ไม่สามารถลบข้อมูลได้ เกิดข้อผิิดพลาดบางประการ');
		  window.location='mat_to_stock.php';</script>");
}
?>
