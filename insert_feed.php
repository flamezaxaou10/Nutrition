<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{


header('location:login.php');
exit();
}
$username=$_SESSION["Username"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>ระบบจัดการข้อมูลการสั่งซื้อวัตถุดิบ</title>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

<link rel="icon" href="img/icon300.ico" type="image/x-icon"/>


  <link rel="stylesheet" href="css/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/css/myStyle2.css">

  <script src="css/js/bootstrap.min.js"></script>
  <script src="css/js/jquery.min.js"></script>
  <script src="css/js/bootstrap.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<style type="text/css">
  .navbar {
      font-family: Montserrat, sans-serif;
      margin-bottom: 0;
      background-color: #2d2d30;
      border: 0;
      font-size: 11px !important;
      letter-spacing: 4px;
      opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
      color: #fff !important;
  }
  .navbar-nav li.active a {
      color: #fff !important;
      background-color: #29292c !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
  }
  .open .dropdown-toggle {
      color: #fff;
      background-color: #555 !important;
  }
  .dropdown-menu li a {
      color: #000 !important;
  }
  .dropdown-menu li a:hover {
      background-color: red !important;
  }
  footer {
      background-color: #2d2d30;
      color: #f5f5f5;
      padding: 32px;
  }
  footer a {
      color: #f5f5f5;
  }
  footer a:hover {
      color: #777;
      text-decoration: none;
  }
</style>
<div class="container">
	<ul class=""></ul>
</div>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">NUTRITION SYSTEM</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">NUTRITION
          <span class="caret"></span></a>

         <ul class="dropdown-menu">
               <li align = "center"><a href="HN_patient.php">ข้อมูลผู้ป่วย</a></li>
            <li align = "center"><a href="user.php">ข้อมูลเจ้าหน้าที่</a></li>
            <li align = "center"><a href="department.php">ข้อมูลแผนก</a></li>
             <li align = "center"><a href="matandunit.php">ข้อมูลวัตถุดิบและหน่วยนับ</a></li>
            <li align = "center"><a href="insert_restaurant.php">ข้อมูลร้านค้าวัตถุดิบ</a></li>
            <li align = "center"><a href="typefood.php">ข้อมูลประเภทอาหาร</a></li>
            <li align = "center"><a href="insert_menu.php">ข้อมูลเมนูอาหาร</a></li>
            <li align = "center"><a href="patient.php">การสั่งอาหารและจัดส่งอาหาร</a></li>
            <li align = "center"><a href="insert_buymaterial.php">สั่งซื้อวัตถุดิบ</a></li>
            <li align = "center"><a href="insert_feed.php">สั่งซื้ออาหารทางสายยาง</a></li>
          </ul>

        </li>
        <li><a href=""><span class="glyphicon glyphicon-user"> <? echo $_SESSION["Username"];?></span></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </div>
</nav>
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
      <p>ข้อมูลการสั่งซื้ออาหารทางสายยาง</p>

            <div class="modal-body">
          	<form method="post" action="#" >
							<table>
								<tr><td><h4>รหัสการสั่งซื้ออาหารทางสายยาง </td><td><h4>: <?php echo $id ; ?>
								<input type="hidden" name="idmat" value="<?php echo $id ; ?>"></h4></td></td>
									<td width=150 align=center><h4>เจ้าหน้าที่ผู้สั่งซื้อ </td><td><h4> :<?php echo $username ; ?>
									<input type="hidden" name="idname" value="<?php echo $username ; ?>"></h4></td>
									<tr><td><h4>เลือกชื่อร้านค้าตัวแทนจำหน่าย </td><td><h4>:
									<select id="dep" name="dep"   onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
								  <option value="">-------กรุณาเลือกร้านค้า-------</option></h4>

								  <?
								    @include('conn.php');

								    $strSQL = "SELECT * FROM restaurant where type='FYST02'";
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
									$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
									$strMonthThai=$strMonthCut[$strMonth];
									$date=$strDay." ".$strMonthThai." ".$strYear;
								?>
							</select></table>


							<table>
							<tr>
							<td  width=240 align=left><h4>วันที่สั่งซื้ออาหารทางสายยาง </td><td><h4>:&nbsp;<?php echo $date; ?>
							<input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>"></h4></td></tr>
							<tr><td><br></table><div class="modal-footer"><input type="submit" class="btn btn-success" name="submit" value="เพิ่มข้อมูล" >&nbsp;&nbsp;</td>
							<td><a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไข?')">ยกเลิก</button>

						</a>
							</form>
							<?php
							if(isset($_POST['submit'])){
								$id=$_POST['idmat'];
								$name=$_POST['idname'];
								$dep=$_POST['dep'];
								$_SESSION['deep2'] = $dep;
							$date=date('Y-m-d', strtotime($_POST['date']));
								@include('conn.php');
							  $insert = "INSERT INTO buymeterial  VALUES  ('$id','$name','$dep','$date','','2','0','0')";
							  		  $query = mysql_query($insert,$connect1);
							            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');
							  		  window.location='select_feed.php?id=$id';</script>");


							  if(!$insert){
							  	echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
							  		  window.location='insert_feed.php';</script>");
							  }
							}
							 ?>
							 </table>
							 </div>

              </div>

		</div>

			<div class="jumbotron">
<?php
$strSQL = "SELECT * FROM buymeterial WHERE typebuy= '2' order by id_mat DESC";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
 ?>
		 <h4>ประวัติการสั่งซื้ออาหารทางสายยาง</h4>
		 <table class="table table-striped table-bordered">
			 <tr class="warning">
		     <th><div align="center">วันที่</div></th>
		     <th><div align="center">รหัสใบสั่งซื้อ</div></th>
		     <th><div align="center">ชื่อผู้สั่ง</div></th>
		     <th><div align="center">ชื่อร้านค้า</div></th>
		 		<th><div align="center">ราคารวม(บาท)</div></th>
		 		<th><div align="center">แก้ไขข้อมูล</div></th>
		 		<th><div align="center">พิมพ์</div></th>
				<th><div align="center">ข้อมูล</div></th>
		   </tr>
			 <?php

while ($objReSult = mysql_fetch_array($objQuery)) {
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
				if($objReSult["status"]!=1){
				 ?>
				<td><div align = "center"><a href="select_feed.php?id=<? echo $objReSult['id_mat'];?>" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
				<td><div align = "center"><a href="success_feed.php?id=<? echo $objReSult['id_mat'];?>"><b><font color="blue"><img src='img/print.png' width=25></font></b></a></td>


				<?php
				}else{ ?>
					<td colspan=2><div align = "center"><img src='img/close.png' width=25></div></td>
		 <?php
}
?>
<td><div align = "center"><a href="detailfeed.php?id=<?php echo $objReSult["id_mat"] ; ?>" ><img src='img/sssss.png' width=25></a></div></td>
</tr>
<?php
	 } ?>
	 </table>
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
