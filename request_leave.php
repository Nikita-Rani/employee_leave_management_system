<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Leave Management</title>
  </head>
  <body>
  <?php require('include/constant.php')?>
  <?php require('nav.php')?>
  <div class="container my-3 mx-2">
<table class="table my-3 ml-4">
  <thead>
    <tr>
      <th scope="col">s.no</th>
      <th scope="col">employee name</th>
      <th scope="col">employee category name</th>
      <th scope="col">Reason for leave</th>
      <th scope="col">Duration for leave</th>
      <th scope="col">Action</th>
      <!-- <th scope="col">Handle</th> -->
    </tr>
  </thead>
  <tbody>
  <?php
     
      if(isset($_GET['type']) && $_GET['type']=='approve'&& isset($_GET['leave_id'])){
          $leave_id=mysqli_real_escape_string($conn,$_GET['leave_id']);
          $sql="UPDATE `leave_apply` SET `leave_status` = '1' WHERE `leave_apply`.`leave_id` = $leave_id";
          $res=mysqli_query($conn,$sql);
       }
       if(isset($_GET['type']) && $_GET['type']=='editapproved'&& isset($_GET['leave_id'])){
        $leave_id=mysqli_real_escape_string($conn,$_GET['leave_id']);
        $sql="UPDATE `leave_apply` SET `leave_status` = '0' WHERE `leave_apply`.`leave_id` = $leave_id";
        $res=mysqli_query($conn,$sql);
     }
     if(isset($_GET['type']) && $_GET['type']=='reject'&& isset($_GET['leave_id'])){
      $leave_id=mysqli_real_escape_string($conn,$_GET['leave_id']);
      $sql="UPDATE `leave_apply` SET `leave_status` = '2' WHERE `leave_apply`.`leave_id` = $leave_id";
      $res=mysqli_query($conn,$sql);
   }
       $sql="SELECT * from `leave_apply` ORDER BY leave_id DESC";
       // var_dump($sql);
       $res=mysqli_query($conn,$sql);
       $i=1;
  while($row=mysqli_fetch_assoc($res)){
      $leave_id=$row['leave_id'];
      $leave_reason=$row['leave_reason'];
      $leave_duration=$row['leave_duration'];
      $leave_status=$row['leave_status'];
      $employee_id=$row['employee_id'];
      $sql2="SELECT * from `employee` where employee_id=$employee_id";
      $res2=mysqli_query($conn,$sql2);
      $row=mysqli_fetch_assoc($res2);
      $employee_name=$row['employee_name'];
      $employee_cat_id=$row['employee_cat_id'];

      $sql3="SELECT * FROM `category` where cat_id=$employee_cat_id";
      $res3=mysqli_query($conn,$sql3);
      $row3=mysqli_fetch_assoc($res3);
          $employee_cat_name=$row3['cat_name'];

     echo '<tr>
          <th scope="row">'.$i.'</th>
          <td>'.$employee_name.'</td>
          <td>'.$employee_cat_name.'</td>
          <td>'.$leave_reason.'</td>
          <td>'.$leave_duration.'</td>
          <td>';
          if($leave_status==1){
            echo '<a href="request_leave.php?type=editapproved&leave_id='.$leave_id.'"><button class="btn btn-success fluid">approved</button></a>  '; 
           }
           elseif($leave_status==0){
                echo '<a href="request_leave.php?type=approve&leave_id='.$leave_id.'"><button class="btn btn-success fluid">approve</button></a>';
                echo '<a href="request_leave.php?type=reject&leave_id='.$leave_id.'"><button  class="btn btn-danger fluid">reject</button></a>';
            }
           elseif($leave_status==2){
              echo '<button class="btn btn-danger fluid">rejected</button>'; 
             }
          '</td>
      </tr>';
      $i++;
  }
  ?>
  </tbody>
</table>
</div>
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>