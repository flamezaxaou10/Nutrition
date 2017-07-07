<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{


header('location:login.php');
exit();
}

?>

<?php
    $id_output = $_GET['id'];
    $sql = "DELETE FROM output_material WHERE id_outputmat = '$id_output'";
    mysql_query($sql,$connect1);

    $sql = "DELETE FROM detail_outputmat WHERE id_outputmat = '$id_output'";
    mysql_query($sql,$connect1);

    header("LOCATION:out_stock.php");
 ?>
