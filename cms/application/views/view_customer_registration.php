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
                        <h1><?php echo CUSTOMER_REGISTRATION; ?></h1>
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
                <div id="login-box" class="col-md-12 mt_80 pt_20">
                    <?php echo form_open(base_url().M_REWRITE.'customer/registration',array('class' => 'form')); ?>
                        <div class="form-group">
                            <label for="" class="text-information"><?php echo NAME; ?></label><br>
                            <input type="text" name="customer_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="text-information"><?php echo EMAIL_ADDRESS; ?></label><br>
                            <input type="text" name="customer_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="text-information"><?php echo PHONE_NUMBER; ?></label><br>
                            <input type="text" name="customer_phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="text-information"><?php echo PASSWORD; ?></label><br>
                            <input type="password" name="customer_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="text-information"><?php echo RETYPE_PASSWORD; ?></label><br>
                            <input type="password" name="customer_re_password" class="form-control">
                        </div>
                        <div class="form-group mb_55">
                            <input type="submit" name="form_registration" class="btn btn-info btn-md log" value="<?php echo REGISTRATION; ?>"><br>
                        </div>
                        <div id="register-link" class="text-right regi mb_35">
                            <a href="<?php echo base_url().M_REWRITE; ?>customer/login" class="text-info text-color"><?php echo GO_TO_LOGIN_PAGE; ?></a><br>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

