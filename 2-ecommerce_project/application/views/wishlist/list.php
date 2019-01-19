<div class="page-heading">
    <div class="page-title">
        <h2>Your wishlist</h2>
    </div>
</div>
<div class="content">
    <section class="main-container col2-left-layout bounceInUp animated">
        <div class="container">
            <div class="row">
                <div class="col-main col-sm-9 col-sm-push-3 product-list">
                    <div class="pro-coloumn">
                        <article>
                            <div class="category-products">
                                <div class="row">
                                    <section class="col-main col-sm-12 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                                        <div class="my-account">
                                            <div class="my-wishlist">
                                                <form id="wishlist-view-form" action="" method="post">
                                                    <fieldset>
                                                        <input name="form_key" type="hidden" value="EPYwQxF6xoWcjLUr">
                                                        <div class="table-responsive">
                                                            <table class="clean-table linearize-table data-table table-striped" id="wishlist-table">
                                                                <thead>
                                                                    <tr class="first last">
                                                                        <th class="customer-wishlist-item-image"></th>
                                                                        <th class="customer-wishlist-item-info"></th>
                                                                        <!-- th class="customer-wishlist-item-quantity">Quantity</th -->
                                                                        <th class="customer-wishlist-item-price">Price</th>
                                                                        <th class="customer-wishlist-item-cart"></th>
                                                                        <th class="customer-wishlist-item-remove"></th>
                                                                    </tr>
                                                                </thead>
<?php

    foreach ($data as $key => $value) {

        // get a product
        $product = \Models\Product::getById($value['product_id']);

        // get an image
        $image = \Models\Image::getByColumn('product_id', $value['product_id']);

?>
                                                                <!-- Item -->
                                                                <tbody>
                                                                    <tr id="item_32" class="first odd">
                                                                        <td class="wishlist-cell0 customer-wishlist-item-image">
                                                                            <a class="product-image" href="/products/show/<?=$product['id']?>" title="<?=$product['name']?>">
                                                                                <img src="<?=$image?>" width="80" height="80" alt="<?=$product['name']?>">
                                                                            </a>
                                                                        </td>
                                                                        <td class="wishlist-cell1 customer-wishlist-item-info">
                                                                            <h3 class="product-name"><a href="/products/show/<?=$product['id']?>" title="<?=$product['name']?>"><?=$product['name']?></a></h3>
                                                                        </td>
                                                                        <!-- td class="wishlist-cell2 customer-wishlist-item-quantity" data-rwd-label="Quantity">
                                                                            <div class="cart-cell">
                                                                                <div class="add-to-cart-alt">
                                                                                    <input type="text" pattern="\d*" class="input-text qty validate-not-negative-number" name="qty[32]" value="1">
                                                                                </div>
                                                                            </div>
                                                                        </td -->
                                                                        <td class="wishlist-cell3 customer-wishlist-item-price" data-rwd-label="Price">
                                                                            <div class="cart-cell">
                                                                                <div class="price-box">
                                                                                    <span class="regular-price" id="product-price-2">
                                                                                        <span class="price">$<?=number_format($product['price'],2,'.',',')?></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="wishlist-cell4 customer-wishlist-item-cart">
                                                                            <div class="cart-cell">
                                                                                <button onclick='window.location.href="/cart/add/<?=$product['id']?>"' type="button" title="Add to Cart" onClick="addWItemToCart(32);" class="button btn-cart"><span><span>Add to Cart</span></span></button>
                                                                            </div>
                                                                            <div class="edit-wishlist">
                                                                                <a href="#" title="Edit item" class="btn-edit">
                                                                                    <i class="icon-pencil"></i>
                                                                                    <span class="hidden">Edit</span>
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                        <td class="wishlist-cell5 customer-wishlist-item-remove last">
                                                                            <a href="/wishlist/delete/<?=$product['id']?>" title="Remove" class="remove-item">
                                                                                <span><span></span></span>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                                <!-- /Item -->
<?php } //foreach ?>
                                                            </table>
                                                        </div>
                                                        <div class="buttons-set buttons-set2">
                                                            <!-- button type="submit" name="save_and_share" title="Share Wishlist" class="button btn-share"><span>Share Wishlist</span></button -->
                                                            <button type="button" title="Add All to Cart" onClick="addAllWItemsToCart()" class="button btn-add"><span>Add All to Cart</span></button>
                                                            <!-- button type="submit" name="do" title="Update Wishlist" class="button btn-update"><span>Update Wishlist</span></button -->
                                                        </div>
                                                    </fieldset>
                                                </form>
                                                <form id="wishlist-allcart-form" action="" method="post">
                                                    <input name="form_key" type="hidden" value="EPYwQxF6xoWcjLUr">
                                                    <div class="no-display">
                                                        <input type="hidden" name="wishlist_id" id="wishlist_id" value="1">
                                                        <input type="hidden" name="qty" id="qty" value="">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <!--row-->
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