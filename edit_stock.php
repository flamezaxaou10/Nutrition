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

<div class="container">
  <div class="jumbotron">
         <br>
        <p>แก้ไขข้อมูลสต๊อก</p>
        <?php
          $ID = $_GET['id'];
          $sql = "SELECT * FROM stock WHERE id_stock = '$ID'";
          $objQuery = mysql_query($sql,$connect1);
          $row = mysql_fetch_array($objQuery);
         ?>
    <div class="modal-body">
       <div class="modal-body">
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสสต๊อก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="id" value="<?php echo $ID; ?>" readonly=""></h4>
                      <h4> ประเภทสต๊อก : &nbsp;<input value="<?php echo $row['name_stock'] ?>"type="text" name="name" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')"><font color="red"> &nbsp;</font><?php if($flag==1)echo "<font color=red>*ชื่อนี้มีในระบบแล้ว</font>"; ?></h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="แก้ไขข้อมูล" name = "submit" onclick="submitModal()"> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="insert_stock.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
    <?php
        if($_POST){
          $stockid = $_POST['id'];
          $stockname = $_POST['name'];
          $sql = "UPDATE stock SET name_stock = '$stockname' WHERE id_stock = '$stockid'";
          $objQuery = mysql_query($sql,$connect1);

          if(!$objQuery){
           echo( "<script> alert('ไม่สามารถแก้ไขข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
               </script>");
          }
          else {
            echo( "<script> alert('แก้ไขข้อมูลสำเร็จ');</script>");
            echo( "<script>window.location='insert_stock.php';</script>");
          }
        }
     ?>
  </div>

<?php
  if ($_GET) {
    $see=$_POST["sen"];
    $strSQL = "SELECT * FROM stock where name_stock like '%$see%' order by id_stock";
    $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
    $num=mysql_num_rows($objQuery);
    if($num==0){
      echo"<script language=\"JavaScript\">";

    echo"alert('ไม่พบข้อมูล')";

    echo"</script>";
    echo( "<script>window.location='stock.php';</script>");
  }
  }
?>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสสต๊อก</div></th>
    <th><div align="center">ประเภทสต๊อก</div></th>
  </tr>

<?
$sql = "SELECT * FROM stock";
$objQuery = mysql_query($sql,$connect1);

while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
    <td><div align = "center"><?php echo $objReSult["id_stock"];?></div></td>
    <td><div align = "left"><? echo $objReSult["name_stock"];?></div></td>
  </tr>
  <?
}

?>
</table>
</div>


<?php include 'footer.php'; ?>
