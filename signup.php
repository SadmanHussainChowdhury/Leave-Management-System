<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
<script>
function validateForm1() {
    var x = document.forms["myForm"]["name"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
    var x = document.forms["myForm"]["username"].value;
    if (x == "") {
        alert("User Name must be filled out");
        return false;
    }
	var x = document.forms["myForm"]["type"].value;
    if (x == "") {
        alert("Position must be filled out");
        return false;
    }
    var x = document.forms["myForm"]["phone"].value;
    if (x == "") {
        alert("Position must be filled out");
        return false;
    }
    var x = document.forms["myForm"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        return false;
    }
}
</script>
</head>
<style>
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: darkblue;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

.cancelbtn {
    padding: 14px 20px;
    background-color: darkred;
}

.cancelbtn,.signupbtn {
    float: left;
    width: 50%;
}
.container {
    padding: 16px;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>
<?php
include 'dbconnect.php';
if(!empty($_POST)) {
    $name =$_POST['name'];
	// $username = $_POST['username'];
    $email = $_POST['email'];
	// $position=$_POST['position'];
	$password = $_POST['password'];
	// $id;
    $type = $_POST['type'];
    $phone = $_POST['phone'];
    $sql="INSERT INTO users( `name`, `email`, `password`, `phone`, `type`) VALUES ('$name','$email','$password','$phone','$type')";
	$qry=mysqli_query($conn,$sql);

		if(isset($_POST['signup'])){
			echo "<div class='form'>
<h3>You are registered successfully.</h3>";
	// header('Location: login.php');
		}
		else{
			echo 'Sign up Failed';	
		}
};
?>
<form name="myForm" 
onsubmit="return validateForm1()" method="post" style="border:30px solid aquamarine">
  <div class="container">
    <label><b>Name</b></label>
    <input type="text" placeholder="Enter Your Name..." name="name" required>
	
    <label><b>Type</b></label>
    <input type="text" placeholder="Enter Your Type..." name="type" required>
  
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Your Email..." name="email" required>
	
	<label><b>Phone</b></label>
    <input type="text" placeholder="Enter Your Phone.." name="phone" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Your Password..." name="password" required>

    <input type="checkbox" checked="checked"> Remember me
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" name="signup" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>

</body>
</html>
