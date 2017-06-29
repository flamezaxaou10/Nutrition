<?php
  include ('conn.php');
  session_start();
  if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
  {
  header('location:login.php');
  exit();
  }
  include "conn.php";
  $ID = $_GET['idinputmat'];

  $sql = "UPDATE input_material SET stat = '0' WHERE id_inputmat = '$ID'";
  mysql_query($sql,$connect1);

  $sql = "DELETE FROM detail_inputmat WHERE id_inputmat = '$ID'";
  mysql_query($sql,$connect1);
  $sql = "SELECT  stock_detail.count as count1,
		              detail_buymat.count,
                  detail_buymat.balance,
                  detail_buymat.id_mat,
                  stock_detail.mat_id
					          FROM stock_detail
                    JOIN input_material ON input_material.id_inputmat = stock_detail.id_inputmat
                    JOIN detail_buymat ON detail_buymat.id_mat = input_material.id_mat
                    WHERE stock_detail.id_inputmat = '$ID' GROUP BY stock_detail.id_detail";
  $objQuery = mysql_query($sql,$connect1);
  while ($row = mysql_fetch_array($objQuery)) {
    $count  =$row['count1'];
    $balance = $row['balance'];
    $balance = $balance+$count;
    $id_mat = $row['id_mat'];
    $mat_id = $row['mat_id'];
    $update = "UPDATE detail_buymat SET balance = '$balance' WHERE id_mat = '$id_mat' AND mat_id = '$mat_id'";
    mysql_query($update,$connect1);
  }
  $sql = "DELETE FROM stock_detail WHERE id_inputmat = '$ID'";
  mysql_query($sql,$connect1);

   echo( "<script> alert('ลบข้อมูลเรียบร้อย');
		  window.location='mat_to_stock.php';</script>");

	if(!$objQuery){
	echo( "<script> alert('ไม่สามารถลบข้อมูลได้ เกิดข้อผิิดพลาดบางประการ');
	 	  window.location='mat_to_stock.php';</script>");
  }
?>
