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
            <h1>Live Class Comments</h1>
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
                  <th>Comment</th>
                  <th>Student Name</th>
                  <th>Teacher Name</th>
                  <th>Date</th>
                  <th>Admin Message</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php  $i=1;foreach($commentLiveList as $data){?>  
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data->comment;?></td>
                  <td><?php echo $data->student_name;?></td>
                  <td><?php echo $data->teacher_name;?></td>
                  <td><?php echo $data->timestamp;?></td>
                  <td><?php echo $data->admin_msg;?></td>
                  <td><a class="btn btn-primary btn-sm my-3" onclick="liveClassComment_id(<?= $data->id; ?>)" href="#" data-toggle="modal" data-target="#modal-default">
                    <span style="color: white;"><i class="fa fa-plus"></i>Reply</span>
                    </a></td>
                </tr>
                <?php $i++;} ?>
                </tbody>
                <tfoot>
                  
                <tr>
                  <th>Sr.no</th>
                  <th>Comment</th>
                  <th>Student Name</th>
                  <th>Teacher Name</th>
                  <th>Date</th>
                   <th>Admin Message</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
               <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title text-center">Reply</h4>
                      </div>
        
                      <div class="modal-body">
        
                         <?php echo form_open_multipart('admin/liveClassCourseComment'); ?> 
                        <?php echo form_error('banner_type'); ?>
                        <div class="form-group">
                          <label for="exampleInputFile">Reply</label>
                         <textarea required=""   name="admin_msg" class="form-control col-xs-12"></textarea>
                         <input type="hidden" name="id" id="id">
                        </div>
                        <?php echo form_submit(['type'=>'submit' ,'class'=>'btn btn-primary' , 'value'=>'Submit'])?>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                         </form>
                      </div>
                      
                    </div>
                    <!-- /.modal-content -->
                  </div>
        
        
                </div>
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
 <script type="text/javascript">
  function liveClassComment_id(bid) {
     $("#id").val(bid);
    }
    </script>
</body>
</html>
