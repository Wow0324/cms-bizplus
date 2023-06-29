<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Home Page Items</h1>
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
                                <th>Language</th>
            			        <th>Action</th>
            			    </tr>
        			    </thead>
                        <tbody>
                        	<?php
                        	$i=0;
                        	foreach ($page_home as $row) {
                        		$i++;
                        		?>
            					<tr>
            	                    <td><?php echo safe_data($i); ?></td>
                                    <td><?php echo safe_data($row['lang_name']); ?></td>
            	                    <td>
            	                        <a href="<?php echo base_url().M_REWRITE; ?>admin/page-home/edit/<?php echo safe_data($row['id']); ?>" class="btn btn-primary btn-xs">Edit</a>
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

<section class="content-header mt_40 mb__30">
    <div class="content-header-left">
        <h1>View Home Page Items (Language Independent)</h1>
    </div>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">        
                <div class="box-body table-responsive">

                    <h3 class="sec_title">Welcome Section</h3>
                    <?php echo form_open_multipart(base_url().M_REWRITE.'admin/page-home',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Video Code (Youtube) </label>
                            <div class="col-sm-6">
                                <input type="text" name="home_welcome_video" class="form-control" value="<?php echo safe_data($page_home_lang_independent['home_welcome_video']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_welcome_status" class="form-control select2 w_auto">
                                <option value="Show" <?php if($page_home_lang_independent['home_welcome_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_welcome_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form_home_welcome">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>



                    <h3 class="sec_title">Why Choose Us Section</h3>
                    <?php echo form_open_multipart(base_url().M_REWRITE.'admin/page-home',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_why_choose_status" class="form-control select2 w_auto">
                                <option value="Show" <?php if($page_home_lang_independent['home_why_choose_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_why_choose_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form_home_why_choose">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>


                    <h3 class="sec_title">Feature Section</h3>
                    <?php echo form_open_multipart(base_url().M_REWRITE.'admin/page-home',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_feature_status" class="form-control select2 w_auto">
                                <option value="Show" <?php if($page_home_lang_independent['home_feature_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_feature_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form_home_feature">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>


                    <h3 class="sec_title">Service Section</h3>
                    <?php echo form_open(base_url().M_REWRITE.'admin/page-home',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_service_status" class="form-control select2 w_auto">
                                <option value="Show" <?php if($page_home_lang_independent['home_service_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_service_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form_home_service">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>

                    
                    <h3 class="sec_title">Testimonial Section</h3>
                    <?php echo form_open(base_url().M_REWRITE.'admin/page-home',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_testimonial_status" class="form-control select2 w_auto">
                                <option value="Show" <?php if($page_home_lang_independent['home_testimonial_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_testimonial_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form_home_testimonial">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>


                    <h3 class="sec_title">Testimonial Photo Section</h3>
                    <?php echo form_open_multipart(base_url().M_REWRITE.'admin/page-home',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Existing Photo</label>
                            <div class="col-sm-6 pt_5">
                                <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($page_home_lang_independent['home_testimonial_photo']); ?>" class="existing-photo h_180">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">New Photo</label>
                            <div class="col-sm-6 pt_5">
                                <input type="file" name="home_testimonial_photo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form_home_testimonial_photo">Update</button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>


                    <h3 class="sec_title">Blog Section</h3>
                    <?php echo form_open(base_url().M_REWRITE.'admin/page-home',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">How many item to show? </label>
                            <div class="col-sm-2">
                                <input type="text" name="home_blog_item" class="form-control" value="<?php echo safe_data($page_home_lang_independent['home_blog_item']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_blog_status" class="form-control select2 w_auto">
                                <option value="Show" <?php if($page_home_lang_independent['home_blog_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_blog_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form_home_blog">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>




                </div>
            </div>
        </div>
    </div>
</section>