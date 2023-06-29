<?php
$CI =& get_instance();
$CI->load->model('Model_team_member');
$s_data = $CI->Model_team_member->s_data();
?>

<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_team_member']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($member['team_member_name']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>team-members"><?php echo safe_data($s_data['team_member_heading']); ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($member['team_member_name']); ?></li>
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

<!--Team Start-->
<div class="person-area pt_80">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="person-add pa">
                    <div class="photo">
                        <img src="<?php echo base_url(); ?>public/uploads/<?php echo safe_data($member['team_member_photo']); ?>" alt="">
                    </div>
                    <div class="text">
                        <h4><?php echo safe_data($member['team_member_name']); ?></h4>
                        <span><?php echo safe_data($member['team_member_designation']); ?></span>
                    </div>
                </div>
                <div class="personal-info person-add mt_20 mb_60">
                    <h5><?php echo CONTACT; ?></h5>
                    <ul class="address">
                        <?php if($member['team_member_email'] != ''): ?>
                            <li><span><i class="fa fa-envelope"></i></span><?php echo safe_data($member['team_member_email']); ?></li>
                        <?php endif; ?>
                        <?php if($member['team_member_phone'] != ''): ?>
                            <li><span><i class="fa fa-phone"></i></span><?php echo safe_data($member['team_member_phone']); ?></li> 
                        <?php endif; ?>
                        <?php if($member['team_member_website'] != ''): ?>
                            <li><span><i class="fa fa-globe"></i></span><?php echo safe_data($member['team_member_website']); ?></li>
                        <?php endif; ?>
                    </ul>
                    <ul class="social-personal">
                        <?php if($member['team_member_facebook'] != ''): ?>
                            <li><a href="<?php echo safe_data($member['team_member_facebook']); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <?php endif; ?>
                        <?php if($member['team_member_twitter'] != ''): ?>
                            <li><a href="<?php echo safe_data($member['team_member_twitter']); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <?php endif; ?>
                        <?php if($member['team_member_linkedin'] != ''): ?>
                            <li><a href="<?php echo safe_data($member['team_member_linkedin']); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <?php endif; ?>
                        <?php if($member['team_member_youtube'] != ''): ?>
                            <li><a href="<?php echo safe_data($member['team_member_youtube']); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        <?php endif; ?>
                        <?php if($member['team_member_google_plus'] != ''): ?>
                            <li><a href="<?php echo safe_data($member['team_member_google_plus']); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        <?php endif; ?>
                        <?php if($member['team_member_instagram'] != ''): ?>
                            <li><a href="<?php echo safe_data($member['team_member_instagram']); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <?php endif; ?>
                        <?php if($member['team_member_flickr'] != ''): ?>
                            <li><a href="<?php echo safe_data($member['team_member_flickr']); ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="row">
                    <div class="col-12 person-contact pb_80">
                        
                        <h3><?php echo DETAIL_INFORMATION; ?></h3>

                        <p>
                            <?php echo safe_data($member['team_member_detail']); ?>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Team End-->