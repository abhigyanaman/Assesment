<?php
session_start();
if(!isset($_SESSION['userId']) || !isset($_SESSION['userType']))
{
header("Location: ../../login.html");
}
	echo "<section class='sidebar'>";
?>
      
	  
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Questions</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../questions/add_question.php"><i class="fa fa-circle-o"></i> Add Question</a></li>
            <li><a href="../questions/view_question.php"><i class="fa fa-circle-o"></i> View Questions</a></li>
          </ul>
        </li>
		
		<li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Questions Set</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../questions_set/add_question_set.php"><i class="fa fa-circle-o"></i> Add Question Set</a></li>
            <li><a href="../questions_set/view_question_set.php"><i class="fa fa-circle-o"></i> View Questions Set</a></li>
          </ul>
        </li>
		
		<li class="treeview active">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Study Material</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_study_material.php"><i class="fa fa-circle-o"></i> Add Study Material</a></li>
            <li><a href="view_study_material.php"><i class="fa fa-circle-o"></i> View Study Materials</a></li>
          </ul>
        </li>
       
      </ul>
<?php
echo '</section>';
?>