<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>news</title>
        <meta name="description" content="<?php echo \Fermion\App::get('config')['pages'][$page]['description'] ?>">
        <meta name="keywords" content="<?php echo \Fermion\App::get('config')['pages'][$page]['keywords'] ?>">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />

		<link rel="stylesheet" href="<?php echo SITE_URL ?>/css/packages/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo SITE_URL ?>/css/packages/jquery-ui.min.css">
		<link rel="stylesheet" href="<?php echo SITE_URL ?>/css/packages/jquery-ui.theme.min.css">
		<link rel="stylesheet" href="<?php echo SITE_URL ?>/css/custom/style.css">
    
    </head>
    <body class="container">    
		<header>
			<a class="logo" href="<?php echo SITE_URL ?>"><img src="<?php echo SITE_URL ?>/img/logo.png"></a>
			<ul class="list-inline">
				<li><a href="<?php echo SITE_URL ?>">News</a></li>
			</ul>
		</header>
    
		<div class="container">
		
			<div id="notifications">
				<?php \Fermion\App::get('helper')->flash() ?>
			</div>
<!-- end header.php -->