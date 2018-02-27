
       <div class="modal-body">
         <h4>&nbsp;รายละเอียดการรับวัตถุดิบเข้าคลัง</h4>
         <table  class="table table-striped table-bordered">
           <tr class="warning">
               <td align=center><b>ลำดับ</td>
            <td align=center><b>ประเภทวัตถุดิบ</td>
            <td align=center><b>ชื่อวัตถุดิบ</td>
             <td align=center><b>จำนวน</td>
             <td align=center><b>คงเหลือ</td>
            <td align=center><b>หน่วยนับ</td>
           </tr>
           <?php
              include ('conn.php');
              $id_mat = $_GET['id'];
               $sql = "SELECT * FROM detail_inputmat d LEFT JOIN material m ON d.mat_id = m.mat_id
                                                        LEFT JOIN feed f ON d.mat_id = f.feed_id
                                                        JOIN unit u ON d.unit_id = u.unit_id
                                                        JOIN stock s ON d.id_stock = s.id_stock
                                                        WHERE d.id_inputmat = '$id_mat' AND stat = '1'";
               $objQuery = mysql_query($sql,$connect1);
               $i = 1;
               while ($objReSult = mysql_fetch_array($objQuery)) {

           ?>
           <tr class ="info">
             <td><div align = "center"><?php echo $i; ?></div></td>
             <td><div align = "left"><? echo $objReSult["name_stock"];?></div></td>
             <?php if ($objReSult['feed_id'] != NULL): ?>
               <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
               <?php $mat = $objReSult["feed_id"]; ?>
             <?php else: ?>
               <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
               <?php $mat = $objReSult["mat_id"]; ?>
             <?php endif; ?>
             <?php

                $sqlb = "SELECT * FROM detail_buymat JOIN input_material ON detail_buymat.id_mat = input_material.id_mat WHERE detail_buymat.mat_id = '$mat' AND input_material.id_inputmat = '$id_mat'";
                $query = mysql_query($sqlb,$connect1);
                $row = mysql_fetch_array($query);
              ?>
             <td><div align = "left"><? echo $objReSult["count"];?></div></td>
             <td><div align = "left"><? echo $row["balance"];?></div></td>
             <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
           </tr>
           <?
           $i++;
         }
         ?>
         </table>
       </div>
