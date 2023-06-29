<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Add Product</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/product" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">

			

			<?php echo form_open_multipart(base_url().M_REWRITE.'admin/product/add',array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Product Name <span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_name" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Product Slug</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_slug" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Old Price </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_old_price" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Current Price <span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_current_price" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Stock <span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_stock" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Content <span>*</span></label>
							<div class="col-sm-8">
								<textarea class="form-control editor" name="product_content"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Short Content <span>*</span></label>
							<div class="col-sm-8">
								<textarea class="form-control h_80" name="product_content_short"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Return Policy</label>
							<div class="col-sm-8">
								<textarea class="form-control editor" name="product_return_policy"></textarea>
							</div>
						</div>
						<div class="form-group">
				            <label for="" class="col-sm-3 control-label">Featured Photo *</label>
				            <div class="col-sm-8 pt_5">
				                <input type="file" name="photo">
				            </div>
				        </div>
				        <div class="form-group">
							<label for="" class="col-sm-3 control-label">Order </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_order" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Meta Title</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="meta_title" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Meta Description</label>
							<div class="col-sm-8">
								<textarea class="form-control h_80" name="meta_description"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Language </label>
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
							<label for="" class="col-sm-3 control-label"></label>
							<div class="col-sm-8">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>

</section>