<!-- <body onLoad="window.print(window.location='report.php')"> -->
<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

<link rel="icon" href="img/icon300.ico" type="image/x-icon"/>


  <link rel="stylesheet" href="css/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/css/myStyle2.css">

  <script src="css/js/jquery.min.js"></script>
  <script src="css/js/bootstrap.min.js"></script>

<!--         <title>Test | Basic Website</title> -->
<title></title>
        <style type="text/css">
            .container{width:980px;margin:0 auto;padding:20px 15px;border:1px solid #000;}
            @media screen and (max-width:980px){.container{width:95%;}}
            .title{width:100%;border-bottom:1px solid #000;}
            .body{width:100%;display:table;min-height:200px;padding:20px 0px;}
            a,a:hover{text-decoration:none;}
            a:hover{color:orange;}
        </style>
         
        <script type="text/javascript"> 
            function printTable(tableprint) { 
var divToPrint = document.getElementById('print_table');
       var popupWin = window.open('');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
      popupWin.document.close();
      window.location;
      window.location.href = 'report.php'; 
            } 
        </script>

<style type="text/css">
  .navbar {
      font-family: Montserrat, sans-serif;
      margin-bottom: 0;
      background-color: #2d2d30;
      border: 0;
      font-size: 11px !important;
      letter-spacing: 4px;
      opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
      color: #fff !important;
  }
  .navbar-nav li.active a {
      color: #fff !important;
      background-color: #29292c !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
  }
  .open .dropdown-toggle {
      color: #fff;
      background-color: #555 !important;
  }
  .dropdown-menu li a {
      color: #000 !important;
  }
  .dropdown-menu li a:hover {
      background-color: red !important;
  }
  footer {
      background-color: #2d2d30;
      color: #f5f5f5;
      padding: 32px;
  }
  footer a {
      color: #f5f5f5;
  }
  footer a:hover {
      color: #777;
      text-decoration: none;
  }
thead {display: table-header-group;}
tfoot {display: table-header-group;}
}
  </style>         
<style type="text/css" media="print">
thead {display: table-header-group;}
</style>
    </head>
    <body>
<div class="container">
  <ul class=""></ul>
</div>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">NUTRITION SYSTEM</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">NUTRITION
          <span class="caret"></span></a>


           <ul class="dropdown-menu">
                <li align = "center"><a href="HN_patient.php">ข้อมูลผู้ป่วย</a></li>
            <li align = "center"><a href="user.php">ข้อมูลเจ้าหน้าที่</a></li>
            <li align = "center"><a href="department.php">ข้อมูลแผนก</a></li>
             <li align = "center"><a href="matandunit.php">ข้อมูลวัตถุดิบและหน่วยนับ</a></li>
            <li align = "center"><a href="insert_restaurant.php">ข้อมูลร้านค้าวัตถุดิบ</a></li>
            <li align = "center"><a href="typefood.php">ข้อมูลประเภทอาหาร</a></li>
            <li align = "center"><a href="insert_menu.php">ข้อมูลเมนูอาหาร</a></li>
            <li align = "center"><a href="patient.php">การสั่งอาหารและจัดส่งอาหาร</a></li>
            <li align = "center"><a href="insert_buymaterial.php">สั่งซื้อวัตถุดิบ</a></li>
            <li align = "center"><a href="insert_feed.php">สั่งซื้ออาหารทางสายยาง</a></li>
          </ul>



        </li>
        <li><a href=""><span class="glyphicon glyphicon-user"> <? echo $_SESSION["Username"];?></span></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <div class="jumbotron">
      <p>รายงานการจัดส่งอาหารให้กับผู้ป่วย</p>
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
  <div class="col-md-3"><value="แผนก" display="">มื้ออาหาร : <?if ($_POST['eats'] == 4) {
    # code...
    echo "เช้า";
    }
      elseif ($_POST["eats"] == 5) {
      echo "กลางวัน";

    }
    elseif ($_POST["eats"] == 6) {
      # code...
      echo "เย็น";
    }
  ?>  </label></div>
  <?php
    $dayy = substr($_POST['daytime'],-2);
    $mon =substr($_POST['daytime'],-5,2);
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
    $year = substr($_POST['daytime'],-10,4);
    $year += 543;
  ?>
  <div class="col-md-3"><value="แผนก" display="">ประจำวันที่ : <? echo $dayy.' '.$mon.' '.$year; ?></label></font></div>
  <div class="col-md-3"><value="แผนก" display="">เจ้าหน้าที่พยาบาล : <? echo $_SESSION["fnname"].' '.$_SESSION["lnname"]; ?></label></font></div>
    </strong>
  </div><br>

<div class="container">
<!-- <center><h1><label type="hidden" name="test" value="">การสั่งอาหาร</label></h1></center>
 --><?php
 error_reporting(0);
@include('conn.php');
$food = 1;
$eats = $_POST['eats'];
$day = $_POST['daytime'];
      if(isset($day)){
    $strSQL = "SELECT * FROM order_food WHERE eats = '$eats' AND date_order = '$day' GROUP BY clinic ORDER BY dep_name";
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
<thead>
  <tr class="warning">
    <th width = "70%">แผนก</th>
    <th width = "10%"><div align="center">สามัญ</div></th>
    <th width = "10%"><div align="center">พิเศษ</div></th>
    <th width = "10%"><div align="center">เฉพาะโรค</div></th>
  </tr>
</thead>
  <?
  // $new_hn = array();
$i = 0;

while ($objReSult = mysql_fetch_array($objQuery)) {
  $i++;
  $clinic = $objReSult['clinic'];
  $strSQL1 = "SELECT count(type_order) as a1 FROM order_food where type_order = 1 AND clinic = '$clinic' AND eats = '$eats' AND date_order = '$day' ";
  //echo $strSQL1;
   $objQuery1 = mysql_query($strSQL1, $connect1);
   $objReSult1 = mysql_fetch_array($objQuery1);

   $strSQL2 = "SELECT count(type_order) as a2 FROM order_food where type_order = 2 AND clinic = '$clinic' AND eats = '$eats' AND date_order = '$day' ";
  //echo $strSQL1;
   $objQuery2 = mysql_query($strSQL2, $connect1);
   $objReSult2 = mysql_fetch_array($objQuery2);

   $strSQL3 = "SELECT count(type_order) as a3 FROM order_food where type_order = 3 AND clinic = '$clinic' AND eats = '$eats' AND date_order = '$day' ";
  //echo $strSQL1;
   $objQuery3 = mysql_query($strSQL3, $connect1);
   $objReSult3 = mysql_fetch_array($objQuery3);
?>
  <tr class ="info">
    <td><? echo $objReSult["dep_name"];?></td>
    <td><div align = "center"><?php echo $objReSult1['a1'];?></div></td>
    <td><div align = "center"><?php echo $objReSult2['a2'];?></div></td>
    <td><div align = "center"><a data-toggle="modal" data-target="#myModal" onclick="setCl('<?php echo $objReSult["dep_name"]; ?>')" href="#myModal"><?php echo $objReSult3['a3'];?></a></div></td>
  </tr>

  <?
}
 $strSQL1 = "SELECT count(type_order) as a1 FROM order_food where type_order = 1 AND eats = '$eats' AND date_order = '$day' ";
 //echo $strSQL1;
  $objQuery1 = mysql_query($strSQL1, $connect1);
  $objReSult1 = mysql_fetch_array($objQuery1);

  $strSQL2 = "SELECT count(type_order) as a2 FROM order_food where type_order = 2 AND eats = '$eats' AND date_order = '$day' ";
 //echo $strSQL1;
  $objQuery2 = mysql_query($strSQL2, $connect1);
  $objReSult2 = mysql_fetch_array($objQuery2);

  $strSQL3 = "SELECT count(type_order) as a3 FROM order_food where type_order = 3 AND eats = '$eats' AND date_order = '$day' ";
 //echo $strSQL1;
  $objQuery3 = mysql_query($strSQL3, $connect1);
  $objReSult3 = mysql_fetch_array($objQuery3);

  $strSQL4 = "SELECT count(type_order) as a4 FROM order_food WHERE eats = '$eats' AND date_order = '$day' ";
 //echo $strSQL1;
  $objQuery4 = mysql_query($strSQL4, $connect1);
  $objReSult4 = mysql_fetch_array($objQuery4);
?>

</table>
<br />
  <div style="float: left; margin-left: 77%;">ยอดรวมผู้ป่วย</div><br />
  <div style="float: left; margin-left: 75%;">สามัญ</div>
    <div style="float: left; margin-left: 1%;"><?php echo $objReSult1['a1'];?> &nbsp;คน</div><br />
  <div style="float: left; margin-left: 75%;">พิเศษ</div>
    <div style="float: left; margin-left: 1%;">&nbsp;<?php echo $objReSult2['a2'];?> &nbsp;คน</div><br />
  <div style="float: left; margin-left: 75%;">เฉพาะโรค</div>
     <div style="float: left; margin-left: 1%;">&nbsp;<?php echo $objReSult3['a3'];?> &nbsp;คน</div>
  <div style="float: left; margin-left: 75%;">ทั้งหมด</div>
     <div style="float: left; margin-left: 1%;">&nbsp;<?php echo $objReSult4['a4'];?> &nbsp;คน</div>
    <br/>
    <br/>
    <br/>
    <br/>
  <div style=" margin-left: 50%;">ลงชื่อ.......................................ผู้จัดส่งอาหาร</div>
  <div style=" margin-left: 58%;"></div><br/>
  <div style=" margin-left: 50%;">ลงชื่อ.......................................พยาบาลหัวหน้าเวร</div>
  <!-- <div style=" margin-left: 57%;">เจ้าหน้าที่พยาบาล </div> -->

<?
  }
?>
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
function setCl(name){
  alert(name);
  $('#clModal').html(name);
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
        <table class="table table-striped table-bordered" border="1" width="100%">
          <tr class="warning">
            <th>รหัสผู้ป่วย</th>
            <th>ชื่อ - นามสกุล</th>
            <th>ห้อง</th>
            <th>เตียง</th>
            <th>ชนิดของอาหาร</th>
          </tr>
          <?php

           ?>
          <tr class="info">

          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
