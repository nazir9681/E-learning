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
                <h3 class="card-title">Add Live Classes</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
              <form action="<?php echo base_url()?>admin/modifyClasses/addClass" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Video Class Title:</label>
                    <input type="text" class="form-control" name="title" required value="" placeholder="Enter the title of note">
                  </div>
			
				
				<div class="form-group">
				    <label for="exampleInputEmail1">Select Teacher</label>
                  <select class="form-control" required name="teacher_id" style="width: 100%;">
                    <option value="">Select Teacher</option>
                  
                 
                 
                 <?php foreach ($appointTeacher as $value) {
                      echo "<option value='".$value->teacher_id."'>".$value->teacher_name."</option>";
                    } ?>
               
                  </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload File</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="video" class="custom-file-input" runat="server" size="20" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
					  
                    </div>
                  </div>
                  
                  
                    <div class="form-group">
                    <label for="exampleInputFile">Status</label>
                  <select name="status" class="form-control required" id="status">
                      <option value="1">ACTIVE</option>
                      <option value="0">INACTIVE</option>
                  </select>
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
