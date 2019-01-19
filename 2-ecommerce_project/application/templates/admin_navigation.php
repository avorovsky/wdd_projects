<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
<?php

    // tables to skip
    $skipTables = array(
            'wishlist',
            'category_product',
            );

    $active = empty($params[0]) ? 'dashboard' : $params[0];

?>
                    <li class="nav-item">
                        <a class="nav-link<?=($active=='dashboard' ? ' active' : '')?>" href="/admin">
                            Dashboard
                        </a>
                    </li>
<?php

    foreach ($params['tables'] as $key => $value) {

        // skip pivots
        if (in_array($value['TABLE_NAME'], $skipTables)) { continue; }

?>
                    <li class="nav-item">
                        <a class="nav-link<?=($active==$value['TABLE_NAME'] ? ' active' : '')?>" href="/admin/list/<?=$value['TABLE_NAME']?>">
                            <?=ucfirst(str_replace('_', ' ', $value['TABLE_NAME']))?>
                        </a>
                    </li>
<?php } // foreach ?>
                </ul>
            </div>
        </nav>