<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<table class="table table-bordered">
    <thead>
      <tr>
        <th>SL NO.</th>
        <th>Student ID</th>
    
        <th>Student Name</th>
        <th>Mobile/Phone No.</th>
        <th>Pickup-Point</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>

    <?php
      $i=0;
      foreach ($row as $r){  if($r->inactive!="1") { $i=$i+1; ?>
      <tr>
        <td> <?php echo $i; ?></td>
       <td> <?php echo $r->student_id; ?></td>
       <td> <?php echo $r->student_name; ?></td>

       <td> <?php echo $r->mobile_no; ?></td>
       <td> <?php echo $r->pic; ?></td>
        <td> <?php echo $r->busfee; ?></td>
      </tr>
      <?php } } ?>

    </tbody>
  </table>

<script>
  window.print();
  setTimeout(function(){
    window.close();
  }, 3000);
</script>