<?php
   $id = $_POST['id'];
   $con =mysqli_connect("localhost","root","");
   mysqli_select_db($con,"quiz_app");
   $query = "select * from questions where id = $id";
   $result = mysqli_query($con,$query);
   $send = mysqli_fetch_assoc($result);
   echo json_encode($send);
?>