<?php 
session_start();
if(!isset($_SESSION['userId']) || !isset($_SESSION['userType']))
{
header("Location: ../../login.html");
}
else
{
	$qID=$_POST['questionID'];
	
	include "../../config.php";
	
	$result=mysqli_query($conn,"SELECT * FROM question inner join answer_options on question.questionId=answer_options.questionId inner join solution on question.questionId=solution.questionId where question.questionID='$qID'");
	while($row=mysqli_fetch_array($result))
	{	
		//question
		$questionID=$row['questionID'];
		$complexityLevel=$row['complexityLevel'];
		$gradeId=$row['gradeId'];
		$gradeName=$row['gradeName'];
		$subjectId=$row['subjectId'];
		$subjectName=$row['subjectName'];
		$unitsId=$row['unitsId'];
		$unitsName=$row['unitsName'];
		$chapterId=$row['chapterId'];
		$chapterName=$row['chapterName'];
		$questionText=$row['questionText'];
		$questionPic=$row['questionPic'];
		if($solutionPic!="")
		{
			$questionPicDiv="display: block;";
		}
		else
		{
			$questionPicDiv="display: none;";
		}
		$addedOn=$row['addedOn'];
		$addedBy=$row['addedBy'];
		$status=$row['status'];
		if($status=="1")
		{
			$status="Active";
		}
		else if($status=="2")
		{
			$status="InActive";
		}
		//answer options
		$answerOptionId=$row['answerOptionId'];
		$answerOptions=$row['answerOptions'];
		
		if($answerOptions=="1")
		{
			$answerOp1="display: block;";
			$answerOp2="display: none;";
			$answerOp3="display: none;";
			$answerOp4="display: none;";
			$answerOp5="display: none;";
		}
		else if($answerOptions=="2")
		{
			$answerOp1="display: block;";
			$answerOp2="display: block;";
			$answerOp3="display: none;";
			$answerOp4="display: none;";
			$answerOp5="display: none;";
		}
		else if($answerOptions=="3")
		{
			$answerOp1="display: block;";
			$answerOp2="display: block;";
			$answerOp3="display: block;";
			$answerOp4="display: none;";
			$answerOp5="display: none;";
		}
		else if($answerOptions=="4")
		{
			$answerOp1="display: block;";
			$answerOp2="display: block;";
			$answerOp3="display: block;";
			$answerOp4="display: block;";
			$answerOp5="display: none;";
		}
		else if($answerOptions=="5")
		{
			$answerOp1="display: block;";
			$answerOp2="display: block;";
			$answerOp3="display: block;";
			$answerOp4="display: block;";
			$answerOp5="display: block;";
		}
		
		$answerOptType=$row['answerOptType'];
		if($answerOptType=="1")
		{
			$answerOptType="Icons only";
			
			$answerOpText1="display: none;";
			$answerOpText2="display: none;";
			$answerOpText3="display: none;";
			$answerOpText4="display: none;";
			$answerOpText5="display: none;";
			
			$answerOpIcon1="display: block;";
			$answerOpIcon2="display: block;";
			$answerOpIcon3="display: block;";
			$answerOpIcon4="display: block;";
			$answerOpIcon5="display: block;";
			
			$answerOpPic1="display: none;";
			$answerOpPic2="display: none;";
			$answerOpPic3="display: none;";
			$answerOpPic4="display: none;";
			$answerOpPic5="display: none;";
			
		}
		else if($answerOptType=="2")
		{
			$answerOptType="Text only";
			
			$answerOpText1="display: block;";
			$answerOpText2="display: block;";
			$answerOpText3="display: block;";
			$answerOpText4="display: block;";
			$answerOpText5="display: block;";
			
			$answerOpIcon1="display: none;";
			$answerOpIcon2="display: none;";
			$answerOpIcon3="display: none;";
			$answerOpIcon4="display: none;";
			$answerOpIcon5="display: none;";
			
			$answerOpPic1="display: none;";
			$answerOpPic2="display: none;";
			$answerOpPic3="display: none;";
			$answerOpPic4="display: none;";
			$answerOpPic5="display: none;";
		}
		else if($answerOptType=="3")
		{
			$answerOptType="Icons + Text";
			
			$answerOpText1="display: block;";
			$answerOpText2="display: block;";
			$answerOpText3="display: block;";
			$answerOpText4="display: block;";
			$answerOpText5="display: block;";
			
			$answerOpIcon1="display: block;";
			$answerOpIcon2="display: block;";
			$answerOpIcon3="display: block;";
			$answerOpIcon4="display: block;";
			$answerOpIcon5="display: block;";
			
			$answerOpPic1="display: none;";
			$answerOpPic2="display: none;";
			$answerOpPic3="display: none;";
			$answerOpPic4="display: none;";
			$answerOpPic5="display: none;";
		}
		else if($answerOptType=="4")
		{
			$answerOptType="Pictures";
			
			$answerOpText1="display: none;";
			$answerOpText2="display: none;";
			$answerOpText3="display: none;";
			$answerOpText4="display: none;";
			$answerOpText5="display: none;";
			
			$answerOpIcon1="display: none;";
			$answerOpIcon2="display: none;";
			$answerOpIcon3="display: none;";
			$answerOpIcon4="display: none;";
			$answerOpIcon5="display: none;";
			
			$answerOpPic1="display: block;";
			$answerOpPic2="display: block;";
			$answerOpPic3="display: block;";
			$answerOpPic4="display: block;";
			$answerOpPic5="display: block;";
		}
		else if($answerOptType=="5")
		{
			$answerOptType="Pictures + Text";
			
			$answerOpText1="display: block;";
			$answerOpText2="display: block;";
			$answerOpText3="display: block;";
			$answerOpText4="display: block;";
			$answerOpText5="display: block;";
			
			$answerOpIcon1="display: none;";
			$answerOpIcon2="display: none;";
			$answerOpIcon3="display: none;";
			$answerOpIcon4="display: none;";
			$answerOpIcon5="display: none;";
			
			$answerOpPic1="display: block;";
			$answerOpPic2="display: block;";
			$answerOpPic3="display: block;";
			$answerOpPic4="display: block;";
			$answerOpPic5="display: block;";
		}
		
		$answerOpt1Text=$row['answerOpt1Text'];
		$answerOpt1Pic=$row['answerOpt1Pic'];
		$answerOpt1Icon=$row['answerOpt1Icon'];
		$answerOpt2Text=$row['answerOpt2Text'];
		$answerOpt2Pic=$row['answerOpt2Pic'];
		$answerOpt2Icon=$row['answerOpt2Icon'];
		$answerOpt3Text=$row['answerOpt3Text'];
		$answerOpt3Pic=$row['answerOpt3Pic'];
		$answerOpt3Icon=$row['answerOpt3Icon'];
		$answerOpt4Text=$row['answerOpt4Text'];
		$answerOpt4Pic=$row['answerOpt4Pic'];
		$answerOpt4Icon=$row['answerOpt4Icon'];
		$answerOpt5Text=$row['answerOpt5Text'];
		$answerOpt5Pic=$row['answerOpt5Pic'];
		$answerOpt5Icon=$row['answerOpt5Icon'];
		//solution
		$solutionId=$row['solutionId'];
		$solutionText=$row['solutionText'];
		$solutionPic=$row['solutionPic'];
		if($solutionPic!="")
		{
			$solutionPicDiv="display: block;";
		}
		else
		{
			$solutionPicDiv="display: none;";
		}
		
		$correctAnswerOption=$row['correctAnswerOption'];
		if($correctAnswerOption=="1")
		{
			$correctAnswerOption="Option A";
		}
		else if($correctAnswerOption=="2")
		{
			$correctAnswerOption="Option B";
		}
		else if($correctAnswerOption=="3")
		{
			$correctAnswerOption="Option C";
		}
		else if($correctAnswerOption=="4")
		{
			$correctAnswerOption="Option D";
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Exam | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
  
  <style>
/* Style the Image Used to Trigger the Modal */
.myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 50px; /* Location of the box */
    left: 0;
    top: 10%;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption { 
    animation-name: zoom;
    animation-duration: 0.6s;
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #ffffff;
    font-size: 50px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $_SESSION['userType'];?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

	<h4 style="color:white; text-align:center;" class="col-sm-10 control-label">Assessment System for Education Institute</h4>
		<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		<li class="dropdown user user-menu">
		<a href="../../logout.php" class="btn btn-danger"><i class='glyphicon glyphicon-log-out'></i>Sign out</a>
		</li>
        </ul>
      </div>
      </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <?php include ('menu.php');?>
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Question Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Questions</a></li>
        <li class="active">Question Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!--<div class="box-header">-->
			<table class="table">
                <tr>
                  <td align="left"><h4><b>Question ID:</b> &nbsp;<?php echo "$questionID";?></h4></td>
                  <td align="center"><h4><b>Added On:</b> &nbsp;<?php echo "$addedOn";?></h4></td>
                  <td align="right"><h4><b>Added By:</b> &nbsp;<?php echo "$addedBy";?></h4></td>
                </tr>
				</table>				
            <!--</div>-->
            
            <!-- /.box-header -->
		<form role="form" class="form-horizontal" action="">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="complexityLevel" class="col-sm-2 control-label">Complexity:</label>
				  <div class="col-sm-10">
					  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo "$complexityLevel";?></label>
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="gradeName" class="col-sm-2 control-label">Grade Name:</label>
				  <div class="col-sm-10">
					  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo "$gradeName";?></label>
				  </div>
                </div>
				<div class="form-group">
                  <label for="subjectName" class="col-sm-2 control-label">Subject name:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo "$subjectName";?></label>
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="unitsName" class="col-sm-2 control-label">Unit name:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo "$unitsName";?></label>
				  </div>
                </div>
				<div class="form-group">
                  <label for="chapterName" class="col-sm-2 control-label">Chapter Name:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo "$chapterName";?></label>
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="questionText" class="col-sm-2 control-label">Specify Question:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo html_entity_decode($questionText);?></label>
				  </div>
                </div>
				
				<div class="form-group" style="<?php echo "$questionPicDiv"; ?>">
                  <label for="questionPic" class="col-sm-2 control-label">Question Pic:</label>
				  <div class="col-sm-10">  
				  <img src='<?php echo "$questionPic" ;?>' class='myImg' width='75' height='75'>
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="status" class="col-sm-2 control-label">Status:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo "$status";?></label>
				  </div>
                </div>
				
				<hr>
				<h4 class="box-title">Answer Details</h4>
				<div class="form-group">
                  <label for="answerOptions" class="col-sm-2 control-label">Number of Answer options: </label>
				  <div class="col-sm-10">
					<label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo "$answerOptions";?></label>
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="answerOptType" class="col-sm-2 control-label">Answer options type: </label>
				  <div class="col-sm-10">
					<label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo "$answerOptType";?></label>
				  </div>
                </div>
				  
				<div style='<?php echo "$answerOp1";?>'>
				<div class="form-group" style='<?php echo "$answerOpText1";?>'>
                  <label for="answerOpt1Text" class="col-sm-2 control-label">Answer1 Text:</label>
				  <div class="col-sm-10">
				  
				  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo 
				  html_entity_decode($answerOpt1Text);?></label>
				  
				  </div>
                </div>
				 
				<div class="form-group" style='<?php echo "$answerOpPic1";?>'>
                  <label for="answerOpt1Pic" class="col-sm-2 control-label">Answer1 Pic:</label>
				  <div class="col-sm-10">
                  <img src='<?php echo "$answerOpt1Pic" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
				  </div>
                </div>
				
				<div class="form-group" style='<?php echo "$answerOpIcon1";?>'>
                  <label for="answerOpt1Icon" class="col-sm-2 control-label">Answer1 Icon:</label>
				  <div class="col-sm-10">
					<img src='<?php echo "$answerOpt1Icon" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
		
				  </div>
                </div>
				</div>
				
				<div style='<?php echo "$answerOp2";?>'>
				<div class="form-group" style='<?php echo "$answerOpText2";?>'>
                  <label for="answerOpt2Text" class="col-sm-2 control-label">Answer2 Text:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo 
				  html_entity_decode($answerOpt2Text);?></label>
				  </div>
                </div>
				 
				<div class="form-group" style='<?php echo "$answerOpPic2";?>'>
                  <label for="answerOpt2Pic" class="col-sm-2 control-label">Answer2 Pic:</label>
				  <div class="col-sm-10">
                  <img src='<?php echo "$answerOpt2Pic" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
				  </div>
                </div>
				
				<div class="form-group" style='<?php echo "$answerOpIcon2";?>'>
                  <label for="answerOpt2Icon" class="col-sm-2 control-label">Answer2 Icon:</label>
				  <div class="col-sm-10">
					<img src='<?php echo "$answerOpt2Icon" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
		
				  </div>
                </div>
				</div>
				
				<div style='<?php echo "$answerOp3";?>'>
				<div class="form-group" style='<?php echo "$answerOpText3";?>'>
                  <label for="answerOpt3Text" class="col-sm-2 control-label">Answer3 Text:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo 
				  html_entity_decode($answerOpt3Text);?></label>
				  </div>
                </div>
				 
				<div class="form-group" style='<?php echo "$answerOpPic3";?>'>
                  <label for="answerOpt3Pic" class="col-sm-2 control-label">Answer3 Pic:</label>
				  <div class="col-sm-10">
                  <img src='<?php echo "$answerOpt3Pic" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
				  </div>
                </div>
				
				<div class="form-group" style='<?php echo "$answerOpIcon3";?>'>
                  <label for="answerOpt3Icon" class="col-sm-2 control-label">Answer3 Icon:</label>
				  <div class="col-sm-10">
					<img src='<?php echo "$answerOpt3Icon" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
		
				  </div>
                </div>
				</div>
				
				<div style='<?php echo "$answerOp4";?>'>
				<div class="form-group" style='<?php echo "$answerOpText4";?>'>
                  <label for="answerOpt4Text" class="col-sm-2 control-label">Answer4 Text:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo 
				  html_entity_decode($answerOpt4Text);?></label>
				  </div>
                </div>
				 
				<div class="form-group" style='<?php echo "$answerOpPic4";?>'>
                  <label for="answerOpt4Pic" class="col-sm-2 control-label">Answer4 Pic:</label>
				  <div class="col-sm-10">
                  <img src='<?php echo "$answerOpt4Pic" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
				  </div>
                </div>
				
				<div class="form-group" style='<?php echo "$answerOpIcon4";?>'>
                  <label for="answerOpt4Icon" class="col-sm-2 control-label">Answer4 Icon:</label>
				  <div class="col-sm-10">
					<img src='<?php echo "$answerOpt4Icon" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
		
				  </div>
                </div>
				</div>
				
				<div style='<?php echo "$answerOp5";?>'>
				<div class="form-group" style='<?php echo "$answerOpText5";?>'>
                  <label for="answerOpt5Text" class="col-sm-2 control-label">Answer5 Text:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo 
				  html_entity_decode($answerOpt5Text);?></label>
				  </div>
                </div>
				 
				<div class="form-group" style='<?php echo "$answerOpPic5";?>'>
                  <label for="answerOpt5Pic" class="col-sm-2 control-label">Answer5 Pic:</label>
				  <div class="col-sm-10">
                  <img src='<?php echo "$answerOpt5Pic" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
				  </div>
                </div>
				
				<div class="form-group" style='<?php echo "$answerOpIcon5";?>'>
                  <label for="answerOpt5Icon" class="col-sm-2 control-label">Answer5 Icon:</label>
				  <div class="col-sm-10">
					<img src='<?php echo "$answerOpt5Icon" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
		
				  </div>
                </div>
				</div>
				
			<hr>
			<h4 class="box-title">Solution Details</h4>
				<div class="form-group">
                  <label for="solutionText" class="col-sm-2 control-label">Solution Text:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo html_entity_decode($solutionText);?></label>
				  </div>
                </div>
				 
				<div class="form-group" style="<?php echo "$solutionPicDiv"; ?>">
                  <label for="solutionPic" class="col-sm-2 control-label">Solution Pic:</label>
				  <div class="col-sm-10">
                  <img src='<?php echo "$solutionPic" ;?>' class='myImg' width='75' height='75'>
					
					<!-- The Modal -->
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div></div>
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="correctAnswerOption" class="col-sm-2 control-label">Correct Answer Option:</label>
				  <div class="col-sm-10">
                  <label class="form-control" style="font-weight:normal; outline: none; border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove;"><?php echo "$correctAnswerOption";?></label>
				  </div>
                </div>
				
              </div>
              <!-- /.box-body -->
              
              <!-- /.box-footer -->
            </form>
		
		
		<!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; Jhamobi Technologies Pvt. Ltd.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementsByClassName('myImg');//document.getElementById('myImg');

var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
for (i = 0; i < img.length; i++)
{
img[i].onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
<?php
}
?>