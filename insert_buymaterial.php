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
			$strSQL = "SELECT MAX(id_mat) FROM buymeterial";
			$objQuery = mysql_query($strSQL, $connect1);
			while ($objReSult = mysql_fetch_array($objQuery)) {
			 $result= $objReSult["MAX(id_mat)"];
			 $ina="";
				 for($a=0;$a<Strlen($result);$a++){
				 if($a>=2)$ina =$ina.intval($result[$a])  ;
				 }
				 $id= "BM-".sprintf("%04d", $ina+1);
			}
			 ?>
			 <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
      <br>
      <p>ข้อมูลการสั่งซื้อวัตถุดิบ</p>

            <div class="modal-body">
          	<form method="post" action="#" >
							<table>
								<tr><td><h4>รหัสการสั่งซื้อวัตถุดิบ</td><td><h4>: <?php echo $id ; ?>
								<input type="hidden" name="idmat" value="<?php echo $id ; ?>"></h4></td>
								<td width=150 align=center><h4>เจ้าหน้าที่ผู้สั่งซื้อ</td><td><h4>: <?php echo $username ; ?>
								<input type="hidden" name="idname" value="<?php echo $username ; ?>"></h4></td>

								<tr><td><h4>เลือกชื่อร้านค้าวัตถุดิบ</td><td><h4>: <select id="dep" required name="dep" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
								  <option value="" disabled selected>-------กรุณาเลือกร้านค้า-------</option>

								  <?
								    @include('conn.php');

								    $strSQL = "SELECT * FROM restaurant where type='FYST01' order by res_name";
								    $objQuery = mysql_query($strSQL, $connect1);

								    while ($objReSult = mysql_fetch_array($objQuery)) {
								      if ($_POST["dep"] == $objReSult['res_id']) {
								        # code...
								        $sel = "selected";
								      }
								      else
								      {
								        $sel = "";
								      }
								  ?>
								<option value="<? echo $objReSult["res_name"];?>" <? echo $sel; ?> > <? echo $objReSult["res_name"];?></option>
								<?
								}
								error_reporting(0);
								$strDate=date('d-m-Y');
									$strYear = date("Y",strtotime($strDate))+543;
									$strMonth= date("n",strtotime($strDate));
									$strDay= date("j",strtotime($strDate));
									$strDays= date("l",strtotime($strDate));
									$strDayCut = Array("Monday"=>"วันจันทรที่","Tuesday"=>"วันอังคารที่","Wednesday"=>"วันพุธที่","Thursday"=>"วันพฤหัสบดีที่","Friday"=>"วันศุกรที่","Saturday"=>"วันเสารที่","Sunday"=>"วันอาทิตย์ที่");
									$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
									$strMonthThai=$strMonthCut[$strMonth];
									$strDaysThai = $strDayCut[$strDays];
									$date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;
								?>
							</select> <font color="red">&nbsp;*</font></table>
							<table>

									<tr>
							<td  width=159 align=left><h4>วันที่สั่งซื้อวัตถุดิบ</td><td><h4>:&nbsp;<?php echo $date; ?><input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>"></h4></td></tr>
							<tr><td><br></table><div class="modal-footer"><input type="submit" class="btn btn-success" name="submit" value="เพิ่มข้อมูล" >&nbsp;&nbsp;</td>
							<td><a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไข?')">ยกเลิก</button>

						</a>
							</form>
							<?php
							if(isset($_POST['submit'])){
								$id=$_POST['idmat'];
								$name=$_POST['idname'];
								$dep=$_POST['dep'];
								$_SESSION['deep'] = $dep;
							$date=date('Y-m-d', strtotime($_POST['date']));
								@include('conn.php');
							  $insert = "INSERT INTO buymeterial  VALUES  ('$id','$name','$dep','$date','','1','0','0')";
							  		  $query = mysql_query($insert,$connect1);
							            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');
							  		  window.location='select_buymat.php?id=$id';</script>");


							  if(!$insert){
							  	echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
							  		  window.location='insert_buymaterial.php';</script>");
							  }
							}
							 ?>
							 </table>
							 </div>

              </div>

		</div>

			<div class="jumbotron">
<?php
$perpage = 20;
if (isset($_GET['page']) && $_GET['page'] != 0) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$start = ($page - 1) * $perpage;

$strSQL = "SELECT * FROM buymeterial WHERE typebuy= '1' order by id_mat desc LIMIT {$start},{$perpage}";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
 ?>
		 <h4>ประวัติการสั่งซื้อวัตถุดิบ</h4>
		 <table class="table table-striped table-bordered">
			 <tr class="warning">
		     <th><div align="center">วันที่</div></th>
		     <th><div align="center">รหัสใบสั่งซื้อ</div></th>
		     <th><div align="center">ชื่อผู้สั่งซื้อ</div></th>
		     <th><div align="center">ชื่อร้านค้า</div></th>
		 		<th><div align="center">ราคารวม(บาท)</div></th>
		 		<th><div align="center">แก้ไขข้อมูล</div></th>
		 		<th><div align="center">พิมพ์</div></th>
				<th><div align="center">ข้อมูล</div></th>
		   </tr>
			 <?php

while ($objReSult = mysql_fetch_array($objQuery)) {
$aa = $objReSult["id_mat"];
	$strDate=date('d-m-Y', strtotime($objReSult["date"]));
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		$date=$strDay." ".$strMonthThai." ".$strYear;

			  ?>
				<tr class ="info">
			  <td><div align = "center"><?php echo $date;?></div></td>
			  <td><div align = "center"><? echo $objReSult["id_mat"];?></div></td>
				<td><div align = "center"><? echo $objReSult["user_name"];?></div></td>
				<td><div align = "center"><? echo $objReSult["res_name"];?></div></td>
				<td><div align = "right"><? echo number_format($objReSult["total_mat"],2);?></div></td>
				<?php
				if($objReSult["status"]==1){
				 ?>
				<td colspan=2><div align = "center"><img src='img/close.png' width=25></div></td>
<?php
}else{ ?>
				<td><div align = "center"><a href="select_buymat.php?id=<? echo $objReSult['id_mat'];?>" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
				<td><div align = "center"><p style="text-align:center;"><a href="suc_buymat.php?id=<? echo $objReSult['id_mat'];?>"><b><font color="blue"><img src='img/print.png' width=25></font></b></a></p></td>


		 <?php
}
?>
<td><div align = "center"><a href="detailmat.php?id=<?php echo $aa ; ?>" ><img src='img/sssss.png' width=25></a></div></td>
</tr>
<?php
	 } ?>
	 </table>
	 <?php
		 $sql2 = "SELECT * FROM buymeterial";
		 $query2 = mysql_query($sql2, $connect1);
		 $total_record = mysql_num_rows($query2);
		 $total_page = ceil($total_record / $perpage);
		?>
	 <nav align="center" aria-label="Page navigation example">
		 <ul class="pagination">
			 <li class="page-item"><a class="page-link" href="insert_buymaterial.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
			 <?php for($i=1;$i<=$total_page;$i++){ ?>
				<li><a href="insert_buymaterial.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			 <?php } ?>
			 <li class="page-item"><a class="page-link" href="insert_buymaterial.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true">>></span></a></li>
		 </ul>
	 </nav>
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
