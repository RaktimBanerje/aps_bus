<?php

class Admin extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->database();
		$this->load->model("Admin_mod");
		$this->load->library('session');
      	$this->load->helper("csv");
     $admin_id=$this->session->userdata("admin_id");
      if($admin_id==""){
        redirect(base_url());
      }
	}

	public function dashboard()
	{
		$this->load->view('dashboard');
	}

	public function setup()
	{
      $aid=$this->session->userdata("admin_id");
      if($aid!='1'){
        redirect(base_url());
      }
		$this->load->view("feesetup");
	}

	public function feeinc()
	{
        $aid=$this->session->userdata("admin_id");
      if($aid!='1'){
        redirect(base_url());
      }
		$n=$this->input->post("pickup_point");
		$f=$this->input->post("busfee");

		$w=array('pickup_point'=>$n, 'busfee'=>$f);
		$this->Admin_mod->fee_ins($w);

		redirect(base_url().'feesetup');
	}


	public function feesel()
	{
        $aid=$this->session->userdata("admin_id");
      if($aid!='1'){
        redirect(base_url());
      }
		$res=$this->Admin_mod->feeselmod();
		$w=array(
         
			'row'=>$res

		);
        $this->load->view('feeselect',$w);

	}

	public function feedel($id){
        $aid=$this->session->userdata("admin_id");
      if($aid!='1'){
        redirect(base_url());
      }

		$this->Admin_mod->feedelmod($id);

		redirect(base_url().'feedel');
	}

	public function feeedit($id){
        $aid=$this->session->userdata("admin_id");
      if($aid!='1'){
        redirect(base_url());
      }

      $res=$this->Admin_mod->feeeditmod($id);

	  $w=array(
        'r'=>$res

	  );
	  $this->load->view("feeedit",$w);

	}

	public function feeupd(){

  $aid=$this->session->userdata("admin_id");
      if($aid!='1'){
        redirect(base_url());
      }
		$n=$this->input->post("pickup_point");
		$f=$this->input->post("busfee");
		$id=$this->input->post("fee_id");

		$w=array('pickup_point'=>$n, 'busfee'=>$f);
		$this->Admin_mod->feeupdmod($w,$id);

		redirect(base_url().'feeselect');
           
    
	}

	// public function showfeereceipt(){
	// 	$res=$this->Admin_mod->listbusfeereceipt();
	// 	$w=array(
	// 		"row"=>$res,
	// 	);
	// 	$this->load->view('showfeereceipt',$w);
	// }

	public function showfeereceipt(){
		$res = $this->Admin_mod->listbusfeereceipt();

		$pagination = $this->config->item('pagination');
		$pagination["base_url"] = base_url().'showfeereceipt';
		$pagination["total_rows"] = count($res);
		$pagination["per_page"] = $this->uri->segment(2)? (int)$this->uri->segment(2) : 10;
		$this->pagination->initialize($pagination);

		$page = $this->uri->segment(3)? (int)$this->uri->segment(3) : 1;
		$start = ($page - 1) * $pagination["per_page"];

		$w=array(
			'pagination_link'  => $this->pagination->create_links(),
			'row'	=>	array_slice($res, $start, $pagination["per_page"]),
			'limit' => $pagination["per_page"],
		);

		$this->load->view('showfeereceipt',$w);
 	}
	// print//

	public function printreceipt($id){
		$res=$this->Admin_mod->printreceiptmod($id);
                  $w=array(
					'r'=>$res
				  );

		$this->load->view('printreceipt',$w);




	}

	public function printadmission($id){
		$res=$this->Admin_mod->printreceiptmod($id);
                  $w=array(
					'r'=>$res
				  );



$this->load->view('admission_print',$w);


	}


      //student admission//





	public function studentadmission(){

		$res=$this->Admin_mod->getpicup();
		$w=array(
   'pickup'=>$res

		);

        $this->load->view("admission",$w);


	}

	public function insertadmission(){

       $si=$this->input->post('student_id');
	   $sn=$this->input->post('student_name');
	   $fname=$this->input->post('father_name');
	   $mn=$this->input->post('mother_name');
	   $add=$this->input->post('address');
	   $mo=$this->input->post('mobile_no');
	   $adh=$this->input->post('adhaar');
	   $gn=$this->input->post('gender');
	   $dob=$this->input->post('dob');
	   $pp=$this->input->post('pickup_point');
	      $class=$this->input->post('class');
	       $section=$this->input->post('section');
	        $roll=$this->input->post('roll');
	   $conf=array(

		'upload_path'=>'./student_images',
		'allowed_types'=>'jpg|png|jpeg',
		'max_size'=>2000
	);

	$this->load->library('upload',$conf);
	if(!$this->upload->do_upload('student_image')){

       echo $this->upload->display_errors();

	}
	else{

       $fd=$this->upload->data();
	   $fn=$fd['file_name'];

	   $w=array(
        
        "student_id"=>$si,
		"student_name"=>$sn,
		"father_name"=>$fname,
		"mother_name"=>$mn,
		"address"=>$add,
		"mobile_no"=>$mo,
		"adhaar"=>$adh,
		"gender"=>$gn,
        "dob"=>$dob,
		"pickup_point"=>$pp,
		"student_image"=>$fn,
		'class'=>$class,
		'section'=>$section,
		'roll'=>$roll
	   );

	   $this->Admin_mod->studentadmission_mod($w);

	}

	}

     public function selectadmission(){
      
		$res=$this->Admin_mod->selectadmissionmod();
           $resp=$this->Admin_mod->getpicup();
		$w=array(
         
			'row'=>$res,
          'pickup'=>$resp

		);
        $this->load->view('selectadmission',$w);
	 }


	 public function deleteadmission($id){

		$this->Admin_mod->deleteadmissionmod($id);

		redirect(base_url().'selectadmission');

	  }

	  public function editadmissionfn($id){

		$res=$this->Admin_mod->editadmissionmod($id);

		$resp=$this->Admin_mod->getpicup();
		
		
		$w=array(
			"r"=>$res,
			'pickup'=>$resp
		);
		
		$this->load->view('editadmission',$w);
		
		
		
		}

		public function updadmission(){
            
			$si=$this->input->post('student_id');
			$sn=$this->input->post('student_name');
			$fname=$this->input->post('father_name');
			$mn=$this->input->post('mother_name');
			$add=$this->input->post('address');
			$mo=$this->input->post('mobile_no');
			$adh=$this->input->post('adhaar');
			$gn=$this->input->post('gender');
			$dob=$this->input->post('dob');
			$pp=$this->input->post('pickup_point');
			$id=$this->input->post('sid');
			 $class=$this->input->post('class');
			  $section=$this->input->post('section');
	        $roll=$this->input->post('roll');

			$conf=array(
	 
			 'upload_path'=>'./student_images',
			 'allowed_types'=>'jpg|png|jpeg',
			 'max_size'=>2000
		 );
	 
		 $this->load->library('upload',$conf);
		 if(!$this->upload->do_upload('student_image')){

			$w=array(
			 
				"student_id"=>$si,
				"student_name"=>$sn,
				"father_name"=>$fname,
				"mother_name"=>$mn,
				"address"=>$add,
				"mobile_no"=>$mo,
				"adhaar"=>$adh,
				"gender"=>$gn,
				"dob"=>$dob,
				"pickup_point"=>$pp,
				'class'=>$class,
				'section'=>$section,
				'roll'=>$roll
			   );
	 
			
		 }
		 else{
	 
			$fd=$this->upload->data();
			$fn=$fd['file_name'];
	 
			$w=array(
			 
			 "student_id"=>$si,
			 "student_name"=>$sn,
			 "father_name"=>$fname,
			 "mother_name"=>$mn,
			 "address"=>$add,
			 "mobile_no"=>$mo,
			 "adhaar"=>$adh,
			 "gender"=>$gn,
			 "dob"=>$dob,
			 "pickup_point"=>$pp,
			 "student_image"=>$fn,
			 'class'=>$class,
			 'section'=>$section,
				'roll'=>$roll
			);
		} 

		$this->Admin_mod->updadmission($w,$id);

		redirect(base_url().'selectadmission');

 }

 public function busfeereceipts(){

$res=$this->Admin_mod->selectadmissionmod();
$w=array(
'std'=>$res

);
 $this->load->view("busfeereceipts",$w);
 }


 public function insbusfeereceipts(){
    
  $snid=$this->input->post('student_nid');
  $sf=$this->input->post('s_from');
  $st=$this->input->post('s_to');
  $pm=$this->input->post('payment');
  $rm=$this->input->post('remarks');


$amount=$this->Admin_mod->amount($snid);


$date1 = $sf;
$date2 = $st;

$ts1 = strtotime($date1);
$ts2 = strtotime($date2);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = (($year2 - $year1) * 12) + ($month2 - $month1)+1;

$tf=$diff*$amount->busfee;

$discount = (float)$this->input->post('discount_amount');
$received_amount = (float)$this->input->post('received_amount');

$return_amount = $received_amount - ($tf - (($tf * $discount) / 100));

  $w=array(
"student_nid"=>$snid,
"s_from"=>$sf,
"s_to"=>$st,
"payment_type"=>$pm,
"remarks"=>$rm,
'amount'=>$amount->busfee,
'payment_for'=>'monthly fee',
'total_fee'=>$tf,
'paydate'=>date("Y-m-d",time()),
'discount_applied' => $this->input->post('discount_applied'),
'discount_amount' => $this->input->post('discount_amount'),
'received_amount' => $this->input->post('received_amount'),
'return_amount' => $return_amount
  );

  $this->Admin_mod->insbusfeereceiptsmod($w);

redirect(base_url().'showfeereceipt');

 }


 public function day_book(){
 

 $this->load->view("daybook");
 }

 public function showdaybook(){

 	 $sf=$this->input->post('s_from');
  $st=$this->input->post('s_to');
$res=$this->Admin_mod->daybookm($sf,$st);
         
		$w=array(

			"row"=>$res,
		);

		$this->load->view('daybookshow',$w);
 }


  public function pendingfees(){

      $res=$this->Admin_mod->pendingfeesmod();
    
    $resp=$this->Admin_mod->getpicup();
	

	  $w=array(

		'row'=>$res,
         'pickup'=>$resp
	  );

	$this->load->view('pendingfees',$w);






 }

  
   public function busreceivedajax(){

	$sid=$this->input->post("sid");

  	$res=$this->Admin_mod->busreceivedajaxmod($sid);

    $lastp=$this->Admin_mod->lastp($sid);
     
   	echo "<p>Student name: ".$res->student_name."</p>"; 
	echo "<p>Student pickup point: ".$res->pic."</p>";
	echo "<p>Student Bus fee: ".$res->busfee."/month</p>";
    echo "<p id='student_bus_fee' style='display: none;'>".$res->busfee."</p>";
    echo "<p id='paid_upto' style='display: none;'>".$res->busfee."</p>";
	echo "<h3 style='color:#000;'>Last Payment for : ".$lastp."</h3>";
 }

 
 public function busreceivedajax1(){

	$sid=$this->input->post("sid");

  	$res=$this->Admin_mod->busreceivedajaxmod($sid);

    $lastp=$this->Admin_mod->lastp($sid);
    header('Content-Type: application/json; charset=utf-8');
   
   	echo json_encode([
    	"student_name" => $res->student_name,
        "pickup_point" => $res->pic,
        "bus_fee"      => $res->busfee,
        "last_payment" => $lastp,
        "next_date"    => date('Y-m-d', strtotime($lastp . ' +1 day')),
        "data"		   => $res
    ]);
 }
  
  

 public function fundtransfer(){
  $aid=$this->session->userdata("admin_id");
      if($aid!='1'){
        redirect(base_url());
      }
$this->load->view('fundtransfer');


 }

 public function insfundtransfer(){

	$f_from=$this->input->post("f_from");
	$f_to=$this->input->post("f_to");

    $res=$this->Admin_mod->insfundtransfermod($f_from ,$f_to);
	$total=0;
	foreach($res as $r){
		$total=$total+$r->total_fee;

	 }
	 echo $total;



 }


 
 public function fundtransferdata(){

	$f_from=$this->input->post("f_from");
	$f_to=$this->input->post("f_to");
	$total=$this->input->post("total");
   $remarks=$this->input->post("remarks");
   
   $petty_cash=$this->input->post("petty_cash");
	$pd=date("Y-m-d",time());

	$w=array(
      'f_from'=>$f_from,
	  'f_to'=>$f_to,
	  'f_amount'=>$total,
	  'pay_date'=>$pd,
      'remarks'=>$remarks,
      'petty_cash'=>$petty_cash
	);

	$this->Admin_mod->fundtransferdatamod($w);

	redirect(base_url().'list-fundtransfer');


 }







 public function fundtransfertable(){
     $aid=$this->session->userdata("admin_id");
      if($aid!='1'){
        redirect(base_url());
      }
	$res=$this->Admin_mod->fundtransfertablemod();

	$w=array(

		'row'=>$res
	);

$this->load->view('fundtransfertable',$w);



 }
  
  
  public function pendingfeesdown(){

      $res=$this->Admin_mod->pendingfeesmoddown();

	  $w=array(

		'row'=>$res
	  );

	$this->load->view('pendingfeesdown',$w);






 }
  
  
  
   public function student_statement(){

$res=$this->Admin_mod->selectadmissionmod();
$w=array(
'std'=>$res

);
 $this->load->view("student_statement",$w);
 }
  
  
  public function sts_print(){
    $res=$this->Admin_mod->stsm();
$w=array(
'row'=>$res

);
 $this->load->view("sts_print",$w);
  }
  
  
  public function stdprint(){
    
    $res=$this->Admin_mod->selectadmissionmodprint();
      
		$w=array(
         
			'row'=>$res,
         

		);
        $this->load->view('stdprint',$w);
  }
  
  
 
		  public function pendingcsv(){

			$header = ["Student ID", "Name", "Mobile no", "Amount"];
            $resp=$this->Admin_mod->pendingcsv();
            csv($header, $resp, "PendingCSV");

		 }
      
    public function studentscsv(){

			$header = ["Student ID", "Name", "Father Name", "Mother Name", "Address", "Mobile No", "Gender", "DOB", "Class", "Section", "Roll", "Pickup Point", "Fees"];
            $resp=$this->Admin_mod->selectadmissionmodcsv();
            csv($header, $resp, "StudentCSV");

		 }
    	
  	public function studentPaymentRecordscsv() {
		$header = [
			"Student ID",
			"Name",
			"Mobile No",
			"Gender",
			"Class",
			"Section",
			"Roll",
			"Pickup Point",
			"Fees",
			"January",
			"February",
			"March",
			"April",
			"May",
			"June",
			"July",
            "August",
			"September",
			"October",
			"November",
			"December"
		];

		$records = $this->Admin_mod->studentPaymentRecords();
		$data = [];

		foreach ($records as $key => $record) {
			$months = [
				"January" => "",
				"February" => "",
				"March" => "",
				"April" => "",
				"May" => "",
				"June" => "",
				"July" => "",
				"August" => "",
				"September" => "",
				"October" => "",
				"November" => "",
				"December" => ""
			];

			$temp = [
				"s_id" => $record["student_id"],
				"s_name" => $record["student_name"],
				"mobile_no" => $record["mobile_no"],
				"gender" => $record["gender"],
				"class" => $record["class"],
				"section" => $record["section"],
				"roll" => $record["roll"],
				"pickup_point" => $record["pic"],
				"busfee" => $record["busfee"],
			];

			$last_payment = $this->Admin_mod->lastp($record["sid"]);
			
			if($last_payment == "No payment till now"){
				$data[] = array_merge($temp, $months);
			}
			else {
				$last_payment_month = (int)date("m", strtotime($last_payment));

				for ($month = 1; $month <= $last_payment_month; $month++) { 
					switch($month) {
						case 1 : {
							$months["January"] = "Paid";
							break;
						}
						case 2 : {
							$months["February"] = "Paid";
							break;
						}
						case 3 : {
							$months["March"] = "Paid";
							break;
						}
						case 4 : {
							$months["April"] = "Paid";
							break;
						}
						case 5 : {
							$months["May"] = "Paid";
							break;
						}
						case 6 : {
							$months["June"] = "Paid";
							break;
						}
						case 7 : {
							$months["July"] = "Paid";
							break;
						}
						case 8 : {
							$months["August"] = "Paid";
							break;
						}
						case 9 : {
							$months["September"] = "Paid";
							break;
						}
						case 10 : {
							$months["October"] = "Paid";
							break;
						}
						case 11 : {
							$months["November"] = "Paid";
							break;
						}
						case 12 : {
							$months["December"] = "Paid";
							break;
						}
					}
				}

				$data[] = array_merge($temp, $months);
			}
		}

		csv($header, $data, "Student Payment Records");
	}  
  
	public function student_list() {
		$res=$this->Admin_mod->selectadmissionmod();
		$resp=$this->Admin_mod->getpicup();
		$w=array(
			'row'=>$res,
			'pickup'=>$resp
		);
		$this->load->view('student_list',$w);
	}

	public function student_discount_update() {
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


		$sid = $this->input->get('sid');
		$discount_applicable = $this->input->get('discount_applicable');
		$discount_amount = $this->input->get('discount_amount');

		$res = $this->Admin_mod->editadmissionmod($sid);

		$res->discount_applicable = $discount_applicable;
		$res->discount_amount = $discount_amount;

		$this->Admin_mod->updadmission($res, $sid);

		echo json_encode(["success" => true]);
		return;
		
	}
	
}

?>