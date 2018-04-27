<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{


header('location:login.php');
exit();
}
$username=$_SESSION["Username"];
include 'header.php';
?>

<div class="container">
		<div class="jumbotron">
			<?php
			@include('conn.php');
      $id=$_GET['id'];
      $id2=$_GET['id2'];

			$strSQL = "SELECT * FROM detail_buymat WHERE id_detail='$id'";
			$objQuery = mysql_query($strSQL, $connect1);
			while ($objReSult = mysql_fetch_array($objQuery)) {
			$matname=$objReSult["mat_name"];
      $count=$objReSult["count"];
      $unit=$objReSult["unit"];
      $price=$objReSult["price"];

			}
			 ?>
			 <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
      <br>
      <p>แก้ไขการสั่งซื้อวัตถุดิบ</p>
            <?php
              if(isset($_POST['submit'])){
              $idd=$_POST['idd'];
              $namemat=$_POST['namemat'];
              $count=$_POST['count'];
              $unit=$_POST['unit'];
              $price=$_POST['price'];
							$matid=$_POST['matid2'];

              @include('conn.php');
              $sql  = "update `cpa`.`detail_buymat` set `mat_id`='".$matid."',`count`='".$count."',`unit_id`='".$unit."',`price`='".$count*$price."',`balance`='".$count."' where id_detail = '".$id."'";

							$result  = mysql_query($sql);
              if(!$result){
                die('ไม่สามารแก้ไขข้อมูลได้ เกิดข้อผิิดพลาดบางประการ'.mysql_error());
              }
              else {
                echo "<script>

                    location='select_buymat.php?id=$idd';

                </script>";
              }


            }

             ?>
            <div class="modal-body">


              <form method="post" action="#">
                <table>
                  <tr><td><h4>รหัสรายละเอียดการสั่งซื้อ </td><td><h4> :  <?php echo $id ?></h4></td></tr>
                  <input type="hidden" name="idd" value="<?php echo $id2; ?>" required="">
									<?php
									@include('conn.php');
									$strSQL = "SELECT DISTINCT * FROM detail_buymat,material WHERE id_detail='$id' and detail_buymat.mat_id=material.mat_id ";
									$objQuery = mysql_query($strSQL, $connect1);

									while ($objReSult = mysql_fetch_array($objQuery)) {
										$dep=$objReSult['mat_name'];
										$dep2=$objReSult['unit_id'];
										$matid=$objReSult['mat_id'];

									}
									 ?>
                  <tr><td><h4>ชื่อวัตถุดิบ </td><td><h4> : <input type="text" id="dep" name="namemat" value="<?php echo $dep ;?>" readonly=""></td><input type="hidden" name="matid2" value="<?php echo $matid ;?>">
                  <td><h4>&nbsp;&nbsp;จำนวน</td><td><h4> : <input type="text" name="count" value="<?php echo $count; ?>" required="<?php echo $count; ?>"onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"><font color="red"> &nbsp;*</font></h4></td></tr>
                  <tr><td><h4>หน่วยนับ</td><td> <h4>: <select id="dep" name="unit"  required onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
								  <option value="" disabled selected>-------แสดงทั้งหมด-------</option></h4>

								  <?
									@include('conn.php');
									$strSQL = "SELECT DISTINCT * FROM detail_buymat WHERE id_detail='$id' ";
									$objQuery = mysql_query($strSQL, $connect1);

									while ($objReSult = mysql_fetch_array($objQuery)) {
										$dep=$objReSult['mat_id'];
										$dep2=$objReSult['unit_id'];

									}
									error_reporting(0);
								    @include('conn.php');
								    $strSQL = "SELECT * FROM unit";
								    $objQuery = mysql_query($strSQL, $connect1);

								    while ($objReSult = mysql_fetch_array($objQuery)) {
								      if ($dep2 == $objReSult['unit_id']) {
								        # code...
								        $sel = "selected";
								      }
								      else
								      {
								        $sel = "";
								      }
								  ?>
								<option value="<? echo $objReSult["unit_id"];?>" <? echo $sel; ?> > <? echo $objReSult["unit_name"];?></option>
								<?
								}
								error_reporting(0);
								?>
								</select><font color="red"> &nbsp;*</font></td>
                  <td><h4>&nbsp;&nbsp;ราคาต่อหน่วย</td><td> <h4> : <input type="text" name="price" value="" required="" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">&nbsp;(บาท) <font color="red"> &nbsp;*</font></h4></td></tr>
</table>
                  <tr><div class="modal-footer"><td colspan=2 align=center><br><input type="submit" class="btn btn-success" name="submit" value="แก้ไขข้อมูล" >&nbsp;&nbsp;
    							<a href="select_buymat.php?id=<?php echo $id2; ?>"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไข?')">ยกเลิก</button></a>
    							</td></tr>

              </form>
              </div>
							</div>
            </div>
        </div>
        <div class="container">


              <table class="table table-striped table-bordered">
              <tr class="warning">
                <td align=center>ลำดับ</td>
                <td align=center>รหัสรายละเอียดการสั่งซื้อ</td>
                <td align=center>ชื่อวัตถุดิบ</td>
                <td align=center>จำนวน</td>
                <td align=center>หน่วยนับ</td>
                <td align=center>ราคารวม(บาท)</td>
                <td align=center>แก้ไขข้อมูล</td>
                <td align=center>ลบ</td>
              </tr>
							<?php
              $no=1;
							$strSQL = "SELECT * FROM detail_buymat a,material b,unit c where a.mat_id=b.mat_id and a.unit_id=c.unit_id AND a.id_mat='$id2'";

							$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
							while ($objReSult = mysql_fetch_array($objQuery)) {
								?>
								<tr class ="info">
									<td align=center><?php echo $no ?></td>
									<td align=center><?php echo $objReSult["id_detail"]; ?></td>
									<td align=center><?php echo $objReSult["mat_name"]; ?></td>
									<td align=center><?php echo $objReSult["count"]; ?></td>
									<td align=center><?php echo $objReSult["unit_name"]; ?></td>
									<td align=center><?php echo number_format($objReSult["price"],2); ?></td>
                  <td><div align = "center"><a href="edit_buymat.php?id=<? echo $objReSult['id_detail'];?>&id2=<? echo $id2;?>" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
                  <td><div align = "center"><a href='delete_buymat.php?id=<? echo $objReSult['id_detail'];?>&id2=<? echo $id2;?>'
                  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a></td>
                </tr>


                <?php

$no++;

              }
              @include('conn.php');
              $strSQL = "SELECT SUM(price) AS sumprice FROM `detail_buymat` WHERE id_mat='$id2'";
              $objQuery = mysql_query($strSQL, $connect1);
              while ($objReSult = mysql_fetch_array($objQuery)) {
               $sum= $objReSult["sumprice"];

              }

							 ?>
               <tr class ="info"><td colspan=5 align=right>ราคารวม(บาท)</td><td align=center><?php echo number_format($sum,2); ?></td><td colspan=2>.-</td></tr>
							 </table>
              </div>


          <div class="modal-footer">
  </div>

		</div>
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
