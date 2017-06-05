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
	<title>ระยยจัดการข้อมูลการสั่งซื้อาหารทางสายยาง</title>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

<link rel="icon" href="img/icon300.ico" type="image/x-icon"/>

 
  <link rel="stylesheet" href="css/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/css/myStyle2.css">

  <script src="css/js/bootstrap.min.js"></script>
  <script src="css/js/jquery.min.js"></script>
  <script src="css/js/bootstrap.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

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
</style>
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
            <li align = "center"><a href="insert_restaurant.php">ข้อมูลรา้นค้าวัตถุดิบ</a></li>
            <li align = "center"><a href="typefood.php">ข้อมูลประเภทอาหาร</a></li>
            <li align = "center"><a href="patient.php">การสั่งอาหารและจัดส่งอาหาร</a></li>
            <li align = "center"><a href="insert_buymaterial.php">สั่งซื้อวัตถุดิบ</a></li>
            <li align = "center"><a href="insert_buyfeed.php">สั่งซื้ออาหารทางสายยาง</a></li>
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
			 <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
      <br>
      <p>ข้อมูลการสั่งซื้ออาหารทางสายยาง</p>

            <div class="modal-body">
            <input type='hidden' name='res_name' value=''>
              <h4 align="center"> ร้านค้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; 
                            <select>
                              <option value="volvo">dddddddddddddd</option>
                              <option value="saab">vvvvvvvvvvvvv</option>
                              <option value="mercedes">hhhhhhhhhhhhhh</option>
                              <option value="audi">mmmmmmmmmmmmmm</option>
                            </select>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่สั่งซื้อ  &nbsp;&nbsp;:&nbsp;&nbsp; 
                <input type="hidden" name="selected_text" id="selected_text" value="" />
                 <input type="date" name="date_buy" size = "8" value=""></td></tr></h4>
                <h4 align="center">&nbsp;&nbsp;&nbsp;&nbsp;รหัสการสั่งซื้อ &nbsp;: 
                <input type='text' name ='id_buymat' required value=''>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รหัสผู้สั่งซื้อ &nbsp;&nbsp;:&nbsp;&nbsp; 
                <input type='text' name ='id_officer' required value=''></td></tr></h4><br>

      <p>รายละเอียดอาหารทางสายยาง</p>


                <h4 align="center">&nbsp;&nbsp;&nbsp;&nbsp;รหัสอาหารทางสายยาง &nbsp;: 
                <input type='text' name ='id_feed' required value=''></td></tr></h4>
           <h4 align="center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่ออาหารทางสายยาง &nbsp;&nbsp;:
                <input type='text' name ='name_feed' required value=''></td></tr></h4>
                 <h4 align="center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนอาหารทางสายยาง &nbsp;:
                <input type='text' name ='number_feed' required value=''>

                      <select>
                              <option value="volvo">กิโลกรัม</option>
                              <option value="saab">กล่อง</option>
                              <option value="mercedes">กรัม</option>
                              <option value="audi">ขีด</option>
                            </select>
               </td></tr></h4><br>
            
              </div>


          <div class="modal-footer">
  <input type="submit" class="btn btn-success" value="ตกลง" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')">&nbsp;&nbsp;
  <a href="typefood.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไข?')">ยกเลิก</button>
  </center>
</a></div>

		</div>
</div>



<!DOCTYPE HTML>
<html>
<head>
<body>
<form method="post" action="update_food.php" >
<center>


	
<!--<div class="modal-body">
<input type='hidden' name='id' value=''>
  <h4 align="left"> รหัสร้านค้า : <input type='text' name ='res_id' required value=''></td></tr></h4>
  <h4 align="left"> ชื่อร้านค้า  &nbsp;: &nbsp;<input type='text' name ='res_name' required value=''></td></tr></h4>
  <h4 align="left"> ที่อยู่  &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type='text' name ='res_address' required value=''></td></tr></h4>


</div>-->





	</form>

</body>
</html>

<!--<div class="modal-footer">
        <input type="submit" onclick="submitModal()" name="submit" class="btn btn-success" value = "ตกลง">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>-->
