<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");
    use Razorpay\Api\Api;
    use Razorpay\Api\Errors\SignatureVerificationError;

    class PaymentController extends CI_Controller {
        
        public function __construct() {
            parent::__construct();

            $this->load->helper("url");
            $this->load->library("session");
            $this->load->database();
            $this->load->helper('form');
            $this->load->model("Payment");
            $this->load->model("Admin_mod");
        }

        public function index() {

        }

        public function create() {
            $students = $this->Payment->get_students();
            $this->load->view("payment", ["students" => $students]);
        }

        public function store() {

            $month = $this->input->post("month");
            $sid = $this->input->post("student_id");
            $student = $this->Admin_mod->busreceivedajaxmod($sid);

            $total_amount = number_format((int)$month * (float)$student->busfee, 2, ".", "");
            
            $api = new Api('rzp_live_3lHfS3OaG8ghUC', 'gBeN6Km845EsgGVORXr0cCZD');

            $razorpayOrder = $api->order->create(array(
            'receipt'         => 'payment_receipt_'.time(),
            'amount'          => $total_amount * 100,
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
            ));

            $amount = $razorpayOrder['amount'];
            $razorpayOrderId = $razorpayOrder['id'];

            $_SESSION['razorpay_order_id'] = $razorpayOrderId;
            $_SESSION['sid'] = $sid;
            $_SESSION['month'] = $month;
            $_SESSION['busfee'] = $student->busfee;
            $_SESSION['last_payment'] = $this->Admin_mod->lastp($sid);

            $razorpay_option = $this->prepareData($amount, $razorpayOrderId, $student);
      
            $this->load->view("razorpay", ["razorpay_option" => $razorpay_option]);
        }

        public function prepareData($amount,$razorpayOrderId, $student)
        {
          $data = array(
            "key" => 'rzp_live_3lHfS3OaG8ghUC',
            "amount" => $amount,
            "name" => "APS Management",
            "description" => "Bus Fees",
            // "callback_url" => base_url() .'payment/verify',
            "prefill" => array(
              "name"  => $student->student_name,
            ),
            "notes"  => array(
              "merchant_order_id" => rand(),
            ),
            "theme"  => array(
              "color"  => "#F37254"
            ),
            "order_id" => $razorpayOrderId
          );
          return $data;
        }

        public function show_student($student_id) {
            $student = $this->Admin_mod->busreceivedajaxmod($student_id);

            header('Content-Type: application/json; charset=utf-8');

            echo json_encode($student);
        }

        public function verify()
        {
          $success = true;
          $error = "payment_failed";
          if (empty($this->input->post('razorpay_payment_id')) === false) {
            $api = new Api('rzp_live_3lHfS3OaG8ghUC', 'gBeN6Km845EsgGVORXr0cCZD');
          try {
              $attributes = array(
                'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                'razorpay_payment_id' => $this->input->post('razorpay_payment_id'),
                'razorpay_signature' => $this->input->post('razorpay_signature')
              );
              $api->utility->verifyPaymentSignature($attributes);
            } catch(SignatureVerificationError $e) {
              $success = false;
              $error = 'Razorpay_Error : ' . $e->getMessage();
            }
          }
          if ($success === true) {
    
            date_default_timezone_set("Asia/Kolkata");

            $from_date = date("Y-m-d", strtotime($_SESSION['last_payment'] . '+ 1 day'));
            $to_date = date('Y-m-t', strtotime($from_date . ' +'.($_SESSION["month"] - 1).' months'));

            $data = array(
                "student_nid"   =>  $_SESSION['sid'],
                "s_from"        =>  $from_date,
                "s_to"          =>  $to_date,
                "payment_type"  =>  "online payment",
                "remarks"       =>  'Transaction ID: '.$attributes["razorpay_payment_id"],
                'amount'        =>  $_SESSION['busfee'],
                'payment_for'   =>  'monthly fee',
                'total_fee'     =>  $_SESSION['busfee'] * $_SESSION['month'],
                'paydate'       =>  date("Y-m-d", time())
              );
              
            $this->Admin_mod->insbusfeereceiptsmod($data);
              
            http_response_code(200);
            header('Content-Type: application/json');

            echo json_encode(
              array( 'razorpay_payment_id' => $attributes['razorpay_payment_id'] )
            );   
          }
          else {
            
            http_response_code(400);
            header('Content-Type: application/json');
            
            echo json_encode(
              array(
                'error' => $error
              )
            );
    
          }
        }
    }
