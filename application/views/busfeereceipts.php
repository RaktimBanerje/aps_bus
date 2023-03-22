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
            <h1 class="h3 mb-4 text-gray-800">Bus Fees Receipts:</h1>

            <form action="<?php echo base_url(); ?>ins-busfeereceipts" method="post">

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Student Name:</label>
                                                    <select style="width:300px" id="select-state" name="student_nid"
                                                        onchange="stddetails(this.value);">
                                                        <option value="">-Select-</option>
                                                        <?php foreach($std as $s) {  if($s->inactive!="1") { ?>
                                                        <option value="<?php echo $s->sid; ?>">
                                                            <?php echo $s->student_id; ?>
                                                        </option>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12" id="details">
                                                
                                            </div>

                                            <div class="col-md-2 mt-4 d-none">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input checked type="radio" name="payment" class="form-check-input"
                                                            value="cash payment">Cash Payment
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Remarks</label>
                                            <input type="text" class="form-control" name="remarks" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="discount_applied" value="0" />
                                            <input type="text" class="form-control" name="discount_amount" value="0.0" />
                                            <input type="submit" name="save" class="btn btn-success" value="Save" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6" id="payment_form">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Bus Fess Paid Upto Date</td>
                                            <td id="paid_upto"></td>
                                        </tr>
                                        <tr>
                                            <td>From Date</td>
                                            <td>
                                                <input type="date" name="s_from" id="s_from" autocomplete="off"
                                                    class="form-control" placeholder="From Date">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>To Date</td>
                                            <td> 
                                                <input type="date" name="s_to" id="s_to" autocomplete="off"
                                                class="form-control" placeholder="To Date">
                                            </td>
                                        </tr>
                                       <tr>
                                         	<td colspan="2" class="text-center">
                                              <button type="button" class="btn btn-info" onclick="calculate()">Calculate</button>
                                         	</td>
                                       </tr>
                                        <tr>
                                            <td>Total Fees</td>
                                            <td><span id="status"></span></td>
                                        </tr>
                                        <tr style="display: none;" >
                                            <td>Discount</td>
                                            <td><span id="discount"></span></td>
                                        </tr>
                                        <tr style="display: none;">
                                            <td>Payble Fees</td>
                                            <td><span id="payble"></span></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Received Amount</td>
                                            <td id="payment_amount">
                                                <input type="text" id="received_amount" name="received_amount" class="form-control" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Return Amount</td>
                                            <td id="payment_amount">
                                              <span id="return_amount"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php $this->load->view("inc/footer");?>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">


    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
 

    <script>

        function differenceInMonths(date1, date2) {
            const monthDiff = date1.getMonth() - date2.getMonth();
            const yearDiff = date1.getYear() - date2.getYear();

            return monthDiff + yearDiff * 12;
        }

        var student_fee = 0
        var totalfees = 0
        var payblefees = 0
        var discount_applicable = false
        var discount_amount = 0

        function calculate() {
        
            let months = (Math.abs(Number(differenceInMonths(new Date($("#s_from").val()), new Date($("#s_to").val())))) + 1)

            $("#status").empty()

            totalfees = student_fee * months
            payblefees = totalfees
            
            document.getElementById("status").innerText = `${totalfees} INR`

            
            if(discount_applicable) {

                $("#discount").text(discount_amount + " %")
                $("#discount").parent().parent().show()

                payblefees = totalfees - ((totalfees * discount_amount) / 100)

                $("#payble").text(`${payblefees} INR`)
                $("#payble").parent().parent().show()
            }

        }


        function stddetails(sid) {

            var fd = new FormData();
            fd.append("sid", sid);

            student_fee = 0
            totalfees = 0
            payblefees = 0
            discount_applicable = false
            discount_amount = 0

            $("#discount").text("")
            $("#payble").text("")
            $("#paid_upto").text("")
            $("#status").text("")
            $("#discount").text("")
            $("#return_amount").text("")
            $("#received_amount").val("")
            $("input[name='discount_applied']").val("0")
            $("input[name='discount_amount']").val("0.0")

            
            $("#discount").parent().parent().hide()
            $("#payble").parent().parent().hide()
            
            fetch("<?php echo base_url();?>busajax1", { method: "POST", body: fd })
                .then(response => response.json())
                .then(data => {

                    if(data.data.discount_applicable == "1") {
                        discount_applicable = true
                        discount_amount = data.data.discount_amount

                        $("input[name='discount_applied']").val("1")
                        $("input[name='discount_amount']").val(discount_amount)
                    }

                    student_fee = Number(data.bus_fee)
              		
              		$("#s_from").attr("min", data.next_date)
                    $("#s_from").val(data.next_date)
              
                    $("#paid_upto").empty()
                    $("#paid_upto").append(`
                        <span style="color: red;"><strong>${data.last_payment}</strong></span>
                    `)
                    

                    $("#details").empty()
                    $("#details").append(`
                   		<p style="color: black;"><strong>Student ID:</strong> ${data.data.student_id}</p>
                        <p style="color: black;"><strong>Student Name:</strong> ${data.student_name}</p>
                        <p style="color: black;"><strong>Pickup Point:</strong> ${data.pickup_point} (${data.bus_fee} INR/month)</p>
                    `)
                })

        }
      
      $("input[name='received_amount']").change(function () {
        
        $("#return_amount").empty()
        document.getElementById('return_amount').innerText = (Number($("input[name='received_amount']").val()) - payblefees) + " INR"
      })
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</div>
<script>        $(document).ready(function () {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>