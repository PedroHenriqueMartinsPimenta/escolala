<?php
	if (isset($_GET['escola'])) {
		include_once('controller/conexao.php');
		include_once('content/config.php');
		$escola = $_GET['escola'];
		$sql = "SELECT * FROM escola WHERE CODIGO = $escola";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
			?>
				
<!DOCTYPE html>
<!-- saved from url=(0042)<?php echo $url?>site/?page_id=12# -->
<html lang="pt-BR"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<title><?php echo $row['NOME']?></title>
<link rel="dns-prefetch" href="https://s.w.org/">
<link rel="alternate" type="application/rss+xml" title="Feed para Nome do site »" href="<?php echo $url?>site">
<link rel="alternate" type="application/rss+xml" title="Feed de comentários para Nome do site »" href="<?php echo $url?>site/?feed=comments-rss2">
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/localhost\/escola\/site\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.6.2"}};
			!function(e,a,t){var n,r,o,i=a.createElement("canvas"),p=i.getContext&&i.getContext("2d");function s(e,t){var a=String.fromCharCode;p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,e),0,0);e=i.toDataURL();return p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,t),0,0),e===i.toDataURL()}function c(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(o=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},r=0;r<o.length;r++)t.supports[o[r]]=function(e){if(!p||!p.fillText)return!1;switch(p.textBaseline="top",p.font="600 32px Arial",e){case"flag":return s([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])?!1:!s([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!s([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]);case"emoji":return!s([55357,56424,8205,55356,57212],[55357,56424,8203,55356,57212])}return!1}(o[r]),t.supports.everything=t.supports.everything&&t.supports[o[r]],"flag"!==o[r]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[o[r]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(n=t.source||{}).concatemoji?c(n.concatemoji):n.wpemoji&&n.twemoji&&(c(n.twemoji),c(n.wpemoji)))}(window,document,window._wpemojiSettings);
		</script><script src="<?php echo $url?>site/wp-includes/js/wp-emoji-release.min.js?ver=5.6.2" type="text/javascript" defer=""></script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
	<link rel="stylesheet" id="wp-block-library-css" href="<?php echo $url?>site/wp-includes/css/dist/block-library/style.min.css?ver=5.6.2" type="text/css" media="all">
<link rel="stylesheet" id="bootstrap-css" href="<?php echo $url?>site/wp-content/themes/unschool/skin/bootstrap/css/bootstrap.css?ver=5.6.2" type="text/css" media="all">
<link rel="stylesheet" id="font-awesome-css" href="<?php echo $url?>site/wp-content/plugins/elementor/assets/lib/font-awesome/css/font-awesome.min.css?ver=4.7.0" type="text/css" media="all">
<link rel="stylesheet" id="unschool-basic-style-css" href="<?php echo $url?>site/wp-content/themes/unschool/style.css?ver=5.6.2" type="text/css" media="all">
<link rel="stylesheet" id="elementor-icons-css" href="<?php echo $url?>site/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.10.0" type="text/css" media="all">
<link rel="stylesheet" id="elementor-animations-css" href="<?php echo $url?>site/wp-content/plugins/elementor/assets/lib/animations/animations.min.css?ver=3.1.1" type="text/css" media="all">
<link rel="stylesheet" id="elementor-frontend-css" href="<?php echo $url?>site/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.1.1" type="text/css" media="all">
<link rel="stylesheet" id="elementor-post-14-css" href="<?php echo $url?>site/wp-content/uploads/elementor/css/post-14.css?ver=1614712564" type="text/css" media="all">
<link rel="stylesheet" id="elementor-global-css" href="<?php echo $url?>site/wp-content/uploads/elementor/css/global.css?ver=1614716423" type="text/css" media="all">
<link rel="stylesheet" id="elementor-post-12-css" href="<?php echo $url?>site/wp-content/uploads/elementor/css/post-12.css?ver=1614716696" type="text/css" media="all">
<link rel="stylesheet" id="google-fonts-1-css" href="./Elementor #12 – Nome do site_files/css" type="text/css" media="all">
<link rel="stylesheet" id="elementor-icons-shared-0-css" href="<?php echo $url?>site/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css?ver=5.15.1" type="text/css" media="all">
<link rel="stylesheet" id="elementor-icons-fa-brands-css" href="<?php echo $url?>site/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min.css?ver=5.15.1" type="text/css" media="all">
<link rel="stylesheet" id="elementor-icons-fa-solid-css" href="<?php echo $url?>site/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css?ver=5.15.1" type="text/css" media="all">
<script type="text/javascript" src="<?php echo $url?>site/wp-includes/js/jquery/jquery.min.js?ver=3.5.1" id="jquery-core-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.3.2" id="jquery-migrate-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-content/themes/unschool/skin/bootstrap/js/bootstrap.js?ver=5.6.2" id="bootstrap-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-content/themes/unschool/js/unschool-toggle.js?ver=5.6.2" id="unschool-toggle-jquery-js"></script>
<link rel="https://api.w.org/" href="<?php echo $url?>site/index.php?rest_route=/"><link rel="alternate" type="application/json" href="<?php echo $url?>site/index.php?rest_route=/wp/v2/pages/12"><link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo $url?>site/xmlrpc.php?rsd">
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo $url?>site/wp-includes/wlwmanifest.xml"> 
<meta name="generator" content="WordPress 5.6.2">
<link rel="canonical" href="<?php echo $url?>site/?page_id=12">
<link rel="shortlink" href="<?php echo $url?>site/?p=12">
<link rel="alternate" type="application/json+oembed" href="<?php echo $url?>site/index.php?rest_route=%2Foembed%2F1.0%2Fembed&amp;url=https%3A%2F%2Flocalhost%2Fescola%2Fsite%2F%3Fpage_id%3D12">
<link rel="alternate" type="text/xml+oembed" href="<?php echo $url?>site/index.php?rest_route=%2Foembed%2F1.0%2Fembed&amp;url=https%3A%2F%2Flocalhost%2Fescola%2Fsite%2F%3Fpage_id%3D12&amp;format=xml">

<script src="chrome-extension://mooikfkahbdckldjjndioackbalphokd/assets/prompt.js"></script></head>
<body class="page-template-default page page-id-12 elementor-default elementor-kit-14 elementor-page elementor-page-12 e--ua-blink e--ua-chrome e--ua-webkit" data-elementor-device-mode="desktop">
<a class="skip-link screen-reader-text" href="<?php echo $url?>site/?page_id=12#contentdiv">
Skip to content</a>
<div id="maintopdiv">
    <div class="header-top">
        <div class="container">
            <div class="row">  
                <div class="col-md-8  col-sm-12 col-lg-8 headercommon header-left">            
                    <ul> 
                        <li>
                  			<i class="fa fa-phone"></i>&nbsp;&nbsp;<?php echo $row['TELEFONE']?>                                                    </li>
<li class="lastemail">
        					<i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?php echo $row['RUA']?><?php if($row['COMPLEMENTO'] != ''){echo '-' . $row['COMPLEMENTO'] . '- ';}else{echo ', ';}?><?php echo $row['BAIRRO']?>, <?php echo $row['CIDADE']?>-<?php echo strtoupper($row['ESTADO'])?>
                                                        
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div> <!--col-sm-3--> 
                
                <div class="col-md-4 col-lg-4 col-sm-12 social-icons headercommon">
                    <ul>
                                                                                                                    </ul>
                    <div class="clear"></div>
                </div><!--col-md-34 col-lg-4 header_right-->
                <div class="clearfix"></div>
            </div><!--row-->
        </div><!--container-->
    </div><!--main-navigations-->


<div class="header-bottom">
    <div class="container">
            <div class="row">  
    <div class="col-md-3  col-lg-3 col-sm-12 header_middle  leftlogo">

                                            <div class="logotxt">
                            <h1><a href=""><?php echo $row['NOME']?></a></h1>
                        </div>
                    

                </div><!--col-md-4 header_middle-->
<div class="col-md-9  col-lg-9 col-sm-12   ">
    <section id="main_navigation">
        
                <div class="main-navigation-inner rightmenu">
                    <div class="toggle">
                        <a class="togglemenu" href="<?php echo $url?>site/?page_id=12#" style="display: none;">Menu</a>
                    </div><!-- toggle --> 
                    <div class="sitenav">
                        <div class="nav">
                        <div class="menu-primary-nav-container"><ul id="menu-primary-nav" class="menu">
                        	<li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-16"><a href="<?php echo $url?>">Início</a></li>
                        	<li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-16"><a href="<?php echo $url?>login.php">Login</a></li><li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-16"><a href="<?php echo $url?>cadastro.php">Cadastre-se</a></li>
</ul></div>                        </div>
                    </div><!-- site-nav -->
                </div><!--<div class=""main-navigation-inner">-->
            
    </section><!--main_navigation-->
</div>
</div><!--row-->
</div><!--container-->
<div class="clearfix"></div>
</div><!--header-bottom-->


    
</div><!--maintopdiv--><section id="banner" class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="row">
                              <img class="img-responsive" src="<?php echo $url?>site/wp-content/themes/unschool/images/innerpage.jpg" alt="Nome do site">   
                </div><!--row-->
</div><!--col-sm-12-->
</div><!--row-->
</section><!--banner--><div class="container" id="contentdiv">
     <div class="row">
         
        <div class="col-md-12 site-main">
        	 <div class="blog-post">
					   
						<div><h1><?php echo $row['NOME']?></h1></div>
						<div>		<div data-elementor-type="wp-post" data-elementor-id="12" class="elementor elementor-12" data-elementor-settings="[]">
							<div class="elementor-section-wrap">
							<section class="elementor-section elementor-top-section elementor-element elementor-element-48f053f elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="48f053f" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-bca7db6" data-id="bca7db6" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-09efc3f elementor-widget elementor-widget-heading" data-id="09efc3f" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h4 class="elementor-heading-title elementor-size-default"><i>"A aprendizagem é um ciclo sem fim"</i></h4>		</div>
				</div>
					</div>
		</div>
							</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-38415ef elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="38415ef" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4007795" data-id="4007795" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-a88881a elementor-widget elementor-widget-heading" data-id="a88881a" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Venha até nós</h2>		</div>
				</div>
					</div>
		</div>
							</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-8ee8ccf elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="8ee8ccf" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-7c1a0cd" data-id="7c1a0cd" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-02a29de elementor-widget elementor-widget-google_maps" data-id="02a29de" data-element_type="widget" data-widget_type="google_maps.default">
				<div class="elementor-widget-container">
			<div class="elementor-custom-embed"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $row['RUA']?><?php if($row['COMPLEMENTO'] != ''){echo '-' . $row['COMPLEMENTO'] . '- ';}else{echo ', ';}?><?php echo $row['BAIRRO']?>, <?php echo $row['CIDADE']?>-<?php echo strtoupper($row['ESTADO'])?>&t=m&z=10&output=embed&iwloc=near" title="<?php echo $row['RUA']?><?php if($row['COMPLEMENTO'] != ''){echo '-' . $row['COMPLEMENTO'] . '- ';}else{echo ', ';}?><?php echo $row['BAIRRO']?>, <?php echo $row['CIDADE']?>-<?php echo strtoupper($row['ESTADO'])?>" aria-label="London Eye, London, United Kingdom"></iframe></div>		</div>
				</div>
					</div>
		</div>
							</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-1055e4d elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="1055e4d" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-2fe1727" data-id="2fe1727" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-6d278cd elementor-widget elementor-widget-heading" data-id="6d278cd" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h4 class="elementor-heading-title elementor-size-default">Mande um WhatsApp para nós😉</h4>		</div>
				</div>
				<div class="elementor-element elementor-element-78a8816 elementor-align-center elementor-widget elementor-widget-button" data-id="78a8816" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a href="tel:<?php echo $row['TELEFONE']?>" class="elementor-button-link elementor-button elementor-size-lg" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon elementor-align-icon-left">
				<i aria-hidden="true" class="fab fa-whatsapp"></i>			</span>
						<span class="elementor-button-text"><?php echo $row['TELEFONE']?></span>
		</span>
					</a>
		</div>
				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-295db22" data-id="295db22" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-34876ee elementor-widget elementor-widget-heading" data-id="34876ee" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h4 class="elementor-heading-title elementor-size-default">Se preferir, temos E-mail também 📩</h4>		</div>
				</div>
				<div class="elementor-element elementor-element-ba98923 elementor-align-center elementor-widget elementor-widget-button" data-id="ba98923" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a href="mailto:<?php echo $row['EMAIL']?>" class="elementor-button-link elementor-button elementor-size-lg" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon elementor-align-icon-left">
				<i aria-hidden="true" class="fas fa-mail-bulk"></i>			</span>
						<span class="elementor-button-text">Clique aqui </span>
		</span>
					</a>
		</div>
				</div>
				</div>
					</div>
		</div>
							</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-a225c5d elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="a225c5d" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-0059332" data-id="0059332" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-fa02aab elementor-widget elementor-widget-heading" data-id="fa02aab" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Temos recursos exclusivos</h2>		</div>
				</div>
					</div>
		</div>
							</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-7fe9730 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="7fe9730" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-531fbba" data-id="531fbba" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-39a05ca elementor-widget elementor-widget-image" data-id="39a05ca" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
					<div class="elementor-image">
										<img width="500" height="500" src="<?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno.png" class="attachment-large size-large" alt="" loading="lazy" srcset="<?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno.png 500w, <?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-300x300.png 300w, <?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-150x150.png 150w" sizes="(max-width: 500px) 100vw, 500px">											</div>
				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-68fe6c8" data-id="68fe6c8" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-950cbbd elementor-widget elementor-widget-image" data-id="950cbbd" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
					<div class="elementor-image">
										<img width="500" height="500" src="<?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-2.png" class="attachment-large size-large" alt="" loading="lazy" srcset="<?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-2.png 500w, <?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-2-300x300.png 300w, <?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-2-150x150.png 150w" sizes="(max-width: 500px) 100vw, 500px">											</div>
				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-2e33262" data-id="2e33262" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-85a24c0 elementor-widget elementor-widget-image" data-id="85a24c0" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
					<div class="elementor-image">
										<img width="500" height="500" src="<?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-3.png" class="attachment-large size-large" alt="" loading="lazy" srcset="<?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-3.png 500w, <?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-3-300x300.png 300w, <?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-3-150x150.png 150w" sizes="(max-width: 500px) 100vw, 500px">											</div>
				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-407a600" data-id="407a600" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-ae73c87 elementor-widget elementor-widget-image" data-id="ae73c87" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
					<div class="elementor-image">
										<img width="500" height="500" src="<?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-4.png" class="attachment-large size-large" alt="" loading="lazy" srcset="<?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-4.png 500w, <?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-4-300x300.png 300w, <?php echo $url?>site/wp-content/uploads/2021/03/Portal-do-aluno-4-150x150.png 150w" sizes="(max-width: 500px) 100vw, 500px">											</div>
				</div>
				</div>
					</div>
		</div>
							</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-921402e elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="921402e" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-e1228af" data-id="e1228af" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-a3e4cda elementor-widget elementor-widget-heading" data-id="a3e4cda" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Entre em contato agora mesmo!</h2>		</div>
				</div>
					</div>
		</div>
							</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-e55f634 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="e55f634" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5479ba2" data-id="5479ba2" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-95f1912 elementor-widget elementor-widget-html" data-id="95f1912" data-element_type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
			<form method="post" action="controller/minha_escola.php?escola=<?php echo $row['CODIGO']?>&&email=<?php echo $row['EMAIL']?>">
			    <label>Seu E-mail:</label>
			    <input type="email" name="email" class="form-control" required=""><br>
			    <label>Assunto:</label>
			    <input type="text" name="assunto" class="form-control" required=""><br>
			    <label>Mensagem</label>
			    <textarea name="message" class="form-control" required="" style="height:200px"></textarea><br>
			    <input type="submit" value="Enviar" class="btn btn-success mt-2">
			</form>		</div>
				</div>
					</div>
		</div>
							</div>
		</section>
						</div>
					</div>
		</div>
						 						                                            </div><!--blog-post -->
             </div><!--col-md-8--> 
                          
        <div class="clearfix"></div>
    </div><!-- row -->
</div><!-- container -->
<!--footer-->

<script type="text/javascript" src="<?php echo $url?>site/wp-includes/js/wp-embed.min.js?ver=5.6.2" id="wp-embed-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-includes/js/comment-reply.min.js?ver=5.6.2" id="comment-reply-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.1.1" id="elementor-webpack-runtime-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.1.1" id="elementor-frontend-modules-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-includes/js/jquery/ui/core.min.js?ver=1.12.1" id="jquery-ui-core-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-content/plugins/elementor/assets/lib/dialog/dialog.min.js?ver=4.8.1" id="elementor-dialog-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2" id="elementor-waypoints-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-content/plugins/elementor/assets/lib/share-link/share-link.min.js?ver=3.1.1" id="share-link-js"></script>
<script type="text/javascript" src="<?php echo $url?>site/wp-content/plugins/elementor/assets/lib/swiper/swiper.min.js?ver=5.3.6" id="swiper-js"></script>
<script type="text/javascript" id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false,"isImprovedAssetsLoading":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"version":"3.1.1","is_static":false,"experimentalFeatures":{"e_dom_optimization":true,"a11y_improvements":true,"landing-pages":true},"urls":{"assets":"https:\/\/localhost\/escola\/site\/wp-content\/plugins\/elementor\/assets\/"},"settings":{"page":[],"editorPreferences":[]},"kit":{"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description"},"post":{"id":12,"title":"Elementor%20%2312%20%E2%80%93%20Nome%20do%20site","excerpt":"","featuredImage":false}};
</script>
<script type="text/javascript" src="<?php echo $url?>site/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.1.1" id="elementor-frontend-js"></script><span id="elementor-device-mode" class="elementor-screen-only"></span>
<script type="text/javascript" src="<?php echo $url?>site/wp-content/plugins/elementor/assets/js/preloaded-elements-handlers.min.js?ver=3.1.1" id="preloaded-elements-handlers-js"></script>
    <script>
        /(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", function () {
            var t, e = location.hash.substring(1);
            /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
        }, !1);
    </script>
    <!-- menu dropdown accessibility -->
    <script type="text/javascript">
    	
jQuery(document).ready(function() {
    jQuery(".nav").unschoolAccessibleDropDown();
});

jQuery.fn.unschoolAccessibleDropDown = function () {
    var el = jQuery(this);

    /* Make dropdown menus keyboard accessible */

    jQuery("a", el).focus(function() {
        jQuery(this).parents("li").addClass("hover");
    }).blur(function() {
        jQuery(this).parents("li").removeClass("hover");
    });
}
    </script>
    
</body></html>
				
			<?php
	}else{
		header('location: index.php');
	}
?>