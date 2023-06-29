<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_blog']); ?>)">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($page_blog['blog_heading']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($page_blog['blog_heading']); ?></li>
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


<!--Blog start-->
<div class="news-area pt_50 pb_80">
    <div class="container">
        <div class="row">
            <?php
                foreach($blog_fetched as $row) {
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 pt_30">
                        <div class="item">
                            <div class="photo" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row->photo); ?>)">
                                <span class="post-date">
                                    <?php 
                                    $dt = explode('-',$row->created_at);
                                    if($dt[1] == '01') {$month = 'January';}
                                    if($dt[1] == '02') {$month = 'February';}
                                    if($dt[1] == '03') {$month = 'March';}
                                    if($dt[1] == '04') {$month = 'April';}
                                    if($dt[1] == '05') {$month = 'May';}
                                    if($dt[1] == '06') {$month = 'June';}
                                    if($dt[1] == '07') {$month = 'July';}
                                    if($dt[1] == '08') {$month = 'August';}
                                    if($dt[1] == '09') {$month = 'September';}
                                    if($dt[1] == '10') {$month = 'October';}
                                    if($dt[1] == '11') {$month = 'November';}
                                    if($dt[1] == '12') {$month = 'December';}
                                    echo safe_data($month) . ' ' . $dt[2] . ', ' . $dt[0];
                                    ?>
                                </span>
                            </div>
                            <div class="text">
                                <h3><a href="<?php echo base_url().M_REWRITE; ?>blog/<?php echo safe_data($row->slug); ?>"><?php echo safe_data($row->title); ?></a></h3>
                                <p><?php echo safe_data($row->content_short); ?></p>
                                <a class="btn btn-primary quote-btn blog" href="<?php echo base_url().M_REWRITE; ?>blog/<?php echo safe_data($row->slug); ?>" role="button"><?php echo READ_MORE; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="row">
            <div class="col-md-12 mt_30 tac">
                <?php echo safe_data($links); ?>
            </div>
        </div>
    </div>
</div>
<!--Blog end-->