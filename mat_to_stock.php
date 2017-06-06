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
        <p>ข้อมูลการรับเข้า</p>
        <?php
          $num = 0;
          $sql = "SELECT COUNT(id_inputmat) FROM input_material";
          $objQuery = mysql_query($sql,$connect1);
          $row = mysql_fetch_array($objQuery);
          $num = sprintf("%03d",$row['COUNT(id_inputmat)'] + 1);

          $sql = "SELECT * FROM input_material ORDER BY id_inputmat";
          $objQuery = mysql_query($sql,$connect1);
         ?>
    <div class="modal-body">
       <div class="modal-body">
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสการรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="id" value="IPMAT-<?php echo $num ?>" readonly=""></h4>
                      <h4> วันที่การรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="date" name="date" required></h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="username" value="<? echo $_SESSION["Username"];?>" readonly=""></h4>
                      <h4>
                        รหัสการสั่งซื้อ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="id_mat">
                          <?php
                              $sql = "SELECT * FROM buymeterial";
                              $select = mysql_query($sql,$connect1);
                              while ($row = mysql_fetch_array($select)) {
                          ?>
                                <option value="<?php echo $row['id_mat'] ?>"><?php echo $row['id_mat'] ?> <?php echo $row['res_name'] ?></option>
                          <?php
                              }
                           ?>
                        </select>
                      </h4>
                      <h4>
                        รหัสการสต๊อก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="id_stock">
                          <?php
                              $sql = "SELECT * FROM stock";
                              $select = mysql_query($sql,$connect1);
                              while ($row = mysql_fetch_array($select)) {
                          ?>
                                <option value="<?php echo $row['id_stock'] ?>"><?php echo $row['id_stock'] ?> <?php echo $row['name_stock'] ?></option>
                          <?php
                              }
                           ?>
                        </select>
                      </h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" onclick="submitModal()"> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="mat_to_stock.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
    <?php
        if($_POST){
            $id_input = $_POST['id'];
            do {
              $pname = $_POST['username'];
              $id_mat = $_POST['id_mat'];
              $date = $_POST['date'];
              $id_stock = $_POST['id_stock'];
              $sql = "INSERT INTO input_material (id_inputmat,id_mat,username,date,id_stock) VALUES ('$id_input','$id_mat','$pname','$date','$id_stock')";
              $objQuery = mysql_query($sql,$connect1);
              $num = sprintf("%03d",$row['COUNT(id_input)']++);
              $stockid = 'IPMAT-'.$num;
            } while (!$objQuery);
          if(!$objQuery){
           echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
               </script>");
          }
          else {
            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');</script>");
            echo( "<script>window.location='mat_to_stock.php';</script>");
          }
        }
     ?>
  </div>
<form method="get" action="?Search=1">
  <div class="text-right">
    <font color=white> ค้นหาจากรหัสการรับเข้า : </font></label> <input type="text" name="sen" >
    <input type="submit" class="btn btn-success" name="submit2" value="ค้นหา">
  </div>
</form>
<br>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสการรับเข้า</div></th>
    <th><div align="center">Username</div></th>
    <th><div align="center">รหัสการสั่งซื้อ</div></th>
    <th><div align="center">วันที่รับเข้า</div></th>
    <th><div align="center">รหัสสต๊อก</div></th>
    <th><div align="center">แก้ไขข้อมูล</div></th>
    <th><div align="center">ลบข้อมูล</div></th>
  </tr>
  <?php if ($_GET): ?>
    <?php
          $see=$_GET["sen"];
          $strSQL = "SELECT * FROM input_material where id_inputmat like '%$see%' order by id_inputmat";
          $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
          $num=mysql_num_rows($objQuery);
          if($num==0){
            echo"<script language=\"JavaScript\">";

          echo"alert('ไม่พบข้อมูล')";

          echo"</script>";
          echo( "<script>window.location='mat_to_stock.php';</script>");
        }
     ?>
  <?php endif; ?>
<?


while ($objReSult = mysql_fetch_array($objQuery)) {

?>
  <tr class ="info">
    <td><div align = "center"><?php echo $objReSult["id_inputmat"];?></div></td>
    <td><div align = "left"><? echo $objReSult["username"];?></div></td>
    <td><div align = "left"><? echo $objReSult["id_mat"];?></div></td>
    <td><div align = "left"><? echo $objReSult["date"];?></div></td>
    <td><div align = "left"><? echo $objReSult["id_stock"];?></div></td>
  <td><div align = "center"><a href='edit_inputmat.php?id=<? echo $objReSult['id_inputmat']?>' onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
  <td><div align = "center"><a href='delete_inputmat.php?id=<? echo $objReSult['id_inputmat']?>'
  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a></td>

    </tr>
  <?
}

?>
</table>
</div>

<?php include 'footer.php'; ?>
