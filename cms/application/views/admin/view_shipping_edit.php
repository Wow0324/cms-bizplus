<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Shipping Information</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/shipping" class="btn btn-primary btn-sm">View All</a>
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

	        <?php echo form_open(base_url().M_REWRITE.'admin/shipping/edit/'.safe_data($shipping['shipping_id']),array('class' => 'form-horizontal')); ?>
	        <div class="box box-info">
	            <div class="box-body">
	                <div class="form-group">
	                    <label for="" class="col-sm-2 control-label">Shipping Name <span>*</span></label>
	                    <div class="col-sm-6">
	                        <input type="text" class="form-control" name="shipping_name" value="<?php echo safe_data($shipping['shipping_name']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-2 control-label">Shipping Text <span>*</span></label>
	                    <div class="col-sm-6">
	                    	<textarea name="shipping_text" class="form-control h_80" cols="30" rows="10"><?php echo safe_data($shipping['shipping_text']); ?></textarea>
	                    </div>
	                </div>
					<div class="form-group">
	                    <label for="" class="col-sm-2 control-label">Shipping Cost <span>*</span></label>
	                    <div class="col-sm-6">
	                        <input type="text" class="form-control" name="shipping_cost" value="<?php echo safe_data($shipping['shipping_cost']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-2 control-label">Shipping Order <span>*</span></label>
	                    <div class="col-sm-6">
	                        <input type="text" class="form-control" name="shipping_order" value="<?php echo safe_data($shipping['shipping_order']); ?>">
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