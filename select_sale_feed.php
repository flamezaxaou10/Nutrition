
    <h4>รายละเอียดการขายอาหารทางสายยาง</h4>
    <?php
      include 'conn.php';
        $salefeed_id = $_GET['id'];
        $sql = "SELECT * FROM sale_feed WHERE salefeed_id = '$salefeed_id'";
        $result = mysql_query($sql,$connect1);
        $row = mysql_fetch_array($result);
        date_default_timezone_set("Asia/Bangkok") ;
        $strDate=$row['date'];
          $strYear = date("Y",strtotime($strDate))+543;
          $strMonth= date("n",strtotime($strDate));
          $strDay= date("j",strtotime($strDate));
          $strDays= date("l",strtotime($strDate));
          $strDayCut = Array("Monday"=>"วันจันทร์","Tuesday"=>"วันอังคาร","Wednesday"=>"วันพุธ","Thursday"=>"วันพฤหัสบดี","Friday"=>"วันศุกร์","Saturday"=>"วันเสาร์","Sunday"=>"วันอาทิตย์");
          $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
          $strMonthThai=$strMonthCut[$strMonth];
          $strDaysThai = $strDayCut[$strDays];
          $date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;
     ?>
  <div class="modal-body">
      <style media="screen">
        td{
          padding-bottom : 20px;
        }
      </style>
      <form action="" method="post">
       <table>
         <tr >
           <td>รหัสการขายอาหารทางสายยาง </td>
           <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
           <td> <?php echo $salefeed_id; ?></td>
         </tr>
         <tr>
           <td>วันที่ขาย </td>
           <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
           <td> <?php echo $date; ?></td>
         </tr>
         <tr>
           <td>ชื่อผู้ซื้อ </td>
           <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
           <td> <?php echo $row['customer']; ?></td>
         </tr>
      </table>
  </div>
  <table class="table table-striped table-bordered">
    <tr class="warning">
       <td align=center><b>ลำดับ</td>
       <td align=center><b>รหัสอาหารทางสายยาง</td>
       <td align=center><b>ชื่ออาหารทางสายยาง</td>
     <td align=center><b>จำนวน</td>
       <td align=center><b>หน่วยนับ</td>
       <td align=center><b>ราคารวม(บาท)</td>
    </tr>
  <?php
    $table = "SELECT d.feed_id,f.feed_name,SUM(d.count),u.unit_name,d.price FROM detail_sale_feed d
                      JOIN feed f ON d.feed_id = f.feed_id
                      JOIN unit u ON d.unit_id = u.unit_id
                      WHERE salefeed_id = '$salefeed_id' GROUP BY f.feed_id";
    $result = mysql_query($table,$connect1);
    $i = 0;
    $total = 0;
    while ($row = mysql_fetch_array($result)){
      $id = $row['salefeed_id'];
      $i++;
    ?>
    <tr class ="info">
      <td align=center><?php echo $i; ?></td>
      <td align=center><?php echo $row['feed_id']; ?></td>
      <td align=center><?php echo $row['feed_name']; ?></td>
      <td align=right><?php echo $row['SUM(d.count)']; ?></td>
    <td align=center><?php echo $row['unit_name']; ?></td>
      <td align="right"><?php echo number_format(($row['SUM(d.count)']*$row['price']),2); ?></td>
    </tr>
    <?php
     $total += $row['SUM(d.count)']*$row['price'];
    }
    ?>
    <tr class ="info">
      <td colspan="5" align="right"><b>ราคาทั้งหมด : </b></td>
      <td align="right"><b><?php echo  number_format($total,2); ?></b> <b>บาท</b></td>
    </tr>
  </table>
