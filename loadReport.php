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
		<th><div align="center">รหัสผู้ป่วย</th>
		<th><div align="center">ชื่อ - นามสกุล</th>
		<th><div align="center">ห้อง</th>
		<th><div align="center">เตียง</th>
		<th><div align="center">ชนิดของอาหาร</th>
		<th><div align="center">พิมพ์</th>
	</tr>
			<?php
      while ($row = mysql_fetch_array($res)) { ?>
				<tr class="info">
          <td><div align="center"><?php echo $row['HN']; ?></td>
          <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
          <td><div align="right"><?php echo $row['roomno']; ?></td>
          <td><div align="right"><?php echo $row['bedno']; ?></td>
          <td><?php echo $row['type_food']; ?></td>
					<td><a target="_blank" href="print_order_food.php?hn=<?php echo $row['HN']; ?>&date=<?php echo $date; ?>&eats=<?php echo $eats; ?>"><img src="img/print.png" width="30px" height="30px"></a></td>
				</tr>
    <?php
      }
     ?>
</table>
<div class="modal-footer">
	<a target="_blank" href="print_orderall.php?date=<?php echo $date;?>&eats=<?php echo $eats;?>&clinic=<?php echo $clinic; ?>"><button type="button" class="btn btn-success" name="button">พิมพ์ทั้งหมด</button></a>
	<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
</div>
