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
    <!-- carousel slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1200x350/?coding,mysql" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1200x350/?programming,php" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1200x350/?software,database" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container my-2">
        <h2 class="text-center">iDiscuss- Browse categories</h2>
        <div class="row">
             <!-- card -->
             <!-- fetching all categories -->
             <?php
             
             $sql="SELECT * FROM `categories`";
             $result=mysqli_query($conn,$sql);
             while($row=mysqli_fetch_assoc($result)){
                $id=$row['categorie_id'];
                $ctg=$row['categorie_name'];
                $desc=$row['categorie_description'];
                echo'  <div class="col-md-4 my-2">
                <div class="card" style="width: 18rem;">
                    <img src="https://source.unsplash.com/500x300/?'.$ctg.',software" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a class="text-decoration-none" href="threadlist.php?ctgid='.$id.'">'.$ctg.'</a></h5>
                        <p class="card-text">'. substr($desc,0,90).'</p>
                        <a href="threadlist.php?ctgid='.$id.'" class="btn btn-primary">View Threads</a>
                    </div>
                </div>
            </div>';
             }
             ?>
        </div>
    </div>
    <?php include "partials/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>
          
          



