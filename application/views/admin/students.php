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
            <h1>Student List</h1>
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
                  <th>Profile</th>
                  <th style="width: 50px;">Name</th>
                  <th>Email-ID</th>
                  <th>Number</th>
                  <th>Attendance</th>
                  <th>Action/Status</th>
                </tr>
                </thead>
                <tbody>
                    
				<?php  $i=1;foreach($studentList as $data){?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><img src="<?php echo base_url().''.$data->student_profile?>" width="49px" height="49px"></td>
                  <td><?php echo $data->student_name;?></td>
                  <td><?php echo $data->student_email;?></td>
                  <td> <?php echo $data->student_mobile_no;?></td>
                  <td> <a href="<?php echo base_url().'admin/attendance/'.$data->student_id?>">Check</a></td>
                  <td> <a href="<?php echo base_url().'admin/studentModify/edit/'.$data->student_id?>"><i class="fas fa-edit"></i></a>
                    <?php if($data->student_status == '1'){ ?>
                      <a class="btn btn-danger btn-sm my-3" href="<?php echo base_url(); ?>admin/studentStatus/0/<?=$data->student_id; ?>" >Suspend</a>
                          <?php }else{ ?>
                          <a class="btn btn-success btn-sm my-3" href="<?php echo base_url(); ?>admin/studentStatus/1/<?=$data->student_id; ?>" >Live</a>
                          <?php } ?>
                  </td>
                </tr>
                <?php $i++;} ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Sr.no</th>
                  <th>Profile</th>
                  <th>Name</th>
                  <th>Email-ID</th>
                  <th>Number</th>
                  <th>Attendance</th>
                  <th>Action/Status</th>
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
