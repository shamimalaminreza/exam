<?php include 'inc/header.php'; ?>


<?php 

//Session::checkSession();

?>

<div class="main" >
<h1>You  are done</h1>
	<div class="starttest" style="width: 500px;margin: 0 auto; border: 5px solid #ddd;height: 200px;">
	
<p>Congrats! you have just completed the test</p>
<p>Final score:

<?php 

if (isset($_SESSION['score'])) {
	echo $_SESSION['score'];
	unset($_SESSION['score']);
}
?>


</p>
<a href="viewans.php" style="text-decoration: none;">View Answer</a><br>
<a href="starttest.php" style="text-decoration: none;">Start Agin</a>

	</div>
	
  </div>
<?php include 'inc/footer.php'; ?>