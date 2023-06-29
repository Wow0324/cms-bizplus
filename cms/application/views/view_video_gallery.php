<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_video_gallery']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($page_video_gallery['video_gallery_heading']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($page_video_gallery['video_gallery_heading']); ?></li>
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

<!--Gallery Start-->
<div class="photo-gallery-area pt_80 pb_80 bgf6">
    <div class="photo-area ">
        <div class="container">
            <div class="row">
                <?php
                    foreach ($video_gallery as $row) {
                        ?>
                        <div class="col-md-4">
                            <div class="photo-item">
                                <div class="g-item">
                                    <div class="g-inner">
                                        <?php
                                        if($row['video_type'] == 'YouTube'):
                                            $img_url = 'http://img.youtube.com/vi/'.$row['video_code'].'/sddefault.jpg';
                                            $anchor = 'http://www.youtube.com/watch?v='.$row['video_code'];
                                        else:
                                            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$row['video_code'].".php"));
                                            $img_url = $hash[0]['thumbnail_medium'];
                                            $anchor = 'https://vimeo.com/'.$row['video_code'];
                                        endif;
                                        ?>
                                        <div class="g-photo" style = "background-image: url(<?php echo safe_data($img_url); ?>)">
                                            <div class="overlay"></div>
                                            <div class="gallery-content">
                                                <a href="<?php echo safe_data($anchor); ?>" class="gal-video"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="g-text">
                                            <h4><?php echo safe_data($row['video_caption']); ?></h4>
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
    </div>
</div>
<!--Gallery End-->