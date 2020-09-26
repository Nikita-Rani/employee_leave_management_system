<?php
?>
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
  <?php
  if($_SERVER['REQUEST_METHOD']=="POST"){
    $employee_email=$_POST['employee_email'];
    $pass=$_POST['employee_pass'];
    $sql="SELECT * FROM `employee` where employee_email='$employee_email' AND employee_mobile='$pass'";
    // var_dump($sql);
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
      $row=mysqli_fetch_assoc($res);
      $role=$row['role'];
      $employee_name=$row['employee_name'];
      $employee_id=$row['employee_id'];
      session_start();
      $_SESSION['loggedin']=true;
      $_SESSION['employee_id']=$employee_id;
      $_SESSION['employee_name']=$employee_name;
      // var_dump($_SESSION['employee_name']);
      echo`<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Success!!</strong> Successfully logged in
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>`;
      header("location:home.php?employee_name='.$employee_name.'");
    }
  }
  ?>
  <h1 class="text-center my-2 px-3">Login to enjoy services</h1>
  <form action="login.php" method="post">
  <div class="container my-2 ml-2">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="employee_email" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="employee_pass">
    <small id="emailHelp" class="form-text text-muted">use your  mobile number as password.</small>

  </div>
  <button type="submit" class="btn btn-primary">login</button>
</form>
</div>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>