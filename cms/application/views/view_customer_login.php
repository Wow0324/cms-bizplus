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
                        <h1><?php echo CUSTOMER_LOGIN; ?></h1>
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
                    <?php echo form_open(base_url().M_REWRITE.'customer/login',array('class' => 'form')); ?>
                        <div class="form-group">
                            <label for="" class="text-information"><?php echo EMAIL_ADDRESS; ?></label><br>
                            <input type="text" name="customer_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="text-information"><?php echo PASSWORD; ?></label><br>
                            <input type="password" name="customer_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <a class="black-color" href="<?php echo base_url().M_REWRITE; ?>customer/forget-password"><?php echo FORGET_PASSWORD; ?></a>
                        </div>
                        <div class="form-group mb_55">
                            <input type="submit" name="form_login" class="btn btn-info btn-md log" value="<?php echo LOGIN; ?>"><br>
                        </div>
                        <div id="register-link" class="text-right regi mb_35">
                            <a href="<?php echo base_url().M_REWRITE; ?>customer/registration" class="text-info text-color"><?php echo MAKE_REGISTRATION; ?></a><br>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

