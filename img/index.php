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
	<title>หน้าแรก</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/css/bootstrap.css">

	<script src="css/js/bootstrap.min.js"></script>
	<script src="css/js/jquery.min.js"></script>
	<script src="css/js/bootstrap.js"></script>
</head>


<body>

<style type="text/css">
	body{background-color: #CAE1FF}
</style>
<div class="container">
	<ul class=""></ul>
</div>

<nav class="navbar navbar-inverse navbar-fixed-top" data-offset-top="197">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">ฝ่ายโภชนาการ<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="serv.php">การจัดส่งอาหาร</a></li>
          <li><a href="bmi.php">อัตราส่วน BMI</a></li>
          <li><a href="#">อาหารทางสายยาง</a></li>
          </ul>
        <li><a href="#">รายงาน</a></li>
        </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li><a href=""><span class="glyphicon glyphicon-user"> <? echo $_SESSION["Status"];?></span></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="jumbotron">
    <h1><font style="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>
    <p>ระบบสารสนเทศ</p>
  </div>

  <!--<div class="container-fluid">
<div class="row">
  <div class="col-md-4">
  	<a class="btn btn-danger btn-lg" href=""><span>ทดสอบ app 1</span></a>
  </div>
  <div class="col-md-4">
  	<a class="btn btn-warning btn-lg" href=""><span>ทดสอบ app 2</span></a>
  </div>
  <div class="col-md-4">
  	<a class="btn btn-success btn-lg" href=""><span>ทดสอบ app 3</span></a>
  </div>
 </div>
 <br>

 <div class="row">
 	<div class="col-md-4">
  	<a class="btn btn-danger btn-lg" href=""><span>ทดสอบ app 4</span></a>
  </div>
  <div class="col-md-4">
  	<a class="btn btn-warning btn-lg" href=""><span>ทดสอบ app 5</span></a>
  </div>
  <div class="col-md-4">
  	<a class="btn btn-success btn-lg" href=""><span>ทดสอบ app 6</span></a>
  </div>
 </div>

<br>
 <div class="row">
 	<div class="col-md-4">
  	<a class="btn btn-danger btn-lg" href=""><span>ทดสอบ app 7</span></a>
  </div>
  <div class="col-md-4">
  	<a class="btn btn-warning btn-lg" href=""><span>ทดสอบ app 8</span></a>
  </div>
  <div class="col-md-4">
  	<a class="btn btn-success btn-lg" href=""><span>ทดสอบ app 9</span></a>
  </div>
 </div>

<br>
 <div class="row">
 	<div class="col-md-4">
  	<a class="btn btn-danger btn-lg" href=""><span>ทดสอบ app 10</span></a>
  </div>
  <div class="col-md-4">
  	<a class="btn btn-warning btn-lg" href=""><span>ทดสอบ app 11</span></a>
  </div>
  <div class="col-md-4">
  	<a class="btn btn-success btn-lg" href=""><span>ทดสอบ app 12</span></a>
  </div>
 </div>

 </div>-->


<div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

          <!--<div class="jumbotron">
            <h1>โรงพยาบาลเจ้าพระยาอภัยภูเบศร</h1>
            <p>ระบบสารสนเทศ</p>
          </div>-->
          <div class="row">
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลผู้ป่วย</h3>            
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลร้านค้าวัตถุดิบ</h3>
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลเจ้าหน้าที่</h3>
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วัตถุดิบ</h3>
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;การสั่งวัตถุดิบ</h3>
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;การรับเข้าวัตถุดิบ</h3>
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลประเภทอาหาร</h3>
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลอาหาร</h3>
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยอดคงเหลือวัตถุดิบ</h3>
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จัดส่งอาหารให้กับผู้ป่วย</h3>
              <p><a class="btn btn-success btn-lg" href="serv.php" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;การขายอาหารทางสายยาง</h3>
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายงาน</h3>
              <p><a class="btn btn-success btn-lg" href="#" role="button">View details »</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->

      <hr>
    </div>


<!--<button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#myModal">Open Modal</button>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>

      <div class="modal-body">
        <table class="table table-striped">
        	<thead>
        		<tr>
        			<th>Firstname</th>
        			<th>Lastname</th>
        			<th>E-Mail</th>
        		</tr>
        	</thead>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>-->


</body>
</html>