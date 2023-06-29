<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Coupon</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/coupon" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
  	<div class="row">
	    <div class="col-md-12">
			
	        <?php echo form_open(base_url().M_REWRITE.'admin/coupon/edit/'.safe_data($coupon['coupon_id']),array('class' => 'form-horizontal')); ?>
	        <div class="box box-info">
	            <div class="box-body">
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon Code <span>*</span></label>
	                    <div class="col-sm-6">
	                        <input type="text" class="form-control" name="coupon_code" value="<?php echo safe_data($coupon['coupon_code']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon Type <span>*</span></label>
	                    <div class="col-sm-6">
	                        <select name="coupon_type" class="form-control select2">
	                        	<option value="Percentage" <?php if($coupon['coupon_type'] == 'Percentage') {echo 'selected';} ?>>Percentage</option>
	                        	<option value="Amount" <?php if($coupon['coupon_type'] == 'Amount') {echo 'selected';} ?>>Amount</option>
	                        </select>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon Discount <span>*</span></label>
	                    <div class="col-sm-6">
	                    	<input type="text" class="form-control" name="coupon_discount" value="<?php echo safe_data($coupon['coupon_discount']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon Maximum Use <span>*</span></label>
	                    <div class="col-sm-6">
	                    	<input type="text" class="form-control" name="coupon_maximum_use" value="<?php echo safe_data($coupon['coupon_maximum_use']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon Start Date <span>*</span></label>
	                    <div class="col-sm-6">
	                    	<input type="text" class="form-control" name="coupon_start_date" id="datepicker" value="<?php echo safe_data($coupon['coupon_start_date']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon End Date <span>*</span></label>
	                    <div class="col-sm-6">
	                    	<input type="text" class="form-control" name="coupon_end_date" id="datepicker1" value="<?php echo safe_data($coupon['coupon_end_date']); ?>">
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