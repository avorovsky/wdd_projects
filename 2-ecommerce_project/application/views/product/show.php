<?php

    // parse paramaters passed
    $imageNumber = empty($params[1]) ? 0 : $params[1];

?>

<div class="page-heading">
    <div class="page-title">
        <h2><?=$data['name']?></h2>
    </div>
</div>
<!-- Page Header Ends Here -->
<div class="content">
    <!-- Main Container Starts Here -->
    <div class="main-container col1-layout wow bounceInUp animated">
        <div class="main">
            <div class="col-main">
                <!-- Endif Next Previous Product -->
                <div class="product-view wow bounceInUp animated" itemscope="" itemtype="http://schema.org/Product" itemid="#product_base">
                    <div id="messages_product_view"></div>
                    <!--product-next-prev-->
                    <div class="product-essential container">
                        <div class="row">
                            <form action="#" method="post" id="product_addtocart_form">
                                <div class="product-img-box col-lg-5 col-sm-5 col-xs-12">
                                    <!-- Images block -->
                                    <div class="product-image">
<?php

    // get images
    $images = \Models\Image::getListByColumn('product_id', $data['id']);



?>
                                        <div class="product-full">
                                            <img id="product-zoom" src="<?=$images[$imageNumber]['image']?>" data-zoom-image="<?=$images[$imageNumber]['image']?>" alt="<?=$data['name']?>"/>
                                        </div>
                                        <div class="more-views">
                                            <div class="slider-items-products">
                                                <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                                                    <div class="slider-items slider-width-col4 block-content">
<?php

    // create excerpt
    $excerpt = new \Components\Excerpt($data['description'], 50);
    $excerpt = $excerpt->getExcerpt();

    foreach ($images as $key => $value) {

?>
                                                        <!-- Image -->
                                                        <div class="more-views-items">
                                                            <a href="/products/show/<?=$data['id']?>/<?=$key?>" data-image="<?=$value['image']?>"
                                                                        data-zoom-image="<?=$value['image']?>">
                                                                <img id="product-zoom0" src="<?=$value['image']?>" alt="<?=$data['name']?>"/>
                                                            </a>
                                                        </div>
                                                        <!-- /Image -->
<?php } //foreach ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Images block -->
                                </div>
                                <div class="product-shop col-lg- col-sm-7 col-xs-12">
                                    <!-- div class="product-next-prev"><a class="product-next" href="#"><span></span></a> <a class="product-prev" href="#"><span></span></a></div-->
                                    <!-- div class="brand">Beyond Brand One</div-->
                                    <div class="product-name">
                                        <h1><?=$data['name']?></h1>
                                    </div>
                                    <!-- Rating and Reviews Start here -->
                                    <!-- div class="ratings">
                                        <div class="rating-box">
                                            <div style="width:60%" class="rating"></div>
                                        </div>
                                        <p class="rating-links"> <a href="#">Number of Reviews</a> <span class="separator">|</span> <a href="#">Write a Review</a> </p>
                                    </div-->
                                    <div class="price-block">
                                        <div class="price-box">
                                            <p class="special-price">
                                                <span class="price-label">Special Price</span>
                                                <span id="product-price-48" class="price">$<?=number_format($data['price'],2,'.',',')?></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="short-description">
                                        <p><?=$excerpt?></p>
                                    </div>
                                    <!--  Add to Cart Starts here -->
                                    <div class="add-to-box">
                                        <div class="add-to-cart">
                                            <button onclick='window.location.href="/cart/add/<?=$data['id']?>"' class="button btn-cart" title="Add to Cart" type="button">Add to Cart</button>
                                        </div>
                                        <!--  Add to Cart Ends here -->
                                    </div>
                                    <!-- Add to wish list Starts Here -->
                                    <div class="email-addto-box">
                                        <ul class="add-to-links">
                                            <li> <a class="link-wishlist" href="/wishlist/add/<?=$data['id']?>"><span>Add to Wishlist</span></a></li>
                                        </ul>
                                    </div>
                                    <!-- Edit Starts Here -->
                                    <div class="email-addto-box">
                                        <ul class="add-to-links">
                                            <li> <a class="link-wishlist" href="/products/edit/<?=$data['id']?>"><span>Edit</span></a></li>
                                        </ul>
                                    </div>
                                    <ul class="shipping-pro">
                                        <li>Free Wordwide Shipping</li>
                                        <li>30 Days Return</li>
                                    </ul>
                                </div>
                                <!--product-shop-->
                                <!--Detail page static block-->
                            </form>
                        </div>
                    </div>
                    <!--product-essential-->
                    <div class="product-collateral container">
                        <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                            <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Product Description </a> </li>
                            <li> <a href="#reviews_tabs" data-toggle="tab">Reviews</a> </li>
                        </ul>
                        <div id="productTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="product_tabs_description">
                                <div class="std">
                                    <p><?=$data['description']?></p>
                                </div>
                            </div>

                            <!-- Reviews -->
                            <?php include_once(APP.'views'.DS.'modules'.DS.'reviews_product.php'); ?>
                            <!-- /Reviews -->

                        </div>
                    </div>
                </div>
                <!--box-additional-->
                <!--product-view-->
            </div>
        </div>
        <!--col-main-->
    </div>
    <!--main-container-->

    <!-- Trending -->
    <?php include_once(APP.'views'.DS.'modules'.DS.'featured.php'); ?>
    <!-- /Trending -->

</div>