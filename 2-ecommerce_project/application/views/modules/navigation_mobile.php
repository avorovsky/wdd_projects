<div id="mobile-menu">
    <ul>
        <li>
            <div class="mm-search">
                <!-- form id="search1" name="search">
                    <div class="input-group">
                        <input type="text" class="form-control simple" placeholder="Search ..." name="srch-term" id="srch-term">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
                        </div>
                    </div>
                </form -->
            </div>
        </li>
        <li>
            <div class="home"><a href="/">Home</a> </div>
        </li>
<?php

    $data = \Models\Category::getList(1);

    foreach ($data as $key => $value) {

?>
        <!-- Top level cat -->
        <li>
            <a href="/categories/list/<?=$value['id']?>"><?=$value['name']?></a>
            <ul>
<?php

        $dataSub = \Models\Category::getListById($value['id']);

        foreach ($dataSub as $keySub => $valueSub) {

?>
                <!-- Sub level -->
                <li>
                    <a href="/categories/list/<?=$valueSub['id']?>"><?=$valueSub['name']?></a>
                </li>
                <!-- /Sub level -->

<?php   } // foreach ?>

            </ul>
        </li>
        <!-- /Top level cat -->

<?php } // foreach ?>

        <li><a href="/about">About</a></li>
    </ul>
    <div class="top-links">
        <ul class="links">
            <!-- li><a title="My Account" href="login.html">My Account</a> </li -->
            <li><a title="Wishlist" href="/wishlist">Wishlist</a> </li>
            <li><a title="Checkout" href="/checkout">Checkout</a> </li>
            <li><a title="Blog" href="/news">News</a> </li>
            <li class="last"><a title="Register" href="/users/new">Register</a> </li>
        </ul>
    </div>
</div>