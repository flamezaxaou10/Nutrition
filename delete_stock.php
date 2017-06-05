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
  $sql = "DELETE FROM stock WHERE id_stock = '$ID'";
  $objQuery = mysql_query($sql,$connect1);

  echo( "<script> alert('ลบข้อมูลเรียบร้อย');
		  window.location='insert_stock.php';</script>");

	if(!$delete_product){
	echo( "<script> alert('ไม่สามารถลบข้อมูลได้ เกิดข้อผิิดพลาดบางประการ');
		  window.location='insert_stock.php';</script>");
}
?>
