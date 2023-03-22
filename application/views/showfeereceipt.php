
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
                    <h1 class="h3 mb-4 text-gray-800">BUS FEES STATEMENT:</h1>
<div class="table-responsive">
                    <table class="table">
    <thead>
      <tr>
          <th>Payment For</th>
        <th>Student Name</th>
        <th>Student Image </th>
        <th>Student Id</th>
        <th>Phone No</th>
        <th>Pickup point (Amount) </th>
        <th>Date(FROM) </th>
        <th>Date (TO) </th>
        <th>Print </th>

      
        
      </tr>
    </thead>
    <tbody>
        <?php foreach($row as $r){?>

            <tr <?php if($r->payment_for=="admission fee"){ ?> style="background: #ffff99" <?php }?>  <?php if(strstr($r->remarks,"pay_")){ ?> style="background: #ffb3b3" <?php } ?>>
      <td><?php echo $r->payment_for; ?></td>
        <td><?php echo $r->student_name; ?></td>
        <td><img src="<?php echo base_url();?>student_images/<?php echo $r->student_image;?>" style="width:120px;"></td>
        <td><?php echo $r->student_id; ?></td>
        <td><?php echo $r->mobile_no;?></td>
        <td><?php echo $r->pic; ?> (<?php echo $r->total_fee; ?>)</td>
        <td><?php echo date("d-m-Y",strtotime($r->s_from)); ?></td>
        <td><?php if($r->s_to!="0000-00-00"){ echo date("d-m-Y",strtotime($r->s_to)); } ?></td>

          
        <td>
               <?php if($r->payment_for=="monthly fee") { ?>
            <a target="_blank" class="btn btn-primary" href="<?php echo base_url();?>printreceipt/<?php echo $r->receipt_id;?>">PRINT</a>
        <?php } else { ?>
 <a target="_blank" class="btn btn-primary" href="<?php echo base_url();?>printadmission/<?php echo $r->receipt_id;?>">PRINT</a>

        <?php } ?>

        </td>
    


        </tr>


      <?php } ?>
    </tbody>
  </table>
  <?php $this->load->view("inc/pagination") ?>
</div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
  
  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
  <script>

    function loadData(limit, page) {
      event.preventDefault()
      window.location.href = `<?php echo base_url() ?>showfeereceipt/${limit}/${page}`
    }

    $(document).on("click", ".pagination li a", function(event) {
        const limit = $("#limit").val()
        const page = event.target.getAttribute("data-ci-pagination-page")
        loadData(limit, page)
    })

    $(document).on("click", "#limit", function(event) {
        const limit = $("#limit").val()
        let currentPage = window.location.pathname.split("/").pop()
        if(Number(currentPage))
        {
            currentPage = Number(currentPage)
        }
        else {
            currentPage = 1
        }
        loadData(limit, currentPage)
    })
  </script>

  <?php $this->load->view("inc/footer");?>