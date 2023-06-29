<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_service']); ?>)">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($page_service['service_heading']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($page_service['service_heading']); ?></li>
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

<!--Service-Area Start-->
<div class="news-area pt_50 pb_80">
    <div class="container">
        <div class="row">

            <?php
            foreach ($services as $row) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 pt_30">
                    <div class="item">
                        <div class="photo" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row['photo']); ?>)">
                        </div>
                        <div class="text">
                            <h3><a href="<?php echo base_url().M_REWRITE; ?>service/<?php echo safe_data($row['slug']); ?>"><?php echo safe_data($row['name']); ?></a></h3>
                            <p>
                                <?php echo nl2br($row['short_description']); ?>
                            </p>
                            <a class="btn btn-primary quote-btn blog" href="<?php echo base_url().M_REWRITE; ?>service/<?php echo safe_data($row['slug']); ?>" role="button"><?php echo READ_MORE; ?></a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<!--Service-Area End-->