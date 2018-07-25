<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
    include_once ($filepath.'/../classes/Admin.php');
	$exm=new Admin();

?>

<style type="text/css">
	.adminpanel{width: 480px;color: #999;margin: 30px auto 0;padding: 10px;border: 1px solid #ddd;}
input[type="number"]{border: 1px solid #ddd;
  margin-bottom: 10px;
  padding: 5px;
  width: 330px;}

input[type="text"]{border: 1px solid #ddd;
  margin-bottom: 10px;
  padding: 5px;
  width: 330px;}



</style>



<?php 

if ($_SERVER['REQUEST_METHOD'] =='POST') {
	$addQue=$exm->addQuestions($_POST);
}

//get total question
$total=$exm->getTotalRows();
$next=$total+1;

?>

<div class="main">
<h1>Admin Panel -Add Question</h1>

<?php 

if (isset($addQue)) {
	echo $addQue;
}
?>


<div class="adminpanel">
	<form action="" method="post">
		
<table>
	<tr>
		<td>Question.No</td>
			<td>:</td>

				<td><input type="number" name="quesNo" value="<?php 
				if (isset($next)) {echo $next;}?>" /></td>
	</tr>


     <tr>
		<td>Question</td>
			<td>:</td>
<td><input type="text" value="" name="ques" placeholder="Enter Question......" required="" /></td>
	</tr>


	<tr>
		<td>Choice One</td>
			<td>:</td>
		<td><input type="text"  name="ans1" placeholder="Enter Choice One......" required="" /></td>
	</tr>

<tr>
		<td>Choice Two</td>
			<td>:</td>
		<td><input type="text"  name="ans2" placeholder="Enter Choice Two......" required="" /></td>
	</tr>

<tr>
		<td>Choice Three</td>
			<td>:</td>
		<td><input type="text"  name="ans3" placeholder="Enter Choice Three......" required="" /></td>
	</tr>

	<tr>
		<td>Choice Four</td>
			<td>:</td>
		<td><input type="text"  name="ans4" placeholder="Enter Choice Four......" required="" /></td>
	</tr>

     <tr>
		<td>Correct.No</td>
			<td>:</td>
				<td><input type="number" name="rightAns" required=""></td>
	    </tr>

      <tr>

	<td colspan="2" align="center">

	<input  type="submit" value="Add A Question" class="btn btn-info">

	</td>
	    </tr>


</table>

	</form>

</div>


	
</div>
<?php include 'inc/footer.php'; ?>