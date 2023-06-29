<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Page Home</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/page-home" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

  	<div class="row">
	    <div class="col-md-12">

			

	        <?php echo form_open(base_url().M_REWRITE.'admin/page-home/edit/'.safe_data($page_home['id']),array('class' => 'form-horizontal')); ?>
	        <div class="box box-info">
	            <div class="box-body">
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Welcome Section Title *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_welcome_title" value="<?php echo safe_data($page_home['home_welcome_title']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Welcome Section Subtitle *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_welcome_subtitle" value="<?php echo safe_data($page_home['home_welcome_subtitle']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Welcome Text *</label>
	                    <div class="col-sm-8">
	                    	<textarea name="home_welcome_text" class="form-control editor" cols="30" rows="10"><?php echo safe_data($page_home['home_welcome_text']); ?></textarea>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Why Choose Title *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_why_choose_title" value="<?php echo safe_data($page_home['home_why_choose_title']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Why Choose Subtitle *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_why_choose_subtitle" value="<?php echo safe_data($page_home['home_why_choose_subtitle']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Feature Title *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_feature_title" value="<?php echo safe_data($page_home['home_feature_title']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Feature Subtitle *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_feature_subtitle" value="<?php echo safe_data($page_home['home_feature_subtitle']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Service Title *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_service_title" value="<?php echo safe_data($page_home['home_service_title']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Service Subtitle *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_service_subtitle" value="<?php echo safe_data($page_home['home_service_subtitle']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Testimonial Title *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_testimonial_title" value="<?php echo safe_data($page_home['home_testimonial_title']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Testimonial Subtitle *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_testimonial_subtitle" value="<?php echo safe_data($page_home['home_testimonial_subtitle']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Blog Title *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_blog_title" value="<?php echo safe_data($page_home['home_blog_title']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Blog Subtitle *</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" name="home_blog_subtitle" value="<?php echo safe_data($page_home['home_blog_subtitle']); ?>">
	                    </div>
	                </div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Language </label>
						<div class="col-sm-2">
							<input type="text" class="form-control" name="" value="<?php echo safe_data($page_home['lang_name']); ?>" disabled>
						</div>
					</div>
	                <div class="form-group">
	                	<label for="" class="col-sm-3 control-label"></label>
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