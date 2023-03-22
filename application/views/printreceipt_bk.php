<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<div class="container">

       <img src="<?php echo base_url(); ?>admin/img/logo.jpg" style="width:100%" />
  
  <h3 style="text-align:center">:Money Receipt For Monthly Fees:</h3>
  <table class="table table-striped" style="margin-top:10px;">
    
    <tbody>
      <tr>
        <td style="width:200px; font-weight: bold;">Student ID:</td>
        <td><?php echo $r->student_id; ?></td>
        
      </tr>
      <tr>
        <td style="width:200px; font-weight: bold;">Student Name:</td>
        <td><?php echo $r->student_name;?></td>
        
      </tr>
      <tr>
        <td style="width:200px; font-weight: bold;">Class:</td>
        <td><?php echo $r->class;?></td>
        
      </tr>
      <tr>
        <td style="width:200px; font-weight: bold;">Section:</td>
        <td><?php echo $r->section;?> <span style="margin-left:50px; font-weight: bold;">Roll No:</span> <span><?php echo $r->roll;?></span></td>
        
      </tr>
      
      
      <tr>
        <td style="width:200px; font-weight: bold;">Student Mobile No:</td>
        <td><?php echo $r->mobile_no;?></td>
        
      </tr>
      <tr>
        <td style="width:200px; font-weight: bold;">Pickup Point: </td>
        <td><?php echo $r->pic; ?> </td>
        
      </tr>
    <tr>
        <td style="width:200px; font-weight: bold;">Amount: </td>
        <td><?php echo $r->total_fee; ?> </td>
        
      </tr>
      
      <tr>
        <td style="width:200px; font-weight: bold;"> Bus fare Date From:</td>
        <td><?php echo date("d-m-Y",strtotime($r->s_from)); ?>  <span style="margin-left:50px; font-weight: bold;">To:</span> <span><?php echo date("d-m-Y",strtotime($r->s_to)); ?></span></td>
        
      </tr>
      
      
    </tbody>
  </table>

<div style="margin-top:50px;">
  <span style="font-weight:bold;">Office Contact No:- +91-9547113170</span>
   <span style="font-weight:bold; float: right; border-top:1px dashed; #000;">Authorized Signature <p><?php echo date("d-m-Y",strtotime($r->paydate)); ?></p></span>
 </div>
</div>


<script>
    window.print();
    setTimeout(function(){
window.close();
    }, 3000);
</script>