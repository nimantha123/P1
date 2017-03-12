<?php require 'connection.php';?>
<?php
$error="";
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
if(isset($_POST['register'])){
	session_start();
	
	$FName=$_POST['fname'];
	$LName=$_POST['lname'];
	$UName=$_POST['username'];
	$pw=$_POST['password'];
	$Con_pw=$_POST['con_password'];
	$email=$_POST['e_mail'];
	$result=$con->query("SELECT * FROM user WHERE username='$UName'");
	$row=$result->fetch_array(MYSQLI_BOTH);
	if($result->num_rows>0){
		$error="user name already exist";
	}
	elseif(strcmp($pw,$Con_pw)!=0){
		$error="password does not match";
	}
	else{
	$sql=$con->query("INSERT INTO user(fname,lname,username,password,con_password,e_mail)
	Values('{$FName}','{$LName}','{$UName}','{$pw}','{$Con_pw}','{$email}')");

		$_SESSION['username']=$UName;
		header('Location:index.php');
}
}
?>
<html>
<head>
<title></title>
<link href="css/reg.css" rel="stylesheet" type="text/css">
</head>
<body>


<div class="header">
		<div class="header1">
			<img src="Images/owl1.png" class="imgleft">
			<h1 id="name">Welcome You To QuizWizard</h1>
		</div>
		<div class="header2">
			A Simple Measure Of Your Knowledge
		</div>
	</div>
	<div id="ContentRight">
	
	<center><img src="Images/img1.png" class="image" ></center>
	<?php
	echo "<center>".$error."</center>";
	?>
	</div>
 <div class="Content">
 <div class="frm">
 <div class="StyleTextField">
 
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
 <span class="error">* required fields</span>
 <center>Register as a new user</center><br>
 
							<label for="name">First Name :</label>
								<input type="text" id="name" name="fname" input required="required"/>
								<span class="error">*</span><br><br>
								<label for="name">Last Name :</label>
								<input type="text" id="name" name="lname" input required="required"/>
								<span class="error">*</span><br><br>
								<label for="name">User Name :</label>
								<input type="text" id="name" name="username" input required="required"/>
								<span class="error">*</span><br><br>
								<label for="name">Password:</label>
								<input type="password" id="name" name="password" input required="required"/>
								<span class="error">*</span><br><br>
								<label for="name"> Confirm Password:</label>
								<input type="password" id="name" name="con_password" input required="required"/>
								<span class="error">*</span><br><br>
							<label  for="email">Email :</label>
								<input type="email" id="email" name="e_mail" placeholder="  example@123.com" input required="required"/>
								<span class="error">*</span>
							<center> <input type="submit" value="Register" name="register"> </center>
							</form>

						</div>
</div>
</div>
 </body>
 </html>