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
                <h3 class="card-title">Add Course</h3>
        
        <?php }elseif($type=="edit"){?>
        
        <h3 class="card-title">Edit Course</h3>
        
        <?php }?>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
              <form action="<?php echo base_url()?>admin/courseModify/<?php echo $type.'/'.$id;?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name of the Course:</label>
                    <input type="text" class="form-control" name="course_name" required="" value="<?php echo isset($courseList->course_name)?$courseList->course_name:'';?>" placeholder="Enter Full name of the Course here">
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
				  $teacher = array(
								'1'=>'Ramesh',
								'2'=>'Suresh',
								'3'=>'Naveem',
								'4'=>'Mathur'
									);
				  
				  
				  ?>
				  
				  
				  <div class="form-group">
                  <label>Course Duration:</label>
                  <select class="form-control" required="" name="course_duration" style="width: 100%;">
                    <option value="">Duration</option>
                  <?php foreach($class as $key=>$courseData) {?>
            <option value="<?php echo $key;?>"  <?php if(isset($courseList->course_duration)){ if($key==$courseList->course_duration){ echo 'selected';} }?>><?php echo $courseData;?></option>
          <?php } ?>
                  </select>
                </div>
				<div class="form-group">
                  <select class="form-control" required="" name="appoint_teacher" style="width: 100%;">
                    <option value="">Appoint Teacher</option>
                    <?php
                    foreach ($appoint_teacher as $value) { ?>
                       <option value="<?php echo $value->teacher_id ?>" <?php if(isset($courseList->appoint_teacher)){ if($value->teacher_id==$courseList->appoint_teacher){ echo 'selected';} }?>><?php echo $value->teacher_name ?></option>
                 <?php   } ?>
               
                  </select>
                </div>
                 
				 <?php 
				  if(isset($courseList->course_type)){
						$course_type = explode(',',$courseList->course_type); 
				  }
				  ?>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Course Type :</label>
                  <br>
				  <input type="checkbox"  name="course_type[]" value="Live" <?php if(isset($courseList->course_type)){ if(in_array('Live',$course_type)){ echo 'checked';} }?>>Live
                    <input type="checkbox"  name="course_type[]" value="Recorded" <?php if(isset($courseList->course_type)){ if(in_array('Recorded',$course_type)){ echo 'checked';} }?>>Recorded
                    <input type="checkbox"  name="course_type[]" value="Documents" <?php if(isset($courseList->course_type)){ if(in_array('Documents',$course_type)){ echo 'checked';} }?>>Documents
                  
				  
				  </div>
				  <div class="form-group">
                    <label for="exampleInputFile">Upload Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="course_image" class="custom-file-input" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div> 
                    </div>
                  </div>
                  
                 <div class="form-group">
                    <?php if(isset($courseList->course_image)){ ?>
						<img src="<?php echo base_url().''.$courseList->course_image;?>" width="63px" height="71px" >
						<?php } ?>
                  </div>
                 
                 <div class="form-group">
                            <label for="exampleInputPassword1">Course Price :</label>
                  <br>
                  <div class="row">
                    <div class="col-lg-2">
                    Actual :  
                    </div>
                    <div class="col-lg-6">
                      <input type="text" class="form-control" name="course_actual_price" required value="<?php echo isset($courseList->course_actual_price)?$courseList->course_actual_price:'';?>">
                    </div>
                  </div>
                    <div class="row">
                    <div class="col-lg-2">
                    Offer :  
                    </div>
                    <div class="col-lg-6">
                      <input type="text" class="form-control" name="course_offer" required value="<?php echo isset($courseList->course_offer)?$courseList->course_offer:'';?>">
                    </div>
                  </div><div class="row">
                    <div class="col-lg-2">
                    Offer% :  
                    </div>
                    <div class="col-lg-6">
                      <input type="text" class="form-control" name="course_offer_per" required value="<?php echo isset($courseList->course_offer_per)?$courseList->course_offer_per:'';?>">
                    </div>
                  </div>
                    
                    
                    
                    
                    
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <label for="exampleInputPassword1">Start date :</label>
                   <!--<div id="datepicker" class="input-group date" name="start_date" data-date-format="mm-dd-yyyy" >-->
                        <input class="form-control" name="start_date" type="date"  value="<?php echo isset($courseList->start_date)?$courseList->start_date:'';?>" />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <!--</div>-->
                    </div>

                    

                    <div class="col-lg-6">
                      <label for="exampleInputPassword1">Number Of slots :</label>
                    <input type="text" class="form-control" name="number_slots" required value="<?php echo isset($courseList->number_slots)?$courseList->number_slots:'';?>">
                    </div>
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
