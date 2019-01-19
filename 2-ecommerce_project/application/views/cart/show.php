<?php if(empty($_SESSION['cart'])){
  header('Location: /');
  die;
}?>
<!-- Page Header Starts Here -->
<div class="page-heading">

  <div class="page-title">
    <h2>Cart / Checkout</h2>
  </div>
</div>
<!-- Page Header Ends Here -->

<!-- Main Container Starts Here -->
<div class="main-container col1-layout wow bounceInUp animated">
  <div class="main">
    <div class="cart wow bounceInUp animated">
     <div class="table-responsive shopping-cart-tbl  container">
       <form>
         <fieldset>
            <table id="shopping-cart-table" class="data-table cart-table table-striped">
               <colgroup>
                  <col width="1">
                  <col>
                  <col width="1">
                  <col width="1">
                  <col width="1">
                  <col width="1">
                  <col width="1">
               </colgroup>
               <thead>
                  <tr class="first last">
                     <th rowspan="1">&nbsp;</th>
                     <th rowspan="1"><span class="nobr">Product Name</span></th>
                     <th rowspan="1"></th>
                     <th class="a-center" colspan="1"><span class="nobr">Unit Price</span></th>
                     <th rowspan="1" class="a-center">Qty</th>
                     <th class="a-center" colspan="1">Subtotal</th>
                     <th rowspan="1" class="a-center">&nbsp;</th>
                  </tr>
               </thead>
               <tfoot>
                <tr class="first last">
                 <td colspan="8" class="a-right last">
                   <button onclick='window.location.href="/products/list"' type="button" title="Continue Shopping" class="button btn-continue" ><span><span>Continue Shopping</span></span></button>
                   <button onclick='window.location.href="/cart/savecart"' type="button" name="update_cart_action" value="update_qty" title="Save Cart" class="button btn-update"><span><span>Save Cart</span></span></button>
                   <button onclick='window.location.href="/cart/clear"' type="button" name="update_cart_action" value="empty_cart" title="Clear Cart" class="button btn-empty" id="empty_cart_button"><span><span>Clear Cart</span></span></button>
                   <!--<button onclick='window.location.href="/cart/loadcart"' type="button" name="update_cart_action" value="update_qty" title="Save Cart" class="button btn-update"><span><span>Load Cart</span></span></button>-->
                 </td>
                </tr>
               </tfoot>
               <tbody>
                <?php $count = 1;?>
                <?php foreach ($data as $value):?>
                  <?php // get an image
                  $image = \Models\Image::getByColumn('product_id', $value['id']);?>
                <tr class="first last odd">
                  <td class="image hidden-table">
                    <a href="/products/show/<?=$value['id']?>" title="<?=$value['name']?>" class="product-image">
                      <img src="<?=$image?>" width="75" alt="<?=$value['name']?>">
                    </a>
                  </td>
                  <td>
                    <h2 class="product-name">
                      <a href="/products/show/<?=$value['id']?>"><?=$value['name'];?></a>
                    </h2>
                  </td>
                  <td class="a-center hidden-table">
                    <input id="id<?=$count?>" type="hidden" value="<?=$value['id']?>">
                    <a id="link<?=$count?>" href="/cart/update/<?=$value['id']?>/<?=$value['quantity']?>" class="btn-update" title="Update Cart"><span><span>Update Quantity</span></span></a>
                  </td>
                  <td class="a-right hidden-table">
                    <span class="cart-price">
                      <span class="price">$<?=number_format($value['price'],2,'.',',')?></span>
                    </span>
                  </td>
                  <td class="a-center movewishlist">
                    <input id="qty<?=$count?>" name="quantity" value="<?=$value['quantity'];?>" size="5" title="Qty" class="input-text qty" type="number">
                  </td>
                  <td class="a-right movewishlist">
                    <span class="cart-price">
                      <span class="price">$<?=number_format($value['sub_total'],2,'.',',')?></span>
                    </span>
                  </td>
                  <td class="a-center last">
                  <a href="/cart/remove/<?=$value['id'];?>" title="Remove item" class="button remove-item"><span><span>Remove item</span></span></a></td>
                </tr>
                <?php $count++;?>
              <?php endforeach;?>
        </tbody>
      </table>
  </fieldset>
 </form>
</div>
<?php
  if (empty($_SESSION['username'])) {
?>
<!-- BEGIN CART COLLATERALS -->
<div class="cart-collaterals container">
  <div class="row">
     <div class="col-sm-6">
        <div class="login-form">
          <!-- Singin -->
          <div class="col-2">
             <h3>Login</h3>
               <form method="POST" action="/users/signin" id="login-form">
                <fieldset>
                  <?=\Components\Token::getToken();?>
                   <h4>Already registered?</h4>
                   <p>Please log in below:</p>
                   <ul class="form-list">
                      <li>
                         <div class="input-box">
                            <label for="username">Username<em class="required">*</em></label>
                            <br>
                            <input id="login-email" class="input-text required-entry validate-email" type="text" name="username" placeholder="&nbsp;Username" value="<?=(empty($_POST['username']) ? '' : $_POST['username'])?>">
                         </div>
                      </li>
                      <li>
                         <div class="input-box">
                            <label for="password">Password<em class="required">*</em></label>
                            <br>
                            <input class="input-text required-entry" id="password" type="password" name="password" placeholder="&nbsp;Password">
                         </div>
                      </li>
                   </ul>
                   <input name="context" type="hidden" value="checkout">
                </fieldset>
                <div class="buttons-set">
                   <p class="required">* Required Fields</p>
                   <button type="submit" class="button login"><span><span>Login</span></span></button>
                   <button onclick='window.location.href="/users/register"' type="button" class="button"><span><span>register</span></span></button>

                </div>
             </form>
          </div>
          <!-- /Singin -->
        </div>
     </div>
     <!--col-sm-4-->
     <div class="col-sm-6">
       <div class="totals">
          <h3><strong>Shopping Cart Total</strong></h3>
          <div class="inner">
             <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
                <colgroup>
                   <col>
                   <col >
                </colgroup>
                <tfoot>
                   <tr>
                      <td style="" class="a-left" colspan="1">
                         <strong>Grand Total</strong>
                      </td>
                      <td style="" class="a-right">
                         <strong><span class="price">$<?=number_format(\Models\Cart::grandTotalCart($_SESSION['cart']),2,'.',',');?></span></strong>
                      </td>
                   </tr>
                </tfoot>
                <tbody>
                   <tr>
                      <td style="" class="a-left" colspan="1">
                         Subtotal
                      </td>
                      <td style="" class="a-right">
                         <span class="price">$<?=number_format(\Models\Cart::subTotalCart($_SESSION['cart']),2,'.',',');?></span>
                      </td>
                   </tr>
                </tbody>
             </table>

          </div>
          <!--inner-->
       </div>
       <!--totals-->
     </div>
     <!--col-sm-4-->
  </div>
</div>

  <?php } else {
    $user = \Models\User::getById(intval($_SESSION['user_id']));
    $shipping = \Models\Cart::getShipping();
  ?>
      <!-- BEGIN CART COLLATERALS -->
      <div class="cart-collaterals container" style="z-index: 0;">
         <!-- BEGIN COL2 SEL COL 1 -->
         <div class="row">
           <?php if(!empty($_SESSION['is_admin'])){?>
           <!-- Singout -->
           <form method="POST" action="/users/signout">
               <?=\Components\Token::getToken();?>
               <a href="/admin"><i class="fas fa-hammer"></i>&nbsp;Admin&nbsp;</a>
               <button type="submit" name="signin" class="utility-bar-login-btn"><?=$_SESSION['username']?>&nbsp;<i class="fas fa-sign-out-alt"></i>&nbsp;Logout&nbsp;</button>
           </form>
           <!-- /Singout -->
           <?php } // endif ?>
            <!-- BEGIN TOTALS COL 2 -->
            <div class="col-sm-4">
               <div class="shipping">
                  <h3><strong>Estimate Shipping and Tax</strong></h3>
                  <div class="shipping-form">
                     <!--<h3><strong>SHIPPING METHOD</strong></h3>-->
                     <form action="" method="post" id="shipping-zip-form">
                        <ul class="form-list">
                           <li>
                              <label for="region_id"></label>
                              <div class="input-box">
                                 <select id="region_id" name="region_id" title="State/Province" class="required-entry validate-select">
                                  <option value="0">Please Select Your Favorite Shipping Method</option>
                                  <?php foreach ($shipping as $key => $value):?>
                                  <option id="<?=$value['id']?>" value="<?=$value['id']?>" title="<?=$value['name']?>"><?=ucfirst($value['name'])?></option>
                                  <?php endforeach;?>
                                 </select>
                              </div>
                           </li>
                        </ul>
                        <div class="shipping-image">
                           <img src="<?=IMG."shipping".DS."ship_it.png"?>" alt="Shipping Methods"/>
                        </div>
                     </form>
                     <h3><strong>PRODUCT WILL BE SHIPPED TO:</strong></h3>
                     <h4><strong><?=$user['first_name']?> <?=$user['last_name']?></strong></h4>
                     <h4><?=$user['address']?>,</h4>
                     <h4><?=$user['city']?>, <?=$user['province']?></h4>
                     <h4><?=$user['postal_code']?></h4>
                     <h4>Phone: <?=$user['phone']?></h4>
                     <h4>Email: <?=$user['email']?></h4>
                     <hr>
                     <h2><strong>SHIPPING ESTIMATE: </strong>$ <span id="ship_cost">0.00</span></h2>
                  </div>
               </div>
            </div>
            <!--col-sm-4-->
            <div class="col-sm-4">
               <!--
                  <div class="discount">
                  <h3><strong>Have A Discount Coupon</strong></h3>
                  <form id="discount-coupon-form" action="" method="post">
                       <label for="coupon_code">Enter your coupon code if you have one.</label>
                       <input type="hidden" name="remove" id="remove-coupone" value="0">
                           <input class="input-text fullwidth" type="text" id="coupon_code" name="coupon_code" value="">
                             <button type="button" title="Apply Coupon" class="button coupon " onClick="discountForm.submit(false)" value="Apply Coupon"><span>Apply Coupon</span></button>

                  </form>

                  </div>
                  -->
            </div>
            <!--col-sm-4-->
            <div class="col-sm-4">
               <div class="totals">
                  <h3><strong>Shopping Cart Total</strong></h3>
                  <div class="inner">
                     <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
                        <colgroup>
                           <col>
                           <col>
                        </colgroup>
                           <tr>
                              <td style="" class="a-left" colspan="1">
                                 Subtotal
                              </td>
                              <td style="" class="a-right">
                                 <span class="price">$<?=number_format(\Models\Cart::subTotalCart($_SESSION['cart']),2,'.',',');?></span>
                              </td>
                           </tr>
                           <tr>
                              <td style="" class="a-left" colspan="1">
                                 Taxes
                              </td>
                              <td style="" class="a-right">
                                 <span class="price">$<?=number_format(\Models\Cart::taxesCart($_SESSION['cart']),2,'.',',');?></span>
                              </td>
                           </tr>
                           <tr>
                              <td style="" class="a-left" colspan="1">
                                 <strong>Grand Total</strong>
                              </td>
                              <td style="" class="a-right">
                                 <strong><span class="price">$<?=number_format(\Models\Cart::grandTotalCart($_SESSION['cart']),2,'.',',');?></span></strong>
                              </td>
                           </tr>
                     </table>
                     <ul class="checkout">
                        <li>
                           <button onclick='window.location.href="/checkout/show"' type="button" title="Proceed to Checkout" class="button btn-proceed-checkout" ><span>Proceed to Checkout</span></button>
                        </li>
                     </ul>
                  </div>
                  <!--inner-->
               </div>
               <!--totals-->
            </div>
            <!--col-sm-4-->
         </div>
         <!--cart-collaterals-->
      </div>
  <?php } // endif ?>

</div>  <!--cart-->
<!-- pre>
  <?php //var_dump($_SESSION['cart'])?>
</pre -->
<!--product-essential-->
<div class="product-collateral container">
<ul id="product-detail-tab" class="nav nav-tabs product-tabs">
<li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Terms & Conditions </a> </li>


</ul>
<div id="productTabContent" class="tab-content">
<div class="tab-pane fade in active" id="product_tabs_description">
  <div class="std">

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Mauris vel tellus non nunc mattis lobortis. vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante.
    <p> Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer enim purus, posuere at ultricies eu, placerat a felis. Suspendisse aliquet urna pretium eros convallis interdum. Quisque in arcu id dui vulputate mollis eget non arcu. Aenean et nulla purus. Mauris vel tellus non nunc mattis lobortis. vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit.</p>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Mauris vel tellus non nunc mattis lobortis. vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. </p>
  </div>
</div>



</div>
</div>

</div><!--main-container-->
