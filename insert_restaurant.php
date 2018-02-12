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
<?php
if(isset($_POST['submit'])){
	$aa=$_POST['res_id'];
	$bb=$_POST['res_name'];
	$cc=$_POST['id_name'];
	$dd=$_POST['res_phone'];
	$ee=$_POST['phone'];
	$ff=$_POST['res_address'];
	$gg=$_POST['type'];
	@include('conn.php');
	$strSQL = "SELECT * FROM restaurant";
	$objQuery = mysql_query($strSQL, $connect1);
	$error=0;
	while ($objReSult = mysql_fetch_array($objQuery)) {
	 $result= $objReSult["res_name"];
	 if($_POST['res_name']==$result){
		 $error=1;
	 }
	}
  @include('conn.php');
	if($error==0){

  $insert = "INSERT INTO restaurant  VALUES  ('".$_POST['res_id']."','".$_POST['res_name']."','".$_POST['id_name']."','".$_POST['res_phone']."','".$_POST['phone']."','".$_POST['res_address']."','".$_POST['type']."')";
  		  $query = mysql_query($insert,$connect1);
            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');
  		  </script>");


  if(!$insert){
  	echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
  		</script>");
  }
	$aa=$bb=$cc=$dd=$ee=$ff=$gg="";
}
}
@include('conn.php');
$strSQL = "SELECT MAX(res_id) FROM restaurant  ORDER BY res_name";
$objQuery = mysql_query($strSQL, $connect1);
while ($objReSult = mysql_fetch_array($objQuery)) {
 $result= $objReSult["MAX(res_id)"];
 $ina="";
   for($a=0;$a<Strlen($result);$a++){
   if($a>=2)$ina =$ina.intval($result[$a])  ;
   }
   $id= "res-".sprintf("%04d", $ina+1);

?>
<option value="<? echo $objReSult["clinic"];?>" <? echo $sel; ?> > <? echo $objReSult["clinicdescribe"];?></option>
<?php
}
?>
      <p>ข้อมูลร้านค้า</p>
<table><form method="post" action="#" >
            <div class="modal-body">
            <input type='hidden' name='id' value=''>
              <tr>
								<td style="width:12%"><h4> รหัสร้านค้า </td>
								<td style="width:40%"><h4>: <input type="text" name ='res_id' readonly value='<?php echo $id ; ?>'></h4></td>
								<td style="width:12%"><h4> ชื่อร้านค้า  </td>
								<td><h4>: <input type='text' name ='res_name' required value="<?php echo $bb; ?>" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}" ><font color="red"> &nbsp;*</font><?php if($error==1)echo "<font color=red>ชื่อร้านนี้มีอยู่ในระบบแล้ว</font>"; ?></h4></td>
							</tr>
              <tr>
								<td><h4> ชื่อผู้ติดต่อ  </td>
								<td><h4>: <input type='text' name ='id_name' required value="<?php echo $cc; ?>" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"><font color="red"> &nbsp;*</font></h4></td>
								<td><h4> โทรศัพท์  </td>
								<td><h4>: <input type='text' name ='res_phone'  value="<?php echo $dd; ?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"/><font color="red"> &nbsp;*</font></h4></td>
							</tr>
              <tr>
								<td><h4> มือถือ  </td>
								<td><h4>: <input type='tel' name ='phone' required value="<?php echo $ee; ?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"><font color="red"> &nbsp;*</font></h4></td>
								<td><h4 align="left"> ประเภทร้านค้า  </td>
								<td>
									<h4>:
									<select name="type" required>
										<option value="" disabled selected>--------โปรดเลือกประเภทร้านค้า-------</option>
	                    <?php
	                      $i = 0;
	                      $strSQL = "SELECT * FROM typestore ";
	                      $objQuery = mysql_query($strSQL, $connect1);
	                      while ($objReSult = mysql_fetch_array($objQuery)) {
	                      ?>
										     <option value="<?php echo $objReSult['type_id'];?>" <?php if($gg==1) echo "selected"; ?>><?php echo $objReSult['type_name'];?></option>
	                      <?php $i++;
	                      }?>
									</select><font color="red"> &nbsp;*</font></h4>
								</td>
							</tr>
              <tr>
								<td><h4 align="left"> ที่อยู่ : </td>
								<td>
                	<textarea class="form-control" rows="3" id="detail" name="res_address" required data-validation="required"><?php echo $ff; ?></textarea></h4>
              	</td>
							</tr>
						</table>
						<div class="modal-footer text-right">
	  					<input type="submit" name="submit" class="btn btn-success" value="เพิ่มข้อมูล" >&nbsp;&nbsp;&nbsp;&nbsp;
	  					<a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้ห?')">ยกเลิก</button></a>
					</form>

						</div>
          </div>

		<form method="post" action="#" class="text-right">
			<font color=white> ค้นหาจากชื่อร้านค้า : </font></label> <input type="text" name="sen" >
		   <input type="submit" class="btn btn-success" name="submit2" value="ค้นหา">
		</form>

		<?php
		@include('conn.php');
		$perpage = 20;
		if (isset($_GET['page']) && $_GET['page'] != 0) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
		$start = ($page - 1) * $perpage;
		$see=$_POST["sen"];
		$strSQL = "SELECT * FROM restaurant a join typestore b on a.type=b.type_id where res_name like '%$see%' order by res_id LIMIT {$start},{$perpage}";
		$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
		$num=mysql_num_rows($objQuery);
		if($num==0){
		  echo"<script language=\"JavaScript\">";

		echo"alert('ไม่พบข้อมูล')";

		echo"</script>";
		//echo( "<script>window.location='insert_restaurant.php';</script>");
		}
		?>
<br>
<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสร้านค้า</div></th>
    <th><div align="center">ชื่อร้านค้า</div></th>
    <th ><div align="center">ชื่อผู้ติดต่อ</div></th>
    <th><div align="center">โทรศัพท์</div></th>
		<th ><div align="center">ที่อยู่</div></th>
		<th ><div align="center">ประเภทร้านค้า</div></th>
		<th><div align="center">แก้ไขข้อมูล</div></th>
		<th><div align="center">ลบข้อมูล</div></th>
  </tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["res_id"];?></div></td>
  <td><div align = "left"><? echo $objReSult["res_name"];?></div></td>
	<td><div align = "left"><? echo $objReSult["shopkeeper"];?></div></td>
	<td><div align = "left"><? if(!empty($objReSult["res_tel"]))echo "ร้าน :".$objReSult["res_tel"]."<br>";?>
		<? if(!empty($objReSult["res_telkeeper"]))echo "มือถือ :".$objReSult["res_telkeeper"]."<br>";?>
	</div></td>
	<td><div align = "left"><? echo $objReSult["address"];?></div></td>
	<td><div align = "left"><? echo $objReSult["type_name"];?></div></td>
  <td><div align = "center"><a href="edit_res.php?id=<? echo $objReSult['res_id'];?>&id1=<? echo $objReSult['type_name'];?>" ><b><font color="blue"><img src='img/edit.png' width=25></font></font></b></a></td>

  <td><div align = "center"><a href='delete_res.php?id=<? echo $objReSult['res_id'];?>'
  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></font></b></a></td>
    </tr>
  <?
}

?>
</table>
<?php
	$sql2 = "SELECT * FROM restaurant";
	$query2 = mysql_query($sql2, $connect1);
	$total_record = mysql_num_rows($query2);
	$total_page = ceil($total_record / $perpage);
 ?>
<nav align="center" aria-label="Page navigation example">
	<ul class="pagination">
		<li class="page-item"><a class="page-link" href="insert_restaurant.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
		<?php for($i=1;$i<=$total_page;$i++){ ?>
		 <li><a href="insert_restaurant.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php } ?>
		<li class="page-item"><a class="page-link" href="insert_restaurant.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true">>></span></a></li>
	</ul>
</nav>
</div>
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">นายนนธวัฒน์  จันทร์กระจ่าง</a></p>
</footer>

</div>
<!DOCTYPE HTML>
<html>
<head>
<body>
<center>



<!--<div class="modal-body">
<input type='hidden' name='id' value=''>
  <h4 align="left"> รหัสร้านค้า : <input type='text' name ='res_id' required value=''></td></tr></h4>
  <h4 align="left"> ชื่อร้านค้า  &nbsp;: &nbsp;<input type='text' name ='res_name' required value=''></td></tr></h4>
  <h4 align="left"> ที่อยู่  &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type='text' name ='res_address' required value=''></td></tr></h4>


</div>-->





	</form>

</body>
</html>

<!--<div class="modal-footer">
        <input type="submit" onclick="submitModal()" name="submit" class="btn btn-success" value = "ตกลง">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>-->
