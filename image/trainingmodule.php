<?php include "header.php" 



?>

<div class="container">
  <h3 class="text-center pt-2">Training Module</h3>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.9.0/p5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.9.0/addons/p5.dom.min.js"></script>
    <script src="https://unpkg.com/ml5@0.2.1/dist/ml5.min.js"></script>

  <br><br>
  
  <?php 
  if(isset($_POST['submit'])){
	$lbl1=$_POST['lbl1'];  
	$lbl2=$_POST['lbl2'];
	$img1total = count($_FILES['img1']['name']);
	$img2total = count($_FILES['img2']['name']);
	if($img1total<=2 || $img2total<=2){
		echo "<script>alert('Please Select at least 3 file for each category!!');</script>";
	}else if($lbl1=="" || $lbl2==""){
		echo "<script>alert('Please Enter Proper label for each category');</script>";
	}else if($img1total!=$img2total){
		echo "<script>alert('File count must be same for all category!!');</script>";
	}else{
		function deleteAll($dir, $remove = false) {
			 $structure = glob(rtrim($dir, "/").'/*');
			 if (is_array($structure)) {
			 foreach($structure as $file) {
			 if (is_dir($file))
			 deleteAll($file,true);
			 else if(is_file($file))
			 unlink($file);
			 }
			 }
			 if($remove)
			 rmdir($dir);
			}
			$path = "./images";
			 
			// call the function
			deleteAll($path);
		mkdir("images/".$lbl1."/");
		mkdir("images/".$lbl2."/");
		//mkdir("images/".$lbl2);
		$target_dir1="images/".$lbl1."/";
		$target_dir2="images/".$lbl2."/";
		for( $i=0 ; $i < $img2total ; $i++ ) {
		  $target_file11 = $target_dir1 . basename($_FILES["img1"]["name"][$i]);
		  $target_file12 = $target_dir2 . basename($_FILES["img2"]["name"][$i]);
		  $uploadedFile1=$_FILES["img1"]["tmp_name"][$i];
		  $uploadedFile2=$_FILES["img2"]["tmp_name"][$i];
		  $target_file1=$target_dir1 . $lbl1 ."-". str_pad($i+1, 4, "0", STR_PAD_LEFT).".jpg";
		  $target_file2=$target_dir2 . $lbl2 ."-". str_pad($i+1, 4, "0", STR_PAD_LEFT).".jpg";
		  /////////////////////////////
		 $imageSrc1 = imagecreatefromjpeg($uploadedFile1); 
		 $sourceProperties1=getimagesize($uploadedFile1);
		 $imageWidth1=$sourceProperties1[0];
		 $imageHeight1=$sourceProperties1[1];
		 $newImageWidth1 =64;
		 $newImageHeight1 =64;
		 $newImageLayer1=imagecreatetruecolor($newImageWidth1,$newImageHeight1);
		 imagecopyresampled($newImageLayer1,$imageSrc1,0,0,0,0,$newImageWidth1,$newImageHeight1,$imageWidth1,$imageHeight1);		
		 imagejpeg($newImageLayer1,$target_file1);
		 echo "<script>localStorage.setItem('lbl1', '".$lbl1."');</script>";
		 
		 
		 $imageSrc2 = imagecreatefromjpeg($uploadedFile2); 
		 $sourceProperties2=getimagesize($uploadedFile2);
		 $imageWidth2=$sourceProperties2[0];
		 $imageHeight2=$sourceProperties2[1];
		 $newImageWidth2 =64;
		 $newImageHeight2 =64;
		 $newImageLayer2=imagecreatetruecolor($newImageWidth2,$newImageHeight2);
		 imagecopyresampled($newImageLayer2,$imageSrc2,0,0,0,0,$newImageWidth2,$newImageHeight2,$imageWidth2,$imageHeight2);		
		 imagejpeg($newImageLayer2,$target_file2);
		 echo "<script>localStorage.setItem('lbl2', '".$lbl2."');</script>";
		  ////////////////////////////
		 
		  
		 // move_uploaded_file($_FILES["img1"]["tmp_name"][$i], $target_file1);
		 // move_uploaded_file($_FILES["img2"]["tmp_name"][$i], $target_file2);
	}
	 echo "<script>alert('Dataset Uploaded Successfully!!')</script>";
}
  }
  ?>
  <form method="POST" action="" enctype="multipart/form-data">
 <label for="file-upload" class="custom-file-upload">
    <i class="fa fa-cloud-upload"></i> Custom Upload Happy
</label>
<input id="file-upload" name="img1[]" type="file" multiple accept="image/jpeg" />
<input type="text" placeholder="Enter Label" name="lbl1" value="happy">
<br><br>
 <label for="file-upload" class="custom-file-upload">
    <i class="fa fa-cloud-upload"></i> Custom Upload Sad
</label>
<input id="file-upload" name="img2[]" type="file" multiple accept="image/jpeg" />
<input type="text" name="lbl2" placeholder="Enter Label" value="sad">
<br><br>
<input type="submit" class="btn btn-success" value="Upload" name="submit">
<a class="btn btn-success" href="training.php">Train</a>
</form>

	
	
</div>
<?php include "footer.php" ?>

