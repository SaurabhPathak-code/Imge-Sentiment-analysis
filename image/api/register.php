<?php
include "db.php";
$name=$_POST['name'];
$dob=$_POST['dob'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$passwoed=$_POST['passwoed'];
$cpassword=$_POST['cpassword'];
$sql=mysqli_query($con,"select * from `register` where `email`='$email'");
 $count=mysqli_num_rows($sql);
if($count>=1){
    echo "User Already Registered With This Email!!";
}else{
    $sql=mysqli_query($con,"INSERT INTO `register`(`name`, `email`, `mobile`, `dob`, `password`) VALUES ('$name','$email','$mobile','$dob','$passwoed')");
    if($sql){
    echo "User Registered Successfully!!";
    }

}


?>