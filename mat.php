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
      <p>ข้อมูลวัตถุดิบ</p>

  <div class="modal-body">
  <?php
  $flag=0;
  if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $rest = $_POST['store'];
    $stock = $_POST['stock'];
    @include('conn.php');
    $strSQL = "SELECT * FROM material";
    $objQuery = mysql_query($strSQL, $connect1);
    while ($objReSult = mysql_fetch_array($objQuery)) {
     $gname= $objReSult["mat_name"];
     $rname= $objReSult["res_id"];
     $cstcok = $objReSult["id_stock"];
     if(($gname==$name&&$rname==$rest) && $stock ==$cstcok){
       $flag=1;
     }
}
if($flag==0){
  $insert = "INSERT INTO material  VALUES  ('$id','$name','$rest','$stock')";
       $query = mysql_query($insert,$connect1);
            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');</script>");


  if(!$insert){
   echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
       </script>");
  }
}
  }
    $strSQL = "SELECT MAX(mat_id) FROM material";
    $objQuery = mysql_query($strSQL, $connect1);
    while ($objReSult = mysql_fetch_array($objQuery)) {
     $result= $objReSult["MAX(mat_id)"];
     $ina="";
       for($a=0;$a<Strlen($result);$a++){
       if($a>=2)$ina =$ina.intval($result[$a])  ;
       }
       $id= "m-".sprintf("%04d", $ina+1);
}
    ?>
     <div class="modal-body">
         <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">

                    <h4> รหัสวัตถุดิบ : &nbsp;<input type="text" name="id" value="<?php echo $id; ?>" readonly=""></h4>
                    <h4> ชื่อวัตถุดิบ &nbsp;&nbsp;: &nbsp;<input type="text" name="name" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"><font color="red">&nbsp;*</font><?php if($flag==1)echo "<font color=red>ชื่อวัตถุดิบนี้มีในระบบแล้ว</font>"; ?></h4>
                    <h4>ประเภทวัตถุดิบ :  &nbsp;&nbsp;
                      <select name="stock" required>
                        <option value=""  disabled selected>------กรุณาเลือกประเภทวัตถุดิบ-----</option>
                    <?php
                      $sql = "SELECT * FROM stock";
                      $result = mysql_query($sql, $connect1);
                      while ($row = mysql_fetch_array($result)){
                    ?>
                      <option value="<?php echo $row['id_stock']; ?>"><?php echo $row['name_stock']; ?></option>
                    <?php
                      }
                     ?>
                     </select>
                     <font color="red">&nbsp;*</font>
                    </h4>
                    <?php
                       $strSQL = "SELECT * FROM restaurant where type = '1'";
                       $objQuery = mysql_query($strSQL, $connect1);
                    ?>
                    <h4> ร้านค้าวัตถุดิบ &nbsp;&nbsp;: &nbsp;&nbsp;
                      <select name = "store" required>
                        <option value=""  disabled selected>------กรุณาเลือกร้านค้าวัตถุดิบ-----</option>
                     <?
                    @include('conn.php');

                    $strSQL = "SELECT * FROM restaurant where type='FYST01'";
                    $objQuery = mysql_query($strSQL, $connect1);

                    while ($objReSult = mysql_fetch_array($objQuery)) {
                      if ($_POST["dep"] == $objReSult['res_id']) {
                        # code...
                        $sel = "selected";
                      }
                      else
                      {
                        $sel = "";
                      }
                  ?>
                <option value="<? echo $objReSult["res_id"];?>" <? echo $sel; ?>> <? echo $objReSult["res_name"];?></option>
                <?
                }
                ?>
                </select><font color="red">&nbsp;*</font>
                </h4>
                     <!--<input type="submit" name="search" value="Search"/>-->
                  </h4>
         <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit"
            >&nbsp;&nbsp;
         &nbsp;&nbsp; <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>

        </form>
</div>
 </div>
  </div>
  </div>
  <form method="post" action="#" class="text-right">
  <font color=white> ค้นหาจากชื่อวัตถุดิบ : </font></label> <input type="text" name="sen" >
     <input type="submit" class="btn btn-success" name="submit2" value="ค้นหา">
</form>
<?php
@include('conn.php');
$perpage = 20;
if (isset($_GET['page']) && $_GET['page'] != 0) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$start = ($page - 1) * $perpage;
$see=$_POST["sen"];
$strSQL = "SELECT * FROM material a join restaurant b on a.res_id = b.res_id JOIN stock ON a.id_stock = stock.id_stock where mat_name like '%$see%' order by mat_id LIMIT {$start},{$perpage}";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
$num=mysql_num_rows($objQuery);
if($num==0){
  echo"<script language='JavaScript'>";

echo"alert('ไม่พบข้อมูล')";
echo"</script>";
}
?>
<br>
<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสวัตถุดิบ</div></th>
    <th><div align="center">ชื่อวัตถุดิบ</div></th>
    <th><div align="center">ประเภทวัตถุดิบ</div></th>
    <th><div align="center">ร้านค้าวัตถุดิบ</div></th>
    <th><div align="center">แก้ไขข้อมูล</div></th>
     <th><div align="center">ลบข้อมูล</div></th>
  </tr>
<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["mat_id"];?></div></td>
  <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
  <td><div align = "left"><? echo $objReSult["name_stock"];?></div></td>
  <td><div align = "left"><? echo $objReSult["res_name"];?></div></td>
  <td><div align = "center"><a href='edit_mat.php?id=<? echo $objReSult['mat_id'];?>&id2=<? echo $objReSult['mat_name']?>&id3=<? echo $objReSult['res_name']?>' onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
  <td><div align = "center"><a href='delete_mat.php?id=<? echo $objReSult['mat_id'];?>'
  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a></td>

    </tr>
  <?
}

?>
</table>
<?php
  $sql2 = "SELECT * FROM material";
  $query2 = mysql_query($sql2, $connect1);
  $total_record = mysql_num_rows($query2);
  $total_page = ceil($total_record / $perpage);
 ?>
<nav align="center" aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="mat.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
    <?php for($i=1;$i<=$total_page;$i++){ ?>
     <li><a href="mat.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } ?>
    <li class="page-item"><a class="page-link" href="mat.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true">>></span></a></li>
  </ul>
</nav>
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
