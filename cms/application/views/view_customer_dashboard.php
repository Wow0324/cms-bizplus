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
                        <h1><?php echo CUSTOMER_DASHBOARD; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Dashboard start-->
<div class="dashboard-content pt_80 pb_80">
    <div class="container">
        <div class="row move-dashboard">
            <div class="col-lg-3 col-md-12">
                <div class="move-sidebar">
                    <?php $this->load->view ('view_customer_sidebar'); ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">

                <div class="dashboard-body">
                    <h3><?php echo WELCOME_TO_DASHBOARD; ?></h3>                   
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td><?php echo NAME; ?></td>
                                <td><?php echo safe_data($this->session->userdata('customer_name')); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo EMAIL_ADDRESS; ?></td>
                                <td><?php echo safe_data($this->session->userdata('customer_email')); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo PHONE_NUMBER; ?></td>
                                <td><?php echo safe_data($this->session->userdata('customer_phone')); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo COUNTRY; ?></td>
                                <td><?php echo safe_data($this->session->userdata('customer_country')); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ADDRESS; ?></td>
                                <td><?php echo nl2br($this->session->userdata('customer_address')); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo STATE; ?></td>
                                <td><?php echo safe_data($this->session->userdata('customer_state')); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo CITY; ?></td>
                                <td><?php echo safe_data($this->session->userdata('customer_city')); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ZIP; ?></td>
                                <td><?php echo safe_data($this->session->userdata('customer_zip')); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard end-->