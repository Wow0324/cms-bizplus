<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_terms']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($page_term['term_heading']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($page_term['term_heading']); ?></li>
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

<div class="page-content pt_80 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-md-12 xs_mt_30 sm_mt_30">
                <div class="text page-title">
                    <?php echo safe_data($page_term['term_content']); ?>
                </div>
            </div>
        </div>
    </div>
</div>