<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Page Contact</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/page-contact" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

  	<div class="row">
	    <div class="col-md-12">

			

	        <?php echo form_open(base_url().M_REWRITE.'admin/page-contact/edit/'.safe_data($page_contact['id']),array('class' => 'form-horizontal')); ?>
	        <div class="box box-info">
	            <div class="box-body">
	                <div class="form-group">
	                    <label for="" class="col-sm-2 control-label">Heading *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="contact_heading" value="<?php echo safe_data($page_contact['contact_heading']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
						<label for="" class="col-sm-2 control-label">Address * </label>
						<div class="col-sm-8">
							<textarea name="contact_address" class="form-control h_80" cols="30" rows="10"><?php echo safe_data($page_contact['contact_address']); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Phone * </label>
						<div class="col-sm-8">
							<textarea name="contact_phone" class="form-control h_80" cols="30" rows="10"><?php echo safe_data($page_contact['contact_phone']); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Email Address * </label>
						<div class="col-sm-8">
							<textarea name="contact_email" class="form-control h_80" cols="30" rows="10"><?php echo safe_data($page_contact['contact_email']); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Language </label>
						<div class="col-sm-2">
							<input type="text" class="form-control" name="" value="<?php echo safe_data($page_contact['lang_name']); ?>" disabled>
						</div>
					</div>
	                <div class="form-group">
	                	<label for="" class="col-sm-2 control-label"></label>
	                    <div class="col-sm-6">
	                      <button type="submit" class="btn btn-success pull-left" name="form1">Update</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <?php echo form_close(); ?>
	    </div>
  	</div>
</section>