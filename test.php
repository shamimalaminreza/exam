<?php include 'inc/header.php'; ?>

<?php 

if (isset($_GET['question'])) {
	$number=(int)$_GET['question'];
}else{
header('Location:exam.php');

}
$total=$ad->getTotalRows();

$Question=$ad->getquestionByNumber($number);

?>


<?php 
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $processdata=$ad->processData($_POST);
}

?>


<div class="main">
<h1>Question <?php echo $Question['quesNo']; ?> to <?php echo $total; ?></h1>


	<div class="test">
		<form method="post" action="">
		<table> 
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $Question['quesNo']; ?>: <?php echo $Question['ques']; ?></h3>
				</td>
			</tr>

<?php 
$iteratequestion=$ad->getItyerateQuestion($number);
if ($iteratequestion) {
	while ($result=$iteratequestion->fetch_assoc()) {
		
?>

			<tr>
				<td>
	<input type="radio" name="ans" value="<?php  echo $result['id'];?>" /><?php  echo $result['ans'];?>
				</td>
			</tr>
			<?php }}?>




			<tr>
			  <td>
				<input type="submit" name="submit" value="Next Question"/>
				<input type="hidden" name="number" value="<?php echo $number;?>"/>
			</td>
			</tr>
			
		</table>
</div>



 </div>
<?php include 'inc/footer.php'; ?>