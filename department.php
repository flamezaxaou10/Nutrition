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
	 <br>
      <!-- <h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->

      <p>ข้อมูลแผนก</p>
      <form method="post" action="#">
       <label for="department">&nbsp; ค้นหาจากชื่อแผนก : </label>&nbsp;<input type="text" name="sen" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}" > <input type="submit" name = "search" class="btn btn-success" value="ค้นหา">
		</div></form>
</div>
<div class="container">
<?php
if(isset($_POST['search']))
{
$sen=$_POST['sen'];

}
@include('conn.php');
   $strSQL = "SELECT DISTINCT clinic, clinicdescribe FROM fpatient_info where clinicdescribe like '%$sen%'";
$objQuery = mysql_query($strSQL,$connect2) or die("Error Query [".$strSQL."]");
$num=mysql_num_rows($objQuery);
if($num==0){
  echo"<script language=\"JavaScript\">";

echo"alert('ไม่พบข้อมูล')";

echo"</script>";
echo( "<script>window.location='department.php';</script>");
}
?>
<table class="table table-striped table-bordered">
	<tr class="warning">
		<th><div align="center">รหัสแผนก</div></th>
		<th><div align="center">ชื่อแผนก</div></th>

	</tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
	# code...
?>
	<tr class ="info">
	<td><div align = "center"><?php echo $objReSult["clinic"];?></div></td>
	<td><div><? echo $objReSult["clinicdescribe"];?></div></td>
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
