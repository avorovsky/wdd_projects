<?php
    if (!empty($_SESSION['username']) AND !empty($_SESSION['is_admin'])) {
?>
    <!-- Singout -->
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="/users/signout"><?=$_SESSION['username']?>&nbsp;<i class="fas fa-sign-out-alt"></i>&nbsp;Logout&nbsp;</a>
        </li>
    </ul>
    <!-- /Singout -->

<?php } // endif ?>
