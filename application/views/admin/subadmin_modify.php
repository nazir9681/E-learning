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
                <h3 class="card-title">Add Sub Admin</h3>
				
				<?php }elseif($type=="edit"){?>
				
				<h3 class="card-title">Edit Sub Admin</h3>
				
				<?php }?>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
              <form action="<?php echo base_url()?>admin/subadminModify/<?php echo $type.'/'.$id;?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Name:</label>
                    <input type="text" class="form-control" name="admin_user_name" required value="<?php echo isset($adminData->admin_user_name)?$adminData->admin_user_name:'';?>" placeholder="Enter user name">
                  </div>
				  <?php 
				  
				  $role = array(
								'Manager'=>'Manager',
								'Employ'=>'Employ',
								'Subadmin'=>'Subadmin',
									);
				  
				  
				  ?>
				  
				  
				  <div class="form-group">
                  <label>Roles:</label>
                  <select class="form-control" required name="admin_role" style="width: 100%;">
                    <option value="">Select Role</option>
                    <?php foreach($role as $key=>$roleData) {?>
					  <option value="<?php echo $key;?>"  <?php if(isset($adminData->admin_role)){ if($key==$adminData->admin_role){ echo 'selected';} }?>><?php echo $roleData;?></option>
					<?php } ?>
                  </select>
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" required name="admin_email" value="<?php echo isset($adminData->admin_email)?$adminData->admin_email:'';?>" placeholder="Enter email ID">
                  </div>
				  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password<?php  if($type=="edit"){  $rq="";?>(If you want change fill this)<?php } else{ $rq="required"; }?></label>
                    <input type="password" class="form-control" <?php echo $rq;?> name="admin_pass" placeholder="Password">
                  </div>
				  
				  <?php 
				  
				  $status = array(
								'1'=>'Active',
								'0'=>'InActive',
									);
				  
				  
				  ?>
				  
				  
				  <div class="form-group">
                  <label>Subadmin status:</label>
                  <select class="form-control" required name="admin_status" style="width: 100%;">
                    <option value="">Select Status</option>
                    <?php foreach($status as $key=>$statusData) {?>
					  <option value="<?php echo $key;?>"  <?php if(isset($adminData->admin_status)){ if($key==$adminData->admin_status){ echo 'selected';} }?>><?php echo $statusData;?></option>
					<?php } ?>
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
