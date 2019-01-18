<div class="category-description std">
    <div class="slider-items-products">
        <div id="category-desc-slider" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col1 owl-carousel owl-theme">
<?php

    // anything in this directory is a promo banner
    $promosDir = $_SERVER['DOCUMENT_ROOT'].IMG.'promos';
    $data = scandir($promosDir);
 
    foreach ($data as $key => $value) {

        if (!is_dir($promosDir.DS.$value)) {

?>
                <!-- Item -->
                <div class="item">
                    <a class="a-disabled" href="/products">
                        <img alt="promotion banner" src="<?=IMG.'promos'.DS.$value?>">
                    </a>
                    <!-- div class="cat-img-title cat-bg cat-box">
                        <div class="small-tag">Get the best deal</div>
                        <h2 class="cat-heading">for <span>you</span></h2>
                        <p>Up to 40% OFF &sdot; Free Delivery </p>
                    </div-->
                </div>
                <!-- /Item -->

<?php   
        } // if 
    } // foreach
?>

            </div>
        </div>
    </div>
</div>
