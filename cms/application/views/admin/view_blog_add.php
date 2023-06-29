<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Add Blog</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/blog" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php echo form_open_multipart(base_url().M_REWRITE.'admin/blog/add',array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="title" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Slug <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="slug" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Short Content <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control h_80" name="content_short"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Content <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="content"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Publish Date <span>*</span></label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="created_at" id="datepicker" value="<?php echo date('Y-m-d'); ?>">(Format: yy-mm-dd)
							</div>
						</div>						
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Select Category <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="category_id">
				            		<option value="">Select a category</option>
				            		<?php
						            	$i=0;
						            	foreach ($all_category as $row) {
						            		?>
											<option value="<?php echo safe_data($row['category_id']); ?>"><?php echo safe_data($row['category_name']); ?></option>
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
									<option value="On">On</option>
									<option value="Off">Off</option>
								</select>
				            </div>
				        </div>
				        <h3 class="seo-info">Photo and Banner</h3>
				        <div class="form-group">
				            <label for="" class="col-sm-2 control-label">Featured Photo *</label>
				            <div class="col-sm-6 pt_5">
				                <input type="file" name="photo">
				            </div>
				        </div>
				        <div class="form-group">
				            <label for="" class="col-sm-2 control-label">Banner *</label>
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