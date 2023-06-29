<?php
$CI =& get_instance();
$CI->load->model('Model_blog');
$s_data = $CI->Model_blog->s_data();
?>
<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($blog_detail['banner']); ?>)">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($blog_detail['title']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>blog"><?php echo safe_data($s_data['blog_heading']); ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($blog_detail['title']); ?></li>
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


<!--Blog details start-->
<div class="blog-details pt_80 pb_60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                <div class="blog-content">
                    <div class="photo mb_30">
                        <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($blog_detail['photo']); ?>" alt="">
                    </div>
                    <div class="heading-text news-details">
                        <h3><?php echo safe_data($blog_detail['title']); ?></h3>
                        <span class="by-admin"><strong><a href="<?php echo base_url().M_REWRITE; ?>category/<?php echo safe_data($blog_detail['category_slug']); ?>"><?php echo safe_data($blog_detail['category_name']); ?></a></strong></span> | <span class="by-admin"><strong>
                            <?php 
                            $dt = explode('-',$blog_detail['created_at']);
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
                        </strong></span>
                    </div>
                    <div class="text mt_20">
                        <?php echo safe_data($blog_detail['content']); ?>

                        <div class="share-news mt_50">
                            <h4><?php echo SHARE_THIS_BLOG; ?></h4>
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_twitter"></a>
                            <a class="a2a_button_google_plus"></a>
                            <a class="a2a_button_pinterest"></a>
                            <a class="a2a_button_linkedin"></a>
                            <a class="a2a_button_digg"></a>
                            <a class="a2a_button_tumblr"></a>
                            <a class="a2a_button_reddit"></a>
                            <a class="a2a_button_stumbleupon"></a>
                            </div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                        </div>

                        <?php if($blog_detail['comment'] == 'On'): ?>
                        <div class="comment-form headstyle mt_50">
                            <h4><?php echo COMMENT; ?></h4>
                            <div class="comment-inner">
                                <?php
                                $final_url = base_url().M_REWRITE.'blog/'.$slug;
                                ?>
                                <div class="fb-comments" data-href="<?php echo safe_data($final_url); ?>" data-numposts="5"></div>
                            </div>
                        </div>
                        <?php endif; ?>


                    </div>
                </div>
            </div>

            <!--Sidebar-->
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">

                <!--Sidebar item-->
                <div class="sidebar-item mb_40">
                    <div class="sidebar-title">
                        <h5><?php echo SIDEBAR_BLOG_HEADING_CATEGORY; ?></h5>
                    </div>
                    <div class="sidebar-body category">
                         <ul>
                            <?php
                            foreach($all_categories as $row) {
                                ?>
                                <li><a href="<?php echo base_url().M_REWRITE; ?>category/<?php echo safe_data($row['category_slug']); ?>"><?php echo safe_data($row['category_name']); ?></a></li>
                                <?php
                            }
                            ?>
                         </ul>
                    </div>
                </div>
                <!--/ Sidebar item-->

                <!--Sidebar item-->
                <div class="sidebar-item mb_40">
                    <div class="sidebar-title">
                        <h5><?php echo SIDEBAR_BLOG_HEADING_RECENT_BLOG; ?></h5>
                    </div>
                    <div class="sidebar-body recent-post">                     
                        <?php
                        $i=0;
                        foreach($blogs as $row) {
                            $i++;
                            if($i>$setting['sidebar_total_recent_blog']) {
                                break;
                            }
                            ?>
                            <div class="s-post-item mb_10 mt_10">
                                <div class="photo">
                                    <a href="<?php echo base_url().M_REWRITE; ?>blog/<?php echo safe_data($row['slug']); ?>"><img src="<?php echo base_url().'public/uploads/'.safe_data($row['photo']); ?>" alt=""></a>
                                </div>
                                <div class="text">
                                    <span class="date-time">
                                        <?php 
                                        $dt = explode('-',$row['created_at']);
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
                                    <h4>
                                        <a href="<?php echo base_url().M_REWRITE; ?>blog/<?php echo safe_data($row['slug']); ?>"><?php echo safe_data($row['title']); ?></a>
                                    </h4>
                                </div>
                            </div>
                            <?php
                        }
                        ?>                        

                    </div>
                </div>
                <!--/ Sidebar item-->

            </div>

        </div>
    </div>
</div>
<!--Blog details end-->