<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$error_message = '';
$success_message = '';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <?php
    $CI =& get_instance();
    $CI->load->model('Model_common');
    $CI->load->model('Model_lang');
    $CI->load->model('Model_home');
    $CI->load->model('admin/Model_menu');

    $arr_menu = array();
    $all_menu = $CI->Model_menu->show();
    foreach($all_menu as $row)
    {
        $arr_menu[$row['menu_id']] = $row['menu_status'];
    }

    $all_dynamic_page = $CI->Model_home->all_dynamic_page();

    $seo = $CI->Model_common->all_seo();

    echo '<meta name="description" content="'.safe_data($seo['description']).'">';
    echo '<meta name="keywords" content="'.safe_data($seo['keyword']).'">';
    echo '<title>'.safe_data($seo['title']).'</title>';

    $class_name = '';
    $segment_2 = 0;
    $segment_3 = 0;
    $class_name = $this->router->fetch_class();
    $segment_2 = $this->uri->segment('2');
    $segment_3 = $this->uri->segment('3');
       
    if($class_name == 'blog')
    {
        if($segment_3 == 0) {
           
        } else {
            $blog_single_item = $this->Model_blog->blog_detail($segment_3);            
            $og_slug = safe_data($blog_single_item['slug']);
            $og_photo = safe_data($blog_single_item['photo']);
            $og_title = safe_data($blog_single_item['title']);
            $og_description = safe_data($blog_single_item['content_short']);
            echo '<meta property="og:title" content="'.$og_title.'">';
            echo '<meta property="og:type" content="website">';
            echo '<meta property="og:url" content="'.base_url().M_REWRITE.'blog/'.$og_slug.'">';
            echo '<meta property="og:description" content="'.$og_description.'">';
            echo '<meta property="og:image" content="'.base_url().'public/uploads/'.$og_photo.'">';
        }
    }
    ?>
    

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['favicon']); ?>">

    <!--Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">


    <!--All CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/toastr.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/slicknav.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/spacing.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/responsive.css">

    <!--All JS-->
    <script src="<?php echo base_url(); ?>public/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery.magnific-popup.js"></script>
    <script src="<?php echo base_url(); ?>public/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery.filterizr.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery.parallax.js"></script>
    <script src="<?php echo base_url(); ?>public/js/plugins.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery.slicknav.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>public/js/toastr.min.js"></script>

    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5993ef01e2587a001253a261&product=inline-share-buttons"></script>
    
    <style>
        .top-section,
        .menu-section .menu ul li.active a,
        .menu-section .menu ul li:hover > a,
        .text-animated li a,
        .testimonial-2-area .bg,
        .call-us:before,
        .btnme,
        .scroll::before,
        .menu-item.acc-class a i,
        .product-page .product-right button,
        .contact-address-area .add-icon,
        .sidebar-body.category ul li::before,
        .cart-buttons .cart-btn,
        #accordionCheckout>.card>.card-header,
        .btn.btn-primary.my-btn {
            background: #<?php echo safe_data($setting['front_end_color']); ?>!important;
        }

        .services-section .item::before,
        .services-section .item::after,
        .btn.btn-primary.quote-btn,
        span.post-date,
        .footer-area .footer-column h3::before,
        .footer-area .footer-column h3::after {
            background-color: #<?php echo safe_data($setting['front_end_color']); ?>!important;   
        }

        .text-animated li a,
        .form-item input:focus, 
        .massege-item textarea:focus,
        .btn.btn-primary.my-btn {
            border-color: #<?php echo safe_data($setting['front_end_color']); ?>!important;   
        }

        .menu-section .menu ul li ul.submenu,
        .person-add {
            border-top-color: #<?php echo safe_data($setting['front_end_color']); ?>!important;   
        }

        .person-contact h3,
        .sidebar-title,
        .service-heading {
            border-left-color: #<?php echo safe_data($setting['front_end_color']); ?>!important;      
        }

        .product-page .nav-pills .nav-link.active {
            border-bottom-color: #<?php echo safe_data($setting['front_end_color']); ?>!important;         
        }

        a:hover,
        .text-animated li a:hover,
        .services-section .icon i,
        .news-area .item .text h3 a:hover,
        .testimonial-2-area .owl-nav i,
        .testimonial-2 .item .customer-say .text p,
        .testimonial-2 .item .icon i,
        .call-us .button a:hover,
        .footer-area .footer-column ul li a:hover,
        .team-item .text h5 a:hover,
        .person-add .text span,
        ul.address li span,
        ul.social-personal li a:hover,
        .sidebar-body .text h4 a:hover,
        .shop-page .text .price,
        .shop-page .text h3 a:hover,
        .product-page .product-right .stock-available-amount,
        .product-page .product-right .main-price,
        .product-page .nav-pills .nav-link.active,
        ul#nav li ul.submenu li a {
            color: #<?php echo safe_data($setting['front_end_color']); ?>!important;      
        }

        .text-animated li a:hover {
            background: #fff!important;
        }

        .text-animated li a:hover {
            border-color: #fff!important;
        }

        .cart-buttons .cart-btn:hover,
        ul#nav li:hover a,
        ul#nav li ul.submenu li:hover a,
        ul#nav li ul.submenu li.active a {
            color: #fff!important;
        }

        ul#nav li ul.submenu li a {
            color: #444!important;
        }
    </style>

</head>

<body>

    <?php echo safe_data($comment['code_body']); ?>

    <?php
        if($this->session->flashdata('error')) {
            ?>
            <script>
                toastr.error('<?php echo safe_data($this->session->flashdata('error')); ?>');
            </script>
            <?php
        }
        if($this->session->flashdata('success')) {
            ?>
            <script>
                toastr.success('<?php echo safe_data($this->session->flashdata('success')); ?>');
            </script>
            <?php
        }
    ?>

    <!--Top area start-->
    <div class="top-section pt_10 pb_10">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 top-bar-left">
                    <div class="contact-bar-left top-list">
                        <ul>
                            <li><i class="fa fa-phone"></i> <?php echo safe_data($setting['top_bar_phone']); ?></li>
                            <li><i class="fa fa-envelope-o"></i> <?php echo safe_data($setting['top_bar_email']); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 top-bar-right">
                    <div class="contact-bar-right top-list">
                        <ul>
                            <?php if(!$this->session->userdata('team_member_id')): ?>
                            <?php if($this->session->userdata('customer_id')): ?>
                                <li><a href="<?php echo base_url().M_REWRITE; ?>customer/dashboard"><i class="fa fa-user-circle"></i><?php echo CUSTOMER_DASHBOARD; ?></a></li>
                            <?php else: ?>
                                <li><a href="<?php echo base_url().M_REWRITE; ?>customer/login"><i class="fa fa-sign-in"></i><?php echo CUSTOMER_LOGIN; ?></a></li>
                                <li><a href="<?php echo base_url().M_REWRITE; ?>customer/registration"><i class="fa fa-user"></i><?php echo CUSTOMER_REGISTRATION; ?></a></li>
                            <?php endif; ?>
                            <?php endif; ?>
                            <li class="cart <?php if(isset($_SESSION['cart_product_id'])) {echo 'cart-pr-30';} else {echo 'cart-no-pr';} ?>">
                                <a href="<?php echo base_url().M_REWRITE; ?>cart"><i class="fa fa-user"></i><?php echo CART; ?></a>
                                <?php 
                                if(isset($_SESSION['cart_product_id'])) {
                                    echo '<div class="number-cart">'.count($_SESSION['cart_product_id']).'</div>';
                                }
                                ?>
                            </li>
                            <li>
                                <?php echo form_open(base_url().M_REWRITE.'lang/change'); ?>
                                <select name="lang_change_id" class="form-control" onchange="this.form.submit()">
                                    <?php
                                    $all_language = $CI->Model_lang->show_all_language();
                                    foreach($all_language as $row)
                                    {
                                        ?>
                                        <option value="<?php echo safe_data($row['lang_id']); ?>" <?php if($row['lang_id'] == $_SESSION['sess_lang_id']) {echo 'selected';} ?>><?php echo safe_data($row['lang_name']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php echo form_close(); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Top area end-->



    <!--Header area start-->
    <div class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="main-logo">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['logo']); ?>" alt="Logo"></a>
                    </div>
                </div>
                <?php
                    $class_name = '';
                    $segment_2 = 0;
                    $segment_3 = 0;
                    $class_name = $this->router->fetch_class();
                    $segment_2 = $this->uri->segment('2');
                    $segment_3 = $this->uri->segment('3');
                ?>
                <div class="col-lg-9 col-md-12">
                    <div class="menu-section d-flex justify-content-end">
                        <div class="menu nav-menu d-flex align-items-center">
                            <nav>
                                <ul id="nav">

                                    <?php if($arr_menu[1] == 'Show'): ?>
                                    <li class="<?php if($class_name == 'home') {echo 'active';} ?>">
                                        <a href="<?php echo base_url(); ?>"><?php echo MENU_HOME; ?></a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if($arr_menu[2] == 'Show'): ?>
                                    <li class="<?php if($class_name == 'about') {echo 'active';} ?>">
                                        <a href="<?php echo base_url().M_REWRITE; ?>about"><?php echo MENU_ABOUT; ?></a>
                                    </li>
                                    <?php endif; ?>                                    

                                    <?php if($arr_menu[3] == 'Show'): ?>
                                    <li class="<?php if($class_name == 'service') {echo 'active';} ?>">
                                        <a href="<?php echo base_url().M_REWRITE; ?>service"><?php echo MENU_SERVICE; ?></a>
                                    </li>
                                    <?php endif; ?>


                                    <?php if( ($arr_menu[5] == 'Show') || ($arr_menu[6] == 'Show') || ($arr_menu[11] == 'Show') || ($arr_menu[4] == 'Show') || ($arr_menu[13] == 'Show') ): ?>
                                    <li><a href="javascript:void;"><?php echo MENU_PAGES; ?> <span class="caret"></span></a>
                                        <ul class="submenu">

                                            <?php if($arr_menu[5] == 'Show'): ?>
                                            <li>
                                                <a href="<?php echo base_url().M_REWRITE; ?>photo-gallery"><?php echo MENU_PHOTO_GALLERY; ?></a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if($arr_menu[6] == 'Show'): ?>
                                            <li>
                                                <a href="<?php echo base_url().M_REWRITE; ?>video-gallery"><?php echo MENU_VIDEO_GALLERY; ?></a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if($arr_menu[11] == 'Show'): ?>
                                            <li>
                                                <a href="<?php echo base_url().M_REWRITE; ?>team-members"><?php echo MENU_TEAM_MEMBERS; ?></a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if($arr_menu[4] == 'Show'): ?>
                                            <li>
                                                <a href="<?php echo base_url().M_REWRITE; ?>faq"><?php echo MENU_FAQ; ?></a>
                                            </li>
                                            <?php endif; ?>


                                            <?php if($arr_menu[13] == 'Show'): ?>
                                            <?php
                                            foreach($all_dynamic_page as $rr)
                                            {
                                                ?>
                                                <li><a href="<?php echo base_url().M_REWRITE; ?>page/<?php echo safe_data($rr['slug']); ?>"><?php echo safe_data($rr['name']); ?></a></li>
                                                <?php
                                            }
                                            ?>
                                            <?php endif; ?>

                                        </ul>
                                    </li>
                                    <?php endif; ?>


                                    <?php if($arr_menu[12] == 'Show'): ?>
                                    <li class="<?php if($class_name == 'shop') {echo 'active';} ?>">
                                        <a href="<?php echo base_url().M_REWRITE; ?>shop"><?php echo MENU_SHOP; ?></a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if($arr_menu[7] == 'Show'): ?>
                                    <li class="<?php if($class_name == 'blog') {echo 'active';} ?>">
                                        <a href="<?php echo base_url().M_REWRITE; ?>blog"><?php echo MENU_BLOG; ?></a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if($arr_menu[8] == 'Show'): ?>
                                    <li class="<?php if($class_name == 'contact') {echo 'active';} ?>">
                                        <a href="<?php echo base_url().M_REWRITE; ?>contact"><?php echo MENU_CONTACT; ?></a>
                                    </li>
                                    <?php endif; ?>


                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Header area end-->