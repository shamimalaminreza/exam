<?php include 'inc/header.php'; ?>
<div class="main">
<h1>Online Exam System - User Login</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/test.png"/>
	</div>
	<div class="segment">

			<?php 



			?>


	<form action="" method="post">
		<table class="tbl">    
			 <tr>
			   <td>Username</td>
			   <td><input name="username" type="text"></td>
			 </tr>
			 <tr>
			   <td>Password </td>
			   <td><input name="password" type="password"></td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" name="login" value="Login">
			   </td>
			 </tr>
       </table>
	   </form>
	   <p>New User ? <a href="register.php">Signup</a> Free</p>
	   <span id="state">
  <?php 
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $userlogin=$ad->userLogin($_POST);
}

?>

<?php 
if (isset($userlogin)) {
  echo $userlogin;
}

?>


</span>
	</div>
</div>
<?php include 'inc/footer.php'; ?>