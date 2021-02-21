<?php
include "db.php";
$imgpath=$_POST['imgpath'];
$label=$_POST['label'];

$updatetbl=mysqli_query($con,"UPDATE `comments` SET `comment`='$label' WHERE `img_url`='$imgpath'");
