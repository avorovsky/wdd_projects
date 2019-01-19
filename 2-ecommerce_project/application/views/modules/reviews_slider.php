<div class="row">
    <div class="testimonials-section slider-items-products">
        <div  id="testimonials" class="offer-slider parallax parallax-2">
            <div class="slider-items slider-width-col6">
<?php

    $data = \Models\Review::getList();

    // shuffle an array to get random order
    shuffle($data);

    // cut to first elements
    $dataToOutput = 5;
    $data = array_slice($data, 0, $dataToOutput);

    foreach ($data as $key => $value) {

        // get the author
        $author = \Models\User::getById($value['user_id']);

        // get the product
        $product = \Models\Product::getById($value['product_id']);

        // create excerpt
        $excerpt = new \Components\Excerpt($value['description']);
        $excerpt = $excerpt->getExcerpt();

?>
                <!-- Item -->
                <div class="item">
                    <div class="avatar">
                        <a href="/users/show/<?=$value['user_id']?>">
                            <img src="<?=IMG.'users'.DS.$author['image']?>" alt="<?=$author['first_name'].' '.$author['last_name']?>">
                        </a>
                    </div>
                    <div class="testimonials">
                        <?=$excerpt?>
                    </div>
                    <div class="clients_author">
                        <?=$author['first_name'].' '.$author['last_name']?>
                        <span>about <a href="/products/show/<?=$value['product_id']?>"><em><?=$product['name']?></em></a></span>
                    </div>
                </div>
                <!-- /Item -->

<?php } // foreach ?>

            </div>
        </div>
    </div>
</div>
