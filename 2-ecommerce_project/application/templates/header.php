<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="robots" content="noindex, nofollow">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Beyond The Deals</title>
        <!-- favourites icon -->
        <link rel="shortcut icon" href="<?=IMG?>favicon.ico" type="image/x-icon" />
        <link rel="icon" href="<?=IMG?>favicon.ico" type="image/x-icon" />
        <!-- CSS Style -->
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>font-awesome.css" media="all">
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>revslider.css" >
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>owl.theme.css">
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>jquery.bxslider.css">
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>jquery.mobile-menu.css">
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>style.css" media="all">
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>responsive.css" media="all">
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>final.css" media="all">
    </head>
    <body>
        <div id="page">
        <header>
            <div class="container">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="header-banner">
                                <div class="assetBlock">
                                    <div id="slideshow">
<?php
    // flash message
    $message = new \Components\Message();
    echo $message->getMessage(0);
?>
                                    </div>
                                    <div class="icon-bar">

                                        <!-- Auth -->
                                        <?php include APP.'views'.DS.'signin'.DS.'auth.php'; ?>
                                        <!-- /Auth -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="header">
                <div class="container">
                    <div class="header-container row">
                        <div class="logo">
                            <a href="/" title="index">
                                <div>
                                    <img src="<?=IMG?>logo.png" alt="logo">
                                </div>
                            </a>
                        </div>
                        <div class="fl-nav-menu">

                            <!-- Mega nav -->
                            <?php include APP.'views'.DS.'modules'.DS.'navigation_mega.php'; ?>
                            <!-- /Mega nav -->

                        </div>
                        <!--row-->
                        <div class="fl-header-right">
                            <div class="fl-links">
                                <div class="no-js">
                                    <a title="Personal" class="clicker"></a>
                                    <div class="fl-nav-links">
                                        <ul class="links">
                                            <!-- li><a href="/account" title="My Account">My Account</a></li -->
                                            <li><a href="/wishlist" title="Wishlist">Wishlist</a></li>
                                            <li><a href="/checkout" title="Checkout">Checkout</a></li>
                                            <li><a href="/news" title="Blog"><span>Blog</span></a></li>
                                            <li><a href="/games/run/animation" title="Win"><span>Win your discount</span></a></li>
                                            <li><a href="/games/run/game" title="Promo"><span>Get promo code</span></a></li>
                                            <?php if (empty($_SESSION['user_id'])) { ?>
                                                <li class="last"><a href="/users/new" title="Register"><span>Register</span></a></li>
                                            <?php } else { ?>
                                                <li class="last"><a href="/users/edit/<?=$_SESSION['user_id']?>" title="Profile"><span>Profile</span></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse navbar-collapse">

                                <!-- Search --> 
                                <?php include APP.'views'.DS.'search'.DS.'search.php'; ?>
                                <!-- /Search -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>