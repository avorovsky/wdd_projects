        <footer>
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <div class="social">
                                <ul>
                                    <li class="fb"><a href="https://facebook.com"></a></li>
                                    <li class="linkedin"><a href="https://linkedin.com"></a></li>
                                    <li class="tw"><a href="https://twitter.com"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-menu">
                          <ul>
                            <li>
                              <a href="/">HOME</a>
                              <a href="/pages/show/about">ABOUt</a>
                              <a href="<?=PUB.'docs'.DS.'proposal.pdf'?>">TERMS AND CONDITIONS</a>
                              <a href="/pages/show/agreement">LICENSE AGREEMENT</a>
                              <a href="/pages/show/agreement">CONTACT</a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-sm-4 col-xs-12 copyright"> &copy; 2018 Beyond The Deals. All Rights Reserved. </div>
                            <div class="col-xs-12 col-sm-4">
                                <div class="payment-accept">
                                    <img src="<?=IMG?>payment-1.png" alt="">
                                    <img src="<?=IMG?>payment-2.png" alt="">
                                    <img src="<?=IMG?>payment-4.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Mobile nav -->
        <?php include APP.'views'.DS.'modules'.DS.'navigation_mobile.php'; ?>
        <!-- /Mobile nav -->

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script> var $ = jQuery.noConflict(); </script>
        <script src="<?=PUB?>js<?=DS?>live_search.js"></script>
        <script src="<?=PUB?>js<?=DS?>jquery.min.js"></script>
        <script> var jQuery = jQuery.noConflict(); </script>
        <script src="<?=PUB?>js<?=DS?>bootstrap.min.js"></script>
        <script src="<?=PUB?>js<?=DS?>parallax.js"></script>
        <script src="<?=PUB?>js<?=DS?>revslider.js"></script>
        <script src="<?=PUB?>js<?=DS?>common.js"></script>
        <script src="<?=PUB?>js<?=DS?>jquery.bxslider.min.js"></script>
        <script src="<?=PUB?>js<?=DS?>owl.carousel.min.js"></script>
        <script src="<?=PUB?>js<?=DS?>jquery.mobile-menu.min.js"></script>
        <script src="<?=PUB?>js<?=DS?>countdown.js"></script>
        <script src="<?=PUB?>js<?=DS?>emad.js"></script>
        <script><?php $h = empty($_SESSION['cart']) ? 0 : count($_SESSION['cart']);?>
          $(document).ready(function(){
            <?php for($i = 1; $i <= $h; $i++){?>
            $('#qty<?=$i?>').on('change keyup', function(){
              var qty = $('#qty<?=$i?>').val();
              var id = $('#id<?=$i?>').val();
              var url = $('#link<?=$i?>').attr('href', "/cart/update/"+id+"/"+qty);
              url = new_url.attr("href");
            });
            <?php }?>
          });
        </script>
        <script>
        $(document).ready(function(){
          $('#region_id').change(function(){
            var value = this.value;
            //alert(value);
            if(value == ''){
              alert("Something went wrong");
            } else {
              var token = $('input[name=token]').val();
              //alert(token);
              $.ajax({
                  type: 'POST',
                  url: '/cart/shipping',
                  data: {region_id: value, token: token},
                  success: function (result) {
                      // show suggestions
                      $('#ship_cost').html(result);
                  }
              });
            }
          });
        });
        </script>
    </body>
</html>
