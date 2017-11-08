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

<div class="container">
    <div class="jumbotron">
       <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
       <br>
      <p><h3>จัดการข้อมูลพื้นฐาน</h3></p>

  <div class="modal-body">
<table align=center>
  <tr>
    <td align=center width=300><strong><h4>จัดการข้อมูลประเภทอาหาร</h4></strong></td>
    <td align=center width=300><strong><h4>จัดการข้อมูลหน่วยนับ</h4></strong></td>
  </tr>
  <tr>
    <td align=center>
<a href="typefood.php"><img src="img/typefood.png" width=180 height=180></a></td><td align=center><a href="unit.php"><img src="img/logo997.png" width=180 height=180></a></td></tr>


<tr>
  <td align=center width=300><br /><strong><h4>จัดการข้อมูลเมนูอาหาร</h4></strong></td>
  <td align=center width=300><br /><strong><h4>จัดการข้อมูลประเภทร้านค้า</h4></strong></td>
</tr>
<tr>
    <td align=center>
<a href="insert_menu.php"><img src="img/logomenu1.png" width=180 height=180></a></td><td align=center><a href="typestore.php"><img src="img/logores.png" width=180 height=180></a>
    </td>
</tr>
<tr>
  <td align=center width=300><br><strong><h4>ประเภทวัตถุดิบ</h4></strong></td>
</tr>
<tr>
  <td align=center>
      <a href="insert_stock.php"><img src="img/logo_stock1.png" width=180 height=180></a></td>
</tr>



</div>
 </div>
  </div>
</table>



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
