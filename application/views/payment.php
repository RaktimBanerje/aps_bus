<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <title>Fees Payment</title>

    <style>
        body{
            background-color: whitesmoke;
        }
        
        @media only screen and (min-width: 992px) {
            .shadow {
                box-shadow: 1px 1px 20px 2px orange !important;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body shadow">
                        <div class="d-none d-md-block text-center mb-4">
                            <img class="img-fluid img-thumbnail" src="<?php echo base_url();?>admin/img/logo.jpg" style="max-width: 26%; height: auto;"/>
                            <hr>
                        </div>
                        <div class="d-block d-md-none text-center mb-2">
                            <img class="img-fluid img-thumbnail" src="<?php echo base_url();?>admin/img/logo.jpg" style="max-width: 52%; height: auto;"/>
                            <hr>
                        </div>
                        
                        <div class="row">
                            <div class="d-none d-md-block col-md-6">
                                <img src="<?php echo base_url();?>admin/img/scool_bus.jpg" style="width:100%" />
                            </div>
                            <div class="col-md-6">
                                <form action="<?php echo base_url() ?>payment/store" method="POST">
                                    <div class="form-group mt-2">
                                        <label for="student_id">Student ID: </label>
                                        <select data-live-search="true" id="student_id" name="student_id" class="form-control selectpicker" placeholder="Enter student ID" data-size="5">
                                            <?php foreach ($students as $key => $student) { ?>
                                                <option value="<?php echo $student["sid"] ?>"><?php echo $student["student_id"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="card" id="information" style="display: none;">
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <div class="spinner-border text-primary"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="month">Month:</label>
                                        <select class="form-control" id="month" name="month">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>

                                    <div class="form-group mt-5">
                                        <button id="pay-btn" class="btn w-100" onclick="pay()" style="background-color: #00b74a; color: white; font-weight: bold;">Pay <span id="total"></span></button>
                                    </div>
                                    <div class="form-group">
                                        <img src="<?php echo base_url();?>admin/img/payment_methods.png" style="width:100%" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <script>
        const base_url = "<?php echo base_url() ?>"
        let student = {
            sid: "",
            busfee: 0
        }
        let total = 0;

        function calculateTotal() {
            const month = $("#month").val()
            total = Number(month) * Number(student.busfee)
            $("#total").text(`₹${total.toFixed(2)}`)
        }

        $(document).ready(function() {

            $("#month").on("change", async function() {
                calculateTotal()
            })

            $('#student_id').on('changed.bs.select', async function(event, clickedIndex, isSelected, previousValue) {

                $("#total").html('')
                $("#information").show()
                $("#information div").html(`
                    <div class="row justify-content-center">
                        <div class="spinner-border text-primary"></div>
                    </div>
                `)

                const selectedId = event.target.value
                const response = await fetch(`${base_url}payment/student/${selectedId}`)
                const data = await response.json()

                $("#information div").html(`
                    <div>
                        <p class="text-muted">Name: ${data.student_name}</p>
                        <p class="text-muted">Roll: ${data.roll}</p>
                        <p class="text-muted">DOB: ${data.dob}</p>
                        <p class="text-muted">Pickup Point: ${data.pic}</p>
                        <p class="text-muted">Bus fee: ₹${Number(data.busfee).toFixed(2)}/month</p>
                    </div>
                `)
                student.sid = data.sid
                student.busfee = data.busfee
                calculateTotal()
            });
        })
    </script>
</body>

</html>