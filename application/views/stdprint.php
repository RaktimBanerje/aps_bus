   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
                  
                    <table class="table table-bordered">
    <thead>
      <tr>
        <th>Student Id</th>
        <th>Name</th>
        
        <th>Mobile no</th>
    
        <th>Gender</th>
       
        <th>Class</th>
        <th>Section</th>
        <th>Roll</th>
        <th>Pickup Point</th>
       
        
      </tr>
    </thead>
    <tbody >
    <?php foreach($row as $r){ if($r->inactive=="0"){ ?>
      <tr>
        <td><?php echo $r->student_id; ?></td>
        <td><?php echo $r->student_name;?></td>
        
        <td><?php echo $r->mobile_no;?></td>
    
        <td><?php echo $r->gender;?></td>
     
         <td><?php echo $r->class;?></td>
         <td><?php echo $r->section;?></td>
         <td><?php echo $r->roll;?></td>
        <td><?php echo $r->pic;?> (<?php echo $r->busfee;?>) </td>
      
        
      </tr>

      <?php } } ?>
     
    </tbody>
  </table>
                