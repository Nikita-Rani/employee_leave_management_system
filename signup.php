<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Apply for leave</title>
</head>

<body>
    <?php require('include/constant.php');?>
    <?php require('nav.php');?>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $employee_name=$_POST['employee_name'];
        $employee_cat=$_POST['employee_cat'];
        // var_dump($employee_cat);
        
        $employee_mobile=$_POST['employee_mobile'];
        $employee_address=$_POST['employee_address'];
        $employee_role=$_POST['employee_role'];
        $employee_email=$_POST['employee_email'];
        if($employee_role=='employee'){
            $role=1;
        }else{
            $role=0;
        }
        $sql="SELECT * FROM `category` WHERE cat_name='$employee_cat'";
        // $sql="SELECT  * from `categories` where cat_name=$employee_cat";
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);
        $employee_cat_id=$row['cat_id'];
        // var_dump($employee_cat_id);
        $sql="INSERT INTO `employee` ( `role`, `employee_name`, `employee_address`, `employee_email`,`employee_mobile`, `employee_cat_id`, `status_id`) VALUES ( '$role', '$employee_name', '$employee_address', '$employee_email','$employee_mobile', '$employee_cat_id', '0')";
        $res=mysqli_query($conn,$sql);
        if($res){
            echo `<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !!</strong> Succesfully registered 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>`;
        }
        else{
            echo`<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops!</strong> something went wrong.please try again.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>`;
        }
    }
    ?>
    <div class="container my-4 ml-4">
        <form action="signup.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Employee name</label>
                <input type="text" class="form-control" name="employee_name" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">employee category</label>
                <input type="text" class="form-control" name="employee_cat" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Employee mobile number</label>
                <input type="number" class="form-control" name="employee_mobile" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Employee address </label>
                <input type="text" class="form-control" name="employee_address" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Select your role </label>
                <select name="employee_role" >
                    <option value="employee">Employee</option>
                    <option value="admin">admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Employee email address</label>
                <input type="email" class="form-control" name="employee_email" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary fluid">Apply</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

</html>