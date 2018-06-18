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
<div class="container">
  <div class="jumbotron">
    <center>
    <p>กระทรวงสาธารณสุข</p>
    <p>ใบสั่งยา</p>
    <p>โรงพยาบาลเจ้าพระยาอภัยภูเบศร</p>
  </center>
    <?php
        $salefeed_id = $_GET['salefeed_id'];
        $sql = "SELECT * FROM sale_feed WHERE salefeed_id = '$salefeed_id'";
        $result = mysql_query($sql,$connect1);
        $row = mysql_fetch_array($result);
        $strDate=$row['date'];
          $strYear = date("Y",strtotime($strDate))+543;
          $strMonth= date("n",strtotime($strDate));
          $strDay= date("j",strtotime($strDate));
          $strDays= date("l",strtotime($strDate));
          $strDayCut = Array("Monday"=>"วันจันทรที่","Tuesday"=>"วันอังคารที่","Wednesday"=>"วันพุธที่","Thursday"=>"วันพฤหัสบดีที่","Friday"=>"วันศุกรที่","Saturday"=>"วันเสารที่","Sunday"=>"วันอาทิตย์ที่");
          $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
          $strMonthThai=$strMonthCut[$strMonth];
          $strDaysThai = $strDayCut[$strDays];
          $date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;
     ?>
  <div class="modal-body">
    <h4>
      <style media="screen">
        td{
          padding-bottom : 20px;
        }
      </style>
      <form action="" method="post">
       <table>
         <tr >
           <td>รหัสการขายอาหารทางสายยาง </td>
           <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
           <td> <?php echo $salefeed_id; ?></td>
         </tr>
         <tr>
           <td>วันที่ขาย </td>
           <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
           <td> <?php echo $date; ?></td>
         </tr>
         <tr>
           <td>ชื่อผู้ป่วย </td>
           <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
           <td> <?php echo $row['customer']; ?></td>
         </tr>
      </table>
  </div>
  <table class="table table-striped table-bordered">
    <tr class="warning">
      <th>ลำดับ</th>
      <th>รหัสอาหารทางสายยาง</th>
      <th>ชื่ออาหารทางสายยาง</th>
      <th>จำนวน</th>
      <th>หน่วยนับ</th>
      <th>ราคารวม</th>
    </tr>
  <?php
    $table = "SELECT d.feed_id,f.feed_name,SUM(d.count),u.unit_name,d.price FROM detail_sale_feed d
                      JOIN feed f ON d.feed_id = f.feed_id
                      JOIN unit u ON d.unit_id = u.unit_id
                      WHERE salefeed_id = '$salefeed_id' GROUP BY f.feed_id";
    $result = mysql_query($table,$connect1);
    $i = 0;
    $total = 0;
    while ($row = mysql_fetch_array($result)){
      $id = $row['salefeed_id'];
      $i++;
    ?>
    <tr class ="info">
      <td><?php echo $i; ?></td>
      <td><?php echo $row['feed_id']; ?></td>
      <td><?php echo $row['feed_name']; ?></td>
      <td align="right"><?php echo $row['SUM(d.count)']; ?></td>
      <td><?php echo $row['unit_name']; ?></td>
      <td align="right"><?php echo number_format(($row['SUM(d.count)']*$row['price']),2) ?></td>

    </tr>
    <?php
     $total += $row['SUM(d.count)']*$row['price'];
    }
    ?>
    <tr class ="info">
      <td colspan="5" align="right"><b>ราคาทั้งหมด : </b></td>
      <td align="right"><b><?php echo number_format($total, 2); ?></b> <b>บาท</b></td>
    </tr>
  </table>
  </div>
</div>
  <div class="col-md-3" align="right">
    <p>.......................................... แพทย์ผู้สั่ง</p>
    <p>.............................................. ผู้จ่ายยา</p>
    <p>.............................................. ผู้รับเงิน</p>
  </div>
<script type="text/javascript">
  window.print();
</script>
