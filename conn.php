<?
$connect1 = mysql_connect( 'localhost','root','123456789') or die ("ติดต่อกับฐานข้อมูล Mysql ไม่ได้ ");
mysql_select_db('cpa') or die(“เลือกฐานข้อมูลไม่ได้”);
mysql_query("SET NAMES UTF8");


$connect2 = mysql_connect("localhost","root","123456789","TRUE") or die("เชื่อมต่อ External ไม่ได้");
mysql_select_db('jhosdb',$connect2);
mysql_query("SET NAMES 'utf8'",$connect2);
?>
