<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <title>Fees Payment</title>

    <style>
        body{
            background-color: whitesmoke;
        }
    </style>
</head>

<body>

<div class="container" id="status" style="display: none;">
        <div class="row align-items-center">
            <div class="col-lg-12 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                       <div class="d-none d-md-block text-center mb-4">
                            <img class="img-fluid img-thumbnail" src="<?php echo base_url();?>admin/img/logo.jpg" style="max-width: 26%; height: auto;"/>
                            <hr>
                        </div>
                        <div class="d-block d-md-none text-center mb-2">
                            <img class="img-fluid img-thumbnail" src="<?php echo base_url();?>admin/img/logo.jpg" style="max-width: 52%; height: auto;"/>
                            <hr>
                        </div>
                        <div class="row flex-column align-items-center" id="payment_verifying" style="display: none;">
                            <div class="row justify-content-center my-2">
                                <div class="spinner-border text-primary"></div>
                            </div>
                            <p class="my-2 text-center">Please wait, your payment is verifying. It may take a few seconds.</p>
                            <p class="my-2 text-center font-weight-bold">Don't close or refresh the window.</p>
                        </div>
                        <div class="row flex-column align-items-center" id="payment_success" style="display: none;">
                            <i class="fa fa-check-circle" style="font-size:48px; color: #28a745; text-align: center;"></i>
                            <p class="text-success">Your Payment Is Success</p>
                            <p class="text-muted" style="font-size: 11px;">Your Payment Id</p>
                            <h6 id="payment_id"></h6>
                            <p class="text-muted" style="font-size: 11px;">Keep the payment id for future reference</p>
                        </div>
                        <div class="row flex-column align-items-center" id="payment_failed" style="display: none;">
                            <i class="fa fa-check-circle" style="font-size:48px; color: #dc3545; text-align: center;"></i>
                            <p class="text-danger">Your Payment Is Failed</p>
                            <h6 id="error"></h6>
                            <a class="btn btn-sm btn-warning" href="<?php echo base_url() ?>payment">Try again</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>    
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
// Checkout details as a json
var options = <?php echo json_encode($razorpay_option);?>;

// Boolean whether to show image inside a white frame. (default: true)
// options.theme.image_padding = false;

options.handler = function (response){

    $("#payment_verifying").show()
    $("#status").show()

    const callback_url = `<?php echo base_url() ?>payment/verify`

    const form = new FormData()
    form.append('razorpay_payment_id', response.razorpay_payment_id)
    form.append('razorpay_signature', response.razorpay_signature)

    const fetchOptions = {
        method: 'POST',
        body: form
    }
    
    fetch(callback_url, fetchOptions)
        .then(async (response) => {

            const data = await response.json()

            if(response.status === 200){
                $("#payment_id").text(data.razorpay_payment_id)
                $("#payment_verifying").hide()
                $("#payment_success").show()
            }
            else {
                return Promise.reject(response)
            }
        })
        .catch(error => {
            $("$error").text(error)
            $("#payment_verifying").hide()
            $("#error").show()
        })
};

options.modal = {
    ondismiss: function() {
        window.location.replace("<?php echo base_url() ?>payment");
    },
    // Boolean indicating whether pressing escape key 
    // should close the checkout form. (default: true)
    escape: true,
    // Boolean indicating whether clicking translucent blank
    // space outside checkout form should close the form. (default: false)
    backdropclose: false
};

var rzp1 = new Razorpay(options);
rzp1.open();
</script>
</body>
</html>