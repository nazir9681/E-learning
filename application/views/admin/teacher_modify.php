<?php //echo "<pre>"; print_r($teacherList); exit; ?>
<?php require_once('header.php'); ?>
<style type="text/css">
    #datepicker{
      width:180px;
      margin: 0 20px 20px 20px;
    }
    #datepicker > span:hover
    {
      cursor: pointer;
    }
</style>
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
                <h3 class="card-title">Add Teacher</h3>
				
				<?php }elseif($type=="edit"){?>
				
				<h3 class="card-title">Edit Teacher</h3>
				
				<?php }?>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
              <form action="<?php echo base_url()?>admin/teacherModify/<?php echo $type.'/'.$id;?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name of the Teacher:</label>
                    <input type="text" class="form-control" name="teacher_name" required value="<?php echo isset($teacherList->teacher_name)?$teacherList->teacher_name:'';?>" placeholder="Enter Full name of the teacher here">
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
				  
				  ?>
				  
				  
				  <div class="form-group">
                  <label>Teaching Details:</label>
                  <select class="form-control" required name="teacher_class" style="width: 100%;">
                    <option value="">Select Class</option>
                    <?php foreach($class as $key=>$classData) {?>
					  <option value="<?php echo $key;?>"  <?php if(isset($teacherList->teacher_class)){ if($key==$teacherList->teacher_class){ echo 'selected';} }?>><?php echo $classData;?></option>
					<?php } ?>
                  </select>
                </div>
				<div class="form-group">
                  <select class="form-control" required name="teacher_subject" style="width: 100%;">
                    <option value="">Select Subject</option>
                    <?php foreach($subject as $subjectData) {?>
                     <option value="<?php echo $subjectData->subject_id;?>" <?php if(isset($teacherList->teacher_subject)){ if($subjectData->subject_id==$teacherList->teacher_subject){ echo 'selected';} }?>><?php echo $subjectData->subject_name;?></option>
					<?php } ?>
                  </select>
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email & Mobile Number:</label>
                    <input type="email" class="form-control" required name="teacher_email" value="<?php echo isset($teacherList->teacher_email)?$teacherList->teacher_email:'';?>" placeholder="Enter email ID of the teacher here">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" required name="teacher_mobile_no" value="<?php echo isset($teacherList->teacher_mobile_no)?$teacherList->teacher_mobile_no:'';?>" placeholder="Enter Number of the teacher here">
                  </div>
				  <?php 
				  if(isset($teacherList->teacher_prefernce)){
						$teacher_prefernce = explode(',',$teacherList->teacher_prefernce); 
				  }
				  ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Prefernce of The Teacher :</label>
					<br>
                    <input type="checkbox"  name="teacher_prefernce[]" value="Live" <?php if(isset($teacherList->teacher_prefernce)){ if(in_array('Live',$teacher_prefernce)){ echo 'checked';} }?>>Live
                    <input type="checkbox"  name="teacher_prefernce[]" value="Recorded" <?php if(isset($teacherList->teacher_prefernce)){ if(in_array('Recorded',$teacher_prefernce)){ echo 'checked';} }?>>Recorded
                    <input type="checkbox"  name="teacher_prefernce[]" value="Documents" <?php if(isset($teacherList->teacher_prefernce)){ if(in_array('Documents',$teacher_prefernce)){ echo 'checked';} }?>>Documents
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Upload Profile</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="teacher_profile" class="custom-file-input" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <?php if(isset($teacherList->teacher_profile)){ ?>
						<img src="<?php echo base_url().''.$teacherList->teacher_profile;?>" width="63px" height="71px" >
						<?php } ?>
                  </div>
                  
                  <div class="row">
                      <div class="col-lg-6">
                   <div class="form-group">
                    <label for="exampleInputPassword1">Class Start Time</label>
                        <input class="form-control" name="class_start_time" required="" type="time"  value="<?php echo isset($teacherList->class_start_time)?$teacherList->class_start_time:'';?>" />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <!--</div>-->
                    </div>
                      </div>
                      <div class="col-lg-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Class End Time</label>
                        <input class="form-control" name="class_end_time" required="" type="time"  value="<?php echo isset($teacherList->class_end_time)?$teacherList->class_end_time:'';?>" />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <!--</div>-->
                    </div>
                      </div>
                  </div>
                  
                  
                  <!--<div class="form-group">-->
                  <!--  <label for="exampleInputPassword1">Duration</label>(in days)-->
                  <!--  <input type="text" class="form-control" name="duration" value="<?php //echo isset($teacherList->duration)?$teacherList->duration:'';?>" placeholder="Enter Duration">-->
                  <!--</div>-->
                  
                  <div class="row">
                      <div class="col-lg-4">
                           <div class="form-group">
                            <label for="exampleInputFile">Duration Year</label>
                          <select name="duration_year" class="form-control " id="status">
                              <option value="" >--no select--</option>
                              <option value="1" <?php if(isset($teacherList->duration_year)){if($teacherList->duration_year == '1'){ echo 'selected';}} ?>>1 Year</option>
                              <option value="2" <?php if(isset($teacherList->duration_year)){if($teacherList->duration_year == '2'){ echo 'selected';}} ?>>2 Years</option>
                              <option value="3" <?php if(isset($teacherList->duration_year)){if($teacherList->duration_year == '3'){ echo 'selected';}} ?>>3 Years</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="form-group">
                            <label for="exampleInputFile">Duration Month</label>
                              <select name="duration_month" class="form-control" id="status">
                                  <option value="" >--no select--</option>
                                  <option value="1" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '1'){ echo 'selected';}} ?>>1 Month</option>
                                  <option value="2" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '2'){ echo 'selected';}} ?>>2 Months</option>
                                  <option value="3" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '3'){ echo 'selected';}} ?>>3 Months</option>
                                  <option value="4" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '4'){ echo 'selected';}} ?>>4 Months</option>
                                  <option value="5" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '5'){ echo 'selected';}} ?>>5 Months</option>
                                  <option value="6" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '6'){ echo 'selected';}} ?>>6 Months</option>
                                  <option value="7" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '7'){ echo 'selected';}} ?>>7 Months</option>
                                  <option value="8" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '8'){ echo 'selected';}} ?>>8 Months</option>
                                  <option value="9" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '9'){ echo 'selected';}} ?>>9 Months</option>
                                  <option value="10" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '10'){ echo 'selected';}} ?>>10 Months</option>
                                  <option value="11" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '11'){ echo 'selected';}} ?>>11 Months</option>
                                  <option value="12" <?php if(isset($teacherList->duration_month)){if($teacherList->duration_month == '12'){ echo 'selected';}} ?>>12 Months</option>
                              </select>
                            </div>
                      </div>
                      <div class="col-lg-4">
                            <div class="form-group">
                            <label for="exampleInputFile">Duration Days</label>
                          <select name="duration" class="form-control" id="status">
                              <option value="" >--no select--</option>
                              <option value="20" <?php if(isset($teacherList->duration)){if($teacherList->duration == '20'){ echo 'selected';}} ?>>20 Days</option>
                              <option value="25" <?php if(isset($teacherList->duration)){if($teacherList->duration == '25'){ echo 'selected';}} ?>>25 Days</option>
                              <option value="30" <?php if(isset($teacherList->duration)){if($teacherList->duration == '30'){ echo 'selected';}} ?>>30 Days</option>
                          </select>
                        </div>
                      </div>
                  </div>
                  
                  <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Original Price</label>
                            <input type="text" class="form-control" name="price" value="<?php echo isset($teacherList->price)?$teacherList->price:'';?>" placeholder="Enter Original Price">
                        </div>  
                      </div>
                      <div class="col-lg-6">
                         <div class="form-group">
                            <label for="exampleInputPassword1">Discount Price</label>
                            <input type="text" class="form-control" name="discount_price" value="<?php echo isset($teacherList->discount_price)?$teacherList->discount_price:'';?>" placeholder="Enter Discount Price">
                        </div>
                      </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password<?php  if($type=="edit"){?>(If you want change fill this)<?php }?></label>
                    <input type="password" class="form-control" name="teacher_password" placeholder="Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
