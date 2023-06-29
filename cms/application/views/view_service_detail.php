<?php
$CI =& get_instance();
$CI->load->model('Model_service');
$s_data = $CI->Model_service->s_data();
?>
<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_service']); ?>)">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($service['name']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>service"><?php echo safe_data($s_data['service_heading']); ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($service['name']); ?></li>
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

<!--Single-Service Start-->
<div class="blog-details pt_80 pb_60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                <div class="photo mb_30">
                    <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($service['photo']); ?>" alt="<?php echo safe_data($service['name']); ?>">
                </div>
                <div class="service-heading mb_20">
                    <h3><?php echo safe_data($service['name']); ?></h3>
                </div>
                <div class="text">
                    <?php echo safe_data($service['description']); ?>
                </div>
            </div>

            <!--sidebar-->
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">

                <!--Sidebar item-->
                <div class="sidebar-item mb_40">
                    <div class="sidebar-title">
                        <h5><?php echo SIDEBAR_SERVICE_HEADING_SERVICES; ?></h5>
                    </div>
                    <div class="sidebar-body recent-post">

                        <?php
                        foreach ($services as $row) {
                            ?>
                            <div class="s-post-item service-item mb_10 mt_10">
                                <div class="photo">
                                    <a href="<?php echo base_url().M_REWRITE; ?>service/<?php echo safe_data($row['slug']); ?>"><img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row['photo']); ?>" alt=""></a>
                                </div>
                                <div class="text">
                                    <h4><a href="<?php echo base_url().M_REWRITE; ?>service/<?php echo safe_data($row['slug']); ?>"><?php echo safe_data($row['name']); ?></a></h4>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <!--/ Sidebar item-->

            </div>
            <!--/ Sidebar-->

        </div>
    </div>
</div>
<!--Single-Service End-->