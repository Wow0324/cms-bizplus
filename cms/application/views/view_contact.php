<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_contact']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($page_contact['contact_heading']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($page_contact['contact_heading']); ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Contact Start-->
<div class="contact-address-area pt_20 pb_40 bgf6">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-sm-12 mb_40">
                <div class="add-item">
                    <div class="add-icon text-center">
                        <i class="fa fa-mobile" aria-hidden="true"></i>
                    </div>
                    <div class="add-text">
                        <h3 class="contact-title"><?php echo PHONE_NUMBER; ?></h3>
                        <span><?php echo safe_data(nl2br($page_contact['contact_phone'])); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-sm-12 mb_40">
                <div class="add-item">
                    <div class="add-icon">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </div>
                    <div class="add-text">
                        <h3 class="contact-title"><?php echo EMAIL_ADDRESS; ?></h3>
                        <span><?php echo safe_data(nl2br($page_contact['contact_email'])); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-sm-12 mb_40">
                <div class="add-item">
                    <div class="add-icon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div class="add-text">
                        <h3 class="contact-title"><?php echo ADDRESS; ?></h3>
                        <span><?php echo safe_data(nl2br($page_contact['contact_address'])); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-area pt_70 pb_80">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="headline pb_30">
                    <h1><?php echo CONTACT_FORM; ?></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open(base_url().M_REWRITE.'contact/send_email',array('class' => '')); ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="contact-form">
                                <div class="form-item">
                                    <input type="text" name="name" placeholder="<?php echo NAME; ?>">
                                </div>
                                <div class="form-item">
                                    <input type="text" name="email" placeholder="<?php echo EMAIL_ADDRESS; ?>">
                                </div>
                                <div class="form-item">
                                    <input type="text" name="phone" placeholder="<?php echo PHONE_NUMBER; ?>">
                                </div>
                                <div class="form-item">
                                    <input type="text" name="subject" placeholder="<?php echo SUBJECT; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="contact-form">
                                <div class="massege-item">
                                    <textarea name="message" placeholder="<?php echo MESSAGE; ?>"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <div class="submit-me">
                                <input name="form_contact" class="btn btn-primary quote-btn submit" type="submit" value="<?php echo SEND_MESSAGE; ?>">
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>