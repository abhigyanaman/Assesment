<?php
session_start();
if(!isset($_SESSION['userId']) || !isset($_SESSION['userType']))
{
header("Location: ../../login.html");
}
else
{
	include "../../config.php";
	error_reporting(0);
	if(isset($_POST['submit']))//for add question set
	{
		$quesSetName=$_POST['quesSetName'];
		$gradeId=$_POST['gradeName'];
		$subjectId=$_POST['subjectName'];
		$unitsId=$_POST['unitsName'];
		$chapterId=$_POST['chapterName'];
		
		$res1=mysqli_query($conn,"select * from `grade` where `gradeId`='$gradeId'");
		while($r1=mysqli_fetch_array($res1))
		{	
			$gradeName=$r1['gradeName'];
		}
		
		$res2=mysqli_query($conn,"select * from `subject` where `subjectId`='$subjectId'");
		while($r2=mysqli_fetch_array($res2))
		{	
			$subjectName=$r2['subjectName'];
		}
		
		$res3=mysqli_query($conn,"select * from `chapter` where `chapterId`='$chapterId'");
		while($r3=mysqli_fetch_array($res3))
		{	
			$chapterName=$r3['chapterName'];
		}
		
		$res4=mysqli_query($conn,"select * from `subject_units` where `unitsId`='$unitsId'");
		while($r4=mysqli_fetch_array($res4))
		{	
			$unitsName=$r4['unitsName'];
		}
		
		$status=$_POST['status'];
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$createdOn=$date;
		$createdBy=$_SESSION['userType'];
		
		$q_list = $_POST['quesID'];
		$quesCount=count($q_list);
		foreach($q_list as $selected)
		{
			$quesIdList= $selected.",".$quesIdList;
		}
		

		$result=mysqli_query($conn,"INSERT INTO `questionSet` (`quesSetName`, `quesCount`, `gradeId`, `gradeName`, `subjectId`, `subjectName`, `topicId`, `topicName`, `chapterId`, `chapterName`, `status`, `createdOn`, `createdBy`, `quesIdList`) VALUES ('$quesSetName', '$quesCount', '$gradeId', '$gradeName', '$subjectId', '$subjectName', '$unitsId', '$unitsName', '$chapterId', '$chapterName', '$status', '$createdOn', '$createdBy','$quesIdList')");
		if ($result)
		{
			echo "<script type='text/javascript'>
			window.location.href='http://localhost/assessment/pages/questions_set/view_question_set.php';
			alert('Question set added successfully.')
			</script>";
		}
		else
		{
			
			echo "<script type='text/javascript'>
			window.location.href='http://localhost/assessment/pages/questions_set/add_question_set.php';
			alert('Something went wrong!')
			</script>";
		}
	}
}	
?>