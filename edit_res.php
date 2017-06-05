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
	<title>TYPE OF FOOD</title>
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
            <li align = "center"><a href="HN_patient.php">ข้อมูลรา้นค้าวัตถุดิบ</a></li>
            <li align = "center"><a href="typefood.php">ข้อมูลประเภทอาหาร</a></li>
     <li align = "center"><a href="patient.php">การสั่งอาหารและจัดส่งอาหาร</a></li>
        <li align = "center"><a href="HN_patient.php">สั่งซื้อวัตถุดิบ</a></li>
      <li align = "center"><a href="HN_patient.php">สั่งซื้ออาหารทางสายยาง</a></li>
          </ul>
        </li>
        <li><a href=""><span class="glyphicon glyphicon-user"> <? echo $_SESSION["Username"];?></span></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </div>
</nav>
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
