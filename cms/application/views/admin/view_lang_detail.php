<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Language Detail</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/lang" class="btn btn-primary btn-sm">View All</a>
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
	        <?php
			$i=0;
			foreach ($lang_detail as $row) {
				$arr1[$i] = $row['lang_key_id'];
				$arr2[$i] = $row['lang_key'];
				$arr3[$i] = $row['lang_value'];
				$i++;
			}
			?>
	        <div class="box box-info">
	            <div class="box-body">
					<?php echo form_open(base_url().'admin/lang/detail/'.$id,array('class' => 'form-horizontal')); ?>
			        <div class="box box-info">
			            <div class="box-body">
			            	<?php for($i=0;$i<count($arr1);$i++): ?>
			                <div class="form-group mb_30">
				                    <label for="" class="col-sm-6 text-right pt_10"><?php echo safe_data($arr2[$i]); ?></label>
			                    <div class="col-sm-6">
			                    	<textarea name="new_arr[]" class="form-control h_60" cols="30" rows="10"><?php echo safe_data($arr3[$i]); ?></textarea>
			                    </div>
			                </div>
			                <input type="hidden" name="new_arr1[]" value="<?php echo safe_data($arr1[$i]); ?>">
			                <input type="hidden" name="id" value="<?php echo safe_data($id); ?>">
			            	<?php endfor; ?>
			                <div class="form-group">
			                    <div class="col-sm-12">
			                      <button type="submit" class="btn btn-success btn-block pull-left" name="form1">Update</button>
			                    </div>
			                </div>
			            </div>
			        </div>
			        <?php echo form_close(); ?>
	            </div>
	        </div>
	    </div>
  	</div>
</section>