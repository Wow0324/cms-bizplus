<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Add Coupon</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/coupon" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<section class="content">
	<div class="row">
		<div class="col-md-12">

			

			<?php echo form_open(base_url().M_REWRITE.'admin/coupon/add',array('class' => 'form-horizontal')); ?>
			<div class="box box-info">
				<div class="box-body">
					<div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon Code <span>*</span></label>
	                    <div class="col-sm-6">
	                        <input type="text" class="form-control" name="coupon_code">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon Type <span>*</span></label>
	                    <div class="col-sm-6">
	                        <select name="coupon_type" class="form-control select2">
	                        	<option value="Percentage">Percentage</option>
	                        	<option value="Amount">Amount</option>
	                        </select>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon Discount <span>*</span></label>
	                    <div class="col-sm-6">
	                    	<input type="text" class="form-control" name="coupon_discount">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon Maximum Use <span>*</span></label>
	                    <div class="col-sm-6">
	                    	<input type="text" class="form-control" name="coupon_maximum_use">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon Start Date <span>*</span></label>
	                    <div class="col-sm-6">
	                    	<input type="text" class="form-control" name="coupon_start_date" id="datepicker">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="" class="col-sm-3 control-label">Coupon End Date <span>*</span></label>
	                    <div class="col-sm-6">
	                    	<input type="text" class="form-control" name="coupon_end_date" id="datepicker1">
	                    </div>
	                </div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label"></label>
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