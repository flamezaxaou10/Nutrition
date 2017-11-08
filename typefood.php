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
      <p>ข้อมูลประเภทอาหาร</p>
<?php
$flag=0;
if(isset($_POST['submit'])){
  @include('conn.php');
  $strSQL = "SELECT * FROM type_food";
  $objQuery = mysql_query($strSQL, $connect1);
  while ($objReSult = mysql_fetch_array($objQuery)) {
   $gname= $objReSult["type_name"];
   if($gname==$_POST['name_food']){
     $flag=1;
   }
}
if($flag==0){
  $insert_food = "INSERT INTO type_food (id_type,type_name) VALUES ('".$_POST['id_food']."','".$_POST['name_food']."')";
  		  $query = mysql_query($insert_food,$connect1);
            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');
  		  window.location='typefood.php';</script>");


  if(!$insert){
  	echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิิดพลาดบางประการ');
  		  window.location='typefood.php';</script>");
  }
}
}
@include('conn.php');
$strSQL = "SELECT MAX(id_type) FROM type_food";
$objQuery = mysql_query($strSQL, $connect1);
while ($objReSult = mysql_fetch_array($objQuery)) {
 $result= $objReSult["MAX(id_type)"];
 $ina="";
   for($a=0;$a<Strlen($result);$a++){
   if($a>=2)$ina =$ina.intval($result[$a])  ;
   }
   $id= "TYP".sprintf("%03d", $ina+1);
 }
 ?>
  <div class="modal-body">
         <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">

                    <h4> รหัสประเภทอาหาร : &nbsp;<input type="text" name="id_food" placeholder="name" value="<?php echo $id; ?>" readonly=""></h4>
                    <h4> ชื่อประเภทอาหาร &nbsp;&nbsp;: &nbsp;<input type="text" name="name_food" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"><font color="red"> &nbsp;*</font><?php if($flag==1)echo "<font color=red>ชื่อนี้มีในระบบแล้ว</font>"; ?></h4>

         <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit"
            onclick="submitModal()">&nbsp;&nbsp;
         &nbsp;&nbsp; <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
        </form>
</div>
 </div>
  </div>
  <form method="post" action="#" class="text-right">
  <font color=white> ค้นหาจากชื่อประเภทอาหาร : </font></label> <input type="text" name="sen" >
     <input type="submit" class="btn btn-success" name="submit2" value="ค้นหา">
  </form>

  <?php
  @include('conn.php');
  $see=$_POST["sen"];
  $strSQL = "SELECT * FROM type_food where type_name like '%$see%'";
  $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
  $num=mysql_num_rows($objQuery);
  if($num==0){
    echo"<script language=\"JavaScript\">";

  echo"alert('ไม่พบข้อมูล')";

  echo"</script>";
  echo( "<script>window.location='typefood.php';</script>");
  }
  ?>
  <br>


<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสประเภทอาหาร</div></th>
    <th><div align="center">ชื่อประเภทอาหาร</div></th>
    <th width="100"><div align="center">แก้ไขข้อมูล</div></th>
    <th width="100"><div align="center">ลบข้อมูล</div></th>
  </tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["id_type"];?></div></td>
  <td><div align = "left"><? echo $objReSult["type_name"];?></div></td>
  <td><div align = "center"><a href='edit_food.php?id=<? echo $objReSult['id_type'];?>&id2=<? echo $objReSult['type_name'];?>' onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
  <td><div align = "center"><a href='delete_food.php?id=<? echo $objReSult['id_type'];?>'
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
