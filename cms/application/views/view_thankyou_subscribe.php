<!--Banner Start-->
<div class="banner-slider" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_verify_subscriber']); ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?php echo safe_data(SUCCESS_SUBSCRIPTION); ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->

<div class="contact-area pt_60 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-form pt_50 pb_50 c_green tac fz_24">
                    <?php echo safe_data(SUCCESS_SUBSCRIPTION); ?>
                </div>
            </div>            
        </div>
    </div>
</div>