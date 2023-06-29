<?php
if(!$this->session->userdata('customer_id')) {
    redirect(base_url());
}

$CI =& get_instance();
$CI->load->model('Model_customer');
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

<div class="dashboard-content pt_80 pb_80">
    <div class="container">
        <div class="row move-dashboard">
            <div class="col-lg-3 col-md-12 mb_40">
                <div class="move-sidebar">
                    <?php $this->load->view ('view_customer_sidebar'); ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="dashboard-body">
                    <h3><?php echo ORDER_HISTORY; ?></h3>
                    <div class="well mt_30">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo SERIAL; ?></th>
                                    <th><?php echo ORDER_NUMBER; ?></th>
                                    <th><?php echo PAID_AMOUNT; ?></th>
                                    <th><?php echo PAYMENT_METHOD; ?></th>
                                    <th><?php echo PAYMENT_STATUS; ?></th>
                                    <th><?php echo ACTION; ?></th>
                                </tr>
                            </thead>
                            <tbody class="history-table">
                                <?php
                                $i=0;
                                foreach($orders as $row)
                                {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo safe_data($i); ?></td>
                                        <td><?php echo safe_data($row['order_no']); ?></td>
                                        <td><?php echo safe_data($row['paid_amount']); ?></td>
                                        <td><?php echo safe_data($row['payment_method']); ?></td>
                                        <td><?php echo safe_data($row['payment_status']); ?></td>
                                        <td>
                                            <a href="" class="btn btn-primary action-me w-100" data-toggle="modal" data-target="#view_details_<?php echo safe_data($i); ?>"><?php echo VIEW_DETAIL; ?></a>

                                            <!-- Modal for edit-->
                                            <div class="modal fade" id="view_details_<?php echo safe_data($i); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo VIEW_DETAIL; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6 class="font-weight-bold mb_5"><?php echo ORDER_DETAIL; ?></h6>
                                                            <div class="table-responsive">
                                                                <table class="table table-sm w-100-p">
                                                                    <tr>
                                                                        <td class="alert-warning w-200"><?php echo ORDER_NUMBER; ?></td>
                                                                        <td><?php echo safe_data($row['order_no']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo PAYMENT_DATE_TIME; ?></td>
                                                                        <td><?php echo safe_data($row['payment_date_time']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo SHIPPING_COST; ?></td>
                                                                        <td>$<?php echo safe_data($row['shipping_cost']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo COUPON_CODE; ?></td>
                                                                        <td><?php echo safe_data($row['coupon_code']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo COUPON_DISCOUNT; ?></td>
                                                                        <td>$<?php echo safe_data($row['coupon_discount']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo PAID_AMOUNT; ?></td>
                                                                        <td>$<?php echo safe_data($row['paid_amount']); ?></td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td class="alert-warning w-200"><?php echo CUSTOMER_TYPE; ?></td>
                                                                        <td><?php echo safe_data($row['customer_type']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning w_150"><?php echo NAME; ?></td>
                                                                        <td><?php echo safe_data($row['customer_name']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo EMAIL_ADDRESS; ?></td>
                                                                        <td><?php echo safe_data($row['customer_email']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo PAYMENT_METHOD; ?></td>
                                                                        <td><?php echo safe_data($row['payment_method']); ?></td>
                                                                    </tr>


                                                                    <?php if($row['payment_method'] == 'Stripe'): ?>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo CARD_NUMBER; ?></td>
                                                                        <td><?php echo safe_data($row['card_number']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo CARD_CVC_NO; ?></td>
                                                                        <td><?php echo safe_data($row['card_cvc']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo CARD_EXPIRY_MONTH; ?></td>
                                                                        <td><?php echo safe_data($row['card_expiry_month']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo CARD_EXPIRY_YEAR; ?></td>
                                                                        <td><?php echo safe_data($row['card_expiry_year']); ?></td>
                                                                    </tr>
                                                                    <?php endif; ?>

                                                                    <?php if($row['payment_status'] == 'Bank'): ?>
                                                                    <tr>
                                                                        <td class="alert-warning">Bank Information</td>
                                                                        <td><?php echo safe_data(nl2br($row['bank_information'])); ?></td>
                                                                    </tr>
                                                                    <?php endif; ?>

                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo PAYMENT_STATUS; ?></td>
                                                                        <td>
                                                                            <?php if($row['payment_status'] == 'Completed'): ?>
                                                                            <a href="javascript:void;" class="btn btn-success btn-sm"><?php echo safe_data($row['payment_status']); ?></a>
                                                                            <?php else: ?>
                                                                            <a href="javascript:void;" class="btn btn-danger btn-sm"><?php echo safe_data($row['payment_status']); ?></a>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>


                                                            <h6 class="font-weight-bold mt_20 mb_5"><?php echo BILLING_INFORMATION; ?></h6>
                                                            <div class="table-responsive">
                                                                <table class="table table-sm w-100-p">
                                                                    <tr>
                                                                        <td class="alert-warning w-200"><?php echo NAME; ?></td>
                                                                        <td><?php echo safe_data($row['billing_name']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo EMAIL_ADDRESS; ?></td>
                                                                        <td><?php echo safe_data($row['billing_email']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo PHONE_NUMBER; ?></td>
                                                                        <td><?php echo safe_data($row['billing_phone']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo COUNTRY; ?></td>
                                                                        <td><?php echo safe_data($row['billing_country']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo ADDRESS; ?></td>
                                                                        <td><?php echo safe_data($row['billing_address']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo STATE; ?></td>
                                                                        <td><?php echo safe_data($row['billing_state']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo CITY; ?></td>
                                                                        <td><?php echo safe_data($row['billing_city']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo ZIP; ?></td>
                                                                        <td><?php echo safe_data($row['billing_zip']); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </div>



                                                            <h6 class="font-weight-bold mt_20 mb_5"><?php echo SHIPPING_INFORMATION; ?></h6>
                                                            <div class="table-responsive">
                                                                <table class="table table-sm w-100-p">
                                                                    <tr>
                                                                        <td class="alert-warning w-200"><?php echo NAME; ?></td>
                                                                        <td><?php echo safe_data($row['shipping_name']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo EMAIL_ADDRESS; ?></td>
                                                                        <td><?php echo safe_data($row['shipping_email']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo PHONE_NUMBER; ?></td>
                                                                        <td><?php echo safe_data($row['shipping_phone']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo COUNTRY; ?></td>
                                                                        <td><?php echo safe_data($row['shipping_country']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo ADDRESS; ?></td>
                                                                        <td><?php echo safe_data($row['shipping_address']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo STATE; ?></td>
                                                                        <td><?php echo safe_data($row['shipping_state']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo CITY; ?></td>
                                                                        <td><?php echo safe_data($row['shipping_city']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="alert-warning"><?php echo ZIP; ?></td>
                                                                        <td><?php echo safe_data($row['shipping_zip']); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </div>


                                                            <h6 class="font-weight-bold mt_20 mb_5"><?php echo PRODUCT_INFORMATION; ?></h6>
                                                            <div class="table-responsive">
                                                                <table class="table table-sm w-100-p">
                                                                    <tr>
                                                                        <th><?php echo SERIAL; ?></th>
                                                                        <th><?php echo PRODUCT_NAME; ?></th>
                                                                        <th><?php echo PRODUCT_PRICE; ?></th>
                                                                        <th><?php echo QUANTITY; ?></th>
                                                                        <th><?php echo SUBTOTAL; ?></th>
                                                                    </tr>
                                                                    <?php
                                                                        $j=0;
                                                                        $order_det = $CI->Model_customer->order_detail_by_order_id($row['id']);
                                                                        foreach ($order_det as $row1) {
                                                                            $j++;
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo safe_data($j); ?></td>
                                                                                <td><?php echo safe_data($row1['product_name']); ?></td>
                                                                                <td>$<?php echo safe_data($row1['product_price']); ?></td>
                                                                                <td><?php echo safe_data($row1['product_qty']); ?></td>
                                                                                <td>
                                                                                    <?php
                                                                                    $s_total = $row1['product_price']*$row1['product_qty'];
                                                                                    echo '$'.safe_data($s_total);
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                </table>
                                                            </div>




                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/ Modal -->
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>