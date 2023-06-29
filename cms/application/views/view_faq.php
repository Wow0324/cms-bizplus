<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_faq']); ?>)">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($page_faq['faq_heading']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($page_faq['faq_heading']); ?></li>
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

<!--FAQ Start-->
<div class="menu-horizontal container pt_50 pb_80">
    <div class="row">
        <div class="col-md-12 pt_30">
            <div class="row menu-container" id="menu">

                <?php
                $i=0;
                foreach ($faqs as $row) {
                    $i++;
                    ?>
                    <div class="col-md-12 menu-item acc-class">
                        <a data-toggle="collapse" class="collapsed" data-target="#studies-collapse<?php echo safe_data($i); ?>" href="#studies-collapse<?php echo safe_data($i); ?>" aria-expanded="false" aria-controls="studies-collapse<?php echo safe_data($i); ?>">
                            <i class="fa fa-angle-double-down" aria-hidden="true"></i> <?php echo safe_data($row['faq_title']); ?>
                        </a>
                        <div class="collapse" id="studies-collapse<?php echo safe_data($i); ?>" data-parent="#menu">
                            <div class="container">
                                <div class="row acc-text">
                                    <?php echo safe_data($row['faq_content']); ?>
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
<!--FAQ End-->