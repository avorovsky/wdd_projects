<?php

    $search_field = $data['search_field'];
    unset($data['search_field']);
?>
<div class="page-heading">
    <div class="page-title">
        <h2>Search result: <?=$search_field?></h2>
    </div>
</div>
<!-- Page Header Ends Here -->
<div class="content">
    <!-- BEGIN Main Container col2-left -->
    <section class="main-container col2-left-layout bounceInUp animated">
        <div class="container">
            <div class="row">
                <div class="col-main col-sm-9 col-sm-push-3 product-list">
                    <div class="pro-coloumn">
                        <article>
                            <!-- Search List start here -->
                            <div class="category-products">
                                <ol class="products-list" id="products-list">
<?php

    foreach ($data as $value) {

?>
                                    <!-- Item -->
                                    <li class="item first" id="search-result-div">
                                        <!-- div class="search-image">
                                            <img class="search-result-image" src="images/beyond-no-image.jpg" />
                                        </div -->
                                        <div class="search-result">
                                            <a href="<?=$value['route']?>">
                                                <h3 class="search-header"><?=$value['view']?></h3>
                                            </a>
                                            <p class="search-text">
                                                <?=preg_replace("/($search_field)/i", "<span class='highlight'>$1</span>", $value['result'])?>
                                            </p>
                                        </div>
                                    </li>
                                    <!-- /Item -->
<?php } //foreach ?>
                                </ol>
                            </div>
                        </article>
                    </div>
                </div>
                <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 wow bounceInUp animated">

                    <!-- Categories menu -->
                    <?php include_once(APP.'views'.DS.'modules'.DS.'categories_menu.php'); ?>
                    <!-- /Categories menu -->

                    <!-- Side slider -->
                    <?php //include_once(APP.'views'.DS.'modules'.DS.'side_slider.php'); ?>
                    <!-- /Side slider -->

                    <!-- Cart preview -->
                    <?php include_once(APP.'views'.DS.'modules'.DS.'cart_preview.php'); ?>
                    <!-- /Cart preview -->

                </aside>
            </div>
        </div>
    </section>
</div>