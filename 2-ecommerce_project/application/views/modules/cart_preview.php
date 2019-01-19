<div class="block block-list block-cart">
    <div class="block-title">My Cart</div>
    <div class="block-content">
      <?php if(!empty($_SESSION['cart'])) :?>
        <div class="summary">
            <p class="amount">There is <a href="#"><?=include(APP.'views'.DS.'modules'.DS.'cart_icon_items.php')?> item(s)</a> in your cart.</p>
            <p class="subtotal"> <span class="label">Cart Subtotal:</span> <span class="price">$<?=number_format(\Models\Cart::subTotalCart($_SESSION['cart']),2,'.',',');?></span> </p>
        </div>
        <div class="ajax-checkout">
            <button type="button" title="Checkout" class="button button-checkout" onclick='window.location.href="/cart/show"'> <span>Checkout</span> </button>
        </div>
        <p class="block-subtitle">Recently added item(s)</p>
        <ul id="cart-sidebar1" class="mini-products-list">
        <?php foreach ($_SESSION['cart'] as $key => $value) :?>
            <li class="item">
                <div class="item-inner">
                  <?php // get an image
                  $image = \Models\Image::getByColumn('product_id', $value['id']);?>
                    <a href="/product/show/<?=$value['id']?>" class="product-image"><img src="<?=$image?>" width="80" alt="product"></a>
                    <div class="product-details">
                        <div class="access"> <a href="/cart/remove/<?=$value['id']?>" class="btn-remove1">Remove</a>
                            <a href="/cart/show" title="Edit item" class="btn-edit">
                            <i class="icon-pencil"></i><span class="hidden">Edit item</span></a>
                        </div>
                        <!--access-->
                        <strong><?=$value['quantity']?></strong> x <span class="price">$<?=$value['price']?></span>
                        <p class="product-name"><a href="/product/show/<?=$value['id']?>"><?=$value['name']?></a></p>
                    </div>
                    <!--product-details-bottoms-->
                </div>
            </li>
          <?php endforeach;?>
        </ul>
      <?php else :?>
        <div class="summary">
          <p class="block-subtitle">Your Shopping Cart is empty.</p>
          <p class="amount">There is <strong>0 items</strong> in your cart.</p>
          <p class="subtotal"> <span class="label">Cart Subtotal:</span> <span class="price">$0</span></p>
        </div>
        <!--<div class="ajax-checkout">
            <button type="button" title="Checkout" class="button button-checkout" onClick="#"> <span>Checkout</span> </button>
        </div>-->
      <?php endif?>
    </div>
</div>
