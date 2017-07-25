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
    <p>การขายอาหารทางสายยาง</p>
    <?php
        $salefeed_id = $_GET['id'];
        $sql = "SELECT * FROM sale_feed WHERE salefeed_id = '$salefeed_id'";
        $result = mysql_query($sql,$connect1);
        $row = mysql_fetch_array($result);
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
           <td>รหัสพนักงาน </td>
           <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
           <td> <?php echo $row['username'];?></td>
         </tr>
         <tr>
           <td>วันที่ขาย </td>
           <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
           <td> <?php echo $row['date']; ?></td>
         </tr>
         <tr>
           <td>ชื่อผู้ซื้อ </td>
           <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
           <td> <?php echo $row['customer']; ?></td>
         </tr>
      </table>
  </div>
  <table class="table table-striped table-bordered">
    <tr class="warning">
      <th>ลำดับ</th>
      <th>รหัสวัตถุดิบ</th>
      <th>ชื่อวัตถุดิบ</th>
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
      <td><?php echo $row['SUM(d.count)']; ?></td>
      <td><?php echo $row['unit_name']; ?></td>
      <td align="right"><?php echo $row['SUM(d.count)']*$row['price']; ?></td>
    </tr>
    <?php
     $total += $row['SUM(d.count)']*$row['price'];
    }
    ?>
    <tr class ="info">
      <td colspan="5" align="right"><b>ราคาทั้งหมด : </b></td>
      <td align="right"><b><?php echo $total; ?></b> <b>บาท</b></td>
    </tr>
  </table>
    <p align="right"><a href="sale_feed.php"><button type="button" class="btn btn-danger" name="button">ย้อนกลับ</button></a></p>
  </div>
</div>
<?php include 'footer.php'; ?>
