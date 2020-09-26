<?php
    require('include/constant.php');
    require('nav.php');
    // session_start();
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        // $_SESSION['employee_name']
        $employee_name=$_SESSION['employee_name'];
        
    echo 'welcome '.$employee_name.' whats up!!';
    }
?>