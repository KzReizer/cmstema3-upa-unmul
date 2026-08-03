<!DOCTYPE html>
<html>

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= $master->{'temaNama' . $lang} ?> | Universitas Mulawarman</title>

    <meta name="keywords" content="Template" />
    <meta name="description" content="Template - Unmul">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>front/img/logo/logo-unmul48.ico" type="image/x-icon" />
    <link rel="logo-unmul-icon" href="<?php echo base_url(); ?>front/img/logo/logo-unmul48.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <!-- Google Fonts: Poppins & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/theme-elements.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/theme-blog.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/theme-shop.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/rs-plugin/css/navigation.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/vendor/circle-flip-slideshow/css/component.css">

    <!-- Skin CSS -->
    <?php if (empty($master->temaWarna)) { ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/skins/default.css">
    <?php } else { ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/skins/default-<?= $master->temaWarna ?>.css">
    <?php } ?>

    <!-- ===== CMS Custom Premium Styles ===== -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/custom1.css">

    <!-- Head Libs -->
    <script src="<?php echo base_url(); ?>front/vendor/modernizr/modernizr.min.js"></script>

    <!-- Dark Mode Initial Script -->
    <script>
        (function() {
            var theme = localStorage.getItem('cms-theme');
            if (theme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>

</head>

<body>
    <div class="body">
        <!-- BEGIN HEADER -->
        <?php
        $this->load->view('front/home/header');
        ?>
        <!-- END HEADER -->
        <!-- main sidebar -->
        <?php
        $this->load->view($pages);
        ?>
        <!-- END NAVBAR -->
        <!-- main sidebar -->
        <?php
        $this->load->view('page/footer');
        ?>
    </div>

    <!-- Vendor -->
    <script src="<?php echo base_url(); ?>front/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/jquery.appear/jquery.appear.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/jquery-cookie/jquery-cookie.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/popper/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/common/common.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/jquery.validation/jquery.validation.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/jquery.gmap/jquery.gmap.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/isotope/jquery.isotope.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/vide/vide.min.js"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="<?php echo base_url(); ?>front/js/theme.js"></script>

    <!-- Current Page Vendor and Views -->
    <script src="<?php echo base_url(); ?>front/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="<?php echo base_url(); ?>front/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js"></script>
    <script src="<?php echo base_url(); ?>front/js/views/view.home.js"></script>

    <!-- Theme Custom -->
    <script src="<?php echo base_url(); ?>front/js/custom.js"></script>

    <!-- Theme Initialization Files -->
    <script src="<?php echo base_url(); ?>front/js/theme.init.js"></script>
    
    <?php if (isset($master->temaResVoice)) : ?>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=<?= $master->temaResVoice ?>"></script>
    <?php endif; ?>

    <!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->

</body>

</html>