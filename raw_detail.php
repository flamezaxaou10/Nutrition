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
    ?>
<div class="container">
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
            <td style="padding-bottom : 10px;"> <?php echo $row['date']; ?></td>
          </tr>
        </table>
      </h5>
    </div>
</div>
  <table class="table table-striped table-bordered" style="padding : 2px;">
    <tr class="warning">
      <th style="width : 10%;">ลำดับ</th>
      <th style="width : 50%;">ชื่อวัตถุดิบ</th>
      <th style="width : 20%;">จำนวน</th>
      <th style="width : 20%;">หน่วยนับ</th>
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
       <td><?php echo $i; ?></td>
       <?php if ($row['feed_id'] != NULL): ?>
         <td><div align = "left"><? echo $row["feed_name"];?></div></td>
       <?php else: ?>
         <td><div align = "left"><? echo $row["mat_name"];?></div></td>
       <?php endif; ?>
      <td><?php echo $row['SUM(count)']; ?></td>
      <td><?php echo $row['unit_name']; ?></td>
     </tr>
   <?php } ?>
  </table>
