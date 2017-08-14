<?php
	 @include('conn.php');
	 $clinic = $_GET['clinic'];
	  $date = $_GET['date'];
		$eats = $_GET['eats'];
	  $sql = "SELECT * FROM order_food where clinic = '$clinic' AND type_order = '3' AND date_order = '$date' AND eats = '$eats'";
      $res = mysql_query($sql,$connect1);
?>
<table class="table table-striped table-bordered" border="1" width="100%">
	<tr class="warning">
		<th>รหัสผู้ป่วย</th>
		<th>ชื่อ - นามสกุล</th>
		<th>ห้อง</th>
		<th>เตียง</th>
		<th>ชนิดของอาหาร</th>
		<th>พิมพ์</th>
	</tr>
			<?php
      while ($row = mysql_fetch_array($res)) { ?>
				<tr class="info">
          <td><?php echo $row['HN']; ?></td>
          <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
          <td><?php echo $row['roomno']; ?></td>
          <td><?php echo $row['bedno']; ?></td>
          <td><?php echo $row['type_food']; ?></td>
					<td><a href="print_order_food.php?hn=<?php echo $row['HN']; ?>&date=<?php echo $date; ?>&eats=<?php echo $eats; ?>"><img src="img/print.png" width="30px" height="30px"></a></td>
				</tr>
    <?php
      }
     ?>
</table>
<div class="modal-footer">
	<a href="print_orderall.php?date=<?php echo $date;?>&eats=<?php echo $eats;?>&clinic=<?php echo $clinic; ?>"><button type="button" class="btn btn-success" name="button">พิมพ์ทั้งหมด</button></a>
	<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
</div>
