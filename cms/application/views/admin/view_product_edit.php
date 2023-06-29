<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Product</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/product" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">

			

			<?php echo form_open_multipart(base_url().M_REWRITE.'admin/product/edit/'.safe_data($product['product_id']),array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Product Name <span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_name" value="<?php echo safe_data($product['product_name']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Product Slug</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_slug" value="<?php echo safe_data($product['product_slug']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Old Price </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_old_price" value="<?php echo safe_data($product['product_old_price']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Current Price <span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_current_price" value="<?php echo safe_data($product['product_current_price']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Stock <span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="product_stock" value="<?php echo safe_data($product['product_stock']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Content <span>*</span></label>
							<div class="col-sm-8">
								<textarea class="form-control editor" name="product_content"><?php echo safe_data($product['product_content']); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Short Content <span>*</span></label>
							<div class="col-sm-8">
								<textarea class="form-control h_80" name="product_content_short"><?php echo safe_data($product['product_content_short']); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Return Policy</label>
							<div class="col-sm-8">
								<textarea class="form-control editor" name="product_return_policy"><?php echo safe_data($product['product_return_policy']); ?></textarea>
							</div>
						</div>
						<div class="form-group">
				            <label for="" class="col-sm-3 control-label">Existing Photo *</label>
				            <div class="col-sm-8 pt_5">
				                <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($product['product_featured_photo']); ?>" alt="<?php echo safe_data($product['product_name']); ?>" class="existing-photo w_150">
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
								<input type="text" class="form-control" name="product_order" value="<?php echo safe_data($product['product_order']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Meta Title</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="meta_title" value="<?php echo safe_data($product['meta_title']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Meta Description</label>
							<div class="col-sm-8">
								<textarea class="form-control h_80" name="meta_description"><?php echo safe_data($product['meta_description']); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Language </label>
							<div class="col-sm-2">
								<select name="lang_id" class="form-control select2">
									<?php
									foreach($all_lang as $row)
									{
										?><option value="<?php echo safe_data($row['lang_id']); ?>" <?php if($product['lang_id'] == $row['lang_id']) {echo 'selected';} ?>><?php echo safe_data($row['lang_name']); ?></option><?php
									}
									?>
								</select>
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