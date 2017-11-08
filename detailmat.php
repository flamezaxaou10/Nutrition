w<?php
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
      <p>รายละเอียดการสั่งซื้อวัตถุดิบ</p>
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

		                    location='suc_buymat.php?id=$id';

		                </script>";
		              }

								}
              if(isset($_POST['submit'])){
              $idd=$_POST['idd'];
              $namemat=$_POST['namemat'];
              $count=$_POST['count'];
              $unit=$_POST['unit'];
              $price=$_POST['price'];
              @include('conn.php');
              $insert = "INSERT INTO detail_buymat  VALUES  ('".$idd."','".$namemat."','".$count."','".$unit."','".$count*$price."','".$id."')";
                    $query = mysql_query($insert,$connect1);



              if(!$insert){
                echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
                    </script>");
              }

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
              <table class="table table-striped table-bordered">
                <?php
        				@include('conn.php');
        				$strSQL = "SELECT SUM(price) AS sumprice FROM `detail_buymat` WHERE id_mat='$id'";
        				$objQuery = mysql_query($strSQL, $connect1);
        				while ($objReSult = mysql_fetch_array($objQuery)) {
        				 $sum= $objReSult["sumprice"];

        				}
        				 ?>

              <tr class="warning">
                <td align=center><b>ลำดับ</td>
                <td align=center><b>รหัสรายละเอียด</td>
                <td align=center><b>ชื่อวัตถุดิบ</td>
                <td align=center><b>จำนวน</td>
                <td align=center><b>หน่วยนับ</td>
                <td align=center colspan="2"><b>ราคา(บาท)</td>

              </tr>
              <?php
              $no=1;
              $strSQL = "SELECT * FROM detail_buymat a,material b,unit c where a.mat_id=b.mat_id and a.unit_id=c.unit_id AND a.id_mat='$id'";

              $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
              while ($objReSult = mysql_fetch_array($objQuery)) {
                ?>
                <tr class ="info">
                  <td align=center><?php echo $no ?></td>
                  <td align=center><?php echo $objReSult["id_detail"]; ?></td>
                  <td align=center><?php echo $objReSult["mat_name"]; ?></td>
                  <td align=right><?php echo $objReSult["count"]; ?></td>
                  <td align=center><?php echo $objReSult["unit_name"]; ?></td>
                  <td align=right colspan="2"><?php echo number_format($objReSult["price"],2); ?></td>

                </tr>


                <?php

              $no++;

              }


               ?>
               <tr class ="info"><td colspan=5 align=right>ราคารวม(บาท)</td><td align=center><?php echo number_format($sum,2); ?></td><!-- <td colspan=2 align=left> -->
               </td></tr>
               </table>
							<div class="modal-footer"><td colspan=2 align=center>
    							<a href="insert_buymaterial.php"><button type="button" class="btn btn-danger" data-dismiss="modal">ย้อนกลับ</button></a>
    							</td></tr>

              </form>
              </div>
            </div></div>
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
