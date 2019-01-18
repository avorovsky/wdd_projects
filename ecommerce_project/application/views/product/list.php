<?php

    // pagination parameters
    $pagination = array(5, 10, 15, 20, 25);

    // parse pagination paramaters passed
    $pageNumber = empty($params[0]) ? 1 : $params[0];
    $itemsPerPage = empty($params[1]) ? $pagination[0] : $params[1];

    // get appropriate page's data and last page number
    $p = new \Components\Paginator($data, $itemsPerPage);
    $pageData = $p->getPage($pageNumber);
    $pagesNum = $p->getPagesNum();

?>

<!-- Title -->
<div class="page-heading">
    <div class="page-title">
        <h2>Products</h2>
    </div>
</div>
<!-- /Title -->
<div class="content">
    <!-- BEGIN Main Container col2-left -->
    <section class="main-container col2-left-layout bounceInUp animated">
        <div class="container">
            <div class="row">
                <div class="col-main col-sm-9 col-sm-push-3 product-list">
                    <div class="pro-coloumn">

                        <!-- Promos slider -->
                        <?php include_once(APP.'views'.DS.'modules'.DS.'promos_slider.php'); ?>
                        <!-- /Promos slider -->

                        <article>
                            <div class="toolbar">
                                <!-- Sorter Starts here -->
                                <!-- div class="sort-by">
                                    <label class="left">Sort By: </label>
                                    <ul>
                                        <li>
                                            <a href="#">Option 1<span class="right-arrow"></span></a>
                                            <ul>
                                                <li><a href="#">Option 2</a></li>
                                                <li><a href="#">Option 3</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <a class="button-asc left" href="#" title="Set Descending Direction"><span class="top_arrow"></span></a> 
                                </div -->
                                <div class="pager">
                                    <div class="limiter">
                                        <!-- Paginator's possible values -->
                                        <label>View: </label>
                                        <ul>
                                            <li>
                                                <a href="/products/list/1/<?=$itemsPerPage?>"><?=$itemsPerPage?><span class="right-arrow"></span></a>
                                                <ul>
<?php

    foreach ($pagination as $value) {

?>
                                                    <li><a href="/products/list/1/<?=$value?>"><?=$value?></a></li>
<?php } //foreach ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pages">
                                        <!-- Paginator -->
                                        <label>Page:</label>
                                        <ul class="pagination">
                                            <li><a href="/products/list/<?= max(1,$pageNumber-1) ?>/<?=$itemsPerPage?>">&laquo;</a></li>
<?php

    for ($i=1; $i<=$pagesNum; $i++) {

        //check for long paginator 
        if ($pagesNum > 5) {
            if ($pageNumber==$i 
                OR $i==1 
                OR $i==$pagesNum 
                OR ($pageNumber<=2 AND ($i>=($pagesNum-1) OR $i<=2)) 
                OR ($pageNumber>=($pagesNum-1) AND ($i<=2 OR $i>=($pagesNum-1)))) {
                // show page marker
?>
                                            <li<?= $pageNumber==$i ? ' class="active"' : '' ?>><a<?= $pageNumber==$i ? ' class="a-disabled"' : '' ?> href="/products/list/<?=$i?>/<?=$itemsPerPage?>"><?=$i?></a></li>
<?php
                unset($dividerShown);
                continue;
            } else {
                if (empty($dividerShown)) { 
                    //show divider
?>
                                            <li><a class="a-disabled" href="/products/list/<?=$pageNumber?>/<?=$itemsPerPage?>">&hellip;</a></li>
<?php
                    // we don't need to repeat divider
                    $dividerShown = 1;
                }
                continue;
            }
        } else {
            // nothing to worry about
            // show page marker
?>
                                            <li<?= $pageNumber==$i ? ' class="active"' : '' ?>><a<?= $pageNumber==$i ? ' class="a-disabled"' : '' ?> href="/products/list/<?=$i?>/<?=$itemsPerPage?>"><?=$i?></a></li>
<?php }} //if //for ?>
                                            <li><a href="/products/list/<?= min($pagesNum,$pageNumber+1) ?>/<?=$itemsPerPage?>">&raquo;</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Products list -->
                            <div class="category-products">
                                <ol class="products-list" id="products-list">
<?php

    foreach ($pageData as $key => $value) {

        // get an image
        $image = \Models\Image::getByColumn('product_id', $value['id']);

        // create excerpt
        $excerpt = new \Components\Excerpt($value['description'], 50);
        $excerpt = $excerpt->getExcerpt();
?>
                                    <!-- Item -->
                                    <li class="item first">
                                        <div class="product-image">
                                            <a href="/products/show/<?=$value['id']?>" title="<?=$value['name']?>">
                                                <img class="small-image" src="<?=$image?>" alt="<?=$value['name']?>">
                                            </a>
                                        </div>
                                        <div class="product-shop">
                                            <h2 class="product-name">
                                                <a href="/products/show/<?=$value['id']?>" title="<?=$value['name']?>"><?=$value['name']?></a>
                                            </h2>
                                            <div class="desc std">
                                                <p><?=$excerpt?><a class="link-learn" title="<?=$value['name']?>" href="/products/show/<?=$value['id']?>">Learn more</a></p>
                                            </div>
                                            <div class="price-box">
                                                <!--p class="old-price"> <span class="price-label"></span> <span id="old-price-212" class="price"> $442.99 </span> </p-->
                                                <p class="special-price">
                                                    <span class="price-label"></span>
                                                    <span id="product-price-212" class="price">$<?=number_format($value['price'],2,'.',',')?></span>
                                                </p>
                                            </div>
                                            <div class="actions">
                                                <button onclick='window.location.href="/cart/add/<?=$value['id']?>"' class="button btn-cart ajx-cart" title="Add to Cart" type="button"><span>Add to Cart</span></button>
                                                <span class="add-to-links">
                                                    <a title="Add to Wishlist" class="button link-wishlist" href="/wishlist/add/<?=$value['id']?>"><span>Add to Wishlist</span></a>
                                                </span> 
                                            </div>
                                        </div>
                                    </li>
                                    <!-- /Item -->
<?php } //foreach ?>
                                </ol>
                            </div>
                            <!-- /Products list -->
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

    <!-- Trending -->
    <?php include_once(APP.'views'.DS.'modules'.DS.'featured.php'); ?>
    <!-- /Trending -->

</div>
