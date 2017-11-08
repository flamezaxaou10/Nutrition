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

<br>
<div class="container">
		<div class="jumbotron">


<!DOCTYPE HTML>
<html>
<head>
<body>
<form method="post" action="#" >


<table>
<?php
$flag=0;
if(isset($_POST['submit'])){
	$idfood  = $_POST['idfood'];
	$name = $_POST['name'];
	$id = $_POST['id'];
	@include('conn.php');
	$strSQL = "SELECT * FROM type_food WHERE id <> '$id'";
	$objQuery = mysql_query($strSQL, $connect1);
	while ($objReSult = mysql_fetch_array($objQuery)) {
	 $gname= $objReSult["type_name"];
	 if($gname==$name){
		 $flag=1;
	 }
}
if($flag==0){
	$insert = "UPDATE type_food  SET  type_name='".$name."' WHERE id_type='".$idfood."'";
	$result  = mysql_query($insert, $connect1);
	echo " <script>

			location='typefood.php';

	</script>";
	if(!$result){
		die('ไม่สามารแก้ไขข้อมูลได้ เกิดข้อผิดพลาดบางประการ'.mysql_error());
	}
}
}
?>
<p align="left">แก้ไขข้อมูลประเภทอาหาร</p>
<div class="modal-body">
<input type='hidden' name='id' value='<? echo $sql['id'];?>'>

      <h4> รหัสประเภทอาหาร :&nbsp;&nbsp;<input type='text' name ='idfood' required value='<? echo $_GET['id'];?>' readonly></td></tr>
</h4>
      <h4> ชื่อประเภทอาหาร  &nbsp;&nbsp;: &nbsp;<input type='text' name ='name' required value='<? echo $_GET['id2'];?>' onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"></td></tr><font color="red"> &nbsp;*</font><?php if($flag==1)echo "<font color=red>ชื่อนี้มีในระบบแล้ว</font>"; ?></h5>



</div>
</div>
</table><br>
<div class="modal-footer">
	<input type="submit" class="btn btn-success" name="submit" value="แก้ไขข้อมูล" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')">&nbsp;&nbsp;
	<a href="typefood.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไข?')">ยกเลิก</button>

</a></div>
</div>
	</form>

  <?php
@include('conn.php');
$strSQL = "SELECT * FROM type_food";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
?>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสประเภทอาหาร</div></th>
    <th><div align="center">ชื่อประเภทอาหาร</div></th>
    <!--<th><div align="center">แก้ไข</div></th> -->

  </tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["id_type"];?></div></td>
  <td><div align = "left"><? echo $objReSult["type_name"];?></div></td>

    </tr>
  <?
}

?>

</body>
</html>

<!--<div class="modal-footer">
        <input type="submit" onclick="submitModal()" name="submit" class="btn btn-success" value = "ตกลง">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>-->
