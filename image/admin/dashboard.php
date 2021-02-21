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
  <title>Sentitment Analysis Using Image</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="dashboard.php">Sentitment Analysis Using Image</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="dashboard.php">Home</a></li>
      <li><a href="logout.php">Logout</a></li>

    </ul>
  </div>
</nav>
  
<div class="container">
  <div class="row">
  <div class="col-md-12">
		<table class="table">
  <thead>
    <tr>   
      <th scope="col">No. Of Time Happy Users</th>
      <th scope="col">No. Of Time Sad Users</th>
    </tr>
  </thead>
  <tbody>
    <tr>
	<?php 
	$sql=mysqli_query($con,"SELECT * FROM `comments` WHERE `comment`='happy'");
	$sql2=mysqli_query($con,"SELECT * FROM `comments` WHERE `comment`='sad'");
	?>
      <td><?php echo mysqli_num_rows($sql); ?></td>
      <td><?php echo mysqli_num_rows($sql2); ?></td>
    </tr>
   
  </tbody>
</table>
  </div>
  </div>
</div>

</body>
</html>
