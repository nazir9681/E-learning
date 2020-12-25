<?php //echo "<pre>"; print_r($youtube); exit; ?>
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
            <h1>Youtube Videos List</h1>
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
                  <th>Teacher Name</th>
                  <th>Title</th>
                  <th>video</th>
                  <th>Comments</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($youtube as $val){ 
                        
                         
                        $videos = $val['videoID'];
                        foreach($videos as $values){    
                    ?>  
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $val['teacherName']; ?></td>
                    <td><?= $values['title']; ?></td>
                  <td>
                  <iframe width="180" height="125" src="https://www.youtube.com/embed/<?= $values['ID']; ?>"></iframe>
                  </td>
                  <td><a href="<?php echo base_url(); ?>admin/youtubeVideoComments/<?= $values['ID']; ?>">Link</a></td>
                </tr>
                <?php $i++;} }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Sr.no</th>
                  <th>Teacher Name</th>
                  <th>Title</th>
                  <th>video</th>
                  <th>Comments</th>
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
