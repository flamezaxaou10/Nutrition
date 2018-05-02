<!-- <body onLoad="window.print(window.location='report.php')"> -->
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
      <p>รายงานการสั่งอาหารให้กับผู้ป่วย</p>
      <div class="modal-body">
      <form method="POST" action="#">
<label> มื้ออาหาร : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<select id="eats" name="eats"  onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
     <option value=4 <?if ($_POST['eats']=="4") {echo"selected";}?>>เช้า</option>
     <option value=5 <?if ($_POST['eats']=="5") {echo"selected";}?>>กลางวัน</option>
     <option value=6 <?if ($_POST['eats']=="6") {echo"selected";}?>>เย็น</option>

</select><font color="red"> &nbsp;*</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 กรุณาเลือกวันที่ :
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
  date_default_timezone_set("Asia/Bangkok");
  $d=strtotime('+1 day');
  $todate = date("Y-m-d",$d);
  $food = 1;
  $eats = 4;
  $day = $todate;
  if (isset($_POST['daytime'])) {
    $day = $_POST['daytime'];
    $eats = $_POST['eats'];
  }
 ?>

<input type="hidden" name="selected_text" id="selected_text" value="" />
<input type="date" name="daytime" size = "8" value="<?php echo $todate; ?>"><font color="red"> &nbsp;*</font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" class="btn btn-success" name="search" value="ค้นหา"/>
<a href="patient.php"><button type="button" class="btn btn-danger" data-dismiss="modal">ย้อนกลับ</button></a>
</form>
</div></label>
</div>

<div class="jumbotron">
<div id="print_table">
<center><h4><label type="text"  value="การสั่งอาหาร" display="">ข้อมูลการสั่งอาหารให้กับผู้ป่วย</label></h4></center>
<center><h4><label type="text"  value="การสั่งอาหาร" display="">ฝ่ายโภชนาการ&nbsp;โรงพยาบาลเจ้าพระยาอภัยภูเบศร</label></h4></center><br>
<div class="row text-center">
  <strong>
  <div class="col-md-3" align = "left"><value="แผนก" display="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;มื้ออาหาร: <?if ($eats == 4) {
    # code...
    echo "เช้า";
    }
      elseif ($eats == 5) {
      echo "กลางวัน";

    }
    elseif ($eats == 6) {
      # code...
      echo "เย็น";
    }
  ?>  </label></div>
  <?php
    $dayy = substr($day,-2);
    $mon =substr($day,-5,2);
    if($mon == '01' ){
      $mon = 'มกราคม';
    }else if($mon == '02'){
      $mon = 'กุมภาพันธ์';
    }else if($mon == '03'){
      $mon = 'มีนาคม';
    }else if($mon == '04'){
      $mon = 'เมษายน';
    }else if($mon == '05'){
      $mon = 'พฤษภาคม';
    }else if($mon == '06'){
      $mon = 'มิถุนายน';
    }else if($mon == '07'){
      $mon = 'กรกฏาคม';
    }else if($mon == '08'){
      $mon = 'สิงหาคม';
    }else if($mon == '09'){
      $mon = 'กันยายน';
    }else if($mon == '10'){
      $mon = 'ตุลาคม';
    }else if($mon == '11'){
      $mon = 'พฤศจิกายน';
    }else if($mon == '12'){
      $mon = 'ธันวาคม';
    }
    $year = substr($day,-10,4);
    $year += 543;
  ?>
  <div class="col-md-3" align = "left"><value="แผนก" display="" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ประจำวันที่ : <? echo $dayy.' '.$mon.' '.$year; ?></label></font></div>
  <div class="col-md-3" align = "left"><value="แผนก" display="" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เจ้าหน้าที่พยาบาล : <? echo $_SESSION["Username"].' '.$_SESSION["lnname"]; ?></label></font></div>
    </strong>
  </div><br>

<div class="container">
<?php
    $phone = $_SESSION["Username"];
    $strSQL = "SELECT * FROM cpa.order_food o JOIN jhosdb.fpatient_info f ON o.HN = f.HN
                JOIN cpa.department d ON d.dep_name = o.dep_name  WHERE o.eats = '$eats' AND o.date_order = '$day' AND d.Dep_phone = '$phone' ORDER BY o.type_order";
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
<thead>
  <tr class="warning">
    <th width = ""><div align="center">ลำดับ</th>
    <th width = ""><div align="center">แผนก</th>
    <th width = ""><div align="center">HN</div></th>
    <th width = ""><div align="center">AN</div></th>
    <th width = ""><div align="center">ชื่อ - นามสกุล</div></th>
    <th width = ""><div align="center">ประเภทอาหาร</div></th>
  </tr>
</thead>
  <?
  // $new_hn = array();
$i = 0;

while ($objReSult = mysql_fetch_array($objQuery)) {
  $i++;
?>
  <tr class ="info">
    <td><div align="center"><?php echo $i; ?></td>
    <td><? echo $objReSult["dep_name"];?></td>
    <td><div align = "center"><?php echo $objReSult['HN'];?></div></td>
    <td><div align = "center"><?php echo $objReSult['an'];?></div></td>
    <td><?php echo $objReSult['fname']." ".$objReSult['lname'];;  ?></td>
    <td>
        <?php
            switch ($objReSult['type_order']) {
              case '1':
                  echo "สามัญ";
                break;
              case '2':
                  echo "พิเศษ";
                break;
              case '3':
                  echo "เฉพาะโรค";
                break;
              default:
                # code...
                break;
            }
         ?>
    </td>
  </tr>

  <?
}
 $strSQL1 = "SELECT count(type_order) as a1 FROM order_food o JOIN department d ON d.dep_name = o.dep_name where type_order = 1 AND eats = '$eats' AND date_order = '$day' AND d.Dep_phone = '$phone'";
 //echo $strSQL1;
  $objQuery1 = mysql_query($strSQL1, $connect1);
  $objReSult1 = mysql_fetch_array($objQuery1);

  $strSQL2 = "SELECT count(type_order) as a2 FROM order_food o JOIN department d ON d.dep_name = o.dep_name where type_order = 2 AND eats = '$eats' AND date_order = '$day' AND d.Dep_phone = '$phone'";
 //echo $strSQL1;
  $objQuery2 = mysql_query($strSQL2, $connect1);
  $objReSult2 = mysql_fetch_array($objQuery2);

  $strSQL3 = "SELECT count(type_order) as a3 FROM order_food o JOIN department d ON d.dep_name = o.dep_name where type_order = 3 AND eats = '$eats' AND date_order = '$day' AND d.Dep_phone = '$phone'";
 //echo $strSQL1;
  $objQuery3 = mysql_query($strSQL3, $connect1);
  $objReSult3 = mysql_fetch_array($objQuery3);

  $strSQL4 = "SELECT count(type_order) as a4 FROM order_food o JOIN department d ON d.dep_name = o.dep_name WHERE eats = '$eats' AND date_order = '$day' AND d.Dep_phone = '$phone'";
 //echo $strSQL1;
  $objQuery4 = mysql_query($strSQL4, $connect1);
  $objReSult4 = mysql_fetch_array($objQuery4);
?>

</table>
<br />
<div align="right"  class="table">
  <table>
    <tr>
      <td><b>ยอดรวมผู้ป่วย</b></td>
      <td></td>
    </tr>
    <tr>
      <td>สามัญ</td>
      <td><?php echo $objReSult1['a1'];?> คน</td>
    </tr>
    <tr>
      <td>พิเศษ</td>
      <td><?php echo $objReSult2['a2'];?> คน</td>
    </tr>
    <tr>
      <td>เฉพาะโรค</td>
      <td><?php echo $objReSult3['a3'];?> คน</td>
    </tr>
    <tr>
      <td>ทั้งหมด</td>
      <td><?php echo $objReSult4['a4'];?> คน</td>
    </tr>
  </table>
</div>
    <br/>
    <br/>
    <br/>
    <br/>
  <div style=" margin-left: 50%;">ลงชื่อ.......................................ผู้จัดส่งอาหาร</div>
  <div style=" margin-left: 58%;"></div><br/>
  <div style=" margin-left: 50%;">ลงชื่อ.......................................พยาบาลหัวหน้าเวร</div>
  <!-- <div style=" margin-left: 57%;">เจ้าหน้าที่พยาบาล </div> -->


</div>
</div>
</div>
                </div>
                <p style="text-align:center;"><button class="btn btn-success"  OnClick="printTable('print_table');">พิมพ์ใบสั่งอาหาร</button></p>
            </div>-->
        </div>
    </body>
</html>
<script type="text/javascript">
function setCl(name,clinic,date,eats){
  $('#clModal').html(name);
  $('#test').load('loadReport.php?clinic='+clinic+'&date='+date+'&eats='+eats);
}

</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ข้อมูลผู้ป่วยเฉพาะโรค</h4>
      </div>
      <div class="modal-body">

        <h4 id="clModal"></h4>
        <div id="test">
        </div>
      </div>
    </div>
  </div>
</div>
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
