<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Language</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/lang" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

  	<div class="row">
	    <div class="col-md-12">

			

	        <?php echo form_open(base_url().'admin/lang/edit/'.$lang['lang_id'],array('class' => 'form-horizontal')); ?>
	        <div class="box box-info">
	            <div class="box-body">
	                <div class="form-group">
	                    <label for="" class="col-sm-2 control-label">Language Name <span>*</span></label>
	                    <div class="col-sm-4">
	                        <input type="text" class="form-control" name="lang_name" value="<?php echo safe_data($lang['lang_name']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
							<label for="" class="col-sm-2 control-label">Language Default?</label>
							<div class="col-sm-4 pt_5">
								<input type="hidden" name="lang_default" value="0">
								<input type="checkbox" name="lang_default" value="1" <?php if($lang['lang_default'] == 'Yes') {echo 'checked';} ?>>
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