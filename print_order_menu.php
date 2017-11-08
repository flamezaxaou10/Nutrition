<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
include 'header.php';
?>
<?php

?>
<?php
  $check_box1 = $_POST['check_list1'];
  $check_box2 = $_POST['check_list2'];
  $check_box3 = $_POST['check_list3'];
  $check_box4 = $_POST['check_list4'];
  $check_box5 = $_POST['check_list5'];
  $check_box6 = $_POST['check_list6'];
  $check_box7 = $_POST['check_list7'];
  $check_box8 = $_POST['check_list8'];
  $check_box9 = $_POST['check_list9'];
  $check_box10 = $_POST['check_list10'];
  $check_box11 = $_POST['check_list11'];
  $check_box12 = $_POST['check_list12'];
  $check_box13 = $_POST['check_list13'];
  $check_box14 = $_POST['check_list14'];
  $check_box15 = $_POST['check_list15'];
  $deta = $_POST['deta'];
?>

<div class="container">
    <div class="jumbotron">
      <div id="print_table">
       <br />

      <H3>ข้อมูลเมนูอาหาร</H3>
      <br />
      <div style="float:left; font-size: 1.5em;">วันที่</div><div style="float:left; font-size: 1.5em;">&nbsp;
      <?php
      @include('conn.php');
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
      <? echo $dayy." ".$mon." ".$year;?></div>
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
      <form method="post" action="#">
      <div id="print_table">
          <table class="table table-striped table-bordered" border="1" width="100%">
            <tr class="warning">
              <th></th><th></th><th><div align="center">พิเศษ</th><th><div align="center">สามัญ</th><th><div align="center">เจ้าหน้าที่</th><br />
            </tr>
            <tr class ="info">
              <td align="center"><b>เช้า</td>
              <td></td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box1);$i++ ){
                              echo "<h5>".$check_box1[$i]."</h5>";
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box2);$i++ ){
                              echo "<h5>".$check_box2[$i]."</h5>";
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box3);$i++ ){
                              echo "<h5>".$check_box3[$i]."</h5>";
                          }
                        ?></td>
            </tr>
            <tr class ="info">
              <td rowspan="2" align="center"><b>กลางวัน</td>
              <td align="center"><b>ธรรมดา</td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box4);$i++ ){
                              echo "<h5>".$check_box4[$i]."</h5>";
                          }
                        ?></td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box5);$i++ ){
                              echo "<h5>".$check_box5[$i]."</h5>";
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box6);$i++ ){
                              echo "<h5>".$check_box6[$i]."</h5>";
                          }
                        ?></td>
            </tr>
            <tr class ="info">
              <td align="center"><b>อ่อน</td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box7);$i++ ){
                              echo "<h5>".$check_box7[$i]."</h5>";
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box8);$i++ ){
                              echo "<h5>".$check_box8[$i]."</h5>";
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box9);$i++ ){
                              echo "<h5>".$check_box9[$i]."</h5>";
                          }
                        ?></td>
            </tr>
            <tr class ="info">
              <td td rowspan="2" align="center"><b>เย็น</td>
              <td align="center"><b>ธรรมดา</td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box10);$i++ ){
                              echo "<h5>".$check_box10[$i]."</h5>";
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box11);$i++ ){
                              echo "<h5>".$check_box11[$i]."</h5>";
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box12);$i++ ){
                              echo "<h5>".$check_box12[$i]."</h5>";
                          }
                        ?></td>
            </tr>
            <tr class ="info">
              <td align="center"><b>อ่อน</td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box13);$i++ ){
                              echo "<h5>".$check_box13[$i]."</h5>";
                          }
                        ?></td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box14);$i++ ){
                              echo "<h5>".$check_box14[$i]."</h5>";
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box15);$i++ ){
                              echo "<h5>".$check_box15[$i]."</h5>";
                          }
                        ?></td>
            </tr>
          </table>
          <h4>หมายเหตุ</h4>&nbsp;&nbsp;
          <?php echo $deta;?>
        </form>
        </div>


    </div>
   </div>
   <p style="text-align:center;"><button class="btn btn-success" OnClick="printTable('print_table');">พิมพ์ใบสั่งอาหาร</button></p>
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
