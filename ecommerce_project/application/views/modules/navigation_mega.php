<nav>
    <div class="mm-toggle-wrap">
        <div class="mm-toggle">
            <i class="icon-align-justify"></i>
            <span class="mm-label">Menu</span>
        </div>
    </div>
    <div class="nav-inner">
        <!-- BEGIN NAV -->
        <ul id="nav" class="hidden-xs">
            <li><a class="level-top" href="/"><span>HOME</span></a></li>
            <li class="mega-menu">
                <a class="level-top" href="/products"><span>PRODUCTS</span></a>
                <div class="level0-wrapper dropdown-6col">
                    <div class="container">
                        <div class="level0-wrapper2">
                            <div class="col-1">
                                <div class="nav-block nav-block-center">
                                    <!--mega menu-->
                                    <ul class="level0">
<?php

    $data = \Models\Category::getList(1);

    foreach ($data as $key => $value) {

?>
                                        <!-- Top level cat -->
                                        <li class="level3 nav-6-1 parent item">
                                            <a href="/categories/list/<?=$value['id']?>"><span><?=$value['name']?></span></a>
                                            <ul class="level1">
<?php

        $dataSub = \Models\Category::getListById($value['id']);

        foreach ($dataSub as $keySub => $valueSub) {

?>
                                                <!-- Sub level -->
                                                <li class="level2 nav-6-1-1"> <a href="/categories/list/<?=$valueSub['id']?>"><span><?=$valueSub['name']?></span></a> </li>
                                                <!-- /Sub level -->

<?php   } // foreach ?>

                                            </ul>
                                        </li>
                                        <!-- /Top level cat -->

<?php } // foreach ?>

                                    </ul>
                                </div>
                            </div>
                            <!--col-1-->
                            <div class="col-2">
                                <div class="menu_image">
                                    <a title="Beyond the deals" href="/products">
                                    <img alt="menu_image" src="<?=IMG?>banner.png">
                                    </a>
                                </div>
                            </div>
                            <!--col-2-->
                        </div>
                    </div>
                </div>
            </li>
            <li class="mega-menu"><a class="level-top" href="/news"><span>NEWS</span></a></li>
            <li class="mega-menu"> <a class="level-top" href="/pages/show/about"><span>ABOUT</span></a></li>
            <li class="mega-menu"> <a class="level-top" href="/pages/show/contact"><span>CONTACT</span></a></li>
        </ul>
        <!--nav-->
    </div>
</nav>
