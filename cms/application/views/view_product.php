<!--banner area start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_shop']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($product_detail['product_name']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>shop">Shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($product_detail['product_name']); ?></li>
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

<?php
$CI =& get_instance();
$CI->load->model('admin/Model_common');
?>

<div class="page-content pt_80 pb_70 product-page">
    <div class="container">
        <div class="row">
            <div class="col-md-4 product-left xs_mt_30 sm_mt_30">
                <div class="product-main-image">
                    <div class="bg"></div>
                    <div class="plus-icon">
                        <i class="fa fa-plus-circle"></i>
                    </div>
                    <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($product_detail['product_featured_photo']); ?>" alt="">
                    <a href="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($product_detail['product_featured_photo']); ?>" class="gal-photo"></a>
                </div>
            </div>
            <div class="col-md-8 product-right xs_mt_30 sm_mt_30">
                <?php echo form_open(base_url().M_REWRITE.'product/add-to-cart',array('class' => '')); ?>
                    <h2><?php echo safe_data($product_detail['product_name']); ?></h2>
                    <div class="stock-available-amount mb_25"><?php echo STOCK_AVAILABLE; ?> <?php echo safe_data($product_detail['product_stock']); ?></div>
                    <p>
                        <?php echo safe_data(nl2br($product_detail['product_content_short'])); ?>
                    </p>
                    <h2 class="mt_30"><?php echo PRODUCT_PRICE; ?></h2>
                    <div class="main-price">
                        $<?php echo safe_data($product_detail['product_current_price']); ?>
                        
                        <?php if($product_detail['product_old_price']!=''): ?>
                        <del>$<?php echo safe_data($product_detail['product_old_price']); ?></del>
                        <?php endif; ?>

                    </div>

                    <h2 class="mt_30"><?php echo QUANTITY; ?></h2>
                    <div class="qty">
                        <input type="number" class="form-control" name="product_qty" step="1" min="1" max="" value="1" pattern="[0-9]*" inputmode="numeric" autocomplete="off">
                    </div>

                    <input type="hidden" name="product_id" value="<?php echo safe_data($product_detail['product_id']); ?>">
                    <input type="hidden" name="product_slug" value="<?php echo safe_data($product_detail['product_slug']); ?>">
                    <input type="hidden" name="product_current_price" value="<?php echo safe_data($product_detail['product_current_price']); ?>">
                    <input type="hidden" name="product_name" value="<?php echo safe_data($product_detail['product_name']); ?>">
                    <input type="hidden" name="product_featured_photo" value="<?php echo safe_data($product_detail['product_featured_photo']); ?>">

                    <button type="submit" class="btn btn-primary mt_30" name="form_add_to_cart"><?php echo ADD_TO_CART; ?></button>
                    <?php echo form_close(); ?>
            </div>
        </div>

        <div class="row mt_40">
            <div class="col-md-12">
                <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo DESCRIPTION; ?></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo RETURN_POLICY; ?></a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <?php echo safe_data($product_detail['product_content']); ?>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <?php echo safe_data($product_detail['product_return_policy']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>