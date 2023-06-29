<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Blog</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/blog" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php echo form_open_multipart(base_url().M_REWRITE.'admin/blog/edit/'.safe_data($blog['id']),array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="title" value="<?php echo safe_data($blog['title']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Slug </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="slug" value="<?php echo safe_data($blog['slug']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Short Content <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control h_80" name="content_short"><?php echo safe_data($blog['content_short']); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Content <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="content"><?php echo safe_data($blog['content']); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Publish Date <span>*</span></label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="created_at" id="datepicker" value="<?php echo safe_data($blog['created_at']); ?>">(Format: yy-mm-dd)
							</div>
						</div>
						
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Categories <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="category_id">
								<?php
				            	$i=0;
				            	foreach ($all_category as $row) {
									?>
									<option value="<?php echo safe_data($row['category_id']); ?>" <?php if($row['category_id']==$blog['category_id']){echo 'selected';} ?>><?php echo safe_data($row['category_name']); ?></option>
	                                <?php
								}
								?>
								</select>
				            </div>
				        </div>

				        <div class="form-group">
				            <label for="" class="col-sm-2 control-label">Comment <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="comment">
									<option value="On" <?php if($blog['comment'] == 'On') {echo 'selected';} ?>>On</option>
									<option value="Off" <?php if($blog['comment'] == 'Off') {echo 'selected';} ?>>Off</option>
								</select>
				            </div>
				        </div>
				        <h3 class="seo-info">Photo and Banner</h3>
				        <div class="form-group">
				            <label for="" class="col-sm-2 control-label">Existing Featured Photo</label>
				            <div class="col-sm-6 pt_5">
				            	<?php
				            	if($blog['photo'] == '') {
				            		echo 'No photo found';
				            	} else {
				            		?><img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($blog['photo']); ?>" alt="<?php echo safe_data($blog['title']); ?>" class="existing-photo w_150"><?php
				            	}
				            	?>
				            </div>
				        </div>
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Change Featured Photo</label>
				            <div class="col-sm-6 pt_5">
				                <input type="file" name="photo">
				            </div>
				        </div>
				        <div class="form-group">
				            <label for="" class="col-sm-2 control-label">Existing Banner</label>
				            <div class="col-sm-6 pt_5">
				            	<?php
				            	if($blog['banner'] == '') {
				            		echo 'No photo found';
				            	} else {
				            		?><img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($blog['banner']); ?>" alt="<?php echo safe_data($blog['title']); ?>" class="existing-photo w_300"><?php
				            	}
				            	?>
				            </div>
				        </div>
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Change Banner</label>
				            <div class="col-sm-6 pt_5">
				                <input type="file" name="banner">
				            </div>
				        </div>
				        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Language </label>
							<div class="col-sm-2">
								<select name="lang_id" class="form-control select2">
									<?php
									foreach($all_lang as $row)
									{
										?><option value="<?php echo safe_data($row['lang_id']); ?>" <?php if($blog['lang_id'] == $row['lang_id']) {echo 'selected';} ?>><?php echo safe_data($row['lang_name']); ?></option><?php
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