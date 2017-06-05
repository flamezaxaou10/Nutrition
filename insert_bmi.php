<?
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
$weight = $_POST['weight'];
$height = $_POST['height'];
$totalH = $height / 100;
$bmi  = ($weight / ($totalH * $totalH));

// echo $_POST['hn'] . $_POST['weight'] . $_POST['height'];
$sql2 = "SELECT * FROM fpatient_info where hn = '".$_POST["hn"]."'"; 
$objQuery2 = mysql_query($sql2, $connect2);

$objReSult2 = mysql_fetch_array($objQuery2);

$sql = "INSERT into bmi_table (hn, fname, lname, weight, height, bmi) values ('".$objReSult2['hn']."', '".$objReSult2['fname']."', '".$objReSult2['lname']."', '".$_POST['weight']."', '".$_POST['height']."', '".number_format($bmi, 2, '.', '')."')";
mysql_query($sql, $connect1);

if ($bmi < 18.5 ) {
	# code...
	echo "น้ำหนักน้อยเกินไป";
}

elseif ($bmi < 23.5) {
	# code...
	echo "น้ำหนักปกติ";
}

elseif ($bmi < 35) {
	echo "เริ่มจะอวบ";
	# code...
}

elseif ($bmi < 30 ) {
	# code...
	echo "โรคอ้วนระดับ1";
}

elseif ($bmi < 40 ) {
	# code...
	echo "โรคอ้วนระดับ2";
}

elseif ($bmi > 39 ) {
	# code...
	echo "โรคอ้วนขั้นสูงสุด";
}
//echo "complete <BR>";
?>