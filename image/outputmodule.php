<?php include "header.php" ?>
<div class="container">

  <h3 class="text-center pt-2">Output Module</h3>
  <br><br>
  <center><img src="band.jpg"></center>
 
<?php 
if(isset($_POST['submit'])){
	//uploadfile
	$target_dir = "uploads/";
	//$sessid
	$bnm=basename($_FILES["uploadfile"]["name"]);
	$uid=uniqid();
	$exp= explode(".",$bnm);
	$extension=$exp[1];//extension
	$filenm=$uid.".".$extension;
	$target_file = $target_dir . $filenm;
	if($_FILES["uploadfile"]["name"]!=""){
		//insert into databese userid and imagepath
		
		$uploadedFile1=$_FILES["uploadfile"]["tmp_name"];
		$imageSrc1 = imagecreatefromjpeg($uploadedFile1); 
		 $sourceProperties1=getimagesize($uploadedFile1);
		 $imageWidth1=$sourceProperties1[0];
		 $imageHeight1=$sourceProperties1[1];
		 $newImageWidth1 =64;
		 $newImageHeight1 =64;
		 $newImageLayer1=imagecreatetruecolor($newImageWidth1,$newImageHeight1);
		 imagecopyresampled($newImageLayer1,$imageSrc1,0,0,0,0,$newImageWidth1,$newImageHeight1,$imageWidth1,$imageHeight1);		
		 imagejpeg($newImageLayer1,$target_file);
		 
		 $sql=mysqli_query($con,"INSERT INTO `comments`(`user_id`, `img_url`) VALUES ('$sessid','$target_file')");
		echo "<script>localStorage.setItem('newimgpath', '".$target_file."');</script>";
	//move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file);
	echo "<script>alert('File Uploaded Successfully!!');</script>";
	}else{
		echo "<script>alert('please select file!!');</script>";
	}
}
?>
<?php
  $sqlselect=mysqli_query($con,"select * from `comments`");
 	   $count=mysqli_num_rows($sqlselect);
  while($rows=mysqli_fetch_array($sqlselect)){
	   $imgurl= $rows['img_url'];
	    $comment= $rows['comment'];
	   
	   echo "<center><img src='$imgurl' width='64' height='64' />";
	   echo "<p>$comment</p></center>";
	   
  }
	  
	  ?>
<center>	  <label for="file-upload" class="custom-file-upload">
    <i class="fa fa-cloud-upload"></i> Custom Upload
</label>

<form method="POST" action="" enctype="multipart/form-data" class="card">
<input id="file-upload" type="file" name="uploadfile" accept="image/jpeg" />
<input type="submit" style="padding:8px;color:white;font-weight:bold;background-color:lightgreen;text-decoration:none" value="Send" name="submit">
</form></center>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.1.9/p5.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.1.9/addons/p5.sound.min.js"></script>
  <script src="https://unpkg.com/ml5@0.6.0/dist/ml5.min.js"></script>
  <meta charset="utf-8" />
   <style>
   #defaultCanvas0{
	     padding-left: 0;
    padding-right: 0;
    margin-left: auto;
    margin-right: auto;
    display: block;
    width: 800px;
   }
   #resultsDiv{
	   text-align:center;
	   margin-bottom:10px;
   }
   </style>
   <script>
var classifier;
var canvas;
var resultsDiv;
var inputImage;
var clearButton;
var video;
var imgpath;
function setup() {
  canvas = createCanvas(64, 64);
  imgpath=localStorage.getItem("newimgpath");
  video = loadImage(imgpath,draw); // Load the image
  
  var options = {
    inputs: [64, 64, 4],
    task: 'imageClassification',
  };
  classifier = ml5.neuralNetwork(options);
  const modelDetails = {
    model: 'model.json',
    metadata: 'model_meta.json',
    weights: 'model.weights.bin',
  };
  background(255);
  resultsDiv = createDiv('loading model');
  resultsDiv.id("resultsDiv");
  inputImage = createGraphics(64, 64);
  classifier.load(modelDetails, modelLoaded);
}

function modelLoaded() {
  console.log('model ready!');
  classifyImage();
}

function classifyImage() {
  classifier.classify(
    {
      image: video,
    },
    gotResults
  );
}

function gotResults(err, results) {
  if (err) {
    console.error(err);
    return;
  }

  var label = results[0].label;
  //sed label to database using ajax
  
   $.ajax({
      method: 'post',
      url: 'updatesentiment.php',
      data: {
        'imgpath': imgpath,
        'label': label
      },
      success: function(data) {
		 localStorage.removeItem("newimgpath");
      }
    });
  
  var confidence = nf(100 * results[0].confidence, 2, 0);
  
  resultsDiv.html(`${label} ${confidence}%`);
  //classifyImage();
  console.log(results);
}
function draw() {
  image(video, 0, 0, width, height);
}

  </script>

<?php include "footer.php" ?>