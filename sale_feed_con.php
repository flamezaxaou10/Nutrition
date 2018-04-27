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
<form class="" action="#" method="post">
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

        <style media="screen">
          td{
            padding-bottom : 20px;
          }
        </style>
         <table>

           <tr>
             <td style="padding-bottom:0px;"><h4>รหัสการขายอาหารทางสายยาง </h4></td>
             <td style="padding-bottom:0px;"><h4>&nbsp;&nbsp; : &nbsp;&nbsp;</h4></td>
             <td style="padding-bottom:0px;"><h4> <?php echo $salefeed_id; ?></h4></td>

           </tr>
           <tr>
             <td style="padding-bottom:0px;"><h4>วันที่ขาย </h4></td>
             <td style="padding-bottom:0px;"><h4>&nbsp;&nbsp; : &nbsp;&nbsp;</h4></td>
             <td style="padding-bottom:0px;">
               <h4>
                 <?php
                  date_default_timezone_set("Asia/Bangkok") ;
                   $strDate=$row['date'];
                   $strYear = date("Y",strtotime($strDate))+543;
                   $strMonth= date("n",strtotime($strDate));
                   $strDay= date("j",strtotime($strDate));
                   $strDays= date("l",strtotime($strDate));
                   $strDayCut = Array("Monday"=>"วันจันทร์ที่","Tuesday"=>"วันอังคารที่","Wednesday"=>"วันพุธที่","Thursday"=>"วันพฤหัสบดีที่","Friday"=>"วันศุกร์ที่","Saturday"=>"วันเสาร์ที่","Sunday"=>"วันอาทิตย์ที่");
                   $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                   $strMonthThai=$strMonthCut[$strMonth];
                   $strDaysThai = $strDayCut[$strDays];
                   $date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;
                  echo $date;
                 ?>
               </h4>
             </td>
           </tr>
           <tr>
             <td style="padding-bottom:0px;"><h4>ชื่อผู้ป่วย </h4></td>
             <td style="padding-bottom:0px;"><h4>&nbsp;&nbsp; : &nbsp;&nbsp;</h4></td>
             <td style="padding-bottom:0px;"><h4> <input type="text" name="customer" value="<?php echo $row['customer']; ?>"><font color="red">&nbsp;*</font></h4></td>
           </tr>
           <tr>
             <td></td>
           </tr>
           <tr>
             <table class="table table-striped table-bordered">
               <tr class="warning">
                 <th><div align="center">รหัสอาหารทางสายยาง</div></th>
                 <th><div align="center">ชื่ออาหารทางสายยาง</div></th>
                 <th><div align="center">จำนวนในคลัง</div></th>
                 <th><div align="center">จำนวนที่ซื้อ</div></th>
                 <th><div align="center">ราคาต่อหน่วย(บาท)</div></th>
                 <th><div align="center">หน่วยนับ</div></th>
                 <th><div align = "center">ซื้อ</div></th>
               </tr>
               <?php
                 $table = "SELECT SUM(s.count),f.feed_id,f.feed_name,u.unit_name,u.unit_id,f.price FROM stock_detail s
                                 JOIN feed f ON s.mat_id = f.feed_id
                                 JOIN unit u ON s.unit_id = u.unit_id
                                 GROUP BY f.feed_id";
                 $result = mysql_query($table,$connect1);
                 while ($row = mysql_fetch_array($result)){
                 ?>
                <form action="" method="post">
                 <tr class ="info">
                   <td><div align = "center"><?php echo $row['feed_id']; ?></div></td>
                   <td><?php echo $row['feed_name']; ?></td>
                   <td><div align = "right"><?php echo $row['SUM(s.count)']; ?></div></td>
                   <td><input type="number" name="count" min="0" max="<?php echo $row['SUM(s.count)']; ?>" style="width:100px;" required value="0"></td>
                   <td><div align = "right"><?php echo $row['price']; ?></div></td>
                   <td><?php echo $row['unit_name']; ?></td>
                   <td align="center">
                      <input type="submit" class="btn btn-success" value="เพิ่มในรายการ">
                   </td>
                  </tr>
                  <input type="hidden" name="feed_id" value="<?php echo $row['feed_id']; ?>">
                  <input type="hidden" name="unit_id" value="<?php echo $row['unit_id']; ?>">
                  <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                </form>
                <?php
                 }
                ?>
             </table>
           </tr>
         </table>
          <?php
            if ($_POST) {
              if ($_POST['Save'] == 'บันทึกการขาย') {
                $customer = $_POST['customer'];
                $update = "UPDATE sale_feed SET customer = '$customer' WHERE salefeed_id = '$salefeed_id'";
                mysql_query($update,$connect1);
              }
              else {
              $feed_id = $_POST['feed_id'];
              $count = $_POST['count'];
              $price = $_POST['price'];
              $unit_id = $_POST['unit_id'];
              header("location:update_detail_salefeed.php?salefeed_id=$salefeed_id&feed_id=$feed_id&count=$count&price=$price&unit_id=$unit_id");
            }
            }
          ?>
    </div>
  </div>
  <table class="table table-striped table-bordered">
    <tr class="warning">
       <th><div align="center">ลำดับ</div></th>
       <th><div align="center">รหัสอาหารทางสายยาง</div></th>
       <th><div align="center">ชื่ออาหารทางสายยาง</div></th>
       <th><div align="center">จำนวน</div></th>
       <th><div align="center">หน่วยนับ</div></th>
       <th><div align="center">ราคารวม(บาท)</div></th>
      <th><div align = "center">ลบ</div></th>
    </tr>
  <?php
    $table = "SELECT d.feed_id,f.feed_name,SUM(d.count),u.unit_name,d.price,d.unit_id FROM detail_sale_feed d
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
      <td><div align = "center"><?php echo $i; ?></div></td>
      <td><div align = "center"><?php echo $row['feed_id']; ?></td>
      <td><?php echo $row['feed_name']; ?></td>
      <td><div align = "right"><?php echo $row['SUM(d.count)']; ?></div></td>
      <td><?php echo $row['unit_name']; ?></td>
      <td align="right"><?php echo number_format($row['SUM(d.count)']*$row['price'],2); ?></td>
      <td><div align = "center"><a href="delete_detail_salefeed.php?salefeed_id=<?php echo $salefeed_id; ?>&feed_id=<?php echo $row['feed_id']; ?>&count=<?php echo $row['SUM(d.count)']; ?>&unit_id=<?php echo $row['unit_id']; ?>" ><img src='img/delete.png' width=25 data-dismiss="modal" onclick="return confirm('ต้องการลบรายการนี้?')"></a></div></td>
    </tr>
    <?php
     $total += $row['SUM(d.count)']*$row['price'];
    }
    ?>
    <tr class ="info">
      <td colspan="5" align="right"><b>ราคาทั้งหมด : </b></td>
      <td align="right"><b><?php echo number_format($total,2); ?></b></td>
      <td><b>บาท</b></td>
    </tr>
  </table>
  <div class="text-right">
      <input type="submit" class="btn btn-success" name="Save" value="บันทึกการขาย" data-toggle="modal" data-target="#myModal"> &nbsp;&nbsp;
      <a href="delete_salefeed.php?salefeed_id=<?php echo $salefeed_id; ?>"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
  </div>
</div>
</div>
 </form>
<?php if ($_POST['Save'] == 'บันทึกการขาย'): ?>
  <script type="text/javascript">
    $(window).load(function(){
    $('#myModal').modal('show');
  });
</script>
<?php endif; ?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" >
    <div class="modal-content" style="width:100%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ยืนยันการบันทึกการขาย</h4>
      </div>
      <div class="modal-body">
        <table width="100%">
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
              <td align="center"><?php echo $row['feed_name']; ?></td>
              <td align="center"><?php echo $row['SUM(d.count)']; ?></td>
              <td align="center"><?php echo $row['unit_name']; ?></td>
            </tr>
            <?php
             $total += $row['SUM(d.count)']*$row['price'];
            }
            ?>
            <tr class ="info">
              <td colspan="5" align="right"><b>ราคาทั้งหมด : </b></td>
              <td align="right"><b><?php echo number_format($total,2); ?></b></td>
              <td align="center"><b>บาท</b></td>
            </tr>
        </table>
      </div>
        <div align="center">
          <a href="check_sale_feed.php?salefeed_id=<?php echo $salefeed_id; ?>">
            <button type="button" class="btn btn-success">บันทึกการขาย</button>
          </a>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
        </div>
        <br>
      </div>
    </div>
  </div>

<?php include 'footer.php'; ?>
