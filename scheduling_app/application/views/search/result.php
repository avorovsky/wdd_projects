<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * list of search results
 */

?>
<div class="scrollable">
<?php

    $search_field = $data['search_field'];
    unset($data['search_field']);

    foreach ($data as $value) {

?>
    <div class="search_result_item">
        <div class="search_result_link">
            <a href="<?=$value['route']?>" title="<?=$value['view']?>">
                <?=$value['view']?>
            </a>
        </div>
        <div class="search_result_tags">
            <a href="/<?=$value['entity']?>" title="<?=ucfirst($value['entity'])?>">
                <?=ucfirst($value['entity'])?>
            </a>
            &nbsp;&#10148;&nbsp;<?=$value['field']?>
        </div>
        <div class="search_result_data">
            <?=preg_replace("/($search_field)/i", "<span class='highlight'>$1</span>", $value['result'])?>
        </div>
    </div>
<?php

    } //foreach

?>
</div>