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
          <div class="col-sm-10">
            <h1>Mock Question List</h1>
          </div>
		   <div class="col-sm-2">
		       <ul class="breadcrumb" style="padding-top: 0">
            <li><a class="btn btn-primary my-3" href="<?php echo base_url(); ?>admin/addMockQuestion/<?= $mock_id ?>">
            <span style="color: white;"><i class="fa fa-plus"></i>Add New Questions</span>
            </a></li>
          </ul>
		   </div>
          
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
                  <th>Mock Test Question</th>
                  <th>Option 1</th>
                  <th>Option 2</th>
                  <th>Option 3</th>
                  <th>Option 4</th>
                  <th>Answer</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php  $i=1;foreach($mockQuestion as $data){?>  
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data->mock_question; ?></td>
                  <td><?php echo $data->option_1; ?></td>
                  <td><?php echo $data->option_2; ?></td>
                  <td><?php echo $data->option_3; ?></td>
                  <td><?php echo $data->option_4; ?></td>
                  <td><?php echo $data->answer; ?></td>
                  <td><a href="<?php echo base_url().'admin/modifyMockQuestion/edit/'.$data->mock_question_id?>"><i class="fas fa-pencil"></i>Edit</a></td>
                </tr>
                <?php $i++;} ?>
                </tbody>
                <tfoot>
                  
                <tr>
                 <th>Sr.no</th>
                  <th>Mock Test Question</th>
                  <th>Option 1</th>
                  <th>Option 2</th>
                  <th>Option 3</th>
                  <th>Option 4</th>
                  <th>Answer</th>
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
