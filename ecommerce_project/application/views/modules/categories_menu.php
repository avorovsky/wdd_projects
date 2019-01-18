<div class="side-nav-categories">
<?php

    $data = \Models\Category::getList(1);

    foreach ($data as $key => $value) {

?>
    <div class="block-title">
        <a href="/categories/list/<?=$value['id']?>"><?=$value['name']?></a>
    </div>

<?php } // foreach ?>

</div>
