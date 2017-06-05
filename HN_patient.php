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
  <title>ข้อมูลผู้ป่วย</title>
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
  <style>
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
  <style type="text/css">
<!--
	.paginate {
	font-family: Arial, Helvetica, sans-serif;
	font-size: .25em;
	}
	a.paginate {
	border: 1px solid #000080;
	padding: 11px 13px 11px 14px;
	text-decoration: none;
	color: #ffffff;
	}
	h2 {
		font-size: 35pt;
		color: #000;
		}

		 h2 {
		line-height: 1.2em;
		letter-spacing:1px;
		margin: 0;
		padding: 0;
		text-align: left;
		}
	a.paginate:hover {
	background-color: #ffffff;
	color: #000000;
	text-decoration: underline;
	}
	a.current {
	border: 2px solid #000080;
	font: bold .7em Arial,Helvetica,sans-serif;
	padding: 11px 13px 11px 14px;
	cursor: default;
	background:#000080;
	color: #FFF;
	text-decoration: none;
	}
	span.inactive {
	border: 1px solid #999;
	font-family: Arial, Helvetica, sans-serif;
	font-size: .25em;
	padding: 11px 13px 11px 14px;
	color: #999;
	cursor: default;
	}
-->
</style>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <?php



  class Paginator{
  	var $items_per_page;
  	var $items_total;
  	var $current_page;
  	var $num_pages;
  	var $mid_range;
  	var $low;
  	var $high;
  	var $limit;
  	var $return;
  	var $default_ipp;
  	var $querystring;
  	var $url_next;

  	function Paginator()
  	{
  		$this->current_page = 1;
  		$this->mid_range = 7;
  		$this->items_per_page = $this->default_ipp;
  		$this->url_next = $this->url_next;
  	}
  	function paginate()
  	{

  		if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
  		$this->num_pages = ceil($this->items_total/$this->items_per_page);

  		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
  		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
  		$prev_page = $this->current_page-1;
  		$next_page = $this->current_page+1;


  		if($this->num_pages > 10)
  		{
  			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=\"".$this->url_next.$this->$prev_page."\">&laquo; ก่อนหน้า</a> ":"<span class=\"inactive\" href=\"#\">&laquo; ก่อนหน้า</span> ";

  			$this->start_range = $this->current_page - floor($this->mid_range/2);
  			$this->end_range = $this->current_page + floor($this->mid_range/2);

  			if($this->start_range <= 0)
  			{
  				$this->end_range += abs($this->start_range)+1;
  				$this->start_range = 1;
  			}
  			if($this->end_range > $this->num_pages)
  			{
  				$this->start_range -= $this->end_range-$this->num_pages;
  				$this->end_range = $this->num_pages;
  			}
  			$this->range = range($this->start_range,$this->end_range);

  			for($i=1;$i<=$this->num_pages;$i++)
  			{
  				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
  				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
  				{
  					$this->return .= ($i == $this->current_page And $_GET['Page'] != 'All') ? "<a title=\"Go to page $i of $this->num_pages\" class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=\"".$this->url_next.$i."\">$i</a> ";
  				}
  				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
  			}
  			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($_GET['Page'] != 'All')) ? "<a class=\"paginate\" href=\"".$this->url_next.$next_page."\">ถัดไป &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; ถัดไป</span>\n";
  		}
  		else
  		{
  			for($i=1;$i<=$this->num_pages;$i++)
  			{
  				$this->return .= ($i == $this->current_page) ? "<a class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" href=\"".$this->url_next.$i."\">$i</a> ";
  			}
  		}
  		$this->low = ($this->current_page-1) * $this->items_per_page;
  		$this->high = ($_GET['ipp'] == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
  		$this->limit = ($_GET['ipp'] == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
  	}

  	function display_pages()
  	{
  		return $this->return;
  	}
  }
  ?>



<div class="container">
  <ul class=""></ul>
</div>
<?
// $dep = "0";
$eats = "0";

?>
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
<?php

@include('conn.php');
$strSQL = "SELECT * FROM fpatient_info";
$objQuery = mysql_query($strSQL, $connect2);
$Num_Rows = mysql_num_rows($objQuery);
$sen=$_POST['sen'];
$dep=$_POST['dep'];
if($sen==""&&$dep==""){
$Per_Page = 20;
$Page = $_GET["Page"];
if(!$_GET["Page"])
{
	$Page=1;
}

$Prev_Page = $Page-1;
$Next_Page = $Page+1;

$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
}
 ?>
    <div class="jumbotron">
    <br>
      <!-- <h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
      <p>ข้อมูลผู้ป่วย</p>

      <form method="post" action="#">

      <!-- ค้นหาจากชื่อแผนก-->
<!--<label for="department"> ค้นหาจากชื่อแผนก : </label>
  <select id="dep" name="dep"   onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
  <option value="">---------------------กรุณาเลือกชื่อแผนก---------------------</option>-->

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
<!--<option value="<? echo $objReSult["clinic"];?>" <? echo $sel; ?> > <? echo $objReSult["clinicdescribe"];?></option>-->
<?
}
error_reporting(0);
?>
</select>
<label for="department">&nbsp;ค้นหาจากชื่อ - นามสกุล : </label> <input type="text" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}" name="sen" >


<? $strDefault = $objReSult['clinic']; ?>
<!--<input type="hidden" name="selected_text" id="selected_text" value="" />-->

  <input type="submit" name = "search" class="btn btn-success" value="ค้นหา" >

<!--<input type="submit" name="search" value="Search"/>-->

    </div>
</div>
<div class="container">
<?php
error_reporting(0);
@include('conn.php');
$dep = $_POST['dep'];
$eats = $_POST['eats'];

if(isset($_POST['search'])){
  $sen=$_POST['sen'];
  if($sen!=""||$dep!=""){
  $Page_Start =0;
  $Per_Page=$Num_Rows;
}
}
if ($dep != 0) {
  # code...
  $strSQL = "SELECT * FROM fpatient_info where clinic = '".$dep."' and (CONCAT(fname,lname) like '%$sen%') ORDER BY clinicdescribe,fname LIMIT $Page_Start , $Per_Page";
$objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");

}
else{
  # code...
$strSQL = "SELECT * FROM fpatient_info  where (CONCAT(fname,lname) like '%$sen%') ORDER BY clinicdescribe,fname LIMIT $Page_Start , $Per_Page";
$objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");
$num=mysql_num_rows($objQuery);
}
?>
<form method="POST" action="chkPHP.php">
<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">ชื่อแผนก</div></th>
    <th><div align="center">รหัสผู้ป่วย</div></th>
    <th><div align="center">เลขที่ผู้ป่วยใน</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
    <th><div align="center">น้ำหนัก</div></th>
    <th><div align="center">ส่วนสูง</div></th>
    <th><div align="center">ห้อง</div></th>
    <th><div align="center">เตียง</div></th>
    <th><div align="center">รหัสแผนก</div></th>

    <!--<th><div align="center">มื้ออาหาร</div></th>
    <th><div align="center">ธรรมดา</div></th>
    <th><div align="center">พิเศษ</div></th>
    <th><div align="center">อาหารเฉพาะโรค</div></th>-->
  </tr>

<?
$new_hn = array();
$i = 0;
if($num==0){
  echo"<script language=\"JavaScript\">";

echo"alert('ไม่พบข้อมูล')";

echo"</script>";
echo( "<script>window.location='HN_patient.php';</script>");
}
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...


$i++;
?>
 <!-- เรียงแบบ การจัดส่งอาหาร

 <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["clinic"];?></div></td>
  <td><div><? echo $objReSult["clinicdescribe"];?></div></td>
  <td><div align = "center"><? echo $objReSult["hn"];?></div></td>
  <td><div align = "center"><? echo $objReSult["an"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  </tr>-->

<tr class ="info">
  <td><div align = "center"><? echo $objReSult["clinicdescribe"];?></div></td>
  <td><div align = "center"><?php echo $objReSult["hn"];?></div></td>
  <td><div align = "center"><? echo $objReSult["an"];?></div></td>
  <td><div align = "left"><? echo $objReSult["fname"];?></div></td>
  <td><div align = "left"><? echo $objReSult["lname"];?></div></td>
    <td><div align = "center"><? echo $objReSult["weight"];?></div></td>
  <td><div align = "center"><? echo $objReSult["height"];?></div></td>
   <td><div align = "center"><? echo $objReSult["roomno"];?></div></td>
  <td><div align = "center"><? echo $objReSult["bedno"];?></div></td>
    <td><div align = "center"><? echo $objReSult["clinic"];?></div></td>

  </tr>

<?
}

?>

</table>
<center>
<?php

$pages = new Paginator;
$pages->items_total = $Num_Rows;
$pages->mid_range = 5;
$pages->current_page = $Page;
$pages->default_ipp = $Per_Page;
$pages->url_next = $_SERVER["PHP_SELF"]."?QueryString=value&Page=";

$pages->paginate();

echo $pages->display_pages()
?>
</center>
<!--code การจัดส่งอาหารเดิม-->

</div>
  <div class="container">
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>

  </div>
  <br>
</form>

<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">นายนนธวัฒน์&nbsp;จันทร์กระจ่าง</a></p>
</footer>

<script>

function chk_all(){
    var x=document.getElementsByTagName("input");
    for(i=0;i<=x.length;i++){
      list($data1,$data2) = split("_", $test);
        if(x[i].type=="radio"){
            x[i].checked=true;
        }
    }
}

function unchk_all(){
    var x=document.getElementsByTagName("input");
    for(i=0;i<=x.length;i++){
        if(x[i].type=="radio"){
            x[i].checked=false;
        }
    }
}

function setHn(id){
  $('#hnModal').html(id);
  $.ajax({
  type: "GET",
  url: "loadPatient.php",
  data: { 'hn': id},
  success:function(response){
    var data = JSON.parse(response);
    $('#fname_modal').html(data.fname);
    $('#lname_modal').html(data.lname);
    $('#weight_modal').val(data.weight);
    $('#height_modal').val(data.height);
    console.log(data);
  }
});
 // alert(id);
}
function submitModal(){
  var idFood = $('#food').val();
  var hn = $('#hnModal').html();
  var detail =$('#detail').val();
  var eats = $('#eats2').val();
  var weight = $('#weight_modal').val();
  var height = $('#height_modal').val();
  if(detail.trim() === '' || idFood === "0" || eats === "0"){
    alert('กรุณากรอกข้อมูลให้ครบถ้วน !!');
    return;
  }else{
     //alert(eats);
   $.ajax({
  type: "POST",
  url: "insert_spec.php",
  data: { 'hn': hn,
    'food' : idFood,
    'detail' : detail,
    'name' : name,
    'eats' : eats,
    'weight' : weight,
    'height' : height
  }
})
  .done(function( msg ) {
     // alert( "Send Data : " + msg);
     $('#myModal').modal('hide');
  });
  }
  // alert(idFood + ' ' + hn + ' ' + detail);

}

$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})



</script>

<form method="POST" action="insert_spec.php" id="servform">
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">การสั่งอาหารพิเศษ</h4>
      </div>

      <div class="modal-body">

      <?


      ?>
      <h5><b> รหัสผู้ป่วย : </b><label id="hnModal"></label></h5>
      <b> ชื่อผู้ป่วย :<span id="fname_modal"></span> &nbsp;<span id="lname_modal"></span></b></h5><br>
      <b><h4>น้ำหนัก : <input type="text" name="weight" id="weight_modal" size="10" maxlength="3" style="text-align: center;">&nbsp;กิโลกรัม</b>
      <b><h4>ส่วนสูง : <input type="text" name="height" id="height_modal" size="10" maxlength="3" style="text-align: center;">&nbsp;เซนติเมตร</b></h4>
      <h4><b>มื้ออาหาร : </b>
  <? if ($eats == 4) {
    # code...
    echo "เช้า";
    ?>
    <input type=hidden name="eats2" id="eats2" value ="<? echo $eats;?>">
    <?
    }

      elseif ($eats == 5) {
      echo "กลางวัน";
      ?>
    <input type=hidden name="eats2" id="eats2" value ="<? echo $eats;?>">
    <?
    }
    elseif ($eats == 6) {
      # code...
      echo "เย็น";
      ?>
            <input type=hidden name="eats2" id="eats2" value ="<? echo $eats;?>">
            <?
    }
  ?></h4>


    <h5><b>ประเภทอาหารของอาหาร :
        <!-- ดึงข้อมูลอาหาร -->
          <select id="food" name="food" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
        <option value="o">-------แสดงทั้งหมด-------</option>
        <?
          @include('conn.php');
          $strSQL = "SELECT DISTINCT id_type, type_name FROM type_food";
          $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
          while ($objReSult = mysql_fetch_array($objQuery)) {

        ?>
         <option value=<?echo $objReSult["id_type"];?>><?echo $objReSult["type_name"];?></option>
           <?
            }
           ?>
      </select></b></h5>

          <h5><b> รายละเอียด : </b><label id="textdis"></label></h5><br>
          <div class="form-group">
          <textarea class="form-control" rows="5" id="detail" name="detail" data-validation="required"></textarea>
      </div>

      <div class="modal-footer">
        <input type="button" onclick="submitModal()" name= "submit" class="btn btn-success" value = "submit" >
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
</form>

</body>
</html>


<!-- $i = 0;
while($objResult = mysql_fetch_array($objQuery))
{
$i++;
?>

  <tr>
  <!--  <td><div align="center"><?php // echo $objResult["UserID"];?></div></td>-->
    <!-- <td><div align="center"><?php echo $objResult["Username"];?></div></td>
    <td><?php echo $objResult["name"];?></td>
    <td align="center"><input name="Chk<?php echo $i;?>" id="Chk<?php echo $i;?>" type="checkbox" value="<?php echo $objResult["join_userid"];?>"></td> -->

  <!-- </tr>
  for($i = 1;$i > 50;$i++)
  {
     $Arrey[$i] = $_POST['Chk1']; -->
  <!-- } -->
