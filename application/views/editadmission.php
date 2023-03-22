
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
                    <h1 class="h3 mb-4 text-gray-800">Student Admission</h1>

                    <form action="<?php echo base_url();?>updadmission" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="sid" value="<?php echo $r->sid; ?>">

                       <p>STUDENT ID</p>
                      <p><input  type="text" name="student_id" value="<?php echo $r->student_id; ?>" ></p>
                      <p>STUDENT NAME</p>
                      <p><input type="text" name="student_name" value="<?php echo $r->student_name; ?>"></p>
                      <p>FATHER NAME</p>
                      <p><input type="text" name="father_name" value="<?php echo $r->father_name; ?>"></p>
                      <p>MOTHER NAME</p>
                      <p><input type="text" name="mother_name" value="<?php echo $r->mother_name; ?>"></p>
                      <p>FULL ADDRESS</p>
                      <p><input type="text" name="address"value="<?php echo $r->address; ?>" ></p>
                      <p>MOBILE/PHONE NUMBER</p>
                      <p><input type="text" name="mobile_no" value="<?php echo $r->mobile_no; ?>"></p>
                      <p>ADHAAR NUMBER</p>
                      <p><input type="text" name="adhaar" value="<?php echo $r->adhaar; ?>"></p>
                      <p>GENDER</p>
                      <p><label><input <?php if ($r->gender=="Male"){echo "checked";} ?> type="radio" name="gender"value="Male" >Male</label></p>
                      <p><label><input <?php if ($r->gender=="Female"){echo "checked";} ?> type="radio" name="gender"value="Female" >Female</label></p>
                      <p>DATE OF BIRTH</p>
                      <p><input type="text" name="dob" id="dob" value="<?php echo $r->dob; ?>"></p>

                       <p>Class</p>
                      <p><input type="text" name="class" value="<?php echo $r->class; ?>" ></p>

       <p>Section</p>
                      <p><input type="text" name="section" required="" class="form-control" value="<?php echo $r->section; ?>"  ></p>
                      <p>Roll</p>
                      <p><input type="text" name="roll" required="" class="form-control" value="<?php echo $r->roll; ?>"  ></p>


                      <p>PICKUP POINT</p>
                      <p><select name="pickup_point">
                        <option value="">-Select-</option>
                        <?php foreach($pickup as $p) { ?>
                        <option <?php if($p->fee_id==$r->pickup_point) { echo "selected"; }?>  value="<?php echo $p->fee_id;?>"><?php echo $p->pickup_point;?> (<?php echo $p->busfee;?>)</option>
                        <?php } ?>

                      </select></p>
                      <p>STUDENT IMAGE</p>
                      <p><input type="file" name="student_image" ></p>
                      <P><img src="<?php echo base_url();?>student_images/<?php echo $r->student_image;?>" style="width:120px;"></P>


                      <p><input type="submit" name="register" value="Save" ></p>
                    

                    </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

                 <?php $this->load->view("inc/footer");?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  
 
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#dob" ).datepicker({
        changeMonth: true, 
    changeYear: true, 
    dateFormat: "yy-mm-dd",
    });
  } );
  </script>