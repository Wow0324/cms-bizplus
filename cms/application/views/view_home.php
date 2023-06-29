<!--Slider Start-->
<div class="slider">

   
    <div class="slide-carousel slider-one owl-carousel">
        <?php
        foreach ($sliders as $slider) {
            ?>
            <div class="slider-item flex" style = "background-image:url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($slider['photo']); ?>);">
                <div class="bg-slider"></div>
                <div class="container">
                    <div class="row">
                        <div class="<?php if($slider['position'] == 'Left') {echo 'col-lg-6 col-md-9 col-12';} else {echo 'offset-lg-6 col-lg-6 offset-md-3 col-md-9 col-12';} ?>">
                            <div class="slider-text">

                                <?php if($slider['heading']!=''): ?>
                                <div class="text-animated">
                                    <h1><?php echo safe_data($slider['heading']); ?></h1>
                                </div>
                                <?php endif; ?>
                                
                                <?php if($slider['content']!=''): ?>
                                <div class="text-animated">
                                    <p>
                                        <?php echo safe_data(nl2br($slider['content'])); ?>
                                    </p>
                                </div>
                                <?php endif; ?>                            
                                
                                <?php if( $slider['button_text'] != ''): ?>
                                <div class="text-animated">
                                    <ul>                                        
                                        <?php if($slider['button_text'] != ''): ?>
                                        <li><a href="<?php echo safe_data($slider['button_url']); ?>"><?php echo safe_data($slider['button_text']); ?></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<!--Slider End-->

<!--About Start-->
<?php if($page_home_lang_independent['home_welcome_status'] == 'Show'): ?>
<div class="home-about-area pt_60 pb_90 bgf6">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mt_30">
                <div class="home-about-content">
                    <div class="ha-headline-left">
                        <h2>
                            <span><?php echo safe_data($page_home['home_welcome_title']); ?></span> <?php echo safe_data($page_home['home_welcome_subtitle']); ?>
                        </h2>
                    </div>
                    <p><?php echo safe_data($page_home['home_welcome_text']); ?></p>
                    
                </div>
            </div>
            <div class="col-lg-6 mt_30">
                <div class="d-video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo safe_data($page_home_lang_independent['home_welcome_video']); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style = "position:absolute;width:100%;height:100%;left:0"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<!--About End-->


<!--Why Choose start-->
<?php if($page_home_lang_independent['home_why_choose_status'] == 'Show'): ?>
<div class="services-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="headline pb_50">
                    <h1><?php echo safe_data($page_home['home_why_choose_title']); ?></h1>
                    <p class="heading"><?php echo safe_data($page_home['home_why_choose_subtitle']); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($why_choose as $row) {
                ?>
                <div class="col-lg-4 col-md-6 col-12 mb_30">
                    <div class="item mb-30">
                        <div class="icon">
                            <i class="<?php echo safe_data($row['icon']); ?>" aria-hidden="true"></i>
                        </div>
                        <div class="text">
                            <h3><?php echo safe_data($row['name']); ?></h3>
                            <p>
                                <?php echo safe_data(nl2br($row['content'])); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php endif; ?>
<!--Why Choose end-->



<!--Services Start-->
<?php if($page_home_lang_independent['home_service_status'] == 'Show'): ?>
<div class="news-area bgf6 pt_80 pb_80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="headline pb_20 text-center">
                    <h1><?php echo safe_data($page_home['home_service_title']); ?></h1>
                    <p class="heading"><?php echo safe_data($page_home['home_service_subtitle']); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                $i=0;
                foreach ($services as $row) {
                    $i++;
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 pt_30">
                        <div class="item">
                            <div class="photo" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row['photo']); ?>)">
                            </div>
                            <div class="text">
                                <h3><a href="<?php echo base_url().M_REWRITE; ?>service/<?php echo safe_data($row['slug']); ?>"><?php echo safe_data($row['name']); ?></a></h3>
                                <p><?php echo safe_data(nl2br($row['short_description'])); ?></p>
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
<?php endif; ?>
<!--Services End-->




<!--Testimonial start-->
<?php if($page_home_lang_independent['home_testimonial_status'] == 'Show'): ?>
<div class="testimonial-2-area pt_80 pb_80" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($page_home_lang_independent['home_testimonial_photo']); ?>);">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="headline pb_40 text-center headline-white">
                    <h1><?php echo safe_data($page_home['home_testimonial_title']); ?></h1>
                    <p class="heading"><?php echo safe_data($page_home['home_testimonial_subtitle']); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="testimonial-2 owl-carousel">
                    <?php
                    foreach ($testimonials as $row) {
                        ?>
                        <div class="item">
                            <div class="customer-say">
                                <div class="icon">
                                    <i class="fa fa-quote-right" aria-hidden="true"></i>
                                </div>
                                <div class="text">
                                    <p>
                                        <?php echo safe_data(nl2br($row['comment'])); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="man-name">
                                <div class="photo">
                                    <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row['photo']); ?>" alt="">
                                </div>
                                <div class="text">
                                    <h5><?php echo safe_data($row['name']); ?></h5>
                                    <span><?php echo safe_data($row['designation']); ?></span>
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
<?php endif; ?>
<!--Testimonial end-->


<!--Blog-Area Start-->
<?php if($page_home_lang_independent['home_blog_status'] == 'Show'): ?>
<div class="news-area bgf6 pt_80 pb_80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="headline pb_20 text-center">
                    <h1><?php echo safe_data($page_home['home_blog_title']); ?></h1>
                    <p class="heading"><?php echo safe_data($page_home['home_blog_subtitle']); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                $i=0;
                foreach ($all_blogs_category as $blog) {
                    $i++;
                    if($i > $page_home_lang_independent['home_blog_item']) {
                        break;
                    }
                    $dt = explode('-',$blog['created_at']);
                    if($dt[1] == '01') {$month = 'Jan';}
                    if($dt[1] == '02') {$month = 'Feb';}
                    if($dt[1] == '03') {$month = 'Mar';}
                    if($dt[1] == '04') {$month = 'Apr';}
                    if($dt[1] == '05') {$month = 'May';}
                    if($dt[1] == '06') {$month = 'Jun';}
                    if($dt[1] == '07') {$month = 'Jul';}
                    if($dt[1] == '08') {$month = 'Aug';}
                    if($dt[1] == '09') {$month = 'Sep';}
                    if($dt[1] == '10') {$month = 'Oct';}
                    if($dt[1] == '11') {$month = 'Nov';}
                    if($dt[1] == '12') {$month = 'Dec';}
                    $year = $dt[0];
                    $day = $dt[2];
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 pt_30">
                        <div class="item">
                            <div class="photo" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($blog['photo']); ?>)">
                                <span class="post-date"><?php echo safe_data($month).' '.safe_data($day).', '.safe_data($year); ?></span>
                            </div>
                            <div class="text">
                                <h3><a href="<?php echo base_url().M_REWRITE; ?>blog/<?php echo safe_data($blog['slug']); ?>"><?php echo safe_data($blog['title']); ?></a></h3>
                                <p><?php echo safe_data($blog['content_short']); ?></p>
                                <a class="btn btn-primary quote-btn blog" href="<?php echo base_url().M_REWRITE; ?>blog/<?php echo safe_data($blog['slug']); ?>" role="button"><?php echo READ_MORE; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>
<?php endif; ?>
<!--Blog-Area end-->