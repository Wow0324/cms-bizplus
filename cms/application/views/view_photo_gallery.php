<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_photo_gallery']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($page_photo_gallery['photo_gallery_heading']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($page_photo_gallery['photo_gallery_heading']); ?></li>
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
                    foreach ($photo_gallery as $row) {
                        ?>
                        <div class="col-md-4">
                            <div class="photo-item">
                                <div class="g-item">
                                    <div class="g-inner">
                                        <div class="g-photo" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row['photo_name']); ?>)">
                                            <div class="overlay"></div>
                                            <div class="gallery-content">
                                                <a href="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row['photo_name']); ?>" class="gal-photo" title="<?php echo safe_data($row['photo_caption']); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </div>
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