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
        <p>ข้อมูลหน่วยนับ</p>

    <div class="modal-body">
       <div class="modal-body">
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสหน่วยนับ : &nbsp;<input type="text" name="id" value="<?php echo $id; ?>" readonly=""></h4>
                      <h4> ชื่อหน่วยนับ &nbsp;&nbsp;: &nbsp;<input type="text" name="name" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')"><font color="red"> &nbsp;</font><?php if($flag==1)echo "<font color=red>*ชื่อนี้มีในระบบแล้ว</font>"; ?></h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" onclick="submitModal()"> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="matandunit.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
  </div>
<form method="post" action="#">
<h4><font color=white> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ค้นหาจากชื่อหน่วยนับ : </font></label> <input type="text" name="sen" >
 <!--<input type="hidden" name="selected_text" id="selected_text" value="" />-->

   <input type="submit" class="btn btn-success" name="submit2" value="ค้นหา">
</form>
<br>
<?php
@include('conn.php');
$see=$_POST["sen"];
$strSQL = "SELECT * FROM unit where unit_name like '%$see%' order by unit_id";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
$num=mysql_num_rows($objQuery);
if($num==0){
  echo"<script language=\"JavaScript\">";

echo"alert('ไม่พบข้อมูล')";

echo"</script>";
echo( "<script>window.location='unit.php';</script>");

}
?>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสหน่วยนับ</div></th>
    <th><div align="center">ชื่อหน่วยนับ</div></th>
    <th><div align="center">แก้ไขข้อมูล</div></th>
    <th><div align="center">ลบข้อมูล</div></th>
  </tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["unit_id"];?></div></td>
  <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
  <td><div align = "center"><a href='edit_unit.php?id=<? echo $objReSult['unit_id']?>&id2=<? echo $objReSult['unit_name']?>' onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
  <td><div align = "center"><a href='delete_unit.php?id=<? echo $objReSult['unit_id']?>'
  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a></td>

    </tr>
  <?
}

?>
</table>
</div>


<?php include 'footer.php'; ?>
