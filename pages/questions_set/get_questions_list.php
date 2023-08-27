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
	
	$quesSetName = $_POST['text1'];
	$gradeId = $_POST['text2'];
	$subjectId = $_POST['text3'];
	$chapterId = $_POST['text4'];
	$unitsId = $_POST['text5'];
	$status = $_POST['text6'];
?>


		<div class="box-body table-responsive no-padding" >
		<div class="box-body">
		  <table id="example1" class="table table-bordered table-striped">
			<thead>
			<tr>
			  <th>Ques Id</th>
			  <th>Ques Text</th>
			  <th>Complexity</th>
			  <th>Grade</th>
			  <th>Subject</th>
			  <th>Chapter</th>
			  <th>Choose</th>
			</tr>
			</thead>
			<tbody>			
		<?php
		$result=mysqli_query($conn,"select * from question where status='1' AND `gradeId`='$gradeId' AND `subjectId`='$subjectId'");
		while($row=mysqli_fetch_array($result))
		{	
		$questionID=$row['questionID'];
		$questionText=$row['questionText'];
		$complexityLevel=$row['complexityLevel'];
		$gradeName=$row['gradeName'];
		$subjectName=$row['subjectName'];
		$chapterName=$row['chapterName'];
		$addedOn=$row['addedOn'];
		$addedBy=$row['addedBy'];
		$status=$row['status'];	
		echo "<tr>
			 <td >$questionID</td>
			 <td >$questionText</td>
			 <td >$complexityLevel</td>
			 <td >$gradeName</td>
			 <td >$subjectName</td>
			 <td >$chapterName</td>
			 <td>
				<input type='checkbox' class='flat-red' value='$questionID' id='quesID' name='quesID[]'>
			 </td>";
			 ?>
		<?php
		echo "</tr>";
		}
		?>
			</tbody>
		  </table>
		</div>
		</div>
		<div class="box-footer" align="middle">
						<input type='submit' id="submit" name='submit' class="btn btn-primary" value='Add Question Set'>
					</div>	

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
<?php
}
?>