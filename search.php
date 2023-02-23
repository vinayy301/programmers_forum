<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    <?php include "partials/header.php" ?>
    <?php  include 'partials/dbconnection.php'?>
    <div class=" container py-2">
        <h1>Search Results for <?php echo $_GET["query"]?></h1>
        <?php
        $query=$_GET['query'];
      $sql="SELECT * FROM `threads` WHERE MATCH(thread_title,thread_desc) against('$query') ";
      $result=mysqli_query($conn,$sql);
    $noresult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noresult=false;
       $title=$row['thread_title'];
       $desc=$row['thread_desc'];
       $thread_id=$row['thread_id'];
       $link_to_thread_page="thread.php?threadid=".$thread_id;
       echo'<div class="result">
       <h3><a href="'.$link_to_thread_page.'" class="text-dark"> '.$title.'</a></h3>
       <p>'.$desc.'</p>
      
       </div>';
       }
      
       if($noresult){
        echo'<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-6">No Results Found</h1>
          <p class="lead">Suggesion:</p>
          <ul><li>Plzz see another keyword.</li>
          <li> Put correct spelling.</li>
          <li>sorry for inconvenience</li>
        </ul>
        </div>
      </div>';
       }
      
    ?>
      </div>
      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>