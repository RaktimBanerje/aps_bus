<?php
	class Admin_mod extends CI_Model
	{
		public function fee_ins($data)
		{
			$this->db->insert("ifeesetup",$data);
		}

		public function feeselmod(){

			$q=$this->db->get("ifeesetup");
			$rs=$q->result();
			return $rs;
		}


		public function feedelmod($id){
         
         $this->db->where("fee_id",$id);
		 $this->db->delete('ifeesetup');

		}


		public function feeeditmod($id){
            $this->db->where("fee_id",$id);
			$q=$this->db->get("ifeesetup");
			$rs=$q->row();
			return $rs;

		}

		public function feeupdmod($w,$id){

         $this->db->where("fee_id",$id);
		 $this->db->update("ifeesetup",$w);


		}


		public function studentadmission_mod($w){
        
			$this->db->insert("student_admission",$w);
 $adf=$this->input->post('adf');
			$insert_id = $this->db->insert_id();

 $payment=$this->input->post('payment');
 $remarks=$this->input->post('remarks');

			  $x=array(
"student_nid"=>$insert_id,
"s_from"=>date("Y-m-d",time()),
"s_to"=>"",
"payment_type"=>"",
"remarks"=>"",
'amount'=>$adf,
'payment_for'=>'admission fee',
'total_fee'=>$adf,
'paydate'=>date("Y-m-d",time()),
'payment_type'=> $payment,
'remarks'=>$remarks

  );

  $this->Admin_mod->insbusfeereceiptsmod($x);

  redirect(base_url().'selectadmission');


		}

		public function getpicup(){
			$q=$this->db->get("ifeesetup");
			$rs=$q->result();
			return $rs;
		}



         public function selectadmissionmod(){

			$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->order_by("sid","DESC")->get();
			$rs=$q->result();
			return $rs;


		 }
      
      
              public function selectadmissionmodprint(){
                
                $pickup_point=$this->input->post("pickup_point");

			$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where("student_admission.pickup_point", $pickup_point)->order_by("sid","DESC")->get();
			$rs=$q->result();
			return $rs;


		 }

		 public function deleteadmissionmod($id){
$w=array(
  'inactive'=>'1'
  
  );

            $this->db->where("sid",$id);
		    $this->db->update('student_admission',$w);

		   }

		   public function editadmissionmod($id){

            $this->db->where("sid",$id);
			$q=$this->db->get("student_admission");
			$rs=$q->row();
			return $rs;

		   }


		   public function updadmission($w,$id){

			$this->db->where("sid",$id);
			$this->db->update("student_admission",$w);
   
   
		   }

		   public function insbusfeereceiptsmod($w){

              $this->db->insert("fee_receipts",$w);


		   }


		   public function amount($id){

			$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where("student_admission.sid",$id)->get();
			$rs=$q->row();
			return $rs;
		

		   }


		   public function listbusfeereceipt(){

			$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee, fee_receipts.*,fee_receipts.total_fee")->from("fee_receipts")->join("student_admission","fee_receipts.student_nid=student_admission.sid")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->order_by("receipt_id","desc")->get();
			$rs=$q->result();
			return $rs;


		 }


		

		 public function printreceiptmod($id){
             
			$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee, fee_receipts.*,fee_receipts.total_fee")->from("fee_receipts")->join("student_admission","fee_receipts.student_nid=student_admission.sid")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where("fee_receipts.receipt_id",$id)->get();
			$rs=$q->row();
			return $rs;




		 }


public function daybookm($sf,$st){

			$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee, fee_receipts.*,fee_receipts.total_fee")->from("fee_receipts")->join("student_admission","fee_receipts.student_nid=student_admission.sid")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where("fee_receipts.paydate >= '$sf'")->where("fee_receipts.paydate <= '$st'")->order_by("receipt_id","desc")->get();
			$rs=$q->result();
			return $rs;


		 }

		  public function pendingfeesmod(){

			$td=date("Y-m-d");
           
			$this->db->where("DATE_ADD(s_to, INTERVAL 3 DAY) > '$td'");
			$q=$this->db->get("fee_receipts");
			$rs=$q->result();
			$paid=array();
			foreach($rs as $r){

				$paid[]=$r->student_nid;

			}

		
             if(count($rs)>0){
			$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where_not_in("student_admission.sid",$paid)->get();
			$rs=$q->result();
			 }else{
				$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->get();
				$rs=$q->result();
			 }
		return $rs;

         

		 }
      
		  public function pendingfeesmoddown(){

			$td=date("Y-m-d");
			
           
			$this->db->where("DATE_ADD(s_to, INTERVAL 3 DAY) > '$td'");
			$q=$this->db->get("fee_receipts");
			$rs=$q->result();
			$paid=array();
			foreach($rs as $r){

				$paid[]=$r->student_nid;

			}

		$pp=$this->input->post("pickup_point");
             if(count($rs)>0){
			$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where_not_in("student_admission.sid",$paid)->where("student_admission.pickup_point",$pp)->get();
			$rs=$q->result();
			 }else{
				$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where("student_admission.pickup_point",$pp)->get();
				$rs=$q->result();
			 }
		return $rs;

         

		 }
      
      
      



		 public function busreceivedajaxmod($sid){

			$q=$this->db->select("student_admission.*,ifeesetup.pickup_point as pic,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where("sid",$sid)->get();
			$rs=$q->row();
			return $rs;


		}

		public function insfundtransfermod($f_from ,$f_to){

           $this->db->where("paydate >= '$f_from'");
		   $this->db->where("paydate <= '$f_to'");
		   $q=$this->db->get("fee_receipts");
		   $rs=$q->result();
		   return $rs;


		}


		public function fundtransferdatamod($w){
           
			$this->db->insert('fund_transfer',$w);


		}


		public function fundtransfertablemod(){
			$this->db->order_by("f_id", "asc");
			$q=$this->db->get("fund_transfer");
			$rs=$q->result();
			return $rs;
		}
      
      public function lastp($id){
        $this->db->where("student_nid",$id);
        $this->db->where("payment_for","monthly fee");
        
        $this->db->from("fee_receipts");
$this->db->order_by("s_to", "DESC");
$query = $this->db->get();

		   $rs=$query->result();
		   if(count($rs)>0){
             return date("d-m-Y",strtotime($rs[0]->s_to));
           }else{
             return "No payment till now";
           }
      }
        public function stsm(){
          $id=$this->input->post("student_nid");
        $this->db->where("student_nid",$id);
                $this->db->from("fee_receipts");

$query = $this->db->get();

		   return $rs=$query->result();
          
        }
      
      
      
      
		  public function pendingcsv(){

			$td=date("Y-m-d");
			
           
			$this->db->where("DATE_ADD(s_to, INTERVAL 3 DAY) > '$td'");
			$q=$this->db->get("fee_receipts");
			$rs=$q->result();
			$paid=array();
			foreach($rs as $r){

				$paid[]=$r->student_nid;

			}

		
             if(count($rs)>0){
			$q=$this->db->select("student_admission.student_id,student_admission.student_name,student_admission.mobile_no,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where_not_in("student_admission.sid",$paid)->get();
			$rs=$q->result_array();
			 }else{
				$q=$this->db->select("student_admission.student_id,student_admission.student_name,student_admission.mobile_no,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->get();
				$rs=$q->result_array();
			 }
		return $rs;

         

		 }
      
      
         public function selectadmissionmodcsv(){

			$q=$this->db->select("student_admission.student_id,student_admission.student_name, ,student_admission.father_name,student_admission.mother_name,student_admission.address,student_admission.mobile_no,student_admission.gender,student_admission.dob,student_admission.class,student_admission.section,student_admission.roll,ifeesetup.pickup_point as pic,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where("inactive",'0')->order_by("sid","DESC")->get();
			$rs=$q->result_array();
			return $rs;


		 }
      
      	public function studentPaymentRecords(){

			$q=$this->db->select("student_admission.sid, student_admission.student_id,student_admission.student_name,student_admission.father_name,student_admission.mother_name,student_admission.address,student_admission.mobile_no,student_admission.gender,student_admission.dob,student_admission.class,student_admission.section,student_admission.roll,ifeesetup.pickup_point as pic,ifeesetup.busfee")->from("student_admission")->join("ifeesetup","ifeesetup.fee_id=student_admission.pickup_point")->where("inactive",'0')->order_by("sid","DESC")->get();
			$rs=$q->result_array();
			return $rs;
		}
      
      
      
	}
?>