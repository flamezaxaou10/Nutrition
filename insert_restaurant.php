<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ระบบจัดการข้อมูลร้านค้าวัตถุดิบ</title>
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
$strSQL = "SELECT MAX(res_id) FROM restaurant";
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
      <p>ข้อมูลร้านค้าวัตถุดิบ</p>
<table><form method="post" action="#" >
            <div class="modal-body">
            <input type='hidden' name='id' value=''>
              <tr><td width=150><h4> รหัสร้านค้า </td><td width=700><h4>: <input type="text" name ='res_id' readonly value='<?php echo $id ; ?>'></h4></td></tr>

              <tr><td><h4> ชื่อร้านค้า  </td><td><h4>: <input type='text' name ='res_name' required value="<?php echo $bb; ?>" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}" ><font color="red"> &nbsp;*</font><?php if($error==1)echo "<font color=red>ชื่อร้านนี้มีอยู่ในระบบแล้ว</font>"; ?></h4></td></tr>
              <tr><td><h4> ชื่อผู้ติดต่อ  </td><td><h4>: <input type='text' name ='id_name' required value="<?php echo $cc; ?>" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"><font color="red"> &nbsp;*</font></h4></td></tr>
              <tr><td><h4> โทรศัพท์  </td><td><h4>: <input type='text' name ='res_phone'  value="<?php echo $dd; ?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"/><font color="red"> &nbsp;*</font></h4></td></tr>
              <tr><td><h4> มือถือ  </td><td><h4>: <input type='tel' name ='phone' required value="<?php echo $ee; ?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"><font color="red"> &nbsp;*</font>
								<tr><td><h4 align="left"> ประเภทร้านค้า  </td><td> <h4>:
								<select name="type">
									<option value="">------------โปรดเลือกประเภทร้านค้า-----------</option>
                    <?php 
                      $i = 0;
                      $strSQL = "SELECT * FROM typestore ";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
									     <option value="<?php echo $objReSult['type_id'];?>" <?php if($gg==1) echo "selected"; ?>><?php echo $objReSult['type_name'];?></option>
                      <?php $i++;
                      }?>
								</select><font color="red"> &nbsp;*</font></td></tr></h4>
              <tr><td><h4 align="left"> ที่อยู่ : </td><td>
                <textarea class="form-control" rows="3" id="detail" name="res_address" required data-validation="required"><?php echo $ff; ?></textarea>
              </td></tr></h4>
              </div>
<tr><td colspan=2><br>
	 <div class="modal-footer">
  <input type="submit" name="submit" class="btn btn-success" value="เพิ่มข้อมูล" >&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้ห?')">ยกเลิก</button>

</a></td></tr>
</table></form>

		</div>

		<form method="post" action="#"
		<h4><font color=white> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ค้นหาจากชื่อร้านค้า : </font></label> <input type="text" name="sen" >
		 <!--<input type="hidden" name="selected_text" id="selected_text" value="" />-->

		   <input type="submit" class="btn btn-success" name="submit2" value="ค้นหา">
		</form>

		<?php
		@include('conn.php');
		$see=$_POST["sen"];
		$strSQL = "SELECT * FROM restaurant a join typestore b on a.type=b.type_id where res_name like '%$see%' order by res_id";
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
