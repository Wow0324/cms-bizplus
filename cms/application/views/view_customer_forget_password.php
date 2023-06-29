<?php
if($this->session->userdata('customer_id')) {
    redirect(base_url().M_REWRITE.'customer/dashboard');
}
?>

<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_customer_section']); ?>)">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo CUSTOMER_RESET_PASSWORD; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<div id="login" class="pb_80">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12 forgot-box mt_80">
                    <?php echo form_open(base_url().M_REWRITE.'customer/forget-password',array('class' => 'form')); ?>
                        <h3 class="text-center mt_30"><?php echo CUSTOMER_RESET_PASSWORD; ?></h3>
                        <div class="form-group">
                            <label for="username" class="text-information"><?php echo EMAIL_ADDRESS; ?>:</label><br>
                            <input type="text" name="customer_email" class="form-control" placeholder="<?php echo EMAIL_ADDRESS; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="form1" class="btn btn-info btn-md log" value="<?php echo SUBMIT; ?>">
                        </div>
                        <div class="reg text-color">
                            <a href="<?php echo base_url().M_REWRITE; ?>customer/login"><?php echo BACK_TO_PREVIOUS; ?></a>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>