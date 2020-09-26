<?php
    $conn=new mysqli("localhost","root","","leave_management");
    if($conn){
        // echo "successfully connected";
    }else{
        echo "error";
    }
?>