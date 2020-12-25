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
            <h1>Order Section</h1>
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
                  <th>Course Name</th>
                  <th>User Name</th>
                  <th>Transaction ID</th>
                  <th>Payment Type</th>
                  <th>Paid Amount</th>
                  <th>Action</th>
                  <th>Details View</th>
                </tr>
                </thead>
                <tbody>  
                <?php  $i=1;foreach($orderData as $data){?> 
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $data->course_name; ?></td>
                  <td><?= $data->student_name; ?></td>
                  <td><?= $data->transaction_id; ?></td>
                  <td><?= $data->payment_type; ?></td>
                  <td><?= $data->paid_amount; ?></td>
                  <td>
                    <div class="btn-group">
                        <?php if($data->order_status == '1'){ ?>
                        <button type="button" class="btn btn-warning">HOLD</button>
                        <?php } else { ?>
                        <button type="button" class="btn btn-danger">REJECT</button>
                        
                        <?php } if($data->order_status == '1'){ ?>
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <?php } else { ?>
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <?php } ?>


                        <ul class="dropdown-menu" role="menu">
                            <?php if($data->order_status == '1'){ ?>
                        <li style="margin-left: 10px;"><a href="<?php echo base_url(); ?>admin/order_status_update/0/<?=$data->order_id; ?>">REJECT</a></li>
                        <?php }else{ ?>
                        <li style="margin-left: 10px;"><a href="<?php echo base_url(); ?>admin/order_status_update/1/<?=$data->order_id; ?>">HOLD</a></li>
                        <?php } ?>
                      </div>
                  </td>
                  <td> <a href="<?php echo base_url(); ?>admin/orderDetailView/<?=$data->order_id; ?>"><i class="fas fa-eye"></i></a></td>
                </tr>
                <?php $i++;} ?>
                </tbody>
                <tfoot>
                  
                <tr>
                  <th>Sr.no</th>
                  <th>Course Name</th>
                  <th>User Name</th>
                  <th>Transaction ID</th>
                  <th>Payment Type</th>
                  <th>Paid Amount</th>
                  <th>Action</th>
                  <th>Details View</th>
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
