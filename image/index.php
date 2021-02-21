<?php
include "db.php";

if(isset($_POST['submit'])){
	$email=$_POST['email'];
	$password=$_POST['password'];

	$sql=mysqli_query($con,"select * from `register` where `email`='$email'");
	$countmob=mysqli_num_rows($sql);
	$dbpassfetch=mysqli_fetch_array($sql);
	$password=$dbpassfetch['password'];
	$id=$dbpassfetch['id'];
	if($countmob!=1){
		echo "<script>alert('Email is Not Registered With Us!! Please Register First.');</script>";
	}else if($email=="" || $password==""){
		echo $error="<script>alert('Please Enter All Fields!!');</script>";
	}else{
		$_SESSION['userlog']=$id;
		header('Location: outputmodule.php');
	}

}
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
    a:hover {
  color: white;
}
    </style>
</head>
<body>                                                                         
<div class="container register">
                <div class="row">
                
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p></p>
                        
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sign Up</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading"> Sentiment detection Using Image <br>Sign In</h3>
                                <form method="post" action="">
                                <div class="row register-form">
                                
                                    <div class="col-md-6">
                                    
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Enter Email *" value="" name="email" id="email"/>
                                            <span class="text-danger font-weight-bold"></span>
                                        </div>
                                       <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password *" value="" />
                                            
                                        </div>
                                        
                                        <button type="submit" class="btnRegister text-light"  value="Login" name="submit">
                                        Log in
                                        </button>
                                      
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                 
                                </div>
                                
                                </form>
                            </div>                          
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                             <h3  class="register-heading">Sentiment detection Using Image <br> Sign Up</h3>
                              <form onsubmit="return formValidation()" method="post" action="">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text"  class="form-control" placeholder="Name *" value="" id="name" name="name"/>
                                            
                                        </div>
                                        <div class="form-group">
                                        <input type="email" id="remail" name="remail" class="form-control" placeholder="Email *" value=""  onkeyup="validateEmail()"/>
                                            <span id="emailalert" class="text-danger font-weight-bold"></span>
                                           
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" maxlength="10" minlength="10" class="form-control" placeholder="Phone *" id="mobile" value="" onkeyup="validateMobile()" name="mobile" />
                                            <span id="mobilealert" class="text-danger font-weight-bold"></span>
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="date" class="form-control" placeholder="`Date Of Birth *" id="dob" name="dob" value="dob" min="1970-01-01" max="2020-12-31"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="passwoed" name="passwoed" class="form-control" placeholder="Password *" value="" onblur="validateCpassword()"/>
                                            <span id="passalert" class="text-danger font-weight-bold"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="cpassword" class="form-control" placeholder="Confirm Password *" value="" onblur="validateCpassword()" onkeyup="validateCpassword()" name="cpassword"/>
                                            <span id="conpassalert" class="text-danger font-weight-bold"></span>
                                        </div>
                                        <!--<input type="submit" class="btnRegister"  value="Register"/>-->
                                        <a href="#" class="btnRegister text-center" id="reg" style="text-decoration:none;hover:none;">Register</a>
                                   
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>

<script>
            
                        //Validate email
                function validateMobile(){
                var mobile=document.getElementById("mobile").value;
                var filter =/^\d{10}$/;
                    if (!filter.test(mobile)) {  
                    document.getElementById("mobilealert").innerHTML='Please provide a valid Mobile Number';
                    mobile.focus;  
                    return false; 
                    }else{
                    document.getElementById("mobilealert").innerHTML='<span class="text-success">valid!</span>';
                    return true;
                    }
                }
                //Validate email
                function validateEmail(){
                var email=document.getElementById("email");

                        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;  
                    if (!filter.test(email.value)) {  
                        document.getElementById("emailalert").innerHTML='Please provide a valid email address';
                        email.focus;  
                        return false;  
                    }else{
                    document.getElementById("emailalert").innerHTML='<span class="text-success">valid!</span>';
                    return true;
                    }  
                    }
                //conpass password
                    function validateCpassword(){

                    var pass=document.getElementById("pass").value;
                    var conpass=document.getElementById("conpass").value;
                    if(pass!=conpass){
                        document.getElementById("conpassalert").innerHTML="Password Not Match!!";
                        return false;

                    }else if(pass==""){
                        document.getElementById("passalert").innerHTML="Password Sholud Not Be Blank!!";
                        return false;
                    }else if(conpass==""){
                        document.getElementById("conpassalert").innerHTML="Confirm Password Sholud Not Be Blank!!";
                        return false;
                    }else if(pass==conpass){
                        document.getElementById("conpassalert").innerHTML="<span style='color:green'>Password Match!!</span>";
                        return true;
                    }
                            }
function formValidation(){
validateEmail(),validateMobile(),validateCpassword();
}
</script>

            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" defer></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" defer></script>
            <!------ End Login Form  ---------->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

            <script>     
	$("#reg").click(function(e){
    e.preventDefault();
	
	    var name=document.getElementById("name").value;
	    var dob=document.getElementById("dob").value;
	    var mobile=document.getElementById("mobile").value;
	    var email=document.getElementById("remail").value;
	    var passwoed=document.getElementById("passwoed").value;
		var cpassword=document.getElementById("cpassword").value;
	
		if(name=="" || dob=="" || mobile=="" || email=="" || passwoed=="" || cpassword==""){
			alert("Please Enter All Fields!!");
		}else if(passwoed!=cpassword ){
			alert("Password Not Match!!");
		}
		else{
			$.ajax({  
					type: 'POST',  
					url: 'api/register.php', 
					data: { name:name,dob:dob,mobile:mobile,email:email,passwoed:passwoed,cpassword:cpassword },
					success: function(response) {
					//document.getElementById("res").innerHTML=response;
					alert(response);
	
					}
				}); 
		}
});

	</script>
</body>
</html>

