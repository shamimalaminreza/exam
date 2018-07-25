<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Admin.php');
	$ad=new Admin();

?>

<!--for enable-->
<?php 
if (isset($_GET['dis'])) {
	$dblid=(int)$_GET['dis'];
	//for disable id
	$dblUser=$ad->DisableUser($dblid);
}
?>

<!--for enable-->


<?php 
if (isset($_GET['ena'])) {
	$edblid=(int)$_GET['ena'];
	//for enable id
	$edblUser=$ad->EnableUser($edblid);
}
?>

<!--for removing -->

<?php 
if (isset($_GET['del'])) {
$delid=(int)$_GET['del'];
	//for enable id
$dellUser=$ad->DeleteUser($delid);
}

?>


<div class="main">
<h2>Admin panel manage - User</h2>
<?php 
if (isset($dblUser)) {
	echo $dblUser;
}

if (isset($edblUser)) {
echo $edblUser;
}




if (isset($dellUser)) {
	echo $dellUser;
}
?>



<div class="manageuser">
	
<table class="tblone">
	


	<tr>
		<th>NO</th>
		<th>Name</th>
		<th>Username</th>
		<th>Email</th>
		<th>Action</th>	
	</tr>

<!--database theke value niye ashar jonno-->
<?php 

$userData=$ad->getAllUsers();

if ($userData) {
	$i=0;
	while ($result=$userData->fetch_assoc()) {
		$i++;

?>



	<tr>
		<td>
		<?php if ($result['status']=='1') {
			echo "<span class='error'>".$i."</span>";
		} else{
			echo $i;
		}

		?>
		

		</td>
		<td><?php echo $result['name'];?></td>
		<td><?php echo $result['username'];?></td>
		<td><?php echo $result['email'];?></td>
		<td>

<?php if ($result['status']=='0') {?>
	
<a onclick="return confirm('Are you sure want to disable?');" href="?dis=<?php echo $result['userId'];?>">Disable</a>
<?php }else {?>


<a onclick="return confirm('Are you sure want to enable?');" href="?ena=<?php echo $result['userId'];?>">Enable</a>
<?php }?>


||<a onclick="return confirm('Are you sure want to remove?');" href="?del=<?php echo $result['userId'];?>">Remove</a>

		</td>	
	</tr>
<?php }}?>

</table>

</div>
</div>


	
</div>
<?php include 'inc/footer.php'; ?>