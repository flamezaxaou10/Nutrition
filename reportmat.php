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
      <p>รายงานสรุปการใช้วัตถุดิบตามช่วงเวลา</p>
      <div class="row">
        <form action="#" method="post">
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
        </form>
      </div>
    </div>
  </div>

  <?php
    if ($_POST) {
      $start = $_POST['start'];
      $end = $_POST['end'];

      //date
      date_default_timezone_set("Asia/Bangkok") ;
      function thDate ($str) {
        $strYear = date("Y",strtotime($str))+543;
        $strMonth= date("n",strtotime($str));
        $strDay= date("j",strtotime($str));
        $strDays= date("l",strtotime($str));
        $strDayCut = Array("Monday"=>"วันจันทร์","Tuesday"=>"วันอังคาร","Wednesday"=>"วันพุธ","Thursday"=>"วันพฤหัสบดี","Friday"=>"วันศุกร์","Saturday"=>"วันเสาร์","Sunday"=>"วันอาทิตย์");
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
          ข้อมูลการใช้วัตถุดิบตามช่วงเวลาฝ่ายโภชนาการ <br>
          โรงพยาบาลเจ้าพระยาอภัยภูเบศร
        </strong>
      </p>
      <br>
      <div class="top">
        ประจำวันที่ : <?php echo thDate($start); ?> ถึง <?php echo thDate($end); ?>
      </div> <br>

      <table class="table table-striped table-bordered" >
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อวัตถุดิบ</th>
          <th>จำนวน</th>
          <th>หน่วยนับ</th>
        </tr>
        <?php
          $select = "SELECT SUM(d.count),d.mat_id,d.unit_id,m.mat_name,u.unit_name
                      FROM raw_system r
                      JOIN detail_raw d ON r.id_raw = d.id_raw
                      LEFT JOIN material m ON d.mat_id = m.mat_id
                      JOIN unit u ON d.unit_id = u.unit_id
                      where (date between '$start' and '$end') GROUP BY d.mat_id";
          $query = mysql_query($select, $connect1);
          $i = 0;
          while ($result = mysql_fetch_array($query)) {
            $i++;
        ?>
        <tr>
          <td><?php echo "$i"; ?></td>
          <td><?php echo $result['mat_name']; ?><?php echo $result['feed_name']; ?></td>
          <td><?php echo $result['SUM(d.count)']; ?></td>
          <td><?php echo $result['unit_name']; ?></td>
        </tr>
      <?php
        }
      ?>

      </table>
      <br>
    </div>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-success " OnClick="printTable('print_table')"> พิมพ์ใบสรุป </button> <br><br>
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
