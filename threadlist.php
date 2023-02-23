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
    }

    .width {
        width: 170em;
    }
    </style>

</head>

<body>
    <?php  include 'partials/dbconnection.php'?>
    <?php include "partials/header.php" ?>
     <?php
    $id=$_GET['ctgid'];  //jab card title python pe click karenge to url me jo ctgid rahegi usko get kar lega
    $sql="SELECT * FROM `categories` WHERE categorie_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
       
       $ctg=$row['categorie_name'];
       $desc=$row['categorie_description'];
    }
    ?>

    <!-- on form submission -->
    <?php
$showalert=false;
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST'){
  $ptitle=$_POST['ptitle'];
  $ellaproblemc=$_POST['ellaproblem'];
  $sno=$_SESSION['sno']; 
  $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_ctg_id`, `thread_user_id`, `date`) VALUES ( '$ptitle', '$ellaproblemc', '$id', '$sno', current_timestamp())" ;
  //$id upar se aaya hai$id=$_GET['ctgid']; 
  $result=mysqli_query($conn,$sql);
  $showalert=true;
  if($showalert){
     echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>Your query submitted successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

  }
}
?>
    <!-- thread content -->
    <div class="container   my-4">
        <div class="jumbotron px-4 py-4 bg-light">
            <h1 class="display-4">Welcome to <?php echo $ctg?> Forum</h1>
            <p class="lead"><?php echo $desc?></p>
            <hr class="my-4">
            <p>You have every right to disagree with your fellow community members and explain your perspective.
                However, you are not free to attack, degrade, insult, or otherwise belittle them or the quality of this
                community. It does not matter what title or power you hold in these forums, you are expected to obey
                this rule.</p>

            <p class="lead">
                <a class="btn btn-primary btn-lg btn-success  " href="#" role="button">Learn more</a>
            </p>

        </div>
    </div>
    <!-- put your quenstion -->
    <?Php
        echo'<div class="container">
        <h2 class="py-2">Start a Discussion</h2>';
        
        if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
        echo'
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
          <div class="mb-3">
            <label for="ptitle" class="form-label">Problem Title</label>
            <input type="text" class="form-control" id="ptitle"  name="ptitle" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Keep your title as short as possible.</div>
          </div>
          <div class="mb-3">
            <label for="ellaproblem" class="form-label">Ellaborate Problem</label>
            <textarea class="form-control" id="ellaproblem" name="ellaproblem" row="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>';
        }else{
        echo'<div class=" container lead">
        <p>Plzz login to asked a question...</p>
        </div>';
        }
      ?>
        
    <!-- quenstion ask list -->
    <div class="container" id="question">
        <h2>Browse Questions</h2>
             <?php
        $id=$_GET['ctgid'];  //jab card title python pe click karenge to url me jo ctgid rahegi usko get kar lega
         $sql="SELECT * FROM `threads` WHERE thread_ctg_id=$id";
         $result=mysqli_query($conn,$sql);
         $noresult=true; //suppose javascript me abhi tak koi question ask nahi hua hai to uska result 0 aaega
         while($row=mysqli_fetch_assoc($result)){
           $noresult=false;
           $id=$row['thread_id'];
            $title=$row['thread_title'];
            $desc=$row['thread_desc'];
            $comment_time=$row['date'];

            $thread_user_id=$row['thread_user_id'];
            $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);



       echo'<div class="d-flex my-3">
       <div class="flex-shrink-0">
         <img src="img/user.png"  width="45px" alt="...">
       </div>
       <div class=" width ms-3">
       <h5 ><a  class="text-black text-decoration-none"  href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
        '.$desc.'
       </div>
       <div class="container  ">Asked by:<b>'.$row2['user_email'].'🕑 '  . date("d M Y",strtotime($comment_time)).' </b></div>   
     </div>';
    }  
    //  no thread found |No query Asked
    if($noresult){
      echo'<div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-6">No query Asked</h1>
        <p class="lead">You are first person to put a Question.</p>
      </div>
    </div>';
    }
    ?>
    <?php include "partials/footer.php" ?>
    </div>
     
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>