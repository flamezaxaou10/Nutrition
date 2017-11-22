<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{


header('location:login.php');
exit();
}
$username=$_SESSION["Username"];
?>

<?php
  $id=$_GET['id'];
  $sql = "SELECT * FROM detail_buymat WHERE id_mat = '$id'";
  $chk = mysql_query($sql,$connect1);
  $num_rows = mysql_num_rows($chk);

  if ($num_rows <= 0) {
    $delete = "DELETE FROM buymeterial WHERE id_mat='$id'";
    $query = mysql_query($delete,$connect1);
    echo( "<script> alert('ยกเลิกการสั่งอาหารทางสายยาง');
  window.location='insert_feed.php';</script>");
}else  {
  echo( "<script> alert('บันทึกข้อมูลสำเร็จ');
window.location='insert_feed.php';</script>");
}


 ?>
