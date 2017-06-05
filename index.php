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
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>ระบบสารสนเทศการจัดการฝ่ายโภชนาการ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

<link rel="icon" href="img/icon300.ico" type="image/x-icon"/>


  <link rel="stylesheet" href="css/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/css/myStyle.css">

  <script src="css/js/bootstrap.min.js"></script>
  <script src="css/js/jquery.min.js"></script>
  <script src="css/js/bootstrap.js"></script>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

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

<!-- picture Slide-->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="img/img2.jpg" alt="New York">
      <div class="carousel-caption">
        <h3>NUTRITION SYSTEM</h3>
      </div>
    </div>

    <div class="item">
      <img src="img/img1.jpg" alt="Chicago">
      <div class="carousel-caption">
        <h3>NUTRITION SYSTEM</h3>
      </div>
    </div>

    <div class="item">
      <img src="img/img3.jpg" alt="Los Angeles">
      <div class="carousel-caption">
        <h3>NUTRITION SYSTEM</h3>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
ห
<!-- Container (The Band Section) -->
<div id="band" class="container text-center">
  <h3>VISIT</h3>
  <p><font face = "JasmineUPC" size="5">บริการสุขภาพแบบผสมที่เป็นเลิศ&nbsp;&nbsp;
และเป็นผู้นำด้านการแพทย์แผนไทยในอาเซียน</font></p>
  <h3>VALUE</h3>
  <p><font face = "JasmineUPC" size="5">อภัยภูเบศร&nbsp;&nbsp;บริการดี&nbsp;&nbsp;มีน้ำใจ&nbsp;&nbsp;ใฝ่เรียนรู้</font></p>

  <br>



<!-- ALL SYSTEM-->
  <div class="row">
     <!-- <div id="demo" class="collapse">
        <p>Guitarist and Lead Vocalist</p>
        <p>Loves long walks on the beach</p>
        <p>Member since 1988</p>
      </div>-->

 <div class="col-md-3">
      <p class="text-center"><strong><font size ="5px">ข้อมูลผู้ป่วย</font></strong></p>
      <a href="HN_patient.php">
        <img src="img/logo14.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>

 <div class="col-md-3">
      <p class="text-center"><strong><font size ="5px">ข้อมูลเจ้าหน้าที่</font></strong></p>
      <a href="user.php">
        <img src="img/logo2.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>

  <div class="col-sm-3">
      <p class="text-center"><strong><font size ="5px">ข้อมูลแผนก</font></strong></p>
      <a href="department.php">
        <img src="img/logo11.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>
    <div class="col-sm-3">
        <p class="text-center"><strong><font size ="5px">ข้อมูลพื้นฐาน</font></strong></p>
        <a href="matandunit.php">
          <img src="img/logo7.png" class="img-circle person" alt="Random Name" width="255" height="255">
        </a>
      </div>

 <div class="col-md-3">
      <p class="text-center"><strong><font size ="5px">ข้อมูลร้านค้า</font></strong></p>
      <a href="insert_restaurant.php">
        <img src="img/logo6.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>


 <div class="col-sm-3">
      <p class="text-center"><strong><font size ="5px">ข้อมูลวัตถุดิบ</font></strong></p>
      <a href="mat.php">
        <img src="img/logo9999.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>


 <div class="col-sm-3">
      <p class="text-center"><strong><font size ="5px">ข้อมูลอาหารทางสายยาง</font></strong></p>
      <a href="feed.php">
        <img src="img/logofeed.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>

  <div class="col-sm-3">
      <p class="text-center"><strong><font size ="5px">ข้อมูลการจัดเมนูอาหาร</font></strong></p>
      <a href="insert_order_menu.php">
        <img src="img/logomenu.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>


  <div class="col-sm-3">
      <p class="text-center"><strong><font size ="5px">การจัดส่งอาหารให้ผู้ป่วย</font></strong></p>
      <a href="patient.php">
        <img src="img/logo10.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>


  <div class="col-sm-3">
      <p class="text-center"><strong><font size ="5px">สั่งซื้อวัตถุดิบ</font></strong></p>
      <a href="insert_buymaterial.php">
        <img src="img/logo8.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>
    <div class="col-sm-3">
        <p class="text-center"><strong><font size ="5px">สั่งซื้ออาหารทางสายยาง</font></strong></p>
        <a href="insert_feed.php">
          <img src="img/logo3.png" class="img-circle person" alt="Random Name" width="255" height="255">
        </a>
      </div>


    <div class="col-sm-3">
      <p class="text-center"><strong><font size ="5px">รายงานการจัดส่งอาหาร</font></strong></p>
      <a href="report.php">
        <img src="img/logo9.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>

    <div class="col-sm-3">
      <p class="text-center"><strong><font size ="5px">สต๊อก</font></strong></p>
      <a href="insert_stock.php">
        <img src="img/logo9.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
    </div>




  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Tickets</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-shopping-cart"></span> Tickets, $23 per person</label>
              <input type="number" class="form-control" id="psw" placeholder="How many?">
            </div>
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Send To</label>
              <input type="text" class="form-control" id="usrname" placeholder="Enter email">
            </div>
              <button type="submit" class="btn btn-block">Pay
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          <p>Need <a href="#">help?</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- <h3 class="text-center">Map</h3>
  <div class="row">
<div class = "col-md-4 col-xs-4"></div>
<div class="col-md-4 col-xs-4" id="googleMap"></div>
</div>

 Add Google Maps
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
var myCenter = new google.maps.LatLng(14.054999, 101.395801);

function initialize() {
var mapProp = {
center:myCenter,
zoom:12,
scrollwheel:false,
draggable:false,
mapTypeId:google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
position:myCenter,
});

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>-->

<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
   <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">นายนนธวัฒน์&nbsp;จันทร์กระจ่าง</a></p>
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
