
<?php $this->load->view("inc/header");?>
        <!-- Sidebar -->
       <?php $this->load->view("inc/menu");?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                  <?php $this->load->view("inc/top");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">DAY BOOK STATEMENT:</h1>
<div class="table-responsive">
                    <table class="table">
    <thead>
      <tr>
          <th>PAYMENT FOR</th>
        <!-- <th>Student Name</th>
        <th>Student Image </th>
        <th>Student Id</th>
        <th>Phone No</th> -->
        <th>AMOUNT </th>
        <!-- <th>Date(FROM) </th>
        <th>Date (TO) </th> -->
        <th>PAYMENT DATE</th>
       

      
        
      </tr>
    </thead>
    <tbody>
        <?php 
        $total=0;
        $c=0;
        $cq=0;
        $o=0;

        foreach($row as $r){
            $total=$total+$r->total_fee;

            if($r->payment_type=="cash payment"){
                $c=$c+$r->total_fee;
            }
             if($r->payment_type=="cheque payment"){
                $cq=$cq+$r->total_fee;
            }
             if($r->payment_type=="online payment"){
                $o=$o+$r->total_fee;
            }

            ?>

            <tr <?php if($r->payment_for=="admission fee"){ ?> style="background: #ffff99" <?php }?>>
      <td><?php echo $r->payment_for; ?></td>
        <!-- <td><?php echo $r->student_name; ?></td>
        <td><img src="<?php echo base_url();?>student_images/<?php echo $r->student_image;?>" style="width:120px;"></td>
        <td><?php echo $r->student_id; ?></td>
        <td><?php echo $r->mobile_no;?></td>
        <td><?php echo $r->pic; ?> (<?php echo $r->total_fee; ?>)</td> -->
        <!-- <td><?php echo date("d-m-Y",strtotime($r->s_from)); ?></td> -->
        <td><?php echo $r->total_fee; ?> (<?php echo $r->payment_type;?>) </td>
        <td><?php echo date("d-m-Y",strtotime($r->paydate));  ?></td>

        </td>

        </tr>



      <?php } ?>
      
        <tr>
            <th>
                Cash Payment 
            </th>
            <th colspan="2"><?php echo number_format($c,2); ?></th>
        </tr>
        <tr>
            <th>
                Cheque payment
            </th>
            <th colspan="2"><?php echo number_format($cq,2); ?></th>
        </tr>
        <tr>
            <th>
                Online payment
            </th>
            <th colspan="2"><?php echo number_format($o,2); ?></th>
        </tr>

         <tr>
            <th>
                Total
            </th>
            <th colspan="2"><?php echo number_format($total,2); ?></th>
        </tr>

    </tbody>
  </table>
</div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

                 <?php $this->load->view("inc/footer");?>