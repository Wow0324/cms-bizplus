<!--banner area start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_shop']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo PAYMENT; ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cart"><?php echo CART; ?></a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>checkout"><?php echo CHECKOUT; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo PAYMENT; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--banner area end-->


<div class="page-content pt_80 pb_70 payment-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 xs_mt_30 sm_mt_30">
                <?php
                if(isset($_SESSION['shipping_cost'])) {
                    $final_price = ($_SESSION['subtotal']+$_SESSION['shipping_cost'])-$_SESSION['coupon_amount'];
                }
                else
                {
                    $final_price = $_SESSION['subtotal']-$_SESSION['coupon_amount'];
                }
                ?>          
                <div class="billing-info mb_30">
                    <h4><?php echo MAKE_PAYMENT; ?></h4>
                    <div class="row mb_10">
                        <div class="col-md-5">
                            <select name="payment_method" class="form-control" id="paymentMethodChange">
                                <option value=""><?php echo SELECT_PAYMENT_METHOD; ?></option>
                                <option value="PayPal"><?php echo PAYPAL; ?></option>
                                <option value="Stripe"><?php echo STRIPE; ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                    
                <div class="paypal">
                    <h4><?php echo PAY_WITH_PAYPAL; ?></h4>

                    <?php echo form_open(base_url().M_REWRITE.'payment/paypal',array('id'=>'paypal_form','class' => 'paypal')); ?>
                    <input type="hidden" name="amount" value="<?php echo safe_data($final_price); ?>">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="no_note" value="1">
                    <input type="hidden" name="lc" value="UK">
                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">
                    <div id="showPaypalField">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary my-btn mt_10" name="form_paypal"><?php echo PAY_NOW; ?></button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>
                <div class="stripe">
                    <h4><?php echo PAY_WITH_STRIPE; ?></h4>
                    <?php echo form_open(base_url().M_REWRITE.'payment/stripe',array('id'=>'stripe_form','class' => 'contact-form')); ?>
                    <input type="hidden" name="payment" value="posted">
                    <input type="hidden" name="amount" value="<?php echo safe_data($final_price); ?>">
                    <div class="row mb_10">
                        <div class="col-md-6">
                            <input type="text" name="card_number" class="form-control card-number" placeholder="<?php echo CARD_NUMBER; ?>" required>
                        </div>
                    </div>
                    <div class="row mb_10">
                        <div class="col-md-6">
                            <input type="text" name="card_cvc" class="form-control card-cvc" placeholder="<?php echo CARD_CVC_NO; ?>" required>
                        </div>
                    </div>
                    <div class="row mb_10">
                        <div class="col-md-6">
                            <input type="text" name="card_expiry_month" class="form-control card-expiry-month" placeholder="<?php echo CARD_EXPIRY_MONTH; ?>" required>
                        </div>
                    </div>
                    <div class="row mb_10">
                        <div class="col-md-6">
                            <input type="text" name="card_expiry_year" class="form-control card-expiry-year" placeholder="<?php echo CARD_EXPIRY_YEAR; ?>" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit-button" name="form_stripe"><?php echo PAY_NOW; ?></button>
                    <div id="msg-container"></div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
(function($) {
    "use strict";
    $(document).ready(function() {
        $('.paypal').hide();
        $('.stripe').hide();
        $('#paymentMethodChange').on('change',function() {
            if($('#paymentMethodChange').val() == 'PayPal') {
                $('.paypal').show();
                $('.stripe').hide();
            } else if($('#paymentMethodChange').val() == 'Stripe') {
                $('.paypal').hide();
                $('.stripe').show();
            } else if($('#paymentMethodChange').val() == '') {
                $('.paypal').hide();
                $('.stripe').hide();
            }
        });
    });
})(jQuery);
</script>