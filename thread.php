<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
    #question {
        min-height: 337px;
        /*for keeping footer as dowen as possible */
    }
    </style>

</head>

<body>
    <?php  include 'partials/dbconnection.php'?>
    <?php include "partials/header.php" ?>
   

    <?php
   $id=$_GET['threadid'];  //jab card title python pe click karenge to url me jo ctgid rahegi usko get kar lega
    $sql="SELECT * FROM `threads` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);
    $noresult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noresult=false;
       $title=$row['thread_title'];
       $desc=$row['thread_desc'];
       $thread_user_id=$row['thread_user_id'];
       $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
       $result2=mysqli_query($conn,$sql2);
       $row2=mysqli_fetch_assoc($result2);
       $posted_by=$row2['user_email'];
    }
    if($noresult){
        echo'<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-6">Not discussed yet</h1>
          <p class="lead">You are first person to put a Question.</p>
        </div>
      </div>';
      }
   ?>

      <!-- on form submission of post comment, put the query into discussion list -->
<?php
$showalert=false;
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST'){
  $content=$_POST['comment'];
  $sno=$_POST['sno']; // <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">  sno iski vajah se aaya line no. 93 may be changed
  $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `date`) VALUES ('$content', '$id', '$sno', current_timestamp())" ;
  //$id upar se aaya hai$id=$_GET['threadid']; 
  $result=mysqli_query($conn,$sql);
  $showalert=true;
  if($showalert){
     echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>Your Comment submitted successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

  }
}
?>

    <!-- perticular thread(query) content| onlty show targeted query not all query -->
    <div class="container my-4 bg-light">
        <div class="jumbotron ">
            <h1 class="display-4"><?php echo $title?> </h1>
            <p class="lead"><?php echo $desc?></p>
            <hr class="my-4">
            <p>You have every right to disagree with your fellow community members and explain your perspective.
                However, you are not free to attack, degrade, insult, or otherwise belittle them or the quality of this
                community. It does not matter what title or power you hold in these forums, you are expected to obey
                this rule.</p>
            <p>
               Posted by: <b><em><?php echo $posted_by ?></em></b>
            </p>
        </div>
    </div>


    <!-- put your comment in form -->
    <!-- comment karte waqt koi special tag likhenge like  </script> or single quote laga denge to error aayega  dhyan dena . isko fix kar sakte hai stringreplace ka use karke eg. < replace kar denge &lt; se aur isko  > replace kar denge $gt;-->
    <?php
     echo'<div class="container">
     <h3 class="py-2"> Type your comment here</h3>';
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
   
        echo'<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
    
             <div class="mb-3">
               <textarea class="form-control" id="comment" name="comment" row="3"></textarea>
             </div> 
             <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    </div>
    </div>';
}else{
  echo'<div class=" container lead">
<p>Plzz login to post a comment ...</p>
</div>';
}
?>


    <!-- comments on given thread-->
    <div class="container" id="question">
        <h2>Discussion</h2>
   <?php
   $id=$_GET['threadid'];  //jab card title python pe click karenge to url me jo ctgid rahegi usko get kar lega
    $sql="SELECT * FROM `comments` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);
    $noresult=true; //suppose javascript me abhi tak koi question ask nahi hua hai to uska result 0 aaega
    while($row=mysqli_fetch_assoc($result)){
      $noresult=false;
      $id=$row['comment_id'];
       $content=$row['comment_content'];
       $comment_time=$row['date'];

       $comment_by=$row['comment_by'];
       $sql2="SELECT user_email FROM `users` WHERE sno='$comment_by'";
       $result2=mysqli_query($conn,$sql2);
       $row2=mysqli_fetch_assoc($result2);
    
       echo'<div class="d-flex my-3">
       <div class="flex-shrink-0">
         <img src="img/user.png"  width="45px" alt="...">
       </div>
       <div class="flex-grow-1 ms-3">
       <h6>'.$row2['user_email'].'  🕑 '  . date("d M Y",strtotime($comment_time)).' </h6>
       
       '.$content.'
       </div>
     </div>';
    }  
    //  no thread found |No query Asked
    if($noresult){
      echo'<div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-6">No query Asked</h1>
        <p class="lead">You are first person to put a Comment.</p>
      </div>
    </div>';
    }
    ?>
    </div>
    <?php include "partials/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>