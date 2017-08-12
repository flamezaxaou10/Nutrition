<?php
	 @include('conn.php');
	 $clinic = $_GET['clinic'];
	  $sql = "SELECT * FROM order_food where dep_name = '$clinic' AND type_order = '3'";
      $res = mysql_query($sql,$connect1);
      while ($row = mysql_fetch_array($res)) { ?>
          <td><?php echo $row['HN']; ?></td>
          <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
          <td><?php echo $row['roomno']; ?></td>
          <td><?php echo $row['bedno']; ?></td>
          <td><?php echo $row['type_food']; ?></td>
    <?php
      }
     ?>
