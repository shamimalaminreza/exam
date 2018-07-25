<?php 
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
class Admin{
	private $db;
	private $fm;
	function __construct(){
	$this->db=new Database();
	$this->fm=new Format();
	}
//method for admin
public function getAdminData($data){
$adminUser=$this->fm->validation($data['adminUser']);
$adminPass=$this->fm->validation($data['adminPass']);
//for validation
$adminUser=mysqli_real_escape_string($this->db->link,$adminUser);
$adminPass=mysqli_real_escape_string($this->db->link,md5($adminPass));
$query="SELECT*FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'";
$result=$this->db->select($query);
if ($result!=false) {
	$value=$result->fetch_assoc();

	//for session start
	Session::init();
	Session::set("adminLogin",true);
	Session::set("adminUser",$value['adminUser']);
	Session::set("adminPass",$value['adminPasss']);
   Session::set("adminId",$value['adminId']);
   header("Location:index.php");

}else{
$msg="<span class='error'>Username or password is not match</span>";
return $msg;
}

}

public function getAllUsers(){
$query="SELECT*FROM tbl_user";
$result=$this->db->select($query);
return $result;
    }

    //DisableUser($dblid)
 public function DisableUser($dblid){
$query="UPDATE tbl_user SET status='1' WHERE userid='$dblid'";
$result=$this->db->update($query);
if ($result==true) {
$msg="<span class='success'>User data disable successfully</span>";
return $msg;
}else {
$msg="<span class='error'>User data not disable successfully</span>";
return $msg;
}

    }
//EnableUser($edblid)
public function EnableUser($edblid){
$query="UPDATE tbl_user SET status='0' WHERE userid='$edblid'";
$result=$this->db->update($query);
if ($result==true) {
$msg="<span class='success'>User data enable successfully</span>";
return $msg;
}else {
$msg="<span class='error'>User data not enable successfully</span>";
return $msg;
}

    }

    //DeleteUser($delid)
public function DeleteUser($delid){
$query="DELETE FROM tbl_user WHERE userid='$delid'";
$result=$this->db->delete($query);
if ($result==true) {
$msg="<span class='success'>User data delete successfully</span>";
return $msg;

}else {

$msg="<span class='error'>User data not delete successfully</span>";
return $msg;

}
}
//method for getQueByOrder()
public function getQueByOrder(){
$query="SELECT*FROM tbl_ques ORDER BY quesNo ASC";
$result=$this->db->select($query);
return $result;

}



//delQuestion($quesNo)
public function delQuestion($quesNo){
//for delating two table data
$tables=array("tbl_ques","tbl_ans");
foreach ($tables as $table) {
$query="DELETE FROM $table WHERE quesNo='$quesNo'";
$result=$this->db->delete($query);
if ($result) {
$msg="<span class='success'>Question delete successfully</span>";
return $msg;
}else {

$msg="<span class='error'>Question delete not successfully</span>";
return $msg;
}
}
}

//>getTotalRows()
public function getTotalRows(){
$query="SELECT*FROM tbl_ques";
$result=$this->db->select($query);
$total=$result->num_rows;
return $total;
}

//addQuestions($_POST)
public function addQuestions($data){
$quesNo=mysqli_real_escape_string($this->db->link,$data['quesNo']);
$ques=mysqli_real_escape_string($this->db->link,$data['ques']);
$ans=array();
$ans[1]=$data['ans1'];
$ans[2]=$data['ans2'];
$ans[3]=$data['ans3'];
$ans[4]=$data['ans4'];
$rightAns=$data['rightAns'];
$query="INSERT INTO tbl_ques(quesNo,ques) VALUES('$quesNo','$ques')";
$insert_row=$this->db->insert($query);
if ($insert_row) {
	foreach ($ans as $key => $ansName) {
		if ($ansName!='') {
			if ($rightAns==$key ) {
				$rquery="INSERT INTO tbl_ans(quesNo,rightAns,ans) VALUES('$quesNo','1','$ansName')";

			}
			else{

				$rquery="INSERT INTO tbl_ans(quesNo,rightAns,ans) VALUES('$quesNo','0','$ansName')";
			}

			$insertrow=$this->db->insert($rquery);

  if ($insertrow) {
  	continue;
  }else{
die('Error.....');
  }
		}
	}

$msg="<span class='success'>Question added successfully</span>";
return $msg;

}
}
//userRegistration($_POST);
public function userRegistration($data){
$name=$this->fm->validation($data['name']);
$username=$this->fm->validation($data['username']);
$password=$this->fm->validation($data['password']);
$email=$this->fm->validation($data['email']);
//for validation
$name=mysqli_real_escape_string($this->db->link,$name);
$username=mysqli_real_escape_string($this->db->link,$username);
$email=mysqli_real_escape_string($this->db->link,$email);
if ($name=="" || $username=="" || $password=="" ||  $email =="" ) {
	echo "<span class='error' style='color:red;'>Field Must not be empty</span>";
	exit();
}else if (filter_var($email,FILTER_VALIDATE_EMAIL)===false) {
	echo "<span class='error' style='color:red;'>Invalid Email Address</span>";
	exit();
}
else{
$chkquery="SELECT*FROM tbl_user WHERE email='$email'";
$chkresult=$this->db->select($chkquery);
if ($chkresult!=false) {
	echo "<span class='error' style='color:red;'>Email Address Already exist</span>";
	exit();
}else{
$password=mysqli_real_escape_string($this->db->link,md5($password));
$query="INSERT INTO tbl_user(name,username,password,email) VALUES('$name','$username','$password','$email')";
$insert_row=$this->db->insert($query);
if ($insert_row) {
	echo "<span class='success' style='color:green;'>Registration Success</span>";
	exit();
}else{
echo "<span class='error' style='color:red;'>Not register</span>";
	exit();
   }
}
}
}

//userLogin($_POST)
public function userLogin($data){
$username=$this->fm->validation($data['username']);
$password=$this->fm->validation($data['password']);
//for validation
$username=mysqli_real_escape_string($this->db->link,$username);
$password=mysqli_real_escape_string($this->db->link,md5($password));
if ($username =="" || $password=="") {
	echo "<span style='color:red;'>Field must not be empty</span>";
	exit();

}else{
//$password=mysqli_real_escape_string($this->db->link,md5($password));
$query="SELECT*FROM tbl_user WHERE username='$username' AND password='$password'";
$result=$this->db->select($query);
if ($result!=false) {
	$value=$result->fetch_assoc();
	if ($value['status']=='1') {
		echo "<span style=color:red;>User id disable</span>";
	    exit();
	}else{
    Session::init();
	Session::set("login",true);
	Session::set("userId",$value['userId']);
	Session::set("username",$value['username']);
	Session::set("name",$value['name']);
    header("Location:exam.php");
	}
}else{
echo "<span style='color:red;'>User name and password is not matched</span>";
exit();
       }
     }
  }
//getUserData($userId)

  public function getUserData($userId){
$query="SELECT*FROM tbl_user WHERE userId='$userId'";
$result=$this->db->select($query);
return $result;
  }

//publicupdateUserdata($_POST)
public function updateUserdata($data,$userId){
$name=mysqli_real_escape_string($this->db->link,$data['name']);
$username=mysqli_real_escape_string($this->db->link,$data['username']);
$email=mysqli_real_escape_string($this->db->link,$data['email']);
if ($name=='' || $username=='' || $email=='') {
echo "<span style='color:red;'>Field must not be empty</span>";
exit();
}else{
$query="UPDATE tbl_user 
SET name='$name',
username='$username',
email='$email' 
WHERE userId='$userId'";
$result=$this->db->update($query);
if ($result==true) {
$msg="<span class='success' style='color:green;'>User data update successfully</span>";
return $msg;
}else {
$msg="<span class='error' style='color:red;'>User data not update successfully</span>";
return $msg;
}

  }

}
public function gettotalQuestion(){
$query="SELECT*FROM tbl_ques";
$result=$this->db->select($query);
$total=$result->num_rows;
return $total;
	
}
//getQuestionList();
public function getQuestionList(){
$query="SELECT*FROM tbl_ques";
$getData=$this->db->select($query);
$result=$getData->fetch_assoc();
return $result;
	
}
//getquestionByNumber()

public function getquestionByNumber($number){
	$query="SELECT*FROM tbl_ques WHERE quesNo='$number'";
	$getData=$this->db->select($query);
	$result=$getData->fetch_assoc();
	return $result;

}
public function getItyerateQuestion($number){

$query="SELECT*FROM tbl_ans WHERE quesNo='$number'";
	$getData=$this->db->select($query);
	return $getData;
}


public function processData($data){
$selectedAns=$this->fm->validation($data['ans']);
$number=$this->fm->validation($data['number']);
$selectedAns=mysqli_real_escape_string($this->db->link,$selectedAns);
$number=mysqli_real_escape_string($this->db->link,$number);
$next=$number+1;
//for count score
if (!isset($_SESSION['score'])) {
	$_SESSION['score']='0';
}
$total=$this->getTotal();
$right=$this->rightAns($number);
if ($right==$selectedAns) {
	$_SESSION['score']++;
}
if ($number==$total) {
header("Location:final.php");
exit();
}else{
header("Location:test.php?question=".$next);
     }
}

//
private function getTotal(){
$query="SELECT*FROM tbl_ques";
$getResult=$this->db->select($query);
$total=$getResult->num_rows;
return $total;

}

private function rightAns($number){
$query="SELECT*FROM tbl_ans WHERE quesNo='$number' AND rightAns='1'";
$getData=$this->db->select($query)->fetch_assoc();
$result=$getData['id'];
return $result;

}
//pgetQueByOrder()
public function getQuesByOrder(){

$query="SELECT*FROM tbl_ques ORDER BY id ASC";
$result=$this->db->select($query);
return $result;
}
//getAnswer($number)

public function getAnswer($number){

$query="SELECT*FROM tbl_ans WHERE quesNo='$number'";
$result=$this->db->select($query);
return $result;



}



}

?>