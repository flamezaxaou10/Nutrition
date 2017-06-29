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
            <li align = "center"><a href="insert_restaurant.php">ข้อมูลรา้นค้าวัตถุดิบ</a></li>
            <li align = "center"><a href="typefood.php">ข้อมูลประเภทอาหาร</a></li>
            <li align = "center"><a href="patient.php">การสั่งอาหารและจัดส่งอาหาร</a></li>
            <li align = "center"><a href="insert_buymaterial.php">สั่งซื้อวัตถุดิบ</a></li>
            <li align = "center"><a href="insert_buyfeed.php">สั่งซื้ออาหารทางสายยาง</a></li>
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
                <td align= right width=150><h4>ชื่อเจ้าหน้าที่</td><td><h4> : <?php echo $username; ?></h4></td>
                <td align= right width=100><h4>ชื่อร้าน</td><td><h4>: <?php echo $resname; ?></h4></td>
                <td align= right width=150><h4>ชื่อเจ้าของร้าน</td><td><h4> : <?php echo $keeper; ?></h4></td></tr>
							</table><br>
              <form method="post" action="#">
                <table>
                  <tr><td width="205"><h4>รหัสรายละเอียดการสั่งซื้อ</td><td><h4> : <?php echo $idd ?></h4></td></tr>
                  <input type="hidden" name="idd" value="<?php echo $idd; ?>" required="">
                  <td><h4>ชื่ออาหารทางสายยาง</td><td><h4> : <select id="dep" name="namemat"   onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
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

								<option value="<? echo $objReSult["feed_id"];?>" <? echo $sel; ?> > <? echo $objReSult["feed_name"];?></option>
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
                  <td><h4>&nbsp;&nbsp;ราคาต่อหน่วย</td><td><h4> : <input type="text" name="price" value="" required="" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">&nbsp;(บาท)<font color="red"> &nbsp;*</font></h4></td></tr>
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
						<div class="modal-footer">
              <table class="table table-striped table-bordered">

								<form method="post" action="#">
								</div><input type="hidden" name="sum" value="<?php echo $sum; ?>">
 								 <input type="submit" class="btn" name="submit2" value="ยืนยันการสั่งซื้อ" onclick="return confirm('ยืนยันการสั่งซื้อ?')">
 							 </form>
              <tr class="warning">
                <td align=center>ลำดับ</td>
                <td align=center>รหัสรายละเอียด</td>
                <td align=center>ชื่อวัตถุดิบ</td>
                <td align=center>จำนวน</td>
                <td align=center>หน่วยนับ</td>
                <td align=center>ราคารวม(บาท)</td>
                <td align=center>แก้ไข</td>
                <td align=center>ลบ</td>
              </tr>
							<?php
              $no=1;
              $strSQL = "SELECT * FROM detail_buymat a,feed b,unit c where a.mat_id=b.feed_id and a.unit_id=c.unit_id AND a.id_mat='$id'";

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
