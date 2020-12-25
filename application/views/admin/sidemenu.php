<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!--<div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> Change Password
          </a>-->
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url()?>admin/admin_logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2" aria-hidden="true"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">SUPER TEACHER<br>
DASHBOARD</span>
    </a>
	
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-university"></i>
              <p>
               Teachers
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/teachers/" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>View All Teachers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/teacherModify/add/" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>Add Teacher</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Students
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/students/" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>View All Student</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/studentModify/add/" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>Add Student</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Courses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/courses" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>View All Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/courseModify/add/" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>Add Course</p>
                </a>
              </li>
            </ul>
            
            <!--<ul class="nav nav-treeview">-->
            <!--  <li class="nav-item">-->
            <!--    <a href="<?php echo base_url()?>admin/notes" class="nav-link">-->
            <!--      <i class="fa fa-database nav-icon"></i>-->
            <!--      <p>View All Notes</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a href="<?php echo base_url()?>admin/notesModify/add/0" class="nav-link">-->
            <!--      <i class="fa fa-database nav-icon"></i>-->
            <!--      <p>Add Notes</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--</ul>-->
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Notes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/notes" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>View All Notes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/notesModify/add/" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>Add Notes</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Live Classes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/liveClasses" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>View All Live Classes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/modifyClasses/add/" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>Add Live Classes</p>
                </a>
              </li>
            </ul>
          </li>
          
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Subjects
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/subject" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>View Subjects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/modifySubject/add/" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>Add Subjects</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Mock Test
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/mockTest" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>View Mock Test</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()?>admin/modifyMockTest/add/" class="nav-link">
                  <i class="fa fa-database nav-icon"></i>
                  <p>Add Mock Test</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url()?>admin/order" class="nav-link">
              <i class="nav-icon fa fa-database"></i>
              <p>
                Orders
              </p>
            </a>
			</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Help
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url()?>admin/offer" class="nav-link">
              <i class="nav-icon fa fa-database"></i>
              <p>
                Offers
              </p>
            </a>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url()?>admin/doubt" class="nav-link">
              <i class="nav-icon fa fa-database"></i>
              <p>
                Doubts
              </p>
            </a>
          </li>
          
          
		  
		  <!--<li class="nav-item has-treeview">-->
    <!--        <a href="#" class="nav-link">-->
    <!--          <i class="nav-icon fa fa-users"></i>-->
    <!--          <p>-->
    <!--            Sub Admin-->
    <!--            <i class="fas fa-angle-left right"></i>-->
    <!--          </p>-->
    <!--        </a>-->
    <!--        <ul class="nav nav-treeview">-->
    <!--          <li class="nav-item">-->
    <!--            <a href="<?php echo base_url()?>admin/subAdmin" class="nav-link">-->
    <!--              <i class="fa fa-database nav-icon"></i>-->
    <!--              <p>View All Sub Admin</p>-->
    <!--            </a>-->
    <!--          </li>-->
    <!--          <li class="nav-item">-->
    <!--            <a href="<?php echo base_url()?>admin/subadminModify/add/" class="nav-link">-->
    <!--              <i class="fa fa-database nav-icon"></i>-->
    <!--              <p>Add Sub Admin</p>-->
    <!--            </a>-->
    <!--          </li>-->
    <!--        </ul>-->
    <!--      </li>-->
		  
         </ul>
         
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
