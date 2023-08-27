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
  <!-- DataTables -->
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
        Create New Question Paper
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Questions Paper</a></li>
        <li class="active">Create New Question Paper</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create New Question Paper</h3>
            </div>
			
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
				  <li class="active"><a href="#basicInfo" data-toggle="tab">Basic Info</a></li>
				  <li><a href="#questionsList" data-toggle="tab">Questions List</a></li>
				</ul>
		
			<form role="form" class="form-horizontal" action="add_question_logic.php" method="POST" autocomplete="off" enctype="multipart/form-data">
		
				<div class="tab-content" style="padding: 40px;">
				  <!-- Basic Info -->
				  <div class="tab-pane active" id="basicInfo">
				  
					<div class="form-group">
					  <label for="quesSetName" class="col-sm-2 control-label">Ques Paper Name:</label>
					  <div class="col-sm-10">
					  <input type="text" class="form-control" name="quesSetName" id="quesSetName" placeholder="Question set name" value="<?php echo $quesSetName; ?>" required>
					  </div>
					</div>
					
					<div class="form-group">
					  <label for="gradeName" class="col-sm-2 control-label">Program name:</label>
					  <div class="col-sm-10">
					  <select class="form-control select2" name="gradeName" id="gradeName" style="width: 100%;" required>
					  <!--onchange="showUser(this.value)"-->
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
					  <label for="subjectName" class="col-sm-2 control-label">Course name:</label>
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
					
					<!-- <div class="form-group">
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
					   <a id="buttonView" class="btn btn-primary">Next</a>
				  </div>
				  <!-- Question List -->
				  <div class="tab-pane" id="questionsList">
					   <div id="txtTable"><b>Questions will be listed here...</b></div>
					<a class="btn btn-primary btnPrevious" >Previous</a>

				  </div>
				</div>
			
			<!-- /.box-body -->
			</form>
			
			</div>
			
			</div>
        <!--/.col (left) -->
        <!-- right column -->
		
        
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!--<div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div> -->
    <strong>Copyright &copy; Jhamobi Technologies Pvt. Ltd. 2022-2023 </strong> All rights reserved.
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
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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
/*
$('#buttonView').click(function() 
{
    var val1 = $('#quesSetName').val();
    var val2 = $('#gradeName').val();
    var val3 = $('#subjectName').val();
    var val4 = $('#chapterName').val();
    var val5 = $('#unitsName').val();
    var val6 = $('#status').val();
 
    $.ajax({
        type: 'POST',
        url: 'get_questions_list.php',
        data: { text1: val1, text2: val2, text3: val3, text4: val4, text5: val5, text6: val6 },
        success: function(response) {
			$('#txtTable').html(response);
        }
    });
	$('.nav-tabs > .active').next('li').find('a').trigger('click');
});
*/


$('#buttonView').click(function() 
{
    var focusSet = false;
	
	if (!$('#quesSetName').val()) {
        if ($("#quesSetName").parent().next(".validation").length == 0)
        {
            $("#quesSetName").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter number question set name!</div>");
        }
        e.preventDefault();
        $('#quesSetName').focus();
        focusSet = true;
    } else {
        $("#quesSetName").parent().next(".validation").remove();
    }
	
	
    if (!$('#gradeName').val()) {
        if ($("#gradeName").parent().next(".validation").length == 0)
        {
            $("#gradeName").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select Grade!</div>");
        }
        e.preventDefault();
        $('#gradeName').focus();
        focusSet = true;
    } else {
        $("#gradeName").parent().next(".validation").remove();
    }
	
	if (!$('#subjectName').val()) {
        if ($("#subjectName").parent().next(".validation").length == 0)
        {
            $("#subjectName").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select Subject!</div>");
        }
        e.preventDefault();
        $('#subjectName').focus();
        focusSet = true;
    } else {
        $("#subjectName").parent().next(".validation").remove();
    }
	
	/*if (!$('#chapterName').val()) {
        if ($("#chapterName").parent().next(".validation").length == 0)
        {
            $("#chapterName").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select Chapter!</div>");
        }
        e.preventDefault(); 
        $('#chapterName').focus();
        focusSet = true;
    } else {
        $("#chapterName").parent().next(".validation").remove(); 
    }
	
	if (!$('#unitsName').val()) {
        if ($("#unitsName").parent().next(".validation").length == 0) 
        {
            $("#unitsName").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select Unit!</div>");
        }
        e.preventDefault(); 
        $('#unitsName').focus();
        focusSet = true;
    } else {
        $("#unitsName").parent().next(".validation").remove();
    }*/
	
	if (!$('#status').val()) 
	{
        if ($("#status").parent().next(".validation").length == 0)
        {
            $("#status").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please select Status!</div>");
        }
		if (!focusSet) {
            $("#status").focus();
        }
    } else {
        $("#status").parent().next(".validation").remove();
		
		var val1 = $('#quesSetName').val();
		var val2 = $('#gradeName').val();
		var val3 = $('#subjectName').val();
		var val4 = $('#chapterName').val();
		var val5 = $('#unitsName').val();
		var val6 = $('#status').val();
	 
		$.ajax({
			type: 'POST',
			url: 'get_questions_list.php',
			data: { text1: val1, text2: val2, text3: val3, text4: val4, text5: val5, text6: val6 },
			success: function(response) {
				$('#txtTable').html(response);
			}
		});
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
    }
	
});


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