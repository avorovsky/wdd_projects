<?php
  $user = \Models\User::getById(intval($_SESSION['user_id']));
  $shipping = \Models\Cart::getShipping();
?>

    <!-- Page Header Starts Here -->
    <div class="page-heading">

      <div class="page-title">
        <h2>Checkout / Payment</h2>
      </div>
    </div>
    <!-- Page Header Ends Here -->
    <div class="content">

      <!-- Main Container Starts Here -->
            <div class="cart-collaterals container" style="z-index:0;">
              <!-- BEGIN COL2 SEL COL 1 -->
              <div class="row">
                <!-- Billing Info Starts Here -->
                <div class="row">
                  <aside class="col-right sidebar col-sm-3 wow bounceInUp animated animated">
                    <div id="checkout-progress-wrapper">
                      <div class="block block-progress">
                        <div class="block-title">
                          Your Checkout </div>
                        <div class="block-content">
                          <dl>
                            <div id="billing-progress-opcheckout">
                              <dt class="">
                                Billing Address</dt>
                            </div>

                            <div id="shipping-progress-opcheckout">
                              <dt class="">
                                Shipping Address</dt>

                            </div>

                            <div id="shipping_method-progress-opcheckout">
                              <dt class="">
                                Shipping Method</dt>

                            </div>

                            <div id="payment-progress-opcheckout">
                              <dt class="">
                                Payment Method</dt>

                            </div>
                          </dl>
                        </div>
                      </div>
                    </div>
                  </aside>
                  <!--col-right sidebar-->
                  <section class="col-main col-sm-9 wow bounceInUp animated animated">
                    <ol class="one-page-checkout" id="checkoutSteps">
                      <li id="opc-billing" class="section allow active">
                        <div class="step-title">
                          <span class="number">1</span>
                          <h3 class="one_page_heading"> Billing Information</h3>
                        </div>
                        <div id="checkout-step-billing" class="step a-item">
                          <form>
                            <fieldset class="group-select">
                              <ul class="">
                                <li id="billing-new-address-form">
                                  <fieldset>
                                    <input readonly type="hidden" name="billing[address_id]" value="27006" id="billing:address_id">
                                    <ul>
                                      <li class="fields">
                                        <div class="customer-name">
                                          <div class="input-box name-firstname">
                                            <label for="firstname">First Name<span class="required">*</span></label>
                                            <div class="input-box1">
                                              <input readonly type="text" id="billing:firstname" name="billing[firstname]" value="<?=$user['first_name']?>" title="First Name" maxlength="255" class="input-text required-entry">
                                            </div>
                                          </div>
                                          <div class="input-box name-lastname">
                                            <label for="billing:lastname">Last Name<span class="required">*</span></label>
                                            <div class="input-box1">
                                              <input readonly type="text" value="<?=$user['last_name']?>" title="Last Name" maxlength="255" class="input-text required-entry">
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                      <li class="wide">
                                        <div class="input-box">
                                          <label for="billing:street1">Address<em class="required">*</em></label><br>
                                          <input readonly type="text" title="Street Address" name="billing[street][]" id="billing:street1" value="<?=$user['address']?>"  class="input-text  required-entry">
                                        </div>
                                      </li>
                                      <li class="fields">
                                        <div class="input-box">
                                          <label for="billing:city">City<em class="required">*</em></label>
                                          <input readonly type="text" title="City" name="billing[city]" value="<?=$user['city']?>" class="input-text  required-entry" id="billing:city">
                                        </div>
                                        <div class="input-box">
                                          <label for="billing:city">State/Province<em class="required">*</em></label>
                                          <input readonly type="text" title="City" name="billing[city]" value="<?=$user['province']?>" class="input-text  required-entry" id="billing:city">
                                        </div>
                                      </li>
                                      <li class="fields">
                                        <div class="input-box">
                                          <label for="billing:postcode">Zip/Postal Code<em class="required">*</em></label>
                                          <input readonly type="text" title="Zip/Postal Code" name="billing[postcode]" id="billing:postcode" value="<?=$user['postal_code']?>" class="input-text validate-zip-international  required-entry">
                                        </div>
                                        <div class="input-box">
                                          <label for="billing:postcode">Country<em class="required">*</em></label>
                                          <input readonly type="text" title="Zip/Postal Code" name="billing[postcode]" id="billing:postcode" value="<?=$user['country']?>" class="input-text validate-zip-international  required-entry">
                                        </div>
                                      </li>
                                      <li class="fields">
                                        <div class="input-box">
                                          <label for="billing:telephone">Telephone<em class="required">*</em></label>

                                          <input readonly type="text" name="billing[telephone]" value="<?=$user['phone']?>" title="Telephone" class="input-text  required-entry" id="billing:telephone">

                                        </div>
                                      </li>
                                    </ul>
                                  </fieldset>
                                </li>
                              </ul>
                            </fieldset>
                          </form>
                        </div>
                      </li>
                      <li id="opc-shipping" class="section">
                        <div class="step-title">
                          <span class="number">2</span>
                          <h3 class="one_page_heading"> Shipping Information</h3>
                        </div>
                        <div id="checkout-step-shipping" class="step a-item" style="">

                          <form>
                            <ul class="">
                              <li id="shipping-new-address-form" style="">
                                <fieldset class="group-select">
                                  <ul>
                                    <li class="wide">
                                      <label for="shipping:street1">Shipping to <em class="required">*</em></label><br>
                                      <input readonly type="text" title="Street Address" name="shipping[street][]" id="shipping:street1" value="<?=$user['first_name']?>, <?=$user['last_name']?>, <?=$user['address']?>, <?=$user['province']?>, <?=$user['city']?>, <?=$user['postal_code']?>, <?=$user['country']?>" class="input-text  required-entry">
                                    </li>
                                  </ul>
                                </fieldset>
                              </li>
                            </ul>
                          </form>
                        </div>
                      </li>
                      <li id="opc-shipping_method" class="section">
                        <div class="step-title">
                          <span class="number">3</span>
                          <h3 class="one_page_heading"> Shipping Method</h3>
                        </div>
                        <div id="checkout-step-shipping_method" class="step a-item" style="">
                          <form>
                            <ul class="">
                              <?php if(!empty($_SESSION['shipping'])):?>
                              <li id="shipping-new-address-form" style="">
                                <fieldset class="group-select">
                                  <ul>
                                    <li class="wide">
                                      <label for="shipping:street1">Shipping method <em class="required">*</em></label><br>
                                      <input readonly type="text" title="Street Address" value="<?=$_SESSION['shipping']['ship_method']?>" class="input-text  required-entry">
                                    </li>
                                    <li class="wide">
                                      <label for="shipping:street1">Shipping Price <em class="required">*</em></label><br>
                                      <input readonly type="text" title="Street Address"value="<?=$_SESSION['shipping']['ship_cost']?>" class="input-text  required-entry">
                                    </li>
                                  </ul>
                                </fieldset>
                              </li>
                              <?php else :?>
                              <div class="buttons-set" id="payment-buttons-container">
                                <p class="required">You haven't add a shipping method.</p>
                                <button type="button" class="button back" onclick='window.location.href="/cart/show"'><span>Go back to cart</span></button>
                              </div>
                              <?php endif;?>
                            </ul>
                          </form>
                        </div>

                      </li>
                      <li id="opc-payment" class="section">
                        <div class="step-title">
                          <span class="number">4</span>
                          <h3 class="one_page_heading"> Payment Information</h3>
                        </div>
                        <div id="checkout-step-payment" class="step a-item" style="/**/">
                          <?php
                          //create the function that can escape the output in quotes
                          function esc_attr($string)
                          {
                            return htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false);
                          } ?>
                          <form method="POST" action="/checkout/payment/<?=$user['id']?>" id="payment-form">
                            <?=\Components\Token::getToken();?>
                            <fieldset class="group-select">
                              <ul class="">
                                <li>
                                  <fieldset>
                                    <ul>
                                      <li class="fields">
                                        <div class="customer-name">
                                          <div class="input-box name-firstname">
                                            <label for="card_name">Name on card<span class="required">*</span></label>
                                            <div class="input-box1">
                                              <input type="text" id="card_name" name="card_name" value="<?php if(!isset($_POST['card_name'])){
                         			                                                                                echo "";
                                                                                       			                  }else{echo esc_attr($_POST['card_name']);}?>"
                                                                                                              title="Name on card" maxlength="255" class="input-text required-entry">
                                            </div>
                                          </div>
                                          <div class="input-box" style="width:25%;">
                                            <label for="card_month">Month<em class="required">*</em></label>
                                            <br>
                                            <select name="card_month" id="card_month" class="validate-select" title="Month" style="margin-top: 5px; height: 42px;">
                                              <?php for ($i = 01; $i <= 12 ; $i++):?>
                                              <option value="<?=$i?>"><?=$i?></option>
                                              <?php endfor;?>
                                            </select>
                                          </div>
                                          <div class="input-box" style="width:25%;">
                                            <label for="card_year">Year<em class="required">*</em></label>
                                            <br>
                                            <select name="card_year" id="card_year" class="validate-select" title="Year" style="margin-top: 5px; height: 42px;">
                                              <?php for ($i = 18; $i <= 38 ; $i++):?>
                                              <option value="<?=$i?>"><?=$i?></option>
                                              <?php endfor;?>
                                            </select>
                                          </div>
                                        </div>
                                      </li>
                                      <li class="wide">
                                        <div class="input-box">
                                          <label for="card_num"><strong>Card number</strong><em class="required">*</em></label><br>
                                          <input type="text" title="Card number" name="card_num" id="card_num" value="<?php if(!isset($_POST['card_num'])){
                                                                                                          echo "";
                                                                                                          }else{echo esc_attr($_POST['card_num']);}?>"
                                                                                                          class="input-text required-entry">
                                        </div>
                                        <div class="input-box" style="width:25%;">
                                          <label for="card_cvv"><strong>CVV number</strong><em class="required">*</em></label><br>
                                          <input type="text" title="CVV number" name="card_cvv" id="card_cvv" value="" class="input-text required-entry">
                                        </div>
                                        <div class="input-box" style="width:25%;">
                                          <label for="card_type">Card Type<em class="required">*</em></label>
                                          <br>
                                          <select name="card_type" id="card_type" class="validate-select" title="Card Type" style="margin-top: 5px; height: 42px;">
                                            <option value="visa">visa</option>
                                            <option value="mastercard">mastercard</option>
                                            <option value="amex">amex</option>
                                          </select>
                                        </div>
                                      </li>
                                    </ul>
                                  </fieldset>
                                </li>
                              </ul>
                            </fieldset>
                            <div class="tool-tip" id="payment-tool-tip" style="">
                              <div class="btn-close"><a href="#" id="payment-tool-tip-close" title="Close">Close</a></div>
                              <div class="tool-tip-content">Card Verification Number Visual Reference</div>
                            </div>
                        </div>
                      </li>
                      <li id="opc-review" class="section">
                        <div class="step-title">
                          <span class="number">5</span>
                          <h3 class="one_page_heading"> Order Review</h3>
                        </div>
                        <div id="checkout-step-review" class="step a-item" style="">
                          <div class="order-review" id="checkout-review-load">
                            <table style="width:100%">
                              <tr class="first last">
                                <th rowspan="1">&nbsp;</th>
                                <th rowspan="1"><span class="nobr">Product Name</span></th>
                                <th rowspan="1"></th>
                                <th rowspan="1" class="a-center">
                                  <div class="a-center movewishlist">
                                    Qty
                                  </div>
                                </th>
                                <th class="a-center" colspan="1">&nbsp;Subtotal</th>
                              </tr>
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
                                      <span>
                                        <a href="/products/show/<?=$value['id']?>"><?=$value['name'];?></a>
                                      </span>
                                    </h2>
                                  </td>
                                  <td class="a-right hidden-table">
                                  </td>
                                  <td class="a-center movewishlist">
                                    <div class="a-center movewishlist">
                                      <?=$value['quantity'];?>
                                    </div>
                                  </td>
                                  <td class="a-right movewishlist">
                                    <span class="cart-price">
                                      <span class="price">$<?=number_format($value['sub_total'],2,'.',',')?></span>
                                    </span>
                                  </td>
                                </tr>
                              <?php endforeach;?>
                              <tr class="order-summary-separator">
                                <td colspan="6"><hr></td>
                              </tr>
                              <tr class="first last odd">
                                </td>
                                <td>
                                  <td class="a-right hidden-table">
                                    <h2 class="product-name" style="text-align: left!important;">
                                      Items:
                                    </h2>
                                  </td>
                                </td>
                                <td class="a-right hidden-table">
                                </td>
                                <td class="a-center movewishlist">
                                  <div class="a-center movewishlist">
                                    CDN
                                  </div>
                                </td>
                                <td class="a-right movewishlist">
                                  <span class="cart-price">
                                    <span class="price">$&nbsp;<span class="price"><?=((!empty($_SESSION['alexa']['sub_total'])) ? number_format($_SESSION['alexa']['sub_total'],2,'.',',') :  number_format(0,2,'.',','))?></span>
                                  </span>
                                </td>
                              </tr>
                              <tr class="first last odd">
                                <td>

                                </td>
                                <td class="a-right hidden-table">
                                  <h2 class="product-name" style="text-align: left!important;">
                                    Shipping &amp; Handling:&nbsp;
                                  </h2>
                                </td>
                                <td class="a-right hidden-table">
                                </td>
                                <td class="a-center movewishlist">
                                  <div class="a-center movewishlist">
                                    CDN
                                  </div>
                                </td>
                                <td class="a-right movewishlist">
                                  <span class="cart-price">
                                    <span class="price">$&nbsp;<?=((!empty($_SESSION['shipping']['ship_cost'])) ? number_format($_SESSION['shipping']['ship_cost'],2,'.',',') :  number_format(0,2,'.',','))?></span>
                                  </span>
                                </td>
                              </tr>
                              <tr class="order-summary-separator">
                                <td colspan="6"><hr></td>
                              </tr>
                              <tr class="first last odd">
                                <td>

                                </td>
                                <td class="a-right hidden-table">
                                  <h2 class="product-name" style="text-align: left!important;">
                                    Total before tax:
                                  </h2>
                                </td>
                                <td class="a-right hidden-table">
                                </td>
                                <td class="a-center movewishlist">
                                  <div class="a-center movewishlist">
                                    CDN
                                  </div>
                                </td>
                                <td class="a-right movewishlist">
                                  <span class="cart-price">
                                    <span class="price"></span><span class="price">$&nbsp;<?=((!empty($_SESSION['alexa']['with_ship'])) ? number_format($_SESSION['alexa']['with_ship'],2,'.',',') :  number_format(0,2,'.',','))?></span></span>
                                  </span>
                                </td>
                              </tr>
                              <tr class="first last odd">
                                <td>

                                </td>
                                <td class="a-right hidden-table">
                                  <h2 class="product-name" style="text-align: left!important;">
                                    Estimated taxes:
                                  </h2>
                                </td>
                                <td class="a-right hidden-table">
                                </td>
                                <td class="a-center movewishlist">
                                  <div class="a-center movewishlist">
                                    CDN
                                  </div>
                                </td>
                                <td class="a-right movewishlist">
                                  <span class="cart-price">
                                    <span class="price">$&nbsp;<?=((!empty($_SESSION['alexa']['taxes'])) ? number_format($_SESSION['alexa']['taxes'],2,'.',',') :  number_format(0,2,'.',','))?></span>
                                  </span>
                                </td>
                              </tr>
                              <tr class="order-summary-separator">
                                <td colspan="6"><hr></td>
                              </tr>
                              <tr class="first last odd">
                                <td>

                                </td>
                                <td class="a-right hidden-table">
                                  <h2 class="product-name" style="text-align: left!important;">
                                    Order Total:
                                  </h2>
                                </td>
                                <td class="a-right hidden-table">
                                </td>
                                <td class="a-center movewishlist">
                                  <div class="a-center movewishlist">
                                    CDN
                                  </div>
                                </td>
                                <td class="a-right movewishlist">
                                  <span class="cart-price">
                                    <span class="price">$&nbsp;<?=((!empty($_SESSION['alexa']['total'])) ? number_format($_SESSION['alexa']['total'],2,'.',',') :  number_format(0,2,'.',','))?></span>
                                  </span>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </li>
                    </ol>
                    <br />
                    <div class="buttons-set" id="payment-buttons-container">
                      <!--<p class="required">* Required Fields</p>-->
                      <button type="submit" class="button continue"><span>Place your Order</span></button>
                      <a href="/cart/show">Back to cart</a>
                    </div>
                  </form>
                  </section>
                </div>
                <!--row-->
              </div>
              <!--cart-collaterals-->
            </div>
          <!--cart-->
          <!--product-essential-->
          <div class="product-collateral container">
            <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
              <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Terms & Conditions </a> </li>


            </ul>
            <div id="productTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="product_tabs_description">
                <div class="std">

                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate
                    adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa.
                    Mauris vel tellus non nunc mattis lobortis. vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit.
                    Donec ac tempus ante.
                    <p> Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean
                      eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer enim purus,
                      posuere at ultricies eu, placerat a felis. Suspendisse aliquet urna pretium eros convallis interdum. Quisque in arcu id dui vulputate mollis eget non arcu. Aenean et nulla purus. Mauris vel tellus non nunc mattis lobortis.
                      vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies
                      massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus
                      feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit.</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate
                      adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa.
                      Mauris vel tellus non nunc mattis lobortis. vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget
                      velit. Donec ac tempus ante. </p>
                </div>
              </div>



            </div>
          </div>

        </div>
        <!--main-container-->

      </div>
      <!--col1-layout-->

    </div>
