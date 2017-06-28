<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{


header('location:login.php');
exit();
}
$username=$_SESSION["Username"];
include 'header.php';
?>
<?php
  $id_input = $_GET['id'];
  $mat_id = $_GET['mat_id'];
  $idbuy = $_GET['idbuy'];
  $count = $_GET['count'];

  if (isset($_GET['All']) && $_GET['All'] == 'เพิ่มทั้งหมด') {
    $sql  = "UPDATE detail_inputmat SET stat = '1' WHERE id_inputmat = '$id_input'";
    mysql_query($sql,$connect1);
   }
  elseif(isset($_GET['del']) && $_GET['del'] == '1'){
    $sql  = "UPDATE detail_inputmat SET stat = '0' WHERE id_inputmat = '$id_input' AND mat_id = '$mat_id'";
    mysql_query($sql,$connect1);
  }
  else{
    $sql  = "UPDATE detail_inputmat SET count = '$count',stat = '1' WHERE id_inputmat = '$id_input' AND mat_id = '$mat_id'";
    mysql_query($sql,$connect1);
  }
  header("location:insert_to_stock.php?id=$idbuy&idinputmat=$id_input");
 ?>
