<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<div class="container">

 <?php $student_nid=$this->input->post("student_nid");

$this->db->where("sid",$student_nid);
			$q=$this->db->get("student_admission");
			$k=$q->row();

?>
   <img src="<?php echo base_url(); ?>admin/img/logo.jpg" style="width:100%" />
  
  <h3 style="text-align:center">Student Statement of <?php echo $k->student_name;?> ( <?php echo $k->student_id;?> )</h3>


                    <table class="table table-brodered" >
    <thead>
      <tr>
       
        <th>Payment Date</th>
        <th>Payment From</th>
        <th>Payment To</th>
        <th>Amount</th>
        
      </tr>
    </thead>
    <tbody>

    <?php foreach ($row as $r){ ?>
      <tr>
       <td> <?php echo date("d-m-Y",strtotime($r->paydate)); ?></td>
       <td> <?php if($r->payment_for=="admission fee"){ echo "admission fee"; }else{ echo date("d-m-Y",strtotime($r->s_from)); } ?></td>
        <td> <?php  if($r->payment_for!="admission fee"){ echo date("d-m-Y",strtotime($r->s_to)); } ?></td>

       <td> <?php echo $r->total_fee; ?></td>
    
      </tr>
      <?php } ?>

    </tbody>
  </table>
</div>
<script>
    window.print();
    setTimeout(function(){
window.close();
    }, 3000);
</script>