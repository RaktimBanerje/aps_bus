
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
                    <h1 class="h3 mb-4 text-gray-800">Fee edit</h1>
                    <form action="<?php echo base_url();?>feeupd" method="post" >
                    <input type="hidden" name="fee_id" value="<?php echo $r->fee_id; ?>">

                    	<p>Create Pickup Point Name</p>
                    	<p><input type="text" name="pickup_point" value="<?php echo $r->pickup_point; ?>"></p>

                    	<p>Monthly Bus Fee Amount</p>
                    	<p><input  type="number" name="busfee" value="<?php echo $r->busfee; ?>"></p>

                    	<p><input type="submit" name="save"></p>
                    </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

                 <?php $this->load->view("inc/footer");?>