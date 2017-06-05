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
  <title>BMI</title>
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
            <li><a href="serv.php">การจัดส่งอาหาร</a></li>
            <li><a href="bmi.php">คำนวณค่า BMI ผู้ป่วย</a></li>
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
      <p>คำนวณค่า BMI ให้กับผู้ป่วย<p>
 <form method="POST">
<label for="department"> แผนก : </label>
  <select id="dep" name="dep"     onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
  <option value="o">-------แสดงทั้งหมด-------</option>
  <?
    @include('conn.php');
    $strSQL = "SELECT DISTINCT clinic, clinicdescribe FROM fpatient_info";
    $objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");
    while ($objReSult = mysql_fetch_array($objQuery)) {

  ?>
     <option value=<?echo $objReSult["clinic"];?>><?echo $objReSult["clinicdescribe"];?></option>
     <?
      }
     ?>
</select>
<input type="hidden" name="selected_text" id="selected_text" value="" />
<input type="submit" name="search" value="Search"/>
</form>
    </div>
</div>
<div class="container">
<?php  
@include('conn.php');
$dep = $_POST['dep'];

if ($dep != 0) {
  # code...
$strSQL = "SELECT * FROM fpatient_info where clinic = '".$dep."'";
$objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");
}
else{
  # code...
  $strSQL = "SELECT * FROM fpatient_info";
$objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");
}
?>

<form method="POST" action="chkPHP.php">
<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">Clinic</div></th>
    <th><div align="center">Clinic Name</div></th>
    <th><div align="center">HN</div></th>
    <th><div align="center">FIRST NAME</div></th>
    <th><div align="center">LAST NAME</div></th>
    <th><div align="center">BMI</div></th>
  </tr>

<?
$new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["clinic"];?></div></td>
  <td><div><? echo $objReSult["clinicdescribe"];?></div></td>
  <td><div align = "center"><? echo $objReSult["hn"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  <td><div><center><a data-toggle="modal" name="hn" onclick="setHn(<? echo $objReSult["hn"]; $testtest = $objReSult["hn"];?>)" href="#myModal">BMI</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a data-toggle="modal" name="update" onclick="updateHn(<? echo $objReSult["hn"]; $testtest = $objReSult["hn"];?>)" href="#myModal1">แก้ไข</a></center></div></td>

  </tr>
  
  <?

 // $temp = array("a", "b", "c");
  // $_SESSION['hn'] = $new_hn[];

  // $_SESSION['hn'] = $objReSult["hn"];
  // $_SESSION['fname'] = $objReSult["fname"];
  // list($data1,$data2,$data3) = split("_", $id);
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
    <div class="col-md-2 col-xs-2"><input type="submit" name="" class="btn btn-lg btn-success" value="&nbsp;&nbsp;&nbsp;&nbsp;บันทึก&nbsp;&nbsp;&nbsp;&nbsp;"></div>
  </div>
  <br>
</form>


<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</a></p>
</footer>

<script>

function setHn(id){
  //alert(id);
  $('#hnModal').html(id);
}

function updateHn(id){
  $('#hnModalUp').html(id);
}

function submitModal(){
  var weight = $('#weight').val();
  var hn = $('#hnModal').html();
  var height = $('#height').val();
  // alert(idFood + ' ' + hn + ' ' + detail);
   $.ajax({
  type: "POST",
  url: "insert_bmi.php",
  data: { 'hn': hn,
  'weight' : weight,
  'height' : height
  }
})
  .done(function( msg ) {
      alert(msg);
  });
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


<form id="bmi" method="POST" action="insert_bmi.php">
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">การส่งค่า BMI</h4>
      </div>

      <div class="modal-body">
      <?
      @include("conn.php");
    $strSQL2 = "SELECT * FROM fpatient_info where hn = '".$testtest."' ";
    $objQuery2 = mysql_query($strSQL2, $connect2);
    $objReSult2 = mysql_fetch_array($objQuery2);

   
    // {
    //   ?>
    <table>
          <h4>รหัสผู้ป่วย : <label id="hnModal"></label></h4>
         <tr> <h4> ชื่อ : <? echo $objReSult2["fname"];?> <? echo $objReSult2["lname"];?> </h4></span></tr></p><br>
          น้ำหนัก : <input type="text" name="txtW" id="weight">&nbsp;&nbsp;กิโลกรัม <br><br>
          ส่วนสูง : <input type="text" name="txtH" id="height" >&nbsp;&nbsp;เซนติเมตร<br><br>
          <?
          // }          
          ?>
      </table>
      </div>
      
      <div class="modal-footer">
        <input type="button" onclick="submitModal()" name= "submit" class="btn btn-success" value = "submit">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
</form>

<form id="bmi" method="POST" action="update_bmi.php">
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">การส่งค่า BMI</h4>
      </div>

      <div class="modal-body">
      <?
      @include("conn.php");
    $strSQL2 = "SELECT * FROM fpatient_info where hn = '".$testtest."' ";
    $objQuery2 = mysql_query($strSQL2, $connect2);
    $objReSult2 = mysql_fetch_array($objQuery2);

     $strSQL3 = "SELECT * FROM bmi_table where hn = '".$testtest."' ";
    $objQuery3 = mysql_query($strSQL3, $connect1);
    $objReSult3 = mysql_fetch_array($objQuery3);
    // {
    //   ?>
    <table>
          <h4>รหัสผู้ป่วย : <label id="hnModalUp"></label></h4>
         <tr> <h4> ชื่อ : <? echo $objReSult2["fname"];?> <? echo $objReSult2["lname"];?> </h4></span></tr></p><br>
          น้ำหนัก : <input type="text" name="txtW" id="weight" value="<? echo $objReSult3["weight"];?>">&nbsp;&nbsp;กิโลกรัม <br><br>
          ส่วนสูง : <input type="text" name="txtH" id="height" value="<? echo $objReSult3["height"];?>">&nbsp;&nbsp;เซนติเมตร<br><br>
          <?
          // }          
          ?>
      </table>
      </div>
      
      <div class="modal-footer">
        <input type="button" onclick="submitModal()" name= "submit" class="btn btn-success" value = "submit">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
</form>


</body>
</html>