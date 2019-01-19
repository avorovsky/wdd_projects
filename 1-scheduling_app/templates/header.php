<!doctype html>

<html lang="en">
    <head>
        <title>Our courses</title>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex" />
        <meta name="theme-color" content="#044c9e">
        <!-- favorites icon -->
        <link rel="icon" href="<?=IMG?>favicon.ico" type="image/x-icon">
        <!-- embedding Google-font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
        <!-- embedding style -->
        <link href="../public/css/clr-default.css" rel="stylesheet" />
        <link href="../public/css/main.css" rel="stylesheet" />
    </head>

    <body>

        <div id="wrapper">

            <div id="header">
                <div id="logo">
                    <a href="/" title="Homepage">
                        <img src="<?=IMG?>logo.png" alt="Logo" title="Logo" width="40" height="40"/>
                        <span>OUR COURSES</span>
                    </a>
                </div> <!-- /logo -->

                <div id="search">
                    <?php include APP.'views'.DS.'search'.DS.'search.php'; ?>
                </div> <!-- /search -->

                <div id="signin">
                    <?php include APP.'views'.DS.'signin'.DS.'auth.php'; ?>
                </div> <!-- /signin -->

            </div> <!-- /header -->
