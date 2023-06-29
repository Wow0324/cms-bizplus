<!--Banner Start-->
<div class="banner-area" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($setting['banner_team_member']); ?>)">
   <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner">
                    <div class="text">
                        <h1><?php echo safe_data($page_team_member['team_member_heading']); ?></h1>
                        <div class="breadcrumb-container d-flex justify-content-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($page_team_member['team_member_heading']); ?></li>
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
<div class="team-area pb_50 pt_80 ">
    <div class="container">
        <div class="row">
            <?php
            foreach ($team_members as $row) {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb_30">
                    <div class="team-item text-center">
                        <div class="photo-in">
                            <div class="photo" style = "background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo safe_data($row['team_member_photo']); ?>)">
                            </div>
                        </div>
                        <div class="text">
                            <h5>
                                <a href="<?php echo base_url().M_REWRITE; ?>team-member/<?php echo safe_data($row['team_member_slug']); ?>"><?php echo safe_data($row['team_member_name']); ?></a>
                            </h5>
                            <span><?php echo safe_data($row['team_member_designation']); ?></span>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<!--Team End-->