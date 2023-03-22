
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
                    <h1 class="h3 mb-4 text-gray-800"></h1>
                  
                  <div class="row">
                    
                    <div class="col-md-3">
                      <div clas="card">
                        <div class="card-body">
                          <?php date_default_timezone_set("Asia/Calcutta"); ?>
                          <h3 class="text-center font-weight-bold"><?php echo date('d-m-Y'); ?></h3>
                          <h6 class="text-center font-weight-bold"><?php echo date("l"); ?></h6>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div clas="card">
                        <div class="card-body">
                          <div class="row">
                            <h3 class="text-center font-weight-bold clock" id="MyClockDisplay" onload="showTime()"></h3>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row flex-column justify-content-center align-items-center">
                    <h3 class="text-mute">Under Construction</h3>
                    <h6 class="text-mute text-danger">Don't Worry! You May See Some Breaking Changes In This Page</h6>
                  </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
          
<script src="https://code.jquery.com/jquery-3.6.4.slim.js" integrity="sha256-dWvV84T6BhzO4vG6gWhsWVKVoa4lVmLnpBOZh/CAHU4=" crossorigin="anonymous"></script>
<script>
  function showTime(){
  var date = new Date();
  var h = date.getHours(); // 0 - 23
  var m = date.getMinutes(); // 0 - 59
  var s = date.getSeconds(); // 0 - 59
  var session = "AM";

  if(h == 0){
      h = 12;
  }

  if(h == 12){
      session = "PM";
  }

  if(h > 12){
      h = h - 12;
      session = "PM";
  }

  h = (h < 10) ? "0" + h : h;
  m = (m < 10) ? "0" + m : m;
  s = (s < 10) ? "0" + s : s;

  var time = h + ":" + m + ":" + s + " " + session;
  document.getElementById("MyClockDisplay").innerText = time;
  document.getElementById("MyClockDisplay").textContent = time;

  setTimeout(showTime, 1000);

  }

  $(document).ready(async function() {
    showTime()
  })
</script>

            
   <?php $this->load->view("inc/footer");?>