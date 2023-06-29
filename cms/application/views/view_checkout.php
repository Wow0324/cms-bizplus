<?php
$CI =& get_instance();
$CI->load->model('Model_common');
$CI->load->model('Model_checkout');
?>

<!--banner area start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_shop']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo CHECKOUT; ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cart"><?php echo CART; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo CHECKOUT; ?></li>
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


<div class="page-content pt_80 pb_70 checkout-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 xs_mt_30 sm_mt_30 checkout-left">

                <div class="accordion" id="accordionCheckout">


                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <?php echo HAVE_A_COUPON; ?>
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionCheckout">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php echo form_open(base_url().M_REWRITE.'checkout',array('class' => '')); ?>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">
                                                    <input type="text" class="form-control" placeholder="<?php echo COUPON_CODE; ?>" name="coupon_code">
                                                </td>
                                                <td class="text-left">
                                                    <button type="submit" class="btn btn-primary btn-block" name="coupon_apply"><?php echo APPLY_COUPON; ?></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php echo form_close(); ?>
                                </div>                                
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <?php echo SHIPPING_INFORMATION; ?>
                            </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionCheckout">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="text-left table-top-bottom-no-border">
                                                    <?php echo form_open(base_url().M_REWRITE.'checkout',array('class' => '')); ?>
                                                    <?php
                                                    $i=0;
                                                    foreach ($shipping_data as $row) {
                                                        $i++;
                                                        if(!isset($_SESSION['shipping_id']))
                                                        {
                                                            if($i==1) {$chk='checked';} else {$chk='';}     
                                                        }
                                                        else
                                                        {
                                                            if($_SESSION['shipping_id'] == $row['shipping_id'])
                                                            {
                                                                $chk='checked';
                                                            }
                                                            else
                                                            {
                                                                $chk='';
                                                            }
                                                        }                                           
                                                        ?>
                                                        <div class="shipping-checkbox-container">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="shipping_id" id="shipping_radio_<?php echo safe_data($i); ?>" value="<?php echo safe_data($row['shipping_id']); ?>" <?php echo safe_data($chk); ?>>
                                                                <label class="form-check-label" for="shipping_radio_<?php echo safe_data($i); ?>">
                                                                    <div class="heading">
                                                                        <?php echo safe_data($row['shipping_name']); ?>
                                                                        ($<span class="shipping_price"><?php echo safe_data($row['shipping_cost']); ?>)</span>
                                                                    </div>
                                                                    <div class="subheading">(<?php echo nl2br($row['shipping_text']); ?>)</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <input type="submit" class="btn btn-primary" name="form_shipping" value="<?php echo APPLY_SHIPPING; ?>">
                                                    <?php echo form_close(); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12 xs_mt_30 sm_mt_30 checkout-right mt_40">
                <h4 class="heading-checkout-page"><?php echo CART_DETAIL; ?></h4>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <?php
                            $arr_cart_product_id = array();
                            $arr_cart_product_qty = array();

                            $i=0;
                            foreach($_SESSION['cart_product_id'] as $value)
                            {
                                $i++;
                                $arr_cart_product_id[$i] = $value;
                            }

                            $i=0;
                            foreach($_SESSION['cart_product_qty'] as $value)
                            {
                                $i++;
                                $arr_cart_product_qty[$i] = $value;
                            }

                            $tot1 = 0;
                            for($i=1;$i<=count($arr_cart_product_id);$i++)
                            {
                                $product_detail = $CI->Model_checkout->product_detail_by_id($arr_cart_product_id[$i]);
                                
                                $product_name = $product_detail['product_name'];
                                $product_slug = $product_detail['product_slug'];
                                $product_current_price = $product_detail['product_current_price'];
                                $product_featured_photo = $product_detail['product_featured_photo'];
                                
                                ?>
                                <tr>
                                    <td class="align-middle p_name">
                                        <?php echo safe_data($product_name); ?> x <?php echo safe_data($arr_cart_product_qty[$i]); ?>
                                    </td>
                                    <td class="align-middle p_price">
                                        <?php $subtotal = $product_current_price*$arr_cart_product_qty[$i]; ?>
                                        $<?php echo safe_data($subtotal); ?>
                                    </td>
                                </tr>
                                <?php
                                $tot1 = $tot1+$subtotal;
                            }
                            $_SESSION['subtotal'] = $tot1;
                            ?>
                            <tr>
                                <td class="text-left"><?php echo SUBTOTAL; ?> </td>
                                <td class="text-right">$<span class="subtotal_price"><?php echo safe_data($_SESSION['subtotal']); ?></span></td>
                            </tr>
                            <tr>
                                <td class="text-left"><?php echo COUPON; ?> <span class="font-weight-bold"><?php if(isset($_SESSION['coupon_code'])) {echo '('.$_SESSION['coupon_code'].')';} ?></span> </td>
                                <td class="text-right">
                                    <?php if(isset($_SESSION['coupon_amount'])): ?>
                                        $<span class="coupon_amount"><?php echo safe_data($_SESSION['coupon_amount']); ?></span>
                                    <?php else: ?>
                                        <?php $_SESSION['coupon_amount'] = 0; ?>
                                        $<span class="coupon_amount"><?php echo safe_data($_SESSION['coupon_amount']); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            
                            <?php if(isset($_SESSION['shipping_id'])): ?>
                            <tr>
                                <?php
                                $shipping_info = $CI->Model_checkout->shipping_detail($_SESSION['shipping_id']);
                                ?>
                                <td class="text-left"><?php echo SHIPPING_INFORMATION ?> <br>(<span class="font-weight-bold"><?php echo safe_data($shipping_info['shipping_name']); ?> - <?php echo safe_data($shipping_info['shipping_text']); ?></span>) </td>
                                <td class="text-right">
                                    $<span class=""><?php echo safe_data($_SESSION['shipping_cost']); ?></span>
                                </td>
                            </tr>
                            <?php endif; ?>

                            <tr>
                                <td class="text-left total_amount"><?php echo TOTAL; ?> </td>
                                <td class="text-right total_amount">
                                    <?php
                                    if(!isset($_SESSION['coupon_amount'])) {
                                        $_SESSION['coupon_amount'] = 0;
                                    }
                                    if(isset($_SESSION['shipping_cost'])) {
                                        $final_price = ($_SESSION['subtotal']+$_SESSION['shipping_cost'])-$_SESSION['coupon_amount'];
                                    }
                                    else
                                    {
                                        $final_price = $_SESSION['subtotal']-$_SESSION['coupon_amount'];
                                    }
                                    ?>
                                    $<span class="total_price"><?php echo safe_data($final_price); ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>


            <div class="col-md-12 xs_mt_30 sm_mt_30 checkout-left">
                
                <h4 class="heading-checkout-page mt_40"><?php echo BILLING_AND_SHIPPING_INFORMATION; ?></h4>

                <?php if(!isset($_SESSION['customer_id'])): ?>
                <?php echo form_open(base_url().M_REWRITE.'checkout',array('class' => '')); ?>
                    <div class="customer-info mb_30">                       
                        <div class="form-check mt_10 mb_10">
                            <input class="form-check-input" type="checkbox" id="returning_customer_action">
                            <label class="form-check-label" for="returning_customer_action">
                                <?php echo RETURNING_CUSTOMER_CLICK_LOGIN; ?>
                            </label>
                        </div>
                        <div class="returning-customer-login-section d_n">
                            <h4><?php echo LOGIN; ?></h4>
                            <div class="row mb_10">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="<?php echo EMAIL_ADDRESS; ?>" name="customer_email">
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control" placeholder="<?php echo PASSWORD; ?>" name="customer_password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="form_login_checkout"><?php echo LOGIN; ?></button>
                        </div>
                    </div>
                <?php echo form_close(); ?>
                <?php endif; ?>

                
                <?php if(isset($_SESSION['customer_id'])): ?>
                <div class="existing-customer-container">
                <h4><?php echo EXISTING_CUSTOMER; ?></h4>
                    <div class="row mb_30">
                        <div class="col">
                            <input type="text" class="form-control first_field" value="<?php echo safe_data($_SESSION['customer_name']); ?>" disabled>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control second_field" value="<?php echo safe_data($_SESSION['customer_email']); ?>" disabled>
                        </div>
                    </div>      
                </div>
                <?php endif; ?>


                <?php echo form_open(base_url().M_REWRITE.'checkout',array('class' => '')); ?>
                    <input type="hidden" name="ff__checkout" value="1">
                    <div class="billing-info">
                        <h4><?php echo BILLING_INFORMATION; ?></h4>
                        <div class="row mb_10">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo FULL_NAME; ?>" name="billing_name" value="<?php if(isset($_SESSION['billing_name'])) {echo safe_data($_SESSION['billing_name']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_name']); } ?>">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo EMAIL_ADDRESS; ?>" name="billing_email" value="<?php if(isset($_SESSION['billing_email'])) {echo safe_data($_SESSION['billing_email']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_email']); } ?>">
                            </div>
                        </div>
                        <div class="row mb_10">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo PHONE_NUMBER; ?>" name="billing_phone" value="<?php if(isset($_SESSION['billing_phone'])) {echo safe_data($_SESSION['billing_phone']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_phone']); } ?>">
                            </div>
                            <div class="col">
                                <select name="billing_country" class="form-control select2">
                                    <option value=""><?php echo SELECT_COUNTRY; ?></option>
                                    <?php
                                    foreach ($all_countries as $row) {
                                        ?><option value="<?php echo safe_data($row['country_name']); ?>" <?php if(isset($_SESSION['billing_country'])) {if($_SESSION['billing_country'] == $row['country_name']) {echo 'selected';}} else {if(isset($_SESSION['customer_id'])) {if($_SESSION['customer_country'] == $row['country_name']) {echo 'selected';}}} ?>><?php echo safe_data($row['country_name']); ?></option><?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb_10">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo ADDRESS; ?>" name="billing_address" value="<?php if(isset($_SESSION['billing_address'])) {echo safe_data($_SESSION['billing_address']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_address']); } ?>">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo STATE; ?>" name="billing_state" value="<?php if(isset($_SESSION['billing_state'])) {echo safe_data($_SESSION['billing_state']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_state']); } ?>">
                            </div>
                        </div>
                        <div class="row mb_10">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo CITY; ?>" name="billing_city" value="<?php if(isset($_SESSION['billing_city'])) {echo safe_data($_SESSION['billing_city']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_city']); } ?>">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo ZIP; ?>" name="billing_zip" value="<?php if(isset($_SESSION['billing_zip'])) {echo safe_data($_SESSION['billing_zip']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_zip']); } ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check mt_30 mb_10">
                        <input class="form-check-input" type="checkbox" id="click_shipping_same_check" name="name_click_shipping_same_check" <?php if(isset($_SESSION['name_click_shipping_same_check'])) {echo 'checked';} ?>>
                        <label class="form-check-label" for="click_shipping_same_check">
                            <?php echo SHIP_TO_DIFFERENT; ?>
                        </label>
                    </div>
                    
                    <div class="shipping-info mt_15 <?php if(isset($_SESSION['shipping_name'])) {echo 'd_b';} else { echo 'd_n';} ?>">
                        <h4><?php echo SHIPPING_INFORMATION; ?></h4>
                        <div class="row mb_10">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo FULL_NAME; ?>" name="shipping_name" value="<?php if(isset($_SESSION['shipping_name'])) {echo safe_data($_SESSION['shipping_name']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_name']); } ?>">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo EMAIL_ADDRESS; ?>" name="shipping_email" value="<?php if(isset($_SESSION['shipping_email'])) {echo safe_data($_SESSION['shipping_email']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_email']); } ?>">
                            </div>
                        </div>
                        <div class="row mb_10">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo PHONE_NUMBER; ?>" name="shipping_phone" value="<?php if(isset($_SESSION['shipping_phone'])) {echo safe_data($_SESSION['shipping_phone']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_phone']); } ?>">
                            </div>
                            <div class="col">
                                <select name="shipping_country" class="form-control select2">
                                    <option value=""><?php echo SELECT_COUNTRY; ?></option>
                                    <?php
                                    foreach ($all_countries as $row) {
                                        ?><option value="<?php echo safe_data($row['country_name']); ?>" <?php if(isset($_SESSION['customer_id'])) {if($_SESSION['customer_country'] == $row['country_name']) {echo 'selected';}} else {if(isset($_SESSION['shipping_country'])) {if($_SESSION['shipping_country'] == $row['country_name']) {echo 'selected';}}} ?>><?php echo safe_data($row['country_name']); ?></option><?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb_10">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo ADDRESS; ?>" name="shipping_address" value="<?php if(isset($_SESSION['shipping_address'])) {echo safe_data($_SESSION['shipping_address']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_address']); } ?>">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo STATE; ?>" name="shipping_state" value="<?php if(isset($_SESSION['shipping_state'])) {echo safe_data($_SESSION['shipping_state']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_state']); } ?>">
                            </div>
                        </div>
                        <div class="row mb_10">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo CITY; ?>" name="shipping_city" value="<?php if(isset($_SESSION['shipping_city'])) {echo safe_data($_SESSION['shipping_city']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_city']); } ?>">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="<?php echo ZIP; ?>" name="shipping_zip" value="<?php if(isset($_SESSION['shipping_zip'])) {echo safe_data($_SESSION['shipping_zip']);} elseif(isset($_SESSION['customer_id'])) {echo safe_data($_SESSION['customer_zip']); } ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row mb_10">
                        <div class="col">
                            <textarea name="order_note" class="form-control h-100" cols="30" rows="10" placeholder="<?php echo ORDER_NOTES; ?>"><?php if(isset($_SESSION['order_note'])) {echo safe_data($_SESSION['order_note']);} ?></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="form_continue_payment"><?php echo CONTINUE_TO_PAYMENT; ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<script>
(function($) {
    
    "use strict";
    
    $(document).ready(function() {
        $("#click_shipping_same_check").on('change',function(e) {
            e.preventDefault();
            if($(this).prop("checked") == true){
                $('.shipping-info').attr('class','shipping-info mt_15 d_b');
            } else {
                $('.shipping-info').attr('class','shipping-info mt_15 d_n');
            }
        });

        $("#returning_customer_action").on('change',function(e) {
            e.preventDefault();
            if($(this).prop("checked") == true){
                $('.returning-customer-login-section').attr('class','returning-customer-login-section d_b');
            } else {
                $('.returning-customer-login-section').attr('class','returning-customer-login-section d_n');
            }
        });
        
        $("#coupon_parent").on('change',function(e) {
            e.preventDefault();
            if($(this).prop("checked") == true){
                $('.coupon_child').attr('class','coupon_child d_b');
            } else {
                $('.coupon_child').attr('class','coupon_child d_n');
            }
        });
    });

})(jQuery);
</script>