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

			<p>ข้อมูลเจ้าหน้าที่</p>
<form method="post" action=#>
			<label for="department">&nbsp;ค้นหาจากชื่อ - นามสกุล : </label> <input type="text" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}" name="sen" >
			<!--<input type="hidden" name="selected_text" id="selected_text" value="" />-->

			  <input type="submit" name = "search" class="btn btn-success" value="ค้นหา">
</form>
			<!--<input type="submit" name="search" value="Search"/>-->
		</div>
</div>
<?php
if(isset($_POST['search']))
{
$sen=$_POST['sen'];

}

 ?>
<div class="container">
<?php
@include('conn.php');
$perpage = 120;
if (isset($_GET['page']) && $_GET['page'] != 0) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$start = ($page - 1) * $perpage;
$strSQL = "SELECT * FROM `sys_user` WHERE concat(fname,lname) like '%$sen%' LIMIT {$start},{$perpage}";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
$num=mysql_num_rows($objQuery);
if($num==0){
  echo"<script language=\"JavaScript\">";

echo"alert('ไม่พบข้อมูล')";

echo"</script>";
echo( "<script>window.location='user.php';</script>");
}

?>
<table class="table table-striped table-bordered">
	<tr class="warning">
		<th><div align="center">ชื่อผู้ใช้</div></th>

    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>


	</tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
	# code...
?>
	<tr class ="info">
	<td><div align = "center"><?php echo $objReSult["username"];?></div></td>

  <td><div align = ""><?php echo $objReSult["fname"];?></div></td>
  <td><div align = ""><?php echo $objReSult["lname"];?></div></td></tr>
<!--	<td><div align = "center"><?php if($objReSult["sex"]==1) echo "ชาย";else if($objReSult["sex"]==2) echo "หญิง";else echo "NULL";?></div></td>
</tr>-->
	<?
}
?>
</table>
<?php
	$sql2 = "SELECT * FROM sys_user";
	$query2 = mysql_query($sql2, $connect1);
	$total_record = mysql_num_rows($query2);
	$total_page = ceil($total_record / $perpage);
 ?>
<nav align="center" aria-label="Page navigation example">
	<ul class="pagination">
		<li class="page-item"><a class="page-link" href="user.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
		<?php for($i=1;$i<=$total_page;$i++){ ?>
		 <li><a href="user.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php } ?>
		<li class="page-item"><a class="page-link" href="user.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true">>></span></a></li>
	</ul>
</nav>
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
