<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Admin.php');
	$exm=new Admin();
?>

<?php 

if (isset($_GET['delque'])) {
	$quesNo=(int)$_GET['delque'];

$delQue=$exm->delQuestion($quesNo);

}


?>


<div class="main">
<h2>Admin panel manage - Question list</h2>
<?php 
if (isset($delQue)) {
	echo $delQue;
}

?>


<div class="quelist">
	
<table class="tblone">
	<tr>
		<th width="10%">NO</th>
		<th width="70%">Question</th>
		<th width="20%">Action</th>	
	</tr>

<!--database theke value niye ashar jonno-->

<?php 
$getData=$exm->getQueByOrder();

if ($getData) {
	$i=0;
	while ($result=$getData->fetch_assoc()) {
		$i++;
?>


	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $result['ques'];?></td>
		<td>
<a onclick="return confirm('Are you sure want to remove?');" style="text-decoration: none;" href="?delque=<?php echo $result['quesNo'];?>">Remove</a>

		</td>	
	</tr>
<?php }}?>

</table>

</div>
</div>	
</div>
<?php include 'inc/footer.php'; ?>