<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Leave Management</title>
</head>

<body>
    <?php include('include/constant.php')?>
    <?php require('nav.php')?>
    <?php
  if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['catid'])){
      $id=mysqli_real_escape_string($conn,$_GET['catid']);
      // var_dump($id);
      $sql="SELECT * from `category`WHERE cat_id='$id'";
      $res=mysqli_query($conn,$sql);
      // var_dump($res);
      if(mysqli_num_rows($res)>0){
        $sql="DELETE FROM `category` WHERE `category`.`cat_id` = $id";
        // var_dump($sql);
        $res=mysqli_query($conn,$sql);
      }
  }
  ?>
    <?php
  
  if($_SERVER["REQUEST_METHOD"]=="POST"){
      $category=$_POST['category_name'];
      $sql="INSERT INTO `category` (`cat_name`) VALUES ('$category')";
      $res=mysqli_query($conn,$sql);
      // echo $category ;
  }

  ?>
    <h1 class="text-center my-3">Add new category</h1>
    <div class="container my-4 ml-4">
        <form action="category.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">category name</label>
                <input type="text" required class="form-control" name="category_name" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary fluid">add category</button>
        </form>
    </div>
    <div class="container my-3 mx-2">
        <table class="table my-3 ml-4">
            <thead>
                <tr>
                    <th scope="col">s.no</th>
                    <th scope="col">category name</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php
  $sql="SELECT * FROM `category`ORDER BY cat_id DESC";
  $res=mysqli_query($conn,$sql);
  // var_dump($res);
  if(mysqli_num_rows($res)>0){
    $i=1;
    while($row=mysqli_fetch_assoc($res)){
      $cat_name=$row['cat_name'];
      $id=$row['cat_id'];
        echo '<tr>
          <th scope="row">'.$i.'</th>
          <td>'.$cat_name.'</td>
          <td><a href="category.php?catid='.$id.'&type=delete">delete</a></td>
        </tr>';
        $i++;
    }
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