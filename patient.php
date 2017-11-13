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
       <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
       <br>
      <p>ระบบการสั่งอาหารและจัดส่งอาหารให้ผู้ป่วย</p>
      <?php
          $user2 = $_SESSION['Username'];
          $sqll = "SELECT DISTINCT * FROM jhosdb.fpatient_info f JOIN cpa.department d ON f.clinicdescribe = d.dep_name
                  JOIN cpa.sys_user s ON d.Dep_phone = s.group WHERE s.username = '$user2'";
          $ress = mysql_query($sqll,$connect1);
          $roww = mysql_fetch_array($ress);
          $dep = $roww['clinic'];
       ?>
      <form method="POST">
<label for="department"> แผนก : </label>
  <select id="dep" name="dep"   onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
  <option value="">-------แสดงทั้งหมด-------</option>
  <?

    $strSQL = "SELECT DISTINCT clinic, clinicdescribe FROM jhosdb.fpatient_info f JOIN cpa.department d ON f.clinicdescribe = d.dep_name  order by clinicdescribe";
    $objQuery = mysql_query($strSQL, $connect2);
    while ($objReSult = mysql_fetch_array($objQuery)) {
      $sql = "SELECT * FROM sys_user s JOIN department d ON s.group=d.Dep_phone  WHERE s.username = '$user2'";
      $res2 = mysql_query($sql,$connect1);
      if ($user2 == "admin2") {
        $dep_number="";
      }
      else {
        $dep_number="style='display:none'";
      }

      while ($row = mysql_fetch_array($res2)){
        if ($_POST["dep"] == $objReSult['clinic'] ) {
          $sel = "selected";
          $dep_number="";
        }
        elseif ($row['dep_name'] ==  $objReSult['clinicdescribe']) {
          $sel = "selected";
          $dep_number="";
        }
        else
        {
          $sel = "";
        }
      }
  ?>
<option value="<? echo $objReSult["clinic"];?>" <? echo $sel; ?> <? echo $dep_number; ?> > <? echo $show." ".$objReSult["clinicdescribe"];?></option>
<?

}
error_reporting(0);
?>
</select><font color="red">&nbsp;*</font>
 <br>
 <label for="fooder"> มื้ออาหาร : </label>
 <?php $eats = $_POST['eats']; ?>
<select id="food" name="eats">
  <option disabled>---เลือกมื้ออาหาร---</option>
  <option value="4" <?php if($eats == '4' && isset($eats)){echo "selected";} ?> >เช้า</option>
  <option value="5" <?php if($eats == '5' && isset($eats)){echo "selected";} ?> >กลางวัน</option>
  <option value="6" <?php if($eats == '6' && isset($eats)){echo "selected";} ?> >เย็น</option>
</select><font color="red">&nbsp;*</font>
<?php
 date_default_timezone_set("Asia/Bangkok");
 $d=strtotime('+1 day');
 $todate = date("d-m-Y",$d);
 $day = date("l");
 $dayy = substr($todate,0,2);
 $mon = substr($todate,3,2);
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
 if ($day = "Monday") {
   $day = "วันอังคาร";
 }
 elseif ($day = "Tuesday"){
   $day = "วันพุธ";
 }
 elseif ($day = "Wednesday"){
   $day = "วันพฤหัสบดี";
 }
 elseif ($day = "Thursday"){
   $day = "วันศุกร์";
 }
 elseif ($day = "Friday"){
   $day = "วันเสาร์";
 }
 elseif ($day = "Saturday"){
   $day = "วันอาทิตย์";
 }
 elseif ($day = "Sunday"){
   $day = "วันจันทร์";
 }
 $year = substr($todate,6,4);
 $year += 543;

?>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <b>ประจำวันที่ : <?php echo "$day $dayy $mon $year"; ?></b>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<? $strDefault = $objReSult['clinic']; ?>
<input type="hidden" name="selected_text" id="selected_text" value="" />
  &nbsp;&nbsp;<input type="submit" name = "search" class="btn btn-success" value="ค้นหา">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="radio" name="check_food" value="t1" onClick="selectAll(form1)">
  <label>สามัญทั้งหมด</label>
  <input type="radio" name="check_food" value="t2" onClick="selectAll(form1)">
  <label>พิเศษทั้งหมด</label>
<!--<input type="submit" name="search" value="Search"/>-->
</form>
    </div>
</div>
<div class="container">
<?php
error_reporting(0);
@include('conn.php');
$eats = 4;
if ($_POST) {
  $dep = $_POST['dep'];
  $eats = $_POST['eats'];
  $chec1 = $_POST['check_food'];
  $chec2 = $_POST['check_food'];
}
if ($dep != 0) {
$strSQL = "SELECT * FROM fpatient_info where clinic = '".$dep."'";
$objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");
}
else{
  $strSQL = "SELECT * FROM fpatient_info where clinic = '$dep'";
$objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");

}
?>
<form method="POST" action="chkPHP.php" name="form1">
<table class="table table-striped table-bordered">
  <tr class="warning">
    <th>
      <div class="text-center">
        มื้ออาหาร :
        <?php if ($eats == 4): ?>
          เช้า
        <?php elseif ($eats == 5): ?>
          กลางวัน
        <?php elseif ($eats == 6): ?>
          เย็น
        <?php endif; ?>
      </div>
    </td>
  </tr>
  <tr class="warning">
    <th><div align="center">ลำดับ</div></th>
    <th><div align="center">ชื่อแผนก</div></th>
    <th><div align="center">HN</div></th>
    <th><div align="center">AN</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
    <th><div align="center">สามัญ</div></th>
    <th><div align="center">พิเศษ</div></th>
    <th><div align="center">อาหารเฉพาะโรค</div></th>
  </tr>

<?
$new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $i; ?></div></td>
  <td><div><? echo $objReSult["clinicdescribe"];?></div></td>
  <td><div align = "center"><? echo $objReSult["hn"];?></div></td>
  <td><div align = "center"><? echo $objReSult["an"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  <input type=hidden name="eats" value = "<? echo $eats;?>">
  <?php
      $chkdate = date("Y-m-d",$d);
      $hnn = $objReSult['hn'];
      $chk = "SELECT type_order FROM order_food WHERE HN = '$hnn' AND eats = '$eats' AND date_order = '$chkdate'";
      $reschk = mysql_query($chk,$connect1);
      $rowc = mysql_fetch_array($reschk);
      $rchk = $rowc['type_order'];
   ?>
  <td><div>
  <center>
      <input type="radio" name="chkfood<?echo "$i";?>" value="t1" <?php
       if($chec1=='t1' ||$rchk == '1'){echo "checked";}?> onclick="del(<? echo $objReSult['hn'];?>,<?php echo $eats; ?>)" required >
  </center>
  </div></td>
  <td><div>
  <center>
      <input type="radio" name="chkfood<?echo "$i";?>" value="t2" <?php
      if($chec1=='t2' ||$rchk == '2'){echo "checked";}?> onclick="del(<? echo $objReSult['hn'];?>,<?php echo $eats; ?>)" required >
  </center>
  </div></td>
  <td><div>
    <center>
        <input type="radio" name="chkfood<?php echo $i;?>" value="" <?php if($rchk == '3'){echo "checked";}?> data-toggle="modal" name="hn" onclick="setHn(<? echo $objReSult['hn'];?>)" href="#myModal" value = "<? echo $objReSult['hn'];?>" required ></center></div></td>
        <input type=hidden name="$new_hn[]" value = <? echo $objReSult["hn"];?> >
  </tr>
  <input type="hidden" name="data2<? echo $i;?>" value="<? echo $objReSult["hn"];?>">
  <?
 // $temp = array("a", "b", "c");
  // $_SESSION['hn'] = $new_hn[];
  $_SESSION['hn'] = $objReSult["hn"];
  $_SESSION['fname'] = $objReSult["fname"];
  }
  ?>

</table>
</div>
  <div class="container">
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"><input type="button" name="" class="btn btn-lg btn-success" value="&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูล&nbsp;&nbsp;&nbsp;&nbsp;" data-toggle="modal" data-target="#myModal2"></div>
  </div>
  <br>
  <!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel2">ยืนยันการบันทึกข้อมูลการสั่งอาหาร</h4>
      </div>
      <div class="modal-body">
        <h4>
          <?php
            $sel = "SELECT DISTINCT clinic, clinicdescribe FROM fpatient_info WHERE clinic = '$dep' order by clinicdescribe";
            $res = mysql_query($sel,$connect2);
            $show = mysql_fetch_array($res);
            echo "แผนก : ".$show['clinicdescribe'];
          ?>
       </h4>
       <p>ประจำวันที่ : <?php echo "$day $dayy $mon $year"; ?></p>
       <p>
         มื้ออาหาร :
         <?php if ($eats == 4): ?>
           เช้า
         <?php elseif ($eats == 5): ?>
           กลางวัน
         <?php elseif ($eats == 6): ?>
           เย็น
         <?php endif; ?>
       </p>
       <p>
         <?php
            $sel = "SELECT COUNT(hn) FROM fpatient_info WHERE clinic = '$dep'";
            $res = mysql_query($sel,$connect2);
            $show = mysql_fetch_array($res);
            echo "จำนวนผู้ป่วย : ".$show['COUNT(hn)']." คน";
          ?>
       </p>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="บันทึกข้อมูล">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
</form>

<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">นายนนธวัฒน์&nbsp;จันทร์กระจ่าง</a></p>
</footer>

<script>
function selectAll(form1) {

  var check = document.getElementsByName("check_food"),
        radios = document.form1.elements;

    if (check[0].checked) {

        for( i = 0; i < radios.length; i++ ) {

            if( radios[i].type == "radio" ) {

                if (radios[i].value == "t1" ) {

                    radios[i].checked = true;
                }

            }

        }

    } else {

        for( i = 0; i < radios.length; i++ ) {

            if( radios[i].type == "radio" ) {

                if (radios[i].value == "t2" ) {

                    radios[i].checked = true;

                }

            }

        }

    };
  return null;
}

function chk_all(){
    var x=document.getElementsByTagName("input");
    for(i=0;i<=x.length;i++){
      list($data1,$data2) = split("_", $test);
        if(x[i].type=="radio"){
            x[i].checked=true;
        }
    }
}

function unchk_all(){
    var x=document.getElementsByTagName("input");
    for(i=0;i<=x.length;i++){
        if(x[i].type=="radio"){
            x[i].checked=false;
        }
    }
}
function del(id,eats){
  $.ajax({
    type: "GET",
    url: "delete_orderfood.php",
    data: {
      'hn': id,
      'eats' : eats,
    }
  });
}

function setHn(id){
  $('#hnModal').html(id);
  $.ajax({
  type: "GET",
  url: "loadPatient.php",
  data: { 'hn': id},
  success:function(response){
    var data = JSON.parse(response);
    $('#clinic').html(data.clinicdescribe);
    $('#fname_modal').html(data.fname);
    $('#lname_modal').html(data.lname);
    console.log(data);
  }
});
 // alert(id);
}
function submitModal(){
  var idFood = $('#idfood').val();
  var hn = $('#hnModal').html();
  var eats = $('#eats2').val();
  var roomno = $('#roomno').val();
  var bedno = $('#bedno').val();
  if(idFood === "" || roomno === "" || bedno === "" || eats === ""){
    alert("กรุณากรอกข้อมูลให้ครบถ้วน");
  }
  else{
    alert("เพิ่มข้อมูลสำเร็จ");
     //alert(eats);
   $.ajax({
  type: "POST",
  url: "insert_spec.php",
  data: {
    'hn': hn,
    'food' : idFood,
    'eats2' : eats,
    'roomno' : roomno,
    'bedno' : bedno
  }
})
  .done(function( msg ) {
     $('#myModal').modal('hide');
  });
 }
 document.getElementById("idfood").value = "";
 document.getElementById("roomno").value = "";
 document.getElementById("bedno").value = "";
}

$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})



</script>

<form method="POST" action="insert_spec.php" id="servform">
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">การสั่งอาหารเฉพาะโรค</h4>
      </div>

      <div class="modal-body">

      <h4> รหัสผู้ป่วย : <label id="hnModal"></label></h4>
      <h4> แผนก : <span id="clinic"></span></h4>
      <h4> ชื่อผู้ป่วย :&nbsp;<span id="fname_modal"></span> &nbsp;<span id="lname_modal"></span></b></h4>
      <h4>มื้ออาหาร :
  <? if ($eats == 4) {
    # code...
    echo "เช้า";
    ?>
    <input type=hidden name="eats2" id="eats2" value ="<? echo $eats;?>">
    <?
    }

      elseif ($eats == 5) {
      echo "กลางวัน";
      ?>
    <input type=hidden name="eats2" id="eats2" value ="<? echo $eats;?>">
    <?
    }
    elseif ($eats == 6) {
      # code...
      echo "เย็น";
      ?>
            <input type=hidden name="eats2" id="eats2" value ="<? echo $eats;?>">
            <?
    }
  ?></h4>

    <h4>ห้อง : <input type="text" name="roomno"  id="roomno"></h4>
    <h4>เตียง : <input type="text" name="bedno"  id="bedno"></h4>
    <h4>ชนิดของอาหาร : <input type="text" name="food"  id="idfood"></h4>
      </div>

      <div class="modal-footer">
        <input type="button" onclick="submitModal()" name= "submit" class="btn btn-success" value = "เพิ่มข้อมูล" >
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>

  </div>
</div>
</div>
</form>
</body>
</html>
