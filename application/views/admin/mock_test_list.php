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
            <h1>Mock Test List</h1>
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
                  <th>Mock Test Category</th>
                  <th>Teacher Name</th>
                  <th>Time (in minutes)</th>
                  <th>Marks(each question)</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php  $i=1;foreach($mockList as $data){?>  
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data->mock_subject_name;?><br>
                  <a href="<?php echo base_url().'admin/mockQuestion/'.$data->mock_id?>"><i class="fas fa-plus"></i>Add Questions</a>
                  </td>
                  <td><?php echo $data->teacher_name;?></td>
                  <td><?php echo $data->mock_time;?></td>
                  <td><?php echo $data->mock_marks;?></td>
                  <td><img src="<?= base_url().''.$data->mock_test_image; ?>" height=80></td>
                  <td><a href="<?php echo base_url().'admin/modifyMockTest/edit/'.$data->mock_id?>"><i class="fas fa-pencil"></i>Edit</a></td>
                </tr>
                <?php $i++;} ?>
                </tbody>
                <tfoot>
                  
                <tr>
                 <th>Sr.no</th>
                  <th>Mock Test Category</th>
                  <th>Teacher Name</th>
                  <th>Time</th>
                  <th>Marks</th>
                  <th>Image</th>
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
