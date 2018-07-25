<?php include 'inc/header.php'; ?>

<?php 
//Session::checkSession();
$userId=Session::get("userId");
?>


<?php 
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $userdata=$ad->updateUserdata($_POST,$userId);
}

?>



<style type="text/css">
	
.profile{width: 530px;margin: 0 auto;border: 1px solid #ddd;padding: 30px 50px 50px;}

</style>

<div class="main">
<h1>Update your profile</h1>
<p style="margin-left: 90px;"><?php 
if (isset($userdata)) {
  echo $userdata;
}

?></p>
<div class="profile">

<form action="profile.php" method="post">
<?php 


$getData=$ad->getUserData($userId);
if ($getData) {
	$result=$getData->fetch_assoc();


?>


		<table class="tbl">    
			 <tr>
			   <td>Name</td>
			   <td><input name="name" type="text" value="<?php echo $result['name'];?>"></td>
			 </tr>
			 <tr>
			   <td>Username</td>
			   <td><input name="username" type="text" value="<?php echo $result['username'];?>"></td>
			 </tr>
			 <tr>
			   <td>Email</td>
			   <td><input name="email" type="text" value="<?php echo $result['email'];?>"></td>
			 </tr>
			  <tr>
			  <td></td>
			   <td><input type="submit" value="Update" style="background: green"></td>
			 </tr>
       </table>
<?php }?>

  	   </form>
 </div>
</div>

<?php include 'inc/footer.php'; ?>