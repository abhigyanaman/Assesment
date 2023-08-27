<?php
session_start();
if(!isset($_SESSION['userId']) || !isset($_SESSION['userType']))
{
header("Location: ../../login.html");
}
	echo "<section class='sidebar'>";
?>
      
	  
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="../../index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>           
          </a>         
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
		
      		<li class="treeview active">
                <a href="#">
                  <i class="fa fa-files-o"></i>
                  <span>Questions Paper</span>
      			       <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
              <ul class="treeview-menu">
                <li><a href="add_question_set.php"><i class="fa fa-circle-o"></i> Add Question Paper</a></li>
                <li><a href="view_question_set.php"><i class="fa fa-circle-o"></i> View Questions Paper</a></li>
              </ul>
          </li>
		
		    <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Study Material</span>
			       <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../study_material/add_study_material.php"><i class="fa fa-circle-o"></i> Add Study Material</a></li>
            <li><a href="../study_material/view_study_material.php"><i class="fa fa-circle-o"></i> View Study Materials</a></li>
          </ul>
        </li> -->
       
      </ul>
<?php
echo '</section>';
?>