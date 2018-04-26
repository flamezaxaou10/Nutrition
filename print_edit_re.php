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
  $date=$_POST['daytime'];
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
<?php
$p=$_POST["print"]+1;
 ?>
      <H3>ข้อมูลเมนูอาหาร</H3>
      <br />
      <h5 align=right>พิมพ์ครั้งที : <?php echo $p ;?></h5>
      <div style="float:left; font-size: 1.3em;">วันที่</div><div style="float:left; font-size: 1.3em;">&nbsp;
      <?php


         $strDate=$_POST['daytime'];
           $strYear = date("Y",strtotime($strDate))+543;
           $strMonth= date("n",strtotime($strDate));
           $strDay= date("j",strtotime($strDate));
           $strDays= date("l",strtotime($strDate));
           $strDayCut = Array("Monday"=>"วันจันทรที่","Tuesday"=>"วันอังคารที่","Wednesday"=>"วันพุธที่","Thursday"=>"วันพฤหัสบดีที่","Friday"=>"วันศุกรที่","Saturday"=>"วันเสารที่","Sunday"=>"วันอาทิตย์ที่");
           $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
           $strMonthThai=$strMonthCut[$strMonth];
           $strDaysThai = $strDayCut[$strDays];
           $date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;
  ?>
      <? echo $date;?></div>
      <br />
      <br />
      <div style="float:left; font-size: 1.3em;">เจ้าหน้าที่</div><div style="float:left; font-size: 1.3em;">&nbsp;
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
              <th><div align="center">มื้ออาหาร</th><th><div align="center">ประเภทอาหาร</th><th><div align="center">พิเศษ</th><th><div align="center">สามัญ</th><th><div align="center">เจ้าหน้าที่</th><br />
            </tr>
            <tr class ="info">
              <td align="center"><b>เช้า</td>
              <td></td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box1);$i++ ){
                              echo "<h5>".$check_box1[$i]."</h5>";
                              $m1=$m1.$check_box1[$i];
                              if($i<sizeof($check_box1)-1){
                                $m1=$m1." ";
                              }

                          }

                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box2);$i++ ){
                              echo "<h5>".$check_box2[$i]."</h5>";
                              $m2=$m2.$check_box2[$i];
                              if($i<sizeof($check_box2)-1){
                                $m2=$m2." ";
                              }

                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box3);$i++ ){
                              echo "<h5>".$check_box3[$i]."</h5>";
                              $m3=$m3.$check_box3[$i];
                              if($i<sizeof($check_box3)-1){
                                $m3=$m3." ";
                              }
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
                              $m4=$m4.$check_box4[$i];
                              if($i<sizeof($check_box4)-1){
                                $m4=$m4." ";
                              }
                          }
                        ?></td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box5);$i++ ){
                              echo "<h5>".$check_box5[$i]."</h5>";
                              $m5=$m5.$check_box5[$i];
                              if($i<sizeof($check_box5)-1){
                                $m5=$m5." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box6);$i++ ){
                              echo "<h5>".$check_box6[$i]."</h5>";
                              $m6=$m6.$check_box6[$i];
                              if($i<sizeof($check_box6)-1){
                                $m6=$m6." ";
                              }
                          }
                        ?></td>
            </tr>
            <tr class ="info">
              <td align="center"><b>อ่อน</td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box7);$i++ ){
                              echo "<h5>".$check_box7[$i]."</h5>";
                              $m7=$m7.$check_box7[$i];
                              if($i<sizeof($check_box7)-1){
                                $m7=$m7." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box8);$i++ ){
                              echo "<h5>".$check_box8[$i]."</h5>";
                              $m8=$m8.$check_box8[$i];
                              if($i<sizeof($check_box8)-1){
                                $m8=$m8." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box9);$i++ ){
                              echo "<h5>".$check_box9[$i]."</h5>";
                              $m9=$m9.$check_box9[$i];
                              if($i<sizeof($check_box9)-1){
                                $m9=$m9." ";
                              }
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
                              $m10=$m10.$check_box10[$i];
                              if($i<sizeof($check_box10)-1){
                                $m10=$m10." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box11);$i++ ){
                              echo "<h5>".$check_box11[$i]."</h5>";
                              $m11=$m11.$check_box11[$i];
                              if($i<sizeof($check_box11)-1){
                                $m11=$m11." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box12);$i++ ){
                              echo "<h5>".$check_box12[$i]."</h5>";
                              $m12=$m12.$check_box12[$i];
                              if($i<sizeof($check_box12)-1){
                                $m12=$m12." ";
                              }
                          }
                        ?></td>
            </tr>
            <tr class ="info">
              <td align="center"><b>อ่อน</td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box13);$i++ ){
                              echo "<h5>".$check_box13[$i]."</h5>";
                              $m13=$m13.$check_box13[$i];
                              if($i<sizeof($check_box13)-1){
                                $m13=$m13." ";
                              }
                          }
                        ?></td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box14);$i++ ){
                              echo "<h5>".$check_box14[$i]."</h5>";
                              $m14=$m14.$check_box14[$i];
                              if($i<sizeof($check_box14)-1){
                                $m14=$m14." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box15);$i++ ){
                              echo "<h5>".$check_box15[$i]."</h5>";
                              $m15=$m15.$check_box15[$i];
                              if($i<sizeof($check_box15)-1){
                                $m15=$m15." ";
                              }
                          }
                        ?></td>
            </tr>
          </table>
          <h4>หมายเหตุ</h4>&nbsp;&nbsp;
          <?php echo $deta;?>
        </form>
        </div>
<?php
$strSQL = "SELECT * FROM detailmenu";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");

while ($objReSult = mysql_fetch_array($objQuery)) {
# code...

}


$insert = "UPDATE detailmenu SET print='$p', mspec='$m1',msta='$m2',maut='$m3',lpspec='$m4',lpsta='$m5',lpaut='$m6',lsspec='$m7',lssta='$m8',lsaut='$m9',epspec='$m10',epsta='$m11',epaut='$m12',esspec='$m13',essta='$m14',esaut='$m15',comment='$deta' WHERE dm_date='$date' ";
      $query = mysql_query($insert,$connect1);


if(!$insert){
  echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิิดพลาดบางประการ');
      </script>");
}
 ?>

    </div>
   </div>
   <p style="text-align:right;">
     <button class="btn btn-success" OnClick="prints('print_table');">พิมพ์ใบสั่งอาหาร</button>
     <button class="btn btn-danger" >ย้อนกลับ</button>
   </p>
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
<script type="text/javascript">
  function prints(divName) {
    var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;

   document.body.innerHTML = printContents;

   window.print();

   document.body.innerHTML = originalContents;
   location.reload();
  }
</script>





</body>
</html>
