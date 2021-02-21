<?php 
include_once "db.php";
if(!isset($_SESSION['userlog'])){
    header("location: index.php");
  }
$sessid= $_SESSION['userlog'];
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Sentiment detection</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!------ Login Form  ---------->
    <link href="css/loginstyle.css" rel="stylesheet" id="bootstrap-css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!------ Login Form  ---------->
    <style>

video{
	margin: auto;
	  overflow: hidden;
		border: 10px solid;
		border-top-color: black;
		border-left-color: black;
		border-bottom-color: black;
		border-right-color: black;
		position: fixed;
    bottom:300px;
    left:550px;
    width: 100%;
    max-height: 100%;
	}
    </style>
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color" style="background: #0062cc;">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#">Image Sentiment detection</a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mr-auto justify-content-center">
	<li class="nav-item">
        <a class="nav-link" href="outputmodule.php">Output Module</a>
      </li>   
      <li class="nav-item">
        <a class="nav-link" href="trainingmodule.php">Training Module</a>
      </li>
      
    
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>  
    </ul>
    <!-- Links -->

   
  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->