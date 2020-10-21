<?php
   session_start();
   $id = $_POST['id'];
   $pass = $_POST['pass'];
   $flag = false;
   $con =mysqli_connect("localhost","root","");
   if(!$con)
      {
         $mess = "Error in connection.";
      }
      else
      {
         if(!mysqli_select_db($con,"quiz_app"))
         {
            $mess = "Database connection failed";
         }
         else
         {
            $query = "Select * from users where id = '$id' and password = '$pass'";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) == 1) {
               $_SESSION["id"]=$id;
               $mess = "Success";
               $flag = true;
            }
            else {
               $mess = "Invalid Input";
            }
         }
      }

      echo json_encode(
         array(
            "mess" => $mess,
            "flag" => $flag
         )
      )

?>