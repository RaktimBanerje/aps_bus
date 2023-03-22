
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
                    <h1 class="h3 mb-4 text-gray-800">PENDING FEES:</h1>
                  <div class="row">
                 <div class="col-md-6">
                    <form target="_blabk" action="<?php echo base_url();?>pendingfeesdownload" method="post"> 
                    
                   <p> <select name="pickup_point" required="">
                        <option value="">-Select-</option>
                        <?php foreach($pickup as $p) { ?>
                        <option value="<?php echo $p->fee_id;?>"><?php echo $p->pickup_point;?> (<?php echo $p->busfee;?>)</option>
                        <?php } ?>

                      </select>  <input type="submit"  class="btn btn-primary" value="Print/Download"></p>
              
                        </form>
                  </div>
                  <div class="col-md-6">
                  <a href="<?php echo base_url();?>pending-csv" class="btn btn-success">Download Xls</a>
                  </div>
                  </div>
                    <table class="table">
    <thead>
      <tr>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Mobile/Phone No.</th>
        <th>Pickup-Point</th>
        <th>Amount</th>
        
      </tr>
    </thead>
    <tbody>

    <?php foreach ($row as $r){  if($r->inactive!="1") {  ?>
      <tr>
       <td> <?php echo $r->student_id; ?></td>
       <td> <?php echo $r->student_name; ?></td>

       <td> <?php echo $r->mobile_no; ?></td>
       <td> <?php echo $r->pic; ?> </td>
        <td><?php echo $r->busfee; ?></td>
      </tr>
      <?php } } ?>

    </tbody>
  </table>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

                 <?php $this->load->view("inc/footer");?>