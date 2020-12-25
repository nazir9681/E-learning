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
				
				<h3 class="card-title">Order Detail View</h3>
              </div>
              
                <div class="card-body">
                  <div class="form-group">
                      <div class="row">
                          <div class="col-lg-6">
                            <label for="exampleInputEmail1">Name of the Course: </label>          
                          </div>
                          <div class="col-lg-6">
                            <?php echo $dataOrderView->course_name; ?>  
                          </div>
                          
                      </div>
                  </div>
			    
			    <div class="form-group">
			        <div class="row">
                          <div class="col-lg-6">
                    <label for="exampleInputEmail1">Transaction ID: </label>
                    </div>
                    <div class="col-lg-6">
                    <?php echo $dataOrderView->transaction_id; ?>
                    </div>
                    </div>
                  </div>
				  
				  
				  
				  
				  <div class="form-group">
			        <div class="row">
                          <div class="col-lg-6">
                    <label for="exampleInputEmail1">Payment Type: </label>
                    </div>
                    <div class="col-lg-6">
                    <?php echo $dataOrderView->payment_type; ?>
                    </div>
                    </div>
                  </div>
				  
				  
				  <div class="form-group">
			        <div class="row">
                          <div class="col-lg-6">
                    <label for="exampleInputEmail1">Paid Amount: </label>
                    </div>
                    <div class="col-lg-6">
                    <?php echo $dataOrderView->paid_amount; ?>
                    </div>
                    </div>
                  </div>
                
                 <div class="form-group">
			        <div class="row">
                          <div class="col-lg-6">
                    <label for="exampleInputEmail1">Order Status: </label>
                    </div>
                    <div class="col-lg-6">
                    <?php if($dataOrderView->order_status == '1'){ ?>
                        <button type="button" class="btn btn-warning">HOLD</button>
                        <?php } else { ?>
                        <button type="button" class="btn btn-danger">REJECT</button>
                        
                        <?php } ?>
                    </div>
                    </div>
                  </div>
				 
                 
                </div>
                <!-- /.card-body -->

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
