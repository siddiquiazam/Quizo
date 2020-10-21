<?php
   session_start();
   $id = $_SESSION["id"];
   $con =mysqli_connect("localhost","root","");
   mysqli_select_db($con,"quiz_app");
   $query = "select * from users where id = '$id'";
   $result = mysqli_query($con,$query);
   $send = mysqli_fetch_assoc($result);
   $high = $send['high_score'];
   echo json_encode(
      array(
         'high' =>$high
      )
   )
?>