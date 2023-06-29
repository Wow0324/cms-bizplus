<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Page Video Gallery</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/page-video-gallery" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

  	<div class="row">
	    <div class="col-md-12">

			

	        <?php echo form_open(base_url().M_REWRITE.'admin/page-video-gallery/edit/'.safe_data($page_video_gallery['id']),array('class' => 'form-horizontal')); ?>
	        <div class="box box-info">
	            <div class="box-body">
	                <div class="form-group">
	                    <label for="" class="col-sm-2 control-label">Heading *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="video_gallery_heading" value="<?php echo safe_data($page_video_gallery['video_gallery_heading']); ?>">
	                    </div>
	                </div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Language </label>
						<div class="col-sm-2">
							<input type="text" class="form-control" name="" value="<?php echo safe_data($page_video_gallery['lang_name']); ?>" disabled>
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