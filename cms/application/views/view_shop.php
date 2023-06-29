<!--banner area start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_shop']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($page_shop['shop_heading']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($page_shop['shop_heading']); ?></li>
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

<div class="page-content pt_80 pb_70 shop-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 xs_mt_30 sm_mt_30">
                <div class="row">
                <?php
                foreach ($products as $row) {
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 pt_30">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="<?php echo base_url().M_REWRITE; ?>product/view/<?php echo safe_data($row['product_slug']); ?>"><img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row['product_featured_photo']); ?>" alt=""></a>
                            </div>
                            <div class="text">
                                <h3>
                                    <a href="<?php echo base_url().M_REWRITE; ?>product/view/<?php echo safe_data($row['product_slug']); ?>"><?php echo safe_data($row['product_name']); ?></a>
                                </h3>
                                <div class="price">
                                    <?php 
                                        echo '$'.$CI->Model_common->n_format($row['product_current_price'],2);
                                    ?>
                                    <?php
                                        if($row['product_old_price'] != '') {
                                            echo '<del>';
                                            echo '$'.$CI->Model_common->n_format($row['product_old_price'],2);
                                            echo '</del>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>