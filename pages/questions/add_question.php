<?php
session_start();
if (!isset($_SESSION["userId"]) || !isset($_SESSION["userType"])) {
    header("Location: ../../login.html");
} else {

    include "../../config.php";

    error_reporting(0);
    $root = $_SERVER["DOCUMENT_ROOT"];
    //$path1 = "$root"."/backend/images/";
    $path1 = "$root" . "/localhost/assessment/images/questions/BCA/math/";
    $upload_url1 =
        "http://" .
        "localhost/assessment/images/questions/BCA/math/";

    if (isset($_POST["submit"])) {
        //for add question
        //$questionType=$_POST['questionType']; hide
        $gradeId = $_POST["gradeName"];
        $subjectId = $_POST["subjectName"];
        $chapterId = $_POST["chapterName"];
        $unitsId = $_POST["unitsName"];

        $res1 = mysqli_query(
            $conn,
            "select * from `grade` where `gradeId`='$gradeId'"
        );
        while ($r1 = mysqli_fetch_array($res1)) {
            $gradeName = $r1["gradeName"];
        }

        $res2 = mysqli_query(
            $conn,
            "select * from `subject` where `subjectId`='$subjectId'"
        );
        while ($r2 = mysqli_fetch_array($res2)) {
            $subjectName = $r2["subjectName"];
        }

        $res3 = mysqli_query(
            $conn,
            "select * from `chapter` where `chapterId`='$chapterId'"
        );
        while ($r3 = mysqli_fetch_array($res3)) {
            $chapterName = $r3["chapterName"];
        }

        $res4 = mysqli_query(
            $conn,
            "select * from `subject_units` where `unitsId`='$unitsId'"
        );
        while ($r4 = mysqli_fetch_array($res4)) {
            $unitsName = $r4["unitsName"];
        }

        $status = $_POST["status"];

        $complexityLevel = $_POST["complexityLevel"];
        $questionText = $_POST["questionText"];

        $numberOptions = $_POST["numberOptions"];

        $answerOptType = $_POST["answerOptions"];
        $answerText1 = $_POST["answerText1"];
        $answerText2 = $_POST["answerText2"];
        $answerText3 = $_POST["answerText3"];
        $answerText4 = $_POST["answerText4"];
        $answerText5 = $_POST["answerText5"];

        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");

        $addedOn = $date;
        $addedBy = $_SESSION["userType"];

        $solutionText = $_POST["solutionText"];
        $correctAnsOption = $_POST["correctAnsOption"];

        //$subjectId=$_POST['subjectId'];

        $result1 = mysqli_query(
            $conn,
            "INSERT INTO question (`complexityLevel`, `gradeId`, `gradeName`, `subjectId`, `subjectName`, `unitsId`, `unitsName`, `chapterId`, `chapterName`, `questionText`, `addedOn`, `addedBy`, `status`) VALUES ('$complexityLevel', '$gradeId', '$gradeName', '$subjectId', '$subjectName', '$unitsId', '$unitsName', '$chapterId', '$chapterName', '$questionText', '$addedOn', '$addedBy', '$status')"
        );
        if ($result1) {
            $questionID = mysqli_insert_id($conn);

            $dir = "quesid_" . $questionID;
            chdir("../../images/questions/BCA/math/");

            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);

                if (is_dir($dir)) {
                    $path1 =
                        "$root" .
                        "/localhost/assessment/images/questions/BCA/math/" .
                        "$dir" .
                        "/";

                    $upload_url1 =
                        "http://" .
                        "localhost/assessment/images/questions/BCA/math/" .
                        "$dir" .
                        "/";

                    if (isset($_FILES["questionPic"])) {
                        //getting file info from the request
                        $fileinfo1 = pathinfo($_FILES["questionPic"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "q1";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path to upload in the server
                        $result1 = move_uploaded_file(
                            $_FILES["questionPic"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $question_pic =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $question_pic = "";
                        }
                    }

                    if (isset($_FILES["answerIcon1"])) {
                        $fileinfo1 = pathinfo($_FILES["answerIcon1"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "ai1";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path
                        $result1 = move_uploaded_file(
                            $_FILES["answerIcon1"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $answer_icon1 =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $answer_icon1 = "";
                        }
                    }

                    if (isset($_FILES["answerPic1"])) {
                        $fileinfo1 = pathinfo($_FILES["answerPic1"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "ap1";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path
                        $result1 = move_uploaded_file(
                            $_FILES["answerPic1"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $answer_pic1 =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $answer_pic1 = "";
                        }
                    }

                    if (isset($_FILES["answerIcon2"])) {
                        $fileinfo1 = pathinfo($_FILES["answerIcon2"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "ai2";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path
                        $result1 = move_uploaded_file(
                            $_FILES["answerIcon2"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $answer_icon2 =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $answer_icon2 = "";
                        }
                    }

                    if (isset($_FILES["answerPic2"])) {
                        $fileinfo1 = pathinfo($_FILES["answerPic2"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "ap2";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path to upload
                        $result1 = move_uploaded_file(
                            $_FILES["answerPic2"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $answer_pic2 =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $answer_pic2 = "";
                        }
                    }

                    if (isset($_FILES["answerIcon3"])) {
                        $fileinfo1 = pathinfo($_FILES["answerIcon3"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "ai3";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path to
                        $result1 = move_uploaded_file(
                            $_FILES["answerIcon3"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $answer_icon3 =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $answer_icon3 = "";
                        }
                    }

                    if (isset($_FILES["answerPic3"])) {
                        $fileinfo1 = pathinfo($_FILES["answerPic3"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "ap3";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path to upload
                        $result1 = move_uploaded_file(
                            $_FILES["answerPic3"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $answer_pic3 =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $answer_pic3 = "";
                        }
                    }

                    if (isset($_FILES["answerIcon4"])) {
                        $fileinfo1 = pathinfo($_FILES["answerIcon4"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "ai4";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path to
                        $result1 = move_uploaded_file(
                            $_FILES["answerIcon4"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $answer_icon4 =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $answer_icon4 = "";
                        }
                    }

                    if (isset($_FILES["answerPic4"])) {
                        $fileinfo1 = pathinfo($_FILES["answerPic4"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "ap4";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path to
                        $result1 = move_uploaded_file(
                            $_FILES["answerPic4"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $answer_pic4 =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $answer_pic4 = "";
                        }
                    }

                    if (isset($_FILES["answerIcon5"])) {
                        $fileinfo1 = pathinfo($_FILES["answerIcon5"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "ai5";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path to
                        $result1 = move_uploaded_file(
                            $_FILES["answerIcon5"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $answer_icon5 =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $answer_icon5 = "";
                        }
                    }

                    if (isset($_FILES["answerPic5"])) {
                        $fileinfo1 = pathinfo($_FILES["answerPic5"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "ap5";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path to upload
                        $result1 = move_uploaded_file(
                            $_FILES["answerPic5"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $answer_pic5 =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $answer_pic5 = "";
                        }
                    }

                    if (isset($_FILES["solutionImage"])) {
                        $fileinfo1 = pathinfo($_FILES["solutionImage"]["name"]);
                        $extension1 = $fileinfo1["extension"];
                        $filename1 = $fileinfo1["filename"];
                        $f1 = $filename1;
                        $filename1 = "s1";
                        $file_path1 = $path1 . $filename1 . "." . $extension1; //file path to upload
                        $result1 = move_uploaded_file(
                            $_FILES["solutionImage"]["tmp_name"],
                            $file_path1
                        );
                        if ($f1 != "") {
                            $solution_image =
                                $upload_url1 . $filename1 . "." . $extension1;
                            $flag++;
                        } else {
                            $solution_image = "";
                        }
                    }

                    $result6 = mysqli_query(
                        $conn,
                        "UPDATE `question` SET `questionPic`='$question_pic' WHERE `questionID`='$questionID'"
                    );
                    if (mysqli_affected_rows($conn) > 0) {
                        $result2 = mysqli_query(
                            $conn,
                            "INSERT INTO answer_options (`questionId`, `answerOptions`, `answerOptType`, `answerOpt1Text`, `answerOpt1Pic`, `answerOpt1Icon`, `answerOpt2Text`, `answerOpt2Pic`, `answerOpt2Icon` , `answerOpt3Text`, `answerOpt3Pic`, `answerOpt3Icon`, `answerOpt4Text`, `answerOpt4Pic`, `answerOpt4Icon`, `answerOpt5Text`, `answerOpt5Pic`, `answerOpt5Icon`) VALUES ('$questionID','$numberOptions','$answerOptType','$answerText1','$answer_pic1','$answer_icon1','$answerText2','$answer_pic2','$answer_icon2','$answerText3','$answer_pic3','$answer_icon3','$answerText4','$answer_pic4','$answer_icon4','$answerText5','$answer_pic5','$answer_icon5')"
                        );
                        if ($result2) {
                            $answerOptionId = mysqli_insert_id($conn);

                            $result3 = mysqli_query(
                                $conn,
                                "INSERT INTO solution (`questionId`, `solutionText`, `solutionPic`, `correctAnswerOption`) VALUES ('$questionID','$solutionText','$solution_image','$correctAnsOption')"
                            );
                            if ($result3) {
                                $solutionId = mysqli_insert_id($conn);

                                echo "<script type='text/javascript'>
								window.location.href='http://localhost/assessment/pages/questions/view_question.php';
								alert('Question added successfully!')
								</script>";
                            } else {
                                echo "<script type='text/javascript'>alert('cannot insert solution!')</script>";
                            }
                        } else {
                            echo "<script type='text/javascript'>alert('cannot insert answer options!')</script>";
                        }
                    } else {
                        echo "<script type='text/javascript'>alert('cannot upload question image!')</script>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('directory not exists!')</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('cannot create directory!')</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Something went wrong!')</script>";
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
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">
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
					.response {
			    padding: 10px;
			    margin-top: 10px;
			    border-radius: 2px;
			}

			.error {
			    background: #fdcdcd;
			    border: #ecc0c1 1px solid;
			}

			.success {
			    background: #c5f3c3;
			    border: #bbe6ba 1px solid;
			}
		</style>
		
	<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=default'></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>A</b>LT</span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b><?php echo $_SESSION["userType"]; ?></b></span>
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
	  
				<h4 style="color:white; text-align:center;" class="col-sm-10 control-label">Assessment System for Education Institute<br>
				</h4>
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
    <?php include "menu.php"; ?>
  </aside>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Questions
        <!--<small>Question</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Questions</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	  
		<div class="col-xs-12">
		<div class="box-header with-border">
              <h3 class="box-title">Add New Quesion</h3>
            </div>
			
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#basicInfo" data-toggle="tab">Basic Info</a></li>
              <li><a href="#questionInfo" data-toggle="tab">Question Info</a></li>
			  <li><a href="#answerOption" data-toggle="tab">Answer Option</a></li>
			  <li><a href="#solutionInfo" data-toggle="tab">Solution Info</a></li>
			  <li><a href="#preview" data-toggle="tab">Preview</a></li>
            </ul>
			<form role="form" class="form-horizontal" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
			<div class="tab-content" style="padding: 40px;">
              <!-- Basic Info -->
              <div class="tab-pane active" id="basicInfo">
				<div class="form-group">
                  <label for="gradeName" class="col-sm-2 control-label">Program name:</label>
				  <div class="col-sm-10">
				  <select class="form-control select2" name="gradeName" id="gradeName" style="width: 100%;" required>
                  <option selected="selected" disabled>--Select--</option>
                  <?php
                  $result = mysqli_query($conn, "select * from grade");
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='$row[gradeId]'>$row[gradeName]</option>";
                  }
                  ?>
				  </select>
				  
				  </div>
                </div>

				<div class="form-group">
                  <label for="subjectName" class="col-sm-2 control-label">Course name:</label>
				  <div class="col-sm-10">
				  <select class="form-control select2" name="subjectName" id="subjectName" style="width: 100%;" required>
                  <option selected="selected" disabled>--Select--</option>
                  <?php
                  $result = mysqli_query($conn, "SELECT * FROM subject");
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='$row[subjectId]'>$row[subjectName]</option>";
                  }
                  ?>
				  </select>				  
				  </div>
                </div>
				
				<!--<div class="form-group">
                  <label for="chapterName" class="col-sm-2 control-label">Chapter Name:</label>
				   <div class="col-sm-10">
				  		<select class="form-control select2" name="chapterName" id="chapterName" style="width: 100%;" required>
                  <option selected="selected" disabled>--Select--</option>
                  <?php
    //$result=mysqli_query($conn,'SELECT * FROM chapter');
    //while($row=mysqli_fetch_assoc($result))
    //{
    //	echo "<option value='$row[chapterId]'>$row[chapterName]</option>";
    //}
    ?>
				  	</select>
				  </div> 
                </div>
				
						<div class="form-group">
               <label for="unitsName" class="col-sm-2 control-label">Units Name:</label>
								<div class="col-sm-10">
								  <select class="form-control select2" name="unitsName" id="unitsName" style="width: 100%;" required>
				                  <option selected="selected" disabled>--Select--</option>
				                  <?php
    //$result=mysqli_query($conn,'SELECT * FROM subject_units');
    //while($row=mysqli_fetch_assoc($result))
    //{
    //	echo "<option value='$row[unitsId]'>$row[unitsName]</option>";
    //}
    ?>
								  </select>
								</div>
            </div>-->
				
				<div class="form-group">
                  <label for="status" class="col-sm-2 control-label">Status:</label>
				  <div class="col-sm-10" required>
					<select class="form-control select2" name="status" id="status" style="width: 100%;">
					  <option selected="selected" disabled>--Select--</option>
					  <option value="1">Active</option>
					  <option value="2">Inactive</option>
					</select>			  
				  </div>
                </div>
				
				<a id="buttonTab1Next" class="btn btn-primary" >Next</a>
		
			  </div>
			  
			  <!-- Question Info -->
			  <div class="tab-pane" id="questionInfo">
				<div class="form-group">
                  <label for="complexityLevel" class="col-sm-2 control-label">Complexity *</label>
				  <!-- radio -->
				  <div class="col-sm-10" style="margin-top: 5px;">
					  <input type="radio" name="complexityLevel" value="Simple" class="minimal" checked> Simple &nbsp;
					  <input type="radio" name="complexityLevel" value="Medium" class="minimal"> Medium &nbsp;
					  <input type="radio" name="complexityLevel" value="Complex" class="minimal"> Complex 
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="questionText" class="col-sm-2 control-label">Specify Question *</label>
				  <div class="col-sm-10">
				  <textarea class="form-control" id="questionText" name="questionText" rows="10" cols="80" placeholder="Question text" required></textarea>
				  
				  </div>
                </div>
				
				
				<!--question pic-->
				<div class="form-group">
                  <label for="questionPic" class="col-sm-2 control-label">Question Pic</label>
				  <div class="col-sm-10">
				  <input type="file" id="questionPic" name="questionPic" onchange="loadFileQuestionPic(event)" accept="image/*">
				  
				  <div id="reset_que_pic" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
				  
				  <img style='display:none;' id="outputQuestionPic" style="margin-top: 10px;" width='100' height='100'/>
                </div>
				</div>
				
				<a class="btn btn-primary btnPrevious" >Previous</a>
				<a id="buttonTab2Next" class="btn btn-primary" >Next</a>
				
			  </div>
			  
			  <!-- Answer Option -->
			  <div class="tab-pane" id="answerOption">
				
				<div class="form-group">
                  <label for="numberOptions" class="col-sm-2 control-label">How many answer * options?:</label>
				  <div class="col-sm-10">
                  <input type="number" class="form-control" name="numberOptions" id="numberOptions" placeholder="Number of answer options" value="<?php echo $numberOptions; ?>" min="1" max="5" required>
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="answerOptions" class="col-sm-2 control-label">Answer options would have?</label>
				  <!-- radio -->
				  <div class="col-sm-10">
					  <input type="radio" name="answerOptions" id="icons_only" value="1" class="minimal"  checked>&nbsp;&nbsp; Icons only 
					  <br/><br/>
					  <input type="radio" name="answerOptions" id="text_only" value="2" class="minimal">&nbsp;&nbsp; Text only 
					  <br/><br/>
					  <input type="radio" name="answerOptions" id="icons_text" value="3" class="minimal">&nbsp;&nbsp; Icons + Text 
					  <br/><br/>
					  <input type="radio" name="answerOptions" id="pictures" value="4" class="minimal">&nbsp;&nbsp; Pictures 
					  <br/><br/>
					  <input type="radio" name="answerOptions" id="pictures_text" value="5" class="minimal">&nbsp;&nbsp; Pictures + Text
					  
					<div class="box-footer" align="right">
						<input type='text' id="addQuestion1"  class="btn btn-primary" style="padding: 0; border: none; background: none;color:blue;" value='+ ADD ANSWER OPTION' readonly>
					</div>
					  
				  </div>				  
                </div>
	
				<!--option1-->
				<div id="dvAnsOp1" style="display: none">
				<hr>	
				<div class="box-footer" align="right">
					<i class='glyphicon glyphicon-remove' id="removeQuestion1"></i>
				</div>
					
				Answer Option 1
					<div class="form-group" id="divAnswerText1">
					  <label for="answerText1" class="col-sm-2 control-label">Answer Text:</label>
					  <div class="col-sm-10">
					  <textarea class="form-control" id="answerText1" name="answerText1" rows="5" cols="80" placeholder="Answer text"><?php echo $answerText1; ?></textarea>	
				  
					  </div>
					</div>
					
					<!--Answer icon-->
					<div class="form-group" id="divAnswerIcon1">
					  <label for="answerIcon1" class="col-sm-2 control-label">Answer icon</label>
					  <div class="col-sm-10">
					  <input type="file" id="answerIcon1" name="answerIcon1" onchange="loadFileAnswerIcon1(event)" accept="image/*">
					  
					  <div id="reset_ans1_icon" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
					  
					  <img style='display:none;' id="outputAnswerIcon1" style="margin-top: 10px;" width='100' height='100'/>
					  </div>
					</div>
					
					<!--Answer icon-->
					<div class="form-group" id="divAnswerPic1">
					  <label for="answerPic1" class="col-sm-2 control-label">Answer picture</label>
					  <div class="col-sm-10">
					  <input type="file" id="answerPic1" name="answerPic1" onchange="loadFileAnswerPic1(event)" accept="image/*">
					  
					  <div id="reset_ans1_pic" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
					  
					  <img style='display:none;' id="outputAnswerPic1" style="margin-top: 10px;" width='100' height='100'/>
					  </div>
					</div>
					
					<div class="box-footer" align="right">
						<input type='text' id="addQuestion2"  class="btn btn-primary" style="padding: 0; border: none; background: none;color:blue;" value='+ ADD ANSWER OPTION' readonly>
					</div>
				
				</div>
				
				<!--option2-->
				<div id="dvAnsOp2" style="display: none">
				<hr>
				<div class="box-footer" align="right">
					<i class='glyphicon glyphicon-remove' id="removeQuestion2"></i>
				</div>
				Answer Option 2
					<div class="form-group" id="divAnswerText2">
					  <label for="answerText2" class="col-sm-2 control-label">Answer Text:</label>
					  <div class="col-sm-10">
					  <textarea class="form-control" id="answerText2" name="answerText2" rows="5" cols="80" placeholder="Answer text"><?php echo $answerText2; ?></textarea>	
					  </div>
					</div>
					
					<!--Answer icon-->
					<div class="form-group" id="divAnswerIcon2">
					  <label for="answerIcon2" class="col-sm-2 control-label">Answer icon</label>
					  <div class="col-sm-10">
					  <input type="file" id="answerIcon2" name="answerIcon2" onchange="loadFileAnswerIcon2(event)" accept="image/*">
					  
					  <div id="reset_ans2_icon" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
					  
					  <img style='display:none;' id="outputAnswerIcon2" style="margin-top: 10px;" width='100' height='100'/>
					  </div>
					</div>
					
					<!--Answer icon-->
					<div class="form-group" id="divAnswerPic2">
					  <label for="answerPic2" class="col-sm-2 control-label">Answer picture</label>
					  <div class="col-sm-10">
					  <input type="file" id="answerPic2" name="answerPic2" onchange="loadFileAnswerPic2(event)" accept="image/*">
					  
					  <div id="reset_ans2_pic" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
					  
					  <img style='display:none;' id="outputAnswerPic2" style="margin-top: 10px;" width='100' height='100'/>
					  </div>
					</div>
					<div class="box-footer" align="right">
					<input type='text' id="addQuestion3"  class="btn btn-primary" style="padding: 0; border: none; background: none;color:blue;" value='+ ADD ANSWER OPTION' readonly>
				</div>
				</div>
				
				<!--option3-->
				<div id="dvAnsOp3" style="display: none">
				<hr>
				<div class="box-footer" align="right">
					<i class='glyphicon glyphicon-remove' id="removeQuestion3"></i>
				</div>
					Answer Option 3
					<div class="form-group" id="divAnswerText3">
					  <label for="answerText3" class="col-sm-2 control-label">Answer Text:</label>
					  <div class="col-sm-10">
					  <textarea class="form-control" id="answerText3" name="answerText3" rows="5" cols="80" placeholder="Answer text"><?php echo $answerText3; ?></textarea>	
					  </div>
					</div>
					
					<!--Answer icon-->
					<div class="form-group" id="divAnswerIcon3">
					  <label for="answerIcon3" class="col-sm-2 control-label">Answer icon</label>
					  <div class="col-sm-10">
					  <input type="file" id="answerIcon3" name="answerIcon3" onchange="loadFileAnswerIcon3(event)" accept="image/*">
					  
					  <div id="reset_ans3_icon" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
					  
					  <img style='display:none;' id="outputAnswerIcon3" style="margin-top: 10px;" width='100' height='100'/>
					  </div>
					</div>
					
					<!--Answer icon-->
					<div class="form-group" id="divAnswerPic3">
					  <label for="answerPic3" class="col-sm-2 control-label">Answer picture</label>
					  <div class="col-sm-10">
					  <input type="file" id="answerPic3" name="answerPic3" onchange="loadFileAnswerPic3(event)" accept="image/*">
					  
					  <div id="reset_ans3_pic" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
					  
					  <img style='display:none;' id="outputAnswerPic3" style="margin-top: 10px;" width='100' height='100'/>
					  </div>
					</div>
					
					<div class="box-footer" align="right">
						<input type='text' id="addQuestion4"  class="btn btn-primary" style="padding: 0; border: none; background: none;color:blue;" value='+ ADD ANSWER OPTION' readonly>
					</div>
				
				</div>
				
				<!--option4-->
				<div id="dvAnsOp4" style="display: none">
				<hr>
				<div class="box-footer" align="right">
					<i class='glyphicon glyphicon-remove' id="removeQuestion4"></i>
				</div>
				Answer Option 4
					<div class="form-group" id="divAnswerText4">
					  <label for="answerText4" class="col-sm-2 control-label">Answer Text:</label>
					  <div class="col-sm-10">
					  <textarea class="form-control" id="answerText4" name="answerText4" rows="5" cols="80" placeholder="Answer text"><?php echo $answerText4; ?></textarea>	
					  </div>
					</div>
					
					<!--Answer icon-->
					<div class="form-group" id="divAnswerIcon4">
					  <label for="answerIcon" class="col-sm-2 control-label">Answer icon</label>
					  <div class="col-sm-10">
					  <input type="file" id="answerIcon4" name="answerIcon4" onchange="loadFileAnswerIcon4(event)" accept="image/*">
					  
					  <div id="reset_ans4_icon" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
					  
					  <img style='display:none;' id="outputAnswerIcon4" style="margin-top: 10px;" width='100' height='100'/>
					  </div>
					</div>
					
					<!--Answer icon-->
					<div class="form-group" id="divAnswerPic4">
					  <label for="answerPic" class="col-sm-2 control-label">Answer picture</label>
					  <div class="col-sm-10">
					  <input type="file" id="answerPic4" name="answerPic4" onchange="loadFileAnswerPic4(event)" accept="image/*">
					  
					  <div id="reset_ans4_pic" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
					  
					  <img style='display:none;' id="outputAnswerPic4" style="margin-top: 10px;" width='100' height='100'/>
					  </div>
					</div>
					<div class="box-footer" align="right">
					<input type='text' id="addQuestion5"  class="btn btn-primary" style="padding: 0; border: none; background: none;color:blue;" value='+ ADD ANSWER OPTION' readonly>
				</div>
				</div>
				
				<!--option5-->
				<div id="dvAnsOp5" style="display: none">
				<hr>
				<div class="box-footer" align="right">
				<i class='glyphicon glyphicon-remove' id="removeQuestion5"></i>
				</div>
				Answer Option 5
					<div class="form-group" id="divAnswerText5">
					  <label for="answerText5" class="col-sm-2 control-label">Answer Text:</label>
					  <div class="col-sm-10">
					  <textarea class="form-control" id="answerText5" name="answerText5" rows="5" cols="80" placeholder="Answer text"><?php echo $answerText5; ?></textarea>	
					  </div>
					</div>
					
					<!--Answer icon-->
					<div class="form-group" id="divAnswerIcon5">
					  <label for="answerIcon5" class="col-sm-2 control-label">Answer icon</label>
					  <div class="col-sm-10">
					  <input type="file" id="answerIcon5" name="answerIcon5" onchange="loadFileAnswerIcon5(event)" accept="image/*">
					  
					  <div id="reset_ans5_icon" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
					  
					  <img style='display:none;' id="outputAnswerIcon5" style="margin-top: 10px;" width='100' height='100'/>
					  </div>
					</div>
					
					<!--Answer icon-->
					<div class="form-group" id="divAnswerPic5">
					  <label for="answerPic5" class="col-sm-2 control-label">Answer picture</label>
					  <div class="col-sm-10">
					  <input type="file" id="answerPic5" name="answerPic5" onchange="loadFileAnswerPic5(event)" accept="image/*">
					  
					  <div id="reset_ans5_pic" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
					  
					  <img style='display:none;' id="outputAnswerPic5" style="margin-top: 10px;" width='100' height='100'/>
					  </div>
					</div>
				</div>
			  
				<a class="btn btn-primary btnPrevious" >Previous</a>
				<a id="buttonTab3Next" class="btn btn-primary" >Next</a>
				
			  </div>
			  
			  <!-- Solution Info -->
			  <div class="tab-pane" id="solutionInfo">
			  
				<div class="form-group">
					  <label for="solutionText" class="col-sm-2 control-label">Solution Text:</label>
					  <div class="col-sm-10">
					  <textarea class="form-control" id="solutionText" name="solutionText" rows="10" cols="80" placeholder="Solution text"><?php echo $solutionText; ?></textarea>				
					  </div>
					</div>
				
				<div class="form-group">
              <label for="status" class="col-sm-2 control-label">Correct Answer Option:</label>
				  <div class="col-sm-10" required>
					<select class="form-control select2" name="correctAnsOption" id="correctAnsOption" style="width: 100%;">
					  <option selected="selected" disabled>--Select--</option>
					  <option value="1">1. Option A</option>
					  <option value="2">2. Option B</option>
					  <option value="3">3. Option C</option>
					  <option value="4">4. Option D</option>
					</select>			  
				  </div>
				</div>
				
				<div class="form-group">
				  <label for="solutionImage" class="col-sm-2 control-label">Solution image</label>
				  <div class="col-sm-10">
				  <input type="file" id="solutionImage" name="solutionImage" onchange="loadFileSolutionImage(event)" accept="image/*">
				  
				  <div id="reset_sol_pic" class="btn btn-primary" style="margin:10px; display:none;">Reset Image</div>
				  
				  <img style='display:none;' id="outputSolutionImage" style="margin-top: 10px;" width='100' height='100'/>
				  </div>
				</div>
				
				<a class="btn btn-primary btnPrevious" >Previous</a>
				<a class="btn btn-primary" onclick="changeLabel()">Next</a>
			  </div>
			  
			  <!-- Preview -->
			  <div class="tab-pane" id="preview">
				<div class="box-body">
				<div class="form-group">
                  <label for="questionText_1" class="col-sm-2 control-label">Q:</label>
				  <div class="col-sm-10">
				  <div id="questionText_1">N/A</div>
				  </div>
                </div>
				
				<div class="form-group">
				<label for="outputQuestionPic1" class="col-sm-2 control-label"></label>
				  <div class="col-sm-10">
				  <img style='display:none;' id="outputQuestionPic1" style="margin-top: 10px;" width='100' height='100'/>
					<div id='myModal' class='modal'>
					<!-- The Close Button -->
					<span class='close'>&times;</span>
					<!-- Modal Content (The Image) -->
					<img class='modal-content' id='img01'>
					<!-- Modal Caption (Image Text) -->
					<div id='caption'></div>
					</div>
				  </div>
                </div>
				
				<div id="dvAnsOp1_1" style="display: none">
				<div class="form-group" id="divAnswerText1_1">
                  <label for="answerOpt1Text" class="col-sm-2 control-label">(A).</label>
				  <div class="col-sm-10">
				  <div id="answerText1_1">N/A</div>
				  </div>
                </div>
				 
				<div class="form-group" id="divAnswerPic1_1">
                  <label for="answerOpt1Pic" class="col-sm-2 control-label">Answer1 Pic:</label>
				  <div class="col-sm-10">
				  
                  <img style='display:none;' id="outputAnswerPic1_1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
				
				<div class="form-group" id="divAnswerIcon1_1">
                  <label for="answerOpt1Icon" class="col-sm-2 control-label">Answer1 Icon:</label>
				  <div class="col-sm-10">
				  
				  <img style='display:none;' id="outputAnswerIcon1_1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
				
				<div id="dvAnsOp2_1" style="display: none">
				<div class="form-group" id="divAnswerText2_1">
                  <label for="answerOpt2Text" class="col-sm-2 control-label">(B).</label>
				  <div class="col-sm-10">
				  <div id="answerText2_1">N/A</div>
				  </div>
                </div>
				 
				<div class="form-group" id="divAnswerPic2_1">
                  <label for="answerOpt2Pic" class="col-sm-2 control-label">Answer2 Pic:</label>
				  <div class="col-sm-10">
                  <img style='display:none;' id="outputAnswerPic2_1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
				
				<div class="form-group" id="divAnswerIcon2_1">
                  <label for="answerOpt2Icon" class="col-sm-2 control-label">Answer2 Icon:</label>
				  <div class="col-sm-10">
					<img style='display:none;' id="outputAnswerIcon2_1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
				
				<div id="dvAnsOp3_1" style="display: none">
				<div class="form-group" id="divAnswerText3_1">
                  <label for="answerOpt3Text" class="col-sm-2 control-label">(C).</label>
				  <div class="col-sm-10">
				  <div id="answerText3_1">N/A</div>
				  </div>
                </div>
				 
				<div class="form-group" id="divAnswerPic3_1">
                  <label for="answerOpt3Pic" class="col-sm-2 control-label">Answer3 Pic:</label>
				  <div class="col-sm-10">
                  <img style='display:none;' id="outputAnswerPic3_1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
				
				<div class="form-group" id="divAnswerIcon3_1">
                  <label for="answerOpt3Icon" class="col-sm-2 control-label">Answer3 Icon:</label>
				  <div class="col-sm-10">
					<img style='display:none;' id="outputAnswerIcon3_1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
				
				<div id="dvAnsOp4_1" style="display: none">
				<div class="form-group" id="divAnswerText4_1">
                  <label for="answerOpt4Text" class="col-sm-2 control-label">(D).</label>
				  <div class="col-sm-10">
				  <div id="answerText4_1">N/A</div>
				  </div>
                </div>
				 
				<div class="form-group" id="divAnswerPic4_1">
                  <label for="answerOpt4Pic" class="col-sm-2 control-label">Answer4 Pic:</label>
				  <div class="col-sm-10">
                  <img style='display:none;' id="outputAnswerPic4_1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
				
				<div class="form-group" id="divAnswerIcon4_1">
                  <label for="answerOpt4Icon" class="col-sm-2 control-label">Answer4 Icon:</label>
				  <div class="col-sm-10">
					<img style='display:none;' id="outputAnswerIcon4_1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
				
				<div id="dvAnsOp5_1" style="display: none">
				<div class="form-group" id="divAnswerText5_1">
                  <label for="answerOpt5Text" class="col-sm-2 control-label">(E).</label>
				  <div class="col-sm-10">
				  <div id="answerText5_1">N/A</div>
				  </div>
                </div>
				 
				<div class="form-group" id="divAnswerPic5_1">
                  <label for="answerOpt5Pic" class="col-sm-2 control-label">Answer5 Pic:</label>
				  <div class="col-sm-10">
                  <img style='display:none;' id="outputAnswerPic5_1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
				
				<div class="form-group" id="divAnswerIcon5_1">
                  <label for="answerOpt5Icon" class="col-sm-2 control-label">Answer5 Icon:</label>
				  <div class="col-sm-10">
					<img style='display:none;' id="outputAnswerIcon5_1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
                  <label for="correctAnswerOption" class="col-sm-2 control-label">Correct Option:</label>
				  <div class="col-sm-10">
                  <label id="correctAnsOption_1" style="font-weight:normal;margin-top:5px;"></label>
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="solutionText" class="col-sm-2 control-label">Solution Hint:</label>
				  <div class="col-sm-10">
				  <div id="solutionText_1">N/A</div>
				  </div>
                </div>
				 
				<div class="form-group">
				<label for="outputSolutionImage1" class="col-sm-2 control-label"></label>
				  <div class="col-sm-10">
                  <img style='display:none;' id="outputSolutionImage1" class='myImg' style="margin-top: 10px;" width='100' height='100'/>
					
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
				
				<div class="box-footer" align="middle">
				<input type='submit' id="submit" name='submit' class="btn btn-primary" value='Add Question'>
				</div>
				
			   </div>
			  </div>
			</div>
			</form>			
		  </div>
		</div>
	 </div>
	  
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!--<div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>-->
    <strong>Copyright &copy; Jhamobi Technologies Pvt. Ltd. 2022-2023</strong> All rights reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page script -->

<!-- CK Editor -->
<script src="../../bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
//for removing  uploaded images
$(document).ready(function() 
{
   $('#reset_que_pic').on('click', function(e) {
      var $el = $('#questionPic');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputQuestionPic").hide();
	  $("#outputQuestionPic1").hide();
	  $("#reset_que_pic").hide();
   });
   
   $('#reset_ans1_icon').on('click', function(e) {
      var $el = $('#answerIcon1');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputAnswerIcon1").hide();
	  $("#outputAnswerIcon1_1").hide();
	  $("#reset_ans1_icon").hide();
   });
   $('#reset_ans1_pic').on('click', function(e) {
      var $el = $('#answerPic1');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputAnswerPic1").hide();
	  $("#outputAnswerPic1_1").hide();
	  $("#reset_ans1_pic").hide();
   });
   
   $('#reset_ans2_icon').on('click', function(e) {
      var $el = $('#answerIcon2');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputAnswerIcon2").hide();
	  $("#outputAnswerIcon2_1").hide();
	  $("#reset_ans2_icon").hide();
   });
   $('#reset_ans2_pic').on('click', function(e) {
      var $el = $('#answerPic2');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputAnswerPic2").hide();
	  $("#outputAnswerPic2_1").hide();
	  $("#reset_ans2_pic").hide();
   });
   
   $('#reset_ans3_icon').on('click', function(e) {
      var $el = $('#answerIcon3');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputAnswerIcon3").hide();
	  $("#outputAnswerIcon3_1").hide();
	  $("#reset_ans3_icon").hide();
   });
   $('#reset_ans3_pic').on('click', function(e) {
      var $el = $('#answerPic3');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputAnswerPic3").hide();
	  $("#outputAnswerPic3_1").hide();
	  $("#reset_ans3_pic").hide();
   });
   
   $('#reset_ans4_icon').on('click', function(e) {
      var $el = $('#answerIcon4');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputAnswerIcon4").hide();
	  $("#outputAnswerIcon4_1").hide();
	  $("#reset_ans4_icon").hide();
   });
   $('#reset_ans4_pic').on('click', function(e) {
      var $el = $('#answerPic4');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputAnswerPic4").hide();
	  $("#outputAnswerPic4_1").hide();
	  $("#reset_ans4_pic").hide();
   });
   
   $('#reset_ans5_icon').on('click', function(e) {
      var $el = $('#answerIcon5');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputAnswerIcon5").hide();
	  $("#outputAnswerIcon5_1").hide();
	  $("#reset_ans5_icon").hide();
   });
   $('#reset_ans5_pic').on('click', function(e) {
      var $el = $('#answerPic5');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputAnswerPic5").hide();
	  $("#outputAnswerPic5_1").hide();
	  $("#reset_ans5_pic").hide();
   });
   
   $('#reset_sol_pic').on('click', function(e) {
      var $el = $('#solutionImage');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#outputSolutionImage").hide();
	  $("#outputSolutionImage1").hide();
	  $("#reset_sol_pic").hide();
   });
});
</script>


<script>
function changeLabel() 
{
	var focusSet = false;
	
    if (!$('#correctAnsOption').val()) 
	{
        if ($("#correctAnsOption").parent().next(".validation").length == 0) // only add if not added
        {
            $("#correctAnsOption").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select correct answer option!</div>");
        }
        e.preventDefault(); // prevent form from POST to server
        $('#correctAnsOption').focus();
        focusSet = true;
    } else {
        $("#correctAnsOption").parent().next(".validation").remove(); // remove it
		
		let questionText_1 = document.getElementById('questionText_1');
		let answerText1_1 = document.getElementById('answerText1_1');
		let answerText2_1 = document.getElementById('answerText2_1');
		let answerText3_1 = document.getElementById('answerText3_1');
		let answerText4_1 = document.getElementById('answerText4_1');
		let answerText5_1 = document.getElementById('answerText5_1');
		let solutionText_1 = document.getElementById('solutionText_1');
		
		let correctAnsOption_1 = document.getElementById('correctAnsOption_1');
		
		let questionText = document.getElementById('questionText').value;
		
		let answerText1 = document.getElementById('answerText1').value;
		let answerText2 = document.getElementById('answerText2').value;
		let answerText3 = document.getElementById('answerText3').value;
		let answerText4 = document.getElementById('answerText4').value;
		let answerText5 = document.getElementById('answerText5').value;
		
		let solutionText = document.getElementById('solutionText').value;
		let correctAnsOption = document.getElementById('correctAnsOption').value;
		
		questionText_1.innerHTML = questionText;
		
		solutionText_1.innerHTML = solutionText;
		correctAnsOption_1.innerHTML = correctAnsOption;
		
		answerText1_1.innerHTML = answerText1;
		answerText2_1.innerHTML = answerText2;
		answerText3_1.innerHTML = answerText3;
		answerText4_1.innerHTML = answerText4;
		answerText5_1.innerHTML = answerText5;
		
		MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
		
		 $('.nav-tabs > .active').next('li').find('a').trigger('click');
			
		//$('.nav-tabs > .active').next('li').find('a').trigger('click');
    }
}	
</script>

<script>
//for tabs next and previous
$('.btnNext').click(function(){
  $('.nav-tabs > .active').next('li').find('a').trigger('click');
});

  $('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});
</script>

<script>
$('#buttonTab1Next').click(function() 
{
    var focusSet = false;
    if (!$('#gradeName').val()) {
        if ($("#gradeName").parent().next(".validation").length == 0) // only add if not added
        {
            $("#gradeName").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select Grade!</div>");
        }
        e.preventDefault(); // prevent form from POST to server
        $('#gradeName').focus();
        focusSet = true;
    } else {
        $("#gradeName").parent().next(".validation").remove(); // remove it
    }
	
	if (!$('#subjectName').val()) {
        if ($("#subjectName").parent().next(".validation").length == 0) // only add if not added
        {
            $("#subjectName").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select Subject!</div>");
        }
        e.preventDefault(); // prevent form from POST to server
        $('#subjectName').focus();
        focusSet = true;
    } else {
        $("#subjectName").parent().next(".validation").remove(); // remove it
    }
	
	/*if (!$('#chapterName').val()) {
        if ($("#chapterName").parent().next(".validation").length == 0) // only add if not added
        {
            $("#chapterName").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select Chapter!</div>");
        }
        e.preventDefault(); // prevent form from POST to server
        $('#chapterName').focus();
        focusSet = true;
    } else {
        $("#chapterName").parent().next(".validation").remove(); // remove it
    }
	
	if (!$('#unitsName').val()) {
        if ($("#unitsName").parent().next(".validation").length == 0) // only add if not added
        {
            $("#unitsName").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select Unit!</div>");
        }
        e.preventDefault(); // prevent form from POST to server
        $('#unitsName').focus();
        focusSet = true;
    } else {
        $("#unitsName").parent().next(".validation").remove(); // remove it
    }*/
	
	if (!$('#status').val()) 
	{
        if ($("#status").parent().next(".validation").length == 0) // only add if not added
        {
            $("#status").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select Status!</div>");
        }
		if (!focusSet) {
            $("#status").focus();
        }
    } else {
        $("#status").parent().next(".validation").remove(); // remove it
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
    }
});

$('#buttonTab2Next').click(function() 
{
    var focusSet = false;
    if (!$('#questionText').val()) {
        if ($("#questionText").parent().next(".validation").length == 0) // only add if not added
        {
            $("#questionText").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter Question specification</div>");
        }
        e.preventDefault(); // prevent form from POST to server
        $('#questionText').focus();
        focusSet = true;
    } else {
        $("#questionText").parent().next(".validation").remove(); // remove it
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
    }
});

$('#buttonTab3Next').click(function() 
{
    var focusSet = false;
    if (!$('#numberOptions').val()) {
        if ($("#numberOptions").parent().next(".validation").length == 0) // only add if not added
        {
            $("#numberOptions").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter number of answer options!</div>");
        }
        e.preventDefault(); // prevent form from POST to server
        $('#numberOptions').focus();
        focusSet = true;
    } else {
        $("#numberOptions").parent().next(".validation").remove(); // remove it
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
    }
});

</script>

<script>
//for adding/removing options 
 $(document).ready(function(){
  $("#addQuestion1").click(function()
  {
    $("#dvAnsOp1").show(); 
    $("#dvAnsOp1_1").show(); 
    $("#addQuestion1").hide();
    $("#removeQuestion1").show(); 
	
	var answer_option_type = $('input[name="answerOptions"]:checked').val();
	if(String(answer_option_type) === String("1"))
	{
		$("#divAnswerText1").hide();
		$("#divAnswerIcon1").show(); 
		$("#divAnswerPic1").hide();
		
		$("#divAnswerText1_1").hide();
		$("#divAnswerIcon1_1").show(); 
		$("#divAnswerPic1_1").hide();
	}
	else if(String(answer_option_type) === String("2"))
	{
		$("#divAnswerText1").show();
		$("#divAnswerIcon1").hide();
		$("#divAnswerPic1").hide();
		
		$("#divAnswerText1_1").show();
		$("#divAnswerIcon1_1").hide();
		$("#divAnswerPic1_1").hide();
	}
	else if(String(answer_option_type) === String("3"))
	{
		$("#divAnswerText1").show();
		$("#divAnswerIcon1").show();
		$("#divAnswerPic1").hide();
		
		$("#divAnswerText1_1").show();
		$("#divAnswerIcon1_1").show();
		$("#divAnswerPic1_1").hide();
	}
	else if(String(answer_option_type) === String("4"))
	{
		$("#divAnswerText1").hide();
		$("#divAnswerIcon1").hide();
		$("#divAnswerPic1").show();
		
		$("#divAnswerText1_1").hide();
		$("#divAnswerIcon1_1").hide();
		$("#divAnswerPic1_1").show();
	}
	else if(String(answer_option_type) === String("5"))
	{
		$("#divAnswerText1").show();
		$("#divAnswerIcon1").hide();
		$("#divAnswerPic1").show();
		
		$("#divAnswerText1_1").show();
		$("#divAnswerIcon1_1").hide();
		$("#divAnswerPic1_1").show();
	}
  });
  $("#removeQuestion1").click(function(){
    $("#dvAnsOp1").hide();
    $("#dvAnsOp1_1").hide();
    $("#addQuestion1").show();
    $("#removeQuestion1").hide();
  });
  
  
  $("#addQuestion2").click(function(){
    $("#dvAnsOp2").show(); 
    $("#dvAnsOp2_1").show(); 
    $("#addQuestion2").hide();
    $("#removeQuestion2").show();
	
	var answer_option_type = $('input[name="answerOptions"]:checked').val();
	if(String(answer_option_type) === String("1"))
	{
		$("#divAnswerText2").hide();
		$("#divAnswerIcon2").show(); 
		$("#divAnswerPic2").hide();
		
		$("#divAnswerText2_1").hide();
		$("#divAnswerIcon2_1").show(); 
		$("#divAnswerPic2_1").hide();
	}
	else if(String(answer_option_type) === String("2"))
	{
		$("#divAnswerText2").show();
		$("#divAnswerIcon2").hide();
		$("#divAnswerPic2").hide();
		
		$("#divAnswerText2_1").show();
		$("#divAnswerIcon2_1").hide();
		$("#divAnswerPic2_1").hide();
	}
	else if(String(answer_option_type) === String("3"))
	{
		$("#divAnswerText2").show();
		$("#divAnswerIcon2").show();
		$("#divAnswerPic2").hide();
		
		$("#divAnswerText2_1").show();
		$("#divAnswerIcon2_1").show();
		$("#divAnswerPic2_1").hide();
	}
	else if(String(answer_option_type) === String("4"))
	{
		$("#divAnswerText2").hide();
		$("#divAnswerIcon2").hide();
		$("#divAnswerPic2").show();
		
		$("#divAnswerText2_1").hide();
		$("#divAnswerIcon2_1").hide();
		$("#divAnswerPic2_1").show();
	}
	else if(String(answer_option_type) === String("5"))
	{
		$("#divAnswerText2").show();
		$("#divAnswerIcon2").hide();
		$("#divAnswerPic2").show();
		
		$("#divAnswerText2_1").show();
		$("#divAnswerIcon2_1").hide();
		$("#divAnswerPic2_1").show();
	}
	
  });
  $("#removeQuestion2").click(function(){
    $("#dvAnsOp2").hide();
    $("#dvAnsOp2_1").hide();
    $("#addQuestion2").show();
    $("#removeQuestion2").hide();
  });
  
  $("#addQuestion3").click(function(){
    $("#dvAnsOp3").show(); 
    $("#dvAnsOp3_1").show(); 
    $("#addQuestion3").hide();
    $("#removeQuestion3").show();
	
	var answer_option_type = $('input[name="answerOptions"]:checked').val();
	if(String(answer_option_type) === String("1"))
	{
		$("#divAnswerText3").hide();
		$("#divAnswerIcon3").show(); 
		$("#divAnswerPic3").hide();
		
		$("#divAnswerText3_1").hide();
		$("#divAnswerIcon3_1").show(); 
		$("#divAnswerPic3_1").hide();
	}
	else if(String(answer_option_type) === String("2"))
	{
		$("#divAnswerText3").show();
		$("#divAnswerIcon3").hide();
		$("#divAnswerPic3").hide();
		
		$("#divAnswerText3_1").show();
		$("#divAnswerIcon3_1").hide();
		$("#divAnswerPic3_1").hide();
	}
	else if(String(answer_option_type) === String("3"))
	{
		$("#divAnswerText3").show();
		$("#divAnswerIcon3").show();
		$("#divAnswerPic3").hide();
		
		$("#divAnswerText3_1").show();
		$("#divAnswerIcon3_1").show();
		$("#divAnswerPic3_1").hide();
	}
	else if(String(answer_option_type) === String("4"))
	{
		$("#divAnswerText3").hide();
		$("#divAnswerIcon3").hide();
		$("#divAnswerPic3").show();
		
		$("#divAnswerText3_1").hide();
		$("#divAnswerIcon3_1").hide();
		$("#divAnswerPic3_1").show();
	}
	else if(String(answer_option_type) === String("5"))
	{
		$("#divAnswerText3").show();
		$("#divAnswerIcon3").hide();
		$("#divAnswerPic3").show();
		
		$("#divAnswerText3_1").show();
		$("#divAnswerIcon3_1").hide();
		$("#divAnswerPic3_1").show();
	}
  });
  $("#removeQuestion3").click(function(){
    $("#dvAnsOp3").hide();
    $("#dvAnsOp3_1").hide();
    $("#addQuestion3").show();
    $("#removeQuestion3").hide();
  });
  
  $("#addQuestion4").click(function(){
    $("#dvAnsOp4").show(); 
    $("#dvAnsOp4_1").show(); 
    $("#addQuestion4").hide();
    $("#removeQuestion4").show();
	
	var answer_option_type = $('input[name="answerOptions"]:checked').val();
	if(String(answer_option_type) === String("1"))
	{
		$("#divAnswerText4").hide();
		$("#divAnswerIcon4").show(); 
		$("#divAnswerPic4").hide();
		
		$("#divAnswerText4_1").hide();
		$("#divAnswerIcon4_1").show(); 
		$("#divAnswerPic4_1").hide();
	}
	else if(String(answer_option_type) === String("2"))
	{
		$("#divAnswerText4").show();
		$("#divAnswerIcon4").hide();
		$("#divAnswerPic4").hide();
		
		$("#divAnswerText4_1").show();
		$("#divAnswerIcon4_1").hide();
		$("#divAnswerPic4_1").hide();
	}
	else if(String(answer_option_type) === String("3"))
	{
		$("#divAnswerText4").show();
		$("#divAnswerIcon4").show();
		$("#divAnswerPic4").hide();
		
		$("#divAnswerText4_1").show();
		$("#divAnswerIcon4_1").show();
		$("#divAnswerPic4_1").hide();
	}
	else if(String(answer_option_type) === String("4"))
	{
		$("#divAnswerText4").hide();
		$("#divAnswerIcon4").hide();
		$("#divAnswerPic4").show();
		
		$("#divAnswerText4_1").hide();
		$("#divAnswerIcon4_1").hide();
		$("#divAnswerPic4_1").show();
	}
	else if(String(answer_option_type) === String("5"))
	{
		$("#divAnswerText4").show();
		$("#divAnswerIcon4").hide();
		$("#divAnswerPic4").show();
		
		$("#divAnswerText4_1").show();
		$("#divAnswerIcon4_1").hide();
		$("#divAnswerPic4_1").show();
	}
  });
  $("#removeQuestion4").click(function(){
    $("#dvAnsOp4").hide();
    $("#dvAnsOp4_1").hide();
    $("#addQuestion4").show();
    $("#removeQuestion4").hide();
  });
  
  $("#addQuestion5").click(function(){
    $("#dvAnsOp5").show(); 
    $("#dvAnsOp5_1").show(); 
    $("#addQuestion5").hide();
    $("#removeQuestion5").show();
	
	var answer_option_type = $('input[name="answerOptions"]:checked').val();
	if(String(answer_option_type) === String("1"))
	{
		$("#divAnswerText5").hide();
		$("#divAnswerIcon5").show(); 
		$("#divAnswerPic5").hide();
		
		$("#divAnswerText5_1").hide();
		$("#divAnswerIcon5_1").show(); 
		$("#divAnswerPic5_1").hide();
	}
	else if(String(answer_option_type) === String("2"))
	{
		$("#divAnswerText5").show();
		$("#divAnswerIcon5").hide();
		$("#divAnswerPic5").hide();
		
		$("#divAnswerText5_1").show();
		$("#divAnswerIcon5_1").hide();
		$("#divAnswerPic5_1").hide();
	}
	else if(String(answer_option_type) === String("3"))
	{
		$("#divAnswerText5").show();
		$("#divAnswerIcon5").show();
		$("#divAnswerPic5").hide();
		
		$("#divAnswerText5_1").show();
		$("#divAnswerIcon5_1").show();
		$("#divAnswerPic5_1").hide();
	}
	else if(String(answer_option_type) === String("4"))
	{
		$("#divAnswerText5").hide();
		$("#divAnswerIcon5").hide();
		$("#divAnswerPic5").show();
		
		$("#divAnswerText5_1").hide();
		$("#divAnswerIcon5_1").hide();
		$("#divAnswerPic5_1").show();
	}
	else if(String(answer_option_type) === String("5"))
	{
		$("#divAnswerText5").show();
		$("#divAnswerIcon5").hide();
		$("#divAnswerPic5").show();
		
		$("#divAnswerText5_1").show();
		$("#divAnswerIcon5_1").hide();
		$("#divAnswerPic5_1").show();
	}
  });
  $("#removeQuestion5").click(function(){
    $("#dvAnsOp5").hide();
    $("#dvAnsOp5_1").hide();
    $("#addQuestion5").show();
    $("#removeQuestion5").hide();
  });
  
});

</script>

<script>
//for image preview
   var loadFileQuestionPic = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputQuestionPic');
      var output1 = document.getElementById('outputQuestionPic1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputQuestionPic").show();
	  $("#outputQuestionPic1").show();
	  $("#reset_que_pic").show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  var loadFileAnswerIcon1 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputAnswerIcon1');
      var output1 = document.getElementById('outputAnswerIcon1_1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputAnswerIcon1").show();
	  $("#outputAnswerIcon1_1").show();
	  $("#reset_ans1_icon").show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  var loadFileAnswerPic1 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputAnswerPic1');
      var output1 = document.getElementById('outputAnswerPic1_1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputAnswerPic1").show();
	  $("#outputAnswerPic1_1").show();
	  $("#reset_ans1_pic").show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  
  var loadFileAnswerIcon2 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputAnswerIcon2');
      var output1 = document.getElementById('outputAnswerIcon2_1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputAnswerIcon2").show();
	  $("#outputAnswerIcon2_1").show();
	  $("#reset_ans2_icon").show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  var loadFileAnswerPic2 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputAnswerPic2');
      var output1 = document.getElementById('outputAnswerPic2_1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputAnswerPic2").show();
	  $("#outputAnswerPic2_1").show();
	  $(reset_ans2_pic).show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  
  
  var loadFileAnswerIcon3 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputAnswerIcon3');
      var output1 = document.getElementById('outputAnswerIcon3_1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputAnswerIcon3").show();
	  $("#outputAnswerIcon3_1").show();
	  $("#reset_ans3_icon").show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  
  var loadFileAnswerPic3 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputAnswerPic3');
      var output1 = document.getElementById('outputAnswerPic3_1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputAnswerPic3").show();
	  $("#outputAnswerPic3_1").show();
	  $(reset_ans3_pic).show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  
  var loadFileAnswerIcon4 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputAnswerIcon4');
      var output1 = document.getElementById('outputAnswerIcon4_1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputAnswerIcon4").show();
	  $("#outputAnswerIcon4_1").show();
	  $("#reset_ans4_icon").show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  var loadFileAnswerPic4 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputAnswerPic4');
      var output1 = document.getElementById('outputAnswerPic4_1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputAnswerPic4").show();
	  $("#outputAnswerPic4_1").show();
	  $("#reset_ans4_pic").show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  
  var loadFileAnswerIcon5 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputAnswerIcon5');
      var output1 = document.getElementById('outputAnswerIcon5_1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputAnswerIcon5").show();
	  $("#outputAnswerIcon5_1").show();
	  $("#reset_ans5_icon").show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  var loadFileAnswerPic5 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputAnswerPic5');
      var output1 = document.getElementById('outputAnswerPic5_1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputAnswerPic5").show();
	  $("#outputAnswerPic5_1").show();
	  $("#reset_ans5_pic").show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  
  var loadFileSolutionImage = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputSolutionImage');
      var output1 = document.getElementById('outputSolutionImage1');
      output.src = reader.result;
      output1.src = reader.result;
	  $("#outputSolutionImage").show();
	  $("#outputSolutionImage1").show();
	  $("#reset_sol_pic").show();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
	
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
<?php
}
?>
