<!DOCTYPE html>
<html>
<head>
  <?php include 'conn.php'; ?>
	<title>ระบบจัดการข้อมูลโรงพยาบาลเจ้าพยาอภัยภูเบศ</title>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
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
  body{
    font-family: 'Kanit', sans-serif;
  }
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
            <li align = "center"><a href="matandunit.php">ข้อมูลพื้นฐาน</a></li>
            <li align = "center"><a href="insert_restaurant.php">ข้อมูลร้านค้าวัตถุดิบ</a></li>
            <li align = "center"><a href="mat.php">ข้อมูลวัตถุดิบ</a></li>
            <li align = "center"><a href="feed.php">ข้อมูลอาหารทางสายยาง</a></li>
            <li align = "center"><a href="insert_order_menu.php">ข้อมูลการจัดเมนูอาหาร</a></li>
            <li align = "center"><a href="raw.php">เบิกวัตถุดิบที่ใช้ทำอาหาร</a></li>
            <li align = "center"><a href="patient.php">การจัดส่งอาหารให้ผู้ป่วย</a></li>
            <li align = "center"><a href="insert_buymaterial.php">สั่งซื้อวัตถุดิบ</a></li>
            <li align = "center"><a href="insert_feed.php">สั่งซื้ออาหารทางสายยาง</a></li>
            <li align = "center"><a href="report.php">รายงานการจัดส่งอาหาร</a></li>
            <li align = "center"><a href="report2.php">รายงานการสั่งอาหาร</a></li>
            <li align = "center"><a href="stockanddetail.php">การรับวัตถุดิบเข้าคลัง</a></li>
            <li align = "center"><a href="sale_feed.php">การขายอาหารทางสายยาง</a></li>
          </ul>

        </li>
        <li><a href=""><span class="glyphicon glyphicon-user"> <? echo $_SESSION["fname"];?></span></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </div>
</nav>
