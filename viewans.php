<?php include 'inc/header.php'; ?>




<?php 

//Session::checkSession();
$total=$ad->getTotalRows();

?>










<div class="main">
<h1>All Questions & ans: <?php echo $total;?></h1>
	<div class="test">
		<table> 
		<?php 
$getQues=$ad->getQuesByOrder();
if ($getQues) {
while ($question=$getQues->fetch_assoc()) {
	?>
			<tr>
				<td colspan="2">
				 <h3><?php echo $question['quesNo'];?>:<?php echo $question['ques'];?></h3>
				</td>
			</tr>
<?php 
$number=$question['quesNo'];
$answer=$ad->getAnswer($number);
if ($answer) {
	while ($result=$answer->fetch_assoc()) {
?>
			<tr>
				<td>
<input type="radio"/> 

<?php if ($result['rightAns']=='1') 

{echo "<span style='color:blue;checked'>".$result['ans']."</span>"; }

else{
echo  $result['ans'];
          }
				 ?>
				</td>
			</tr>
			
<?php }}?>
<?php }}?>

		</table>

<a href="starttest.php" style="text-decoration: none;">Start Again</a>

</div>
 </div>
<?php include 'inc/footer.php'; ?>