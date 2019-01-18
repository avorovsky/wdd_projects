<div class="top-cate">
    <div class="featured-pro container">
        <div class="row">
            <div class="slider-items-products">
                <div id="top-categories" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4 products-grid">
<?php

    $data = \Models\Category::getList(1);

    foreach ($data as $key => $value) {

?>
                        <!-- Item -->
                        <div class="item">
                            <a href="/categories/list/<?=$value['id']?>">
                                <div class="pro-img"><img src="<?=IMG.'categories'.DS.$value['image']?>" alt="<?=$value['name']?>">
                                    <div class="pro-info"><?=$value['name']?></div>
                                </div>
                            </a>
                        </div>
                        <!-- /Item -->

<?php } // foreach ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
