<div id="top">
    <div class="container">
        <div class="row">
<?php

    // anything in this directory is a promo banner
    $promosDir = $_SERVER['DOCUMENT_ROOT'].IMG.'promos';
    $data = scandir($promosDir);

    // how many to show
    $toShow = 2;

    foreach ($data as $key => $value) {

        if (!is_dir($promosDir.DS.$value)) {

?>
            <!-- Item -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a class="a-disabled" href="/products" data-scroll-goto="1">
                    <img src="<?=IMG.'promos'.DS.$value?>" alt="promotion banner">
                </a>
            </div>
            <!-- /Item -->

<?php
            $toShow--;
            if (!$toShow) {
                break;
            }
               
        } // if 
    } // foreach
?>

        </div>
    </div>
</div>
