

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
                    <h1 class="h3 mb-4 text-gray-800">STUDENT'S LISTING:</h1>
                 <div class="row"> <div class="col-md-3"><input class="form-control" id="myInput" type="text" placeholder="Search.."></div>
                   <div class="col-md-4">
                       <form target="_blabk" action="<?php echo base_url();?>stdprint" method="post"> 
                    
                   <p> <select name="pickup_point" required="">
                        <option value="">-Select-</option>
                        <?php foreach($pickup as $p) { ?>
                        <option value="<?php echo $p->fee_id;?>"><?php echo $p->pickup_point;?> (<?php echo $p->busfee;?>)</option>
                        <?php } ?>

                      </select>  <input type="submit"  class="btn btn-primary" value="Print/Download"></p>
              
                        </form>
                   </div>
                   
                   <div class="col-md-2">
                     <a href="<?php echo base_url();?>student-csv" class="btn btn-success">Total Students History</a>
                   </div>

                   <div class="col-md-3">
                     <a href="<?php echo base_url();?>student-payment-records-csv" class="btn btn-success">Total Students Payment History</a>
                   </div>
                   </div> 
                  <?php 
  $aid=$this->session->userdata("admin_id");
      
?>
                    <div class="table-responsive">
                    <table class="table">
    <thead>
      <tr>
        <th>Student Id</th>
        <th>Name</th>
        <th>Father's Name</th>
        <th>Mother's Name</th>
        <th>Address</th>
        <th>Mobile no</th>
        <th>Adhaar</th>
        <th>Gender</th>
        <th>Date Of Birth</th>
        <th>Class</th>
        <th>Section</th>
        <th>Roll</th>
        <th>Pickup Point</th>
        <th>Image</th>
        <?php 
        if($aid==1){
        ?>
         <th>Inactive</th>
        <?php } ?>
        <th>Edit</th>
        
      </tr>
    </thead>
    <tbody id="myTable">
    <?php foreach($row as $r){ ?>
      <tr>
        <td><?php echo $r->student_id; ?></td>
        <td><?php echo $r->student_name;?></td>
        <td><?php echo $r->father_name;?></td>
        <td><?php echo $r->mother_name;?></td>
        <td><?php echo $r->address;?></td>
        <td><?php echo $r->mobile_no;?></td>
        <td><?php echo $r->adhaar;?></td>
        <td><?php echo $r->gender;?></td>
        <td><?php echo $r->dob;?></td>
         <td><?php echo $r->class;?></td>
         <td><?php echo $r->section;?></td>
         <td><?php echo $r->roll;?></td>
        <td><?php echo $r->pic;?> (<?php echo $r->busfee;?>) </td>
        <td><img src="<?php echo base_url();?>student_images/<?php echo $r->student_image;?>" style="width:120px;"></td>
        <?php 
        if($aid==1){
        ?>
       <td> <?php if($r->inactive=="0"){ ?><a onclick="return confirm('are you sure?');" class="btn btn-danger" href="
        <?php echo base_url();?>deleteadmission/<?php echo $r->sid; ?>">Inactive</a> <?php } else { "Already Inactive"; }?></td>
        <?php } ?>
        <td><a class="btn btn-primary" href="<?php echo base_url();?>editadmission/<?php echo $r->sid;?>">EDIT</a></td>
        
        
      </tr>

      <?php } ?>
     
    </tbody>
  </table>
                    </div>

                </div>
                <!-- /.container-fluid -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
            </div>
            <!-- End of Main Content -->

                 <?php $this->load->view("inc/footer");?>