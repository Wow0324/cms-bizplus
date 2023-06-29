<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Settings Section</h1>
	</div>
</section>

<section class="content min_h_a mb__30">
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

		</div>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">
							
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_logo" data-toggle="tab">Logo</a></li>
						<li><a href="#tab_favicon" data-toggle="tab">Favicon</a></li>
						<li><a href="#tab_top_bar" data-toggle="tab">Top Bar</a></li>
						<li><a href="#tab_footer" data-toggle="tab">Footer</a></li>
						<li><a href="#tab_email" data-toggle="tab">Email</a></li>
						<li><a href="#tab_banner" data-toggle="tab">Banner</a></li>
						<li><a href="#tab_sidebar" data-toggle="tab">Sidebar</a></li>
                        <li><a href="#tab_color" data-toggle="tab">Color</a></li>
                        <li><a href="#tab_payment" data-toggle="tab">Payment</a></li>
                        <li><a href="#tab_other" data-toggle="tab">Other</a></li>
					</ul>

					<div class="tab-content">

          				<div class="tab-pane active" id="tab_logo">
          					<?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
          					<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">Existing Photo</label>
							            <div class="col-sm-6 pt_5">
							                <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['logo']); ?>" class="existing-photo h_80">
							            </div>
							        </div>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6 pt_5">
							                <input type="file" name="photo_logo">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_logo">Update Logo</button>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
          				</div>


          				<div class="tab-pane" id="tab_favicon">

          					<?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">Existing Photo</label>
							            <div class="col-sm-6 pt_5">
							                <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['favicon']); ?>" class="existing-photo h_40">
							            </div>
							        </div>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6 pt_5">
							                <input type="file" name="photo_favicon">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_favicon">Update Favicon</button>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
          				</div>


          				<div class="tab-pane" id="tab_top_bar">
							<?php echo form_open(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
							<div class="box box-info">
								<div class="box-body">									
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Top Bar Email </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="top_bar_email" value="<?php echo safe_data($setting['top_bar_email']); ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Top Bar Phone Number </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="top_bar_phone" value="<?php echo safe_data($setting['top_bar_phone']); ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_top_bar">Update</button>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
          				</div>



          				<div class="tab-pane" id="tab_footer">
							

							<?php echo form_open(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
							<h3 class="sec_title">General Section</h3>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Number of Recent Blogs </label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="footer_recent_blog_item" value="<?php echo safe_data($setting['footer_recent_blog_item']); ?>">
                                </div>
                            </div>
                            <div class="form-group">
								<label for="" class="col-sm-3 control-label"></label>
								<div class="col-sm-6">
									<button type="submit" class="btn btn-success pull-left" name="form_footer_general">Update</button>
								</div>
							</div>
							<?php echo form_close(); ?>



							<?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
                            <h3 class="sec_title">Call To Action Section</h3>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">CTA Button URL </label>
                                <div class="col-sm-6">
                                    <input type="text" name="cta_button_url" class="form-control" value="<?php echo safe_data($setting['cta_button_url']); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">CTA Status </label>
                                <div class="col-sm-2">
                                    <select name="cta_status" class="form-control select2">
                                    	<option value="Show" <?php if($setting['cta_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                    	<option value="Hide" <?php if($setting['cta_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
								<label for="" class="col-sm-3 control-label"></label>
								<div class="col-sm-6">
									<button type="submit" class="btn btn-success pull-left" name="form_footer_cta">Update</button>
								</div>
							</div>
							<?php echo form_close(); ?>




							<?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
							<h3 class="sec_title mt_0">Call To Action Background Photo</h3>
							<div class="form-group">
                                <label for="" class="col-sm-3 control-label">Existing Photo </label>
                                <div class="col-sm-6">
                                    <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['cta_background']); ?>" alt="" class="w_300">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">New Photo </label>
                                <div class="col-sm-6">
                                    <input type="file" name="photo" class="pt_5">
                                </div>
                            </div>
							<div class="form-group">
								<label for="" class="col-sm-3 control-label"></label>
								<div class="col-sm-6">
									<button type="submit" class="btn btn-success pull-left" name="form_footer_cta_background">Update</button>
								</div>
							</div>
							<?php echo form_close(); ?>



          				</div>



          				<div class="tab-pane" id="tab_email">
          					<?php echo form_open(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
							<div class="box box-info">
								<div class="box-body">
									<h3 class="sec_title mt_0">General Setting</h3>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Send Email From <span>*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="send_email_from" maxlength="255" autocomplete="off" value="<?php echo safe_data($setting['send_email_from']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Receive Email To <span>*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="receive_email_to" maxlength="255" autocomplete="off" value="<?php echo safe_data($setting['receive_email_to']); ?>">
                                        </div>
                                    </div>

                                    <h3 class="sec_title mt_0">SMTP Setting</h3>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">SMTP Active? <span>*</span></label>
                                        <div class="col-sm-4">
                                            <select name="smtp_active" class="form-control select2">
                                            	<option value="Yes" <?php if($setting['smtp_active'] == 'Yes') {echo 'selected';} ?>>Yes</option>
                                            	<option value="No" <?php if($setting['smtp_active'] == 'No') {echo 'selected';} ?>>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">SMTP Secured? <span>*</span></label>
                                        <div class="col-sm-4">
                                            <select name="smtp_secured" class="form-control select2">
                                            	<option value="Yes" <?php if($setting['smtp_secured'] == 'Yes') {echo 'selected';} ?>>Yes</option>
                                            	<option value="No" <?php if($setting['smtp_secured'] == 'No') {echo 'selected';} ?>>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">SMTP Host</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="smtp_host" maxlength="255" autocomplete="off" value="<?php echo safe_data($setting['smtp_host']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">SMTP Port</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="smtp_port" maxlength="255" autocomplete="off" value="<?php echo safe_data($setting['smtp_port']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">SMTP Username</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="smtp_username" maxlength="255" autocomplete="off" value="<?php echo safe_data($setting['smtp_username']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">SMTP Password</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="smtp_password" maxlength="255" autocomplete="off" value="<?php echo safe_data($setting['smtp_password']); ?>">
                                        </div>
                                    </div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_email">Update</button>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
          				</div>



          				<div class="tab-pane" id="tab_banner">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">                                
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>About Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_about']); ?>" alt="" class="w_100_p h_auto">
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_about">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Testimonial Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_testimonial']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_testimonial">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Blog Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_blog']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_blog">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Contact Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_contact']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_contact">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Privacy Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_privacy']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_privacy">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Terms Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_terms']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_terms">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>FAQ Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_faq']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_faq">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>

                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Service Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_service']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_service">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Team Member Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_team_member']); ?>" alt="" class="w_100_p h_auto">
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_team_member">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Photo Gallery Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_photo_gallery']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_photo_gallery">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>

                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Video Gallery Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_video_gallery']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_video_gallery">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>

                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Shop Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_shop']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_shop">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Customer Section Pages Banner</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_customer_section']); ?>" alt="" class="w_100_p h_auto">
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_customer_section">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().M_REWRITE.'admin/setting/update',array('class' => '')); ?>
                                            <td class="w_50_p">
                                                <h4>Verify Subscriber Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.safe_data($setting['banner_verify_subscriber']); ?>" alt="" class="w_100_p h_auto">  
                                                </p>                                        
                                            </td>
                                            <td class="w_50_p">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs mt_10" value="Change" name="form_banner_verify_subscriber">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
          				</div>



          				<div class="tab-pane" id="tab_sidebar">
          					<?php echo form_open(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
							<div class="box box-info">
								<div class="box-body">                                    
                                    <h3 class="sec_title mt_0">Blog Detail Page - Sidebar Section</h3>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Total Recent Blogs <span>*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="sidebar_total_recent_blog" maxlength="255" autocomplete="off" value="<?php echo safe_data($setting['sidebar_total_recent_blog']); ?>">
                                        </div>
                                    </div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_sidebar">Update</button>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
          				</div>


                        
                        <div class="tab-pane" id="tab_color">
                            <?php echo form_open(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Color </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="front_end_color" class="form-control jscolor" value="<?php echo safe_data($setting['front_end_color']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form_color">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>



                        <div class="tab-pane" id="tab_payment">
                            <?php echo form_open(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">PayPal Email Address </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="paypal_email" class="form-control" value="<?php echo safe_data($setting['paypal_email']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Stripe Public Key </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="stripe_public_key" class="form-control" value="<?php echo safe_data($setting['stripe_public_key']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Stripe Secret Key </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="stripe_secret_key" class="form-control" value="<?php echo safe_data($setting['stripe_secret_key']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form_payment">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>



                        <div class="tab-pane" id="tab_other">
                            <?php echo form_open(base_url().M_REWRITE.'admin/setting/update',array('class' => 'form-horizontal')); ?>
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Website Name * </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="website_name" class="form-control" value="<?php echo safe_data($setting['website_name']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form_other">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>



          			</div>
				</div>

			
		</div>
	</div>

</section>