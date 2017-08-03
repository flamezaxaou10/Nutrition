<body onLoad="window.print(window.location='insert_feed.php')">
  <?php
include ('conn.php');
$id=$_GET['id'];
?>
  <h4 align=center>ใบสั่งซื้ออาหารทางสายยาง</h4>
  <h4 align=center>ฝ่ายโภชนาการ โรงพยาบาลเจ้าพระยาอภัยภูเบศร</h4>
  <?php
  $strSQL = "SELECT * FROM buymeterial where id_mat ='$id'";
  $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
  while ($objReSult = mysql_fetch_array($objQuery)) {
    $pr=$objReSult['print']+1;

}
echo "<h5 align=right>พิมพ์ครั้งที่ :  $pr </h5>";
echo "<h5 align=right>รหัสใบสั่งซื้อ :  $id </h5>";
$sql  = "update `cpa`.`buymeterial` set `print`='".$pr."' where id_mat = '".$id."'";
$result  = mysql_query($sql);
  $strSQL = "SELECT * FROM `buymeterial` a,sys_user b,restaurant c WHERE a.user_name=b.username and a.res_name=c.res_name  AND typebuy= '2' AND id_mat='$id' order by date desc";
  $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
  while ($objReSult = mysql_fetch_array($objQuery)) {
    date_default_timezone_set('America/New_York');
      $strDate=date('d-m-Y', strtotime($objReSult["date"]));
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("j",strtotime($strDate));
      $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
      $strMonthThai=$strMonthCut[$strMonth];
      $date=$strDay." ".$strMonthThai." ".$strYear;
?>
  <h5 align=right>วันที่ : <?php echo $date; ?></h5>
  ผู้สั่งซื้อ : <?php echo $objReSult['fname']." ".$objReSult['lname']; ?><br>
  ชื่อร้านค้า : <?php echo $objReSult['res_name']; ?><br>
  ชื่อเจ้าของร้าน : <?php echo $objReSult['shopkeeper']; ?><br>
  ที่อยู่ร้าน : <?php echo $objReSult['address']; ?><br><br><br>
<?php
}
   ?>
   <?php
   @include('conn.php');
   $strSQL = "SELECT SUM(price) AS sumprice FROM `detail_buymat` WHERE id_mat='$id'";
   $objQuery = mysql_query($strSQL, $connect1);
   while ($objReSult = mysql_fetch_array($objQuery)) {
    $sum= $objReSult["sumprice"];

   }
    ?>
    <div style="page-break-after: always">
         <table border=1 width="100%">

           <thead>
         <tr>
           <th align=center>ลำดับ</th>

           <th align=center>ชื่ออาหารทางสายยาง</th>
           <th align=center>จำนวน</th>
           <th align=center>หน่วยนับ</th>
           <th align=center>ราคารวม(บาท)</th>

         </tr>
       </thead>
         <?php
         $no=1;
         $strSQL = "SELECT a.id_detail,b.feed_name,a.count,c.unit_name,a.price FROM detail_buymat a,feed b,unit c where a.mat_id=b.feed_id and a.unit_id=c.unit_id AND a.id_mat='$id'";

         $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
         while ($objReSult = mysql_fetch_array($objQuery)) {
           ?>
           <cfoutput>
                 <cfloop>
           <tr>
             <td align=center><?php echo $no ?></td>

             <td align=left><?php echo $objReSult["feed_name"]; ?></td>
             <td align=right><?php echo number_format($objReSult["count"]); ?></td>
             <td align=left><?php echo $objReSult["unit_name"]; ?></td>
             <td align=right><?php echo number_format($objReSult["price"],2); ?></td>
           </tr></cfloop>
           </cfoutput>


           <?php

$no++;

         }


          ?>
          <tr ><td colspan=4 align=right>ราคารวม(บาท)</td><td align=center><?php echo number_format($sum,2)." .- "; ?></td></tr>
          </table>
        </div>
</body>
