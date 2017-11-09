<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
include 'header.php';
?>
<div class="container">
    <div class="jumbotron">
       <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
       <br>
      <p>ข้อมูลหน่วยนับ</p>

  <div class="modal-body">
  <?php
  $flag=0;
  if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    @include('conn.php');
    $strSQL = "SELECT * FROM unit";
    $objQuery = mysql_query($strSQL, $connect1);
    while ($objReSult = mysql_fetch_array($objQuery)) {
     $gname= $objReSult["unit_name"];
     if($gname==$name){
       $flag=1;
     }
}
if($flag==0){
  @include('conn.php');
  $insert = "INSERT INTO unit  VALUES  ('".$id."','".$name."')";
       $query = mysql_query($insert,$connect1);
            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');</script>");


  if(!$insert){
   echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
       </script>");
  }
}
  }
    @include('conn.php');
    $strSQL = "SELECT MAX(unit_id) FROM unit";
    $objQuery = mysql_query($strSQL, $connect1);
    while ($objReSult = mysql_fetch_array($objQuery)) {
     $result= $objReSult["MAX(unit_id)"];
     $ina="";
       for($a=0;$a<Strlen($result);$a++){
       if($a>=2)$ina =$ina.intval($result[$a])  ;
       }
       $id= "u-".sprintf("%04d", $ina+1);
}
    ?>
     <div class="modal-body">
         <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">

                    <h4> รหัสหน่วยนับ : &nbsp;<input type="text" name="id" value="<?php echo $id; ?>" readonly=""></h4>
                    <h4> ชื่อหน่วยนับ &nbsp;&nbsp;: &nbsp;<input type="text" name="name" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')"><font color="red"> &nbsp;</font><?php if($flag==1)echo "<font color=red>*ชื่อนี้มีในระบบแล้ว</font>"; ?></h4>


         <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit"
            onclick="submitModal()">&nbsp;&nbsp;
         &nbsp;&nbsp; <a href="matandunit.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
        </form>
</div>
 </div>
  </div>
</div>

<form method="post" action="#" class="text-right">
<font color=white> ค้นหาจากชื่อหน่วยนับ : </font></label> <input type="text" name="sen" >
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




<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">นายนนธวัฒน์  จันทร์กระจ่าง</a></p>
</footer>

<script>
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






</body>
</html>
