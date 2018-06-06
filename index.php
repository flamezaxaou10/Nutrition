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
    $user = $_SESSION['Username'];
    if ($user == 'director') {
      for ($i=1; $i <= 17 ; $i++) {
        $menu[$i] = "onclick='return false'"." class='isDisabled'";
      }
      $menu[1] = '';
      $menu[2] = '';
      $menu[3] = '';
      $menu[4] = '';
      $menu[17] = '';
    } else {
      for ($i=1; $i <= 17 ; $i++) {
        $menu[$i] = "";
      }
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
<style media="screen">
  body{
    background-size: 100%;
    background-image:url(img/backg.jpg);
    background-repeat: no-repeat;
    background-attachment : fixed;
  }
  .isDisabled {
    color: currentColor;
    cursor: not-allowed;
    opacity: 0.4;
    text-decoration: none;
    display: inline-block;
  }
</style>
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
             <li align = "center"><a href="matandunit.php">ข้อมูลพื้นฐาน</a></li>
             <li align = "center"><a href="insert_restaurant.php">ข้อมูลร้านค้าวัตถุดิบ</a></li>
             <li align = "center"><a href="mat.php">ข้อมูลวัตถุดิบ</a></li>
             <li align = "center"><a href="feed.php">ข้อมูลอาหารทางสายยาง</a></li>
             <li align = "center"><a href="insert_order_menu.php">ข้อมูลการจัดเมนูอาหาร</a></li>
             <li align = "center"><a href="raw.php">เบิกวัตถุดิบที่ใช้ทำอาหาร</a></li>
             <li align = "center"><a href="patient.php">การสั่งอาหารให้ผู้ป่วย</a></li>
             <li align = "center"><a href="insert_buymaterial.php">สั่งซื้อวัตถุดิบ</a></li>
             <li align = "center"><a href="insert_feed.php">สั่งซื้ออาหารทางสายยาง</a></li>
             <li align = "center"><a href="report.php">รายงานการจัดส่งอาหาร</a></li>
             <li align = "center"><a href="report2.php">รายงานการสั่งอาหาร</a></li>
             <li align = "center"><a href="stockanddetail.php">การรับวัตถุดิบเข้าคลัง</a></li>
             <li align = "center"><a href="sale_feed.php">การขายอาหารทางสายยาง</a></li>
           </ul>


        </li>
        <li><a href=""><span class="glyphicon glyphicon-user"> <? echo $_SESSION["fnname"];?></span></a></li>
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
  <!-- <div class="carousel-inner" role="listbox">
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
</div> -->


<div id="band" class="container text-center">
  <!--<h3>VISIT</h3> -->
<!--  <p><font face = "JasmineUPC" size="5">บริการสุขภาพแบบผสมที่เป็นเลิศ&nbsp;&nbsp;
และเป็นผู้นำด้านการแพทย์แผนไทยในอาเซียน</font></p>-->
<!--  <h3>VALUE</h3>-->
<!--  <p><font face = "JasmineUPC" size="5">อภัยภูเบศร&nbsp;&nbsp;บริการดี&nbsp;&nbsp;มีน้ำใจ&nbsp;&nbsp;ใฝ่เรียนรู้</font></p>-->

<!-- ALL SYSTEM-->
<style media="screen">
  .col-sm-3 {
    height: 120%;
  }
  .col-sm-3:hover{
    border-color: red;
  }
  .person {
    margin-bottom: 0px;
  }
  p {
    font-size: 22px;
  }
  hr {
    border-top: 1px solid black;
  }
</style>
<script type="text/javascript">
    $(document).ready(function(){
      $('#img1').width(83);
      $('#img1').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img1').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img2').width(83);
      $('#img2').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img2').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img3').width(83);
      $('#img3').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img3').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img4').width(83);
      $('#img4').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img4').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img5').width(83);
      $('#img5').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img5').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img6').width(83);
      $('#img6').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img6').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img7').width(83);
      $('#img7').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img7').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img8').width(83);
      $('#img8').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img8').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img9').width(83);
      $('#img9').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img9').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img10').width(83);
      $('#img10').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img10').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img11').width(83);
      $('#img11').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img11').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img12').width(83);
      $('#img12').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img12').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img13').width(83);
      $('#img13').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img13').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img14').width(83);
      $('#img14').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img14').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img15').width(83);
      $('#img15').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img15').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });
    ////////////////////////////////////
    $(document).ready(function(){
      $('#img16').width(83);
      $('#img16').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img16').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });

    ////////////////////////////////////
    $(document).ready(function(){
      $('#img55').width(83);
      $('#img55').mouseover(function()
      {
         $(this).css("cursor","pointer");
         $(this).animate({width: "150px"}, 'slow');
      });

      $('#img55').mouseout(function()
       {
           $(this).animate({width: "103px"}, 'slow');
        });
    });

</script>
  <div class="row">
     <div class="col-sm-3"  >
          <a href="HN_patient.php" <?php echo $menu[1]; ?>>
            <center><img id="img1"  src="img/logo14.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>ข้อมูลผู้ป่วย</strong></p>


        </div>
     <div class="col-sm-3">
          <a href="user.php" <?php echo $menu[2]; ?>  >
            <center><img id="img2"  src="img/logo2.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>ข้อมูลเจ้าหน้าที่</strong></p>
      </div>

      <div class="col-sm-3"  >
          <a href="department.php" <?php echo $menu[3]; ?> >
            <center><img id="img3"  src="img/logo11.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>ข้อมูลแผนก</strong></p>
      </div>
        <div class="col-sm-3"  >
            <a href="matandunit.php" <?php echo $menu[4]; ?> >
              <center><img id="img4"  src="img/logo7.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
            </a>
            <p class="text-center"><strong>ข้อมูลพื้นฐาน</strong></p>
        </div>
      </div>
      <hr>
    <div class="row">
     <div class="col-sm-3">
          <a href="insert_restaurant.php" <?php echo $menu[5]; ?> >
            <center><img id="img5"  src="img/logoshop.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>ข้อมูลร้านค้า</strong></p>
      </div>
     <div class="col-sm-3">
          <a href="mat.php" <?php echo $menu[6]; ?> >
            <center><img id="img6"  src="img/logo9999.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>ข้อมูลวัตถุดิบ</strong></p>
      </div>
     <div class="col-sm-3">
          <a href="feed.php" <?php echo $menu[7]; ?>>
            <center><img id="img7"  src="img/logofeed.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>ข้อมูลอาหารทางสายยาง</strong></p>
      </div>

      <div class="col-sm-3">
          <a href="insert_order_menu.php" <?php echo $menu[8]; ?> >
            <center><img id="img8"  src="img/logomenu.png" class="img-circle person" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>จัดรายการอาหาร</strong></p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-3">
        <a href="raw.php" <?php echo $menu[9]; ?> >
          <center><img id="img9" src="img/make01.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
        </a>
        <p class="text-center"><strong>เบิกวัตถุดิบที่ใช้ทำอาหาร</strong></p>
      </div>

      <div class="col-sm-3">
          <a href="patient.php" <?php echo $menu[10]; ?> >
            <center><img id="img10" src="img/logo10.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>สั่งอาหารให้ผู้ป่วย</strong></p>
      </div>


      <div class="col-sm-3">
          <a href="insert_buymaterial.php" <?php echo $menu[11]; ?>>
          <center>  <img id="img11" src="img/logobuy.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>สั่งซื้อวัตถุดิบ</strong></p>
        </div>

        <div class="col-sm-3">
            <a href="insert_feed.php" <?php echo $menu[12]; ?>>
              <center><img id="img12" src="img/logo3.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
            </a>
            <p class="text-center"><strong>สั่งซื้ออาหารทางสายยาง</strong></p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-3">
          <a href="report.php" <?php echo $menu[13]; ?>>
            <center><img id="img13" src="img/logo9.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>รายงานการจัดส่งอาหาร</strong></p>
        </div>

        <div class="col-sm-3">
          <a href="report2.php" <?php echo $menu[14]; ?>>
            <center><img id="img14" src="img/logoss.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>รายงานการสั่งอาหาร</strong></p>
        </div>

        <div class="col-sm-3">
          <a href="stockanddetail.php" <?php echo $menu[15]; ?>>
            <center><img id="img15" src="img/logo_stock.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>การรับวัตถุดิบเข้าคลัง</strong></p>
        </div>

        <div class="col-sm-3">
          <a href="sale_feed.php" <?php echo $menu[16]; ?>>
            <center><img id="img16" src="img/logosell.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
          </a>
          <p class="text-center"><strong>ขายอาหารทางสายยาง</strong></p>
        </div>
      </div>

        <hr>
      <div class="row">
       <div class="col-sm-3">
            <a href="report_all.php" <?php echo $menu[17]; ?>>
              <center><img id="img55"  src="img/graph.png" class="img-circle person img-responsive" alt="Random Name" width="" height=""></center>
            </a>
            <p class="text-center"><strong>รายงานสรุป</strong></p>
        </div>
      </div>
      <hr>
  <div class="row">

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
<div class = "col-md-4 col-sm-4"></div>
<div class="col-md-4 col-sm-4" id="googleMap"></div>
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
