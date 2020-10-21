<?php

$id_valid = "/^[1-9]{1}[0-9]{1}[A-Z]{3}[0-9]{4}$/";
$email_valid = "/\S+@\S+\.\S+/";
$name_valid = "/^[A-Za-z ]+$/";
$mob_valid = "/^[6-9]{1}[0-9]{9}$/";
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$mob = $_POST['mob'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
$con =mysqli_connect("localhost","root","");
$score = 0;
$mess = "";
$flag = false;
if(isset($_POST['id'])) {
      
   if(!validate()) {
      $mess = "Invalid Input";
   }
   else {
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
            $query = "INSERT INTO users (id,first_name,last_name,email,dob,mobile,password,high_score) VALUES('$id','$fname','$lname','$email','$dob','$mob','$pass','$score')";
            if(mysqli_query($con,$query)) {
               $mess = "Success";
               $flag = true;
            }
            else {
               $mess = "Some fields are not unique";
            }
         }
      }
   }
   echo json_encode(
      array(
         'mess' => $mess,
         'flag' => $flag
      )
      );
}


function validate()
{
   $id_valid = "/^[1-9]{1}[0-9]{1}[A-Z]{3}[0-9]{4}$/";
   $email_valid = "/\S+@\S+\.\S+/";
   $name_valid = "/^[A-Za-z ]+$/";
   $mob_valid = "/^[6-9]{1}[0-9]{9}$/";
   $id = $_POST['id'];
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $email = $_POST['email'];
   $dob = $_POST['dob'];
   $mob = $_POST['mob'];
   $pass = $_POST['pass'];
   $cpass = $_POST['cpass'];
   if($pass != $cpass)
      return false;
   else {
      if(!(preg_match($id_valid,$id)))
         return false;
      else {
         if(!(preg_match($name_valid,$fname)))
            return false;
         else {
            if(!(preg_match($name_valid,$lname)))
               return false;
            else {
               if(!(preg_match($mob_valid,$mob)))
                  return false;
               else {
                  if(!(preg_match($email_valid,$email)))
                     return false;
                  else {
                     return true;
                  }
               }
            }
         }
      }
   }
}


?>