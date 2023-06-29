<?php
if(!$this->session->userdata('customer_id')) {
    redirect(base_url());
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
                        <h1><?php echo EDIT_PROFILE; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->


<div class="dashboard-content pt_80 pb_80">
    <div class="container">
        <div class="row move-dashboard">
            <div class="col-lg-3 col-md-12 mb_40">
                <div class="move-sidebar">
                    <?php
                        $this->load->view ('view_customer_sidebar');
                    ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
               <div class="dashboard-body">
                <h3 class="mb_30"><?php echo EDIT_PROFILE; ?></h3>
                    <div class="tab-panels">
                        <?php echo form_open(base_url().M_REWRITE.'customer/profile_edit',array('class' => 'contact-form')); ?>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><?php echo NAME; ?>*</label>
                                    <input type="text" class="form-control" name="customer_name" value="<?php echo safe_data($this->session->userdata('customer_name')); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><?php echo EMAIL_ADDRESS; ?>*</label>
                                    <input type="text" class="form-control" name="" value="<?php echo safe_data($this->session->userdata('customer_email')); ?>" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><?php echo PHONE_NUMBER; ?>*</label>
                                    <input type="text" class="form-control" name="customer_phone" value="<?php echo safe_data($this->session->userdata('customer_phone')); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><?php echo COUNTRY; ?> *</label>
                                    <select name="customer_country" class="form-control">
                                        <?php
                                        foreach($all_country as $row)
                                        {
                                            ?><option value="<?php echo safe_data($row['country_name']); ?>"  <?php if($row['country_name'] == $_SESSION['customer_country']) {echo 'selected';} ?>><?php echo safe_data($row['country_name']); ?></option><?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><?php echo ADDRESS; ?></label>
                                    <textarea name="customer_address" class="form-control h_120" cols="30" rows="10"><?php echo safe_data($this->session->userdata('customer_address')); ?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><?php echo STATE; ?></label>
                                    <input type="text" class="form-control" name="customer_state" value="<?php echo safe_data($this->session->userdata('customer_state')); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><?php echo CITY; ?></label>
                                    <input type="text" class="form-control" name="customer_city" value="<?php echo safe_data($this->session->userdata('customer_city')); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><?php echo ZIP; ?></label>
                                    <input type="text" class="form-control" name="customer_zip" value="<?php echo safe_data($this->session->userdata('customer_zip')); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><?php echo PASSWORD; ?></label>
                                    <input type="password" class="form-control" name="customer_password">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><?php echo RETYPE_PASSWORD; ?></label>
                                    <input type="password" class="form-control" name="customer_re_password">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary my-btn" name="form1"><?php echo UPDATE_PROFILE; ?></button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>