<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
?>
<br>
<style media="screen,print" >
  td{
    padding: 5px;
  }
  .card{
    border: 2px black solid;
    padding: 20px;
    width: 80%;
    margin: auto;
  }
  .text-right{
    float: right;
  }
</style>
<?php
  $clinic = $_GET['clinic'];
  $date = $_GET['date'];
  $eats = $_GET['eats'];
  $sql = "SELECT * FROM order_food WHERE clinic = '$clinic' AND date_order = '$date' AND eats = '$eats' AND type_order = '3'";
  $res = mysql_query($sql,$connect1);
  while ($row = mysql_fetch_array($res)){
?>
<div class="col-md-6 card">
  <div class="text-right">อาหารเฉพาะโรค</div></td>
  <center>
  <table width="80%">
    <tr>
      <td><b>ตึก</b> <?php echo $row['dep_name']; ?></td>
      <td><b>ห้อง</b> <?php echo $row['roomno']; ?></td>
    </tr>
    <tr>
      <td></td>
      <td><b>เตียง</b> <?php echo $row['bedno']; ?></td>
    </tr>
    <tr>
      <td><b>ชื่อ</b> <?php echo $row['fname']; ?></td>
      <td><b>นามสกุล</b> <?php echo $row['lname']; ?></td>
    </tr>
    <tr>
      <td colspan="2"><b>ชนิดของอาหาร</b> <?php echo $row['type_food']; ?></td>
    </tr>
  </table>
</center>
</div>
<br>
<?
  }
?>

 <script type="text/javascript">
   window.print();
 </script>
