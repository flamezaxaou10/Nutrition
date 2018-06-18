<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
include 'header.php';
?>


<div class="container">
  <div class="jumbotron">
    <div class="modal-body">
      <p>รายงานสรุปยอดขายอาหารทางสายยาง</p>
      <form action="#" method="post">
        <div class="row">
          <div class="col-md-9">
            <label style="width:20%;">
              กรุกรุณาเลือกวันที่ :
            </label>
            <input type="date" name="start" value="" style="width:35%;" required>
            <label style="width:5%;" class="text-center">ถึง</label>
            <input type="date" name="end" value="" style="width:35%;" required>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-success ">ค้นหา</button>
            <a href="report_all.php">
              <button type="button"  class="btn btn-danger">ย้อนกลับ</button>
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php
    if ($_POST) {
      $start = $_POST['start'];
      $end = $_POST['end'];
      $res = $_POST['res'];
      //date
      date_default_timezone_set("Asia/Bangkok") ;
      function thDate ($str) {
        $strYear = date("Y",strtotime($str))+543;
        $strMonth= date("n",strtotime($str));
        $strDay= date("j",strtotime($str));
        $strDays= date("l",strtotime($str));
        $strDayCut = Array("Monday"=>"วันจันทร์ที่","Tuesday"=>"วันอังคารที่","Wednesday"=>"วันพุธที่","Thursday"=>"วันพฤหัสบดีที่","Friday"=>"วันศุกร์ที่","Saturday"=>"วันเสาร์ที่","Sunday"=>"วันอาทิตย์ที่");
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        $strDaysThai = $strDayCut[$strDays];
        $date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;
        return ($date);
      }

   ?>

  <div class="jumbotron" id="print_table">
    <div class="modal-body">
      <p class="text-center ">
        <strong>
          ข้อมูลสรุปยอดขายอาหารทางสายยาง<br>
          ฝ่ายโภชนาการ โรงพยาบาลเจ้าพระยาอภัยภูเบศร
        </strong>
      </p>
      <br>
      <div class="top">
        ประจำวันที่ : <?php echo thDate($start); ?> ถึง <?php echo thDate($end); ?>
      </div> <br>

      <table class="table table-striped table-bordered" >
        <tr>
          <th><div align = "center">รหัสการขาย</div></th>
          <th><div align = "center">ชื่อผู้ป่วย</div></th>
          <th><div align = "center">ชื่ออาหารทางสายยาง</div></th>
          <th><div align = "center">จำนวน</div></th>
          <th><div align = "center">หน่วยนับ</div></th>
          <th><div align = "center">ราคารวม(บาท)</div></th>
        </tr>
        <?php
          $select = "SELECT * FROM sale_feed where (date between '$start' and '$end')";
          $query = mysql_query($select, $connect1);
          while ($result = mysql_fetch_array($query)) {
            $salefeed_id = $result['salefeed_id'];
            $sum = 0;
        ?>
          <tr>

            <?php
              $sql = "SELECT * FROM detail_sale_feed d
                      JOIN unit u ON d.unit_id = u.unit_id
                      JOIN feed f ON d.feed_id = f.feed_id
                      WHERE d.salefeed_id = '$salefeed_id'";
              $queryin = mysql_query($sql, $connect1);
              $i = mysql_num_rows($queryin);
            ?>
              <td rowspan="<?php echo $i; ?>"><div align = "center"><?php echo $result['salefeed_id']; ?></div></td>
              <td rowspan="<?php echo $i; ?>"><?php echo $result['customer']; ?></td>
            <?php
              while ($resultin = mysql_fetch_array($queryin)) {
             ?>
              <td><?php echo $resultin['feed_name']; ?></td>
              <td><div align = "right"><?php echo $resultin['count']; ?></div></td>
              <td><?php echo $resultin['unit_name']; ?></td>
              <td><div align = "right"><?php echo number_format($resultin['price'],2); ?></div></td>
          </tr>
        <?php
              $sum += $resultin['price'];
            }
        ?>
            <tr>
              <td colspan="6" class="text-right">ยอดขายรวม <?php echo number_format ($sum,2); ?> บาท</td>
            </tr>
        <?php
          }
        ?>
      </table>
      <br>
    </div>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-success " OnClick="printTable('print_table');"> พิมพ์ใบสรุป </button> <br><br>
  </div>
  <?php } ?>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
  function printTable(divName) {
    var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;

   document.body.innerHTML = printContents;

   window.print();

   document.body.innerHTML = originalContents;
   location.reload();
  }
</script>
