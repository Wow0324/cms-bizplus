<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().M_REWRITE.'admin/login');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Videos</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url().M_REWRITE; ?>admin/video/add" class="btn btn-primary btn-sm">Add New</a>
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
			        <th>Video Preview</th>
                    <th>Video Caption</th>
                    <th>Video Type</th>
                    <th>Language</th>
			        <th>Action</th>
			    </tr>
			</thead>
            <tbody>

            	<?php
            	$i=0;
            	foreach ($video as $row) {
            		$i++;
	            	?>
	                <tr>
	                    <td><?php echo safe_data($i); ?></td>
	                    <td>
                            <?php if($row['video_type'] == 'YouTube'): ?>
                                <div class="iframe-thumb">
	                               <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo safe_data($row['video_code']); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                               </div>
                            <?php else: ?>
                                <div class="iframe-thumb">
                                    <iframe src="https://player.vimeo.com/video/<?php echo safe_data($row['video_code']); ?>?title=0&byline=0" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                </div>
                            <?php endif; ?>
	                    </td>
                        <td>
                            <?php echo safe_data($row['video_caption']); ?>
                        </td>
                        <td>
                            <?php echo safe_data($row['video_type']); ?>
                        </td>
                        <td>
                            <?php echo safe_data($row['lang_name']); ?>
                        </td>
	                    <td>
	                        <a href="<?php echo base_url().M_REWRITE; ?>admin/video/edit/<?php echo safe_data($row['video_id']); ?>" class="btn btn-primary btn-xs">Edit</a>
                            <a href="<?php echo base_url().M_REWRITE; ?>admin/video/delete/<?php echo safe_data($row['video_id']); ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a> 
	                    </td>
	                </tr>
	                <?php
            	}
            	?>
            </tbody>
          </table>
        </div>
      </div> 

</section>