    <?php
    $CI =& get_instance();
    $CI->load->model('admin/Model_menu');

    $arr_menu = array();
    $all_menu = $CI->Model_menu->show();
    foreach($all_menu as $row)
    {
        $arr_menu[$row['menu_id']] = $row['menu_status'];
    }
    ?>


    <!--Call Start-->
    <?php if($setting['cta_status'] == 'Show'): ?>
    <div class="call-us" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['cta_background']); ?>)">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="call-text">
                        <h3><?php echo CALL_TO_ACTION_TEXT; ?></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="button">
                        <a href="<?php echo safe_data($setting['cta_button_url']); ?>"><?php echo CALL_TO_ACTION_BUTTON_TEXT; ?> <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!--Call End-->


    <!--Footer top start-->
    <div class="footer-area pt_30 pb_80">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column pt_50">
                    <h3><?php echo FOOTER_COL_1_HEADING; ?></h3>
                    <p><?php echo FOOTER_NEWSLETTER_TEXT; ?></p>
                    <?php echo form_open(base_url().M_REWRITE.'newsletter/send',array('class' => '')); ?>
                    <div class="content">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="<?php echo EMAIL_ADDRESS; ?>" name="email_subscribe" required>
                            <span class="input-group-btn">
                                <button class="btnme" type="submit" name="form_subscribe"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 footer-column pt_50">
                    <h3><?php echo FOOTER_COL_2_HEADING; ?></h3>
                    <ul>
                        <?php
                        $i=0;
                        foreach ($all_blogs as $blog) {
                            $i++;
                            if($i > $setting['footer_recent_blog_item']) {
                                break;
                            }
                            ?>
                            <li><a href="<?php echo base_url().M_REWRITE; ?>blog/<?php echo safe_data($blog['slug']); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo safe_data($blog['title']); ?></a></li>    
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 footer-column pt_50">
                    <h3><?php echo FOOTER_COL_3_HEADING; ?></h3>
                    <ul>
                        
                        <?php if($arr_menu[1] == 'Show'): ?>
                        <li><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                        <?php endif; ?>

                        <?php if($arr_menu[9] == 'Show'): ?>
                        <li><a href="<?php echo base_url().M_REWRITE; ?>terms-and-conditions"><?php echo TERMS_AND_CONDIITIONS; ?></a></li>
                        <?php endif; ?>

                        <?php if($arr_menu[10] == 'Show'): ?>
                        <li><a href="<?php echo base_url().M_REWRITE; ?>privacy-policy"><?php echo PRIVACY_POLICY; ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 footer-column pt_50">
                    <h3><?php echo FOOTER_COL_4_HEADING; ?></h3>
                    <div class="footer-address-item">
                        <div class="icon"><i class="fa fa-map-marker"></i></div>
                        <div class="text">
                            <span>
                                <?php echo FOOTER_ADDRESS; ?>
                            </span>
                        </div>
                    </div>
                    <div class="footer-address-item">
                        <div class="icon"><i class="fa fa-phone"></i></div>
                        <div class="text">
                            <span>
                                <?php echo FOOTER_PHONE; ?>
                            </span>
                        </div>
                    </div>
                    <div class="footer-address-item">
                        <div class="icon"><i class="fa fa-envelope-o"></i></div>
                        <div class="text">
                            <span>
                                <?php echo FOOTER_EMAIL; ?>
                            </span>
                        </div>
                    </div>
                    <div class="footer-social-list">
                        <ul>
                            <?php
                            foreach ($social as $row)
                            {
                                if($row['social_url']!='')
                                {
                                    echo '<li><a href="'.safe_data($row['social_url']).'"><i class="'.safe_data($row['social_icon']).'"></i></a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!--Footer top end-->

    <!--Footer bottom start-->
    <div class="footer-bottom-area pt_20 pb_20 text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php echo FOOTER_COPYRIGHT; ?>
                </div>
            </div>
        </div>
    </div>
    <!--Footer bottom end-->

    <!--Scroll-Top-->
    <div class="scroll-top">
        <div class="scroll"></div>
    </div>
    <!--Scroll-Top-->

    <script src="https://js.stripe.com/v2/"></script>
    <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
    <script>
        (function($) {
            "use strict";
            $(document).on('submit', '#stripe_form', function () {
                $('#submit-button').prop("disabled", true);
                $("#msg-container").hide();
                Stripe.card.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                    // name: $('.card-holder-name').val()
                }, stripeResponseHandler);
                return false;
            });
            Stripe.setPublishableKey('<?php echo safe_data($setting['stripe_public_key']); ?>');
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('#submit-button').prop("disabled", false);
                    $("#msg-container").html('<div class="c-red bdw-1 bds-s mt_10 mb_10 ml_0 mr_0 p_5"><strong>Error:</strong> ' + response.error.message + '</div>');
                    $("#msg-container").show();
                } else {
                    var form$ = $("#stripe_form");
                    var token = response['id'];
                    var net = response['net'];
                    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' /><input type='hidden' name='netPrice' value='" + net + "' />");
                    form$.get(0).submit();
                }
            }
        })(jQuery);
    </script>
</body>
</html>