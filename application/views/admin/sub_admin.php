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
          <div class="col-sm-6">
            <h1>Teacher List</h1>
          </div>
		   <div class="col-md-6"></div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php echo $this->session->flashdata('msg');?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          

          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.no</th>
                  <th>User name</th>
                  <th>Role</th>
                  <th>Email-ID</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    
				<?php  $i=1;foreach($subadminList as $data){?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data->admin_user_name;?></td>
                  <td><?php echo $data->admin_role;?></td>
                  <td> <?php echo $data->admin_email;?></td>
                  <td> <?php 
					  if($data->admin_status==1){?>
						 
						 Active
					  <?php }else{ ?>
						
						InActive
					  
					  <?php } ?>
				  </td>
                  <td> <a href="<?php echo base_url().'admin/subadminModify/edit/'.$data->admin_id?>"><i class="fas fa-edit"></i></a></td>
                </tr>
                <?php $i++;} ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Sr.no</th>
                  <th>User name</th>
                  <th>Role</th>
                  <th>Email-ID</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php require_once('footer.php'); ?>
</body>
</html>
