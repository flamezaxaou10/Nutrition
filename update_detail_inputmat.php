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
  $select = "SELECT * FROM detail_inputmat WHERE id_inputmat = '$id_input' AND mat_id = '$mat_id'";
  $query = mysql_query($select,$connect1);
  $row = mysql_fetch_array($query);
  $count0 = $row['count'];
  $count1 = $count+$count0;

  if (isset($_GET['All']) && $_GET['All'] == 'รับทั้งหมด') {
    $update = "SELECT * FROM detail_buymat WHERE id_mat = '$idbuy'";
    $result = mysql_query($update,$connect1);
    while ($row = mysql_fetch_array($result)) {
      $mat_id = $row['mat_id'];
      $count = $row['balance'];
      $sql  = "UPDATE detail_inputmat SET count = '$count',stat = '1' WHERE id_inputmat = '$id_input' AND mat_id = '$mat_id'";
      mysql_query($sql,$connect1);
    }
    $select = "SELECT * FROM detail_buymat WHERE id_mat = '$idbuy'";
    $result = mysql_query($select,$connect1);
    while ($row = mysql_fetch_array($result)){
      $balance = 0;
      $update = "UPDATE detail_buymat SET balance = '$balance' WHERE id_mat = '$idbuy'";
      mysql_query($update,$connect1);
    }
      header("location:insert_to_stock.php?id=$idbuy&idinputmat=$id_input");
   }
  elseif(isset($_GET['del']) && $_GET['del'] == '1'){
    $sql  = "UPDATE detail_inputmat SET count = '0',stat = '0' WHERE id_inputmat = '$id_input' AND mat_id = '$mat_id'";
    mysql_query($sql,$connect1);
    $select = "SELECT * FROM detail_buymat WHERE id_mat = '$idbuy' AND mat_id = '$mat_id'";
    $result = mysql_query($select,$connect1);
    while ($row = mysql_fetch_array($result)){
      $balance = $row['balance'];
      $balance = $balance+$count;
      $update = "UPDATE detail_buymat SET balance = '$balance' WHERE id_mat = '$idbuy' AND mat_id = '$mat_id'";
      mysql_query($update,$connect1);
    }
    header("location:insert_to_stock_con.php?id=$idbuy&idinputmat=$id_input");
  }
  else{
    $sql  = "UPDATE detail_inputmat SET count = '$count1',stat = '1' WHERE id_inputmat = '$id_input' AND mat_id = '$mat_id'";
    mysql_query($sql,$connect1);
    $select = "SELECT * FROM detail_buymat WHERE id_mat = '$idbuy' AND mat_id = '$mat_id'";
    $result = mysql_query($select,$connect1);
    while ($row = mysql_fetch_array($result)){
      $balance = $row['balance'];
      $balance = $balance-$count;
      $update = "UPDATE detail_buymat SET balance = '$balance' WHERE id_mat = '$idbuy' AND mat_id = '$mat_id'";
      mysql_query($update,$connect1);
    }
    header("location:insert_to_stock.php?id=$idbuy&idinputmat=$id_input");
  }

 ?>
