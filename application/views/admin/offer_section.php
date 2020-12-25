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
          <div class="col-sm-4">
            <h1>Offer Section</h1>
          </div>
		   <div class="col-md-6"></div>
          <ul class="breadcrumb" style="padding-top: 0">
            <li><a class="btn btn-primary my-3" href="#" data-toggle="modal" data-target="#modal-default">
            <span style="color: white;"><i class="fa fa-plus"></i>Add New Banner</span>
            </a></li>
          </ul>

          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title text-center">Add New Offer</h4>
              </div>

              <div class="modal-body">

                 <?php echo form_open_multipart('admin/isvalidate_offer'); ?> 
                <?php echo form_error('banner_type'); ?>
                <div class="form-group">
                  <label for="exampleInputFile">Image</label>
                 <input type="file" required=""  accept="image/x-png,image/gif,image/jpeg" name="offer_img" id="offer_img">
                </div>
                <?php echo form_submit(['type'=>'submit' ,'class'=>'btn btn-primary' , 'value'=>'Submit'])?>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                 </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
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
                  <th>Offer Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                
                </thead>
                <tbody>
                    <?php  $i=1;foreach($offerList as $data){?>  
                <tr>
                  <td><?= $i; ?></td>
                  <td><img style="width: 100px;" src="<?= base_url().$data->offer_img; ?>"></td>
                  <td>
                    <div class="btn-group">
                        <?php if($data->offer_status == '1'){ ?>
                        <button type="button" class="btn btn-info">Active</button>
                        <?php }else{ ?>
                        <button type="button" class="btn btn-danger">Inactive</button>
                        <?php } if($data->offer_status == '1'){ ?>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <?php }else{ ?>
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <?php } ?>


                        <ul class="dropdown-menu" role="menu">
                        <?php if($data->offer_status == '1'){ ?>
                        <li style="margin-left: 10px;"><a href="<?php echo base_url(); ?>admin/offer_status_update/0/<?=$data->offer_id; ?>">INACTIVE</a></li>
                        <?php } else{ ?>
                        <li style="margin-left: 10px;"><a href="<?php echo base_url(); ?>admin/offer_status_update/1/<?=$data->offer_id; ?>">ACTIVE</a></li>
                        <?php } ?> 
                      </div>
                  </td>
                  <td>
                      <a class="btn btn-info" onclick="offer_id(<?=$data->offer_id; ?>)" href="#" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></a>
                 </td>
                </tr>
                <?php $i++;} ?>
                </tbody>
                <tfoot>
                  
                <tr>
                  <th>Sr.no</th>
                  <th>Offer Image</th>
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
  <div class="modal fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-center">Edit Offer</h4>
              </div>
              <div class="modal-body">

                  <div class="row">
                    <div class="col-lg-7">
                      <form id="banner" name="banner" action="isvalidate_offer_edit" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleInputFile">Image</label>
                 <input type="file" required=""  accept="image/x-png,image/gif,image/jpeg" name="offer_img" id="offer_img">
                </div>
                <input type="hidden" id="b_id"  name="b_id"> 
                <?php echo form_submit(['type'=>'submit' ,'class'=>'btn btn-primary' , 'value'=>'Submit'])?>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                 </form>
               </div>
               </div>


              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
 <?php require_once('footer.php'); ?>
 <script type="text/javascript">
  function offer_id(bid) {
    //alert(bid);
 $("#b_id").val(bid);
}
</script>
</body>
</html>
