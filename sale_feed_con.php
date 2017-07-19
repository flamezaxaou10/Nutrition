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
             <td>เลือกอาหารทางสายยาง</td>
             <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td>
               <select name="feed_id">
               <?php
                  $sel = "SELECT * FROM stock_detail s JOIN feed f ON s.mat_id = f.feed_id WHERE s.stock_id = 'MT-06' GROUP BY s.mat_id";
                  $res = mysql_query($sel,$connect1);
                  while ($rows = mysql_fetch_array($res)) {
              ?>
                <option value="<?php echo $rows['feed_id']; ?>"><?php echo $rows['feed_name']; ?></option>
              <?php
                  }
                ?>
                </select>
             </td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>จำนวน</td>
              <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td><input type="number" name="count" min="1"></td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td><a href="update_detail_salefeed.php?salefeed_id=<?php echo $salefeed_id; ?>"><button class="btn btn-success" type="button" name="button">เพิ่มสินค้า</button></a></td>
           </tr>
         </table>
    </h4>
    </div>
    <div class="modal-footer" style="padding-bottom : 0px;">
      <form class="" action="sale_feed.php" method="post">
        <input type="submit" class="btn btn-success" value="บันทึกการขาย" name = "submit" onclick="submitModal()">
        <a href="delete_salefeed.php"><button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button></a>
      </form>
    </div>
  </div>

</div>
<?php include 'footer.php'; ?>
