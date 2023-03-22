
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
                    <h1 class="h3 mb-4 text-gray-800">FEES LISTING:</h1>

                    <table class="table">
    <thead>
      <tr>
        <th>PICKUP POINT NAME</th>
        <th>BUS FEES AMOUNT</th>
        <!--  <th>Delete</th> -->
        <th>RECTIFY</th>
        
      </tr>
    </thead>
    <tbody>
    <?php foreach($row as $r){ ?>
      <tr>
        <td><?php echo $r->pickup_point; ?></td>
        <td><?php echo $r->busfee;?></td>
       <!--  <td><a onclick="return confirm('are you sure?');" class="btn btn-danger" href="
        <?php echo base_url();?>feedel/<?php echo $r->fee_id; ?>">DELETE</a></td> -->
        <td><a class="btn btn-primary" href="<?php echo base_url();?>feeedit/<?php echo $r->fee_id;?>">EDIT</a></td>
        
        
      </tr>

      <?php } ?>
     
    </tbody>
  </table>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

                 <?php $this->load->view("inc/footer");?>