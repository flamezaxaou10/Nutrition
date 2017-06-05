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
	$idfood  = $_POST['menu_id'];
	$name    = $_POST['menu_name'];
	$id      = $_GET['id'];
	@include('conn.php');
	$strSQL = "SELECT * FROM menu WHERE menu_id <> '$id'";
	$objQuery = mysql_query($strSQL, $connect1);
	while ($objReSult = mysql_fetch_array($objQuery)) {
	 $gname= $objReSult["menu_name"];
	 if($gname==$name){
		 $flag=1;
	 }
}
if($flag==0){
	$insert = "UPDATE menu  SET  menu_name='".$name."',id_type='".$_POST['store']."' WHERE menu_id='".$id."'";
	$result  = mysql_query($insert, $connect1);
	echo " <script>

			location='insert_menu.php';

	       </script>";
	if(!$result){
		die('ไม่สามารแก้ไขข้อมูลได้ เกิดข้อผิดพลาดบางประการ'.mysql_error());
	}
}
}
?>

<p align="left">แก้ไขข้อมูลเมนูอาหาร</p>
<div class="modal-body">
<input type='hidden' name='id' value='<? echo $sql['id'];?>'>
      <h4> รหัสเมนูอาหาร :&nbsp;&nbsp;<input type='text' name ='menu_id' required value='<? echo $_GET['id'];?>' readonly></td></tr>
</h4>
      <h4> ชื่อเมนูอาหาร  &nbsp;&nbsp;: &nbsp;<input type='text' name ='menu_name' required value='<? echo $_GET['id2'];?>' onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"></td></tr><font color="red"> &nbsp;*</font><?php if($flag==1)echo "<font color=red>ชื่อนี้มีในระบบแล้ว</font>"; ?></h4>
      <h4> ประเภทอาหาร :
                      <select name = "store">
                        <option>------กรุณาเลือกประเภทอาหาร-----</option>
                      <?
                    @include('conn.php');

                    $strSQL = "SELECT * FROM type_food";
                    $objQuery = mysql_query($strSQL, $connect1);

                    while ($objReSult = mysql_fetch_array($objQuery)) {
                     
                     
                  ?>
                <option value="<? echo $objReSult["id_type"];?>" <? if($_GET['id3']==$objReSult['id_type']){echo "selected";} ?> > <? echo $objReSult["type_name"];?></option>
                <?
                }
                ?>
                </select><font color="red">&nbsp;*</font>
                </h4>




</div>
</div>
</table><br>
<div class="modal-footer">
	<input type="submit" class="btn btn-success" name="submit" value="แก้ไขข้อมูล" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')">&nbsp;&nbsp;
	<a href="insert_menu.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไข?')">ยกเลิก</button>

</a>
      </div>
      </div>
	</form>

 <?php
@include('conn.php');
$strSQL = "SELECT * FROM menu a join type_food b on a.id_type = b.id_type order by menu_id";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
?>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสเมนูอาหาร</div></th>
    <th><div align="center">ชื่อเมนูอาหาร</div></th>
     <th><div align="center">ประเภทอาหาร</div></th>
    <!--<th><div align="center">แก้ไข</div></th> -->

  </tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["menu_id"];?></div></td>
  <td><div align = "left"><? echo $objReSult["menu_name"];?></div></td>
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
