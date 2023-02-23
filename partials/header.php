<?php
session_start();
echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/myproject/Forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/myproject/Forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Top Categories
        </a>
        <ul class="dropdown-menu">';
        include 'partials/dbconnection.php';
        $sql="SELECT * FROM `categories` LIMIT 3"; // sirf top ke 3 category hi dikhaenge
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
           $id=$row['categorie_id'];
           $ctgname=$row['categorie_name'];

           echo'<a class="dropdown-item" href="threadlist.php?ctgid='.$id.'">'. $ctgname.'</a>';
        }
          
         
        echo'</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>';
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
      echo'<form class="d-flex " role="search"  action="search.php" method="get">
      <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
      <p class="text-light px-2  ">'.$_SESSION['useremail'].'</p>
      <a href="partials/logout.php" class="btn btn-outline-success mx-2" >Logout</a>
      </form>';
    }
    else{
      echo' <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
      <button class="btn btn-outline-success mr-2" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>';
    }
   
   
  
    echo'</div>
  </div>
  </nav>';   
  include 'loginmodal.php';
  include 'signupmodal.php';  
  if (isset($_GET['signupsuccess'])&&$_GET['signupsuccess']=="true") {
    echo ' <div class="alert mb-0 alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>Your registration successfull plss log in .
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }  
  ?>