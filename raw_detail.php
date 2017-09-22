<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{


header('location:login.php');
exit();
}
$username=$_SESSION["Username"];
include 'header.php';
?>
  <table class="table table-striped table-bordered">
    <tr class="warning">
      
    </tr>

  </table>

<?php include 'footer.php'; ?>
