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
if(isset($_POST['submit'])) {

  $sql  = "update `cpa`.`restaurant` set `res_name`='".$_POST['res_name']."',`shopkeeper`='".$_POST['id_name']."',`res_tel`='".$_POST['res_phone']."',`res_tel`='".$_POST['res_phone']."',`res_telkeeper`='".$_POST['phone']."',`address`='".$_POST['res_address']."',`type`='".$_POST['type']."' where res_id = '".$_POST['res_id']."'";
  $result  = mysql_query($sql);
  if(!$result){
    die('ไม่สามารแก้ไขข้อมูลได้ เกิดข้อผิิดพลาดบางประการ'.mysql_error());
  }
  else {
    echo "<script>

    		location='insert_restaurant.php';

    </script>";
  }

}


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
$gid=$_GET['id'];
	$sql = "SELECT * FROM restaurant WHERE res_id ='$gid'";
	$query = mysql_query($sql,$connect1);
	while($sql  = mysql_fetch_array($query))
	{
	?>

<p align="left">แก้ไขข้อมูลร้านค้าวัตถุดิบ</p>
<table>
            <div class="modal-body">
            <input type='hidden' name='id' value=''>
              <tr><td width=150><h4 align="left"> รหัสร้านค้า </td><td width=700><h4>: <input type="text" name ='res_id' readonly value="<?php echo $sql["res_id"] ; ?>"></td></tr></h4>
              <tr><td><h4 align="left"> ชื่อร้านค้า  </td><td><h4>: <input type='text' name ='res_name'  readonly required value="<?php echo  $sql["res_name"] ; ?>" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}" ><font color="red"> &nbsp;*</font></td></tr></h4>
              <tr><td><h4 align="left"> ชื่อผู้ติดต่อ  </td><td><h4>: <input type='text' name ='id_name' required value="<? echo $sql["shopkeeper"];?>" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}" ><font color="red"> &nbsp;*</font></td></tr></h4>
              <tr><td><h4 align="left"> โทรศัพท์  </td><td><h4>: <input type='tel' name ='res_phone' required value="<? echo $sql["res_tel"];?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"><font color="red"> &nbsp;*</font></td></tr></h4>
              <tr><td><h4 align="left"> มือถือ  </td><td><h4>: <input type='tel' name ='phone'  value="<? echo $sql["res_telkeeper"];?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"><font color="red"> &nbsp;*</font></td></tr>
								<tr><td><h4 align="left"> ประเภทร้านค้า </td><td><h4> : <select id="type" name="type"   onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
							  	<option value="">< ----- โปรดเลือก ----- > </option>

							 <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM typestore ";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                       <option value="<?php echo $objReSult['type_id'];?>" <?php if($_GET['id1']==$objReSult['type_name']) echo "selected"; ?>><?php echo $objReSult['type_name'];?></option>
                      <?php $i++;
                      }?>

						</select><font color="red"> &nbsp;*</font></td></tr></h4>
              <tr><td><h4 align="left"> ที่อยู่ : </td><td>

              <textarea class="form-control" rows="3" id="detail" name="res_address" required data-validation="required"><? echo $sql["address"];?></textarea>
              </td></tr></h4>
              <tr><td colspan=2><br> <div class="modal-footer">
								<input type="submit" name="submit" class="btn btn-success" value="แก้ไขข้อมูล" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')">&nbsp;&nbsp;
            	<a href="insert_restaurant.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไขข้อมูลนี้?')">ยกเลิก</button>
              </td></tr>
              </div>

</a></td></tr>
</table></form>
<?
	}
?>

</div>
<?php
@include('conn.php');
$strSQL = "SELECT * FROM restaurant a join typestore b on a.type=b.type_id where res_name like '%$see%' order by res_id";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
?>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสร้านค้า</div></th>
    <th><div align="center">ชื่อร้านค้า</div></th>
    <th ><div align="center">ชื่อผู้ติดต่อ</div></th>
    <th><div align="center">โทรศัพท์</div></th>
    <th ><div align="center">ที่อยู่</div></th>
    <th ><div align="center">ประเภทร้านค้า</div></th>

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

    </tr>
    </tr>
  <?
}

?>
</table>
</div>


</div>
</div>
</table><br>


</body>
</html>

<!--<div class="modal-footer">
        <input type="submit" onclick="submitModal()" name="submit" class="btn btn-success" value = "ตกลง">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>-->
