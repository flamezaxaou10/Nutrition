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
      <p>ข้อมูลการจัดเมนูอาหาร</p>
      <br>
      <?php

       ?>
      <form method="post" action="print_test.php">
      <div style="float:left; font-size: 1.5em;">วันที่</div><div style="float:left; font-size: 1.5em;">&nbsp;<input type="date" name="daytime" size = "8" value="<?php echo date(); ?>"><font color="red"> &nbsp;*&nbsp;&nbsp;</font><a href="editdetailorder.php"><input type="submit1" class="btn btn-success" name="submit2" value="ค้นหาและแก้ไขข้อมูล"></a><br></div>
<br />
<br />

<div style="float:left; font-size: 1.5em;">เจ้าหน้าที่</div><div style="float:left; font-size: 1.5em;">&nbsp;
  <?php echo $_SESSION["fnname"];?>&nbsp;<?php echo $_SESSION["lnname"];?>
</div>
<br />

<?php
@include('conn.php');
 ?>
  <div class="modal-body">

        <table class="table table-striped table-bordered" border="1" width="100%">
          <tr class="warning">
            <th></th><th></th><th><div align="center">พิเศษ</th><th><div align="center">สามัญ</th><th><div align="center">เจ้าหน้าที่</th>
          </tr>
          <tr class ="info">
            <td align="center"><b>เช้า</td>
            <td></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list1[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list2[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list3[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
          </tr>
          <tr class ="info">
            <td rowspan="2" align="center"><b>กลางวัน</td>
            <td align="center"><b>ธรรมดา</td>
            <td>
                    <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list4[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                    $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list5[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu ";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list6[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
          </tr>
          <tr class ="info">
            <td align="center"><b>อ่อน</td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list7[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list8[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      </td>
          </tr>
          <tr class ="info">
            <td td rowspan="2" align="center"><b>เย็น</td>
            <td align="center"><b>ธรรมดา</td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list10[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list11[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list12[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
          </tr>
          <tr class ="info">
            <td align="center"><b>อ่อน</td>
            <td>
                     <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list13[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list14[]" value="<?php echo $objReSult['menu_name'];?>"> <label style="font-size:13px"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      </td>
          </tr>
        </table>
        <h4>หมายเหตุ</h4>
        <textarea class="form-control" rows="3" id="detail" name="deta"  data-validation="required"><?php echo $ff; ?></textarea><br />
        <div style="float: right;"><input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit"></div>
      </form>

  </div>
 </div>
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
