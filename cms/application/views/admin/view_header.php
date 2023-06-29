<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Panel</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/datepicker3.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/bootstrap-timepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/jquery.fancybox.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/magnific-popup.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/spacing.css">
	
	<link href="https://fonts.googleapis.com/css2?family=Signika:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body class="hold-transition fixed skin-blue sidebar-mini">

	<div class="wrapper">

		<header class="main-header">

			<a href="<?php echo base_url().M_REWRITE; ?>admin/dashboard" class="logo">
				<span class="logo-lg"><?php echo safe_data($setting['website_name']); ?></span>
			</a>

			<nav class="navbar navbar-static-top">
				
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<span class="a_panel_name">Control Panel (Admin)</span>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li>
							<a href="<?php echo base_url(); ?>" target="_blank">Front End</a>
						</li>
						<li>
							<a href="<?php echo base_url().M_REWRITE; ?>admin/profile">Edit Profile</a>
						</li>
						<li>
							<a href="<?php echo base_url().M_REWRITE; ?>admin/login/logout">Log out</a>
						</li>
					</ul>
				</div>

			</nav>
		</header>

  		<?php
			$class_name = '';
		    $segment_2 = 0;
		    $segment_3 = 0;
		    $class_name = $this->router->fetch_class();
		    $segment_2 = $this->uri->segment('2');
		    $segment_3 = $this->uri->segment('3');
		?>

  		<aside class="main-sidebar">
    		<section class="sidebar">

     
      			<ul class="sidebar-menu">

			        <li class="treeview <?php if($class_name == 'dashboard') {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/dashboard">
			            <i class="fa fa-laptop"></i> <span>Dashboard</span>
			          </a>
			        </li>


			        <li class="treeview <?php if( ($class_name == 'setting') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/setting">
			            <i class="fa fa-cog"></i> <span>Website Settings</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'page_home') || ($class_name == 'page_about') || ($class_name == 'page_service') || ($class_name == 'page_faq') || ($class_name == 'page_photo_gallery') || ($class_name == 'page_video_gallery') || ($class_name == 'page_blog') || ($class_name == 'page_contact') || ($class_name == 'page_term') || ($class_name == 'page_privacy') || ($class_name == 'page_team_member') || ($class_name == 'page_shop') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-file-text"></i>
							<span>Page Section</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-home"><i class="fa fa-long-arrow-right"></i>Home Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-about"><i class="fa fa-long-arrow-right"></i>About Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-service"><i class="fa fa-long-arrow-right"></i>Service Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-faq"><i class="fa fa-long-arrow-right"></i>FAQ Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-photo-gallery"><i class="fa fa-long-arrow-right"></i>Photo Gallery Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-video-gallery"><i class="fa fa-long-arrow-right"></i>Video Gallery Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-blog"><i class="fa fa-long-arrow-right"></i>Blog Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-contact"><i class="fa fa-long-arrow-right"></i>Contact Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-term"><i class="fa fa-long-arrow-right"></i>Terms and Conditions Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-privacy"><i class="fa fa-long-arrow-right"></i>Privacy Policy Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-team-member"><i class="fa fa-long-arrow-right"></i>Team Members Page</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/page-shop"><i class="fa fa-long-arrow-right"></i>Shop Page</a></li>
						</ul>
					</li>

					<li class="treeview <?php if( ($class_name == 'page_dynamic') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/page-dynamic">
			            <i class="fa fa-cog"></i> <span>Dynamic Page</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'menu') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/menu">
			            <i class="fa fa-cog"></i> <span>Menu Section</span>
			          </a>
			        </li>

					<li class="treeview <?php if( ($class_name == 'customer') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/customer">
			            <i class="fa fa-hospital-o"></i> <span>Customer</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'lang') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/lang">
			            <i class="fa fa-language"></i> <span>Language</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'seo') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/seo">
			            <i class="fa fa-gift"></i> <span>SEO</span>
			          </a>
			        </li> 

			        <li class="treeview <?php if( ($class_name == 'product') || ($class_name == 'shipping') || ($class_name == 'coupon') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-newspaper-o"></i>
							<span>Product</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/product"><i class="fa fa-long-arrow-right"></i>Product</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/shipping"><i class="fa fa-long-arrow-right"></i>Shipping</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/coupon"><i class="fa fa-long-arrow-right"></i>Coupon</a></li>
						</ul>
					</li>

					<li class="treeview <?php if( ($class_name == 'order') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/order">
			            <i class="fa fa-shopping-basket"></i> <span>Order</span>
			          </a>
			        </li>
			      
			        <li class="treeview <?php if( ($class_name == 'category') || ($class_name == 'blog') || ($class_name == 'comment') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-newspaper-o"></i>
							<span>Blog</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/category"><i class="fa fa-long-arrow-right"></i>Category</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/blog"><i class="fa fa-long-arrow-right"></i>Blog</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/comment"><i class="fa fa-long-arrow-right"></i>Comment</a></li>
						</ul>
					</li>

					<li class="treeview <?php if( ($class_name == 'subscriber') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-comment"></i>
							<span>Subscriber</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/subscriber"><i class="fa fa-long-arrow-right"></i>All Subscribers</a></li>
							<li><a href="<?php echo base_url().M_REWRITE; ?>admin/subscriber/send_email"><i class="fa fa-long-arrow-right"></i>Email to Subscribers</a></li>
						</ul>
					</li>

			        

			        <li class="treeview <?php if( ($class_name == 'slider') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/slider">
			            <i class="fa fa-picture-o"></i> <span>Slider</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'team_member') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/team-member">
			            <i class="fa fa-user-md"></i> <span>Team Member</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'testimonial') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/testimonial">
			            <i class="fa fa-user-plus"></i> <span>Testimonial</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'photo') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/photo">
			            <i class="fa fa-camera"></i> <span>Photo Gallery</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'video') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/video">
			            <i class="fa fa-camera"></i> <span>Video Gallery</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'service') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/service">
			            <i class="fa fa-life-ring"></i> <span>Service</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'why_choose') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/why_choose">
			            <i class="fa fa-paper-plane-o"></i> <span>Why Choose Us</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'faq') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/faq">
			            <i class="fa fa-bolt"></i> <span>FAQ</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($class_name == 'social_media') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url().M_REWRITE; ?>admin/social_media">
			            <i class="fa fa-address-book"></i> <span>Social Media</span>
			          </a>
			        </li>   
      
      			</ul>
    		</section>
  		</aside>

  		<div class="content-wrapper">