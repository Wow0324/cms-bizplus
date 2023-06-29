<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>SEO Section</h1>
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

            <?php echo form_open(base_url().M_REWRITE.'admin/seo/update',array('class' => 'form-horizontal')); ?>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Title </label>
                            <div class="col-sm-6">
                                <input type="text" name="title" class="form-control" value="<?php echo safe_data($seo['title']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Keyword </label>
                            <div class="col-sm-6">
                                <textarea class="form-control h_80" name="keyword"><?php echo safe_data($seo['keyword']); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Description </label>
                            <div class="col-sm-6">
                                <textarea class="form-control h_80" name="description"><?php echo safe_data($seo['description']); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form_seo">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
                
        </div>
    </div>

</section>