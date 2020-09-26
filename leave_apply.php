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
    <?php require('include/constant.php')?>
    <?php require('nav.php')?>
    <?php  
    if($_SERVER["REQUEST_METHOD"]=="POST"){

      $employee_name=$_POST['employee_name'];
        // echo $employee_name ;
      $leave_reason=$_POST['leave_reason'];
      $leave_duration=$_POST['leave_duration'];
      $sql="SELECT * FROM `employee` Where employee_name='$employee_name'";
    //   var_dump($sql);
      $res=mysqli_query($conn,$sql);
    //   var_dump($res);
      if(mysqli_num_rows($res)>0){
          $row=mysqli_fetch_assoc($res);
          $employee_cat_id=$row['employee_cat_id'];
        //   var_dump($employee_cat_id);
          $employee_id=$row['employee_id'];
        //   var_dump($employee_id);
          $sql="INSERT INTO `leave_apply` (`leave_reason`, `cat_id`, `employee_id`, `leave_duration`,`leave_status`) VALUES ( '$leave_reason', '$employee_cat_id', '$employee_id', '$leave_duration','0')";
          $res=mysqli_query($conn,$sql);
          if($res){
              echo `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> successfully applied for leave.please wait for the admin response
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>`;
          }
          else{
              echo`<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Oops !</strong> something went wrong please try again.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>`;
          }
      }

    }
  ?>
    <h1 class="text-center my-3">Apply for leave</h1>
    <div class="container my-4 ml-4">
        <form action="leave_apply.php" method="post" >
            <div class="form-group">
                <label for="exampleInputEmail1">Employee name</label>
                <input type="text" class="form-control" name="employee_name" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Reason for leave</label>
                <input type="text" class="form-control" name="leave_reason" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Duration of leave</label>
                <input type="text" class="form-control" name="leave_duration" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary fluid">Apply</button>
        </form>
    </div>
    <h1 class="text-center my-3">Recent Leave status</h1>
    <div class="container my-3 mx-2">
        <table class="table my-3 ml-4">
            <thead>
                <tr>
                    <th scope="col">s.no</th>
                    <th scope="col">employee name</th>
                    <th scope="col">Reason for leave</th>
                    <th scope="col">duration of leave</th>
                    <th scope="col">status </th>


                    <!-- <th scope="col">Handle</th> -->
                </tr>
            </thead>
            <tbody>
            <?php
                $sql="SELECT * from `leave_apply` ORDER BY leave_id DESC";
                // var_dump($sql);
                $res=mysqli_query($conn,$sql);
                $i=1;
            while($row=mysqli_fetch_assoc($res)){
                $leave_status=$row['leave_status'];
                $leave_reason=$row['leave_reason'];
                $leave_duration=$row['leave_duration'];
                $employee_id=$row['employee_id'];
                $sql2="SELECT * from `employee` where employee_id=$employee_id";
                $res2=mysqli_query($conn,$sql2);
                $row=mysqli_fetch_assoc($res2);
                $employee_name=$row['employee_name'];
               echo '<tr>
                    <th scope="row">'.$i.'</th>
                    <td>'.$employee_name.'</td>
                    <td>'.$leave_reason.'</td>
                    <td>'.$leave_duration.'</td>
                    <td>';
                    if($leave_status==0){
                        echo '<button type="submit" class="btn btn-primary fluid">Pending</button>';
                    }elseif($leave_status==1){
                        echo '<button type="submit" class="btn btn-success fluid">approved</button>';
                    }elseif($leave_status==2){
                        echo '<button type="submit" class="btn btn-danger fluid">rejected</button>';
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