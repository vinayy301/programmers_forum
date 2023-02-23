<?php
$showError=false;
if($_SERVER["REQUEST_METHOD"]=='POST'){
    include 'dbconnection.php';
    $uemail=$_POST['email'];
    $upass=$_POST['pass']; 
    $ucpass=$_POST['cpass'];
 
    $sql="SELECT * FROM `users` WHERE user_email='$uemail'";
    $result=mysqli_query($conn,$sql);
    $numRow=mysqli_num_rows($result);
   
    if($numRow>0){
       
        $showError="This email Already exist.";
    }else{
         if($upass==$ucpass){ //agar pass matche karta hai to uss user ko database me dal do
            $hashpass=password_hash($upass,PASSWORD_DEFAULT); 
           
          $sql="INSERT INTO `users` (`user_email`,`user_pass`,`date`) VALUES ('$uemail','$hashpass', current_timestamp())";
       
          $result=mysqli_query($conn,$sql); 
          
          if($result){
            $showAlert=true;
            header("location:../index.php?signupsuccess=true");
            exit();
          }


        }else{
            $showError="Password do no matched." ;
        }
    }
    header("location:../index.php?signupsuccess=false&error=$showError");
}
?>