<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Dynamic Pages</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/page-dynamic/add" class="btn btn-primary btn-sm">Add New</a>
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
                                <th>Banner</th>
                                <th>Name</th>
                                <th>Language</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							foreach ($page_dynamic as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo safe_data($i); ?></td>
									<td>
										<img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row['banner']); ?>" class="w_150">
									</td>
									<td>
										<?php echo safe_data($row['name']); ?>
									</td>
									<td>
										<?php echo safe_data($row['lang_name']); ?>
									</td>
									<td>
                                        <a href="<?php echo base_url(); ?>admin/page-dynamic/edit/<?php echo safe_data($row['id']); ?>" class="btn btn-primary btn-sm btn-block">Edit</a>
                                        <a href="<?php echo base_url(); ?>admin/page-dynamic/delete/<?php echo safe_data($row['id']); ?>" class="btn btn-danger btn-sm btn-block" onClick="return confirm('Are you sure?');">Delete</a>  
                                    </td>
								</tr>
								<?php
							}
							?>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


</section>