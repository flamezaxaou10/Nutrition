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
      <p>รายงานสรุปการสั่งซื้อวัตถุดิบจากร้านค้าตามช่วงเวลา</p>
      <form action="#" method="post">
        <div class="row">
          <div class="col-md-12">
            <label style="width:14.8%;">
              ชื่อร้านค้า :
            </label>
            <select id="res" name="res"  required onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text" style="width:57%;">
              <option value="" disabled selected>-------กรุณาเลือกร้านค้า-------</option></h4>
                <?
                  $strSQL = "SELECT * FROM restaurant ORDER BY res_name";
                  $objQuery = mysql_query($strSQL, $connect1);
                  while ($objReSult = mysql_fetch_array($objQuery)) {
                    if ($_POST["dep"] == $objReSult['res_id']) {
                      # code...
                      $sel = "selected";
                    }
                    else
                    {
                      $sel = "";
                    }
                ?>
              <option value="<? echo $objReSult["res_name"];?>" <? echo $sel; ?> > <? echo $objReSult["res_name"];?></option>
              <?
               }
              ?>
            </select>
          </div>
        </div>
        <br>
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
ก
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
          ข้อมูลการสั่งซื้อวัตถุดิบจากร้านค้าประจำสัปดาห์<br>
          ฝ่ายโภชนาการ โรงพยาบาลเจ้าพระยาอภัยภูเบศร
        </strong>
      </p>
      <br>
      <div class="top">
        <h4> ร้าน <?php echo $res; ?> </h4>
        ประจำวันที่ : <?php echo thDate($start); ?> ถึง <?php echo thDate($end); ?>
      </div> <br>

      <table class="table table-striped table-bordered" >
        <tr>
          <th><div align = "center">ลำดับ</div></th>
          <th><div align = "center">ชื่อวัตถุดิบ</div></th>
          <th><div align = "center">จำนวน</div></th>
          <th><div align = "center">หน่วยนับ</div></th>
          <th><div align = "center">ราคารวม(บาท)</div></th>
        </tr>
        <?php
          $select = "SELECT SUM(d.count),d.mat_id,SUM(d.price),d.unit_id,m.mat_name,u.unit_name,f.feed_name
                      FROM buymeterial b
                      JOIN detail_buymat d ON b.id_mat = d.id_mat
                      LEFT JOIN material m ON d.mat_id = m.mat_id
                      JOIN unit u ON d.unit_id = u.unit_id
                      LEFT JOIN feed f ON d.mat_id = f.feed_id
                      where res_name = '$res' AND (date between '$start' and '$end') GROUP BY d.mat_id";
          $query = mysql_query($select, $connect1);
          $i = 0;
          while ($result = mysql_fetch_array($query)) {
            $i++;
        ?>
          <tr>
            <td><div align = "center"><?php echo "$i"; ?></div></td>
            <td><?php echo $result['mat_name']; ?><?php echo $result['feed_name']; ?></td>
            <td><div align = "right"><?php echo $result['SUM(d.count)']; ?></div></td>
            <td><?php echo $result['unit_name']; ?></td>
            <td><div align = "right"><?php echo number_format ($result['SUM(d.price)'],2); ?></div></td>
          </tr>
        <?php
             $sum += $result['SUM(d.price)'];
          }
        ?>

      </table>
      <div class="text-right">
        <h4> ราคารวมทั้งหมด <?php echo  number_format($sum,2); ?> บาท</h4>
      </div>
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
