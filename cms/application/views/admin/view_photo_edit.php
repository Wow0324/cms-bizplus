<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin/login');
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Photo</h1>
	</div>
	<div class="content-header-right">
		<a href="photo.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">

			

			<?php echo form_open_multipart(base_url().M_REWRITE.'admin/photo/edit/'.$photo['photo_id'],array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Existing Photo</label>
				            <div class="col-sm-6 pt_5">
				                <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($photo['photo_name']); ?>" class="existing-photo w_300">
				            </div>
				        </div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Upload New Photo <span>*</span></label>
							<div class="col-sm-4 pt_5">
								<input type="file" name="photo"> (Only jpg, jpeg, gif and png are allowed)
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Photo Caption</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="photo_caption" value="<?php echo safe_data($photo['photo_caption']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Language </label>
							<div class="col-sm-2">
								<select name="lang_id" class="form-control select2">
									<?php
									foreach($all_lang as $row)
									{
										?><option value="<?php echo safe_data($row['lang_id']); ?>" <?php if($photo['lang_id'] == $row['lang_id']) {echo 'selected';} ?>><?php echo safe_data($row['lang_name']); ?></option><?php
									}
									?>
								</select>
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