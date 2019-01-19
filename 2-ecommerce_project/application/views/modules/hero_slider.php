<div id="thmg-slider-slideshow" class="thmg-slider-slideshow">
    <div class="container">
        <div id='thm_slider_wrapper' class='thm_slider_wrapper fullwidthbanner-container' >
            <div id='thm-rev-slider' class='rev_slider fullwidthabanner'>
                <ul>
<?php

    // anything in this directory is a hero image
    $heroDir = $_SERVER['DOCUMENT_ROOT'].IMG.'hero';
    $data = scandir($heroDir);
 
    foreach ($data as $key => $value) {

        if (!is_dir($heroDir.DS.$value)) {

?>
                    <!-- Item -->
                    <li data-transition='random' data-masterspeed='1000' data-thumb='<?=IMG.'hero'.DS.$value?>'><img src='<?=IMG.'hero'.DS.$value?>' data-bgposition='left top'  data-bgfit='cover' data-bgrepeat='no-repeat' alt="slider-image1" />
                        <div class="info">
                            <div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-x='0'  data-y='220'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2; white-space:nowrap;'><span>Latest Technologies</span></div>
                            <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='0'  data-y='300'  data-endspeed='500'  data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3; white-space:nowrap;'>Simply <span>The Best</span></div>
                            <div class='tp-caption sfb  tp-resizeme ' data-x='0'  data-y='520'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'><a href='/products' class="buy-btn">GO BEYOND THE DEAL</a></div>
                            <div class='tp-caption Title sft  tp-resizeme ' data-x='0'  data-y='420'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'>Discover more Beyond the Deals</div>
                        </div>
                    </li>
                    <!-- /Item -->

<?php   
        } // if 
    } // foreach
?>

                </ul>
            </div>
        </div>
    </div>
</div>
