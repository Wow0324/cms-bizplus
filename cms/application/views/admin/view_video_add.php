<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin/login');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Video</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/video" class="btn btn-primary btn-sm">View All</a>
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

			<?php echo form_open(base_url().M_REWRITE.'admin/video/add',array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Select Video Type <span>*</span></label>
							<div class="col-sm-3">
								<select name="video_type" class="form-control select2">
									<option value="YouTube">YouTube</option>
									<option value="Vimeo">Vimeo</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Video Code <span>*</span></label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="video_code">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Video Caption <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="video_caption">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Language </label>
							<div class="col-sm-2">
								<select name="lang_id" class="form-control select2">
									<?php
									foreach($all_lang as $row)
									{
										?><option value="<?php echo safe_data($row['lang_id']); ?>"><?php echo safe_data($row['lang_name']); ?></option><?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</section>