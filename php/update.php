<?php
   session_start();
   $id = $_SESSION["id"];
   $score = $_POST['score'];
   $con =mysqli_connect("localhost","root","");
   mysqli_select_db($con,"quiz_app");
   $query = "select * from users where id = '$id'";
   $result = mysqli_query($con,$query);
   $send = mysqli_fetch_assoc($result);
   $high = $send['high_score'];
   if($score > $high) {
      $query1 = "update users set high_score = '$score' where id = '$id'";
      mysqli_query($con,$query1);
      $mess = "Updated";
   }
   else {
      $mess = "Not Updated";
   }
   echo json_encode(
      array(
         'mess' =>$mess
      )
   )

?>