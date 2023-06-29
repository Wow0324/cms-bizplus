<?php
if($this->session->userdata('customer_id')) {
    redirect(base_url().M_REWRITE.'customer/dashboard');
}
?>

<!--Banner Start-->
<div class="banner-slider h_150" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_customer_section']); ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?php echo CUSTOMER_RESET_PASSWORD; ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->

<div class="contact-area pt_60 pb_90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="contact-form headstyle user-login-tab pt_0">
                    
                    <?php
                    if($this->session->flashdata('success')) {
                        echo '<div class="success-class mt_10">'.$this->session->flashdata('success').'</div>';
                    }
                    ?>

                    <a href="<?php echo base_url().M_REWRITE; ?>customer/login" class="c_red"><?php echo GO_TO_LOGIN_PAGE; ?></a>                   
                   
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>