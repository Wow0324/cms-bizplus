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
                    if($this->session->flashdata('error')) {
                        echo '<div class="error-class mt_10">'.$this->session->flashdata('error').'</div>';
                    }
                    if($this->session->flashdata('success')) {
                        echo '<div class="success-class mt_10">'.$this->session->flashdata('success').'</div>';
                    }
                    ?>

                    <ul class="nav nav-tabs mt_15" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#patientLogin" role="tab"><?php echo CUSTOMER_RESET_PASSWORD; ?></a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="patientLogin" role="tabpanel">
                            <?php echo form_open(base_url().M_REWRITE.'customer/reset-password/'.$var1.'/'.$var2,array('class' => '')); ?>
                                <div class="form-row row mt_20">
                                    <div class="form-group col-12">
                                        <input class="form-control" placeholder="<?php echo NEW_PASSWORD; ?>" name="new_password" type="password" autocomplete="off" required>
                                    </div>
                                    <div class="form-group col-12">
                                        <input class="form-control" placeholder="<?php echo RETYPE_PASSWORD; ?>" name="re_password" type="password" autocomplete="off" required>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn" name="form1"><?php echo SUBMIT; ?></button>
                                        <a href="<?php echo base_url().M_REWRITE; ?>customer/login" class="btn fp"><?php echo GO_TO_LOGIN_PAGE; ?></a>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                   
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>