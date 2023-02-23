<?php
if($_SERVER["REQUEST_METHOD"] =="POST"){
    include 'dbconnection.php';
$email=$_POST['email'];   // post[email]login form ka email hai
$pass=$_POST['pass'];
$sql="SELECT * FROM `users` WHERE user_email='$email'";
$result=mysqli_query($conn,$sql);
$numRow=mysqli_num_rows($result);
if($numRow==1){
    while($row=mysqli_fetch_assoc($result)){
    // if($pass==$row['user_pass']){
   if(password_verify($pass,$row['user_pass'])){    //$has password 
        echo"password verify";
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['useremail']=$email;
        $_SESSION['sno']=$row['sno'];// left side sno  not need to same as right side sno. left side sno ki jagah ham kuchh aur bgi likh sakte hai 
        echo "email is" .$email;
    
    } else{
        echo"password not verify";
    }
}
    header("location:../index.php");
}

}
?>