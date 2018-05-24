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
			$strSQL = "SELECT * FROM `buymeterial`, `restaurant` WHERE buymeterial.res_name=restaurant.res_name and buymeterial.id_mat='$id'";
			$objQuery = mysql_query($strSQL, $connect1);
			while ($objReSult = mysql_fetch_array($objQuery)) {
			$username=$objReSult["user_name"];
      $resname=$objReSult["res_name"];
      $keeper=$objReSult["shopkeeper"];

			}
			 ?>
			 <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
      <br>
      <p>รายละเอียดการสั่งซื้ออาหารทางสายยาง</p>
            <?php
							  if(isset($_POST['submit2'])){
									$summ=$_POST['sum'];
									@include('conn.php');
		              $sql  = "update `cpa`.`buymeterial` set `total_mat`='".$summ."' where id_mat = '".$id."'";
		              $result  = mysql_query($sql);
		              if(!$result){
		                die('ไม่สามารแก้ไขข้อมูลได้ เกิดข้อผิิดพลาดบางประการ'.mysql_error());
		              }
		              else {
		                echo "<script>

		                    location='success_feed.php?id=$id';

		                </script>";
		              }

								}
              if(isset($_POST['submit'])){
              $idd=$_POST['idd'];
              $namemat=$_POST['namemat'];
              $count=$_POST['count'];
              $unit=$_POST['unit'];
              $price=$_POST['price'];
							$sum2=$_POST['sum2'];
							$sum2=$sum2+($count*$price);
							@include('conn.php');
							$sql  = "update `cpa`.`buymeterial` set `total_mat`='".$sum2."' where id_mat = '".$id."'";
							$result  = mysql_query($sql);
							if(!$result){
								die('ไม่สามารแก้ไขข้อมูลได้ เกิดข้อผิิดพลาดบางประการ'.mysql_error());
							}
              @include('conn.php');
              $insert = "INSERT INTO detail_buymat  VALUES  ('".$idd."','".$namemat."','".$count."','".$unit."','".$count*$price."','".$id."','$count')";
                    $query = mysql_query($insert,$connect1);



              if(!$insert){
                echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
                    </script>");
              }

            }
						@include('conn.php');
						$strSQL = "SELECT SUM(price) AS sumprice FROM `detail_buymat` WHERE id_mat='$id'";
						$objQuery = mysql_query($strSQL, $connect1);
						while ($objReSult = mysql_fetch_array($objQuery)) {
						 $sum= $objReSult["sumprice"];

						}
            @include('conn.php');
            $strSQL = "SELECT MAX(id_detail) FROM detail_buymat";
            $objQuery = mysql_query($strSQL, $connect1);
            while ($objReSult = mysql_fetch_array($objQuery)) {
             $result= $objReSult["MAX(id_detail)"];
             $ina="";
               for($a=0;$a<Strlen($result);$a++){
               if($a>=2)$ina =$ina.intval($result[$a])  ;
               }
               $idd= "DT-".sprintf("%04d", $ina+1);
            }
             ?>
            <div class="modal-body">

							<table>
								<tr><td align= right width=100><h4>รหัสใบเสร็จ</td><td><h4>: <?php echo $id; ?></h4></td>
                <td align= right width=150><h4>ชื่อเจ้าหน้าที่</td><td><h4> : <?php echo  $_SESSION['fnname']; ?></h4></td>
                <td align= right width=100><h4>ชื่อร้าน</td><td><h4>: <?php echo $resname; ?></h4></td>
                <td align= right width=150><h4>ชื่อเจ้าของร้าน</td><td><h4> : <?php echo $keeper; ?></h4></td></tr>
							</table><br>
              <form method="post" action="#">
                <table>
                  <tr><td width="205"><h4>รหัสรายละเอียดการสั่งซื้อ</td><td><h4> : <?php echo $idd ?></h4></td></tr>
                  <input type="hidden" name="idd" value="<?php echo $idd; ?>" required="">
                  <td><h4>ชื่ออาหารทางสายยาง</td><td><h4> : <select id="dep" name="namemat"   onchange="document.getElementById('price').value=this.options[this.selectedIndex].id">
								  <option value="">-----------------โปรดเลือก----------------</option></h4>

								  <?
								    @include('conn.php');
                    $deep2 = $_SESSION['deep2'];
                    $strSQL0= "SELECT DISTINCT * FROM restaurant where res_name = '$deep2'";
                    $objQuery0 = mysql_query($strSQL0, $connect1);
                    while ($objReSult1 = mysql_fetch_array($objQuery0)) {
                        $idres = $objReSult1['res_id'];
                    }

								    $strSQL = "SELECT DISTINCT * FROM feed where res_id = '$idres'";
								    $objQuery = mysql_query($strSQL, $connect1);

								    while ($objReSult = mysql_fetch_array($objQuery)) {
											$tt=$objReSult["feed_id"];
											$error2=0;
											$strSQL2 = "SELECT DISTINCT * FROM detail_buymat where id_mat='$id'";
											$objQuery2 = mysql_query($strSQL2, $connect1);

											while ($objReSult2 = mysql_fetch_array($objQuery2)) {
												if($tt==$objReSult2["mat_id"]){
														$error2=1;
																					}
											}
											if($error2==0){
								  ?>

								<option value="<? echo $objReSult["feed_id"];?>" <? echo $sel; ?> id="<? echo $objReSult["price"];?>"> <? echo $objReSult["feed_name"];?> </option>
								<?
							}
								}
								error_reporting(0);
								?>
								</select><font color="red"> &nbsp;*</font></td>
                 <td><h4>&nbsp;&nbsp;จำนวน</td><td> <h4>: <input type="text" name="count" value="" required="" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"><font color="red"> &nbsp;*</font></td></tr>
                <td><h4>หน่วยนับ</td><td><h4>  : <select id="dep" name="unit"   onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
								  <option value="">--------------โปรดเลือก-------------</option></h4>

								  <?
								    @include('conn.php');
								    $strSQL = "SELECT DISTINCT * FROM unit";
								    $objQuery = mysql_query($strSQL, $connect1);

								    while ($objReSult = mysql_fetch_array($objQuery)) {

								  ?>
								<option value="<? echo $objReSult["unit_id"];?>" <? echo $sel; ?> > <? echo $objReSult["unit_name"];?></option>
								<?
								}
								error_reporting(0);
								?>
								</select><font color="red"> &nbsp;*</font></td><input type="hidden" name="sum2" value="<?php echo $sum ; ?>">
                  <td><h4>&nbsp;&nbsp;ราคาต่อหน่วย</td><td><h4> : <input id="price" type="text" name="price" value="" required="" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">&nbsp;บาท<font color="red"> &nbsp;*</font></h4></td></tr>
                  <tr></table><div class="modal-footer"><td colspan=2 align=center><input type="submit" class="btn btn-success" name="submit" value="เพิ่มข้อมูล" >&nbsp;&nbsp;
    						<a href="delete_allfeed.php?id=<?php echo $id ;?>"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการสั่งซื้อ?')">ยกเลิกการสั่งซื้อ</button></a>
    							</td></tr>

              </form>
              </div>
            </div></div>
        </div>
				<?php
				@include('conn.php');
				$strSQL = "SELECT SUM(price) AS sumprice FROM `detail_buymat` WHERE id_mat='$id'";
				$objQuery = mysql_query($strSQL, $connect1);
				while ($objReSult = mysql_fetch_array($objQuery)) {
				 $sum= $objReSult["sumprice"];

				}
				 ?>
        <div class="container">
              <table class="table table-striped table-bordered">
								<form method="post" action="#">
								<input type="hidden" name="sum" value="<?php echo $sum; ?>">

 							 </form>
              <tr class="warning">
                <th><div align="center">ลำดับ</th>
                <th><div align="center">รหัสรายละเอียด</th>
                <th><div align="center">ชื่อวัตถุดิบ</th>
              	<th><div align="center">จำนวน</th>
                <th><div align="center">หน่วยนับ</th>
                <th><div align="center">ราคารวม(บาท)</th>
              	<th><div align="center">แก้ไข</th>
              	<th><div align="center">ลบ</th>
              </tr>
							<?php
              $no=1;
              $strSQL = "SELECT a.id_detail,b.feed_name,a.count,c.unit_name,a.price FROM detail_buymat a,feed b,unit c where a.mat_id=b.feed_id and a.unit_id=c.unit_id AND a.id_mat='$id'";

              $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
              while ($objReSult = mysql_fetch_array($objQuery)) {
                ?>
                <tr class ="info">
                  <td align=center><?php echo $no ?></td>
                  <td align=center><?php echo $objReSult["id_detail"]; ?></td>
                  <td align=center><?php echo $objReSult["feed_name"]; ?></td>
                  <td align=right><?php echo $objReSult["count"]; ?></td>
                  <td align=center><?php echo $objReSult["unit_name"]; ?></td>
                  <td align=right><?php echo number_format($objReSult["price"],2); ?></td>
                  <td><div align = "center"><a href="edit_feed.php?id=<? echo $objReSult['id_detail'];?>&id2=<? echo $id;?>" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
                  <td><div align = "center"><a href='delete_feed.php?id=<? echo $objReSult['id_detail'];?>&id2=<? echo $id;?>'
                  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a></td>
                </tr>

                <?php

$no++;

              }

							@include('conn.php');
							$sql  = "update `cpa`.`buymeterial` set `total_mat`='".$sum."' where id_mat = '".$id."'";
							$result  = mysql_query($sql);
							if(!$result){
								die('ไม่สามารแก้ไขข้อมูลได้ เกิดข้อผิิดพลาดบางประการ'.mysql_error());
							}
							 ?>
               <tr class ="info"><td colspan=5 align=right>ราคารวม(บาท)</td><td align=center><?php echo number_format($sum,2); ?></td><td colspan=2 align=left>.-
							 </td></tr>

							 </table>
							 <div class="text-right"><a href="chk_feed.php?id=<?php echo $id; ?>">	<input type="submit" class="btn btn-success" name="submit2" value="ยืนยันการสั่งซื้อ" onclick="return confirm('ยืนยันการสั่งซื้อ?')"></a>
								 <a href="chk_feed.php?back&id=<?php echo $id; ?>" class="btn btn-danger">ย้อนกลับ</a>
							</div>

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
