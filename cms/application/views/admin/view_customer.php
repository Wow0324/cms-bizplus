<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Customers</h1>
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
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Address Detail</th>
								<th>Status</th>
								<th width="140">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							foreach ($customer as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo safe_data($i); ?></td>
									<td><?php echo safe_data($row['customer_name']); ?></td>
									<td><?php echo safe_data($row['customer_email']); ?></td>
									<td><?php echo safe_data($row['customer_phone']); ?></td>
									<td>
										Country: <?php echo safe_data($row['customer_country']); ?><br>
										Address: <?php echo safe_data($row['customer_address']); ?><br>
										State: <?php echo safe_data($row['customer_state']); ?><br>
										City: <?php echo safe_data($row['customer_city']); ?><br>
										Zip: <?php echo safe_data($row['customer_zip']); ?><br>
									</td>
									<td>
										<?php echo safe_data($row['customer_status']); ?><br>
										<?php if($row['customer_status'] == "Active"): ?>
										<a href="<?php echo base_url().M_REWRITE; ?>admin/customer/make-pending/<?php echo safe_data($row['customer_id']); ?>" class="btn btn-xs btn-primary" onClick="return confirm('Are you sure?');">Make Pending</a>
										<?php else: ?>
										<a href="<?php echo base_url().M_REWRITE; ?>admin/customer/make-active/<?php echo safe_data($row['customer_id']); ?>" class="btn btn-xs btn-primary" onClick="return confirm('Are you sure?');">Make Active</a>
										<?php endif; ?>
									</td>
									<td>
										<a href="<?php echo base_url().M_REWRITE; ?>admin/customer/delete/<?php echo safe_data($row['customer_id']); ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>
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