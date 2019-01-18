<?php 
    if (empty($_SESSION['username'])) {
?>

    <!-- Singin -->
    <form method="POST" action="/users/signin" class="utility-form">
        <?=\Components\Token::getToken();?>
        <input type="text" name="username" placeholder="&nbsp;Username" value="<?=(empty($_POST['username']) ? '' : $_POST['username'])?>">
        <input type="password" name="password" placeholder="&nbsp;Password">
        <button type="submit" name="signin" class="utility-bar-login-btn">&nbsp;<i class="fas fa-sign-in-alt"></i>&nbsp;Login</button>
        <a class="active" href="/cart/show"><i class="fas fa-shopping-cart"></i><span class="badge"><?=include(APP.'views'.DS.'modules'.DS.'cart_icon.php')?></span></a>
        <!--
        -->
    </form>
    <!-- /Singin -->

<?php } else { ?>

    <!-- Singout -->
    <form method="POST" action="/users/signout">
        <?=\Components\Token::getToken();?>
<?php
    if (!empty($_SESSION['is_admin'])) {
?>
        <a href="/admin"><i class="fas fa-hammer"></i>&nbsp;Admin&nbsp;</a>
<?php } // endif ?>
        <a href="/wishlist"><i class="fas fa-heart"></i>&nbsp;Wishlist&nbsp;</a>
        <a class="active" href="/cart/show"><i class="fas fa-shopping-cart"></i><span class="badge"><?=include(APP.'views'.DS.'modules'.DS.'cart_icon.php')?></span></a>
        <button type="submit" name="signin" class="utility-bar-login-btn"><?=$_SESSION['username']?>&nbsp;<i class="fas fa-sign-out-alt"></i>&nbsp;Logout&nbsp;</button>
    </form>
    <!-- /Singout -->

<?php } // endif ?>
