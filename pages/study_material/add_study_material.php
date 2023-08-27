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
	$root = $_SERVER['DOCUMENT_ROOT'];
	$path1 = "$root"."/backend/yofundowebapp/studymaterial/";
	$upload_url1 = "http://"."34.229.183.41/backend/yofundowebapp/studymaterial/";

	if(isset($_POST['submit']))//for add study material
	{
		$gradeId=$_POST['gradeName'];
		$subjectId=$_POST['subjectName'];
		$chapterId=$_POST['chapterName'];
		$unitsId=$_POST['unitsName'];
		
		$res1=mysqli_query($conn,"select * from `grade` where `gradeId`='$gradeId'");
		while($r1=mysqli_fetch_array($res1))
		{	
			$gradeName=$r1['gradeName'];
			$gradeRoman=$r1['gradeRoman'];
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
		
		$studyName=$_POST['studyName'];
		$studyDescription=$_POST['studyDescription'];
		$documentType=$_POST['documentType'];
		
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$addedOn=$date;
		$addedBy=$_SESSION['userType'];
		
		$result1=mysqli_query($conn,"INSERT INTO study_material (`studyMatName`,`studyMatDesc`, `gradeId`, `grade`, `subjectId`, `subject`, `topicId`, `topicOrUnit`, `chapterId`, `chapter`, `addedOn`, `addedBy`, `status`) VALUES ('$studyName', '$studyDescription', '$gradeId', '$gradeName', '$subjectId', '$subjectName', '$unitsId', '$unitsName', '$chapterId', '$chapterName', '$addedOn', '$addedBy', '$status')");
		if($result1)
		{
			$studyMatId=mysqli_insert_id($conn);
			
			$dir = "XII/math/".$chapterName."/studyMatId_".$studyMatId;
			chdir ("../../studymaterial");
			if (!is_dir($dir)) 
			{
				mkdir($dir, 0777, true);	
				if( is_dir($dir))
				{
					$path1 = "$root"."/backend/yofundowebapp/studymaterial/"."$dir"."/";
					$upload_url1 = "http://"."34.229.183.41/backend/yofundowebapp/studymaterial/"."$dir"."/";
					
					if($documentType=="1")//pdf
					{
						if(isset($_FILES['myPdf']))
						{
							$size=$_FILES['myPdf']['size'];
							//getting file info from the request 
							$fileinfo1 = pathinfo($_FILES['myPdf']['name']);
							$extension1 = $fileinfo1['extension'];
							$filename1 = $fileinfo1['filename'];
							$f1=$filename1;
							$filename1="doc";
							$file_path1 = $path1 . $filename1 . '.'. $extension1; //file path to upload in the server 
							$result1 = move_uploaded_file($_FILES['myPdf']['tmp_name'],$file_path1);
							if($f1!= '')
							{
								$study_url = $upload_url1 . $filename1 . '.' . $extension1;
								$flag++;
							}
							else
							{
								$study_url = '';
							}
						}
					}
					else if($documentType=="2")//video
					{
						if(isset($_FILES['video']))
						{
							$size=$_FILES['video']['size'];
							//getting file info from the request 
							$fileinfo1 = pathinfo($_FILES['video']['name']);
							$extension1 = $fileinfo1['extension'];
							$filename1 = $fileinfo1['filename'];
							$f1=$filename1;
							$filename1="doc";
							$file_path1 = $path1 . $filename1 . '.'. $extension1; //file path to upload in the server 
							$result1 = move_uploaded_file($_FILES['video']['tmp_name'],$file_path1);
							if($f1!= '')
							{
								$study_url = $upload_url1 . $filename1 . '.' . $extension1;
								$flag++;
							}
							else
							{
								$study_url = '';
							}
						}
					}
					
					

					$result6=mysqli_query($conn,"UPDATE `study_material` SET `fileSize`='$size', `fileName`='$study_url', `fileType`='$documentType' WHERE `studyMatId`='$studyMatId'");
					if(mysqli_affected_rows($conn) > 0)
					{
						echo "<script type='text/javascript'>
							window.location.href='http://34.229.183.41/backend/yofundowebapp/pages/study_material/view_study_material.php';
							alert('Study material added successfully!')
							</script>";
					}
					else
					{
						echo "<script type='text/javascript'>alert('cannot upload document!')</script>";
					}
				}
				else
				{
					echo "<script type='text/javascript'>alert('directory not exists!')</script>";
				}
			}
			else
			{
				echo "<script type='text/javascript'>alert('cannot create directory!')</script>";
			}
		}
		else
		{
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>


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
	  
	<h4 style="color:white; text-align:center;" class="col-sm-10 control-label">American International School of Johannesburg</h4>

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
        Study Maetrial
        <!--<small>Question</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Study Maetrial</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	  
		<div class="col-xs-12">
		<div class="box-header with-border">
              <h3 class="box-title">Add Study Maetrial</h3>
            </div>
			
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#basicInfo" data-toggle="tab">Basic Info</a></li>
              <li><a href="#studyMaterial" data-toggle="tab">Study Material</a></li>
            </ul>
			<form role="form" class="form-horizontal" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
			<div class="tab-content" style="padding: 40px;">
              <!-- Basic Info -->
              <div class="tab-pane active" id="basicInfo">
				<div class="form-group">
                  <label for="gradeName" class="col-sm-2 control-label">Grade name:</label>
				  <div class="col-sm-10">
				  <select class="form-control select2" name="gradeName" id="gradeName" style="width: 100%;" required>
                  <option selected="selected" disabled>--Select--</option>
                  <?php 
					$result=mysqli_query($conn,'select * from grade');
					while($row=mysqli_fetch_assoc($result)) 
					{ 
						echo "<option value='$row[gradeId]'>$row[gradeName]</option>"; 
					} 
				  ?>
				  </select>
				  
				  </div>
                </div>

				<div class="form-group">
                  <label for="subjectName" class="col-sm-2 control-label">Subject name:</label>
				  <div class="col-sm-10">
				  <select class="form-control select2" name="subjectName" id="subjectName" style="width: 100%;" required>
                  <option selected="selected" disabled>--Select--</option>
                  <?php 
					$result=mysqli_query($conn,'SELECT * FROM subject');
					while($row=mysqli_fetch_assoc($result)) 
					{ 
						echo "<option value='$row[subjectId]'>$row[subjectName]</option>"; 
					} 
				  ?>
				  </select>				  
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="chapterName" class="col-sm-2 control-label">Chapter Name:</label>
				  <div class="col-sm-10">
				  <select class="form-control select2" name="chapterName" id="chapterName" style="width: 100%;" required>
                  <option selected="selected" disabled>--Select--</option>
                  <?php 
					$result=mysqli_query($conn,'SELECT * FROM chapter');
					while($row=mysqli_fetch_assoc($result)) 
					{ 
						echo "<option value='$row[chapterId]'>$row[chapterName]</option>"; 
					} 
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
					$result=mysqli_query($conn,'SELECT * FROM subject_units');
					while($row=mysqli_fetch_assoc($result)) 
					{ 
						echo "<option value='$row[unitsId]'>$row[unitsName]</option>"; 
					} 
				  ?>
				  </select>
				  </div>
                </div>
				
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
			  
			  <!-- Study Material -->
			  <div class="tab-pane" id="studyMaterial">
				<!--Doc1-->
				<div class="form-group">
                  <label for="studyName" class="col-sm-2 control-label">Study Name:</label>
				  <div class="col-sm-10">
				  <input type="text" class="form-control" id="studyName" name="studyName" placeholder="Study name" value="<?php echo $studyName; ?>" required>
                </div>
				</div>
			
				<div class="form-group">
				  <label for="studyDescription" class="col-sm-2 control-label">Study Description:</label>
				  <div class="col-sm-10">
				  <textarea class="form-control" id="studyDescription" name="studyDescription" rows="10" cols="80" placeholder="Study description"><?php echo $studyDescription; ?></textarea>				
				  </div>
				</div>
					
				<div class="form-group">
                  <label for="documentType" class="col-sm-2 control-label">Document Type:</label>
				  <div class="col-sm-10" required>
					<select class="form-control select2" name="documentType" id="documentType" style="width: 100%;">
					  <option selected="selected" disabled>--Select--</option>
					  <option value="1">Pdf</option>
					  <option value="2">Video</option>
					</select>			  
				  </div>
                </div>
				
				<div class="form-group" id="document_pdf" style="display:none;">
                  <label for="myPdf" class="col-sm-2 control-label">Document *</label>
				  <div class="col-sm-10">
				  <input type="file" id="myPdf" name="myPdf" accept="application/pdf, application/vnd.ms-excel">
				  
				  <div id="reset_pdf" class="btn btn-primary" style="margin:10px; display:none;">Reset file</div>
				  
				  <canvas id="pdfViewer" height="25" width="25"></canvas>
                </div>
				</div>
				
				<!--Video-->
				<div class="form-group" id="document_video" style="display:none;">
                  <label for="video" class="col-sm-2 control-label">Video *</label>
				  <div class="col-sm-10">
				  <input type="file" id="video" name="video" accept="video/mp4,video/x-m4v,video/*">
				  
				  <div id="reset_video" class="btn btn-primary" style="margin:10px; display:none;">Reset file</div>
				  
                </div>
				</div>
				<a class="btn btn-primary btnPrevious" >Previous</a>
				<a id="confirm" class="btn btn-primary">Confirm</a>
				
				<div class="box-footer" align="middle">
				<input type='submit' id="submit" name='submit' style="display:none;" class="btn btn-primary" value='Add Study Material'>
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
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; Jhamobi Technologies Pvt. Ltd. </strong> All rights reserved.
  </footer>
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
//for removing  uploaded docs
$(document).ready(function() 
{
   $('#reset_pdf').on('click', function(e) {
      var $el = $('#myPdf');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#pdfViewer").hide();
	  $("#reset_pdf").hide();
   });
   $('#reset_video').on('click', function(e) {
      var $el = $('#video');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
	  $("#reset_video").hide();
   });
});


$(document).ready(function(){
  $("input").keydown(function(){
		$("#confirm").show();
		$("#submit").hide();
  });
  
  $("textarea").keydown(function(){
		$("#confirm").show();
		$("#submit").hide();
  });
});
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
$(document).ready(function(){
    $('#documentType').on('change', function() 
	{
      if ( this.value == '1')
      {
        $("#document_pdf").show();
		$("#document_video").hide();
      }
      else if ( this.value == '2')
      {
        $("#document_pdf").hide();
        $("#document_video").show();
      }
	  
		$("#confirm").show();
		$("#submit").hide();
		
    });
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
	
	if (!$('#chapterName').val()) {
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
    }
	
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

$('#confirm').click(function() 
{
	var focusSet = false;
    if (!$('#studyName').val()) {
        if ($("#studyName").parent().next(".validation").length == 0)
        {
            $("#studyName").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter study name!</div>");
        }
        e.preventDefault();
        $('#studyName').focus();
        focusSet = true;
    } else {
		$("#studyName").parent().next(".validation").remove(); // remove it
	}
	
	if (!$('#studyDescription').val()) {
        if ($("#studyDescription").parent().next(".validation").length == 0)
        {
            $("#studyDescription").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter study description!</div>");
        }
        e.preventDefault();
        $('#studyDescription').focus();
        focusSet = true;
    } else {
		$("#studyDescription").parent().next(".validation").remove(); // remove it
	}
	
	if (!$('#documentType').val()) {
        if ($("#documentType").parent().next(".validation").length == 0)
        {
            $("#documentType").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select document type!</div>");
        }
        e.preventDefault();
        $('#documentType').focus();
        focusSet = true;
    } else {
		$("#documentType").parent().next(".validation").remove(); // remove it
		
		let documentType = document.getElementById('documentType').value;
		if(String(documentType) === String("1"))
		{
			if( $('#myPdf').val() != "")
			{
				$("#confirm").hide();
				$("#submit").show();
			}
			else
			{
				alert("empty pdf file"); 
			   return false; 
			}
		}
		else if(String(documentType) === String("2"))
		{
		   if( $('#video').val() != "")
			{
				$("#confirm").hide();
				$("#submit").show();
			}
			else
			{
				alert("empty pdf file"); 
			   return false; 
			}
		}
	}
});


</script>

<script>
// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];
// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';

$("#myPdf").on("change", function(e)
{
	$("#reset_pdf").show();
	
	var file = e.target.files[0]
	if(file.type == "application/pdf"){
		var fileReader = new FileReader();  
		fileReader.onload = function() {
			var pdfData = new Uint8Array(this.result);
			// Using DocumentInitParameters object to load binary data.
			var loadingTask = pdfjsLib.getDocument({data: pdfData});
			loadingTask.promise.then(function(pdf) 
			{
			  console.log('PDF loaded');  
			  // Fetch the first page
			  var pageNumber = 1;
			  pdf.getPage(pageNumber).then(function(page) 
			  {
				console.log('Page loaded');
				
				var scale = 0.5;
				var viewport = page.getViewport({scale: scale});

				// Prepare canvas using PDF page dimensions
				var canvas = $("#pdfViewer")[0];
				var context = canvas.getContext('2d');
				canvas.height = viewport.height;
				canvas.width = viewport.width;

				// Render PDF page into canvas context
				var renderContext = {
				  canvasContext: context,
				  viewport: viewport
				};
				var renderTask = page.render(renderContext);
				renderTask.promise.then(function () {
				  console.log('Page rendered');
				});
			  });
			}, function (reason) {
			  // PDF loading error
			  console.error(reason);
			});
		};
		fileReader.readAsArrayBuffer(file);
	}
});
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