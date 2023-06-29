<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Categories</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/category/add" class="btn btn-primary btn-sm">Add New</a>
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
			        <th>Category Name</th>
                    <th>Category Banner</th>
                    <th>Language</th>
			        <th>Action</th>
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	foreach ($category as $row) {
            		$i++;
            		?>
					<tr>
	                    <td><?php echo safe_data($i); ?></td>
	                    <td><?php echo safe_data($row['category_name']); ?></td>
                        <td>
                            <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row['category_banner']); ?>" alt="<?php echo safe_data($row['category_name']); ?>" class="w_250">
                        </td>
                        <td><?php echo safe_data($row['lang_name']); ?></td>
	                    <td>
	                        <a href="<?php echo base_url().M_REWRITE; ?>admin/category/edit/<?php echo safe_data($row['category_id']); ?>" class="btn btn-primary btn-xs">Edit</a>
	                        <a href="<?php echo base_url().M_REWRITE; ?>admin/category/delete/<?php echo safe_data($row['category_id']); ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>
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