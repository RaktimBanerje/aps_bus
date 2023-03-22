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
      <h1 class="h3 mb-4 text-gray-800">Student List</h1>
      <div class="row">
        <div class="col-md-3"><input class="form-control" id="myInput" type="text" placeholder="Search.."></div>
      </div>
      <?php 
  $aid=$this->session->userdata("admin_id");
      
?>
      <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Student Id</th>
              <th>Name</th>
              <th>Class</th>
              <th>Section</th>
              <th>Pickup Point</th>
              <th>Discount (%)</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="myTable">
            <?php foreach($row as $r){ ?>
              <tr>
                <td>
                  <?php echo $r->student_id; ?>
                </td>
                <td>
                  <?php echo $r->student_name;?>
                </td>
                <td>
                  <?php echo $r->class;?>
                </td>
                <td>
                  <?php echo $r->section;?>
                </td>
                <td>
                  <?php echo $r->pic;?>( <?php echo $r->busfee; ?> )
                </td>

                <form id="<?php echo $r->sid; ?>">
                  <td class="d-flex">
                    <input type="text" class="form-control d-none" id="sid_<?php echo $r->sid; ?>" name="sid"  value="<?php echo $r->sid; ?>" />  
                    <input type="checkbox" class="form-input-check" id="discount_applicable_<?php echo $r->sid; ?>" name="discount_applicable" value="<?php echo $r->discount_applicable == 1 ? 1 : 0 ?>" <?php if($r->discount_applicable == 1) { echo "checked";} ?> />
                    <input type="text" class="form-control ml-2" id="discount_amount_<?php echo $r->sid; ?>" name="discount_amount"  value="<?php echo $r->discount_amount ?>" />
                  </td>
                  <td>
                    <button type="button" type="submit" id="btn_<?php echo $r->sid; ?>" class="btn btn-info" onclick="save(<?php echo $r->sid; ?>)">Save</button>
                  </td>
                </form>
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
      $(document).ready(function () {
        $("#myInput").on("keyup", function () {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
    </script>
  </div>
  <!-- End of Main Content -->

  <script>

    const save = (id) => {

      $(`btn_${id}`).attr('disabled', true);

      const sid = $(`#sid_${id}`).val()
      const discount_applicable =  $(`#discount_applicable_${id}`).is(":checked")
      const discount_amount = $(`#discount_amount_${id}`).val()


      fetch(`<?php echo base_url() ?>updiscount?sid=${sid}&discount_applicable=${discount_applicable}&discount_amount=${discount_amount}`)
      .then(response => response.json())
      .then(data => {
        if(data.success) {
          alert("Successfully Saved");
          $(`btn_${id}`).attr('disabled', false);
        }
        else {
          alert("Unable to Save")
          $(`btn_${id}`).attr('disabled', false);
        }
      })
      .catch(err => {
        alert("Unable to Save")
        $(`btn_${id}`).attr('disabled', false);
      })
    }

  </script>

  <?php $this->load->view("inc/footer");?>