<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
?>
<?php


?>
<!DOCTYPE html>
<html>
<head>
  <title>ระบบจัดการข้อมูลประเภทอาหาร</title>
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
<?php

?>
<div class="container">
    <div class="jumbotron">
       <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
       <br>
      <p>ข้อมูลการจัดเมนูอาหาร</p>
      <br>
      <?php

       ?>
      <form method="post" action="print_test.php">
      <div style="float:left; font-size: 1.5em;">วันที่</div><div style="float:left; font-size: 1.5em;">&nbsp;<input type="date" name="daytime" size = "8" value="<?php echo date(); ?>"><font color="red"> &nbsp;*&nbsp;&nbsp;</font><a href="editdetailorder.php"><input type="submit1" class="btn btn-success" name="submit2" value="ค้นหาและแก้ไขข้อมูล"></a><br></div>
<br />
<br />

<div style="float:left; font-size: 1.5em;">เจ้าหน้าที่</div><div style="float:left; font-size: 1.5em;">&nbsp;
  <?php echo $_SESSION["fnname"];?>&nbsp;<?php echo $_SESSION["lnname"];?>
</div>
<br />

<?php
@include('conn.php');
 ?>
  <div class="modal-body">

        <table class="table table-striped table-bordered" border="1" width="100%">
          <tr class="warning">
            <th></th><th></th><th><div align="center">พิเศษ</th><th><div align="center">สามัญ</th><th><div align="center">เจ้าหน้าที่</th>
          </tr>
          <tr class ="info">
            <td align="center"><b>เช้า</td>
            <td></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list1[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list2[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list3[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
          </tr>
          <tr class ="info">
            <td rowspan="2" align="center"><b>กลางวัน</td>
            <td align="center"><b>ธรรมดา</td>
            <td>
                    <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list4[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                    $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list5[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu ";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list6[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
          </tr>
          <tr class ="info">
            <td align="center"><b>อ่อน</td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list7[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list8[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      </td>
          </tr>
          <tr class ="info">
            <td td rowspan="2" align="center"><b>เย็น</td>
            <td align="center"><b>ธรรมดา</td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list10[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list11[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list12[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
          </tr>
          <tr class ="info">
            <td align="center"><b>อ่อน</td>
            <td>
                     <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list13[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list14[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      </td>
          </tr>
        </table>
        <h4>หมายเหตุ</h4>
        <textarea class="form-control" rows="3" id="detail" name="deta"  data-validation="required"><?php echo $ff; ?></textarea><br />
        <div style="float: right;"><input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit"></div>
      </form>

  </div>
 </div>
  </div>


<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">นายนนธวัฒน์  จันทร์กระจ่าง</a></p>
</footer>

<script>
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






</body>
</html>
