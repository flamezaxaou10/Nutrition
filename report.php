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
       <h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>
      <p>รายงานการจัดส่งอาหารให้กับผู้ป่วย</p>
      <div class="modal-body">
      <form method="POST" action="#">
  <h4>แผนก : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <select id="dep" name="dep"    onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
  <option value="o">-----------------------กรุณาเลือกแผนก-----------------------</option>
  <?
    @include('conn.php');
    $strSQL = "SELECT DISTINCT clinic, clinicdescribe FROM fpatient_info order by clinicdescribe";
    $objQuery = mysql_query($strSQL, $connect2);
    while ($objReSult = mysql_fetch_array($objQuery)) {
      if ($_POST["dep"] == $objReSult['clinic']) {
        # code...
        $sel = "selected";
      }
      else
      {
        $sel = "";
      }
  ?>
     <option value="<? echo $objReSult["clinic"];?>" <? echo $sel; ?> > <? echo $objReSult["clinicdescribe"];?></option>
     <?
      }
      error_reporting(0);
     ?>
</select><font color="red"> &nbsp;*</font></h4>
<!--<h4> ประเภทการสั่งอาหารอาหาร : 
<select id="dfood" name="dfood"    onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
<option value="o" <?if ($_POST['dfood']=="0") {echo"selected";}?>>-------กรุณาเลือกประเภทการสั่งอาหาร-------</option>
     <option value=1 <?if ($_POST['dfood']=="1") {echo"selected";}?>>สามัญ</option>
     <option value=2 <?if ($_POST['dfood']=="2") {echo"selected";}?>>พิเศษ</option>
     <option value=3 <?if ($_POST['dfood']=="3") {echo"selected";}?>>เฉพาะโรค</option>
     
</select><font color="red"> &nbsp;*</font>-->
<h4> ช่วงเวลา : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;

<select id="eats" name="eats"  onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
<option value="o" <?if ($_POST['eats']=="0") {echo"selected";}?>>-------กรุณาเลือกช่วงเวลา-------</option>
     <option value=4 <?if ($_POST['eats']=="4") {echo"selected";}?>>เช้า</option>
     <option value=5 <?if ($_POST['eats']=="5") {echo"selected";}?>>กลางวัน</option>
     <option value=6 <?if ($_POST['eats']=="6") {echo"selected";}?>>เย็น</option>
     
</select><font color="red"> &nbsp;*</font>

<h4> กรุณาเลือกวันที่ : 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;


  

<input type="hidden" name="selected_text" id="selected_text" value="" />
<input type="date" name="daytime" size = "8" value="<?php echo $_POST['daytime']; ?>"><font color="red"> &nbsp;*</font><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-success" name="search" value="ค้นหา"/>
<a href="patient.php"><button type="button" class="btn btn-danger" data-dismiss="modal">ย้อนกลับ</button></a>
</form>
</div>
</h4>
</div>

<div class="jumbotron">
<div id="print_table">
<center><h4><label type="text"  value="การสั่งอาหาร" display="">ข้อมูลการสั่งอาหารให้กับผู้ป่วย</label></h4></center>
<center><h4><label type="text"  value="การสั่งอาหาร" display="">ฝ่ายโภชนาการ&nbsp;โรงพยาบาลเจ้าพระยาอภัยภูเบศร</label></h4></center><br>
<div class="row">
<div class="col-md-4"><value="แผนก" display="">แผนก : <? $strSQL = "SELECT clinicdescribe FROM fpatient_info where clinic = '".$_POST['dep']."'";
    $objQuery = mysql_query($strSQL, $connect2);
    $objReSult = mysql_fetch_array($objQuery);
      echo $objReSult['clinicdescribe'];
  ?>  </label></div>

  <div class="col-md-3"><value="แผนก" display="">มื้อ : <?if ($_POST['eats'] == 4) {
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

  </div><br>

<div class="container">
<!-- <center><h1><label type="hidden" name="test" value="">การสั่งอาหาร</label></h1></center>
 --><?php
 error_reporting(0);
@include('conn.php');
$dep = $_POST['dep'];
$food = 1;
$eats = $_POST['eats'];
$day = $_POST['daytime'];

if ($dep != 0) {
  # code...
  if($food == 1)
  {
      # code...
      if(isset($day)){
    $strSQL = "SELECT * FROM order_food where clinic = '".$dep."' AND eats = '".$eats."' AND date_order = '".$day."' order by type_order";
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
<thead>
  <tr class="warning">
    <th width = "10%"><div align="center">ห้อง</div></th>
    <th width = "13%"><div align="center">รหัสผู้ป่วย</div></th>
    <th width = "25%"><div align="center">ชื่อ-นามสกุล</div></th>
    <th width = "5%"><div align="center">น้ำหนัก</div></th>
    <th width = "5%"><div align="center">ส่วนสูง</div></th>
    <th width = "11%"><div align="center">ประเภทผู้ป่วย</div></th>
    <th width = "15%"><div align="center">ประเภทอาหาร</div></th>
    <th width = "50%"><div align="center">รายละเอียด</div></th>
    
  </tr>
</thead>
  <?
  // $new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">
  <td><div align = "center"><? echo $objReSult["roomno"];?></div></td>
  <td><div align = "center"><? echo $objReSult["HN"];?></div></td>
  <td><div><? echo $objReSult["fname"]." ". $objReSult["lname"];?></div></td>
  <td><div align = "center"><? echo $objReSult["weight"];?></div></td>
  <td><div align = "center"><? echo $objReSult["height"];?></div></td>

  <td><div align = "center">
  <?php if($objReSult["type_order"]=='1'){
      echo 'สามัญ';
  } 
  else if($objReSult["type_order"]=='2'){
      echo 'พิเศษ';
  }
  else if($objReSult["type_order"]=='3'){
      echo 'สามัญ';
  }
  ?>
  <td><div align = "center">
  <?php if($objReSult["type_order"]=='1'){
      echo 'ธรรมดา';
  } 
  else if($objReSult["type_order"]=='2'){
      echo 'พิเศษ';
  }
  else if($objReSult["type_order"]=='3'){
      echo 'อาหารเฉพาะโรค';
  }
  ?>
  <td><div align = "center"><? echo $objReSult["detail_food"];?></div></td>
  
  </div></td>

  </tr>
  
  <?
}
 $strSQL1 = "SELECT count(type_order) as a1 FROM order_food where clinic = '".$dep."' and type_order = 1";
 //echo $strSQL1;
  $objQuery1 = mysql_query($strSQL1, $connect1);
  $objReSult1 = mysql_fetch_array($objQuery1);

  $strSQL2 = "SELECT count(type_order) as a2 FROM order_food where clinic = '".$dep."' and type_order = 2";
 //echo $strSQL1;
  $objQuery2 = mysql_query($strSQL2, $connect1);
  $objReSult2 = mysql_fetch_array($objQuery2);

  $strSQL3 = "SELECT count(type_order) as a3 FROM order_food where clinic = '".$dep."' and type_order = 3";
 //echo $strSQL1;
  $objQuery3 = mysql_query($strSQL3, $connect1);
  $objReSult3 = mysql_fetch_array($objQuery3);

  $strSQL4 = "SELECT count(type_order) as a4 FROM order_food where clinic = '".$dep."'";
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
    } 
  elseif ($food == 2) {
      # code...
      if(isset($day)){
    $strSQL = "SELECT * FROM order_food where clinic = '".$dep."' AND eats = '".$eats."' AND date_order = '".$day."'";
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
<thead>
  <tr class="warning">
    <th width = "10%"><div align="center">ห้อง</div></th>
    <th width = "20%"><div align="center">รหัสผู้ป่วย</div></th>
    <th width = "30%"><div align="center">ชื่อ-นามสกุล</div></th>
  </tr>
</thead>
  <?
  // $new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">
  <td><div align = "center"><? echo $objReSult["roomno"];?></div></td>
  <td><div align = "center"><? echo $objReSult["HN"];?></div></td>
  <td><div><? echo $objReSult["fname"]." ". $objReSult["lname"];?></div></td>
  </tr>
  
  <?
}
?>

</table>
  <?
}
    }
  elseif ($food == 3) {
    # code...
    if(isset($day)) {
      $strSQL = "SELECT * FROM order_diss where clinic = '".$dep."' AND eats = '".$eats."' AND date_order = '".$day."'";
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
  <thead>
  <tr class="warning">
    <th width = "5%"><div align="center">ห้อง</div></th>
    <th width = "13%"><div align="center">รหัสผู้ป่วย</div></th>
    <th width = "20%"><div align="center">ชื่อ-นามสกุล</div></th>
    <th width = "9%"><div align="center">น้ำหนัก</div></th>
    <th width = "7%"><div align="center">ส่วนสูง</div></th>
    <th width = "19%"><div align="center">ประเภทอาหาร</div></th>
    <th width = "25%"><div align="center">รายละเอียด</div></th>
  </tr>
</thead>
  <?

  // $new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
<cfoutput>
      <cfloop from="1" to="30" index="i">
  <tr class ="info">
    <td><div align = "center"><? echo $objReSult["roomno"];?></div></td>
    <td><div align = "center"><? echo $objReSult["HN"];?></div></td>
    <td><div><? echo $objReSult["fname"] ." ". $objReSult["lname"];?></div></td>
    <td><div align = "center"><? echo $objReSult["weight"];?></div></td>
    <td><div align = "center"><? echo $objReSult["height"];?></div></td>
    <td><div><? echo $objReSult["type_name"];?></div></td>
    <td><div><? echo $objReSult["detail_food"];?></div></td>
  </tr>
  </cfloop>
  </cfoutput>
  <?
}
?>
</table>
<?  
}
}
}
else {
  
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