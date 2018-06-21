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
    font-size: 11px;
  }
  .card{
    border: 2px black solid;
    padding: 10px;
    width: 40%;
    margin: 10px;
    float: left;
  }
  .text-right{
    float: right;
    font-size: 12px;
  }
</style>
<?php
  $clinic = $_GET['clinic'];
  $date = $_GET['date'];
  $eats = $_GET['eats'];
  $sql = "SELECT * FROM order_food WHERE clinic = '$clinic' AND date_order = '$date' AND eats = '$eats' AND type_order = '3'";
  $res = mysql_query($sql,$connect1);
  $i = 1;
  $strDate=date('d-m-Y', strtotime($date));
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    $dates=$strDay." ".$strMonthThai." ".$strYear;
  switch ($eats) {
    case '4':
      $eat = "มื้อเช้า / $dates";
      break;
    case '5':
      $eat = "มื้อกลางวัน / $dates";
      break;
    case '6':
      $eat = "มื้อเย็น / $dates";
      break;
  }
  while ($row = mysql_fetch_array($res)){
?>
  <?php if ($i % 12 == 0): ?>
    <div class="card" style="margin-bottom:100px;">
      <center>
        <table width="100%">
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
  <?php else: ?>
    <div class="card">
      <div class="text-left">
          <span >อาหารเฉพาะโรค</span>
          <span style="float:right;"><?php echo $eat; ?></span>
      </div>
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
  <?php endif; ?>
<?
    $i++;
  }
?>

 <script type="text/javascript">
   window.print();
 </script>
