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
      <p>ข้อมูลเมนูอาหาร</p>
<?php
$flag=0;
if(isset($_POST['submit'])){
  @include('conn.php');
  $strSQL = "SELECT * FROM menu";
  $objQuery = mysql_query($strSQL, $connect1);
  while ($objReSult = mysql_fetch_array($objQuery)) {
   $gname= $objReSult["menu_name"];
   if($gname==$_POST['name_menu']){
     $flag=1;
   }
}
if($flag==0){
  $insert_food = "INSERT INTO menu (menu_id,menu_name)  VALUES     ('".$_POST['id_menu']."','".$_POST['name_menu']."')";
  		  $query = mysql_query($insert_food,$connect1);
            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');
  		  window.location='insert_menu.php';</script>");


  if(!$insert){
  	echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิิดพลาดบางประการ');
  		  window.location='insert_menu.php';</script>");
  }
}
}
@include('conn.php');
$strSQL = "SELECT MAX(menu_id) FROM menu";
$objQuery = mysql_query($strSQL, $connect1);
while ($objReSult = mysql_fetch_array($objQuery)) {
 $result= $objReSult["MAX(menu_id)"];
 $ina="";
   for($a=0;$a<Strlen($result);$a++){
   if($a>=2)$ina =$ina.intval($result[$a])  ;
   }
   $id= "MN-".sprintf("%04d", $ina+1);
 }
 ?>
  <div class="modal-body">
         <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">

                    <h4> รหัสเมนูอาหาร : &nbsp;<input type="text" name="id_menu" placeholder="name" value="<?php echo $id; ?>" readonly=""></h4>
                    <h4> ชื่อเมนูอาหาร &nbsp;&nbsp;: &nbsp;<input type="text" name="name_menu" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"><font color="red"> &nbsp;*</font><?php if($flag==1)echo "<font color=red>ชื่อนี้มีในระบบแล้ว</font>"; ?></h4>

         <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit"
            ">&nbsp;&nbsp;

         &nbsp;&nbsp; <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
        </form>
</div>
 </div>
  </div>

  <form method="post" action="#"
  <h4><font color=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ค้นหาจากชื่อเมนูอาหาร : </font></label> <input type="text" name="sen" >
   <!--<input type="hidden" name="selected_text" id="selected_text" value="" />-->

     <input type="submit" class="btn btn-success" name="submit2" value="ค้นหา">
  </form>

  <?php
  @include('conn.php');
  $see=$_POST["sen"];
  $strSQL = "SELECT * FROM menu where menu_name like '%$see%'";
  $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
  $num=mysql_num_rows($objQuery);
  if($num==0){
    echo"<script language=\"JavaScript\">";

  echo"alert('ไม่พบข้อมูล')";

  echo"</script>";
  echo( "<script>window.location='insert_menu.php';</script>");
  }
  ?>
  <br>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสเมนูอาหาร</div></th>
    <th><div align="center">ชื่อเมนูอาหาร</div></th>
    <th width="100"><div align="center">แก้ไขข้อมูล</div></th>
    <th width="100"><div align="center">ลบข้อมูล</div></th>
  </tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["menu_id"];?></div></td>
  <td><div align = "left"><? echo $objReSult["menu_name"];?></div></td>
  <td><div align = "center"><a href='edit_menu.php?id="<? echo $objReSult['menu_id']?>"' onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
  <td><div align = "center"><a href='delete_menu.php?id="<? echo $objReSult['id']?>"'
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
