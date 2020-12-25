<?php require_once('header.php'); ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
 <?php require_once('sidemenu.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		 <div class="col-md-3"> </div>
          <div class="col-sm-6">
            <h1></h1>
          </div>
		   <div class="col-md-3"> </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
		  <div class="col-md-3"> </div>
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
			  <?php  if($type=="add"){?>
                <h3 class="card-title">Add Student</h3>
				
				<?php }elseif($type=="edit"){?>
				
				<h3 class="card-title">Edit Student</h3>
				
				<?php }?>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
              <form action="<?php echo base_url()?>admin/studentModify/<?php echo $type.'/'.$id;?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name of the Student:</label>
                    <input type="text" class="form-control" name="student_name" required value="<?php echo isset($studentList->student_name)?$studentList->student_name:'';?>" placeholder="Enter Full name opf the student here">
                  </div>
				  <?php 
				  
				  $class = array(
								'1'=>1,
								'2'=>2,
								'3'=>3,
								'4'=>4,
								'5'=>5,
								'6'=>6,
									);
				  $subject = array(
								'1'=>'Hindi',
								'2'=>'English',
								'3'=>'Match',
								'4'=>'Science'
									);
				  
				  
				  ?>
				  
				  
				  <div class="form-group">
                  <label>Student Details:</label>
                  <select class="form-control" required name="student_class" style="width: 100%;">
                    <option value="">Select Class</option>
                    <?php foreach($class as $key=>$classData) {?>
					  <option value="<?php echo $key;?>"  <?php if(isset($studentList->student_class)){ if($key==$studentList->student_class){ echo 'selected';} }?>><?php echo $classData;?></option>
					<?php } ?>
                  </select>
                </div>
				<div class="form-group">
                  <select class="form-control" required name="student_course" style="width: 100%;">
                    <option value="">Select Course</option>
                    <?php
                    foreach ($student_course as $value) { ?>
                       <option value="<?php echo $value->course_id ?>" <?php if(isset($studentList->student_course)){ if($value->course_id==$studentList->student_course){ echo 'selected';} }?>><?php echo $value->course_name;?></option>
                   
                   <?php } ?>
               
                  </select>
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email & Mobile Number:</label>
                    <input type="email" class="form-control" required name="student_email" value="<?php echo isset($studentList->student_email)?$studentList->student_email:'';?>" placeholder="Enter email ID of the student here">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" required name="student_mobile_no" value="<?php echo isset($studentList->student_mobile_no)?$studentList->student_mobile_no:'';?>" placeholder="Enter Number of the student here">
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputFile">Upload Profile</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="student_profile" class="custom-file-input" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
					  
                    </div>
                  </div>
                  <div class="form-group">
                    <?php if(isset($studentList->student_profile)){ ?>
						<img src="<?php echo base_url().''.$studentList->student_profile;?>" width="63px" height="71px" >
						<?php } ?>
                  </div>
				  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password<?php  if($type=="edit"){?>(If you want change fill this)<?php }?></label>
                    <input type="password" class="form-control" name="student_password" placeholder="Password">
                  </div>
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
         </div>

          </div>
		   <div class="col-md-3"> </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php require_once('footer.php'); ?>
</body>
</html>
