<!doctype html>
<html lang="en">
    <head>
        <meta name="robots" content="noindex, nofollow">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- favourites icon -->
        <link rel="shortcut icon" href="<?=IMG?>favicon.ico" type="image/x-icon" />
        <link rel="icon" href="<?=IMG?>favicon.ico" type="image/x-icon" />
        <title>Beyond: Admin</title>
        <!-- Bootstrap core CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font awesome -->
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <!-- CSS Style -->
        <link rel="stylesheet" type="text/css" href="<?=PUB?>css<?=DS?>admin.css">
    </head>
    <body id="admin">
<?php
    // flash message
    $message = new \Components\Message();
    echo $message->getMessage();
?>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/admin"><i class="fas fa-hammer">&nbsp;</i>Beyond the deals</a>

            <!-- Auth -->
            <?php include APP.'views'.DS.'signin'.DS.'admin_auth.php'; ?>
            <!-- /Auth -->

        </nav>