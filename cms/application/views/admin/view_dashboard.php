<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>
<section class="content-header">
    <div class="content-header-left">
        <h1>Dashboard</h1>
    </div>
</section>

<section class="content">

    <div class="row">

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-bg"></div>
                <div class="info-box-content">
                    <span class="info-box-text">Total Blog Categories</span>
                    <span class="info-box-number"><?php echo safe_data($total_category); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-bg"></div>
                <div class="info-box-content">
                    <span class="info-box-text">Total Blog</span>
                    <span class="info-box-number"><?php echo safe_data($total_blog); ?></span>
                </div>
            </div>
        </div>
   
    
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-bg"></div>
                <div class="info-box-content">
                    <span class="info-box-text">Total Team Members</span>
                    <span class="info-box-number"><?php echo safe_data($total_team_member); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-bg"></div>
                <div class="info-box-content">
                    <span class="info-box-text">Total Services</span>
                    <span class="info-box-number"><?php echo safe_data($total_service); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-bg"></div>
                <div class="info-box-content">
                    <span class="info-box-text">Total Testimonials</span>
                    <span class="info-box-number"><?php echo safe_data($total_testimonial); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-bg"></div>
                <div class="info-box-content">
                    <span class="info-box-text">Total Photos (Gallery)</span>
                    <span class="info-box-number"><?php echo safe_data($total_photo); ?></span>
                </div>
            </div>
        </div>


    </div>


</section>