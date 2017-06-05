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
      <p>แก้ไขข้อมูลวัตถุดิบ</p>

  <div class="modal-body">
  <?php
  $id=$_GET['id'];
  $name=$_GET['id2'];
  $flag=0;
  if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $rest=$_POST['store'];
    @include('conn.php');
    $strSQL = "SELECT * FROM material WHERE mat_id <> '$id'";
    $objQuery = mysql_query($strSQL, $connect1);
    while ($objReSult = mysql_fetch_array($objQuery)) {
     $gname= $objReSult["mat_name"];
     if($gname==$name){
       $flag=1;
     }
}
if($flag==0){
  @include('conn.php');
  $insert = "UPDATE material  SET  mat_name='$name',res_id='$rest' WHERE mat_id='$id'";
       $query = mysql_query($insert,$connect1);
            echo( "<script> alert('แก้ไขข้อมูลสำเร็จ');
            window.location='mat.php';</script>");


  if(!$insert){
   echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
       </script>");
  }
}
  }

    ?>
         <form method="POST" action="#" onsubmit="return confirm('ต้องการแก้ไขข้อมูลนี้?');">

                    <h4> รหัสวัตถุดิบ : &nbsp;<input type="text" name="id" value="<?php echo $id ; ?>" readonly ></h4>
                    <h4> ชื่อวัตถุดิบ &nbsp;&nbsp;: &nbsp;<input type="text" name="name" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}" value="<?php echo $name; ?>"><font color="red"> &nbsp;*</font><?php if($flag==1)echo "<font color=red>ชื่อวัตถุดิบนี้มีในระบบแล้ว</font>"; ?></h4>
                    <?php
                       $strSQL = "SELECT * FROM restaurant where type = 'FYST01'";
                       $objQuery = mysql_query($strSQL, $connect1);
                    ?>
                    <h4> ร้านค้า : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name = "store">
                        <option>------กรุณาเลือกร้านค้า-----</option>
                      <?php while ($objReSult = mysql_fetch_array($objQuery)) {?> 
                        <option value="<?php echo $objReSult['res_id'];?>"
                        <?php if($_GET['id3']==$objReSult['res_name']){echo "selected";}?>>
                        <?php echo $objReSult['res_name'];?>
                        </option>
                      <?php }?>
                      </select><font color="red"> &nbsp;*</font>
                    </h4>

         <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="แก้ไขข้อมูล" name = "submit"
            onclick="submitModal()"">&nbsp;&nbsp;
         &nbsp;&nbsp; <a href="mat.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไขข้อมูลนี้?')">ยกเลิก</button></a>
        </form>
</div>
 </div>
  </div>

<?php
@include('conn.php');
$strSQL = "SELECT * FROM material a join restaurant b on a.res_id = b.res_id where mat_name like '%$see%' order by mat_id";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
?>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสวัตถุดิบ</div></th>
    <th><div align="center">ชื่อวัตถุดิบ</div></th>
    <th><div align="center">ร้านค้า</div></th>
   <!-- <th><div align="center">แก้ไข</div></th>-->

  </tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["mat_id"];?></div></td>
  <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
  <td><div align = "left"><? echo $objReSult["res_name"];?></div></td>
  <!--<td><div align = "center"><a href='edit_mat.php?id="<? echo $objReSult['mat_id']?>"&id2="<? echo $objReSult['mat_name']?>"' onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>-->

    </tr>
  <?
}

?>
</table>
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
