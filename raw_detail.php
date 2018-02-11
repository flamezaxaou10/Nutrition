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
      $id_raw = $_GET['id_raw'];
      $sql = "SELECT * FROM raw_system WHERE id_raw = '$id_raw'";
      $res = mysql_query($sql,$connect1);
      $row = mysql_fetch_array($res);
      $todate = $row['date'];
      date_default_timezone_set("Asia/Bangkok") ;
      $strDate=$todate;
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strDays= date("l",strtotime($strDate));
        $strDayCut = Array("Monday"=>"วันจันทร์","Tuesday"=>"วันอังคาร","Wednesday"=>"วันพุธ","Thursday"=>"วันพฤหัสบดี","Friday"=>"วันศุกร์","Saturday"=>"วันเสาร์","Sunday"=>"วันอาทิตย์");
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        $strDaysThai = $strDayCut[$strDays];
        $date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;
    ?>
<div class="container" >
    <h4>รายละเอียดการจัดการวัตถุดิบ</h4>
    <div class="modal-body" style="padding-bottom:0px;">
      <h5>
        <table>
          <tr >
            <td style="padding-bottom : 10px;">รหัสจัดการวัตถุดิบ </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"><?php echo $id_raw; ?></td>
            <td style="padding-bottom : 10px; width:10%;"></td>
            <td style="padding-bottom : 10px;">เมนูอาหาร </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"> <?php echo $row['name_raw']; ?> </td>
          </tr>
          <tr>
            <td style="padding-bottom : 10px;">วันที่ </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"> <?php echo $date;?></td>
          </tr>
        </table>
      </h5>
    </div>
</div>
  <table class="table table-striped table-bordered" style="padding : 2px;">
    <tr class="warning">
      <th><div align="center">ลำดับ</div></th>
      <th><div align="center">ชื่อวัตถุดิบ</div></th>
      <th><div align="center">จำนวน</div></th>
      <th><div align="center">หน่วยนับ</div></th>
    </tr>
    <?php
        $table = "SELECT d.mat_id,f.feed_id,f.feed_name,m.mat_name,SUM(count),u.unit_name,u.unit_id FROM detail_raw d LEFT JOIN material m ON d.mat_id = m.mat_id
                                                 LEFT JOIN feed f ON d.mat_id = f.feed_id
                                                 JOIN unit u ON d.unit_id = u.unit_id
                                                 WHERE d.id_raw = '$id_raw' GROUP BY mat_id";
        $result = mysql_query($table,$connect1);
        $i = 0;
        while ($row = mysql_fetch_array($result)){
          $i++;
     ?>
     <tr class="info">
       <td><div align = "center"><?php echo $i; ?></div></td>
       <?php if ($row['feed_id'] != NULL): ?>
         <td><div align = "center"><? echo $row["feed_name"];?></div></td>
       <?php else: ?>
         <td><div align = "center"><? echo $row["mat_name"];?></div></td>
       <?php endif; ?>
      <td><div align = "right"><?php echo $row['SUM(count)']; ?></div></td>
      <td><div align = "center"><?php echo $row['unit_name']; ?></div></td>
     </tr>
   <?php } ?>
  </table>
