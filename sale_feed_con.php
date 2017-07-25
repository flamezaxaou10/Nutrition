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
          $salefeed_id = $_GET['salefeed_id'];
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
         <table>
           <tr >
             <td>รหัสการขายอาหารทางสายยาง </td>
             <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td> <?php echo $salefeed_id; ?></td>
           </tr>
           <tr>
             <td>วันที่ขาย </td>
             <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td> <?php echo $row['date']; ?></td>
           </tr>
           <tr>
             <td>ชื่อผู้ป่วย </td>
             <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td> <?php echo $row['customer']; ?></td>
           </tr>
           <tr>
             <table class="table table-striped table-bordered">
               <tr class="warning">
                 <th>รหัสวัตถุดิบ</th>
                 <th>ชื่อวัตถุดิบ</th>
                 <th>จำนวนในคลัง</th>
                 <th>จำนวนที่ซื้อ</th>
                 <th>ราคาต่อหน่วย</th>
                 <th>หน่วยนับ</th>
                 <th><div align = "center">ซื้อ</div></th>
               </tr>
               <?php
                 $table = "SELECT SUM(s.count),f.feed_id,f.feed_name,u.unit_name,u.unit_id FROM stock_detail s
                                 JOIN feed f ON s.mat_id = f.feed_id
                                 JOIN unit u ON s.unit_id = u.unit_id
                                 GROUP BY f.feed_id";
                 $result = mysql_query($table,$connect1);
                 while ($row = mysql_fetch_array($result)){
                 ?>
                <form action="" method="post">
                 <tr class ="info">
                   <td><?php echo $row['feed_id']; ?></td>
                   <td><?php echo $row['feed_name']; ?></td>
                   <td><?php echo $row['SUM(s.count)']; ?></td>
                   <td><input type="number" name="count" min="1" max="<?php echo $row['SUM(s.count)']; ?>" style="width:100px;" required></td>
                   <td><input type="number" name="price" min="1" style="width:100px;" required></td>
                   <td><?php echo $row['unit_name']; ?></td>
                   <td align="center"><input type="submit" class="btn btn-success" value="เพิ่มในรายการ"></td>
                  </tr>
                  <input type="hidden" name="feed_id" value="<?php echo $row['feed_id']; ?>">
                  <input type="hidden" name="unit_id" value="<?php echo $row['unit_id']; ?>">
                </form>
                <?php
                 }
                ?>
             </table>
           </tr>
         </table>

          <?php
            if ($_POST) {
              $feed_id = $_POST['feed_id'];
              $count = $_POST['count'];
              $price = $_POST['price'];
              $unit_id = $_POST['unit_id'];

              $sql = "INSERT INTO detail_sale_feed (salefeed_id,feed_id,count,price,unit_id) VALUES ('$salefeed_id','$feed_id','$count','$price','$unit_id')";
              mysql_query($sql,$connect1);
            }
          ?>
    </h4>
    </div>
  </div>
  <table class="table table-striped table-bordered">
    <tr class="warning">
      <th>ลำดับ</th>
      <th>รหัสวัตถุดิบ</th>
      <th>ชื่อวัตถุดิบ</th>
      <th>จำนวน</th>
      <th>หน่วยนับ</th>
      <th>ราคารวม</th>
      <th><div align = "center">ลบ</div></th>
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
      $i++;
    ?>
    <tr class ="info">
      <td><?php echo $i; ?></td>
      <td><?php echo $row['feed_id']; ?></td>
      <td><?php echo $row['feed_name']; ?></td>
      <td><?php echo $row['SUM(d.count)']; ?></td>
      <td><?php echo $row['unit_name']; ?></td>
      <td align="right"><?php echo $row['SUM(d.count)']*$row['price']; ?></td>
      <td><div align = "center"><a href="delete_detail_salefeed.php?salefeed_id=<?php echo $salefeed_id; ?>&feed_id=<?php echo $row['feed_id']; ?>" ><img src='img/delete.png' width=25></a></div></td>
    </tr>
    <?php
     $total += $row['SUM(d.count)']*$row['price'];
    }
    ?>
    <tr class ="info">
      <td colspan="5" align="right"><b>ราคาทั้งหมด : </b></td>
      <td align="right"><b><?php echo $total; ?></b></td>
      <td><b>บาท</b></td>
    </tr>
  </table>
  <div class="modal-footer">
      <a href="sale_feed.php"><input type="submit" class="btn btn-success" value="บันทึกการขาย" name = "submit"></a>
      <a href="delete_salefeed.php?salefeed_id=<?php echo $salefeed_id; ?>"><button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button></a>
  </div>
</div>
<?php include 'footer.php'; ?>
