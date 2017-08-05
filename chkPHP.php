<?php
session_start();
include ('conn.php');

if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}

 $temp  = $_POST['$new_hn'];
 // FOR($X = 0; $X < count($temp); $X++)	{
 // 	echo $temp[$X] . "<BR>";
 // }
//$hn  = $_POST['hn'];
$chkhn = count($temp);
for($i = 1; $i<=$chkhn; $i++) {
	if(isset($_POST['chkfood'.$i]))	{
		$test = $_POST['chkfood'.$i];
	list($data1,$data2) = split("_", $test);

 $sql2 = "SELECT * FROM fpatient_info where hn = '".$data2."'";
 $objQuery2 = mysql_query($sql2, $connect2);

 $objReSult2 = mysql_fetch_array($objQuery2);

 $row = mysql_num_rows($objQuery2);
 //echo $row;



 $chkfood = $_POST['chkfood'.$i];

//  // $food =  array($_POST['chkfood'.$i'']);
//  // $chkfood = count($food]);
// // echo $_POST["hn"]  . " ชื่อ " .$objReSult2['fname'] . "    " . $objReSult2['lname'];
// //echo "complete";
//  // $objQuery4 = mysql_query($sql2);
//  // $objReSult4 = mysql_fetch_array($objQuery4);

date_default_timezone_set("Asia/Bangkok");
$d=strtotime("tomorrow");
$date = date("Y-m-d",$d);
$hn = $data2;
$fname = $objReSult2['fname'];
$lname = $objReSult2['lname'];
$eats = $_POST['eats'];
$clinic = $objReSult2['clinic'];
$dep_name = $objReSult2['clinicdescribe'];
$roomno = $objReSult2['roomno'];
$bedno = $objReSult2['bedno'];
$weight = $objReSult2['weight'];
$height = $objReSult2['height'];
	# code...
 if ($chkfood == 1)
 {
$sql = "INSERT into order_food (HN, fname, lname, eats, clinic, dep_name, roomno, bedno, weight, height, date_order,type_order) values ('$hn','$fname','$lname','$eats','$clinic','$dep_name','$roomno','$bedno','$weight','$height','$date','1')";
echo $sql;
mysql_query($sql, $connect1);
echo "complete <BR>";
}
else if ($chkfood == 2) {
	# code...
	$sql = "INSERT into order_food (HN, fname, lname, eats, clinic, dep_name, roomno, bedno, weight, height, date_order,type_order) values ('$hn','$fname','$lname','$eats','$clinic','$dep_name','$roomno','$bedno','$weight','$height','$date','2')";
echo $sql;
mysql_query($sql, $connect1);
echo "complete <BR>";
}
else
{
	echo "No detail <BR>";
}

}

}
echo "";
?>
