<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Photo Gallery Page Items</h1>
	</div>
</section>


<section class="content">

  <div class="row">
    <div class="col-md-12">
    
        <?php
            if($this->session->flashdata('error')) {
                ?>
                <div class="callout callout-danger">
                    <p><?php echo safe_data($this->session->flashdata('error')); ?></p>
                </div>
                <?php
            }
            if($this->session->flashdata('success')) {
                ?>
                <div class="callout callout-success">
                    <p><?php echo safe_data($this->session->flashdata('success')); ?></p>
                </div>
                <?php
            }
            ?>

      <div class="box box-info">
        
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
			        <th>SL</th>
			        <th>Heading</th>
                    <th>Language</th>
			        <th>Action</th>
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	foreach ($page_photo_gallery as $row) {
            		$i++;
            		?>
					<tr>
	                    <td><?php echo safe_data($i); ?></td>
	                    <td><?php echo safe_data($row['photo_gallery_heading']); ?></td>
                        <td><?php echo safe_data($row['lang_name']); ?></td>
	                    <td>
	                        <a href="<?php echo base_url().M_REWRITE; ?>admin/page-photo-gallery/edit/<?php echo safe_data($row['id']); ?>" class="btn btn-primary btn-xs">Edit</a>
	                    </td>
	                </tr>
            		<?php
            	}
            	?>
            </tbody>
          </table>
        </div>
      </div>
</section>