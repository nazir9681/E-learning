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
            <h1>Course List</h1>
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
                  <th>Name</th>
                  <th>Actual price</th>
                  <th>Offer price</th>
                  <th>Date Added</th>
                  <th>Images</th>
                  <th>Comments</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php  $i=1;foreach($courseList as $data){?>  
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data->course_name;?></td>
                  <td><?php echo $data->course_actual_price;?></td>
                  <td><?php echo $data->course_offer;?></td>
                  <td><?php echo $data->course_created;?></td>
                  <td><img src="<?php echo base_url().''.$data->course_image ?>" height=80></td>
                  <td><a href="<?php echo base_url().'admin/courseComment/'.$data->course_id?>">Comment</a></td>
                  <td><a href="<?php echo base_url().'admin/courseModify/edit/'.$data->course_id?>"><i class="fas fa-edit"></i></a></td>
                </tr>
                <?php $i++;} ?>
                </tbody>
                <tfoot>
                  
                <tr>
                  <th>Sr.no</th>
                  <th>Name</th>
                  <th>Actual price</th>
                  <th>Offer price</th>
                  <th>Date Added</th>
                  <th>Images</th>
                  <th>Comments</th>
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
