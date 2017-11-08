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
      <p>ข้อมูลการสั่งซื้ออาหารทางสายยาง</p>

            <div class="modal-body">
            <input type='hidden' name='res_name' value=''>
              <h4 align="center"> ร้านค้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;
                            <select>
                              <option value="volvo">dddddddddddddd</option>
                              <option value="saab">vvvvvvvvvvvvv</option>
                              <option value="mercedes">hhhhhhhhhhhhhh</option>
                              <option value="audi">mmmmmmmmmmmmmm</option>
                            </select>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่สั่งซื้อ  &nbsp;&nbsp;:&nbsp;&nbsp;
                <input type="hidden" name="selected_text" id="selected_text" value="" />
                 <input type="date" name="date_buy" size = "8" value=""></td></tr></h4>
                <h4 align="center">&nbsp;&nbsp;&nbsp;&nbsp;รหัสการสั่งซื้อ &nbsp;:
                <input type='text' name ='id_buymat' required value=''>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รหัสผู้สั่งซื้อ &nbsp;&nbsp;:&nbsp;&nbsp;
                <input type='text' name ='id_officer' required value=''></td></tr></h4><br>

      <p>รายละเอียดอาหารทางสายยาง</p>


                <h4 align="center">&nbsp;&nbsp;&nbsp;&nbsp;รหัสอาหารทางสายยาง &nbsp;:
                <input type='text' name ='id_feed' required value=''></td></tr></h4>
           <h4 align="center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่ออาหารทางสายยาง &nbsp;&nbsp;:
                <input type='text' name ='name_feed' required value=''></td></tr></h4>
                 <h4 align="center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนอาหารทางสายยาง &nbsp;:
                <input type='text' name ='number_feed' required value=''>

                      <select>
                              <option value="volvo">กิโลกรัม</option>
                              <option value="saab">กล่อง</option>
                              <option value="mercedes">กรัม</option>
                              <option value="audi">ขีด</option>
                            </select>
               </td></tr></h4><br>

              </div>


          <div class="modal-footer">
  <input type="submit" class="btn btn-success" value="ตกลง" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')">&nbsp;&nbsp;
  <a href="typefood.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไข?')">ยกเลิก</button>
  </center>
</a></div>

		</div>
</div>
