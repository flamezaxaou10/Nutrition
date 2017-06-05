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
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

<link rel="icon" href="img/icon300.ico" type="image/x-icon"/>

 
  <link rel="stylesheet" href="css/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/css/myStyle2.css">

  <script src="css/js/jquery.min.js"></script>
  <script src="css/js/bootstrap.min.js"></script>

<!--         <title>Test | Basic Website</title> -->
<title></title>
        <style type="text/css">
            .container{width:980px;margin:0 auto;padding:20px 15px;border:1px solid #000;}
            @media screen and (max-width:980px){.container{width:95%;}}
            .title{width:100%;border-bottom:1px solid #000;}
            .body{width:100%;display:table;min-height:200px;padding:20px 0px;}
            a,a:hover{text-decoration:none;}
            a:hover{color:orange;}
        </style>
         
        <script type="text/javascript"> 
            function printTable(tableprint) { 
                var printContents = document.getElementById(tableprint).innerHTML; 
                var originalContents = document.body.innerHTML; 
                document.body.innerHTML = printContents; 
                window.print(); 
                document.body.innerHTML = originalContents; 
            } 
        </script>

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
    </head>
    <body>
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

<div class="container">
    <div class="jumbotron">
       <h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>
      <p>ข้อมูลผู้ป่วย</p>
      <form method="POST">
<label for="department"> แผนก : </label>
  <select id="dep" name="dep"    onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
  <option value="o">-------แสดงทั้งหมด-------</option>
  <?
    @include('conn.php');
    $strSQL = "SELECT DISTINCT clinic, clinicdescribe FROM fpatient_info";
    $objQuery = mysql_query($strSQL, $connect2);
    while ($objReSult = mysql_fetch_array($objQuery)) {
      if ($_POST["dep"] == $objReSult['clinic']) {
        # code...
        $sel = "selected";
      }
      else
      {
        $sel = "";
      }
  ?>
     <option value="<? echo $objReSult["clinic"];?>" <? echo $sel; ?> > <? echo $objReSult["clinicdescribe"];?></option>
     <?
      }
      error_reporting(0);
     ?>
</select><br>

<label for="department"> ประเภทอาหาร : </label><select id="dfood" name="dfood"    onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
<option value="o" <?if ($_POST['dfood']=="0") {echo"selected";}?>>-------กรุณาเลือกประเภท-------</option>
     <option value=1 <?if ($_POST['dfood']=="1") {echo"selected";}?>>สามัญ</option>
     <option value=2 <?if ($_POST['dfood']=="2") {echo"selected";}?>>พิเศษ</option>
     <option value=3 <?if ($_POST['dfood']=="3") {echo"selected";}?>>เฉพาะโรค</option>
     
</select><br>

<label for="department">มื้อ : </label><select id="eats" name="eats"  onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
<option value="o" <?if ($_POST['eats']=="0") {echo"selected";}?>>-------กรุณาเลือกช่วงเวลา-------</option>
     <option value=4 <?if ($_POST['eats']=="4") {echo"selected";}?>>เช้า</option>
     <option value=5 <?if ($_POST['eats']=="5") {echo"selected";}?>>กลางวัน</option>
     <option value=6 <?if ($_POST['eats']=="6") {echo"selected";}?>>เย็น</option>
     
</select>



<input type="hidden" name="selected_text" id="selected_text" value="" />
<input type="submit" name="search" value="ค้นหา"/>
</form>
</div>
<div id="print_table">
<center><h3><font color="#000000"><label type="text"  value="การสั่งอาหาร" display="">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</label></font></h3></center>
<center><h3><font color="#000000"><label type="text"  value="การสั่งอาหาร" display="">รายการอาหาร</label></font></h3></center><br>
<h4 align="left"><font color="#000000"><label type="text"  value="การสั่งอาหาร" display="">แผนก : </label></font></h4></center>
<h4 align="right"><font color="#000000"><label type="text"  value="การสั่งอาหาร" display="">วันที่ : </label></font></h4></center>
<h4 align="center"><font color="#000000"><label type="text"  value="การสั่งอาหาร" display="">มื้อ : </label></font></h4></center>

<div class="container">
<!-- <center><h1><label type="hidden" name="test" value="">การสั่งอาหาร</label></h1></center>
 --><?php
 error_reporting(0);
@include('conn.php');
$dep = $_POST['dep'];
$food = $_POST['dfood'];
$eats = $_POST['eats'];

if ($dep != 0) {
  # code...
  if($food == 1)
  {
    if ($eats == 4) {
      # code...
      $strSQL = "SELECT * FROM order_normal where clinic = '".$dep."' AND eats = '".$eats."'";
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
  <tr class="warning">
  
    <th><div align="center">รหัสผู้ป่วย</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
   <th><div align="center">มื้อ</div></th>
     <th><div align="center">แผนก</div></th>
     <th><div align="center">ว/ด/ป</div></th>
  </tr>
  <?
  // $new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">
  
  <td><div align = "center"><? echo $objReSult["HN"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  <td><div align = "center"><? 
    if ($objReSult["eats"] == 4) {
    # code...
    echo "เช้า"; 
    }
      elseif ($objReSult["eats"] == 5) {
      echo "กลางวัน";
 
    }
    elseif ($objReSult["eats"] == 6) {
      # code...
      echo "เย็น";
    }
      ?>
    </div>
    </td>
  <td><div><? echo $objReSult["dep_name"];?></div></td>
  <td><div><? echo $objReSult["date_order"];?></div></td>
  </tr>
  
  <?
}
?>

</table>
<?

    } elseif ($eats == 5) {
      # code...
      $strSQL = "SELECT * FROM order_normal where clinic = '".$dep."' AND eats = '".$eats."'" ;
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
  <tr class="warning">

    <th><div align="center">รหัสผู้ป่วย</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
   <th><div align="center">มื้อ</div></th>
    <th><div align="center">แผนก</div></th>
    <th><div align="center">ว/ด/ป</div></th>
  </tr>
  <?
  $i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">
 
  <td><div align = "center"><? echo $objReSult["HN"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  <td><div align = "center"><? 
    if ($objReSult["eats"] == 4) {
    # code...
    echo "เช้า"; 
    }
      elseif ($objReSult["eats"] == 5) {
      echo "กลางวัน";
 
    }
    elseif ($objReSult["eats"] == 6) {
      # code...
      echo "เย็น";
    }
      ?>
    </div>
    </td>
  <td><div><? echo $objReSult["dep_name"];?></div></td>
  <td><div><? echo $objReSult["date_order"];?></div></td>
  </tr>
  
  <?
}
?>
</table>
  <?
    } elseif ($eats == 6) {
      # code...
      $strSQL = "SELECT * FROM order_normal where clinic = '".$dep."' AND eats = '".$eats."'" ;
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
  <tr class="warning">
 
    <th><div align="center">รหัสผู้ป่วย</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
    <th><div align="center">มื้อ</div></th>
    <th><div align="center">แผนก</div></th>
    <th><div align="center">ว/ด/ป</div></th>
  </tr>
<?
  // $new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">

  <td><div align = "center"><? echo $objReSult["HN"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  <td><div align = "center"><? 
    if ($objReSult["eats"] == 4) {
    # code...
    echo "เช้า"; 
    }
      elseif ($objReSult["eats"] == 5) {
      echo "กลางวัน";
 
    }
    elseif ($objReSult["eats"] == 6) {
      # code...
      echo "เย็น";
    }
      ?>
    </div>
    </td>
  <td><div><? echo $objReSult["dep_name"];?></div></td>
  <td><div><? echo $objReSult["date_order"];?></div></td>
  </tr>
  
  <?
}
?>

</table>
  <?
    }
  }
  elseif ($food == 2) {
    # code...
    $strSQL = "SELECT * FROM order_spec where clinic = '".$dep."'" ;
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
  <tr class="warning">
   
    <th><div align="center">รหัสผู้ป่วย</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
    <th><div align="center">มื้อ</div></th>
    <th><div align="center">แผนก</div></th>
    <th><div align="center">ว/ด/ป</div></th>
  </tr>

  <?
  // $new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">

  <td><div align = "center"><? echo $objReSult["HN"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  <td><div align = "center"><? 
    if ($objReSult["eats"] == 4) {
    # code...
    echo "เช้า"; 
    }
      elseif ($objReSult["eats"] == 5) {
      echo "กลางวัน";
 
    }
    elseif ($objReSult["eats"] == 6) {
      # code...
      echo "เย็น";
    }
      ?>
    </div>
    </td>
  <td><div><? echo $objReSult["dep_name"];?></div></td>
  <td><div><? echo $objReSult["date_order"];?></div></td>
  </tr>
  
  <?
}
?>

</table>

  <?
  if ($eats == 1) {
      # code...
      $strSQL = "SELECT * FROM order_spec where clinic = '".$dep."' AND eats = '".$eats."'" ;
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
  <tr class="warning">

    <th><div align="center">รหัสผู้ป่วย</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
    <th><div align="center">มื้อ</div></th>
    <th><div align="center">แผนก</div></th>
    <th><div align="center">ว/ด/ป</div></th>
  </tr>
  <?
    } elseif ($eats == 2) {
      # code...
      $strSQL = "SELECT * FROM order_spec where clinic = '".$dep."' AND eats = '".$eats."'" ;
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
  <tr class="warning">
   
    <th><div align="center">รหัสผู้ป่วย</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
    <th><div align="center">มื้อ</div></th>
    <th><div align="center">แผนก</div></th>
    <th><div align="center">ว/ด/ป</div></th>

  <?
  // $new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">

  <td><div align = "center"><? echo $objReSult["HN"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  <td><div align = "center"><? 
    if ($objReSult["eats"] == 4) {
    # code...
    echo "เช้า"; 
    }
      elseif ($objReSult["eats"] == 5) {
      echo "กลางวัน";
 
    }
    elseif ($objReSult["eats"] == 6) {
      # code...
      echo "เย็น";
    }
      ?>
    </div>
    </td>
  <td><div><? echo $objReSult["dep_name"];?></div></td>
  <td><div><? echo $objReSult["date_order"];?></div></td>
  </tr>
  
  <?
}
?>

</table>
  <?
    } elseif ($eats == 3) {
      # code...
      $strSQL = "SELECT * FROM order_spec where clinic = '".$dep."' AND eats = '".$eats."'" ;
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
  <tr class="warning">

    <th><div align="center">รหัสผู้ป่วย</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
    <th><div align="center">มื้อ</div></th>
    <th><div align="center">แผนก</div></th>
    <th><div align="center">ว/ด/ป</div></th>
  </tr>

  <?
  // $new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">
  
  <td><div align = "center"><? echo $objReSult["HN"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  <td><div align = "center"><? 
    if ($objReSult["eats"] == 4) {
    # code...
    echo "เช้า"; 
    }
      elseif ($objReSult["eats"] == 5) {
      echo "กลางวัน";
 
    }
    elseif ($objReSult["eats"] == 6) {
      # code...
      echo "เย็น";
    }
      ?>
    </div>
    </td>
  <td><div><? echo $objReSult["dep_name"];?></div></td>
  <td><div><? echo $objReSult["date_order"];?></div></td>
  </tr>
  
  <?
}
?>

</table>
  <?
    }
  }
  elseif ($food == 3) {
    # code...
    $strSQL = "SELECT * FROM order_diss where clinic = '".$dep."' AND eats = '".$eats."'" ;
    $objQuery = mysql_query($strSQL, $connect1);
    ?>
    <div id="print_table">
<table class="table table-striped table-bordered" border="1" width="100%">
  <tr class="warning">

    <th><div align="center">รหัสผู้ป่วย</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
    <th><div align="center">มื้อ</div></th>
 
    <th><div align="center">Type Detail</div></th>
     <th><div align="center">รายละเอียด</div></th>
  
   <th><div align="center">แผนก</div></th>
    <th><div align="center">ว/ด/ป</div></th>
  </tr>

  <?

  // $new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">

  <td><div align = "center"><? echo $objReSult["HN"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  <td><div align = "center"><? 
    if ($objReSult["eats"] == 4) {
    # code...
    echo "เช้า"; 
    }
      elseif ($objReSult["eats"] == 5) {
      echo "กลางวัน";
 
    }
    elseif ($objReSult["eats"] == 6) {
      # code...
      echo "เย็น";
    }
      ?>
    </div>
    </td>

  <td><div><? echo $objReSult["type_name"];?></div></td>
  <td><div><? echo $objReSult["detail_food"];?></div></td>

  <td><div><? echo $objReSult["dep_name"];?></div></td>
  <td><div><? echo $objReSult["date_order"];?></div></td>
  </tr>
  
  <?
}
?>

</table>

  <?
}
}
else {
  
}
?>
</div>
</div>
                </div>
                <p style="text-align:center;"><button OnClick="printTable('print_table');">Print Table</button></p>
            </div>
        </div>
    </body>
</html>