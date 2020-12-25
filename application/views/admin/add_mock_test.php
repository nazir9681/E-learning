<?php require_once('header.php'); ?>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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
                <h3 class="card-title">Add Mock Test</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
              <form action="<?php echo base_url()?>admin/modifyMockTest/addMockTest" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Mock Test Name:</label>
                    <input type="text" class="form-control" name="mock_subject_name" required value="" placeholder="Enter the Name of Mock Test">
                  </div>
                  
                  	<div class="form-group">
                  	    <label for="exampleInputEmail1">Select Teacher:</label>
                  <select class="form-control" required="" name="teacher_id" style="width: 100%;">
                    <option value="">Select Teacher</option>
                    <?php
                    foreach ($appoint_teacher as $value) { ?>
                       <option value="<?php echo $value->teacher_id ?>" <?php if(isset($courseList->appoint_teacher)){ if($value->teacher_id==$courseList->appoint_teacher){ echo 'selected';} }?>><?php echo $value->teacher_name ?></option>
                 <?php   } ?>
               
                  </select>
                </div>
                
                   <div class="form-group">
                    <label for="exampleInputEmail1">Enter Marks of each question:</label>
                    <input type="text" class="form-control" name="mock_marks" required value="" placeholder="Enter Marks">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Negative Marks of each question:</label>(if required)(like -1,-2..)
                    <input type="text" class="form-control" name="mock_negative_mark" value="" placeholder="Enter Negative Marks">
                  </div>
                  
                   <div class="form-group">
                    <label for="exampleInputEmail1">Duration:</label>(in minutes)
                    <input type="number" class="form-control" name="mock_time" required value="" placeholder="Enter Duration">
                  </div>
                  
                   <div class="form-group">
                    <label for="exampleInputEmail1">Mock Test Image:</label>
                    <input type="file" class="form-control" name="mock_test_image" required value="">
                  </div>
			       
			       <!--<div class="form-group">-->
          <!--          <label for="exampleInputEmail1">Date:</label>-->
          <!--          <input type="text" class="form-control" name="mock_date" required value="" placeholder="Enter Date">-->
          <!--        </div>-->
                    
                    <div class="form-group">
                    <label for="exampleInputPassword1">Date :</label>
                   <!--<div id="datepicker" class="input-group date" name="start_date" data-date-format="mm-dd-yyyy" >-->
                        <input class="form-control" name="mock_date" required="" type="date"  value="" />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <!--</div>-->
                    </div>
                    <div class="form-group">
                          <label for="exampleInputFile">Description</label>
                         <textarea name="mock_description"></textarea>
                            <script>
                                    CKEDITOR.replace( 'mock_description' );
                            </script>
                    </div>
                  
                    <div class="form-group">
                    <label for="exampleInputFile">Status</label>
                  <select name="mock_status" class="form-control required" id="status">
                      <option value="1">ACTIVE</option>
                      <option value="0">INACTIVE</option>
                  </select>
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
