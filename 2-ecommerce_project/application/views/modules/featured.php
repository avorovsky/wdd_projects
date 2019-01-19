<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title">
            <h2>Featured</h2>
            <h4>Especially for you at Beyond the deals</h4>
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
<?php

    $data = \Models\Product::getList();

    // shuffle an array to get random order
    shuffle($data);

    // cut to first elements
    $dataToOutput = 10;
    $data = array_slice($data, 0, $dataToOutput);

    foreach ($data as $key => $value) {

        // get an image
        $image = \Models\Image::getByColumn('product_id', $value['id']);

?>
                <!-- Item -->
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="/products/show/<?=$value['id']?>" title="<?=$value['name']?>" class="product-image">
                                    <img src="<?=$image?>" alt="<?=$value['name']?>">
                                </a>
                                <div class="item-box-hover">
                                    <div class="box-inner">
                                        <div class="product-detail-bnt"><a class="button detail-bnt"><span>Quick View</span></a></div>
                                        <div class="actions">
                                            <span class="add-to-links">
                                                <a href="/wishlist/add/<?=$value['id']?>" class="link-wishlist" title="Add to Wishlist">
                                                    <span>Add to Wishlist</span>
                                                </a>
                                                <!--a href="#" class="link-compare add_to_compare" title="Add to Compare"><span>Add to Compare</span></a-->
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add_cart">
                                <button onclick='window.location.href="/cart/add/<?=$value['id']?>"' class="button btn-cart" type="button"><span>Add to Cart</span></button>
                            </div>
                        </div>
                        <div class="item-info">
                            <div class="info-inner">
                                <div class="item-title">
                                    <a href="/products/show/<?=$value['id']?>" title="<?=$value['name']?>"><?=$value['name']?></a>
                                </div>
                                <div class="item-content">
                                    <div class="rating">
                                        <div class="ratings">
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%"></div>
                                            </div>
                                            <!--p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a></p-->
                                        </div>
                                    </div>
                                    <div class="item-price">
                                        <div class="price-box">
                                            <span class="regular-price">
                                                <span class="price">$<?=number_format($value['price'],2,'.',',')?></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Item -->

<?php } // foreach ?>

            </div>
        </div>
    </div>
</section>
