<?php
$CI =& get_instance();
$CI->load->model('Model_common');
$CI->load->model('Model_cart');
?>

<!--banner area start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_shop']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo CART; ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo CART; ?></li>
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


<div class="page-content pt_80 pb_70 cart-page">
    <div class="container">
        <div class="row cart">
            <div class="col-md-12 xs_mt_30 sm_mt_30">
                <?php if(!isset($_SESSION['cart_product_id'])): ?>
                <?php echo CART_EMPTY; ?>
                <?php else: ?>
                    <?php echo form_open(base_url().M_REWRITE.'cart',array('class' => '')); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-info">
                                    <th><?php echo SERIAL; ?></th>
                                    <th><?php echo THUMBNAIL; ?></th>
                                    <th><?php echo PRODUCT_NAME; ?></th>
                                    <th><?php echo UNIT_PRICE; ?></th>
                                    <th><?php echo QUANTITY; ?></th>
                                    <th><?php echo SUBTOTAL; ?></th>
                                    <th><?php echo ACTION; ?></th>
                                </tr>
                            </thead>
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
                                    $product_detail = $this->Model_cart->product_detail_by_id($arr_cart_product_id[$i]);
                                    
                                    $product_name = $product_detail['product_name'];
                                    $product_slug = $product_detail['product_slug'];
                                    $product_current_price = $product_detail['product_current_price'];
                                    $product_featured_photo = $product_detail['product_featured_photo'];

                                    ?>
                                    <input type="hidden" name="product_id[]" value="<?php echo safe_data($arr_cart_product_id[$i]); ?>">
                                    <input type="hidden" name="product_name[]" value="<?php echo safe_data($product_name); ?>">
                                    <tr>
                                        <td><?php echo safe_data($i); ?></td>
                                        <td class="align-middle"><img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($product_featured_photo); ?>"></td>
                                        <td class="align-middle">
                                            <a href="<?php echo base_url().M_REWRITE; ?>product/view/<?php echo safe_data($product_slug); ?>" class="cart-product-name"><?php echo safe_data($product_name); ?></a>
                                        </td>
                                        <td class="align-middle">$<?php echo safe_data($product_current_price); ?></td>
                                        <td class="align-middle">
                                            <input type="number" class="form-control cart-qty-input" name="product_qty[]" step="1" min="1" max="" pattern="" pattern="[0-9]*" inputmode="numeric" value="<?php echo safe_data($arr_cart_product_qty[$i]); ?>">
                                        </td>
                                        <td class="align-middle">
                                            <?php $subtotal = $product_current_price*$arr_cart_product_qty[$i]; ?>
                                            $<?php echo safe_data($subtotal); ?>
                                        </td>
                                        <td class="align-middle">
                                            <a onClick="return confirm('<?php echo ARE_YOU_SURE; ?>');" href="<?php echo base_url().M_REWRITE; ?>cart/delete/<?php echo safe_data($arr_cart_product_id[$i]); ?>" class="btn btn-xs btn-danger cart-btn-delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $tot1 = $tot1+$subtotal;
                                }
                                ?>
                                <tr>
                                    <td colspan="5" class="text-right"><?php echo TOTAL; ?>: </td>
                                    <td colspan="2">$<span class="update_subtotal"><?php echo safe_data($tot1); ?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-buttons">
                        <a href="<?php echo base_url().M_REWRITE; ?>shop" class="btn btn-info cart-btn"><?php echo CONTINUE_SHOPPING; ?></a>
                        <input type="submit" value="<?php echo UPDATE_CART; ?>" class="btn btn-info cart-btn" name="form_cart">
                        <a href="<?php echo base_url().M_REWRITE; ?>checkout" class="btn btn-info cart-btn"><?php echo CHECKOUT; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>