<?php include 'inc/header.php'; ?>


<?php 

//Session::checkSession();

$total=$ad->gettotalQuestion();
$question=$ad->getQuestionList();

?>


<!--for finding question from database table-->

<style type="text/css">
	
.starttest{border: 1px solid #f4f4f4;margin: 0 auto;padding: 20px;width: 590px;}
.starttest h2{border-bottom: 1px solid #ddd;font-size: 20px;margin-bottom: 10px;padding-bottom: 10px;text-align: center;}
.starttest ul{margin: 0;padding: 0;list-style: none;}
.starttest ul li{margin-top: 5px;}
.starttest a{background: #f4f4f4;border: 1px solid #ddd;color: #444;display: block;margin-top: 10px;padding: 6px 10px;text-align: center;text-decoration: none;}



</style>


<div class="main">
<h1>Welcome to Online Exam</h1>
	<div class="starttest">
	<h2>Test your knowledge</h2>
<p>This is multiple choice quiz to test your knowledge</p>

<ul>
	
<li><strong>Number Of Questions:</strong><?php echo $total;?></li>
<li><strong>Questions type:</strong>Multiple Choice</li>

</ul>
<a href="test.php?question=<?php echo $question['quesNo'];?>">Start Test</a>

	</div>
  </div>
<?php include 'inc/footer.php'; ?>