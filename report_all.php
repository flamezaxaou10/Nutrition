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

    </script>



<div class="container" style="height:85vh;">
    <div class="jumbotron">
       <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
       <br>
      <p><h3>รายงานสรุป</h3></p>

  <div class="modal-body">
    <table align=center>
      <tr>
        <td align=center style="width:20%;"><a href="reportmat.php"><img id="img1" src="img/report_mat.png" class="img-responsive" width=80 height=80></a></td>
        <td align=center style="width:20%;"><a href="reportres.php"><img id="img2" src="img/report_buy.png" class="img-responsive" width=80 height=80></a></td>
        <td align=center style="width:20%;"><a href="reportsell.php"><img id="img3" src="img/report_sell.png" class="img-responsive" width=80 height=80></a></td>

      </tr>
      <tr>
        <td align=center><strong><h4>รายงานสรุปการใช้วัตถุดิบตามช่วงเวลา</h4></strong></td>
        <td align=center><strong><h4>รายงานสรุปการสั่งซื้อวัตถุดิบจากร้านค้าตามช่วงเวลา</h4></strong></td>
        <td align=center><strong><h4>รายสรุปยอดขายอาหารทางสายยาง</h4></strong></td>

      </tr>
    </table>
  </div>
 </div>
</div>


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
<?php include 'footer.php' ?>
