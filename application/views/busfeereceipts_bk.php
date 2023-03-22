
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
                    <h1 class="h3 mb-4 text-gray-800">BUS FEES RECEIPTS:</h1>

                    <form action="<?php echo base_url(); ?>ins-busfeereceipts" method="post" >
                       
                    <p>STUDENT NAME:</p>
                    <p><select style="width:300px"  id="select-state"  name="student_nid" onchange="stddetails(this.value);">
                        <option value="">-Select-</option>
                        <?php foreach($std as $s) {  if($s->inactive!="1") { ?>
                        <option value="<?php echo $s->sid; ?>"><?php echo $s->student_id; ?></option>
                      <?php } ?>

                        <?php } ?>
                    </select></p>
                      <div id="ajx"> </div>

                  
                <p>SERVICE FROM: <input type="text" name="s_from" id="s_from" autocomplete="off"> TO: <input type="text" name="s_to" id="s_to" autocomplete="off"></p>

                <p>PAYMENT METHOD:</p>
                  
                <p><label><input type="radio" name="payment" value="cash payment">Cash Payment</label></p>
                <p><label><input type="radio" name="payment" value="cheque payment">Cheque Payment</label></p>
                <p><label><input type="radio" name="payment" value="online payment">Online Payment</label></p>

                <p>REMARKS:</p>
                <P><input type="text" name="remarks"></P>


                <p><input type="submit" name="save" value="save" class="btn btn-success"></p>


              


                    



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
    $( "#s_from" ).datepicker({
        changeMonth: true, 
    changeYear: true, 
    dateFormat: "yy-mm-dd",
    });
  } );
  </script>

<script>
  $( function() {
    $( "#s_to" ).datepicker({
        changeMonth: true, 
    changeYear: true, 
    dateFormat: "yy-mm-dd",
    });
  } );


  function stddetails(sid){
   
    var fd=new FormData();
    fd.append("sid",sid);

    $.ajax({
      url:"<?php echo base_url();?>busajax",
      type:'POST',
      data:fd,
      contentType:false,
      processData:false,
      success:function(resp){

        $("#ajx").html(resp);

      }
    })
  }
  </script>
              
     
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
          </div>
 <script>        $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
                  </script>